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

        // ACTUALIZAR TABLA TALENTO
        $talento->update([
            'condicion_modalidad' => $request->condicion_modalidad,
            'condicion_jornada' => $request->condicion_jornada,
            'resumen' => $request->resumen,
        ]);

        // ACTUALIZAR USUARIO
        $talento->user->update([
            'name' => $request->name,
            'estado' => $request->estado,
        ]);

        return redirect()->back()->with('success', 'Talento actualizado');
    }
}