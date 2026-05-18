<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $carreras = Carrera::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])->get();

        return view('public.section.index', compact('carreras'));
    }

    public function carreras(Request $request, $carrera): View
    {
        $carreraModel = Carrera::findOrFail($carrera);
        $search = $request->input('search_carrera', '');

        $itemsPerPage = $request->input('items_per_page', 10);

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
            ->paginate($itemsPerPage)
            ->appends($request->query());

        return view('public.section.carrera', compact('carreraModel', 'informes', 'search'));
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
