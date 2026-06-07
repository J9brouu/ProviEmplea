<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Talento\PerfilController;
use App\Http\Controllers\Controller;
use App\Models\CompetenciasTecnica;
use App\Models\CompetenciasTecnicas;
use App\Models\Talento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompetenciasController extends Controller
{
    public function index()
    {
        $talento = Talento::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $competencias = CompetenciasTecnicas::where(
            'talento_id',
            $talento->id
        )->get();

        return view(
            'talento.competencias',
            compact('competencias')
        );
    }

    public function store(Request $request)
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        CompetenciasTecnicas::where('talento_id', $talento->id)->delete();

        $competencias = $request->competencias ?? [];

        if ($request->filled('otras_competencias')) {
            $extras = array_map('trim', explode(',', $request->otras_competencias));
            $competencias = array_merge($competencias, array_filter($extras));
        }

        foreach ($competencias as $competencia) {
            CompetenciasTecnicas::create([
                'talento_id' => $talento->id,
                'nombre_competencia' => $competencia,
            ]);
        }

        return back()->with('success', 'Competencias actualizadas');
    }
}