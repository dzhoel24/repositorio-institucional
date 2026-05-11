<?php

// routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Informe;

// ============================================
// INICIO
// ============================================
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

// ============================================
// REPOSITORIO UNIFICADO (NUEVO SISTEMA)
// ============================================

// Índice del repositorio por tipo
Breadcrumbs::for('repositorio.index', function (BreadcrumbTrail $trail, $tipo) {
    $trail->parent('home');

    $titulos = [
        'institucional' => 'Repositorio Institucional',
        'investigacion' => 'Repositorio de Investigación',
        'modulo' => 'Módulos Académicos',
        'feria' => 'Proyectos de Feria Tecnológica',
    ];

    $nombre = $titulos[$tipo] ?? 'Repositorio';
    $trail->push($nombre, route('repositorio.index', ['tipo' => $tipo]));
});

// Detalle de un informe en el repositorio
Breadcrumbs::for('repositorio.show', function (BreadcrumbTrail $trail, $tipo, $id) {
    $trail->parent('repositorio.index', $tipo);

    $informe = Informe::find($id);
    if ($informe) {
        $trail->push($informe->titulo, route('repositorio.show', ['tipo' => $tipo, 'id' => $id]));
    }
});

// ============================================
// RESPALDO PARA RUTAS ANTIGUAS (REDIRECCIONES)
// ============================================

// Redirigen a las nuevas rutas
Breadcrumbs::for('institucional.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Repositorio Institucional', route('repositorio.index', ['tipo' => 'institucional']));
});

Breadcrumbs::for('investigacion.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Repositorio de Investigación', route('repositorio.index', ['tipo' => 'investigacion']));
});

Breadcrumbs::for('modulo.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Módulos Académicos', route('repositorio.index', ['tipo' => 'modulo']));
});

Breadcrumbs::for('feria.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Proyectos de Feria Tecnológica', route('repositorio.index', ['tipo' => 'feria']));
});

// Rutas show antiguas (por si acaso)
Breadcrumbs::for('institucional.show', function (BreadcrumbTrail $trail, $informe) {
    $trail->parent('repositorio.index', 'institucional');
    $trail->push($informe->titulo, route('repositorio.show', ['tipo' => 'institucional', 'id' => $informe->id]));
});

Breadcrumbs::for('investigacion.show', function (BreadcrumbTrail $trail, $informe) {
    $trail->parent('repositorio.index', 'investigacion');
    $trail->push($informe->titulo, route('repositorio.show', ['tipo' => 'investigacion', 'id' => $informe->id]));
});

Breadcrumbs::for('modulo.show', function (BreadcrumbTrail $trail, $informe) {
    $trail->parent('repositorio.index', 'modulo');
    $trail->push($informe->titulo, route('repositorio.show', ['tipo' => 'modulo', 'id' => $informe->id]));
});

Breadcrumbs::for('feria.show', function (BreadcrumbTrail $trail, $informe) {
    $trail->parent('repositorio.index', 'feria');
    $trail->push($informe->titulo, route('repositorio.show', ['tipo' => 'feria', 'id' => $informe->id]));
});

// ============================================
// CATEGORÍAS / PROGRAMAS
// ============================================

// Inicio > Categorías
Breadcrumbs::for('section.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Programas de Estudio', route('filtros.category'));
});

// Inicio > Programas de Estudio > {Programa Correspondiente}
Breadcrumbs::for('item.index', function (BreadcrumbTrail $trail, $programa) {
    $trail->parent('section.index');
    $trail->push($programa->nombre, route('carrera.index', ['carrera' => $programa->id]));
});

// Inicio > Programas de Estudio > {Programa Correspondiente} > Detalle
Breadcrumbs::for('item.show', function (BreadcrumbTrail $trail, $programa) {
    $trail->parent('section.index');
    $trail->push($programa->nombre, route('carrera.index', ['carrera' => $programa->id]));
    $trail->push("Detalle del Programa");
});

// ============================================
// FILTROS
// ============================================

// Inicio > Autores
Breadcrumbs::for('filtros.autores', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Autores', route('filtros.autores'));
});

// Inicio > Por Fecha de Publicación
Breadcrumbs::for('filtros.fechaP', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Por Fecha de Publicación', route('filtros.fechaP'));
});

// Inicio > Por Título de Publicación
Breadcrumbs::for('filtros.listTitle', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Por Título de Publicación', route('filtros.listTitle'));
});
