<?php
// app/Http/Controllers/Public/RepositorioController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RepositorioController extends Controller  // ← Cambiado de InformeController a RepositorioController
{

    private array $tipos = [
        'institucional' => null,  // null = todos
        'investigacion' => 3,
        'modulo'        => 1,
        'feria'         => 4,
    ];

    private array $config = [
        'institucional' => [
            'titulo' => 'Repositorio Institucional',
            'descripcion' => 'Todos los documentos institucionales',
            'icono' => 'heroicon-s-building-library',
            'color' => 'blue',  // ← Agregado para diseño
        ],
        'investigacion' => [
            'titulo' => 'Proyectos de Investigación',
            'descripcion' => 'Investigaciones y artículos científicos',
            'icono' => 'heroicon-s-beaker',
            'color' => 'green',  // ← Agregado
        ],
        'modulo' => [
            'titulo' => 'Módulos Educativos',
            'descripcion' => 'Material educativo y módulos de aprendizaje',
            'icono' => 'heroicon-s-academic-cap',
            'color' => 'purple',  // ← Agregado
        ],
        'feria' => [
            'titulo' => 'Feria de Proyectos',
            'descripcion' => 'Proyectos expuestos en ferias',
            'icono' => 'heroicon-s-sparkles',
            'color' => 'orange',  // ← Agregado
        ],
    ];

    /**
     * Mostrar listado de informes por tipo
     */
    public function index(Request $request, string $tipo): View
    {
        // Validar tipo
        abort_unless(array_key_exists($tipo, $this->tipos), 404);

        $config = $this->config[$tipo];
        $itemsPerPage = $request->input('items_per_page', 10);

        // ✅ CORREGIDO: 'search' en lugar de 'buscador'
        $search = $request->input('search', '');

        $sort = $request->input('sort', 'desc');

        // Construir consulta base
        $query = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('estado', 'Publicado');

        // Filtrar por tipo (excepto institucional que muestra todos)
        if ($tipo !== 'institucional') {
            $query->where('tipo_informe_id', $this->tipos[$tipo]);
        }

        // Búsqueda
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                    ->orWhere('resumen', 'LIKE', "%{$search}%")
                    ->orWhereHas('autores', function ($q) use ($search) {
                        $q->whereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$search}%"]);
                    });
            });
        }

        // Ordenamiento
        $query->orderBy('created_at', $sort === 'desc' ? 'desc' : 'asc');

        // Paginación
        $informes = $query->paginate($itemsPerPage)->withQueryString();
        $contador = $informes->total();

        return view('public.' . $tipo . '.index', compact('informes', 'contador', 'search', 'sort'));
    }


    public function show(Request $request, string $tipo, int $id): View
    {
        // Validar tipo
        abort_unless(array_key_exists($tipo, $this->tipos), 404);

        $config = $this->config[$tipo];

        $informe = Informe::with(['autores', 'carrera', 'tipoInforme'])
            ->where('id', $id)
            ->where('estado', 'Publicado')
            ->firstOrFail();

        // Verificar que el informe corresponde al tipo solicitado
        if ($tipo !== 'institucional' && $informe->tipo_informe_id !== $this->tipos[$tipo]) {
            abort(404);
        }

        // ✅ Usa la vista específica del tipo (institucional.show, investigacion.show, etc.)
        return view('public.' . $tipo . '.show', compact('informe'));
    }
}
