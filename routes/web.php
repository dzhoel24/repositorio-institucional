<?php

use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\FeriaController;
use App\Http\Controllers\Public\FilterController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\InstitucionalController;
use App\Http\Controllers\Public\InvestigacionController;
use App\Http\Controllers\Public\ModuloController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', HomeController::class)->name('home');

// Rutas para los repositorios
Route::prefix('institucional')->group(function () {
    Route::get('/', [InstitucionalController::class, 'index'])->name('institucional.index');
    Route::get('/{institucional}', [InstitucionalController::class, 'show'])->name('institucional.show');
});

// Rutas para el controlador Investigacion
Route::prefix('investigacion')->group(function () {
    Route::get('/', [InvestigacionController::class, 'index'])->name('investigacion.index');
    Route::get('/{investigacion}', [InvestigacionController::class, 'show'])->name('investigacion.show');
});

// Rutas para el controlador Modulo
Route::prefix('modulo')->group(function () {
    Route::get('/', [ModuloController::class, 'index'])->name('modulo.index');
    Route::get('/{modulo}', [ModuloController::class, 'show'])->name('modulo.show');
});

// Rutas para la feria
Route::prefix('feria')->group(function () {
    Route::get('/', [FeriaController::class, 'index'])->name('feria.index');
    Route::get('/{feria}', [FeriaController::class, 'show'])->name('feria.show');
});

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
