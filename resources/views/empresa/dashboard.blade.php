<x-app-layout>

    <div class="space-y-8">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Dashboard Empresa
            </h1>

            <p class="text-gray-500 mt-2">
                Gestión general de vacantes y postulantes.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Vacantes Activas
                </p>

                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    12
                </h2>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Postulantes
                </p>

                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    84
                </h2>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Entrevistas
                </p>

                <h2 class="text-5xl font-bold text-yellow-500 mt-4">
                    18
                </h2>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Contratados
                </p>

                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    7
                </h2>

            </div>

        </div>
        <div class="bg-white rounded-2xl shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Vacantes Publicadas
            </h2>

            <p class="text-gray-500 mt-1">
                Gestión de ofertas laborales activas.
            </p>

        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

            Nueva Vacante

        </button>

    </div>

    <table class="w-full">

        <thead>

            <tr class="border-b text-gray-500">

                <th class="text-left py-4">
                    Cargo
                </th>

                <th class="text-left py-4">
                    Modalidad
                </th>

                <th class="text-left py-4">
                    Estado
                </th>

                <th class="text-left py-4">
                    Postulantes
                </th>

                <th class="text-center py-4">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            <tr class="border-b">

                <td class="py-5 font-semibold">
                    Desarrollador Frontend
                </td>

                <td>
                    Remoto
                </td>

                <td>

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                        Activa

                    </span>

                </td>

                <td>
                    24
                </td>

                <td class="text-center">

                    <div class="flex justify-center gap-3">

                        <button class="bg-green-400 hover:bg-green-500 text-black px-4 py-2 rounded-lg transition">

                            Editar

                        </button>

                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                            Cerrar

                        </button>

                    </div>

                </td>

            </tr>

            <tr class="border-b">

                <td class="py-5 font-semibold">
                    Diseñador UX/UI
                </td>

                <td>
                    Híbrido
                </td>

                <td>

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                        Pausada

                    </span>

                </td>

                <td>
                    12
                </td>

                <td class="text-center">

                    <div class="flex justify-center gap-3">

                        <button class="bg-green-400 hover:bg-green-500 text-black px-4 py-2 rounded-lg transition">

                            Editar

                        </button>

                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                            Cerrar

                        </button>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

</div>
    </div>

</x-app-layout>