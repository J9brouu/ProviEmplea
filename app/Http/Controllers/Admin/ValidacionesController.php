<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use App\Models\TalentoArchivo;
use App\Models\ArchivoEmpresa;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;

class ValidacionesController extends Controller
{
    public function index()
    {
        $talentos = Talento::with(['user', 'talentoArchivos'])
            ->where(function ($q) {
                $q->whereHas('user', fn($q2) => $q2->where('estado', 'pendiente'))
                  ->orWhereHas('talentoArchivos', fn($q2) => $q2->where('estado', 'pendiente'));
            })
            ->paginate(10, ['*'], 'talentos_page');

        $empresas = DatosEmpresa::with(['user', 'archivosEmpresa'])
            ->where(function ($q) {
                $q->whereHas('user', fn($q2) => $q2->where('estado', 'pendiente'))
                  ->orWhereHas('archivosEmpresa', fn($q2) => $q2->where('estado', 'pendiente'));
            })
            ->paginate(10, ['*'], 'empresas_page');

        return view('admin.validaciones', compact('talentos', 'empresas'));
    }

    // APROBAR ARCHIVO
    public function aprobarArchivo($id)
    {
        $archivo = TalentoArchivo::findOrFail($id);
        $archivo->update(['estado' => 'aprobado', 'motivo_rechazo' => null]);

        // Si es certificado de discapacidad, activar el campo en el talento
        if ($archivo->tipo_archivo === 'discapacidad') {
            $archivo->talento->update(['discapacidad' => 1]);
        }

        return back()->with('success', 'Documento aprobado.');
    }

    // RECHAZAR ARCHIVO
    public function rechazarArchivo(Request $request, $id)
    {
        $request->validate(['motivo' => 'required|string|max:500']);
        $archivo = TalentoArchivo::findOrFail($id);
        $archivo->update(['estado' => 'rechazado', 'motivo_rechazo' => $request->motivo]);

        // Si es certificado de discapacidad rechazado, limpiar el campo
        if ($archivo->tipo_archivo === 'discapacidad') {
            $archivo->talento->update(['discapacidad' => 0]);
        }

        return back()->with('success', 'Documento rechazado.');
    }

    // APROBAR TALENTO COMPLETO
    public function aprobarTalento($id)
    {
        Talento::findOrFail($id)->user->update(['estado' => 'activo']);
        return back()->with('success', 'Talento aprobado.');
    }

    // RECHAZAR TALENTO COMPLETO
    public function rechazarTalento($id)
    {
        Talento::findOrFail($id)->user->update(['estado' => 'rechazado']);
        return back()->with('success', 'Talento rechazado.');
    }

    // APROBAR EMPRESA
    public function aprobarEmpresa($id)
    {
        DatosEmpresa::findOrFail($id)->user->update(['estado' => 'activo']);
        return back()->with('success', 'Empresa aprobada.');
    }

    // RECHAZAR EMPRESA
    public function rechazarEmpresa($id)
    {
        DatosEmpresa::findOrFail($id)->user->update(['estado' => 'rechazado']);
        return back()->with('success', 'Empresa rechazada.');
    }

    // APROBAR DOCUMENTO EMPRESA
    public function aprobarArchivoEmpresa($id)
    {
        ArchivoEmpresa::findOrFail($id)->update(['estado' => 'aprobado', 'motivo_rechazo' => null]);
        return back()->with('success', 'Documento aprobado.');
    }

    // RECHAZAR DOCUMENTO EMPRESA
    public function rechazarArchivoEmpresa(Request $request, $id)
    {
        $request->validate(['motivo' => 'required|string|max:500']);
        ArchivoEmpresa::findOrFail($id)->update(['estado' => 'rechazado', 'motivo_rechazo' => $request->motivo]);
        return back()->with('success', 'Documento rechazado.');
    }
}
