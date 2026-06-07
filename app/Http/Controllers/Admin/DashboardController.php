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

        $empresas = DatosEmpresa::with('user')->latest()->take(4)->get();
        $talentos = Talento::with('user')->latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalTalentos', 'totalEmpresas', 'totalUsuarios',
            'totalPostulaciones', 'empresas', 'talentos'
        ));
    }
}