<x-admin-layout>

    <div class="space-y-8">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">Configuración</h1>
            <p class="text-gray-500 mt-2">Administra las configuraciones generales de la plataforma.</p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Información General -->
            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Información General
                </h2>

                <div class="space-y-5">

                    <div>

                        <label class="block text-gray-600 mb-2">
                            Nombre Plataforma
                        </label>

                        <input
                            type="text"
                            value="ProviEmplea"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block text-gray-600 mb-2">
                            Correo Soporte
                        </label>

                        <input
                            type="email"
                            value="soporte@proviemplea.cl"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block text-gray-600 mb-2">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            value="+56 9 1234 5678"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>

                </div>

            </div>

            <!-- Seguridad -->
            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Seguridad
                </h2>

                <div class="space-y-5">

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="font-semibold text-gray-700">
                                Verificación en dos pasos
                            </h3>

                            <p class="text-gray-500 text-sm">
                                Mayor seguridad para administradores.
                            </p>

                        </div>

                        <button
                            class="bg-green-500 text-white px-4 py-2 rounded-lg">

                            Activo

                        </button>

                    </div>

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="font-semibold text-gray-700">
                                Cambio automático de contraseña
                            </h3>

                            <p class="text-gray-500 text-sm">
                                Renovación cada 90 días.
                            </p>

                        </div>

                        <button
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">

                            Desactivado

                        </button>

                    </div>

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="font-semibold text-gray-700">
                                Sesiones activas
                            </h3>

                            <p class="text-gray-500 text-sm">
                                Control de dispositivos conectados.
                            </p>

                        </div>

                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                            Gestionar

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Notificaciones -->
        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Notificaciones
            </h2>

            <div class="space-y-5">

                <div class="flex justify-between items-center border-b pb-4">

                    <div>

                        <h3 class="font-semibold text-gray-700">
                            Nuevas Empresas
                        </h3>

                        <p class="text-gray-500 text-sm">
                            Recibir alertas de registros empresariales.
                        </p>

                    </div>

                    <input type="checkbox" checked class="w-6 h-6">

                </div>

                <div class="flex justify-between items-center border-b pb-4">

                    <div>

                        <h3 class="font-semibold text-gray-700">
                            Nuevas Postulaciones
                        </h3>

                        <p class="text-gray-500 text-sm">
                            Notificaciones de nuevas postulaciones.
                        </p>

                    </div>

                    <input type="checkbox" checked class="w-6 h-6">

                </div>

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="font-semibold text-gray-700">
                            Reportes Semanales
                        </h3>

                        <p class="text-gray-500 text-sm">
                            Resumen semanal del sistema.
                        </p>

                    </div>

                    <input type="checkbox" class="w-6 h-6">

                </div>

            </div>

        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4">

            <button
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-xl transition">

                Cancelar

            </button>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow transition">

                Guardar Cambios

            </button>

        </div>

    </div>

</x-admin-layout>