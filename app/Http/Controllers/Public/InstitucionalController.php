<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use App\Models\Informe;
use App\Traits\WithFilteringAndPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class InstitucionalController extends Controller
{
    use WithFilteringAndPagination;
    public function index(Request $request): Factory|View
    {
        $query = Informe::filter($request);
        $informes = $this->applyFilters($request, $query);
        $contador = $informes->total();
        return view('institucional.index', compact('informes', 'contador'));
    }

    public function show($item): Factory|View
    {
        $informe = Informe::where('id', $item)->firstOrFail();
        $this->actualizarRuta($informe);
        return view('institucional.show', compact('informe'));
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
