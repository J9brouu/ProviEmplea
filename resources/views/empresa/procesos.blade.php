<x-empresa-layout>

    <div class="space-y-10">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Procesos de Selección
            </h1>
            <p class="text-gray-500 mt-2">
                Seguimiento de talentos contactados y procesos activos.
            </p>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Procesos Activos
                </p>
                <h2 class="text-4xl font-bold text-blue-600 mt-4">
                    12
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Entrevistas
                </p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-4">
                    5
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Seleccionados
                </p>
                <h2 class="text-4xl font-bold text-green-600 mt-4">
                    3
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    No seleccionados
                </p>
                <h2 class="text-4xl font-bold text-red-500 mt-4">
                    4
                </h2>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800">
                    Seguimiento de Procesos
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Talento
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Cargo
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Fecha
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
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Talento #1024
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        Frontend Developer
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                Desarrollador Frontend
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Entrevista
                                </span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                21/05/2026
                            </td>
                            <td class="px-6 py-5">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver Proceso
                                </button>
                            </td>
                        </tr>

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Talento #2045
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        Backend Developer
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                Backend Laravel
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Seleccionado
                                </span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                18/05/2026
                            </td>
                            <td class="px-6 py-5">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver Proceso
                                </button>
                            </td>
                        </tr>

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Talento #8871
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        Data Analyst
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                Analista de Datos
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-medium">
                                    No seleccionado
                                </span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                12/05/2026
                            </td>
                            <td class="px-6 py-5">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver Proceso
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-empresa-layout>