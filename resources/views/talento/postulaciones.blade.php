<x-app-layout>

    <div class="space-y-8">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Mis Postulaciones
            </h1>

            <p class="text-gray-500 mt-2">
                Seguimiento de ofertas laborales postuladas.
            </p>

        </div>

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

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm">
                                    En revisión
                                </span>

                            </td>

                            <td class="py-5">
                                18/05/2026
                            </td>

                            <td class="py-5 text-center">

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Ver Oferta
                                </button>

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
                                Híbrido
                            </td>

                            <td class="py-5">

                                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                                    Aprobado
                                </span>

                            </td>

                            <td class="py-5">
                                10/05/2026
                            </td>

                            <td class="py-5 text-center">

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Ver Oferta
                                </button>

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
                                Presencial
                            </td>

                            <td class="py-5">

                                <span class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm">
                                    Rechazado
                                </span>

                            </td>

                            <td class="py-5">
                                02/05/2026
                            </td>

                            <td class="py-5 text-center">

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Ver Oferta
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>