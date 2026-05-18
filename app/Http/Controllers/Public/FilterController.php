<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilterController extends Controller
{
    private function publishedInformesQuery()
    {
        return Informe::with('autores')->where('estado', 'Publicado');
    }

    private function publishedAutoresQuery()
    {
        return Autor::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }]);
    }

    public function searchLetter(Request $request): View
    {
        $starts_with = $request->get('starts_with', '');

        $autores = Autor::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])
            ->having('informes_count', '>', 0)  // 👈 SOLO autores con informes publicados
            ->when(!empty($starts_with), function ($query) use ($starts_with) {
                return $query->where('apellidos', 'LIKE', "$starts_with%");
            })
            ->orderBy('apellidos', 'ASC')
            ->paginate(20)
            ->appends($request->query());

        return view('filtros.autores', compact('autores'));
    }

    public function autores(Request $request): View
    {
        $search = $request->get('search', '');
        $starts_with = $request->get('starts_with', '');
        $perPage = $request->input('items_per_page', 20);

        $query = $this->publishedAutoresQuery()
            ->having('informes_count', '>', 0);  // 👈 SOLO autores con informes publicados

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nombres', 'LIKE', "%$search%")
                    ->orWhere('apellidos', 'LIKE', "%$search%");
            });
        }

        if (!empty($starts_with)) {
            $query->where('apellidos', 'LIKE', "$starts_with%");
        }

        $autores = $query->orderBy('apellidos', 'ASC')
            ->paginate($perPage)
            ->appends($request->query());

        return view('filtros.autores', compact('autores'));
    }

    // app/Http/Controllers/Public/FilterController.php

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

    public function searchYear(Request $request, $year = null): View
    {
        $year = $request->get('search', $year);
        $perPage = $request->input('items_per_page', 10);

        $publi_fecha = $this->publishedInformesQuery()
            ->when(!empty($year), fn($q) => $q->where('anio', $year))
            ->orderBy('anio', 'DESC')
            ->paginate($perPage)
            ->appends($request->query());

        return view('filtros.fecha', [
            'publi_fecha' => $publi_fecha,
            'contador' => $publi_fecha->total(),
            'yearRanges' => $this->generateYearRanges()  // 👈 AGREGAR ESTO
        ]);
    }

    public function searchYearRange(Request $request, string $range): View
    {
        [$yearA, $yearB] = explode('-', $range);
        $perPage = $request->input('items_per_page', 10);

        $publi_fecha = $this->publishedInformesQuery()
            ->whereBetween('anio', [$yearA, $yearB])
            ->orderBy('anio', 'DESC')
            ->paginate($perPage)
            ->appends($request->query());

        return view('filtros.fecha', [
            'publi_fecha' => $publi_fecha,
            'contador' => $publi_fecha->total(),
            'yearRanges' => $this->generateYearRanges()  // 👈 AGREGAR ESTO
        ]);
    }
    /**
     * Lista de títulos
     */
    public function listTitle(Request $request): View
    {
        $search = $request->get('search', '');
        $starts_with = $request->get('starts_with', '');
        $perPage = $request->input('items_per_page', 10);

        $query = $this->publishedInformesQuery();

        if (!empty($search)) {
            $query->where('titulo', 'LIKE', "%$search%");
        }

        if (!empty($starts_with)) {
            $query->where('titulo', 'LIKE', "$starts_with%");
        }

        $informes = $query->orderBy('titulo', 'ASC')
            ->paginate($perPage)
            ->appends($request->query());

        return view('filtros.titulo', compact('informes'));
    }

    /**
     * Mostrar detalle de informe por fecha
     */
    public function show(int $id): View
    {
        $informe = $this->publishedInformesQuery()->findOrFail($id);
        return view('filtros.showFechaP', compact('informe'));
    }

    /**
     * Mostrar detalle de informe por título
     */
    public function showtitle(int $id): View
    {
        $informe = $this->publishedInformesQuery()->findOrFail($id);
        return view('filtros.showTitulos', compact('informe'));
    }

    /**
     * Mostrar informe desde autores
     */
    public function showInformeAutores(int $id): View
    {
        $informe = $this->publishedInformesQuery()->findOrFail($id);
        return view('filtros.showInformeAutores', compact('informe'));
    }

    /**
     * Mostrar informes de un autor específico
     */
    public function showInformes(Autor $autor): View
    {
        $informes = $autor->informes()
            ->with('autores')
            ->where('estado', 'Publicado')
            ->paginate(10);

        return view('filtros.show-informe-autor', compact('autor', 'informes'));
    }

    /**
     * Categorías (redirige o muestra vista)
     */
    public function categories(): View
    {
        return view('public.section.index');
    }
}
