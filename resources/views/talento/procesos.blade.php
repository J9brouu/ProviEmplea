<x-talento-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Mis Procesos</h1>
            <p class="text-gray-500 mt-2">Seguimiento de procesos de selección en los que participas.</p>
        </div>

        <!-- CARDS RESUMEN -->
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

        <!-- PROCESOS -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Historial de Procesos</h2>

            @forelse($procesos as $proceso)
                @php $empresa = $proceso->datosEmpresa; @endphp
                <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 mb-4">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-5">

                        <!-- AVATAR EMPRESA -->
                        <div class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center text-white text-xl font-bold shrink-0">
                            {{ strtoupper(substr($empresa?->user?->name ?? '?', 0, 1)) }}
                        </div>

                        <!-- INFO EMPRESA -->
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <h3 class="text-lg font-bold text-gray-800">{{ $empresa?->user?->name ?? '—' }}</h3>
                                <span class="{{ $proceso->estado_color }} px-2.5 py-0.5 rounded-full text-xs font-semibold">
                                    {{ $proceso->estado_texto }}
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-gray-500 mt-1">
                                @if($empresa?->rubro_empresa && $empresa->rubro_empresa !== 'No especificado')
                                    <span>{{ $empresa->rubro_empresa }}</span>
                                @endif
                                @if($empresa?->tipo_empresa)
                                    @if($empresa?->rubro_empresa && $empresa->rubro_empresa !== 'No especificado')
                                        <span class="text-gray-300">·</span>
                                    @endif
                                    <span>{{ $empresa->tipo_empresa }}</span>
                                @endif
                            </div>
                            @if($empresa?->user?->email)
                                <div class="mt-1">
                                    <a href="mailto:{{ $empresa->user->email }}"
                                        class="text-sm text-blue-600 hover:underline">
                                        {{ $empresa->user->email }}
                                    </a>
                                </div>
                            @endif

                            @if($empresa?->presentacion_empresa && $empresa->presentacion_empresa !== 'Empresa recientemente registrada.')
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $empresa->presentacion_empresa }}</p>
                            @endif

                            @if($proceso->notas && $proceso->notas !== 'Enviado por el equipo ProviEmplea.')
                                <p class="text-xs text-gray-400 mt-2 bg-gray-50 rounded-lg px-3 py-2">
                                    <span class="font-medium text-gray-500">Nota:</span> {{ $proceso->notas }}
                                </p>
                            @endif
                        </div>

                        <!-- FECHA -->
                        <div class="text-right shrink-0">
                            <p class="text-xs text-gray-400">Fecha</p>
                            <p class="text-sm font-semibold text-gray-700">{{ $proceso->created_at->format('d/m/Y') }}</p>
                        </div>

                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow border border-gray-100 py-20 text-center text-gray-400">
                    <p class="text-lg">Aún no tienes procesos de selección activos.</p>
                    <p class="text-sm mt-1">Cuando una empresa se interese en tu perfil, aparecerá aquí.</p>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $procesos->links() }}
            </div>
        </div>

    </div>

</x-talento-layout>
