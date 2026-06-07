<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use App\Models\AntecedentesEducacionales;
use App\Models\Perfeccionamiento;
use App\Models\Talento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AntecedentesEducacionalesController extends Controller
{
    public function index()
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        $educaciones = AntecedentesEducacionales::where(
            'talento_id',
            $talento->id
        )->latest()->get();

        $perfeccionamientos = Perfeccionamiento::where(
            'talento_id',
            $talento->id
        )->latest()->get();

        return view(
            'talento.educacion',
            compact(
                'educaciones',
                'perfeccionamientos'
            )
        );
    }
    public function store(Request $request)
    {
        $talento = Talento::where('user_id', Auth::id())->firstOrFail();

        if ($request->categoria == 'educacion') {

            $validated = $request->validate([
                'nombre_curso' => 'required|string|max:255',
                'institucion' => 'required|string|max:255',
                'ingreso' => 'required|date',
                'egreso' => 'nullable|date|after_or_equal:ingreso',
            ]);

            AntecedentesEducacionales::create([
                'talento_id' => $talento->id,
                'titulo' => $validated['nombre_curso'],
                'nombre_institucion' => $validated['institucion'],
                'ingreso' => $validated['ingreso'],
                'egreso' => $request->has('actualidad')
                    ? null
                    : ($validated['egreso'] ?? null),
                'completo' => $request->has('actualidad') ? 0 : 1,
            ]);
        } else {

            $validated = $request->validate([
                'nombre_curso' => 'required|string|max:255',
                'institucion' => 'required|string|max:255',
                'tipo' => 'required|string|max:100',
                'ingreso' => 'required|date',
                'egreso' => 'required|date|after_or_equal:ingreso',
            ]);

            Perfeccionamiento::create([
                'talento_id' => $talento->id,
                'nombre_curso' => $validated['nombre_curso'],
                'institucion' => $validated['institucion'],
                'tipo' => $validated['tipo'],
                'ingreso' => $validated['ingreso'],
                'egreso' => $validated['egreso'] ?? null,
            ]);
        }

        return back()->with('success', 'Registro agregado correctamente');
    }
    public function destroy($id)
    {
        $registro = AntecedentesEducacionales::findOrFail($id);

        $registro->delete();

        return back()->with('success', 'Educación eliminada correctamente');
    }
    public function destroyCurso($id)
    {
        $curso = Perfeccionamiento::findOrFail($id);

        $curso->delete();

        return back()->with('success', 'Curso eliminado correctamente');
    }
    public function updateEducacion(Request $request, $id)
    {
        $educacion = AntecedentesEducacionales::findOrFail($id);

        $validated = $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'ingreso' => 'required|date',
            'egreso' => 'nullable|date|after_or_equal:ingreso',
        ]);

        $educacion->update([
            'titulo' => $validated['nombre_curso'],
            'nombre_institucion' => $validated['institucion'],
            'ingreso' => $validated['ingreso'],
            'egreso' => $request->has('actualidad')
                ? null
                : ($validated['egreso'] ?? null),
            'completo' => $request->has('actualidad') ? 0 : 1,
        ]);

        return back()->with('success', 'Educación actualizada correctamente');
    }
    public function updateCurso(Request $request, $id)
    {
        $curso = Perfeccionamiento::findOrFail($id);

        $validated = $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'ingreso' => 'required|date',
            'egreso' => 'nullable|date|after_or_equal:ingreso',
        ]);

        $curso->update([
            'nombre_curso' => $validated['nombre_curso'],
            'institucion' => $validated['institucion'],
            'tipo' => $validated['tipo'],
            'ingreso' => $validated['ingreso'],
            'egreso' => $validated['egreso'] ?? null,
        ]);

        return back()->with('success', 'Curso actualizado correctamente');
    }
}
