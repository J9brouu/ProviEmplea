<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use App\Models\UsuariosEmpresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $usuarios = UsuariosEmpresa::where('datos_empresa_id', $empresa->id)
            ->with('user')
            ->get();

        return view('empresa.usuarios', compact('empresa', 'usuarios'));
    }

    public function store(Request $request)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'cargo'    => 'required|in:RRHH,Reclutador,Supervisor,Jefe de Area',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => 'empresa',
            'estado'   => 'activo',
        ]);

        UsuariosEmpresa::create([
            'datos_empresa_id' => $empresa->id,
            'user_id'          => $user->id,
            'telefono'         => $request->telefono,
            'cargo'            => $request->cargo,
        ]);

        return back()->with('success', 'Usuario agregado correctamente.');
    }

    public function destroy($id)
    {
        $empresa = DatosEmpresa::where('user_id', Auth::id())->firstOrFail();

        $usuario = UsuariosEmpresa::where('id', $id)
            ->where('datos_empresa_id', $empresa->id)
            ->firstOrFail();

        $usuario->user->delete();

        return back()->with('success', 'Usuario eliminado.');
    }
}
