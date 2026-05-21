<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Rutas para el administrador
    Route::view('/perfil', 'admin.perfil')->name('perfil');
    Route::view('/empresas', 'admin.empresas')->name('empresas');
    Route::view('/postulaciones', 'admin.postulaciones')->name('postulaciones');
    Route::view('/configuracion', 'admin.configuracion')->name('configuracion');
    Route::view('/talentos', 'admin.talentos')->name('talentos');

    // Rutas para el talento
    Route::view('/talento/dashboard', 'talento.dashboard')->name('talento.dashboard');
    // Rutas para la empresa
     Route::view('/empresa/dashboard', 'empresa.dashboard')->name('empresa.dashboard');
});

require __DIR__ . '/auth.php';
