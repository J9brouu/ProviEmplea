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

                        $cvData = [
                            'codigo'      => 'Talento #' . str_pad($talento->id, 4, '0', STR_PAD_LEFT),
                            'resumen'     => $talento->resumen ?? '',
                            'jornada'     => $talento->condicion_jornada ?? '',
                            'modalidad'   => $talento->condicion_modalidad ?? '',
                            'renta_desde' => $talento->renta_desde ?? 0,
                            'renta_hasta' => $talento->renta_hasta ?? 0,
                            'discapacidad'=> (bool) $talento->discapacidad,
                            'educacion'   => $talento->antecedentesEducacionales->sortByDesc('egreso')->map(fn($e) => [
                                'titulo'       => $e->titulo,
                                'institucion'  => $e->nombre_institucion,
                                'ingreso'      => $e->ingreso ? \Carbon\Carbon::parse($e->ingreso)->format('Y') : '',
                                'egreso'       => $e->egreso ? \Carbon\Carbon::parse($e->egreso)->format('Y') : 'En curso',
                                'completo'     => $e->completo,
                            ])->values()->toArray(),
                            'experiencia' => $talento->antecedentesLaborales->sortByDesc('egreso')->map(fn($l) => [
                                'empresa'  => $l->institucion_o_empresa,
                                'cargo'    => $l->cargo,
                                'funciones'=> $l->funciones,
                                'ingreso'  => $l->ingreso ? \Carbon\Carbon::parse($l->ingreso)->format('M Y') : '',
                                'egreso'   => $l->egreso ? \Carbon\Carbon::parse($l->egreso)->format('M Y') : 'Actualidad',
                            ])->values()->toArray(),
                            'perfeccionamiento' => $talento->perfeccionamientos->map(fn($p) => [
                                'nombre'      => $p->nombre_curso,
                                'institucion' => $p->institucion,
                                'tipo'        => $p->tipo,
                                'egreso'      => $p->egreso ? \Carbon\Carbon::parse($p->egreso)->format('Y') : '',
                            ])->values()->toArray(),
                            'competencias'=> $talento->competenciasTecnicas->pluck('nombre_competencia')->toArray(),
                            'idiomas'     => $talento->idiomas->map(fn($i) => $i->nombre_idioma . ' · ' . $i->nivel)->toArray(),
                        ];
                    @endphp

                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition-shadow duration-300 border border-gray-100 flex flex-col overflow-hidden
                        {{ $yaSolicitado ? 'opacity-70' : '' }}"
                        data-cv="{{ json_encode($cvData) }}">

                        {{-- Franja superior con código y checkbox --}}
                        <div class="flex items-center justify-between px-5 pt-5 pb-3">
                            <span class="bg-blue-50 text-blue-600 border border-blue-100 px-3 py-1 rounded-full text-xs font-bold tracking-wide">
                                Talento #{{ str_pad($talento->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            @if(!$yaSolicitado)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="talentos[]" value="{{ $talento->id }}"
                                        class="talent-check w-5 h-5 rounded text-blue-600 cursor-pointer">
                                </label>
                            @else
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">
                                    Solicitado
                                </span>
                            @endif
                        </div>

                        {{-- Cuerpo del card --}}
                        <div class="px-5 pb-5 flex flex-col flex-1">

                            {{-- Título y organización --}}
                            <div class="mb-4">
                                <h2 class="text-lg font-bold text-gray-900 leading-snug">
                                    {{ $edu?->titulo ?? 'Sin título registrado' }}
                                </h2>
                                @if($edu?->nombre_institucion)
                                    <p class="text-gray-400 text-sm mt-0.5">{{ $edu->nombre_institucion }}</p>
                                @endif
                            </div>

                            {{-- Resumen --}}
                            @if($talento->resumen)
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4">
                                    {{ $talento->resumen }}
                                </p>
                            @endif

                            {{-- Condiciones en pills --}}
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if($talento->condicion_modalidad)
                                    <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">
                                        {{ $talento->condicion_modalidad }}
                                    </span>
                                @endif
                                @if($talento->condicion_jornada)
                                    <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">
                                        {{ $talento->condicion_jornada }}
                                    </span>
                                @endif
                                @if(($talento->renta_desde ?? 0) > 0)
                                    <span class="bg-green-50 text-green-700 text-xs px-3 py-1 rounded-full font-medium">
                                        $ {{ number_format($talento->renta_desde, 0, ',', '.') }}
                                        @if(($talento->renta_hasta ?? 0) > 0)
                                            — $ {{ number_format($talento->renta_hasta, 0, ',', '.') }}
                                        @endif
                                    </span>
                                @endif
                                @if($talento->discapacidad)
                                    <span class="bg-purple-50 text-purple-700 text-xs px-3 py-1 rounded-full font-medium">
                                        Ley 21.015
                                    </span>
                                @endif
                            </div>

                            {{-- Idiomas --}}
                            @if($talento->idiomas->count())
                                <div class="flex flex-wrap gap-1.5 mb-3">
                                    @foreach($talento->idiomas as $idioma)
                                        <span class="bg-indigo-50 text-indigo-600 border border-indigo-100 px-2.5 py-1 rounded-lg text-xs font-medium">
                                            {{ $idioma->nombre_idioma }} · {{ $idioma->nivel }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Competencias --}}
                            @if($talento->competenciasTecnicas->count())
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    @foreach($talento->competenciasTecnicas->take(4) as $comp)
                                        <span class="bg-blue-50 text-blue-600 border border-blue-100 px-2.5 py-1 rounded-lg text-xs font-medium">
                                            {{ $comp->nombre_competencia }}
                                        </span>
                                    @endforeach
                                    @if($talento->competenciasTecnicas->count() > 4)
                                        <span class="bg-gray-100 text-gray-400 px-2.5 py-1 rounded-lg text-xs">
                                            +{{ $talento->competenciasTecnicas->count() - 4 }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            {{-- Botón siempre al fondo --}}
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <button type="button" onclick="abrirCV(this.closest('[data-cv]'))"
                                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-xl transition">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Ver CV completo
                                </button>
                            </div>

                        </div>

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

    <!-- MODAL CV CIEGO -->
    <div id="modalCV" class="fixed inset-0 hidden items-center justify-center bg-black/60 backdrop-blur-sm z-50 p-4">
        <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl flex flex-col max-h-[90vh]">

            <!-- Header fijo -->
            <div class="flex items-center justify-between px-8 pt-8 pb-4 border-b border-gray-100 shrink-0">
                <div>
                    <span id="cv-codigo" class="text-xs font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full"></span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-2">CV Profesional</h2>
                </div>
                <button onclick="cerrarCV()"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition shrink-0">
                    &times;
                </button>
            </div>

            <!-- Contenido scrollable -->
            <div class="overflow-y-auto px-8 py-6 space-y-6 text-sm">

                <!-- Condiciones -->
                <div id="cv-condiciones" class="flex flex-wrap gap-3"></div>

                <!-- Resumen -->
                <div id="cv-bloque-resumen" class="hidden">
                    <h3 class="font-bold text-gray-700 mb-2 uppercase tracking-wide text-xs">Resumen Profesional</h3>
                    <p id="cv-resumen" class="text-gray-600 leading-relaxed"></p>
                </div>

                <!-- Experiencia -->
                <div id="cv-bloque-experiencia" class="hidden">
                    <h3 class="font-bold text-gray-700 mb-3 uppercase tracking-wide text-xs">Experiencia Laboral</h3>
                    <div id="cv-experiencia" class="space-y-4"></div>
                </div>

                <!-- Educación -->
                <div id="cv-bloque-educacion" class="hidden">
                    <h3 class="font-bold text-gray-700 mb-3 uppercase tracking-wide text-xs">Formación</h3>
                    <div id="cv-educacion" class="space-y-3"></div>
                </div>

                <!-- Perfeccionamiento -->
                <div id="cv-bloque-perfec" class="hidden">
                    <h3 class="font-bold text-gray-700 mb-3 uppercase tracking-wide text-xs">Cursos y Perfeccionamiento</h3>
                    <div id="cv-perfec" class="space-y-2"></div>
                </div>

                <!-- Competencias -->
                <div id="cv-bloque-comp" class="hidden">
                    <h3 class="font-bold text-gray-700 mb-3 uppercase tracking-wide text-xs">Competencias Técnicas</h3>
                    <div id="cv-competencias" class="flex flex-wrap gap-2"></div>
                </div>

                <!-- Idiomas -->
                <div id="cv-bloque-idiomas" class="hidden">
                    <h3 class="font-bold text-gray-700 mb-3 uppercase tracking-wide text-xs">Idiomas</h3>
                    <div id="cv-idiomas" class="flex flex-wrap gap-2"></div>
                </div>

                <!-- Discapacidad -->
                <div id="cv-bloque-disc" class="hidden">
                    <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-xl text-sm font-semibold">
                        ♿ Candidato con discapacidad — Ley 21.015
                    </span>
                </div>

            </div>

            <!-- Footer -->
            <div class="px-8 py-5 border-t border-gray-100 shrink-0">
                <button onclick="cerrarCV()"
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-2xl transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Checkboxes selección
        const checks = document.querySelectorAll('.talent-check');
        const contador = document.getElementById('contador-seleccionados');
        const btnSolicitar = document.getElementById('btn-solicitar');
        checks.forEach(c => c.addEventListener('change', () => {
            const total = document.querySelectorAll('.talent-check:checked').length;
            if (contador) contador.textContent = total + ' seleccionado(s)';
            if (btnSolicitar) btnSolicitar.classList.toggle('hidden', total === 0);
        }));

        // Modal CV ciego
        function abrirCV(card) {
            const cv = JSON.parse(card.dataset.cv);
            const m  = document.getElementById('modalCV');

            document.getElementById('cv-codigo').textContent = cv.codigo;

            // Condiciones
            const cond = document.getElementById('cv-condiciones');
            cond.innerHTML = '';
            if (cv.modalidad) cond.innerHTML += `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">${cv.modalidad}</span>`;
            if (cv.jornada)   cond.innerHTML += `<span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">${cv.jornada}</span>`;
            if (cv.renta_desde > 0) {
                let renta = `$ ${cv.renta_desde.toLocaleString('es-CL')}`;
                if (cv.renta_hasta > 0) renta += ` — $ ${cv.renta_hasta.toLocaleString('es-CL')}`;
                cond.innerHTML += `<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">${renta}</span>`;
            }

            // Resumen
            mostrarBloque('cv-bloque-resumen', cv.resumen, () => {
                document.getElementById('cv-resumen').textContent = cv.resumen;
            });

            // Experiencia
            mostrarBloque('cv-bloque-experiencia', cv.experiencia?.length, () => {
                document.getElementById('cv-experiencia').innerHTML = cv.experiencia.map(e =>
                    `<div class="border-l-2 border-blue-200 pl-4">
                        <p class="font-semibold text-gray-800">${e.cargo} <span class="text-gray-400 font-normal">· ${e.empresa}</span></p>
                        <p class="text-gray-400 text-xs mb-1">${e.ingreso} — ${e.egreso}</p>
                        ${e.funciones ? `<p class="text-gray-600">${e.funciones}</p>` : ''}
                    </div>`
                ).join('');
            });

            // Educación
            mostrarBloque('cv-bloque-educacion', cv.educacion?.length, () => {
                document.getElementById('cv-educacion').innerHTML = cv.educacion.map(e =>
                    `<div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-gray-800">${e.titulo}</p>
                            <p class="text-gray-500">${e.institucion}</p>
                        </div>
                        <span class="text-xs text-gray-400 whitespace-nowrap ml-4">${e.ingreso} — ${e.egreso}</span>
                    </div>`
                ).join('');
            });

            // Perfeccionamiento
            mostrarBloque('cv-bloque-perfec', cv.perfeccionamiento?.length, () => {
                document.getElementById('cv-perfec').innerHTML = cv.perfeccionamiento.map(p =>
                    `<div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800 font-medium">${p.nombre}</span>
                            <span class="text-gray-500 text-xs ml-2">${p.institucion}</span>
                        </div>
                        ${p.egreso ? `<span class="text-xs text-gray-400">${p.egreso}</span>` : ''}
                    </div>`
                ).join('');
            });

            // Competencias
            mostrarBloque('cv-bloque-comp', cv.competencias?.length, () => {
                document.getElementById('cv-competencias').innerHTML = cv.competencias.map(c =>
                    `<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-xl text-xs font-medium">${c}</span>`
                ).join('');
            });

            // Idiomas
            mostrarBloque('cv-bloque-idiomas', cv.idiomas?.length, () => {
                document.getElementById('cv-idiomas').innerHTML = cv.idiomas.map(i =>
                    `<span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-xl text-xs font-medium">🌎 ${i}</span>`
                ).join('');
            });

            // Discapacidad
            const disc = document.getElementById('cv-bloque-disc');
            disc.classList.toggle('hidden', !cv.discapacidad);

            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function cerrarCV() {
            const m = document.getElementById('modalCV');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function mostrarBloque(id, condicion, fn) {
            const el = document.getElementById(id);
            if (condicion) { el.classList.remove('hidden'); fn(); }
            else { el.classList.add('hidden'); }
        }

        document.getElementById('modalCV').addEventListener('click', function(e) {
            if (e.target === this) cerrarCV();
        });
    </script>

</x-empresa-layout>
