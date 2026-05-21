<x-app-layout>

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

                    <p class="text-gray-500 mt-1">
                        Administrador General
                    </p>

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
            <div class="bg-white rounded-2xl shadow p-6">

                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    Seguridad
                </h3>

                <div class="space-y-4">

                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition">

                        Editar Perfil

                    </button>

                    <button
                        class="w-full bg-gray-800 hover:bg-gray-900 text-white py-3 rounded-xl transition">

                        Cambiar Contraseña

                    </button>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>