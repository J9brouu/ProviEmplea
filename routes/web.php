<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TalentosController;
use App\Http\Controllers\Admin\EmpresasController;
use App\Http\Controllers\Admin\SolicitudesController;
use App\Http\Controllers\Admin\ValidacionesController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Auth\TalentoRegisterController;
use App\Http\Controllers\Auth\EmpresaRegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Registros
Route::get('/registro/talento', [TalentoRegisterController::class, 'create'])->name('registro.talento');
Route::post('/registro/talento', [TalentoRegisterController::class, 'store'])->name('registro.talento.store');
Route::get('/registro/empresa', [EmpresaRegisterController::class, 'create'])->name('registro.empresa');
Route::post('/registro/empresa', [EmpresaRegisterController::class, 'store'])->name('registro.empresa.store');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para el Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/perfil', [PerfilController::class, 'index'])->name('admin.perfil');
    Route::put('admin/perfil/update', [PerfilController::class, 'update'])->name('admin.perfil.update');
    Route::put('admin/perfil/password', [PerfilController::class, 'password'])->name('admin.perfil.password');
    Route::get('admin/empresas', [EmpresasController::class, 'index'])->name('admin.empresas');
    Route::put('admin/empresas/{id}', [EmpresasController::class, 'update'])->name('admin.empresas.update');
    Route::get('admin/configuracion', function () {return view('admin.configuracion');})->name('admin.configuracion');
    Route::get('admin/talentos', [TalentosController::class, 'index'])->name('admin.talentos');
    Route::put('/admin/talentos/{id}',[TalentosController::class, 'update'])->name('admin.talentos.update');
    Route::get('admin/validaciones', [ValidacionesController::class, 'index'])->name('admin.validaciones');
// TALENTOS
    Route::put('admin/validaciones/talento/{id}/aprobar', [ValidacionesController::class, 'aprobarTalento'])->name('admin.validaciones.talento.aprobar');
    Route::put('admin/validaciones/talento/{id}/rechazar', [ValidacionesController::class, 'rechazarTalento'])->name('admin.validaciones.talento.rechazar');
// EMPRESAS
    Route::put('admin/validaciones/empresa/{id}/aprobar', [ValidacionesController::class, 'aprobarEmpresa'])->name('admin.validaciones.empresa.aprobar');
    Route::put('admin/validaciones/empresa/{id}/rechazar',[ValidacionesController::class, 'rechazarEmpresa'])->name('admin.validaciones.empresa.rechazar');
    Route::get('admin/solicitudes', [SolicitudesController::class, 'index'])->name('admin.solicitudes');
    Route::put('admin/solicitudes/{id}/aprobar', [SolicitudesController::class, 'aprobar'])->name('admin.solicitudes.aprobar');
    Route::put('admin/solicitudes/{id}/rechazar', [SolicitudesController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
    Route::put('admin/solicitudes/{id}/contactar', [SolicitudesController::class, 'contactar'])->name('admin.solicitudes.contactar');
    Route::put('admin/solicitudes/{id}/entrevista', [SolicitudesController::class, 'entrevista'])->name('admin.solicitudes.entrevista');
    Route::put('admin/solicitudes/{id}/seleccionado',[SolicitudesController::class, 'seleccionado'])->name('admin.solicitudes.seleccionado');
    Route::put('admin/solicitudes/{id}/rechazar', [SolicitudesController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
    Route::get('admin/solicitudes/pdf', [SolicitudesController::class, 'pdf'])->name('admin.solicitudes.pdf');
});
// Rutas para el talento
Route::middleware(['auth', 'role:talento'])->group(function () {
    Route::get('talento/dashboard', function () {return view('talento.dashboard');})->name('talento.dashboard');
    Route::get('talento/perfil', function () {return view('talento.perfil');})->name('talento.perfil');
    Route::get('talento/experiencia', function () {return view('talento.experiencia');})->name('talento.experiencia');
    Route::get('talento/educacion', function () {return view('talento.educacion');})->name('talento.educacion');
    Route::get('talento/documentos', function () {return view('talento.documentos');})->name('talento.documentos');
    Route::get('talento/procesos', function () {return view('talento.procesos');})->name('talento.procesos');
});

// Rutas para la empresa
Route::middleware(['auth', 'role:empresa'])->group(function () {
    Route::get('empresa/dashboard', function () {return view('empresa.dashboard');})->name('empresa.dashboard');
    Route::get('empresa/perfil', function () {return view('empresa.perfil');})->name('empresa.perfil');
    Route::get('empresa/talentos', function () {return view('empresa.talentos');})->name('empresa.talentos');
    Route::get('empresa/procesos', function () {return view('empresa.procesos');})->name('empresa.procesos');
    Route::get('empresa/usuarios', function () {return view('empresa.usuarios');})->name('empresa.usuarios');
    Route::get('empresa/documentos', function () {return view('empresa.documentos');})->name('empresa.documentos');
    Route::get('empresa/configuracion', function () {return view('empresa.configuracion');})->name('empresa.configuracion');
});

require __DIR__ . '/auth.php';
