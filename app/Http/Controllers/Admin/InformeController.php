<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HtmxResponse;
use App\Models\Autor;
use App\Models\Informe;
use App\Models\TipoInforme;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InformeController extends Controller
{
    use HtmxResponse;

    public function index(Request $request)
    {
        $busqueda = strtolower($request->query('buscador', ''));

        $informes = Informe::query()
            ->with(['autores', 'carrera', 'tipoInforme'])
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->where(function ($q) use ($busqueda) {
                    $q->whereRaw('LOWER(titulo) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereRaw('CAST(anio AS CHAR) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereHas(
                            'tipoInforme',
                            fn($q) =>
                            $q->whereRaw('LOWER(nombre) LIKE ?', ["%{$busqueda}%"])
                        )
                        ->orWhereHas('autores', function ($q) use ($busqueda) {
                            $q->whereRaw('LOWER(nombres) LIKE ?', ["%{$busqueda}%"])
                                ->orWhereRaw('LOWER(apellidos) LIKE ?', ["%{$busqueda}%"])
                                ->orWhereRaw("LOWER(CONCAT(nombres, ' ', apellidos)) LIKE ?", ["%{$busqueda}%"]);
                        });
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return $this->htmxView('admin.informes.index', [
            'informes'     => $informes,
            'tipos'        => TipoInforme::all(),
            'carreras'     => Carrera::all(),
            'badgeEstilos' => config('repositorio.badge_informes'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'resumen'      => 'required|string',
            'anio'         => 'required|integer',
            'pdf'          => 'required|mimes:pdf',
            'caratula'     => 'required|image|mimes:jpeg,png,jpg,gif',
            'modulo'       => 'nullable|string',
            'tipo_informe' => 'required|string',
            'carrera'      => 'nullable|string',
            'autores'      => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $informe = Informe::create([
                'titulo'          => $request->titulo,
                'resumen'         => $request->resumen,
                'anio'            => $request->anio,
                'estado'          => 'No Publicado',
                'acceso'          => 'Restringido',
                'carrera_id'      => $request->carrera,
                'modulo'          => $request->modulo,
                'tipo_informe_id' => $request->tipo_informe,
                'ruta_pdf'        => $this->subirArchivo($request->file('pdf'), 'pdfs'),
                'ruta_caratula'   => $this->subirArchivo($request->file('caratula'), 'caratulas'),
            ]);

            $informe->autores()->attach($this->parseDnis($request->input('autores')));

            DB::commit();

            return htmxRedirect(route('admin.informes.index'), '¡Informe añadido exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al guardar el informe.')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $informe = Informe::findOrFail($id);

        $request->validate([
            'titulo'       => 'required|string|max:255',
            'resumen'      => 'required|string',
            'autores'      => 'nullable|string',
            'anio'         => 'required|integer',
            'pdf'          => 'nullable|file|mimes:pdf|max:10240',
            'caratula'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'carrera'      => 'nullable|string',
            'modulo'       => 'nullable|string',
            'tipo_informe' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('caratula')) {
                Storage::disk('public')->delete('caratulas/' . $informe->ruta_caratula);
                $informe->ruta_caratula = $this->subirArchivo($request->file('caratula'), 'caratulas');
            }

            if ($request->hasFile('pdf')) {
                Storage::disk('public')->delete('pdfs/' . $informe->ruta_pdf);
                $informe->ruta_pdf = $this->subirArchivo($request->file('pdf'), 'pdfs');
            }

            $informe->update([
                'titulo'          => $request->titulo,
                'resumen'         => $request->resumen,
                'anio'            => $request->anio,
                'carrera_id'      => $request->carrera,
                'modulo'          => $request->modulo,
                'tipo_informe_id' => $request->tipo_informe,
                'ruta_pdf'        => $informe->ruta_pdf,
                'ruta_caratula'   => $informe->ruta_caratula,
            ]);

            $informe->autores()->sync($this->parseDnis($request->input('autores')));

            DB::commit();

            return htmxRedirect(route('admin.informes.index'), 'Informe actualizado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al actualizar el informe.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $informe = Informe::findOrFail($id);

            Storage::disk('public')->delete('pdfs/' . $informe->ruta_pdf);
            Storage::disk('public')->delete('caratulas/' . $informe->ruta_caratula);

            $informe->autores()->detach();
            $informe->delete();

            return htmxRedirect(route('admin.informes.index'), 'Informe eliminado exitosamente!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el informe.');
        }
    }

    public function search_dni_autor(Request $request)
    {
        $dni = $request->query('dni');

        if (!$dni) {
            return response()->json(['message' => 'DNI requerido'], 400);
        }

        $autor = Autor::where('dni', $dni)->first();

        if (!$autor) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }

        return response()->json([
            'nombres'   => $autor->nombres,
            'apellidos' => $autor->apellidos,
        ]);
    }

    private function subirArchivo($file, string $carpeta): string
    {
        $nombre = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->storeAs($carpeta, $nombre, 'public');
        return $nombre;
    }

    private function parseDnis(?string $raw): array
    {
        if (!$raw) return [];
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }
}
