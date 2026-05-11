<?php

use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\RepositorioController;  // ← Cambiado de InformeController
use App\Http\Controllers\Public\FilterController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;
// Búsqueda global
Route::get('/buscar', [RepositorioController::class, 'globalSearch'])->name('global.search');
Route::redirect('/investigacion', '/repositorio/investigacion', 301);
Route::redirect('/investigacion/{id}', '/repositorio/investigacion/{id}', 301);
Route::redirect('/modulo', '/repositorio/modulo', 301);
Route::redirect('/modulo/{id}', '/repositorio/modulo/{id}', 301);
Route::redirect('/feria', '/repositorio/feria', 301);
Route::redirect('/feria/{id}', '/repositorio/feria/{id}', 301);
Route::redirect('/institucional', '/repositorio/institucional', 301);
Route::redirect('/institucional/{id}', '/repositorio/institucional/{id}', 301);
// Ruta principal
Route::get('/', HomeController::class)->name('home');

// 🚀 Repositorio unificado
Route::prefix('repositorio')->name('repositorio.')->group(function () {
    // Listados por tipo
    Route::get('/{tipo}', [RepositorioController::class, 'index'])  // ← Corregido
        ->name('index')
        ->where('tipo', 'institucional|investigacion|modulo|feria');

    // Ver detalle
    Route::get('/{tipo}/{id}', [RepositorioController::class, 'show'])  // ← Corregido
        ->name('show')
        ->where('tipo', 'institucional|investigacion|modulo|feria')
        ->where('id', '[0-9]+');

    // Descargar PDF
    Route::get('/{tipo}/{id}/descargar', [RepositorioController::class, 'download'])  // ← Corregido
        ->name('download')
        ->where('tipo', 'institucional|investigacion|modulo|feria')
        ->where('id', '[0-9]+');
});

// 🔄 Redirecciones de URLs antiguas (para no romper enlaces existentes)
Route::redirect('/institucional', '/repositorio/institucional', 301);
Route::redirect('/investigacion', '/repositorio/investigacion', 301);
Route::redirect('/modulo', '/repositorio/modulo', 301);
Route::redirect('/feria', '/repositorio/feria', 301);

// El resto de tus rutas se mantienen igual
// Rutas para filtros de fechas
Route::prefix('filtros/fecha')->group(function () {
    Route::get('/', [FilterController::class, 'searchYear'])->name('filtros.fechaP');
    Route::get('{id}', [FilterController::class, 'show'])->name('filtros.showFechaP');
    Route::get('fecharange/{range}', [FilterController::class, 'searchYearRange'])->name('filtros.rangeYear');
});

// Rutas para filtros de autores
Route::prefix('filtros/autores')->group(function () {
    Route::get('/', [FilterController::class, 'autores'])->name('filtros.autores');
    Route::get('search', [FilterController::class, 'searchLetter'])->name('filtros.autores.search');
    Route::get('/informesAutor/{autor}', [FilterController::class, 'showInformes'])->name('filtros.showAutor');
    Route::get('/informes/{informe}', [FilterController::class, 'showInformeAutores'])->name('filtros.showInformeAutores');
    Route::get('/{autor}/informes', [FilterController::class, 'showInformes'])->name('filtros.informesA');
});

// Rutas para listas de títulos
Route::prefix('filtros/listTitle')->group(function () {
    Route::get('search', [FilterController::class, 'searchTitle'])->name('filtros.listTitle.search');
    Route::get('{filtros}', [FilterController::class, 'showtitle'])->name('filtros.show');
    Route::get('/', [FilterController::class, 'listTitle'])->name('filtros.listTitle');
});

// Rutas para categorías
Route::prefix('filtros/category')->group(function () {
    Route::get('/', [FilterController::class, 'categories'])->name('filtros.category');
    Route::get('/item/{id}', [CategoryController::class, 'show'])->name('carrera.show');
    Route::get('/{carrera?}', [CategoryController::class, 'carreras'])->name('carrera.index');
});
