<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HtmxResponse;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class AutorController extends Controller
{
    use HtmxResponse;

    public function index(Request $request)
    {
        try {
            $autores = Autor::withCount('informes')
                ->filter($request)
                ->orderBy('dni', 'asc')
                ->paginate(10)
                ->withQueryString();

            return $this->htmxView('admin.autores.index', [
                'autores' => $autores,
                'paletas' => config('repositorio.paletas_autores'),
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Error al cargar los autores.');
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'dni'      => 'required|string|min:8',
                'nombres'  => 'required|string',
                'apellidos' => 'required|string',
            ]);

            Autor::create($data);

            return htmxRedirect(route('admin.autores.index'), 'Autor creado correctamente.');
        } catch (Exception $e) {
            return back()->with('error', 'Error al crear el autor.');
        }
    }

    public function update(Request $request, $dni)
    {
        try {
            $autor = Autor::where('dni', $dni)->firstOrFail();

            $data = $request->validate([
                'nombres'  => 'required|string',
                'apellidos' => 'required|string',
            ]);

            $autor->update($data);

            return htmxRedirect(route('admin.autores.index'), 'Autor actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'El autor no existe.');
        } catch (Exception $e) {
            return back()->with('error', 'Error al actualizar el autor.');
        }
    }

    public function destroy($dni)
    {
        try {
            Autor::where('dni', $dni)->firstOrFail()->delete();

            return htmxRedirect(route('admin.autores.index'), 'Autor eliminado correctamente.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'El autor no existe o ya fue eliminado.');
        } catch (Exception $e) {
            return back()->with('error', 'Error al eliminar el autor.');
        }
    }
}
