<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talento;
use Illuminate\Http\Request;

class TalentosController extends Controller
{
    public function index()
    {
        $buscar = request('buscar');

        $talentos = Talento::with('user')

            ->when($buscar, function ($query) use ($buscar) {

                $query->whereHas('user', function ($q) use ($buscar) {

                    $q->where('name', 'LIKE', "%{$buscar}%");
                })

                    ->orWhere('condicion_modalidad', 'LIKE', "%{$buscar}%")
                    ->orWhere('condicion_jornada', 'LIKE', "%{$buscar}%");
            })

            ->paginate(5);

        return view('admin.talentos', compact('talentos'));
    }

    public function update(Request $request, $id)
    {
        $talento = Talento::findOrFail($id);

        // VALIDAR DATOS
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'estado' => 'required|in:activo,pendiente,bloqueado,rechazado',
            'condicion_modalidad' => 'required|in:Presencial,Remoto,Híbrido',
            'condicion_jornada' => 'required|in:Full-Time,Part-Time,Freelance',
            'resumen' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => 'El nombre es requerido',
            'estado.required' => 'El estado es requerido',
            'estado.in' => 'El estado no es válido',
            'condicion_modalidad.required' => 'La modalidad es requerida',
            'condicion_modalidad.in' => 'La modalidad no es válida',
            'condicion_jornada.required' => 'La jornada es requerida',
            'condicion_jornada.in' => 'La jornada no es válida',
            'resumen.required' => 'El resumen es requerido',
            'resumen.min' => 'El resumen debe tener al menos 10 caracteres',
            'resumen.max' => 'El resumen no puede superar 5000 caracteres',
        ]);

        try {
            // ACTUALIZAR TABLA TALENTO
            $talento->update([
                'condicion_modalidad' => $validated['condicion_modalidad'],
                'condicion_jornada' => $validated['condicion_jornada'],
                'resumen' => $validated['resumen'],
            ]);

            // ACTUALIZAR USUARIO
            $talento->user->update([
                'name' => $validated['name'],
                'estado' => $validated['estado'],
            ]);

            return redirect()->back()->with('success', 'Talento actualizado correctamente ✓');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }
}