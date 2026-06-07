<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())
            ->with('usuariosEmpresa')
            ->firstOrFail();

        $totales = [
            'solicitados'  => Interacciones::where('datos_empresa_id', $empresa->id)->count(),
            'activos'      => Interacciones::where('datos_empresa_id', $empresa->id)->whereIn('estado', ['contactado', 'entrevista'])->count(),
            'seleccionados'=> Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'seleccionado')->count(),
            'usuarios'     => $empresa->usuariosEmpresa->count(),
        ];

        $procesos = Interacciones::where('datos_empresa_id', $empresa->id)
            ->with(['talento.antecedentesEducacionales'])
            ->latest()
            ->take(5)
            ->get();

        return view('empresa.dashboard', compact('empresa', 'totales', 'procesos'));
    }
}
