<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Informe;
use App\Models\Carrera;
use App\Models\Autor;

// INICIO
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

// REPOSITORIO
Breadcrumbs::for('repositorio.index', function (BreadcrumbTrail $trail, $tipo) {
    $trail->parent('home');

    $titulos = [
        'institucional' => 'Repositorio Institucional',
        'investigacion' => 'Proyectos de Investigación',
        'titulacion' => 'Proyectos de Titulación',
        'modulo' => 'Módulos Educativos',
        'feria' => 'Feria de Proyectos',
    ];

    $nombre = $titulos[$tipo] ?? 'Repositorio';
    $trail->push($nombre, route('repositorio.index', ['tipo' => $tipo]));
});

Breadcrumbs::for('repositorio.show', function (BreadcrumbTrail $trail, $tipo, $id, $origen = null, $origenData = null) {

    // Si viene de autores
    if ($origen === 'autor' && $origenData) {
        $trail->parent('filtros.autores.informes', $origenData);
    }
    // Si viene de fechas
    elseif ($origen === 'fecha') {
        $trail->parent('filtros.fechas.index');
    }
    // Si viene de títulos
    elseif ($origen === 'titulo') {
        $trail->parent('filtros.titulos.index');
    }
    // Si viene de carrera
    elseif ($origen === 'carrera' && $origenData) {
        $trail->parent('filtros.carreras.show', $origenData);
    }
    // Por defecto, viene del repositorio
    else {
        $trail->parent('repositorio.index', $tipo);
    }

    $informe = Informe::find($id);
    if ($informe) {
        $trail->push($informe->titulo, route('repositorio.show', ['tipo' => $tipo, 'id' => $id]));
    }
});

// FILTROS - AUTORES
Breadcrumbs::for('filtros.autores.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Autores', route('filtros.autores.index'));
});

Breadcrumbs::for('filtros.autores.informes', function (BreadcrumbTrail $trail, $autor) {
    $trail->parent('filtros.autores.index');

    if ($autor instanceof Autor) {
        $trail->push($autor->nombres . ' ' . $autor->apellidos, route('filtros.autores.informes', ['autor' => $autor]));
    }
});

// FILTROS - FECHAS
Breadcrumbs::for('filtros.fechas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Fecha de Publicación', route('filtros.fechas.index'));
});

Breadcrumbs::for('filtros.fechas.rango', function (BreadcrumbTrail $trail, $range) {
    $trail->parent('filtros.fechas.index');
    $trail->push($range, route('filtros.fechas.rango', ['range' => $range]));
});

// FILTROS - TÍTULOS
Breadcrumbs::for('filtros.titulos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Títulos de Documentos', route('filtros.titulos.index'));
});

// FILTROS - CARRERAS
Breadcrumbs::for('filtros.carreras.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Programas de Estudio', route('filtros.carreras.index'));
});

Breadcrumbs::for('filtros.carreras.show', function (BreadcrumbTrail $trail, $carrera) {
    $trail->parent('filtros.carreras.index');

    // Asegurar que $carrera es un ID, no una colección
    $carreraId = is_numeric($carrera) ? $carrera : ($carrera->id ?? null);
    $carreraModel = Carrera::find($carreraId);

    if ($carreraModel) {
        $trail->push($carreraModel->nombre, route('filtros.carreras.show', ['carrera' => $carreraId]));
    }
});
