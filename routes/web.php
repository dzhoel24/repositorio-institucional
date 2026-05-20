<?php

use App\Http\Controllers\Public\RepositorioController;
use App\Http\Controllers\Public\FilterController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

// Inicio
Route::get('/', HomeController::class)->name('home');

// Búsqueda global
Route::get('/buscar', [RepositorioController::class, 'globalSearch'])->name('global.search');

// Repositorio unificado
Route::prefix('repositorio')->name('repositorio.')->group(function () {
    Route::get('/{tipo}', [RepositorioController::class, 'index'])
        ->name('index')
        ->where('tipo', 'institucional|investigacion|titulacion|modulo|feria');
    Route::get('/{tipo}/{id}/{origen?}/{origenId?}', [RepositorioController::class, 'show'])
        ->name('show')
        ->where('tipo', 'institucional|investigacion|titulacion|modulo|feria')
        ->where('id', '[0-9]+')
        ->where('origen', 'autor|fecha|titulo|carrera')
        ->where('origenId', '[0-9]+');

    Route::get('/{tipo}/{id}/descargar', [RepositorioController::class, 'download'])
        ->name('download')
        ->where('tipo', 'institucional|investigacion|modulo|feria')
        ->where('id', '[0-9]+');
});

// Filtros
Route::prefix('filtros')->name('filtros.')->group(function () {

    // Fechas
    Route::prefix('fechas')->name('fechas.')->group(function () {
        Route::get('/', [FilterController::class, 'searchYear'])->name('index');
        Route::get('/rango/{range}', [FilterController::class, 'searchYearRange'])->name('rango');
        Route::get('/{id}', [FilterController::class, 'showtitle'])->name('show');
    });

    // Autores
    Route::prefix('autores')->name('autores.')->group(function () {
        Route::get('/', [FilterController::class, 'autores'])->name('index');
        Route::get('/{autor}/informes', [FilterController::class, 'showInformes'])->name('informes');
        Route::get('/informe/{id}', [FilterController::class, 'showInformeAutores'])->name('show');
    });

    // Títulos
    Route::prefix('titulos')->name('titulos.')->group(function () {
        Route::get('/', [FilterController::class, 'listTitle'])->name('index');
        Route::get('/{id}', [FilterController::class, 'showtitle'])->name('show');
    });

    // Carreras
    Route::prefix('carreras')->name('carreras.')->group(function () {
        Route::get('/', [FilterController::class, 'carrerasList'])->name('index');
        Route::get('/{carrera}', [FilterController::class, 'carrerasShow'])->name('show');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
