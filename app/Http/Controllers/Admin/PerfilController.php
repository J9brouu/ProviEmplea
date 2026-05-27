<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PerfilController extends Controller
{
    // MOSTRAR PERFIL
    public function index()
    {
        return view('admin.perfil');
    }

    // ACTUALIZAR PERFIL
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with(
            'success',
            'Perfil actualizado correctamente'
        );
    }

    // CAMBIAR PASSWORD
    public function password(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with(
            'success',
            'Contraseña actualizada correctamente'
        );
    }
}