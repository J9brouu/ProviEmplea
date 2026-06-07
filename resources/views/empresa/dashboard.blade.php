<x-empresa-layout>

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-wrap justify-between items-start gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-500 mt-1">Bienvenido, <span class="font-semibold text-gray-700">{{ $empresa->user->name }}</span>.</p>
            </div>
            <a href="{{ route('empresa.talentos') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow text-sm">
                Buscar Talentos
            </a>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-sm">Solicitados</p>
                </div>
                <h2 class="text-3xl font-bold text-blue-600">{{ $totales['solicitados'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-sm">En Proceso</p>
                </div>
                <h2 class="text-3xl font-bold text-yellow-500">{{ $totales['activos'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-sm">Seleccionados</p>
                </div>
                <h2 class="text-3xl font-bold text-green-600">{{ $totales['seleccionados'] }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-sm">Usuarios</p>
                </div>
                <h2 class="text-3xl font-bold text-purple-600">{{ $totales['usuarios'] }}</h2>
            </div>
        </div>

        <!-- ÚLTIMOS PROCESOS -->
        <div class="bg-white rounded-2xl shadow border border-gray-100">
            <div class="px-6 py-5 border-b flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Últimos Procesos</h2>
                <a href="{{ route('empresa.procesos') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Ver todos →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[500px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Talento</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Formación</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($procesos as $p)
                            @php $edu = $p->talento?->antecedentesEducacionales?->sortByDesc('egreso')->first(); @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        Talento #{{ str_pad($p->talento_id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $edu?->titulo ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="{{ $p->estado_color }} px-2.5 py-1 rounded-full text-xs font-semibold">
                                        {{ $p->estado_texto }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $p->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                    Aún no tienes procesos.
                                    <a href="{{ route('empresa.talentos') }}" class="text-blue-600 hover:underline ml-1">Busca talentos →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-empresa-layout>
