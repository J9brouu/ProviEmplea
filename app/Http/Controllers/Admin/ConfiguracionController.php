<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $admins = User::where('rol', 'admin')->orderBy('name')->get();
        return view('admin.configuracion', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => 'admin',
            'estado'   => 'activo',
        ]);

        return back()->with('success', 'Administrador creado correctamente.');
    }

    public function toggleAdmin(int $id)
    {
        if ($id == Auth::id()) {
            return back()->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        $admin = User::where('id', $id)->where('rol', 'admin')->firstOrFail();
        $admin->estado = $admin->estado === 'inactivo' ? 'activo' : 'inactivo';
        $admin->save();

        $msg = $admin->estado === 'activo' ? 'Administrador activado.' : 'Administrador desactivado.';
        return back()->with('success', $msg);
    }
}
