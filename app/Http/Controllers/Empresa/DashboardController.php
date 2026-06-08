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
        $empresa = DatosEmpresa::with('usuariosEmpresa')
            ->firstOrCreate(
                ['user_id' => Auth::id()],
                [
                    'rut_empresa' => 'Pendiente',
                    'rubro_empresa' => 'No especificado',
                    'tipo_empresa' => 'Pyme',
                    'presentacion_empresa' => 'Empresa registrada sin datos.',
                    'beneficios_empresa' => 'Beneficios por definir.',
                    'validacion' => 0,
                ]
            );

        $totales = [
            'solicitados'  => Interacciones::where('datos_empresa_id', $empresa->id)->count(),
            'activos'      => Interacciones::where('datos_empresa_id', $empresa->id)->whereIn('estado', ['contactado', 'entrevista'])->count(),
            'seleccionados'=> Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'seleccionado')->count(),
            'usuarios'     => $empresa->usuariosEmpresa()
                ->whereHas('user', fn ($q) => $q->where('estado', '!=', 'desactivado'))
                ->count(),
        ];

        $procesos = Interacciones::where('datos_empresa_id', $empresa->id)
            ->with(['talento.antecedentesEducacionales'])
            ->latest()
            ->take(5)
            ->get();

        return view('empresa.dashboard', compact('empresa', 'totales', 'procesos'));
    }
}
