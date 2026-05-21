<x-app-layout>

    <div>

        <!-- Título -->
        <h1 class="text-4xl font-bold text-gray-800 mb-8">
            Dashboard Principal
        </h1>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <h2 class="text-gray-500 text-sm">
                    Talentos Activos
                </h2>

                <p class="text-4xl font-bold text-blue-600 mt-4">
                    1,240
                </p>

            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <h2 class="text-gray-500 text-sm">
                    Empresas Asociadas
                </h2>

                <p class="text-4xl font-bold text-green-600 mt-4">
                    85
                </p>

            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <h2 class="text-gray-500 text-sm">
                    Postulaciones
                </h2>

                <p class="text-4xl font-bold text-purple-600 mt-4">
                    320
                </p>

            </div>

        </div>

        <!-- Tabla -->
        <div class="mt-10 bg-white rounded-2xl shadow p-6">

            <!-- Header tabla -->
            <div class="flex items-center justify-between mb-6">

                <h2 class="text-2xl font-bold text-gray-800">
                    Últimas Empresas
                </h2>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl transition">

                    Ver todas

                </button>

            </div>

            <!-- Tabla -->
            <table class="w-full">

                <thead>

                    <tr class="text-left text-gray-500 border-b">

                        <th class="pb-4">Empresa</th>
                        <th class="pb-4">Estado</th>
                        <th class="pb-4">Vacantes</th>

                    </tr>

                </thead>

                <tbody class="text-gray-700">

                    <!-- Empresa 1 -->
                    <tr class="border-b">

                        <td class="py-4">
                            TechSolutions
                        </td>

                        <td>

                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Activa

                            </span>

                        </td>

                        <td>
                            12
                        </td>

                    </tr>

                    <!-- Empresa 2 -->
                    <tr class="border-b">

                        <td class="py-4">
                            Innovatech
                        </td>

                        <td>

                            <span
                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                Pendiente

                            </span>

                        </td>

                        <td>
                            5
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>