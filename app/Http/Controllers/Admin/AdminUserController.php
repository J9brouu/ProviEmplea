<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function store(CreateAdminUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['rol'] = 'admin';
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(60);

        User::create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Cuenta de administrador creada correctamente.');
    }

    public function deactivate(int $id): RedirectResponse
    {
        $admin = User::where('rol', 'admin')->findOrFail($id);

        if (Auth::id() === $admin->getKey()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'No puedes desactivar tu propia cuenta desde aquí.');
        }

        $admin->update(['estado' => 'desactivado']);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Administrador desactivado correctamente.');
    }

    public function reactivate(int $id): RedirectResponse
    {
        $user = User::where('estado', 'desactivado')->findOrFail($id);

        $user->update(['estado' => 'activo']);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Usuario reactivado correctamente.');
    }
}
