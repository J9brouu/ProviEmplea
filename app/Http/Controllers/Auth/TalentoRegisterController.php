<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Talento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TalentoRegisterController extends Controller
{
    public function create()
    {
        return view('auth.registro-talento');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:50',
            'password' => 'required|confirmed|min:8',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => 'talento',
            'estado' => 'pendiente',
            'password' => Hash::make($request->password),
        ]);

        // Crear perfil talento
        Talento::create([
            'user_id' => $user->id,
            'edad' => 0,
            'telefono' => $request->telefono,
            'direccion' => 'No especificado',
            'genero' => 'No especificado',
            'resumen' => '',
            'renta_desde' => 0,
            'renta_hasta' => 0,
            'condicion_jornada' =>'No especificado',
            'condicion_modalidad' =>'No especificado',
            'discapacidad' => 0,
            'validacion' => 0,
        ]);

        Auth::login($user);

        return redirect('/talento/dashboard');
    }
}
