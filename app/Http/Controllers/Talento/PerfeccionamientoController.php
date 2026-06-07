<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\Perfeccionamiento;
use App\Models\Talento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfeccionamientoController extends Controller
{
    private const TIPOS = ['Curso', 'Certificación', 'Diplomado', 'Bootcamp', 'Taller'];

    private function rules(): array
    {
        return [
            'tipo'        => 'required|in:Curso,Certificación,Diplomado,Bootcamp,Taller',
            'institucion' => 'required|string|min:3|max:100',
            'nombre_curso'=> 'required|string|min:3|max:100',
            'ingreso'     => 'required|date|before_or_equal:today',
            'egreso'      => 'nullable|date|after_or_equal:ingreso',
        ];
    }

    private function messages(): array
    {
        return [
            'tipo.required'         => 'El tipo es requerido',
            'tipo.in'               => 'El tipo de perfeccionamiento no es válido',
            'institucion.required'  => 'La institución es requerida',
            'institucion.min'       => 'La institución debe tener al menos 3 caracteres',
            'institucion.max'       => 'La institución no puede exceder 100 caracteres',
            'nombre_curso.required' => 'El nombre del curso es requerido',
            'nombre_curso.min'      => 'El nombre debe tener al menos 3 caracteres',
            'nombre_curso.max'      => 'El nombre no puede exceder 100 caracteres',
            'ingreso.required'      => 'La fecha de inicio es requerida',
            'ingreso.before_or_equal' => 'La fecha de inicio no puede ser en el futuro',
            'egreso.after_or_equal' => 'La fecha de término debe ser posterior al inicio',
        ];
    }

    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        $perfeccionamientos = Perfeccionamiento::where('talento_id', $talento->id)->latest()->get();

        return view('talento.experiencia', compact('perfeccionamientos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        Perfeccionamiento::create([
            'talento_id'   => $talento->id,
            'tipo'         => $validated['tipo'],
            'institucion'  => trim($validated['institucion']),
            'nombre_curso' => trim($validated['nombre_curso']),
            'ingreso'      => $validated['ingreso'],
            'egreso'       => $validated['egreso'] ?? null,
        ]);

        return back()->with('success', 'Perfeccionamiento agregado correctamente');
    }

    public function update(Request $request, $id)
    {
        $perfeccionamiento = Perfeccionamiento::findOrFail($id);

        if ($perfeccionamiento->talento?->user_id !== Auth::id()) {
        }

        $validated = $request->validate($this->rules(), $this->messages());

        $perfeccionamiento->update([
            'tipo'         => $validated['tipo'],
            'institucion'  => trim($validated['institucion']),
            'nombre_curso' => trim($validated['nombre_curso']),
            'ingreso'      => $validated['ingreso'],
            'egreso'       => $validated['egreso'] ?? null,
        ]);

        return back()->with('success', 'Perfeccionamiento actualizado correctamente');
    }

    public function destroy($id)
    {
        $perfeccionamiento = Perfeccionamiento::findOrFail($id);

        if ($perfeccionamiento->talento?->user_id !== Auth::id()) {
            return back()->withErrors(['error' => 'No tienes permiso para eliminar este registro']);
        }

        $perfeccionamiento->delete();

        return back()->with('success', 'Perfeccionamiento eliminado correctamente');
    }
}
