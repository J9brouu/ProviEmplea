<x-app-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-5xl font-bold text-gray-800">
                    Postulaciones
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestión de postulaciones realizadas por talentos.
                </p>

            </div>
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition shadow">
                Nueva Postulación
            </button>

        </div>
        <br>
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Total Postulaciones
                </p>

                <h2 class="text-4xl font-bold text-blue-600 mt-4">
                    320
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    En Revisión
                </p>

                <h2 class="text-4xl font-bold text-yellow-500 mt-4">
                    48
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Aprobadas
                </p>

                <h2 class="text-4xl font-bold text-green-600 mt-4">
                    190
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Rechazadas
                </p>

                <h2 class="text-4xl font-bold text-red-500 mt-4">
                    82
                </h2>

            </div>

        </div>
        <br>
        <!-- Tabla -->
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-3xl font-bold text-gray-800">
                    Historial de Postulaciones
                </h2>

                <input
                    type="text"
                    placeholder="Buscar postulante..."
                    class="border border-gray-300 rounded-xl px-4 py-3">

            </div>

            <table class="w-full table-auto">

                <thead>

                    <tr class="border-b text-gray-500 text-center">

                        <th class="pb-4">
                            Talento
                        </th>

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

                        <th class="pb-4">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody class="text-gray-700 text-center">

                    <!-- Fila 1 -->
                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-5 font-medium">
                            Juan Pérez
                        </td>

                        <td>
                            TechSolutions
                        </td>

                        <td>
                            Frontend Developer
                        </td>

                        <td>

                            <span
                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                En Revisión

                            </span>

                        </td>

                        <td>
                            12/05/2026
                        </td>

                        <td class="space-x-2">

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                Ver

                            </button>

                            <button
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">

                                Aprobar

                            </button>

                        </td>

                    </tr>

                    <!-- Fila 2 -->
                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-5 font-medium">
                            Camila Soto
                        </td>

                        <td>
                            Innovatech
                        </td>

                        <td>
                            UX Designer
                        </td>

                        <td>

                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Aprobada

                            </span>

                        </td>

                        <td>
                            10/05/2026
                        </td>

                        <td class="space-x-2">

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                Ver

                            </button>

                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                Rechazar

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>