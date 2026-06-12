<x-admin-layout>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any() && !$errors->has('current_password') && !$errors->has('password') && !$errors->has('password_confirmation'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">Perfil Administrativo</h1>
            <p class="text-gray-500 mt-2">Información general del administrador.</p>
        </div>

        <!-- Perfil principal -->
        <div class="bg-white rounded-2xl shadow p-8">
            <div class="flex items-center gap-6">
                <div class="w-32 h-32 rounded-full bg-blue-600 flex items-center justify-center text-white text-3xl font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Información -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Cuenta -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Información de Cuenta</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-500 text-sm">Nombre</p>
                        <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Correo</p>
                        <p class="text-lg font-semibold">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Rol</p>
                        <p class="text-lg font-semibold text-blue-600">Administrador</p>
                    </div>
                </div>
            </div>

            <!-- Seguridad -->
            <div class="bg-white rounded-2xl shadow p-6 self-start">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Seguridad</h3>
                <div class="flex flex-wrap gap-4">
                    <button type="button"
                        onclick="const m = document.getElementById('modalPerfil'); m.classList.remove('hidden'); m.classList.add('flex');"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl transition font-semibold shadow">
                        Editar Perfil
                    </button>
                    <button type="button"
                        onclick="const m = document.getElementById('modalPassword'); m.classList.remove('hidden'); m.classList.add('flex');"
                        class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-2xl transition font-semibold shadow">
                        Cambiar Contraseña
                    </button>
                </div>
            </div>

        </div>

    </div>

    <!-- MODAL PERFIL -->
    <div id="modalPerfil"
        class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Editar Perfil</h2>
                    <p class="text-gray-500 text-sm mt-1">Actualiza tu nombre y correo</p>
                </div>
                <button type="button"
                    onclick="const m = document.getElementById('modalPerfil'); m.classList.add('hidden'); m.classList.remove('flex');"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">
                    &times;
                </button>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('admin.perfil.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow">
                        Guardar Cambios
                    </button>
                    <button type="button"
                        onclick="const m = document.getElementById('modalPerfil'); m.classList.add('hidden'); m.classList.remove('flex');"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">
                        Cancelar
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- MODAL PASSWORD -->
    <div id="modalPassword"
        class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Cambiar contraseña</h2>
                    <p class="text-gray-500 text-sm mt-1">Actualiza tu contraseña de acceso</p>
                </div>
                <button type="button"
                    onclick="const m = document.getElementById('modalPassword'); m.classList.add('hidden'); m.classList.remove('flex');"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">
                    &times;
                </button>
            </div>

            @if ($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-5">
                    <ul class="space-y-1">
                        @error('current_password')<li>• {{ $message }}</li>@enderror
                        @error('password')<li>• {{ $message }}</li>@enderror
                        @error('password_confirmation')<li>• {{ $message }}</li>@enderror
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('admin.perfil.password') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Contraseña actual</label>
                    <input type="password" name="current_password"
                        class="w-full border {{ $errors->has('current_password') ? 'border-red-400' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Nueva contraseña</label>
                    <input type="password" name="password"
                        class="w-full border {{ $errors->has('password') ? 'border-red-400' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border {{ $errors->has('password_confirmation') ? 'border-red-400' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow">
                        Actualizar contraseña
                    </button>
                    <button type="button"
                        onclick="const m = document.getElementById('modalPassword'); m.classList.add('hidden'); m.classList.remove('flex');"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">
                        Cancelar
                    </button>
                </div>
            </form>

        </div>
    </div>

    @if ($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var m = document.getElementById('modalPassword');
                m.classList.remove('hidden');
                m.classList.add('flex');
            });
        </script>
    @endif

</x-admin-layout>
