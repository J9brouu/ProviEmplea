<x-app-layout>

    <h1 class="text-5xl font-bold text-slate-900">
        Seguimiento
    </h1>

    <p class="text-gray-500 mt-2">
        Seguimiento de procesos entre empresas y talentos.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500">
                Procesos Activos
            </p>

            <h2 class="text-5xl font-bold text-blue-600 mt-4">
                48
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500">
                Entrevistas
            </p>

            <h2 class="text-5xl font-bold text-yellow-500 mt-4">
                16
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500">
                Contratados
            </p>

            <h2 class="text-5xl font-bold text-green-600 mt-4">
                21
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-gray-500">
                Finalizados
            </p>

            <h2 class="text-5xl font-bold text-red-500 mt-4">
                11
            </h2>

        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6 mt-8">

        <h2 class="text-3xl font-bold text-slate-900 mb-6">
            Procesos en Seguimiento
        </h2>

        <table class="w-full">

            <thead>

                <tr class="border-b text-gray-500">

                    <th class="text-left py-4">
                        Talento
                    </th>

                    <th class="text-left py-4">
                        Empresa
                    </th>

                    <th class="text-left py-4">
                        Estado
                    </th>

                    <th class="text-left py-4">
                        Última actualización
                    </th>

                    <th class="text-left py-4">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                <tr class="border-b">

                    <td class="py-4">
                        Jonathan Ortiz
                    </td>

                    <td>
                        TechSolutions
                    </td>

                    <td>

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                            Entrevista
                        </span>

                    </td>

                    <td>
                        20/05/2026
                    </td>

                    <td class="flex gap-2 py-4">

                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Ver
                        </button>

                    </td>

                </tr>

                <tr>

                    <td class="py-4">
                        Camila Soto
                    </td>

                    <td>
                        InnovaTech
                    </td>

                    <td>

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Contratado
                        </span>

                    </td>

                    <td>
                        18/05/2026
                    </td>

                    <td class="flex gap-2 py-4">

                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Ver
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</x-app-layout>