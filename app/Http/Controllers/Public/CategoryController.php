<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Informe;
use App\Traits\WithFilteringAndPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use WithFilteringAndPagination;
    public function carreras($carrera, Request $request)
    {
        $search = $request->get('search', '');
        $starts_with = $request->get('starts_with', '');

        $carreraN = Carrera::select('id', 'nombre')->where('id', $carrera)->first();
        $query = Informe::where('carrera_id', $carrera);
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'LIKE', "%$search%");
            });
        }
        if (!empty($starts_with)) {
            $query->where('titulo', 'LIKE', "$starts_with%");
        }

        $items = $this->applyFilters($request, $query);
        $contador = $items->total();
        $this->actualizarRutaInforme($items);

        return view('section.carrera', compact('items', 'contador', 'carrera', 'carreraN'));
    }

    public function show($id)
    {
        $item = Informe::findOrFail($id);
        $carreraN = Carrera::select('id', 'nombre')->where('id', $item->carrera_id)->first();
        $this->actualizarRuta($item);
        return view('section.showItem', compact('item', 'carreraN'));
    }
    private function actualizarRuta(Informe $informe)
    {
        if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
            $informe->ruta_caratula = 'img/default2.png';
        }
    }

    private function actualizarRutaInforme($informes)
    {
        foreach ($informes as $informe) {
            if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
                $informe->ruta_caratula = 'img/default2.png';
            }
        }
    }
}
