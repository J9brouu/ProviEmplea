<x-talento-layout>
    <div class="space-y-8">

        <!-- Header -->

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Dashboard Talento
            </h1>
            <p class="text-gray-500 mt-2">
                Resumen general de perfil y procesos activos.
            </p>
        </div>

        <!-- Cards -->

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- Perfil -->

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Perfil Completado
                </p>
                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    92%
                </h2>
            </div>

            <!-- Procesos -->

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Procesos Activos
                </p>
                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    4
                </h2>
            </div>

            <!-- Empresas -->

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Empresas Interesadas
                </p>
                <h2 class="text-5xl font-bold text-green-600 mt-4">
                3
                </h2>
            </div>

            <!-- Documentos -->

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">
                    Documentos Validados
                </p>
                <h2 class="text-5xl font-bold text-yellow-500 mt-4">
                    5
                </h2>
            </div>
        </div>

        <!-- Últimos procesos -->

        <div class="bg-white rounded-2xl shadow p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">
                    Últimos Procesos
                </h2>
                <a href="/talento/procesos"
                class="text-blue-600 hover:text-blue-700 font-semibold">
                    Ver todos
                </a>
            </div>
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
                                Estado
                            </th>
                            <th class="pb-4">
                                Fecha
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="border-b">
                            <td class="py-5">
                                TechSolutions
                            </td>
                            <td class="py-5">
                                Desarrollador Frontend
                            </td>
                            <td class="py-5">
                                <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm">
                                    Contactado
                                </span>
                            </td>
                            <td class="py-5">
                                18/05/2026
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-5">
                                InnovaTech
                            </td>
                            <td class="py-5">
                                Diseñador UX/UI
                            </td>
                            <td class="py-5">
                                <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm">
                                Entrevista
                                </span>
                            </td>
                            <td class="py-5">
                                10/05/2026
                            </td>
                        </tr>
                        <tr>
                            <td class="py-5">
                                Logística S.A.
                            </td>
                            <td class="py-5">
                                Soporte TI
                            </td>
                            <td class="py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                                    Seleccionado
                                </span>
                            </td>
                            <td class="py-5">
                                v02/05/2026
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</x-talento-layout>