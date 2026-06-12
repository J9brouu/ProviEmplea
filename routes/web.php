<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TalentosController;
use App\Http\Controllers\Admin\EmpresasController;
use App\Http\Controllers\Admin\VitrinaController as AdminVitrinaController;
use App\Http\Controllers\Admin\SolicitudesController;
use App\Http\Controllers\Admin\ValidacionesController;
use App\Http\Controllers\Admin\PerfilController as AdminPerfilController;
use App\Http\Controllers\Admin\ExportController as AdminExportController;
use App\Http\Controllers\Admin\ConfiguracionController as AdminConfiguracionController;
use App\Http\Controllers\Talento\DashboardController as TalentoDashboardController;
use App\Http\Controllers\Talento\PerfilController as TalentoPerfilController;
use App\Http\Controllers\Talento\IdiomasController;
use App\Http\Controllers\Talento\ProcesosController;
use App\Http\Controllers\Talento\PerfeccionamientoController;
use App\Http\Controllers\Talento\AntecedentesEducacionalesController;
use App\Http\Controllers\Talento\AntecedentesLaboralesController;
use App\Http\Controllers\Talento\CompetenciasController;
use App\Http\Controllers\Talento\DocumentosController;
use App\Http\Controllers\Talento\CvController;
use App\Http\Controllers\Auth\TalentoRegisterController;
use App\Http\Controllers\Auth\EmpresaRegisterController;
use App\Http\Controllers\Empresa\TalentosController as EmpresaTalentosController;
use App\Http\Controllers\Empresa\ProcesosController as EmpresaProcesosController;
use App\Http\Controllers\Empresa\DashboardController as EmpresaDashboardController;
use App\Http\Controllers\Empresa\PerfilController as EmpresaPerfilController;
use App\Http\Controllers\Empresa\UsuariosController as EmpresaUsuariosController;
use App\Http\Controllers\Empresa\DocumentosController as EmpresaDocumentosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verificacion/estado', function () {
    if (!auth()->check()) {
        return response()->json(['verified' => false]);
    }
    $user = auth()->user();
    if (!$user->hasVerifiedEmail()) {
        return response()->json(['verified' => false]);
    }
    $redirect = match($user->rol) {
        'admin'   => route('admin.dashboard'),
        'empresa' => route('empresa.dashboard'),
        default   => route('talento.dashboard'),
    };
    return response()->json(['verified' => true, 'redirect' => $redirect]);
})->middleware('auth');

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
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/perfil', [AdminPerfilController::class, 'index'])->name('admin.perfil');
    Route::put('admin/perfil/update', [AdminPerfilController::class, 'update'])->name('admin.perfil.update');
    Route::put('admin/perfil/password', [AdminPerfilController::class, 'password'])->name('admin.perfil.password');
    Route::get('admin/empresas', [EmpresasController::class, 'index'])->name('admin.empresas');
    Route::put('admin/empresas/{id}', [EmpresasController::class, 'update'])->name('admin.empresas.update');
    Route::get('admin/configuracion', [AdminConfiguracionController::class, 'index'])->name('admin.configuracion');
    Route::post('admin/configuracion/usuarios', [AdminConfiguracionController::class, 'storeAdmin'])->name('admin.configuracion.usuarios.store');
    Route::put('admin/configuracion/usuarios/{id}/toggle', [AdminConfiguracionController::class, 'toggleAdmin'])->name('admin.configuracion.usuarios.toggle');
    Route::get('admin/talentos', [TalentosController::class, 'index'])->name('admin.talentos');
    Route::get('admin/vitrina', [AdminVitrinaController::class, 'index'])->name('admin.vitrina');
    Route::post('admin/vitrina/enviar', [AdminVitrinaController::class, 'enviar'])->name('admin.vitrina.enviar');
    Route::put('/admin/talentos/{id}', [TalentosController::class, 'update'])->name('admin.talentos.update');
    Route::get('admin/validaciones', [ValidacionesController::class, 'index'])->name('admin.validaciones');
    Route::put('admin/validaciones/talento/{id}/aprobar', [ValidacionesController::class, 'aprobarTalento'])->name('admin.validaciones.talento.aprobar');
    Route::put('admin/validaciones/talento/{id}/rechazar', [ValidacionesController::class, 'rechazarTalento'])->name('admin.validaciones.talento.rechazar');
    Route::put('admin/validaciones/archivo/{id}/aprobar', [ValidacionesController::class, 'aprobarArchivo'])->name('admin.validaciones.archivo.aprobar');
    Route::put('admin/validaciones/archivo/{id}/rechazar', [ValidacionesController::class, 'rechazarArchivo'])->name('admin.validaciones.archivo.rechazar');
    Route::put('admin/validaciones/empresa/{id}/aprobar', [ValidacionesController::class, 'aprobarEmpresa'])->name('admin.validaciones.empresa.aprobar');
    Route::put('admin/validaciones/empresa/{id}/rechazar', [ValidacionesController::class, 'rechazarEmpresa'])->name('admin.validaciones.empresa.rechazar');
    Route::put('admin/validaciones/archivo-empresa/{id}/aprobar', [ValidacionesController::class, 'aprobarArchivoEmpresa'])->name('admin.validaciones.archivo-empresa.aprobar');
    Route::put('admin/validaciones/archivo-empresa/{id}/rechazar', [ValidacionesController::class, 'rechazarArchivoEmpresa'])->name('admin.validaciones.archivo-empresa.rechazar');
    Route::get('admin/solicitudes', [SolicitudesController::class, 'index'])->name('admin.solicitudes');
    Route::put('admin/solicitudes/{id}/nota', [SolicitudesController::class, 'nota'])->name('admin.solicitudes.nota');
    Route::put('admin/solicitudes/{id}/aprobar', [SolicitudesController::class, 'aprobar'])->name('admin.solicitudes.aprobar');
    Route::put('admin/solicitudes/{id}/rechazar', [SolicitudesController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
    Route::put('admin/solicitudes/{id}/contactar', [SolicitudesController::class, 'contactar'])->name('admin.solicitudes.contactar');
    Route::put('admin/solicitudes/{id}/entrevista', [SolicitudesController::class, 'entrevista'])->name('admin.solicitudes.entrevista');
    Route::put('admin/solicitudes/{id}/seleccionado', [SolicitudesController::class, 'seleccionado'])->name('admin.solicitudes.seleccionado');
    Route::put('admin/solicitudes/{id}/contratar', [SolicitudesController::class, 'contratar'])->name('admin.solicitudes.contratar');
    Route::get('admin/solicitudes/pdf', [SolicitudesController::class, 'pdf'])->name('admin.solicitudes.pdf');
    Route::get('admin/export/talentos', [AdminExportController::class, 'talentos'])->name('admin.export.talentos');
    Route::get('admin/export/empresas', [AdminExportController::class, 'empresas'])->name('admin.export.empresas');
    Route::get('admin/export/procesos', [AdminExportController::class, 'procesos'])->name('admin.export.procesos');
    Route::post('admin/talentos/cvs/zip', [AdminExportController::class, 'cvsBulk'])->name('admin.talentos.cvs.zip');
});

