<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Rutas para el administrador
    Route::get('admin/dashboard', function () {return view('admin.dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('admin/perfil', function () {return view('admin.perfil');})->name('admin.perfil');
    Route::get('admin/empresas', function () {return view('admin.empresas');})->name('admin.empresas');
    Route::get('admin/configuracion', function () {return view('admin.configuracion');})->name('admin.configuracion');
    Route::get('admin/talentos', function () {return view('admin.talentos');})->name('admin.talentos');
    Route::get('admin/validaciones', function () {return view('admin.validaciones');})->name('admin.validaciones');
    Route::get('admin/solicitudes', function () {return view('admin.solicitudes');})->name('admin.solicitudes');
    Route::get('admin/seguimiento', function () {return view('admin.seguimiento');})->name('admin.seguimiento');

    // Rutas para el talento
    Route::get('talento/dashboard', function () {return view('talento.dashboard');})->name('talento.dashboard');
    Route::get('talento/perfil', function () {return view('talento.perfil');})->name('talento.perfil');
    Route::get('talento/postulaciones', function () {return view('talento.postulaciones');})->name('talento.postulaciones');
    Route::get('talento/vacantes', function () {return view('talento.vacantes');})->name('talento.vacantes');
    Route::get('talento/configuracion', function () {return view('talento.configuracion');})->name('talento.configuracion');
    // Rutas para la empresa
     Route::get('empresa/dashboard', function () {return view('empresa.dashboard');})->name('empresa.dashboard');
});

require __DIR__ . '/auth.php';
