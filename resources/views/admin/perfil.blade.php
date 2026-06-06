<x-admin-layout>
    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    <div class="space-y-8">

        <!-- Header -->
        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Perfil Administrativo
            </h1>

            <p class="text-gray-500 mt-2">
                Información general del administrador.
            </p>

        </div>
        <br>
        <!-- Perfil principal -->
        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex items-center gap-6">

                <!-- Avatar -->
                <div
                    class="w-32 h-32 rounded-full bg-blue-600 flex items-center justify-center text-white text-3xl font-bold">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>

                <!-- Datos -->
                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ Auth::user()->name }}
                    </h2>
                    <p class="text-gray-500">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </div>

        </div>
        <br>
        <!-- Información -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Cuenta -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    Información de Cuenta
                </h3>

                <div class="space-y-4">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Nombre
                        </p>

                        <p class="text-lg font-semibold">
                            {{ Auth::user()->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-gray-500 text-sm">
                            Correo
                        </p>

                        <p class="text-lg font-semibold">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                    <div>

                        <p class="text-gray-500 text-sm">
                            Rol
                        </p>

                        <p class="text-lg font-semibold text-blue-600">
                            Administrador
                        </p>

                    </div>

                </div>

            </div>

            <!-- Seguridad -->
            <div class="bg-white rounded-2xl shadow p-6 self-start max-w-md">

                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    Seguridad
                </h3>

                <!-- BOTONES -->
                <div class="flex flex-wrap gap-4">

                    <!-- BOTON MODAL PERFIL -->
                    <button type="button"
                        onclick="
                const modal = document.getElementById('modalPerfil');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            "
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl transition font-semibold shadow">

                        Editar Perfil

                    </button>

                    <!-- BOTON MODAL PASSWORD -->
                    <button type="button"
                        onclick="
                const modal = document.getElementById('modalPassword');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            "
                        class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-2xl transition font-semibold shadow">

                        Cambiar Contraseña

                    </button>

                </div>

            </div>
            <!-- MODAL PERFIL -->
            <div id="modalPerfil"
                class="fixed inset-0 top-0 left-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">

                <!-- CAJA -->
                <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <h2 class="text-3xl font-bold text-gray-800">
                                Editar Perfil
                            </h2>

                            <p class="text-gray-500 text-sm mt-1">
                                Actualiza tu información administrativa
                            </p>

                        </div>

                        <!-- CERRAR -->
                        <button type="button"
                            onclick="
                    const modal = document.getElementById('modalPerfil');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                "
                            class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">

                            &times;

                        </button>

                    </div>

                    <!-- FORM -->
                    <form method="POST" action="{{ route('admin.perfil.update') }}" class="space-y-5">

                        @csrf
                        @method('PUT')

                        <!-- NOMBRE -->
                        <div>

                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Nombre
                            </label>

                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">

                        </div>

                        <!-- EMAIL -->
                        <div>

                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Correo electrónico
                            </label>

                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">

                        </div>

                        <!-- BOTONES -->
                        <div class="flex gap-3 pt-4">

                            <!-- GUARDAR -->
                            <button type="submit"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow">

                                Guardar Cambios

                            </button>

                            <!-- CANCELAR -->
                            <button type="button"
                                onclick="
                        const modal = document.getElementById('modalPerfil');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    "
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

                <!-- CAJA -->
                <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <h2 class="text-3xl font-bold text-gray-800">
                                Cambiar Contraseña
                            </h2>

                            <p class="text-gray-500 text-sm mt-1">
                                Actualiza tu contraseña de acceso
                            </p>

                        </div>

                        <!-- CERRAR -->
                        <button type="button"
                            onclick="
                    const modal = document.getElementById('modalPassword');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                "
                            class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">

                            &times;

                        </button>

                    </div>

                    <!-- FORM -->
                    <form method="POST" action="{{ route('admin.perfil.password') }}" class="space-y-5">

                        @csrf
                        @method('PUT')

                        <!-- PASSWORD -->
                        <div>

                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Nueva Contraseña
                            </label>

                            <input type="password" name="password"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-gray-700 focus:outline-none transition">

                        </div>

                        <!-- CONFIRM -->
                        <div>

                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Confirmar Contraseña
                            </label>

                            <input type="password" name="password_confirmation"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-gray-700 focus:outline-none transition">

                        </div>

                        <!-- BOTONES -->
                        <div class="flex gap-3 pt-4">

                            <!-- ACTUALIZAR -->
                            <button type="submit"
                                class="flex-1 bg-gray-800 hover:bg-black text-white py-3 rounded-2xl font-semibold transition shadow">

                                Actualizar

                            </button>

                            <!-- CANCELAR -->
                            <button type="button"
                                onclick="
                        const modal = document.getElementById('modalPassword');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    "
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">

                                Cancelar

                            </button>

                        </div>

                    </form>

                </div>

            </div>
</x-admin-layout>
