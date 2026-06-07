<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use Illuminate\Http\Request;

class VitrinaController extends Controller
{
    public function index(Request $request)
    {
        $query = Talento::with(['competenciasTecnicas', 'idiomas', 'antecedentesEducacionales', 'user'])
            ->whereHas('user', fn($q) => $q->where('estado', 'activo'));

        if ($request->filled('carrera')) {
            $query->whereHas('antecedentesEducacionales', fn($q) => $q->where('titulo', 'LIKE', "%{$request->carrera}%"));
        }

        if ($request->filled('competencia')) {
            $query->whereHas('competenciasTecnicas', fn($q) => $q->where('nombre_competencia', 'LIKE', "%{$request->competencia}%"));
        }

        if ($request->filled('discapacidad')) {
            $query->where('discapacidad', 1);
        }

        if ($request->filled('modalidad')) {
            $query->where('condicion_modalidad', $request->modalidad);
        }

        if ($request->filled('jornada')) {
            $query->where('condicion_jornada', $request->jornada);
        }

        if ($request->filled('renta_max')) {
            $query->where('renta_desde', '<=', $request->renta_max);
        }

        $talentos = $query->paginate(12)->withQueryString();

        $empresas = DatosEmpresa::with('user')->whereHas('user', fn($q) => $q->where('estado', 'activo'))->get();

        return view('admin.vitrina', compact('talentos', 'empresas'));
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'talento_ids'      => 'required|array|min:1',
            'datos_empresa_id' => 'required|exists:datos_empresa,id',
        ], [
            'talento_ids.required' => 'Debes seleccionar al menos un talento.',
            'datos_empresa_id.required' => 'Debes seleccionar una empresa.',
        ]);

        $empresaId = $request->datos_empresa_id;
        $enviados  = 0;

        foreach ($request->talento_ids as $talentoId) {
            $existe = Interacciones::where('datos_empresa_id', $empresaId)
                ->where('talento_id', $talentoId)->exists();

            if (!$existe) {
                Interacciones::create([
                    'datos_empresa_id' => $empresaId,
                    'talento_id'       => $talentoId,
                    'estado'           => 'contactado',
                    'fecha_contacto'   => now(),
                    'notas'            => 'Enviado por el equipo ProviEmplea.',
                ]);
                $enviados++;
            }
        }

        return back()->with('success', "{$enviados} talento(s) enviado(s) a la empresa correctamente.");
    }
}
