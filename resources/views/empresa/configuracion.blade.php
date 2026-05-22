<x-empresa-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Configuración
            </h1>
            <p class="text-gray-500 mt-2">
                Administración general de la cuenta empresarial.
            </p>
        </div>
        <!-- Grid Principal -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <!-- Información General -->
            <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">
                    Información General
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">
                            Nombre Empresa
                        </label>
                        <input type="text" value="TechSolutions SpA"
                            class="w-full h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">
                            Correo Empresa
                        </label>
                        <input type="email" value="contacto@techsolutions.cl"
                            class="w-full h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">
                            Teléfono
                        </label>
                        <input type="text" value="+56 9 8765 4321"
                            class="w-full h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">
                            Dirección
                        </label>
                        <input type="text" value="Santiago, Chile"
                            class="w-full h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Seguridad -->
            <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">
                    Seguridad
                </h2>
                <div class="space-y-6">

                    <!-- Item -->
                    <div class="flex items-center justify-between border-b border-gray-100 pb-5">
                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Verificación Cuenta
                            </h3>
                            <p class="text-sm text-gray-500">
                                Cuenta empresarial validada.
                            </p>
                        </div>
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                            Activa
                        </span>
                    </div>

                    <!-- Item -->
                    <div class="flex items-center justify-between border-b border-gray-100 pb-5">
                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Cambio Contraseña
                            </h3>
                            <p class="text-sm text-gray-500">
                                Última actualización hace 30 días.
                            </p>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                            Gestionar
                        </button>

                    </div>

                    <!-- Item -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-800">
                                Sesiones Activas
                            </h3>
                            <p class="text-sm text-gray-500">
                                Control de dispositivos conectados.
                            </p>
                        </div>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-2xl transition">
                            Ver
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preferencias -->
        <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">
                Preferencias
            </h2>
            <div class="space-y-6">

                <!-- Item -->
                <div class="flex items-center justify-between border-b border-gray-100 pb-5">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            Notificaciones
                        </h3>
                        <p class="text-sm text-gray-500">
                            Recibir alertas sobre postulaciones y procesos.
                        </p>
                    </div>
                    <input type="checkbox" checked class="rounded">
                </div>

                <!-- Item -->
                <div class="flex items-center justify-between border-b border-gray-100 pb-5">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            Alertas Email
                        </h3>
                        <p class="text-sm text-gray-500">
                            Notificaciones automáticas por correo.
                        </p>
                    </div>
                    <input type="checkbox" checked class="rounded">
                </div>

                <!-- Item -->
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            Perfil Público
                        </h3>
                        <p class="text-sm text-gray-500">
                            Mostrar empresa en vitrina pública.
                        </p>
                    </div>
                    <input type="checkbox" class="rounded">
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4">
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-4 rounded-2xl transition">
                Cancelar
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold transition shadow-lg">
                Guardar Cambios
            </button>
        </div>
    </div>

</x-empresa-layout>
