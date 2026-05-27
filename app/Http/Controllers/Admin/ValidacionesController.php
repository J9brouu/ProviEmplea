<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use App\Models\DatosEmpresa;
use App\Models\User;
use Illuminate\Http\Request;

class ValidacionesController extends Controller
{
    public function index()
    {
        // TALENTOS PENDIENTES
        $talentos = Talento::with('user')
            ->whereHas('user', function ($q) {
                $q->where('estado', 'pendiente');
            })
            ->paginate(5);

        // EMPRESAS PENDIENTES
        $empresas = DatosEmpresa::with('user')
            ->whereHas('user', function ($q) {
                $q->where('estado', 'pendiente');
            })
            ->paginate(5);

        return view('admin.validaciones', compact(
            'talentos',
            'empresas'
        ));
    }

    // VALIDAR TALENTO
    public function aprobarTalento($id)
    {
        $talento = Talento::findOrFail($id);

        $talento->user->update([
            'estado' => 'activo'
        ]);

        return back()->with('success', 'Talento aprobado');
    }

    // RECHAZAR TALENTO
    public function rechazarTalento($id)
    {
        $talento = Talento::findOrFail($id);

        $talento->user->update([
            'estado' => 'rechazado'
        ]);

        return back()->with('success', 'Talento rechazado');
    }

    // APROBAR EMPRESA
    public function aprobarEmpresa($id)
    {
        $empresa = DatosEmpresa::findOrFail($id);

        $empresa->user->update([
            'estado' => 'activo'
        ]);

        return back()->with('success', 'Empresa aprobada');
    }

    // RECHAZAR EMPRESA
    public function rechazarEmpresa($id)
    {
        $empresa = DatosEmpresa::findOrFail($id);

        $empresa->user->update([
            'estado' => 'rechazado'
        ]);

        return back()->with('success', 'Empresa rechazada');
    }
}