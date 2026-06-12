<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesosController extends Controller
{
    public function index()
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $procesos = Interacciones::where('datos_empresa_id', $empresa->id)
            ->with(['talento.competenciasTecnicas', 'talento.antecedentesEducacionales'])
            ->latest()
            ->paginate(10);

        $totales = [
            'pendiente'    => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'pendiente')->count(),
            'contactado'   => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'contactado')->count(),
            'entrevista'   => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'entrevista')->count(),
            'seleccionado' => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'seleccionado')->count(),
            'rechazado'    => Interacciones::where('datos_empresa_id', $empresa->id)->where('estado', 'rechazado')->count(),
        ];

        return view('empresa.procesos', compact('procesos', 'totales'));
    }

    public function antecedentes(Request $request)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $antecedentes = Interacciones::where('datos_empresa_id', $empresa->id)
            ->where('notas', 'Enviado por el equipo ProviEmplea.')
            ->with([
                'talento.user',
                'talento.antecedentesEducacionales',
                'talento.antecedentesLaborales',
                'talento.competenciasTecnicas',
                'talento.idiomas',
            ])
            ->when($request->filled('estado'), fn ($q) =>
                $q->where('estado', $request->estado)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('empresa.antecedentes', compact('antecedentes'));
    }
}
