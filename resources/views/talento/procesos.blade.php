<x-talento-layout>

    <div class="space-y-8">
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Procesos de Selección
            </h1>
            <p class="text-gray-500 mt-2">
                Seguimiento de procesos y solicitudes empresariales.
            </p>
        </div>

        <!-- Cards -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Contactados
                </p>
                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    4
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Entrevistas
                </p>
                <h2 class="text-5xl font-bold text-yellow-500 mt-4">
                    2
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Seleccionados
                </p>
                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    1
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    No Seleccionados
                </p>
                <h2 class="text-5xl font-bold text-red-500 mt-4">
                    3
                </h2>
            </div>
        </div>

        <!-- Tabla -->

        <div class="bg-white rounded-2xl shadow p-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="pb-4">
                                Empresa
                            </th>
                            <th class="pb-4">
                                Cargo
                            </th>
                            <th class="pb-4">
                                Modalidad
                            </th>
                            <th class="pb-4">
                                Etapa
                            </th>
                            <th class="pb-4">
                                Estado
                            </th>
                            <th class="pb-4">
                                Fecha
                            </th>
                            <th class="pb-4 text-center">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <!-- Proceso -->
                        <tr class="border-b">
                            <td class="py-5">
                                TechSolutions
                            </td>
                            <td class="py-5">
                                Desarrollador Frontend
                            </td>
                            <td class="py-5">
                                Remoto
                            </td>
                            <td class="py-5">
                                Revisión CV
                            </td>
                            <td class="py-5">
                                <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm">
                                    Contactado
                                </span>
                            </td>
                            <td class="py-5">
                                18/05/2026
                            </td>
                            <td class="py-5 text-center">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Ver Proceso
                                </button>
                            </td>
                        </tr>

                        <!-- Proceso -->

                        <tr class="border-b">
                            <td class="py-5">
                                InnovaTech
                            </td>
                            <td class="py-5">
                                Diseñador UX/UI
                            </td>
                            <td class="py-5">
                                Híbrido
                            </td>
                            <td class="py-5">
                                Entrevista Técnica
                            </td>
                            <td class="py-5">

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm">
                                    Entrevista
                                </span>
                            </td>
                            <td class="py-5">
                                10/05/2026
                            </td>
                            <td class="py-5 text-center">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Ver Proceso
                                </button>
                            </td>
                        </tr>

                        <!-- Proceso -->

                        <tr>
                            <td class="py-5">
                                Logística S.A.
                            </td>
                            <td class="py-5">
                                Soporte TI
                            </td>
                            <td class="py-5">
                                Presencial
                            </td>
                            <td class="py-5">
                                Evaluación Final
                            </td>
                            <td class="py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                                    Seleccionado
                                </span>
                            </td>
                            <td class="py-5">
                                02/05/2026
                            </td>
                            <td class="py-5 text-center">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Ver Proceso
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</x-talento-layout>