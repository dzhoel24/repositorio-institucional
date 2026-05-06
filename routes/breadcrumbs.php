<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Inicio >
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});
// Inicio > Repositorio Institucional
Breadcrumbs::for('institucional.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Repositorio Institucional', route('institucional.index'));
});

// Inicio > Categorías
Breadcrumbs::for('section.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Programas de Estudio', route('filtros.category'));
});

// Inicio > Programas de Estudio > {Programa Correspondiente}
Breadcrumbs::for('item.index', function (BreadcrumbTrail $trail, $programa) {
    $trail->parent('section.index');
    $trail->push($programa->nombre, route('carrera.index', [ $programa->id])); 
});
// Inicio > Programas de Estudio > {Programa Correspondiente} > {Item Correspondiente} (Breadcrumb para detalles de un ítem)
Breadcrumbs::for('item.show', function (BreadcrumbTrail $trail, $programa) {
    $trail->parent('section.index');
    // Ajustamos el segundo parámetro para que tome el id o nombre correcto.
    $trail->push($programa->nombre, route('carrera.index', ['carrera' => $programa->id]));
    $trail->push("Item");
});



Breadcrumbs::for('investigacion.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Repositorio de Investigación', route('investigacion.index'));
});

Breadcrumbs::for('modulo.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Modulos Academicos', route('modulo.index'));
});
Breadcrumbs::for('feria.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Proyectos de Feria Tecnologica', route('feria.index'));
});

// Filtros
Breadcrumbs::for('filtros.autores', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Autores', route('filtros.autores'));
});
Breadcrumbs::for('filtros.fechaP', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Por Fecha de Publicación', route('filtros.fechaP'));
});
Breadcrumbs::for('filtros.listTitle', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Por Titulo de Publicación', route('filtros.listTitle'));
});
//Secciones



