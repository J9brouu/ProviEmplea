<x-admin-layout>

    <h1 class="text-5xl font-bold text-slate-900">
        Validaciones
    </h1>

    <p class="text-gray-500 mt-2">
        Revisión de talentos y empresas pendientes.
    </p>

    <div class="bg-white rounded-2xl shadow p-6 mt-8">

        <table class="w-full">

            <thead>

                <tr class="border-b text-gray-500">

                    <th class="text-left py-4">Nombre</th>
                    <th class="text-left py-4">Tipo</th>
                    <th class="text-left py-4">Estado</th>
                    <th class="text-left py-4">Acciones</th>

                </tr>

            </thead>

            <tbody>

                <tr class="border-b">

                    <td class="py-4">
                        Jonathan Ortiz
                    </td>

                    <td>
                        Talento
                    </td>

                    <td>
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                            Pendiente
                        </span>
                    </td>

                    <td class="flex gap-2 py-4">

                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                            Aprobar
                        </button>

                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                            Rechazar
                        </button>

                    </td>

                </tr>

                <tr>

                    <td class="py-4">
                        TechSolutions
                    </td>

                    <td>
                        Empresa
                    </td>

                    <td>
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                            Pendiente
                        </span>
                    </td>

                    <td class="flex gap-2 py-4">

                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                            Aprobar
                        </button>

                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                            Rechazar
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</x-admin-layout>