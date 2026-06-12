<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTalentos  = Talento::count();
        $totalEmpresas  = DatosEmpresa::count();
        $totalUsuarios  = User::count();
        $totalProcesos  = Interacciones::count();

        // Pendientes de validación (accionables)
        $talentosPendientes = Talento::where('validacion', false)->count();
        $empresasPendientes = DatosEmpresa::where('validacion', false)->count();

        // Procesos por estado
        $procesosPorEstado = [
            'pendiente'    => Interacciones::where('estado', 'pendiente')->count(),
            'contactado'   => Interacciones::where('estado', 'contactado')->count(),
            'entrevista'   => Interacciones::where('estado', 'entrevista')->count(),
            'seleccionado' => Interacciones::where('estado', 'seleccionado')->count(),
            'contratado'   => Interacciones::where('estado', 'contratado')->count(),
        ];

        $empresas = DatosEmpresa::with('user')->latest()->take(4)->get();
        $talentos = Talento::with('user')->latest()->take(4)->get();

        // Últimas solicitudes pendientes (para atención inmediata)
        $solicitudesPendientes = Interacciones::with(['datosEmpresa.user', 'talento.user'])
            ->where('estado', 'pendiente')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTalentos', 'totalEmpresas', 'totalUsuarios', 'totalProcesos',
            'talentosPendientes', 'empresasPendientes',
            'procesosPorEstado', 'empresas', 'talentos', 'solicitudesPendientes'
        ));
    }
}