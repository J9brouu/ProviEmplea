<x-talento-layout>

    <div class="space-y-8">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-5xl font-bold text-gray-800">
                    Documentos
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestión de documentos y archivos del talento.
                </p>

            </div>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition shadow">

                Subir Documento

            </button>

        </div>

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-left text-gray-500">

                            <th class="pb-4">
                                Documento
                            </th>

                            <th class="pb-4">
                                Tipo
                            </th>

                            <th class="pb-4">
                                Fecha
                            </th>

                            <th class="pb-4">
                                Estado
                            </th>

                            <th class="pb-4 text-center">
                                Acción
                            </th>

                        </tr>

                    </thead>

                    <tbody class="text-gray-700">

                        <tr class="border-b">

                            <td class="py-5">
                                CV_Jonathan_Ortiz.pdf
                            </td>

                            <td class="py-5">
                                Curriculum Vitae
                            </td>

                            <td class="py-5">
                                18/05/2026
                            </td>

                            <td class="py-5">

                                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                                    Validado
                                </span>

                            </td>

                            <td class="py-5 text-center">

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Descargar
                                </button>

                            </td>

                        </tr>

                        <tr class="border-b">

                            <td class="py-5">
                                Certificado_Residencia.pdf
                            </td>

                            <td class="py-5">
                                Certificado
                            </td>

                            <td class="py-5">
                                15/05/2026
                            </td>

                            <td class="py-5">

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm">
                                    Pendiente
                                </span>

                            </td>

                            <td class="py-5 text-center">

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Descargar
                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td class="py-5">
                                Portafolio_UI.pdf
                            </td>

                            <td class="py-5">
                                Portafolio
                            </td>

                            <td class="py-5">
                                10/05/2026
                            </td>

                            <td class="py-5">

                                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                                    Validado
                                </span>

                            </td>

                            <td class="py-5 text-center">

                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                    Descargar
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-talento-layout>