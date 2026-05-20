<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Informe;
use App\Models\Carrera;
use App\Models\Autor;

// HOME
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

// REPOSITORIO

Breadcrumbs::for('repositorio.index', function (BreadcrumbTrail $trail, $tipo, $origen = null, $origenModel = null) {
    $titulos = [
        'institucional' => 'Repositorio Institucional',
        'investigacion' => 'Investigación',
        'titulacion' => 'Titulación',
        'modulo' => 'Módulos',
        'feria' => 'Ferias',
    ];

    if ($origen === 'carrera' && $origenModel) {
        $trail->parent('filtros.carreras.index');
        $trail->push($origenModel->nombre, route('repositorio.index', [
            'tipo' => $tipo,
            'origen' => 'carrera',
            'carrera_id' => $origenModel->id
        ]));
    } elseif ($origen === 'autor' && $origenModel) {
        $trail->parent('filtros.autores.index');
        $trail->push($origenModel->nombre_completo, route('repositorio.index', [
            'tipo' => $tipo,
            'origen' => 'autor',
            'autor_id' => $origenModel->id
        ]));
    } else {
        $trail->parent('home');
        $trail->push($titulos[$tipo] ?? 'Repositorio', route('repositorio.index', ['tipo' => $tipo]));
    }
});

Breadcrumbs::for('repositorio.show', function (BreadcrumbTrail $trail, $tipo, $id, $origen = null, $origenData = null) {
    $informe = Informe::find($id);

    if (!$informe) {
        $trail->parent('home');
        $trail->push('Documento no encontrado');
        return;
    }

    match ($origen) {
        'carrera' => $trail->parent('filtros.carreras.show', is_numeric($origenData) ? Carrera::find($origenData) : $origenData),
        'autor' => $trail->parent('filtros.autores.informes', is_numeric($origenData) ? Autor::find($origenData) : $origenData),
        'fecha' => $trail->parent('filtros.fechas.index'),
        'titulo' => $trail->parent('filtros.titulos.index'),
        default => $trail->parent('repositorio.index', $tipo),
    };

    $trail->push($informe->titulo, route('repositorio.show', ['tipo' => $tipo, 'id' => $id]));
});

// FILTROS - AUTORES

Breadcrumbs::for('filtros.autores.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Autores', route('filtros.autores.index'));
});

Breadcrumbs::for('filtros.autores.informes', function (BreadcrumbTrail $trail, $autor) {
    $trail->parent('filtros.autores.index');
    $nombre = $autor instanceof Autor ? $autor->nombre_completo : 'Publicaciones del autor';
    $trail->push($nombre, route('filtros.autores.informes', ['autor' => $autor]));
});

// FILTROS - TÍTULOS

Breadcrumbs::for('filtros.titulos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Títulos', route('filtros.titulos.index'));
});

// FILTROS - FECHAS

Breadcrumbs::for('filtros.fechas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Fechas', route('filtros.fechas.index'));
});

Breadcrumbs::for('filtros.fechas.rango', function (BreadcrumbTrail $trail, $range) {
    $trail->parent('filtros.fechas.index');
    $trail->push($range, route('filtros.fechas.rango', ['range' => $range]));
});

// FILTROS - CARRERAS

Breadcrumbs::for('filtros.carreras.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Programas de Estudio', route('filtros.carreras.index'));
});

Breadcrumbs::for('filtros.carreras.show', function (BreadcrumbTrail $trail, $carrera) {
    $trail->parent('filtros.carreras.index');
    $carreraModel = is_numeric($carrera) ? Carrera::find($carrera) : $carrera;
    $trail->push($carreraModel->nombre ?? 'Carrera no encontrada', $carreraModel ? route('filtros.carreras.show', ['carrera' => $carreraModel->id]) : '#');
});
