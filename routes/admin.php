<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\AutorController;
use App\Http\Controllers\Admin\InformeController;
use App\Http\Controllers\Admin\PublicacionesController;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [PanelController::class, 'home'])->name('index');

    Route::get('informes/buscar-dni', [InformeController::class, 'search_dni_autor'])
        ->name('informes.buscar-dni');
    Route::resource('proyectos', InformeController::class)
        ->names('informes')
        ->except(['show']);

    Route::controller(PublicacionesController::class)->prefix('publicaciones')->name('publicaciones.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/{id}/toggle', 'toggleEstado')->name('toggle');
    });

    Route::resource('autores', AutorController::class)->parameters([
        'autores' => 'dni'
    ]);

    Route::get('/perfil', [PanelController::class, 'perfil'])->name('perfil');
    Route::get('/manual', [PanelController::class, 'manual'])->name('manual');
});
Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

require __DIR__ . '/auth.php';
