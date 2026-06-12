<x-empresa-layout>

    <div class="space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Antecedentes Recibidos</h1>
            <p class="text-gray-500 mt-1">Talentos enviados por el equipo de ProviEmplea para tu consideración.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- FILTRO -->
        <form method="GET" action="{{ route('empresa.antecedentes') }}">
            <div class="bg-white p-4 rounded-2xl shadow border border-gray-100 flex flex-wrap items-center gap-3">
                <select name="estado"
                    class="h-11 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm px-3">
                    <option value="">Todos los estados</option>
                    <option value="contactado"   {{ request('estado') == 'contactado'   ? 'selected' : '' }}>Recibido</option>
                    <option value="entrevista"   {{ request('estado') == 'entrevista'   ? 'selected' : '' }}>Entrevista</option>
                    <option value="seleccionado" {{ request('estado') == 'seleccionado' ? 'selected' : '' }}>Seleccionado</option>
                    <option value="rechazado"    {{ request('estado') == 'rechazado'    ? 'selected' : '' }}>No Seleccionado</option>
                    <option value="contratado"   {{ request('estado') == 'contratado'   ? 'selected' : '' }}>Contratado</option>
                </select>
                <button type="submit"
                    class="h-11 bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-xl font-semibold transition text-sm">
                    Filtrar
                </button>
                @if(request()->filled('estado'))
                    <a href="{{ route('empresa.antecedentes') }}"
                        class="h-11 flex items-center px-4 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition text-sm">
                        Limpiar
                    </a>
                @endif
                <p class="ml-auto text-sm text-gray-500">{{ $antecedentes->total() }} talento(s)</p>
            </div>
        </form>

        <!-- CARDS -->
        @forelse($antecedentes as $item)
            @php
                $talento = $item->talento;
                $edu     = $talento?->antecedentesEducacionales?->sortByDesc('egreso')->first();
            @endphp

            <div class="bg-white rounded-2xl shadow border border-gray-100 p-6">
                <div class="flex flex-col md:flex-row md:items-start gap-6">

                    <!-- AVATAR + INFO BÁSICA -->
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white text-xl font-bold shrink-0">
                            {{ strtoupper(substr($talento?->user?->name ?? '?', 0, 1)) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <h2 class="text-lg font-bold text-gray-800">{{ $talento?->user?->name ?? '—' }}</h2>
                                @if($talento?->discapacidad)
                                    <span class="bg-blue-50 text-blue-600 border border-blue-200 px-2 py-0.5 rounded-full text-xs font-semibold">Ley 21.015</span>
                                @endif
                                <span class="{{ $item->estado_color }} px-2.5 py-0.5 rounded-full text-xs font-semibold">
                                    {{ $item->estado_texto }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-500">{{ $talento?->user?->email ?? '—' }}</p>

                            @if($talento?->condicion_modalidad)
                                <p class="text-sm text-gray-500 mt-0.5">
                                    {{ $talento->condicion_modalidad }} · {{ $talento->condicion_jornada }}
                                    @if(($talento->renta_desde ?? 0) > 0)
                                        · Renta desde ${{ number_format($talento->renta_desde, 0, ',', '.') }}
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- FECHA -->
                    <div class="text-right shrink-0">
                        <p class="text-xs text-gray-400">Recibido el</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $item->fecha_contacto?->format('d/m/Y') ?? $item->created_at->format('d/m/Y') }}</p>
                    </div>

                </div>

                <!-- SEPARADOR -->
                <div class="border-t my-4"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- FORMACIÓN -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Formación</p>
                        @if($edu)
                            <p class="text-sm font-medium text-gray-800">{{ $edu->titulo ?? '—' }}</p>
                            <p class="text-xs text-gray-500">{{ $edu->nombre_institucion ?? '' }}</p>
                            @if($edu->egreso)
                                <p class="text-xs text-gray-400">Egreso: {{ $edu->egreso }}</p>
                            @endif
                        @else
                            <p class="text-sm text-gray-400">Sin información</p>
                        @endif
                    </div>

                    <!-- COMPETENCIAS -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Competencias</p>
                        @if($talento?->competenciasTecnicas?->count())
                            <div class="flex flex-wrap gap-1">
                                @foreach($talento->competenciasTecnicas as $comp)
                                    <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">{{ $comp->nombre_competencia }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-400">Sin información</p>
                        @endif
                    </div>

                    <!-- IDIOMAS -->
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Idiomas</p>
                        @if($talento?->idiomas?->count())
                            <div class="flex flex-wrap gap-1">
                                @foreach($talento->idiomas as $idioma)
                                    <span class="bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded text-xs">{{ $idioma->nombre_idioma }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-400">Sin información</p>
                        @endif
                    </div>

                </div>

                <!-- RESUMEN -->
                @if($talento?->resumen)
                    <div class="mt-4 bg-gray-50 rounded-xl p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Resumen Profesional</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $talento->resumen }}</p>
                    </div>
                @endif

            </div>
        @empty
            <div class="bg-white rounded-2xl shadow border border-gray-100 py-20 text-center text-gray-400">
                <p class="text-lg">No tienes antecedentes recibidos aún.</p>
                <p class="text-sm mt-1">El equipo de ProviEmplea te enviará talentos que coincidan con tu perfil.</p>
            </div>
        @endforelse

        <!-- PAGINACIÓN -->
        @if($antecedentes->hasPages())
            <div>{{ $antecedentes->links() }}</div>
        @endif

    </div>

</x-empresa-layout>
