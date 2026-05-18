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

    public function carreras(Request $request, $carrera = null): View
    {
        if ($carrera) {
            $carreraModel = Carrera::findOrFail($carrera);

            $search = $request->input('search_carrera', '');

            $query = Informe::with(['autores', 'tipoInforme'])
                ->where('carrera_id', $carrera)
                ->where('estado', 'Publicado');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('titulo', 'LIKE', "%{$search}%")
                        ->orWhere('resumen', 'LIKE', "%{$search}%");
                });
            }

            $informes = $query->orderBy('titulo', 'asc')
                ->paginate(10)
                ->appends($request->query());

            return view('public.section.carrera', compact('carreraModel', 'informes', 'search'));
        }

        // ✅ Agrega este bloque para cuando no hay carrera seleccionada
        $carreras = Carrera::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])->get();

        return view('public.section.index', compact('carreras'));
    }

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
