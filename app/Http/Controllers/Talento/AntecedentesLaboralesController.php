<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\AntecedentesLaborales;
use App\Models\Talento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntecedentesLaboralesController extends Controller
{
    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        $experiencias = AntecedentesLaborales::where(
            'talento_id',
            $talento->id
        )->latest()->get();

        return view(
            'talento.experiencia',
            compact('experiencias')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institucion_o_empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'ingreso' => 'required|date',
            'egreso' => 'nullable|date|after_or_equal:ingreso',
            'funciones' => 'nullable|string|max:1000',
            'referencia_nombre' => 'nullable|string|max:100',
            'referencia_telefono' => 'nullable|digits:8',
            'referencia_correo' => 'nullable|email|max:255',
            'referencia_cargo' => 'nullable|string|max:255',
        ], []);
        if ($request->has('actualidad')) {
            $validated['egreso'] = null;
        }

        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        AntecedentesLaborales::create([
            'talento_id' => $talento->id,
            'institucion_o_empresa' => $validated['institucion_o_empresa'],
            'cargo' => $validated['cargo'],
            'ingreso' => $validated['ingreso'],
            'egreso' => $validated['egreso'] ?? null,
            'funciones' => $validated['funciones'] ?? null,
            'referencia_nombre' => $validated['referencia_nombre'] ?? null,
            'referencia_telefono' => !empty($validated['referencia_telefono']) ? '+569' . $validated['referencia_telefono'] : null,
            'referencia_correo' => $validated['referencia_correo'] ?? null,
            'referencia_cargo' => $validated['referencia_cargo'] ?? null,
        ]);

        return back()->with('success', 'Experiencia laboral agregada correctamente');
    }

    public function update(Request $request, int $id)
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();
        $experiencia = AntecedentesLaborales::where('id', $id)
            ->where('talento_id', $talento->id)
            ->firstOrFail();

        $validated = $request->validate([
            'institucion_o_empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'ingreso' => 'required|date',
            'egreso' => 'nullable|date|after_or_equal:ingreso',
            'funciones' => 'nullable|string|max:1000',
            'referencia_nombre' => 'nullable|string|max:100',
            'referencia_telefono' => 'nullable|digits:8',
            'referencia_correo' => 'nullable|email|max:255',
            'referencia_cargo' => 'nullable|string|max:255',
        ]);

        if ($request->has('actualidad')) {
            $validated['egreso'] = null;
        }

        $experiencia->update([
            'institucion_o_empresa' => $validated['institucion_o_empresa'],
            'cargo' => $validated['cargo'],
            'ingreso' => $validated['ingreso'],
            'egreso' => $validated['egreso'] ?? null,
            'funciones' => $validated['funciones'] ?? null,
            'referencia_nombre' => $validated['referencia_nombre'] ?? null,
            'referencia_telefono' => !empty($validated['referencia_telefono']) ? '+569' . preg_replace('/[^0-9]/', '', $validated['referencia_telefono']) : null,
            'referencia_correo' => $validated['referencia_correo'] ?? null,
            'referencia_cargo' => $validated['referencia_cargo'] ?? null,
        ]);

        return back()->with('success', 'Experiencia laboral actualizada correctamente');
    }

    public function destroy(int $id)
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();
        $experiencia = AntecedentesLaborales::where('id', $id)
            ->where('talento_id', $talento->id)
            ->firstOrFail();

        $experiencia->delete();

        return back()->with('success', 'Experiencia laboral eliminada correctamente');
    }
}