// Rutas para el Talento
Route::middleware(['auth', 'verified', 'role:talento'])->group(function () {
    Route::get('talento/dashboard', [TalentoDashboardController::class, 'index'])->name('talento.dashboard');
    Route::get('talento/perfil', [TalentoPerfilController::class, 'index'])->name('talento.perfil');
    Route::put('/talento/perfil', [TalentoPerfilController::class, 'update'])->name('talento.perfil.update');
    Route::post('/talento/competencias', [CompetenciasController::class, 'store'])->name('talento.competencias.store');
    Route::delete('/talento/competencias/{id}', [CompetenciasController::class, 'destroy'])->name('talento.competencias.destroy');
    Route::post('/talento/idiomas', [IdiomasController::class, 'store'])->name('talento.idiomas.store');
    Route::get('/talento/experiencia', [AntecedentesLaboralesController::class, 'index'])->name('talento.experiencia');
    Route::post('/talento/experiencia', [AntecedentesLaboralesController::class, 'store'])->name('talento.experiencia.store');
    Route::put('/talento/experiencia/{id}', [AntecedentesLaboralesController::class, 'update'])->name('talento.experiencia.update');
    Route::delete('/talento/experiencia/{id}', [AntecedentesLaboralesController::class, 'destroy'])->name('talento.experiencia.destroy');
    Route::get('talento/educacion', [AntecedentesEducacionalesController::class, 'index'])->name('talento.educacion');
    Route::post('/talento/educacion', [AntecedentesEducacionalesController::class, 'store'])->name('talento.educacion.store');
    Route::put('/talento/educacion/{id}', [AntecedentesEducacionalesController::class, 'updateEducacion'])->name('talento.educacion.update');
    Route::put('/talento/educacion/curso/{id}', [AntecedentesEducacionalesController::class, 'updateCurso'])->name('talento.educacion.curso.update');
    Route::delete('/talento/educacion/{id}', [AntecedentesEducacionalesController::class, 'destroy'])->name('talento.educacion.destroy');
    Route::delete('/talento/educacion/curso/{id}', [AntecedentesEducacionalesController::class, 'destroyCurso'])->name('talento.educacion.curso.destroy');
    Route::get('talento/documentos', [DocumentosController::class, 'index'])->name('talento.documentos');
    Route::post('talento/documentos', [DocumentosController::class, 'store'])->name('talento.documentos.store');
    Route::delete('talento/documentos/{id}', [DocumentosController::class, 'destroy'])->name('talento.documentos.destroy');
    Route::get('talento/archivos/{id}', [DocumentosController::class, 'ver'])->name('archivos.talento');
    Route::get('talento/procesos', [ProcesosController::class, 'index'])->name('talento.procesos');
    Route::get('talento/cv/descargar', [CvController::class, 'descargar'])->name('talento.cv.descargar');
});

