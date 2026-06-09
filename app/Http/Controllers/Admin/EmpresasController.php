<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index()
    {
        $buscar = request('buscar');

        $empresas = DatosEmpresa::with('user')
            ->whereHas('user', fn ($q) => $q->where('estado', '!=', 'desactivado'))

            ->when($buscar, function ($query) use ($buscar) {

                $query->whereHas('user', function ($q) use ($buscar) {

                    $q->where('name', 'LIKE', "%{$buscar}%");

                });

            })

            ->paginate(5);

        return view('admin.empresas', compact('empresas'));
    }

    public function update(Request $request, $id)
    {
        $empresa = DatosEmpresa::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'estado' => 'required|in:activo,pendiente,desactivado,bloqueado,rechazado',
            'rubro_empresa' => 'required|string|max:255',
            'tipo_empresa' => 'required|string|max:255',
            'presentacion_empresa' => 'required|string|max:5000',
        ]);

        // ACTUALIZAR USER
        $empresa->user->update([
            'name' => $validated['name'],
            'estado' => $validated['estado'],
        ]);

        // ACTUALIZAR EMPRESA
        $empresa->update([
            'rubro_empresa' => $validated['rubro_empresa'],
            'tipo_empresa' => $validated['tipo_empresa'],
            'presentacion_empresa' => $validated['presentacion_empresa'],
        ]);

        return redirect()->back()->with('success', 'Empresa actualizada');
    }
}