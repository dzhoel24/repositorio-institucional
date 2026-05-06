<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ModuloController extends Controller
{
    public function index(Request $request)
    {
        $informes = Informe::where('tipo_informe_id', '1')->//Modulo
        filter($request)
        ->paginate(10)
        ->appends(request()->query());
        $contador = $informes->total();
        foreach ($informes as $informe) {
            if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
                $informe->ruta_caratula = 'img/default2.png';
            }
        }
        return view('modulo.index',compact('informes', 'contador'));
    }
    public function show($item)
    {
        $informe = Informe::where('id', $item)->firstOrFail();
        $this->actualizarRuta($informe);
        return view('modulo.show', compact('informe'));
    }
    private function actualizarRuta(Informe $informe)
    {
        if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
            $informe->ruta_caratula = 'img/default2.png';
        }
    }
}
