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

        $totales = [
            'pendiente'    => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'pendiente')->count(),
            'contactado'   => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'contactado')->count(),
            'entrevista'   => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'entrevista')->count(),
            'seleccionado' => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'seleccionado')->count(),
            'rechazado'    => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'rechazado')->count(),
        ];

        return view('empresa.procesos', compact('procesos', 'totales'));
    }
}
