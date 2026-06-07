<x-empresa-layout>

    <div class="space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Procesos de Selección</h1>
            <p class="text-gray-500 mt-1">Seguimiento de talentos contactados y procesos activos.</p>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-2">Pendientes</p>
                <h2 class="text-3xl font-bold text-yellow-500">{{ $totales['pendiente'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-2">Contactados</p>
                <h2 class="text-3xl font-bold text-green-600">{{ $totales['contactado'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-2">Entrevistas</p>
                <h2 class="text-3xl font-bold text-purple-600">{{ $totales['entrevista'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-2">Seleccionados</p>
                <h2 class="text-3xl font-bold text-blue-600">{{ $totales['seleccionado'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-2">No Seleccionados</p>
                <h2 class="text-3xl font-bold text-red-500">{{ $totales['rechazado'] }}</h2>
            </div>
        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Mis Procesos</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Talento</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Formación</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Competencias</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Notas</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($procesos as $proceso)
                            @php $edu = $proceso->talento?->antecedentesEducacionales?->sortByDesc('egreso')->first(); @endphp
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        Talento #{{ str_pad($proceso->talento_id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $proceso->talento?->condicion_modalidad ?? '—' }} · {{ $proceso->talento?->condicion_jornada ?? '—' }}
                                    </p>
                                </td>

                                <td class="px-6 py-4">
                                    @if($edu)
                                        <p class="text-sm font-medium text-gray-700">{{ $edu->titulo ?? '—' }}</p>
                                        <p class="text-xs text-gray-400">{{ $edu->nombre_institucion ?? '' }}</p>
                                    @else
                                        <span class="text-gray-400 text-sm">—</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($proceso->talento?->competenciasTecnicas?->take(3) ?? [] as $comp)
                                            <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-xs">{{ $comp->nombre_competencia }}</span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="{{ $proceso->estado_color }} px-2.5 py-1 rounded-full text-xs font-semibold">
                                        {{ $proceso->estado_texto }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 max-w-[150px] truncate">
                                    {{ $proceso->notas ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $proceso->created_at->format('d/m/Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                                    No tienes procesos activos.
                                    <a href="{{ route('empresa.talentos') }}" class="text-blue-600 hover:underline ml-1">Solicita contactos →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t bg-gray-50">
                {{ $procesos->links() }}
            </div>
        </div>

    </div>

</x-empresa-layout>
