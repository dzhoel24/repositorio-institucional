<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Carrera;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilterController extends Controller
{
    private function publishedInformesQuery()
    {
        return Informe::with(['autores', 'carrera', 'tipoInforme'])->where('estado', 'Publicado');
    }

    private function publishedAutoresQuery()
    {
        return Autor::withCount([
            'informes' => fn($q) => $q->where('estado', 'Publicado')
        ]);
    }

    private function generateYearRanges(): array
    {
        $currentYear = date('Y');
        $ranges = [];
        $startYear = 2000;

        while ($startYear <= $currentYear) {
            $endYear = min($startYear + 4, $currentYear);
            $ranges[] = "{$startYear}-{$endYear}";
            $startYear += 5;
        }

        return array_reverse($ranges);
    }

    private function getTipoByInforme(Informe $informe): string
    {
        return match ($informe->tipo_informe_id) {
            1 => 'modulo',
            2 => 'titulacion',
            3 => 'investigacion',
            4 => 'feria',
            default => 'institucional'
        };
    }

    public function autores(Request $request): View
    {
        $autores = $this->publishedAutoresQuery()
            ->having('informes_count', '>', 0)
            ->when(
                $request->filled('search'),
                fn($q) => $q->where(function ($q) use ($request) {
                    $q->where('nombres', 'LIKE', "%{$request->search}%")
                        ->orWhere('apellidos', 'LIKE', "%{$request->search}%");
                })
            )
            ->when(
                $request->filled('starts_with'),
                fn($q) => $q->where('apellidos', 'LIKE', "{$request->starts_with}%")
            )
            ->orderBy('apellidos')
            ->paginate($request->input('items_per_page', 10))
            ->appends($request->query());

        return view('public.filtros.autores', compact('autores'));
    }

    public function showInformes(Request $request, Autor $autor): View
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc');
        $itemsPerPage = $request->input('items_per_page', 10);

        $query = $autor->informes()
            ->with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                    ->orWhere('resumen', 'LIKE', "%{$search}%");
            });
        }

        $informes = $query->orderBy('created_at', $sort === 'desc' ? 'desc' : 'asc')
            ->paginate($itemsPerPage)
            ->appends($request->query());

        return view('public.filtros.show-informe-autor', compact('autor', 'informes'));
    }

    public function showInformeAutores(int $id): View
    {
        $informe = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado')
            ->findOrFail($id);

        $tipo = $this->getTipoByInforme($informe);

        $autor = null;
        if ($informe->autores->isNotEmpty()) {
            $autor = $informe->autores->first();
        }

        return view('public.repositorio.show', [
            'informe' => $informe,
            'tipo' => $tipo,
            'origen' => 'autor',
            'origenData' => $autor
        ]);
    }

    public function searchYear(Request $request, $year = null): View
    {
        $year = $request->get('search', $year);

        $publi_fecha = $this->publishedInformesQuery()
            ->when(!empty($year), fn($q) => $q->where('anio', $year))
            ->orderByDesc('anio')
            ->paginate($request->input('items_per_page', 10))
            ->appends($request->query());

        return view('public.filtros.fecha', [
            'publi_fecha' => $publi_fecha,
            'contador' => $publi_fecha->total(),
            'yearRanges' => $this->generateYearRanges(),
        ]);
    }

    public function searchYearRange(Request $request, string $range): View
    {
        [$yearA, $yearB] = explode('-', $range);

        $publi_fecha = $this->publishedInformesQuery()
            ->whereBetween('anio', [$yearA, $yearB])
            ->orderByDesc('anio')
            ->paginate($request->input('items_per_page', 10))
            ->appends($request->query());

        return view('public.filtros.fecha', [
            'publi_fecha' => $publi_fecha,
            'contador' => $publi_fecha->total(),
            'yearRanges' => $this->generateYearRanges(),
        ]);
    }

    public function show(int $id): View
    {
        $informe = $this->publishedInformesQuery()->findOrFail($id);
        $tipo = $this->getTipoByInforme($informe);

        return view('public.repositorio.show', [
            'informe' => $informe,
            'tipo' => $tipo,
            'origen' => 'fecha',
            'origenData' => null
        ]);
    }

    public function listTitle(Request $request): View
    {
        $informes = $this->publishedInformesQuery()
            ->when(
                $request->filled('search'),
                fn($q) => $q->where('titulo', 'LIKE', "%{$request->search}%")
            )
            ->when(
                $request->filled('starts_with'),
                fn($q) => $q->where('titulo', 'LIKE', "{$request->starts_with}%")
            )
            ->orderBy('titulo')
            ->paginate($request->input('items_per_page', 10))
            ->appends($request->query());

        return view('public.filtros.titulo', compact('informes'));
    }

    public function showtitle(int $id): View
    {
        $informe = $this->publishedInformesQuery()->findOrFail($id);
        $tipo = $this->getTipoByInforme($informe);

        return view('public.repositorio.show', [
            'informe' => $informe,
            'tipo' => $tipo,
            'origen' => 'titulo',
            'origenData' => null
        ]);
    }

    public function carrerasList(): View
    {
        $carreras = Carrera::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])->get();

        return view('public.filtros.carreras', compact('carreras'));
    }

    public function carrerasShow(Request $request, $carrera): View
    {
        $carreraModel = Carrera::findOrFail($carrera);

        $search = $request->input('search');
        $sort = $request->input('sort', 'desc');
        $itemsPerPage = $request->input('items_per_page', 10);

        $query = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado')
            ->where('carrera_id', $carrera);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                    ->orWhere('resumen', 'LIKE', "%{$search}%")
                    ->orWhereHas('autores', function ($q) use ($search) {
                        $q->where('nombres', 'LIKE', "%{$search}%")
                            ->orWhere('apellidos', 'LIKE', "%{$search}%");
                    });
            });
        }

        $informes = $query->orderBy('created_at', $sort === 'desc' ? 'desc' : 'asc')
            ->paginate($itemsPerPage)
            ->appends($request->query());

        return view('repositorio.index', [
            'tipo' => 'institucional',
            'origen' => 'carrera',
            'carrera_id' => $carrera
        ]);
    }
}
