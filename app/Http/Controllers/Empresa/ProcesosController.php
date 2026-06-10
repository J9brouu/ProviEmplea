<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesosController extends Controller
{
    public function index(Request $request)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $query = Interacciones::where('datos_empresa_id', $empresa->id)
            ->with(['talento.competenciasTecnicas', 'talento.antecedentesEducacionales'])
            ->latest();

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $procesos = $query->paginate(10)->withQueryString();

        $conteos = Interacciones::where('datos_empresa_id', $empresa->id)
            ->selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        $totales = [
            'pendiente'    => $conteos->get('pendiente', 0),
            'contactado'   => $conteos->get('contactado', 0),
            'entrevista'   => $conteos->get('entrevista', 0),
            'seleccionado' => $conteos->get('seleccionado', 0),
            'rechazado'    => $conteos->get('rechazado', 0),
        ];

        return view('empresa.procesos', compact('procesos', 'totales'));
    }
}
