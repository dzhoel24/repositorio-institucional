<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use App\Models\Autor;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RepositorioController extends Controller
{
    private array $tipos = [
        'institucional' => null,
        'modulo'        => 1,
        'titulacion' => 2,
        'investigacion' => 3,
        'feria'         => 4,
    ];

    private array $config = [
        'institucional' => [
            'titulo'      => 'Repositorio Institucional',
            'descripcion' => 'Todos los documentos institucionales',
            'color'       => 'blue',
        ],
        'investigacion' => [
            'titulo'      => 'Proyectos de Investigación',
            'descripcion' => 'Investigaciones y artículos científicos',
            'color'       => 'green',
        ],
        'modulo' => [
            'titulo'      => 'Módulos Educativos',
            'descripcion' => 'Material educativo y módulos de aprendizaje',
            'color'       => 'purple',
        ],
        'titulacion' => [
            'titulo'      => 'Proyectos de Titulación',
            'descripcion' => 'Trabajos de titulación y tesis',
            'color'       => 'indigo',
        ],
        'feria' => [
            'titulo'      => 'Feria de Proyectos',
            'descripcion' => 'Proyectos expuestos en ferias',
            'color'       => 'orange',
        ],
    ];

    public function index(Request $request, string $tipo): View
    {
        abort_unless(array_key_exists($tipo, $this->tipos), 404);

        $config       = $this->config[$tipo];
        $search       = strtolower($request->input('search', ''));
        $sort         = $request->input('sort', 'desc');
        $itemsPerPage = $request->input('items_per_page', 10);

        $informes = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado')
            ->when(
                $tipo !== 'institucional',
                fn($q) =>
                $q->where('tipo_informe_id', $this->tipos[$tipo])
            )
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(titulo) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('LOWER(resumen) LIKE ?', ["%{$search}%"])
                        ->orWhereHas(
                            'autores',
                            fn($q) =>
                            $q->whereRaw("LOWER(CONCAT(nombres, ' ', apellidos)) LIKE ?", ["%{$search}%"])
                        );
                });
            })
            ->orderBy('created_at', $sort === 'desc' ? 'desc' : 'asc')
            ->paginate($itemsPerPage)
            ->withQueryString();

        $contador = $informes->total();

        return view('public.repositorio.index', compact('informes', 'config', 'tipo', 'search', 'sort', 'contador'));
    }

    public function show(Request $request, string $tipo, int $id, string $origen = null): View
    {
        abort_unless(array_key_exists($tipo, $this->tipos), 404);

        $config  = $this->config[$tipo];
        $informe = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado')
            ->findOrFail($id);

        if ($tipo !== 'institucional' && $informe->tipo_informe_id !== $this->tipos[$tipo]) {
            abort(404);
        }

        $origenData = null;

        if ($origen === 'autor') {
            $autorId = $request->get('autor_id');
            if ($autorId) {
                $origenData = Autor::find($autorId);
            }
        } elseif ($origen === 'carrera') {
            $carreraId = $request->get('carrera_id');
            if ($carreraId) {
                $origenData = Carrera::find($carreraId);
            }
        }

        return view('public.repositorio.show', compact('informe', 'config', 'tipo', 'origen', 'origenData'));
    }
}
