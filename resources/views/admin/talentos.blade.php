<x-app-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-5xl font-bold text-gray-800">
                    Gestión de Talentos
                </h1>

                <p class="text-gray-500 mt-2">
                    Administración de perfiles registrados.
                </p>

            </div>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow transition">

                Nuevo Talento

            </button>

        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-2xl shadow p-8">

            <table class="w-full text-left">

                <thead>

                    <tr class="border-b text-gray-500">

                        <th class="pb-4 text-center">Nombre</th>
                        <th class="pb-4 text-center">Especialidad</th>
                        <th class="pb-4 text-center">Estado</th>
                        <th class="pb-4 text-center">Experiencia</th>
                        <th class="pb-4 text-center">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b">

                        <td class="py-5 text-center">
                            Jonathan Ortiz
                        </td>

                        <td class="py-5 text-center">
                            Frontend Developer
                        </td>

                        <td class="py-5 text-center">

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Activo

                            </span>

                        </td>

                        <td class="py-5 text-center">
                            Junior
                        </td>

                        <td class="py-5 text-center">

                            <div class="flex justify-center gap-2">

                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                    Ver

                                </button>

                                <button
                                    class="bg-green-400 hover:bg-green-500 text-black px-4 py-2 rounded-lg transition">

                                    Editar

                                </button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td class="py-5 text-center">
                            Camila Soto
                        </td>

                        <td class="py-5 text-center">
                            UX/UI Designer
                        </td>

                        <td class="py-5 text-center">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                Verificado

                            </span>

                        </td>

                        <td class="py-5 text-center">
                            Senior
                        </td>

                        <td class="py-5 text-center">

                            <div class="flex justify-center gap-2">

                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                    Ver

                                </button>

                                <button
                                    class="bg-green-400 hover:bg-green-500 text-black px-4 py-2 rounded-lg transition">

                                    Editar

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>