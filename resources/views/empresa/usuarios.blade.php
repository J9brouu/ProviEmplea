<x-empresa-layout>

    <div class="space-y-10">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Usuarios Asociados
            </h1>
            <p class="text-gray-500 mt-2">
                Gestión de usuarios vinculados a la empresa.
            </p>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Usuarios Activos
                </p>
                <h2 class="text-4xl font-bold text-blue-600 mt-4">
                    12
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    RRHH
                </p>
                <h2 class="text-4xl font-bold text-green-600 mt-4">
                    4
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Reclutadores
                </p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-4">
                    5
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Supervisores
                </p>
                <h2 class="text-4xl font-bold text-purple-600 mt-4">
                    3
                </h2>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">

            <!-- Header tabla -->
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Usuarios Empresa
                    </h2>
                    <p class="text-gray-500 mt-1">
                        Administración de usuarios internos.
                    </p>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-medium transition">
                    Nuevo Usuario
                </button>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Usuario
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Cargo
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Correo
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                                        MG
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            María González
                                        </p>
                                        <p class="text-gray-500 text-sm">
                                            Recursos Humanos
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                RRHH
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                maria@empresa.cl
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Activo
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver Usuario
                                </button>
                            </td>
                        </tr>

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-yellow-100 text-yellow-700 flex items-center justify-center font-bold">
                                        CP
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            Carlos Pérez
                                        </p>
                                        <p class="text-gray-500 text-sm">
                                            Reclutador Senior
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                Reclutador
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                carlos@empresa.cl
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Activo
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver Usuario
                                </button>
                            </td>
                        </tr>

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-red-100 text-red-700 flex items-center justify-center font-bold">
                                        AL
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            Andrea López
                                        </p>
                                        <p class="text-gray-500 text-sm">
                                            Supervisora
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                Supervisor
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                andrea@empresa.cl
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Pendiente
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver Usuario
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-empresa-layout>
