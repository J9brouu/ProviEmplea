<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Interacciones;
use App\Models\Talento;
use App\Models\TalentoArchivo;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->first();

        $procesos = collect();
        $totales  = ['contactado' => 0, 'entrevista' => 0, 'seleccionado' => 0, 'rechazado' => 0];
        $documentos = collect();

        $completitud = 0;

        if ($talento) {
            $talento->load(['user', 'antecedentesEducacionales', 'antecedentesLaborales', 'competenciasTecnicas', 'talentoArchivos']);

            $procesos = Interacciones::where('talento_id', $talento->id)
                ->with('datosEmpresa.user')
                ->latest()
                ->take(5)
                ->get();

            foreach (array_keys($totales) as $estado) {
                $totales[$estado] = Interacciones::where('talento_id', $talento->id)
                    ->where('estado', $estado)->count();
            }

            $documentos  = TalentoArchivo::where('talento_id', $talento->id)->latest()->get();
            $completitud = $talento->porcentajeCompletitud();
        }

        return view('talento.dashboard', compact('talento', 'procesos', 'totales', 'documentos', 'completitud'));
    }
}