// Rutas para la Empresa
Route::middleware(['auth', 'verified', 'role:empresa'])->group(function () {
    Route::get('empresa/dashboard', [EmpresaDashboardController::class, 'index'])->name('empresa.dashboard');
    Route::get('empresa/perfil', [EmpresaPerfilController::class, 'index'])->name('empresa.perfil');
    Route::put('empresa/perfil', [EmpresaPerfilController::class, 'update'])->name('empresa.perfil.update');
    Route::put('empresa/perfil/password', [EmpresaPerfilController::class, 'password'])->name('empresa.perfil.password');
    Route::get('empresa/talentos', [EmpresaTalentosController::class, 'index'])->name('empresa.talentos');
    Route::post('empresa/talentos/solicitar', [EmpresaTalentosController::class, 'solicitar'])->name('empresa.talentos.solicitar');
    Route::get('empresa/procesos', [EmpresaProcesosController::class, 'index'])->name('empresa.procesos');
    Route::get('empresa/antecedentes', [EmpresaProcesosController::class, 'antecedentes'])->name('empresa.antecedentes');
    Route::get('empresa/usuarios', [EmpresaUsuariosController::class, 'index'])->name('empresa.usuarios');
    Route::post('empresa/usuarios', [EmpresaUsuariosController::class, 'store'])->name('empresa.usuarios.store');
    Route::delete('empresa/usuarios/{id}', [EmpresaUsuariosController::class, 'destroy'])->name('empresa.usuarios.destroy');
    Route::get('empresa/documentos', [EmpresaDocumentosController::class, 'index'])->name('empresa.documentos');
    Route::post('empresa/documentos', [EmpresaDocumentosController::class, 'store'])->name('empresa.documentos.store');
    Route::delete('empresa/documentos/{id}', [EmpresaDocumentosController::class, 'destroy'])->name('empresa.documentos.destroy');
});

require __DIR__ . '/auth.php';
