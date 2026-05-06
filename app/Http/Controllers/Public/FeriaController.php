<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeriaController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'asc');
        $itemsPerPage = $request->input('items_per_page', 10);
        $informes = Informe::where('tipo_informe_id', '4')
            ->orderBy('titulo', $sort)
            ->paginate($itemsPerPage);

        $contador = $informes->total();
        foreach ($informes as $informe) {
            if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
                $informe->ruta_caratula = 'img/default2.png';
            }
        }
        return view('feria.index', compact('informes', 'contador', 'sort', 'itemsPerPage'));
    }

    public function show($item)
    {
        $informe = Informe::where('id', $item)->firstOrFail();
        $this->actualizarRuta($informe);
        return view('feria.show', compact('informe'));
    }
    private function actualizarRuta(Informe $informe)
    {
        if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
            $informe->ruta_caratula = 'img/default2.png';
        }
    }
}
