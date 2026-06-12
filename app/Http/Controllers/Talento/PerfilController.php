<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Talento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetenciasTecnicas;
use App\Models\TalentoIdioma;
use App\Http\Controllers\Talento\IdiomasController;

class PerfilController extends Controller
{
    public const LISTA_COMPETENCIAS = [
        'Excel', 'Word', 'Power BI', 'SAP', 'ERP', 'CRM',
        'Trabajo en Equipo', 'Liderazgo', 'Comunicación',
    ];

    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();
        $talento->load(['user', 'antecedentesEducacionales', 'antecedentesLaborales', 'competenciasTecnicas', 'talentoArchivos']);

        $todasCompetencias = $talento->competenciasTecnicas->pluck('nombre_competencia')->toArray();

        $competencias = array_intersect($todasCompetencias, self::LISTA_COMPETENCIAS);
        $otras_competencias = implode(', ', array_diff($todasCompetencias, self::LISTA_COMPETENCIAS));
        $lista = self::LISTA_COMPETENCIAS;

        $idiomas       = TalentoIdioma::where('talento_id', $talento->id)->get();
        $listaIdiomas  = IdiomasController::LISTA_IDIOMAS;
        $nivelesIdiomas = IdiomasController::NIVELES;

        $completitud = $talento->porcentajeCompletitud();

        return view('talento.perfil', compact(
            'talento', 'competencias', 'otras_competencias', 'lista',
            'idiomas', 'listaIdiomas', 'nivelesIdiomas', 'completitud'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'edad' => 'nullable|integer|min:18|max:99',
            'telefono' => 'nullable|digits:8',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'nullable|in:Masculino,Femenino,No binario,No especificado',
            'resumen' => 'nullable|string|max:1000',
            'renta_desde' => 'nullable|numeric|min:0',
            'renta_hasta' => 'nullable|numeric|min:0',
            'condicion_jornada' => 'nullable|in:Full-Time,Part-Time,Freelance',
            'condicion_modalidad' => 'nullable|in:Presencial,Híbrido,Remoto',
        ]);

        // Usuario autenticado
        $user = User::find(Auth::id());

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Perfil talento
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        // Formatear teléfono
        $telefono = null;

        if ($request->filled('telefono')) {
            $telefono = '+569' . preg_replace('/[^0-9]/', '', $request->telefono);
        }

        $talento->update([
            'edad' => $request->edad,
            'telefono' => $telefono,
            'direccion' => $request->direccion,
            'genero' => $request->genero,
            'resumen' => $request->resumen ?? '',
            'renta_desde' => $request->renta_desde ?? 0,
            'renta_hasta' => $request->renta_hasta ?? 0,
            'condicion_jornada' => $request->condicion_jornada,
            'condicion_modalidad' => $request->condicion_modalidad,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
