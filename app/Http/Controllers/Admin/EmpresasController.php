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

        // ACTUALIZAR USER
        $empresa->user->update([
            'name' => $request->name,
            'estado' => $request->estado,
        ]);

        // ACTUALIZAR EMPRESA
        $empresa->update([
            'rubro_empresa' => $request->rubro_empresa,
            'tipo_empresa' => $request->tipo_empresa,
            'presentacion_empresa' => $request->presentacion_empresa,
        ]);

        return redirect()->back()->with('success', 'Empresa actualizada');
    }
}