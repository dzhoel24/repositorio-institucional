<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use App\Traits\WithFilteringAndPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InvestigacionController extends Controller
{
    use WithFilteringAndPagination;
    public function index(Request $request): Factory|View
    {
        $informes = Informe::where('tipo_informe_id', '3') // Investigación
            ->with(['autores' => function($query) {
                $query->select('nombres', 'apellidos', 'autor_informe.informe_id');
            }])
            ->filter($request)
            ->paginate(10)
            ->appends(request()->query());

        $contador = $informes->total();

        foreach ($informes as $informe) {
            if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
                $informe->ruta_caratula = 'img/default2.png';
            }
        }

        return view('investigacion.index', compact('informes', 'contador'));
    }


    public function show($item): Factory|View
    {
        $informe = Informe::where('id', $item)->firstOrFail();
        $this->actualizarRuta($informe);
        return view('investigacion.show', compact('informe'));
    }
    private function actualizarRuta(Informe $informe)
    {
        if (!empty($informe->ruta_caratula) && !File::exists(public_path($informe->ruta_caratula))) {
            $informe->ruta_caratula = 'img/default2.png';
        }
    }
}
