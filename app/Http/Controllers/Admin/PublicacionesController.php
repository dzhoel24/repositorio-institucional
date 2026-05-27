<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HtmxResponse;
use App\Models\Informe;
use Illuminate\Http\Request;

class PublicacionesController extends Controller
{
    use HtmxResponse;

    public function index(Request $request)
    {
        $busqueda = strtolower($request->query('buscador'));

        $publicaciones = Informe::with([
            'autores:dni,nombres,apellidos',
            'tipoInforme:id,nombre',
            'carrera:id,nombre'
        ])
            ->when($busqueda, function ($query, $busqueda) {
                $query->where(function ($q) use ($busqueda) {
                    $q->whereRaw('LOWER(titulo) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereRaw('CAST(anio AS CHAR) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereHas('tipoInforme', function ($t) use ($busqueda) {
                            $t->whereRaw('LOWER(nombre) LIKE ?', ["%{$busqueda}%"]);
                        })
                        ->orWhereHas('autores', function ($a) use ($busqueda) {
                            $a->whereRaw('LOWER(nombres) LIKE ?', ["%{$busqueda}%"])
                                ->orWhereRaw('LOWER(apellidos) LIKE ?', ["%{$busqueda}%"]);
                        });
                });
            })
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        return $this->htmxView('admin.publicaciones.index', [
            'publicaciones' => $publicaciones,
            'tipoEstilos'   => config('repositorio.tipo_estilos_publicaciones'),
        ]);
    }

    public function toggleEstado(Request $request, $id)
    {
        \Log::info('Datos recibidos:', $request->all());

        $informe = Informe::findOrFail($id);

        if ($informe->estado === 'Publicado') {
            $informe->estado = 'No Publicado';
            $informe->acceso = 'Restringido';
            $message = 'El informe ha sido retirado correctamente.';
        } else {
            $request->validate([
                'acceso' => 'required|in:Publico,Restringido',
            ]);
            $informe->estado = 'Publicado';
            $informe->acceso = $request->acceso;
            $message = '¡El informe ha sido publicado exitosamente!';
        }

        $informe->save();
        return htmxRedirect(route('admin.publicaciones.index'), $message);
    }
}
