<x-admin-layout>

    <div class="space-y-6">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Vitrina de Talentos</h1>
            <p class="text-gray-500 mt-1">Busca talentos y envía sus antecedentes a una empresa.</p>
        </div>

        <!-- FILTROS -->
        <form method="GET" action="{{ route('admin.vitrina') }}">
            <div class="bg-white p-6 rounded-2xl shadow border border-gray-100 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                    <input type="text" name="carrera" value="{{ request('carrera') }}"
                        placeholder="Carrera o título..."
                        class="h-11 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 text-sm">

                    <input type="text" name="competencia" value="{{ request('competencia') }}"
                        placeholder="Competencia técnica..."
                        class="h-11 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 text-sm">

                    <select name="modalidad" class="h-11 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Modalidad</option>
                        <option value="Presencial" {{ request('modalidad') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Remoto"     {{ request('modalidad') == 'Remoto'     ? 'selected' : '' }}>Remoto</option>
                        <option value="Híbrido"    {{ request('modalidad') == 'Híbrido'    ? 'selected' : '' }}>Híbrido</option>
                    </select>

                    <select name="jornada" class="h-11 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Jornada</option>
                        <option value="Full-Time"  {{ request('jornada') == 'Full-Time'  ? 'selected' : '' }}>Full-Time</option>
                        <option value="Part-Time"  {{ request('jornada') == 'Part-Time'  ? 'selected' : '' }}>Part-Time</option>
                        <option value="Freelance"  {{ request('jornada') == 'Freelance'  ? 'selected' : '' }}>Freelance</option>
                    </select>

                    <select name="renta_max" class="h-11 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Renta máxima pretendida</option>
                        <option value="500000"  {{ request('renta_max') == '500000'  ? 'selected' : '' }}>Hasta $500.000</option>
                        <option value="700000"  {{ request('renta_max') == '700000'  ? 'selected' : '' }}>Hasta $700.000</option>
                        <option value="1000000" {{ request('renta_max') == '1000000' ? 'selected' : '' }}>Hasta $1.000.000</option>
                        <option value="1500000" {{ request('renta_max') == '1500000' ? 'selected' : '' }}>Hasta $1.500.000</option>
                        <option value="2000000" {{ request('renta_max') == '2000000' ? 'selected' : '' }}>Hasta $2.000.000</option>
                    </select>

                    <div class="flex gap-3 items-center">
                        <label class="flex items-center gap-2 h-11 px-4 rounded-xl border border-gray-300 cursor-pointer bg-white text-sm shrink-0">
                            <input type="checkbox" name="discapacidad" value="1" {{ request('discapacidad') ? 'checked' : '' }}
                                class="rounded text-blue-600">
                            Ley 21.015
                        </label>
                        <button type="submit" class="flex-1 h-11 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition text-sm">
                            Filtrar
                        </button>
                        @if(request()->anyFilled(['carrera','competencia','modalidad','jornada','renta_max','discapacidad']))
                            <a href="{{ route('admin.vitrina') }}" class="h-11 px-4 flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition text-sm">
                                Limpiar
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </form>

        <!-- FORM ENVÍO -->
        <form method="POST" action="{{ route('admin.vitrina.enviar') }}" id="form-envio">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl text-sm">
                    <ul class="list-disc pl-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <!-- Barra de envío (aparece al seleccionar) -->
            <div id="barra-envio" class="hidden bg-blue-600 text-white px-6 py-4 rounded-2xl shadow">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <p class="font-semibold text-sm">
                        <span id="contador-sel">0</span> talento(s) seleccionado(s) para enviar
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <select name="datos_empresa_id" required
                            class="rounded-xl px-4 py-2 text-gray-800 text-sm border-0 focus:ring-2 focus:ring-white outline-none min-w-[220px]">
                            <option value="">Seleccionar empresa destino...</option>
                            @foreach($empresas as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-white text-blue-700 font-bold px-6 py-2 rounded-xl hover:bg-blue-50 transition text-sm shadow">
                            Enviar antecedentes
                        </button>
                    </div>
                </div>
            </div>

            @if($talentos->count() > 0)
                <p class="text-gray-500 text-sm">{{ $talentos->total() }} talento(s) encontrado(s)</p>
            @endif

            <!-- CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mt-2">

                @forelse($talentos as $talento)
                    @php $edu = $talento->antecedentesEducacionales->sortByDesc('egreso')->first(); @endphp

                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-5 relative hover:shadow-md transition">

                        <label class="absolute top-4 right-4 cursor-pointer">
                            <input type="checkbox" name="talento_ids[]" value="{{ $talento->id }}"
                                class="talento-check w-5 h-5 rounded text-blue-600">
                        </label>

                        <div class="mb-3 flex flex-wrap gap-1">
                            <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                Talento #{{ str_pad($talento->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            @if($talento->discapacidad)
                                <span class="bg-blue-50 text-blue-600 border border-blue-200 px-2.5 py-1 rounded-full text-xs font-semibold">
                                    Ley 21.015
                                </span>
                            @endif
                        </div>

                        <!-- Admin ve nombre real -->
                        <h2 class="text-base font-bold text-gray-800 pr-8">{{ $talento->user->name }}</h2>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $talento->user->email }}</p>

                        @if($edu)
                            <p class="text-sm text-gray-600 mt-2 font-medium">{{ $edu->titulo ?? '—' }}</p>
                            <p class="text-xs text-gray-400">{{ $edu->nombre_institucion ?? '' }}</p>
                        @endif

                        <div class="mt-3 space-y-1 text-xs text-gray-500">
                            @if($talento->condicion_modalidad)
                                <p>{{ $talento->condicion_modalidad }} · {{ $talento->condicion_jornada }}</p>
                            @endif
                            @if(($talento->renta_desde ?? 0) > 0)
                                <p>Renta pretendida: ${{ number_format($talento->renta_desde, 0, ',', '.') }}
                                    @if(($talento->renta_hasta ?? 0) > 0)
                                        — ${{ number_format($talento->renta_hasta, 0, ',', '.') }}
                                    @endif
                                </p>
                            @endif
                        </div>

                        @if($talento->competenciasTecnicas->count())
                            <div class="flex flex-wrap gap-1 mt-3">
                                @foreach($talento->competenciasTecnicas->take(4) as $comp)
                                    <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">
                                        {{ $comp->nombre_competencia }}
                                    </span>
                                @endforeach
                                @if($talento->competenciasTecnicas->count() > 4)
                                    <span class="text-gray-400 text-xs">+{{ $talento->competenciasTecnicas->count() - 4 }} más</span>
                                @endif
                            </div>
                        @endif

                    </div>

                @empty
                    <div class="col-span-3 py-20 text-center text-gray-400">
                        No se encontraron talentos con los filtros seleccionados.
                    </div>
                @endforelse

            </div>

        </form>

        @if($talentos->hasPages())
            <div>{{ $talentos->links() }}</div>
        @endif

    </div>

    <script>
        const checks   = document.querySelectorAll('.talento-check');
        const barra    = document.getElementById('barra-envio');
        const contador = document.getElementById('contador-sel');

        function actualizar() {
            const total = document.querySelectorAll('.talento-check:checked').length;
            contador.textContent = total;
            barra.classList.toggle('hidden', total === 0);
        }

        checks.forEach(c => c.addEventListener('change', actualizar));
    </script>

</x-admin-layout>
