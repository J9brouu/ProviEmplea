<x-admin-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Dashboard Principal
            </h1>

            <p class="text-gray-500 mt-2">
                Bienvenido al panel administrativo de ProviEmplea.
            </p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Talentos Activos
                </p>

                <h2 class="text-5xl font-bold mt-4 text-gray-900">
                    {{ $totalTalentos }}
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Empresas Asociadas
                </p>

                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    {{ $totalEmpresas }}
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Usuarios Registrados
                </p>

                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    {{ $totalUsuarios }}
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Postulaciones
                </p>

                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    {{ $totalPostulaciones }}
                </h2>
            </div>

        </div>

        <!-- Tablas -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- Empresas -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex justify-between items-center mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">
                        Empresas Recientes
                    </h2>

                    <a href="{{ route('admin.empresas') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">

                        Ver todas

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>

                            <tr class="border-b border-gray-200 text-gray-500 text-sm">

                                <th class="py-4 text-left">
                                    Empresa
                                </th>

                                <th class="py-4 text-center">
                                    Estado
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($empresas as $empresa)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                    <td class="py-5">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="w-11 h-11 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">

                                                {{ substr($empresa->user->name, 0, 1) }}

                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-900">
                                                    {{ $empresa->user->name }}
                                                </p>

                                                <p class="text-sm text-gray-500">
                                                    {{ $empresa->rubro_empresa }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="text-center">

                                        @if ($empresa->validacion)
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">

                                                Verificada

                                            </span>
                                        @else
                                            <span
                                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                                Pendiente
                                            </span>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Usuarios -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex justify-between items-center mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">
                        Talentos Recientes
                    </h2>
                    <a href="{{ route('admin.talentos') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">
                        Ver todas
                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>
                            <tr>
                                <th class="pb-4 text-left text-sm font-semibold text-gray-500">
                                    Usuario
                                </th>

                                <th class="pb-4 text-center text-sm font-semibold text-gray-500">
                                    Jornada
                                </th>

                                <th class="pb-4 text-center text-sm font-semibold text-gray-500">
                                    Modalidad
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($talentos as $talento)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                    <td class="py-5">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="w-11 h-11 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center font-bold">

                                                {{ substr($talento->user?->name ?? 'T', 0, 1) }}
                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-900">
                                                    {{ $talento->user?->name }}
                                                </p>

                                                <p class="text-sm text-gray-500">
                                                    {{ $talento->user?->email }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="py-4 text-center">
                                        <span class="text-sm text-gray-700">
                                            {{ $talento->condicion_jornada }}
                                        </span>
                                    </td>

                                    <td class="py-4 text-center">
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                            {{ $talento->condicion_modalidad }}
                                        </span>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-admin-layout>
