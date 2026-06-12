<x-talento-layout>
    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">
                Dashboard Talento
            </h1>
            <p class="text-gray-500 mt-2">
                Resumen general de perfil y procesos activos.
            </p>
        </div>

        <!-- Completitud del perfil -->
        @php
            $color = $completitud >= 80 ? 'bg-green-500' : ($completitud >= 50 ? 'bg-blue-500' : 'bg-yellow-500');
            $texto = $completitud >= 80 ? 'Perfil sólido' : ($completitud >= 50 ? 'En progreso' : 'Completa tu perfil');
        @endphp
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-sm">Completitud del perfil</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $completitud }}%</p>
                </div>
                <span class="text-sm font-semibold px-3 py-1 rounded-full
                    {{ $completitud >= 80 ? 'bg-green-100 text-green-700' : ($completitud >= 50 ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ $texto }}
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="{{ $color }} h-3 rounded-full transition-all duration-500" style="width: {{ $completitud }}%"></div>
            </div>
            @if($completitud < 100)
                <a href="{{ route('talento.perfil') }}" class="text-sm text-blue-600 hover:underline mt-3 block">
                    Completar perfil →
                </a>
            @endif
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">Contactados</p>
                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    {{ $totales['contactado'] }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">Entrevistas</p>
                <h2 class="text-5xl font-bold text-yellow-500 mt-4">
                    {{ $totales['entrevista'] }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">Seleccionados</p>
                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    {{ $totales['seleccionado'] }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">Documentos</p>
                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    {{ $documentos->count() }}
                </h2>
            </div>

        </div>

        <!-- Últimos procesos -->
        <div class="bg-white rounded-2xl shadow p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">
                    Últimos Procesos
                </h2>
                <a href="{{ route('talento.procesos') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    Ver todos
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="pb-4">Empresa</th>
                            <th class="pb-4">Estado</th>
                            <th class="pb-4">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($procesos as $proceso)
                            <tr class="border-b">
                                <td class="py-5">
                                    {{ $proceso->datosEmpresa?->user?->name ?? 'Empresa #'.$proceso->datos_empresa_id }}
                                </td>
                                <td class="py-5">
                                    <span class="{{ $proceso->estado_color }} px-4 py-1 rounded-full text-sm">
                                        {{ $proceso->estado_texto }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    {{ $proceso->created_at?->format('d/m/Y') ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-10 text-center text-gray-500">
                                    Aún no tienes procesos activos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-talento-layout>
