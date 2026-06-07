<x-empresa-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Vitrina de Talentos</h1>
            <p class="text-gray-500 mt-2">Encuentra candidatos según tus necesidades. Los perfiles son anónimos.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- FILTROS -->
        <form method="GET" action="{{ route('empresa.talentos') }}" id="filtros-form">
            <div class="bg-white p-6 rounded-2xl shadow border border-gray-100 space-y-4">

                <!-- Fila 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <input type="text" name="carrera" value="{{ request('carrera') }}"
                        placeholder="Carrera o título..."
                        class="h-12 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4">

                    <input type="text" name="competencia" value="{{ request('competencia') }}"
                        placeholder="Competencia técnica..."
                        class="h-12 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4">

                    <select name="idioma" class="h-12 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Idioma</option>
                        <option value="Inglés"    {{ request('idioma') == 'Inglés'    ? 'selected' : '' }}>Inglés</option>
                        <option value="Francés"   {{ request('idioma') == 'Francés'   ? 'selected' : '' }}>Francés</option>
                        <option value="Portugués" {{ request('idioma') == 'Portugués' ? 'selected' : '' }}>Portugués</option>
                        <option value="Alemán"    {{ request('idioma') == 'Alemán'    ? 'selected' : '' }}>Alemán</option>
                        <option value="Italiano"  {{ request('idioma') == 'Italiano'  ? 'selected' : '' }}>Italiano</option>
                        <option value="Mandarín"  {{ request('idioma') == 'Mandarín'  ? 'selected' : '' }}>Mandarín</option>
                    </select>
                </div>

                <!-- Fila 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 items-center">
                    <select name="renta_max" class="h-12 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Renta máxima</option>
                        <option value="500000"  {{ request('renta_max') == '500000'  ? 'selected' : '' }}>Hasta $500.000</option>
                        <option value="700000"  {{ request('renta_max') == '700000'  ? 'selected' : '' }}>Hasta $700.000</option>
                        <option value="1000000" {{ request('renta_max') == '1000000' ? 'selected' : '' }}>Hasta $1.000.000</option>
                        <option value="1500000" {{ request('renta_max') == '1500000' ? 'selected' : '' }}>Hasta $1.500.000</option>
                        <option value="2000000" {{ request('renta_max') == '2000000' ? 'selected' : '' }}>Hasta $2.000.000</option>
                    </select>

                    <select name="modalidad" class="h-12 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Modalidad</option>
                        <option value="Presencial" {{ request('modalidad') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Remoto"     {{ request('modalidad') == 'Remoto'     ? 'selected' : '' }}>Remoto</option>
                        <option value="Híbrido"    {{ request('modalidad') == 'Híbrido'    ? 'selected' : '' }}>Híbrido</option>
                    </select>

                    <select name="jornada" class="h-12 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Jornada</option>
                        <option value="Full-Time"  {{ request('jornada') == 'Full-Time'  ? 'selected' : '' }}>Full-Time</option>
                        <option value="Part-Time"  {{ request('jornada') == 'Part-Time'  ? 'selected' : '' }}>Part-Time</option>
                        <option value="Freelance"  {{ request('jornada') == 'Freelance'  ? 'selected' : '' }}>Freelance</option>
                    </select>

                    <label class="flex items-center gap-2 h-12 px-4 rounded-xl border border-gray-300 cursor-pointer bg-white">
                        <input type="checkbox" name="discapacidad" value="1" {{ request('discapacidad') ? 'checked' : '' }}
                            class="rounded text-blue-600">
                        <span class="text-sm text-gray-600">♿ Ley 21.015</span>
                    </label>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">
                            Filtrar
                        </button>
                        @if(request()->anyFilled(['modalidad','jornada','competencia','idioma','discapacidad','carrera','renta_max']))
                            <a href="{{ route('empresa.talentos') }}" class="flex items-center justify-center h-12 px-4 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition text-sm">
                                Limpiar
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </form>

        <!-- FORM SOLICITUD -->
        <form method="POST" action="{{ route('empresa.talentos.solicitar') }}" id="form-solicitud">
            @csrf

            @if($talentos->count() > 0)
                <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                    <p class="text-gray-500 text-sm">
                        {{ $talentos->total() }} talento(s) encontrado(s)
                        — <span id="contador-seleccionados" class="font-semibold text-blue-600">0 seleccionado(s)</span>
                    </p>
                    <button type="submit" id="btn-solicitar"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition hidden">
                        Enviar Solicitud de Contacto
                    </button>
                </div>
            @endif

            <!-- CARDS CV CIEGO -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($talentos as $talento)
                    @php
                        $yaSolicitado = in_array($talento->id, $solicitados);
                        $edu = $talento->antecedentesEducacionales->sortByDesc('egreso')->first();
                    @endphp

                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6 border border-gray-100 relative
                        {{ $yaSolicitado ? 'opacity-75' : '' }}">

                        @if(!$yaSolicitado)
                            <label class="absolute top-4 right-4 cursor-pointer">
                                <input type="checkbox" name="talentos[]" value="{{ $talento->id }}"
                                    class="talent-check w-5 h-5 rounded text-blue-600 cursor-pointer">
                            </label>
                        @else
                            <span class="absolute top-4 right-4 bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-semibold">
                                Solicitado
                            </span>
                        @endif

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                            Talento #{{ str_pad($talento->id, 4, '0', STR_PAD_LEFT) }}
                        </span>

                        <h2 class="text-xl font-bold text-gray-800 mt-4">
                            {{ $edu?->titulo ?? 'Sin título registrado' }}
                        </h2>

                        @if($edu?->nombre_institucion)
                            <p class="text-gray-500 text-sm mt-1">{{ $edu->nombre_institucion }}</p>
                        @endif

                        @if($talento->resumen)
                            <p class="text-gray-600 text-sm mt-4 leading-relaxed line-clamp-3">
                                {{ $talento->resumen }}
                            </p>
                        @endif

                        <div class="mt-4 space-y-2 text-gray-600 text-sm">
                            @if($talento->condicion_modalidad || $talento->condicion_jornada)
                                <div class="flex items-center gap-2">
                                    <span>{{ $talento->condicion_modalidad ?? '—' }} · {{ $talento->condicion_jornada ?? '—' }}</span>
                                </div>
                            @endif
                            @if(($talento->renta_desde ?? 0) > 0)
                                <div class="flex items-center gap-2">
                                    <span>$ {{ number_format($talento->renta_desde, 0, ',', '.') }}
                                        @if(($talento->renta_hasta ?? 0) > 0) — $ {{ number_format($talento->renta_hasta, 0, ',', '.') }} @endif
                                    </span>
                                </div>
                            @endif
                            @if($talento->discapacidad)
                                <div class="flex items-center gap-2">
                                    <span>♿</span><span>Ley 21.015</span>
                                </div>
                            @endif
                        </div>

                        @if($talento->idiomas->count())
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($talento->idiomas as $idioma)
                                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-xl text-xs font-medium">
                                        🌎 {{ $idioma->nombre_idioma }} · {{ $idioma->nivel }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        @if($talento->competenciasTecnicas->count())
                            <div class="flex flex-wrap gap-2 mt-3">
                                @foreach($talento->competenciasTecnicas->take(4) as $comp)
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-xl text-xs font-medium">
                                        {{ $comp->nombre_competencia }}
                                    </span>
                                @endforeach
                                @if($talento->competenciasTecnicas->count() > 4)
                                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-xl text-xs">
                                        +{{ $talento->competenciasTecnicas->count() - 4 }} más
                                    </span>
                                @endif
                            </div>
                        @endif

                    </div>

                @empty
                    <div class="col-span-3 py-20 text-center text-gray-500">
                        No se encontraron talentos con los filtros seleccionados.
                    </div>
                @endforelse

            </div>
        </form>

        @if($talentos->hasPages())
            <div class="mt-6">{{ $talentos->links() }}</div>
        @endif

    </div>

    <script>
        const checks = document.querySelectorAll('.talent-check');
        const contador = document.getElementById('contador-seleccionados');
        const btnSolicitar = document.getElementById('btn-solicitar');
        checks.forEach(c => c.addEventListener('change', () => {
            const total = document.querySelectorAll('.talent-check:checked').length;
            if (contador) contador.textContent = total + ' seleccionado(s)';
            if (btnSolicitar) btnSolicitar.classList.toggle('hidden', total === 0);
        }));
    </script>

</x-empresa-layout>
