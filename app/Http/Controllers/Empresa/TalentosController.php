<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use App\Models\Talento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TalentosController extends Controller
{
    public function index(Request $request)
    {
        $query = Talento::with(['competenciasTecnicas', 'idiomas', 'antecedentesEducacionales', 'antecedentesLaborales', 'perfeccionamientos'])
            ->whereHas('user', fn($q) => $q->where('estado', 'activo'))
            ->whereDoesntHave('interacciones', fn($q) => $q->whereIn('estado', ['seleccionado', 'contratado']));

        if ($request->filled('nivel_educacional')) {
            $query->whereHas('antecedentesEducacionales', fn($q) => $q->where('titulo', 'LIKE', "%{$request->nivel_educacional}%"));
        }

        if ($request->filled('carrera')) {
            $query->whereHas('antecedentesEducacionales', fn($q) => $q->where('titulo', 'LIKE', "%{$request->carrera}%"));
        }

        if ($request->filled('modalidad')) {
            $query->where('condicion_modalidad', $request->modalidad);
        }

        if ($request->filled('jornada')) {
            $query->where('condicion_jornada', $request->jornada);
        }

        if ($request->filled('discapacidad')) {
            $query->where('discapacidad', 1);
        }

        if ($request->filled('renta_max')) {
            $query->where('renta_desde', '<=', $request->renta_max);
        }

        if ($request->filled('competencia')) {
            $query->whereHas('competenciasTecnicas', fn($q) => $q->where('nombre_competencia', 'LIKE', "%{$request->competencia}%"));
        }

        if ($request->filled('idioma')) {
            $query->whereHas('idiomas', fn($q) => $q->where('nombre_idioma', $request->idioma));
        }

        $talentos = $query->paginate(9)->withQueryString();

        // Obtener empresa logueada
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        // IDs de talentos ya solicitados por esta empresa
        $solicitados = Interacciones::where('datos_empresa_id', $empresa->id)
            ->pluck('talento_id')->toArray();

        return view('empresa.talentos', compact('talentos', 'solicitados'));
    }

    public function solicitar(Request $request)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $ids = $request->input('talentos', []);

        foreach ($ids as $talento_id) {
            // Evitar duplicados
            $existe = Interacciones::where('datos_empresa_id', $empresa->id)
                ->where('talento_id', $talento_id)->exists();

            if (!$existe) {
                Interacciones::create([
                    'datos_empresa_id' => $empresa->id,
                    'talento_id'       => $talento_id,
                    'estado'           => 'pendiente',
                    'fecha_contacto'   => now(),
                ]);
            }
        }

        return back()->with('success', 'Solicitud enviada al equipo de ProviEmplea.');
    }
}
