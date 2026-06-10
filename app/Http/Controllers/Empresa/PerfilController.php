<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use App\Models\Interacciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $empresa = DatosEmpresa::with('usuariosEmpresa')
            ->firstOrCreate(
                ['user_id' => Auth::id()],
                [
                    'rut_empresa' => 'Pendiente',
                    'rubro_empresa' => 'No especificado',
                    'tipo_empresa' => 'Pyme',
                    'presentacion_empresa' => 'Empresa registrada sin datos.',
                    'beneficios_empresa' => 'Beneficios por definir.',
                    'validacion' => 0,
                ]
            );

        $totales = [
            'procesos'   => Interacciones::where('datos_empresa_id', $empresa->id)->whereIn('estado', ['contactado', 'entrevista'])->count(),
            'contactados'=> Interacciones::where('datos_empresa_id', $empresa->id)->count(),
            'usuarios'   => $empresa->usuariosEmpresa()
                ->whereHas('user', fn ($q) => $q->where('estado', '!=', 'desactivado'))
                ->count(),
        ];

        return view('empresa.perfil', compact('empresa', 'totales'));
    }

    public function update(Request $request)
    {
        $empresa = DatosEmpresa::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'rut_empresa' => 'Pendiente',
                'rubro_empresa' => 'No especificado',
                'tipo_empresa' => 'Pyme',
                'presentacion_empresa' => 'Empresa registrada sin datos.',
                'beneficios_empresa' => 'Beneficios por definir.',
                'validacion' => 0,
            ]
        );

        $request->validate([
            'name'                 => 'required|string|max:255',
            'rut_empresa'          => 'required|string|max:20',
            'rubro_empresa'        => 'required|string|max:255',
            'tipo_empresa'         => 'required|string|max:100',
            'presentacion_empresa' => 'nullable|string|max:3000',
            'beneficios_empresa'   => 'nullable|string|max:3000',
            'logo'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'rut_empresa', 'rubro_empresa', 'tipo_empresa',
            'presentacion_empresa', 'beneficios_empresa',
        ]);

        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $data['logo_contenido'] = base64_encode(file_get_contents($logoFile->getRealPath()));
            $data['logo_mime']      = $logoFile->getMimeType();
        }

        $empresa->update($data);
        $empresa->user->update(['name' => $request->name]);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        /** @var User|null $user */
        $user = Auth::user();

        $user?->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
