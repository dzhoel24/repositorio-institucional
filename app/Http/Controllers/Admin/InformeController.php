<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HtmxResponse;
use App\Models\Autor;
use App\Models\AutorInforme;
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
        $busqueda = strtolower($request->query('buscador'));

        $informes = Informe::query()
            ->select('informe.*', 'tipo_informe.nombre as tipo_nombre')
            ->join('tipo_informe', 'informe.tipo_informe_id', '=', 'tipo_informe.id')
            ->with('carrera')
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->where(function ($q) use ($busqueda) {
                    $q->whereRaw('LOWER(informe.titulo) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereRaw('CAST(informe.anio AS CHAR) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereRaw('LOWER(tipo_informe.nombre) LIKE ?', ["%{$busqueda}%"])
                        ->orWhereExists(function ($sub) use ($busqueda) {
                            $sub->select(DB::raw(1))
                                ->from('autor_informe')
                                ->join('autores', 'autor_informe.autor_dni', '=', 'autores.dni')
                                ->whereColumn('autor_informe.informe_id', 'informe.id')
                                ->where(function ($q2) use ($busqueda) {
                                    $q2->whereRaw('LOWER(autores.nombres) LIKE ?', ["%{$busqueda}%"])
                                        ->orWhereRaw('LOWER(autores.apellidos) LIKE ?', ["%{$busqueda}%"])
                                        ->orWhereRaw("LOWER(CONCAT(autores.nombres, ' ', autores.apellidos)) LIKE ?", ["%{$busqueda}%"]);
                                });
                        });
                });
            })
            ->orderByDesc('informe.id')
            ->paginate(10)
            ->withQueryString();

        $informes->getCollection()->transform(function ($informe) {
            $informe->autores = AutorInforme::join('autores', 'autor_informe.autor_dni', '=', 'autores.dni')
                ->where('autor_informe.informe_id', $informe->id)
                ->select('autores.*')
                ->get();
            return $informe;
        });

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

            $informe                  = new Informe();
            $informe->titulo          = $request->titulo;
            $informe->resumen         = $request->resumen;
            $informe->anio            = $request->anio;
            $informe->estado          = 'No Publicado';
            $informe->acceso          = 'Restringido';
            $informe->carrera_id      = $request->carrera;
            $informe->modulo          = $request->modulo;
            $informe->tipo_informe_id = $request->tipo_informe;

            $pdf         = $request->file('pdf');
            $nombrePDF   = time() . '_' . str_replace(' ', '_', $pdf->getClientOriginalName());
            $pdf->storeAs('pdfs', $nombrePDF, 'public');
            $informe->ruta_pdf = $nombrePDF;

            $caratula        = $request->file('caratula');
            $nombreCaratula  = time() . '_' . str_replace(' ', '_', $caratula->getClientOriginalName());
            $caratula->storeAs('caratulas', $nombreCaratula, 'public');
            $informe->ruta_caratula = $nombreCaratula;

            $informe->save();

            $dniArray    = array_filter(array_map('trim', explode(',', $request->input('autores'))));
            $autoresData = [];
            foreach ($dniArray as $dni) {
                if (!empty($dni)) {
                    $autoresData[] = ['autor_dni' => $dni, 'informe_id' => $informe->id];
                }
            }
            AutorInforme::insert($autoresData);

            DB::commit();

            return htmxRedirect(route('admin.informes.index'), '¡Proyecto añadido exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al guardar el proyecto.')->withInput();
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
            'pdf'          => 'nullable|mimes:pdf',
            'caratula'     => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'carrera'      => 'nullable|string',
            'modulo'       => 'nullable|string',
            'tipo_informe' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('caratula')) {
                if ($informe->ruta_caratula) {
                    Storage::disk('public')->delete('caratulas/' . $informe->ruta_caratula);
                }
                $caratula       = $request->file('caratula');
                $nombreCaratula = time() . '_' . str_replace(' ', '_', $caratula->getClientOriginalName());
                $caratula->storeAs('caratulas', $nombreCaratula, 'public');
                $informe->ruta_caratula = $nombreCaratula;
            }

            if ($request->hasFile('pdf')) {
                if ($informe->ruta_pdf) {
                    Storage::disk('public')->delete('pdfs/' . $informe->ruta_pdf);
                }
                $pdf       = $request->file('pdf');
                $nombrePDF = time() . '_' . str_replace(' ', '_', $pdf->getClientOriginalName());
                $pdf->storeAs('pdfs', $nombrePDF, 'public');
                $informe->ruta_pdf = $nombrePDF;
            }

            $informe->titulo          = $request->titulo;
            $informe->resumen         = $request->resumen;
            $informe->anio            = $request->anio;
            $informe->carrera_id      = $request->carrera;
            $informe->modulo          = $request->modulo;
            $informe->tipo_informe_id = $request->tipo_informe;
            $informe->save();

            $dniArray     = array_filter(array_map('trim', explode(',', $request->input('autores'))));
            $existingDnis = AutorInforme::where('informe_id', $informe->id)->pluck('autor_dni')->toArray();

            $dnisToRemove = array_diff($existingDnis, $dniArray);
            AutorInforme::whereIn('autor_dni', $dnisToRemove)
                ->where('informe_id', $informe->id)
                ->delete();

            foreach (array_diff($dniArray, $existingDnis) as $dni) {
                if (!empty($dni)) {
                    AutorInforme::create(['autor_dni' => $dni, 'informe_id' => $informe->id]);
                }
            }

            DB::commit();

            return htmxRedirect(route('admin.informes.index'), '¡Proyecto actualizado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al actualizar el proyecto.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $informe = Informe::findOrFail($id);

            if ($informe->ruta_pdf) {
                Storage::disk('public')->delete('pdfs/' . $informe->ruta_pdf);
            }
            if ($informe->ruta_caratula) {
                Storage::disk('public')->delete('caratulas/' . $informe->ruta_caratula);
            }

            $informe->autores()->detach();
            $informe->delete();

            return htmxRedirect(route('admin.informes.index'), '¡Proyecto eliminado exitosamente!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el proyecto.');
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
}
