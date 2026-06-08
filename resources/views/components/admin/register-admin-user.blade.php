<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Registrar nuevo administrador</h2>
            <p class="text-gray-500 mt-2 max-w-2xl">
                Crea nuevas cuentas administrativas con acceso al panel de admin. Este formulario solo genera usuarios con rol <strong>admin</strong>.
            </p>
        </div>
        <span class="inline-flex items-center rounded-full bg-blue-100 text-blue-700 px-4 py-2 text-sm font-medium">
            Rol: administrador
        </span>
    </div>

    @if (session('success'))
        <div class="rounded-2xl border border-green-200 bg-green-50 text-green-800 px-4 py-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.admins.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2" for="name">
                Nombre completo
            </label>
            <input id="name" name="name" type="text" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2" for="email">
                Correo electrónico
            </label>
            <input id="email" name="email" type="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2" for="password">
                    Contraseña
                </label>
                <input id="password" name="password" type="password"
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2" for="password_confirmation">
                    Confirmar contraseña
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            </div>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold transition shadow">
                Crear cuenta de administrador
            </button>
        </div>
    </form>
</div>
