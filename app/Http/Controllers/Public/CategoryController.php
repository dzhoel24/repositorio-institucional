<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Informe;
use App\Traits\WithFilteringAndPagination;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use WithFilteringAndPagination;

    /**
     * Mostrar carreras o informes por carrera
     */
    public function carreras(Request $request, $carrera = null): View
    {
        if ($carrera) {
            $carreraModel = Carrera::findOrFail($carrera);

            // ✅ Obtener el término de búsqueda
            $search = $request->input('search', '');

            $query = Informe::with(['autores', 'tipoInforme'])
                ->where('carrera_id', $carrera)
                ->where('estado', 'Publicado');

            // ✅ Aplicar búsqueda si existe
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('titulo', 'LIKE', "%{$search}%")
                        ->orWhere('resumen', 'LIKE', "%{$search}%")
                        ->orWhereHas('autores', function ($q) use ($search) {
                            $q->whereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$search}%"]);
                        });
                });
            }

            $informes = $query->orderBy('titulo', 'asc')
                ->paginate(10)
                ->appends($request->query());

            return view('public.section.carrera', [
                'carrera' => $carreraModel,
                'informes' => $informes,
                'contador' => $informes->total(),
                'items' => $informes,
                'search' => $search  // ← Pasar search a la vista
            ]);
        }

        $carreras = Carrera::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])->get();

        return view('public.section.index', compact('carreras'));
    }

    /**
     * Mostrar detalle de un informe
     */
    public function show($id): View
    {
        $item = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado')
            ->findOrFail($id);

        $carreraN = Carrera::select('id', 'nombre')
            ->where('id', $item->carrera_id)
            ->first();

        return view('public.section.showItem', compact('item', 'carreraN'));
    }
}
