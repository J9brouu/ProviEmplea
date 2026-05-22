<x-admin-layout>

    <div class="space-y-8">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Dashboard Principal
            </h1>

            <p class="text-gray-500 mt-2">
                Bienvenido al panel administrativo de ProviEmplea.
            </p>
        </div>
        <br>
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-8 rounded-2xl shadow">
                <p class="text-gray-500">
                    Talentos Activos
                </p>

                <h2 class="text-5xl font-bold mt-4">
                    1,240
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow">
                <p class="text-gray-500">
                    Empresas Asociadas
                </p>

                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    85
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow">
                <p class="text-gray-500">
                    Postulaciones
                </p>

                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    320
                </h2>
            </div>

        </div>
        <br>
        <!-- Buscador -->
        <div class="bg-white p-6 rounded-2xl shadow">

            <div class="flex flex-col md:flex-row gap-4 justify-between">

                <input type="text" placeholder="Buscar empresa o talento..."
                    class="w-full md:w-1/2 border border-gray-300 rounded-xl px-4 py-3">

                <div class="flex gap-3">

                    <select class="border border-gray-300 rounded-xl px-8 py-3">

                        <option>
                            Todos los tipos
                        </option>

                        <option>
                            Empresas
                        </option>

                        <option>
                            Talentos
                        </option>

                    </select>

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">

                        Filtrar

                    </button>

                </div>

            </div>

        </div>
        <br>
        <!-- Tabla -->
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-3xl font-bold text-gray-800">
                    Gestión de Organizaciones
                </h2>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                    Ver todas

                </button>

            </div>

            <table class="w-full table-auto">

                <thead>

                    <tr class=" border-b text-gray-500">

                        <th class="pb-4 w-1/3">
                            Empresa
                        </th>

                        <th class="pb-4 w-1/4">
                            Estado
                        </th>

                        <th class="pb-4 w-1/6">
                            Vacantes
                        </th>

                        <th class="pb-4 w-1/4">
                            Clasificación
                        </th>

                    </tr>

                </thead>

                <tbody class="text-gray-700">

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-5 font-medium text-center">
                            TechSolutions Global
                        </td>

                        <td class="text-center">

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-center text-sm ">

                                Verificada

                            </span>

                        </td>

                        <td class="font-semibold text-center">
                            12
                        </td>

                        <td class="text-yellow-500 text-lg tracking-wide text-center">
                            ★★★★★
                        </td>

                    </tr>

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-5 font-medium text-center">
                            Banca Municipal
                        </td>

                        <td class="text-center">

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-center text-sm ">

                                Verificada

                            </span>

                        </td>

                        <td class="font-semibold text-center">
                            8
                        </td>

                        <td class="text-yellow-500 text-lg tracking-wide text-center">
                            ★★★★☆
                        </td>

                    </tr>

                    <tr class="hover:bg-gray-50 transition">

                        <td class="py-5 font-medium text-center">
                            Logística S.A.
                        </td>

                        <td class="text-center">

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-center text-sm">

                                Pendiente

                            </span>

                        </td>

                        <td class="font-semibold text-center">
                            5
                        </td>

                        <td class="text-gray-400 text-center">
                            S/C
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</x-admin-layout>
