<x-empresa-layout>

    <div class="space-y-10">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Documentos Empresa
            </h1>
            <p class="text-gray-500 mt-2">
                Gestión de documentos corporativos y archivos internos.
            </p>
        </div>

        <!-- Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Documentos Totales
                </p>
                <h2 class="text-4xl font-bold text-blue-600 mt-3">
                    14
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Documentos Validados
                </p>
                <h2 class="text-4xl font-bold text-green-600 mt-3">
                    10
                </h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
                <p class="text-gray-500">
                    Pendientes
                </p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-3">
                    4
                </h2>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">

            <!-- Header tabla -->
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Archivos Empresa
                    </h2>
                    <p class="text-gray-500 mt-1">
                        Administración de documentos subidos al sistema.
                    </p>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-medium transition">
                    Subir Documento
                </button>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Documento
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Tipo
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Fecha
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-gray-600 font-semibold">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Escritura Empresa.pdf
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        Documento Legal
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                PDF
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                21/05/2026
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Validado
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver
                                </button>
                            </td>
                        </tr>

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Logo_Empresa.png
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        Imagen Corporativa
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                PNG
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                18/05/2026
                            </td>
                            <td class="px-6 py-5">
                                <spanclass="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Pendiente
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver
                                </button>
                            </td>
                        </tr>

                        <!-- FILA -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5">
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        Certificado_SII.pdf
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        Validación Tributaria
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                PDF
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                15/05/2026
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Validado
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-2xl transition">
                                    Ver
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-empresa-layout>