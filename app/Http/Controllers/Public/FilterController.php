<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilterController extends Controller
{
    /**
     * Mostrar lista de autores
     */
    public function autores(Request $request): View
    {
        $search = $request->get('search', '');
        $starts_with = $request->get('starts_with', '');

        // ✅ CORREGIDO: Solo contar informes publicados
        $query = Autor::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }]);

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
            ->paginate($request->input('items_per_page', 20))
            ->appends($request->query());

        return view('filtros.autores', compact('autores'));
    }

    /**
     * Búsqueda de autores por letra
     */
    public function searchLetter(Request $request): View
    {
        $starts_with = $request->get('starts_with', '');

        // ✅ CORREGIDO: Solo contar informes publicados
        $autores = Autor::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])
            ->when(!empty($starts_with), function ($query) use ($starts_with) {
                return $query->where('apellidos', 'LIKE', "$starts_with%");
            })
            ->orderBy('apellidos', 'ASC')
            ->paginate(20)
            ->appends($request->query());

        return view('filtros.autores', compact('autores'));
    }

    /**
     * Búsqueda por año
     */
    public function searchYear(Request $request, $year = null): View
    {
        $year = $request->get('search', $year);

        $publi_fecha = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->when(!empty($year), function ($query) use ($year) {
                return $query->where('anio', $year);
            })
            ->orderBy('anio', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        $contador = $publi_fecha->total();

        return view('filtros.fechaP', compact('publi_fecha', 'contador'));
    }

    /**
     * Búsqueda por rango de años
     */
    public function searchYearRange(Request $request, string $range): View
    {
        [$yearA, $yearB] = explode('-', $range);

        $publi_fecha = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->whereBetween('anio', [$yearA, $yearB])
            ->orderBy('anio', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        $contador = $publi_fecha->total();

        return view('filtros.fechaP', compact('publi_fecha', 'contador'));
    }

    /**
     * Lista de títulos
     */
    public function listTitle(Request $request): View
    {
        $search = $request->get('search', '');

        $informes = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->when(!empty($search), function ($query) use ($search) {
                return $query->where('titulo', 'LIKE', "%$search%");
            })
            ->orderBy('titulo', 'ASC')
            ->paginate(10)
            ->appends($request->query());

        return view('filtros.listTitulo', compact('informes'));
    }

    /**
     * Mostrar detalle de informe por fecha
     */
    public function show(int $id): View
    {
        $informe = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->findOrFail($id);

        return view('filtros.showFechaP', compact('informe'));
    }

    /**
     * Mostrar detalle de informe por título
     */
    public function showtitle(int $id): View
    {
        $informe = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->findOrFail($id);

        return view('filtros.showTitulos', compact('informe'));
    }

    /**
     * Mostrar informe desde autores
     */
    public function showInformeAutores(int $id): View
    {
        $informe = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->findOrFail($id);

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

        return view('filtros.informesA', compact('autor', 'informes'));
    }

    /**
     * Búsqueda de títulos por letra
     */
    public function searchTitle(Request $request): View
    {
        $starts_with = $request->get('starts_with', '');

        $informes = Informe::with('autores')
            ->where('estado', 'Publicado')
            ->when(!empty($starts_with), function ($query) use ($starts_with) {
                return $query->where('titulo', 'LIKE', "$starts_with%");
            })
            ->orderBy('titulo', 'ASC')
            ->paginate(10)
            ->appends($request->query());

        return view('filtros.listTitulo', compact('informes'));
    }

    /**
     * Categorías (redirige o muestra vista)
     */
    public function categories(): View
    {
        return view('public.section.index');
    }
}
