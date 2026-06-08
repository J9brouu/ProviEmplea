<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
}
