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
        $totalTalentos = Talento::count();
        $totalEmpresas = DatosEmpresa::count();
        $totalUsuarios = User::count();
        $totalPostulaciones = Interacciones::count();

        $empresas = DatosEmpresa::with('user')
            ->whereHas('user', fn ($q) => $q->where('estado', '!=', 'desactivado'))
            ->latest()
            ->take(4)
            ->get();

        $talentos = Talento::with('user')
            ->whereHas('user', fn ($q) => $q->where('estado', '!=', 'desactivado'))
            ->latest()
            ->take(4)
            ->get();

        $admins = User::where('rol', 'admin')
            ->where('estado', '!=', 'desactivado')
            ->latest()
            ->get();

        $disabledUsers = User::where('estado', 'desactivado')->latest()->get();

        return view('admin.dashboard', compact(
            'totalTalentos', 'totalEmpresas', 'totalUsuarios',
            'totalPostulaciones', 'empresas', 'talentos', 'admins', 'disabledUsers'
        ));
    }
}