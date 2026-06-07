<x-talento-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Mis Procesos</h1>
            <p class="text-gray-500 mt-2">Seguimiento de procesos de selección en los que participas.</p>
        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-2 xl:grid-cols-6 gap-4">
            <div class="bg-white rounded-2xl shadow p-6 border">
                <p class="text-gray-500 text-sm">Pendientes</p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-2">{{ $totales['pendiente'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 border">
                <p class="text-gray-500 text-sm">Contactado</p>
                <h2 class="text-4xl font-bold text-blue-600 mt-2">{{ $totales['contactado'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 border">
                <p class="text-gray-500 text-sm">Entrevistas</p>
                <h2 class="text-4xl font-bold text-purple-600 mt-2">{{ $totales['entrevista'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 border">
                <p class="text-gray-500 text-sm">Seleccionado</p>
                <h2 class="text-4xl font-bold text-green-600 mt-2">{{ $totales['seleccionado'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 border">
                <p class="text-gray-500 text-sm">Contratado</p>
                <h2 class="text-4xl font-bold text-emerald-600 mt-2">{{ $totales['contratado'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 border">
                <p class="text-gray-500 text-sm">No Seleccionado</p>
                <h2 class="text-4xl font-bold text-red-500 mt-2">{{ $totales['rechazado'] }}</h2>
            </div>
        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow p-8 border">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Historial de Procesos</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="pb-4">Empresa</th>
                            <th class="pb-4">Estado</th>
                            <th class="pb-4">Notas</th>
                            <th class="pb-4">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($procesos as $proceso)
                            <tr class="border-b hover:bg-gray-50 transition">

                                <!-- EMPRESA (anónima) -->
                                <td class="py-5 font-medium">
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">
                                        Empresa #{{ str_pad($proceso->datos_empresa_id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                <!-- ESTADO -->
                                <td class="py-5">
                                    <span class="{{ $proceso->estado_color }} px-4 py-1 rounded-full text-sm font-semibold">
                                        {{ $proceso->estado_texto }}
                                    </span>
                                </td>

                                <!-- NOTAS -->
                                <td class="py-5 text-gray-500 text-sm">
                                    {{ $proceso->notas ?? '—' }}
                                </td>

                                <!-- FECHA -->
                                <td class="py-5 text-gray-500 text-sm">
                                    {{ $proceso->created_at->format('d/m/Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-16 text-center text-gray-400">
                                    Aún no tienes procesos de selección activos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $procesos->links() }}
            </div>
        </div>

    </div>

</x-talento-layout>
