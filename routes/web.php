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
    Route::get('talento/experiencia', function () {return view('talento.experiencia');})->name('talento.experiencia');
    Route::get('talento/educacion', function () {return view('talento.educacion');})->name('talento.educacion');
    Route::get('talento/documentos', function () {return view('talento.documentos');})->name('talento.documentos');
    Route::get('talento/procesos', function () {return view('talento.procesos');})->name('talento.procesos');

    // Rutas para la empresa
    Route::get('empresa/dashboard', function () {return view('empresa.dashboard');})->name('empresa.dashboard');
    Route::get('empresa/perfil', function () {return view('empresa.perfil');})->name('empresa.perfil');
    Route::get('empresa/talentos', function () {return view('empresa.talentos');})->name('empresa.talentos');
    Route::get('empresa/procesos', function () {return view('empresa.procesos');})->name('empresa.procesos');
    Route::get('empresa/usuarios', function () {return view('empresa.usuarios');})->name('empresa.usuarios');
    Route::get('empresa/documentos', function () {return view('empresa.documentos');})->name('empresa.documentos');
    Route::get('empresa/configuracion', function () {return view('empresa.configuracion');})->name('empresa.configuracion');
});

require __DIR__ . '/auth.php';
