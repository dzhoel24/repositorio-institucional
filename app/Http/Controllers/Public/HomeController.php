<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function __invoke()
    {
        // LA SOLUCIÓN: Añadimos with(['autores', 'tipoInforme'])
        $recientes = Informe::with(['autores', 'tipoInforme'])
            ->latest()
            ->take(10)
            ->get();

        $this->actualizarRutas($recientes);

        return view('home', compact('recientes'));
    }

    private function actualizarRutas($informes)
    {
        foreach ($informes as $informe) {
            $this->actualizarRuta($informe);
        }
    }

    private function actualizarRuta(Informe $informe)
    {
        if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
            $informe->ruta_caratula = 'img/default2.png';
        }
    }
}
