<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use App\Models\Autor;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RepositorioController extends Controller
{
    private array $tipos = [
        'institucional' => null,
        'modulo'        => 1,
        'titulacion'    => 2,
        'investigacion' => 3,
        'feria'         => 4,
    ];

    private array $config = [
        'institucional' => [
            'titulo'      => 'Repositorio Institucional',
            'descripcion' => 'Documentos oficiales, normativas y publicaciones institucionales',
            'color'       => 'blue',
        ],
        'investigacion' => [
            'titulo'      => 'Proyectos de Investigación',
            'descripcion' => 'Estudios, artículos científicos y avances académicos',
            'color'       => 'green',
        ],
        'modulo' => [
            'titulo'      => 'Prácticas Modulares',
            'descripcion' => 'Informes de prácticas profesionales por módulo',
            'color'       => 'purple',
        ],
        'titulacion' => [
            'titulo'      => 'Proyectos de Titulación',
            'descripcion' => 'Tesis, monografías y trabajos de grado para titulación',
            'color'       => 'indigo',
        ],
        'feria' => [
            'titulo'      => 'Feria de Proyectos',
            'descripcion' => 'Prototipos, innovaciones y proyectos expuestos en ferias',
            'color'       => 'orange',
        ],
    ];

    private function baseQuery()
    {
        return Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado');
    }

    public function index(Request $request, string $tipo): View
    {
        abort_unless(array_key_exists($tipo, $this->tipos), 404);

        $search = strtolower($request->input('search', ''));
        $sort = $request->input('sort', 'desc');
        $itemsPerPage = $request->input('items_per_page', 10);
        $origen = $request->get('origen');
        $carreraId = $request->get('carrera_id');
        $autorId = $request->get('autor_id');

        $query = $this->baseQuery()
            ->when($tipo !== 'institucional', fn($q) => $q->where('tipo_informe_id', $this->tipos[$tipo]))
            ->when($carreraId, fn($q) => $q->where('carrera_id', $carreraId))
            ->when($autorId, fn($q) => $q->whereHas('autores', fn($q) => $q->where('autores.dni', $autorId)))
            ->when($search, fn($q) => $q->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(titulo) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(resumen) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('autores', fn($q) => $q->whereRaw("LOWER(CONCAT(nombres, ' ', apellidos)) LIKE ?", ["%{$search}%"]));
            }))
            ->orderBy('created_at', $sort === 'desc' ? 'desc' : 'asc');

        $informes = $query->paginate($itemsPerPage)->withQueryString();

        $carreraModel = null;
        $autorModel = null;
        $origenModel = null;

        if ($origen === 'carrera' && $carreraId) {
            $carreraModel = Carrera::find($carreraId);
            $origenModel = $carreraModel;
        }

        if ($origen === 'autor' && $autorId) {
            $autorModel = Autor::find($autorId);
            $origenModel = $autorModel;
        }

        return view('public.repositorio.index', [
            'informes' => $informes,
            'config' => $this->config[$tipo],
            'tipo' => $tipo,
            'search' => $search,
            'sort' => $sort,
            'contador' => $informes->total(),
            'origen' => $origen,
            'origenModel' => $origenModel,
            'carreraModel' => $carreraModel,
            'autorModel' => $autorModel,
        ]);
    }

    public function show(Request $request, string $tipo, int $id, string $origen = null, string $origenId = null): View
    {
        abort_unless(array_key_exists($tipo, $this->tipos), 404);

        $informe = $this->baseQuery()->findOrFail($id);

        if ($tipo !== 'institucional' && $informe->tipo_informe_id !== $this->tipos[$tipo]) {
            abort(404);
        }

        $origenData = null;

        if ($origen === 'carrera' && $origenId) {
            $origenData = Carrera::find($origenId);
        } elseif ($origen === 'autor' && $origenId) {
            $origenData = Autor::find($origenId);
        }

        return view('public.repositorio.show', [
            'informe' => $informe,
            'config' => $this->config[$tipo],
            'tipo' => $tipo,
            'origen' => $origen,
            'origenData' => $origenData,
        ]);
    }
}
