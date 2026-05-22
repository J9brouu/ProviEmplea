<x-empresa-layout>

    <div class="space-y-10">

        <!-- Header -->

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Perfil Empresa
            </h1>
            <p class="text-gray-500 mt-2">
                Información general y presentación de la empresa.
            </p>
        </div>

        <!-- Información Empresa -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

            <!-- Banner -->
            <div class="h-44 bg-gradient-to-r from-blue-700 to-indigo-600"></div>

            <!-- Contenido -->
            <div class="px-10 pb-10">

                <!-- Header Empresa -->
                <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-8 -mt-14 relative">

                    <!-- Left -->
                    <div class="flex items-end gap-6">

                        <!-- Logo -->
                        <div
                            class="w-28 h-28 rounded-3xl bg-white shadow-xl border-4 border-white flex items-center justify-center text-5xl font-bold text-blue-700">
                            TS
                        </div>

                        <!-- Info -->
                        <div class="pb-2">
                            <br>
                            <div class="flex items-center gap-3 flex-wrap">

                                <h2 class="text-4xl font-bold text-gray-800">
                                    TechSolutions SpA
                                </h2>
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                                    Empresa Validada
                                </span>
                            </div>
                            <p class="text-gray-500 mt-2 text-lg">
                                Empresa tecnológica especializada en desarrollo de software.
                            </p>
                        </div>
                    </div>

                    <!-- Botón -->
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold transition shadow-lg w-fit">
                        Editar Perfil
                    </button>
                </div>

                <!-- Tags -->
                <div class="flex flex-wrap gap-3 mt-8">
                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-2xl text-sm">
                        Tecnología
                    </span>
                    <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-2xl text-sm">
                        Software
                    </span>
                    <span class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-2xl text-sm">
                        Innovación
                    </span>
                </div>

                <!-- Estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                    <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100">
                        <p class="text-gray-500">
                            Procesos Activos
                        </p>
                        <h3 class="text-4xl font-bold text-blue-600 mt-3">
                            12
                        </h3>
                    </div>
                    <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100">
                        <p class="text-gray-500">
                            Talentos Contactados
                        </p>
                        <h3 class="text-4xl font-bold text-green-600 mt-3">
                            34
                        </h3>
                    </div>
                    <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100">
                        <p class="text-gray-500">
                            Usuarios Empresa
                        </p>
                        <h3 class="text-4xl font-bold text-purple-600 mt-3">
                            8
                        </h3>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-10">

                    <!-- Información -->
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">
                            Información Empresa
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-sm text-gray-500">
                                    RUT Empresa
                                </p>
                                <p class="font-semibold text-gray-800 text-lg">
                                    76.123.456-7
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">
                                    Rubro
                                </p>
                                <p class="font-semibold text-gray-800 text-lg">
                                    Tecnología y Software
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">
                                    Tipo Empresa
                                </p>
                                <p class="font-semibold text-gray-800 text-lg">
                                    Privada
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">
                                    Correo
                                </p>
                                <p class="font-semibold text-gray-800 text-lg">
                                    contacto@techsolutions.cl
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Presentación -->
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">
                            Presentación Empresa
                        </h3>
                        <p class="text-gray-700 leading-relaxed text-lg">
                            TechSolutions es una empresa enfocada en soluciones digitales,
                            desarrollo web, automatización de procesos y consultoría tecnológica.
                            Actualmente participa en procesos de reclutamiento TI y análisis de datos,
                            buscando profesionales innovadores y especializados en tecnologías modernas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-empresa-layout>
