<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Interacciones;
use App\Models\Talento;
use Illuminate\Support\Facades\Auth;

class ProcesosController extends Controller
{
    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        $procesos = Interacciones::where('talento_id', $talento->id)
            ->with('datosEmpresa.user')
            ->latest()
            ->paginate(10);

        $totales = [
            'pendiente'    => Interacciones::where('talento_id', $talento->id)->where('estado', 'pendiente')->count(),
            'contactado'   => Interacciones::where('talento_id', $talento->id)->where('estado', 'contactado')->count(),
            'entrevista'   => Interacciones::where('talento_id', $talento->id)->where('estado', 'entrevista')->count(),
            'seleccionado' => Interacciones::where('talento_id', $talento->id)->where('estado', 'seleccionado')->count(),
            'contratado'   => Interacciones::where('talento_id', $talento->id)->where('estado', 'contratado')->count(),
            'rechazado'    => Interacciones::where('talento_id', $talento->id)->where('estado', 'rechazado')->count(),
        ];

        return view('talento.procesos', compact('procesos', 'totales'));
    }
}
