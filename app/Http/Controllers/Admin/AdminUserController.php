<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    public function store(CreateAdminUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['rol'] = 'admin';

        User::create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Cuenta de administrador creada correctamente.');
    }
}
