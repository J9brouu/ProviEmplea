<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Perfeccionamiento;
use App\Models\Talento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfeccionamientoController extends Controller
{
    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->first();

        $perfeccionamientos = Perfeccionamiento::where(
            'talento_id',
            $talento->id
        )->latest()->get();

        return view(
            'talento.experiencia',
            compact('perfeccionamientos')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:Full-Time,Part-Time,Freelance,Contrata',
            'institucion' => 'required|string|max:100|min:3',
            'nombre_curso' => 'required|string|max:100|min:3',
            'ingreso' => 'required|date|before_or_equal:today',
            'egreso' => 'nullable|date|after_or_equal:ingreso',
            'perfeccionamiento_descripcion' => 'nullable|string|max:500',
        ], [
            'tipo.required' => 'El tipo de contrato es requerido',
            'tipo.in' => 'El tipo de contrato no es válido',
            'institucion.required' => 'La empresa es requerida',
            'institucion.min' => 'La empresa debe tener al menos 3 caracteres',
            'institucion.max' => 'La empresa no puede exceder 100 caracteres',
            'nombre_curso.required' => 'El cargo es requerido',
            'nombre_curso.min' => 'El cargo debe tener al menos 3 caracteres',
            'nombre_curso.max' => 'El cargo no puede exceder 100 caracteres',
            'ingreso.required' => 'La fecha de inicio es requerida',
            'ingreso.before_or_equal' => 'La fecha de inicio no puede ser en el futuro',
            'egreso.after_or_equal' => 'La fecha de término debe ser igual o posterior a la fecha de inicio',
            'egreso.before_or_equal' => 'La fecha de término no puede ser en el futuro',
            'perfeccionamiento_descripcion.max' => 'La descripción no puede exceder 500 caracteres',
        ]);

        try {
            $talento = Talento::where('user_id', Auth::id())->first();

            Perfeccionamiento::create([
                'talento_id' => $talento->id,
                'tipo' => $validated['tipo'],
                'institucion' => trim($validated['institucion']),
                'nombre_curso' => trim($validated['nombre_curso']),
                'ingreso' => $validated['ingreso'],
                'egreso' => $validated['egreso'] ?? null,
            ]);

            return back()->with('success', '✓ Experiencia laboral agregada correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $perfeccionamiento = Perfeccionamiento::findOrFail($id);
        
        if ($perfeccionamiento->talento->user_id !== Auth::id()) {
            return back()->withErrors(['error' => 'No tienes permiso para actualizar esta experiencia']);
        }

        $validated = $request->validate([
            'tipo' => 'required|in:Full-Time,Part-Time,Freelance,Contrata',
            'institucion' => 'required|string|max:100|min:3',
            'nombre_curso' => 'required|string|max:100|min:3',
            'ingreso' => 'required|date|before_or_equal:today',
            'egreso' => 'nullable|date|after_or_equal:ingreso',
        ], [
            'tipo.required' => 'El tipo de contrato es requerido',
            'tipo.in' => 'El tipo de contrato no es válido',
            'institucion.required' => 'La empresa es requerida',
            'institucion.min' => 'La empresa debe tener al menos 3 caracteres',
            'institucion.max' => 'La empresa no puede exceder 100 caracteres',
            'nombre_curso.required' => 'El cargo es requerido',
            'nombre_curso.min' => 'El cargo debe tener al menos 3 caracteres',
            'nombre_curso.max' => 'El cargo no puede exceder 100 caracteres',
            'ingreso.required' => 'La fecha de inicio es requerida',
            'ingreso.before_or_equal' => 'La fecha de inicio no puede ser en el futuro',
            'egreso.after_or_equal' => 'La fecha de término debe ser igual o posterior a la fecha de inicio',
            'egreso.before_or_equal' => 'La fecha de término no puede ser en el futuro',
        ]);

        try {
            $perfeccionamiento->update([
                'tipo' => $validated['tipo'],
                'institucion' => trim($validated['institucion']),
                'nombre_curso' => trim($validated['nombre_curso']),
                'ingreso' => $validated['ingreso'],
                'egreso' => $validated['egreso'] ?? null,
            ]);

            return back()->with('success', '✓ Experiencia laboral actualizada correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $perfeccionamiento = Perfeccionamiento::findOrFail($id);
        
        if ($perfeccionamiento->talento->user_id !== Auth::id()) {
            return back()->withErrors(['error' => 'No tienes permiso para eliminar esta experiencia']);
        }

        try {
            $perfeccionamiento->delete();
            return back()->with('success', '✓ Experiencia eliminada correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar: ' . $e->getMessage()]);
        }
    }
}