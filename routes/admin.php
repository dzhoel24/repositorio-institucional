<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\AutorController;
use App\Http\Controllers\Admin\InformeController;
use App\Http\Controllers\Admin\PublicacionesController;

// Prefijo 'admin' para la URL y 'admin.' para los nombres de ruta
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // PANEL PRINCIPAL (Tu "Home" administrativo)
    Route::get('/dashboard', [PanelController::class, 'home'])->name('index');

    // GESTIÓN DE PROYECTOS (Informes)
    Route::get('informes/buscar-dni', [InformeController::class, 'search_dni_autor'])
        ->name('informes.buscar-dni');
    Route::resource('proyectos', InformeController::class)
        ->names('informes') // Mantiene el nombre interno pero la URL puede ser /admin/proyectos
        ->except(['show']);

    // CENTRO DE PUBLICACIONES
    Route::controller(PublicacionesController::class)->prefix('publicaciones')->name('publicaciones.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/{id}/toggle', 'toggleEstado')->name('toggle');
    });

    // DIRECTORIO DE AUTORES
    Route::resource('autores', AutorController::class)->parameters([
        'autores' => 'dni'
    ]);

    // SOPORTE (Perfil y Manual)
    Route::get('/perfil', [PanelController::class, 'perfil'])->name('perfil');
    Route::get('/manual', [PanelController::class, 'manual'])->name('manual');
});
Route::put('/perfil/password', [PanelController::class, 'updatePassword'])
    ->name('profile.password.update');
require __DIR__ . '/auth.php';
