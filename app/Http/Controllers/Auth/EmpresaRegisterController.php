<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsuariosEmpresa;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmpresaRegisterController extends Controller
{
    public function create()
    {
        return view('auth.registro-empresa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'rut' => 'required|string|max:50',
            'telefono' => 'required|string|max:50',
            'password' => 'required|confirmed|min:8',
        ]);

        // USER
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'rol'            => 'empresa',
            'estado'         => 'pendiente',
            'password'       => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        // CREAR DATOS EMPRESA
        $datosEmpresa = DatosEmpresa::create([
            'user_id' => $user->id,
            'rut_empresa' => $request->rut,
            'rubro_empresa' => 'No especificado',
            'tipo_empresa' => 'Pyme',
            'presentacion_empresa' => 'Empresa recientemente registrada.',
            'beneficios_empresa' => 'Beneficios por definir.',
            'validacion' => 0,
        ]);

        // PERFIL EMPRESA
        UsuariosEmpresa::create([
            'user_id' => $user->id,
            'datos_empresa_id' => $datosEmpresa->id,
            'rut' => $request->rut,
            'telefono' => $request->telefono,
        ]);
        Auth::login($user);

        return redirect('/empresa/dashboard');
    }
}
