<x-empresa-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Dashboard Empresa
            </h1>
            <p class="text-gray-500 mt-2">
                Seguimiento de talentos y procesos de selección.
            </p>
        </div>
        <!-- Stats -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Talentos Encontrados
                </p>
                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    48
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Procesos Activos
                </p>
                <h2 class="text-5xl font-bold text-yellow-500 mt-4">
                    12
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Reclutadores
                </p>
                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    5
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Contactos Realizados
                </p>
                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    31
                </h2>
            </div>
        </div>

        <!-- Procesos -->
        <div class="bg-white rounded-2xl shadow p-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Procesos de Selección
                    </h2>
                    <p class="text-gray-500 mt-1">
                        Seguimiento de candidatos.
                    </p>
                </div>
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">
                    Nuevo Proceso
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-500">
                            <th class="pb-4">Talento</th>
                            <th class="pb-4">Cargo</th>
                            <th class="pb-4">Estado</th>
                            <th class="pb-4">Fecha</th>
                            <th class="pb-4">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr>
                            <td class="py-5">
                                Jonathan Ortiz
                            </td>
                            <td>
                                Frontend Developer
                            </td>
                            <td>
                                <span
                                    class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm">
                                    Entrevista
                                </span>
                            </td>
                            <td>
                                20/05/2026
                            </td>
                            <td>
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                    Ver
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-5">
                                Camila Soto
                            </td>
                            <td>
                                UX/UI Designer
                            </td>
                            <td>
                                <span
                                    class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                                    Seleccionado
                                </span>
                            </td>
                            <td>
                                18/05/2026
                            </td>
                            <td>
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                    Ver
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-empresa-layout>