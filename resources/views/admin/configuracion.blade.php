<x-admin-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">Configuración</h1>
            <p class="text-gray-500 mt-2">Administra los usuarios administradores de la plataforma.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 rounded-xl px-5 py-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 rounded-xl px-5 py-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Gestión de Administradores -->
        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Usuarios Administradores</h2>
                <button
                    @click="$dispatch('abrir-modal-admin')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition">
                    + Nuevo Administrador
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-left">
                            <th class="px-4 py-3 rounded-l-xl">Nombre</th>
                            <th class="px-4 py-3">Correo</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3 rounded-r-xl text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($admins as $admin)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $admin->name }}
                                    @if($admin->id === auth()->id())
                                        <span class="ml-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Tú</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $admin->email }}</td>
                                <td class="px-4 py-3">
                                    @if($admin->estado === 'inactivo')
                                        <span class="inline-block bg-red-100 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Inactivo</span>
                                    @else
                                        <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">Activo</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    @if($admin->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.configuracion.usuarios.toggle', $admin->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-sm font-medium {{ $admin->estado === 'inactivo' ? 'text-green-600 hover:text-green-800' : 'text-orange-500 hover:text-orange-700' }}">
                                                {{ $admin->estado === 'inactivo' ? 'Activar' : 'Desactivar' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

@push('modals')
    <div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }"
         x-show="open"
         x-cloak
         @abrir-modal-admin.window="open = true"
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Nuevo Administrador</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.configuracion.usuarios.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" required minlength="8"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="open = false"
                        class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm hover:bg-gray-50 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                        Crear Administrador
                    </button>
                </div>

            </form>

        </div>
    </div>
@endpush

</x-admin-layout>
