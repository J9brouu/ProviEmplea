<x-admin-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-5xl font-bold text-gray-800">
                    Empresas
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestión de empresas registradas en ProviEmplea.
                </p>

            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition shadow">

                Nueva Empresa

            </button>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Empresas Activas
                </p>

                <h2 class="text-4xl font-bold text-green-600 mt-4">
                    72
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Pendientes
                </p>

                <h2 class="text-4xl font-bold text-yellow-500 mt-4">
                    14
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Suspendidas
                </p>

                <h2 class="text-4xl font-bold text-red-500 mt-4">
                    3
                </h2>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Nuevas este mes
                </p>

                <h2 class="text-4xl font-bold text-blue-600 mt-4">
                    9
                </h2>

            </div>

        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-3xl font-bold text-gray-800">
                    Empresas Registradas
                </h2>

                <input type="text" placeholder="Buscar empresa..."
                    class="border border-gray-300 rounded-xl px-4 py-3">

            </div>

            <table class="w-full table-auto">

                <thead>

                    <tr class="border-b text-gray-500 text-center">

                        <th class="pb-4">
                            Empresa
                        </th>

                        <th class="pb-4">
                            Estado
                        </th>

                        <th class="pb-4">
                            Vacantes
                        </th>

                        <th class="pb-4">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody class="text-gray-700 text-center">

                    <!-- Empresa 1 -->
                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-5 font-medium">
                            TechSolutions
                        </td>

                        <td>

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Verificada

                            </span>

                        </td>

                        <td>
                            12
                        </td>
                        <td class="py-5">

                            <div class="flex justify-center gap-2">

                                <button
                                    class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg transition shadow-md">

                                    Editar

                                </button>

                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                    Eliminar

                                </button>

                            </div>

                        </td>

                    </tr>

                    <!-- Empresa 2 -->
                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-5 font-medium">
                            Innovatech
                        </td>

                        <td>

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                Pendiente

                            </span>

                        </td>

                        <td>
                            5
                        </td>

                        <td class="py-5">

                            <div class="flex justify-center gap-2">

                                <button
                                    class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg transition shadow-md">

                                    Editar

                                </button>

                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                    Eliminar

                                </button>

                            </div>

                        </td>
                    </tr>

                    <!-- Empresa 3 -->
                    <tr class="hover:bg-gray-50 transition">

                        <td class="py-5 font-medium">
                            Logística S.A.
                        </td>

                        <td>

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Suspendida

                            </span>

                        </td>

                        <td>
                            0
                        </td>

                        <td class="py-5">

                            <div class="flex justify-center gap-2">

                                <button
                                    class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg transition shadow-md">

                                    Editar

                                </button>

                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                    Eliminar

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</x-admin-layout>
