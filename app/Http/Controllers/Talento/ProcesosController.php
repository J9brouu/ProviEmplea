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

        $conteos = Interacciones::where('talento_id', $talento->id)
            ->selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        $totales = [
            'pendiente'    => $conteos->get('pendiente', 0),
            'contactado'   => $conteos->get('contactado', 0),
            'entrevista'   => $conteos->get('entrevista', 0),
            'seleccionado' => $conteos->get('seleccionado', 0),
            'contratado'   => $conteos->get('contratado', 0),
            'rechazado'    => $conteos->get('rechazado', 0),
        ];

        return view('talento.procesos', compact('procesos', 'totales'));
    }
}
