<x-admin-layout>

    <div class="space-y-8">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div class="flex flex-wrap justify-between items-start gap-4">
            <div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Solicitudes Empresariales</h1>
                <p class="text-gray-500 mt-2">Gestión y seguimiento de contactos entre empresas y talentos.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.export.procesos') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl font-semibold flex items-center gap-2 transition shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Excel
                </a>
                <a href="{{ route('admin.solicitudes.pdf') }}"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition shadow">
                    Exportar PDF
                </a>
            </div>
        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
            <a href="{{ route('admin.solicitudes') }}"
                class="bg-white p-6 rounded-2xl shadow border hover:shadow-md transition {{ !request('estado') ? 'ring-2 ring-blue-500' : '' }}">
                <p class="text-gray-500 text-sm">Total</p>
                <h2 class="text-4xl font-bold text-blue-600 mt-3">{{ array_sum($totales) }}</h2>
            </a>
            <a href="{{ route('admin.solicitudes', ['estado' => 'pendiente']) }}"
                class="bg-white p-6 rounded-2xl shadow border hover:shadow-md transition {{ request('estado') == 'pendiente' ? 'ring-2 ring-yellow-400' : '' }}">
                <p class="text-gray-500 text-sm">Pendientes</p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-3">{{ $totales['pendiente'] }}</h2>
            </a>
            <a href="{{ route('admin.solicitudes', ['estado' => 'contactado']) }}"
                class="bg-white p-6 rounded-2xl shadow border hover:shadow-md transition {{ request('estado') == 'contactado' ? 'ring-2 ring-green-500' : '' }}">
                <p class="text-gray-500 text-sm">Contactados</p>
                <h2 class="text-4xl font-bold text-green-600 mt-3">{{ $totales['contactado'] }}</h2>
            </a>
            <a href="{{ route('admin.solicitudes', ['estado' => 'entrevista']) }}"
                class="bg-white p-6 rounded-2xl shadow border hover:shadow-md transition {{ request('estado') == 'entrevista' ? 'ring-2 ring-purple-500' : '' }}">
                <p class="text-gray-500 text-sm">Entrevistas</p>
                <h2 class="text-4xl font-bold text-purple-600 mt-3">{{ $totales['entrevista'] }}</h2>
            </a>
            <a href="{{ route('admin.solicitudes', ['estado' => 'contratado']) }}"
                class="bg-white p-6 rounded-2xl shadow border hover:shadow-md transition {{ request('estado') == 'contratado' ? 'ring-2 ring-emerald-500' : '' }}">
                <p class="text-gray-500 text-sm">Contratados</p>
                <h2 class="text-4xl font-bold text-emerald-600 mt-3">{{ $totales['contratado'] }}</h2>
            </a>
        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Historial de Solicitudes</h2>
                    <p class="text-gray-500 mt-1 text-sm">Seguimiento de interacciones entre empresas y talentos.</p>
                </div>
                <form method="GET" action="{{ route('admin.solicitudes') }}" class="flex gap-2 flex-wrap">
                    <input type="hidden" name="estado" value="{{ request('estado') }}">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar talento o empresa..."
                        class="border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl text-sm transition">Buscar</button>
                    @if(request('buscar') || request('estado'))
                        <a href="{{ route('admin.solicitudes') }}" class="flex items-center px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm transition">Limpiar</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="border-b text-gray-500 text-sm">
                            <th class="text-left py-4 px-2">Talento</th>
                            <th class="text-left py-4 px-2">Empresa</th>
                            <th class="text-left py-4 px-2">Estado</th>
                            <th class="text-left py-4 px-2">Fecha</th>
                            <th class="text-left py-4 px-2">Notas</th>
                            <th class="text-left py-4 px-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($solicitudes as $solicitud)
                            @php $finalizado = in_array($solicitud->estado, ['contratado', 'rechazado']); @endphp
                            <tr class="border-b hover:bg-gray-50 transition {{ $finalizado ? 'opacity-60' : '' }}">

                                <td class="py-4 px-2 font-medium text-sm">
                                    {{ $solicitud->talento->user->name }}
                                </td>

                                <td class="py-4 px-2 text-sm">
                                    {{ $solicitud->datosEmpresa->user->name }}
                                </td>

                                <td class="py-4 px-2">
                                    <span class="{{ $solicitud->estado_color }} px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $solicitud->estado_texto }}
                                    </span>
                                </td>

                                <td class="py-4 px-2 text-gray-500 text-sm">
                                    {{ optional($solicitud->created_at)->format('d/m/Y') }}
                                </td>

                                <td class="py-4 px-2">
                                    <form method="POST" action="{{ route('admin.solicitudes.nota', $solicitud->id) }}" class="flex gap-2 items-center">
                                        @csrf @method('PUT')
                                        <input type="text" name="notas" value="{{ $solicitud->notas }}"
                                            placeholder="Sin notas"
                                            class="border border-gray-300 rounded-xl px-3 py-2 text-xs w-36 focus:ring-2 focus:ring-blue-400 outline-none">
                                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-xl text-xs transition">✓</button>
                                    </form>
                                </td>

                                <td class="py-4 px-2">
                                    @if(!$finalizado)
                                        <div class="flex flex-wrap gap-1">

                                            @if($solicitud->estado === 'pendiente')
                                                <form method="POST" action="{{ route('admin.solicitudes.contactar', $solicitud->id) }}">
                                                    @csrf @method('PUT')
                                                    <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-green-600 hover:bg-green-700 text-white transition">
                                                        Contactar
                                                    </button>
                                                </form>
                                            @endif

                                            @if($solicitud->estado === 'contactado')
                                                <form method="POST" action="{{ route('admin.solicitudes.entrevista', $solicitud->id) }}">
                                                    @csrf @method('PUT')
                                                    <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-purple-600 hover:bg-purple-700 text-white transition">
                                                        Entrevista
                                                    </button>
                                                </form>
                                            @endif

                                            @if($solicitud->estado === 'entrevista')
                                                <form method="POST" action="{{ route('admin.solicitudes.seleccionado', $solicitud->id) }}">
                                                    @csrf @method('PUT')
                                                    <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-600 hover:bg-blue-700 text-white transition">
                                                        Seleccionar
                                                    </button>
                                                </form>
                                            @endif

                                            @if($solicitud->estado === 'seleccionado')
                                                <form method="POST" action="{{ route('admin.solicitudes.contratar', $solicitud->id) }}">
                                                    @csrf @method('PUT')
                                                    <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-emerald-600 hover:bg-emerald-700 text-white transition">
                                                        Contratar
                                                    </button>
                                                </form>
                                            @endif

                                            <form method="POST" action="{{ route('admin.solicitudes.rechazar', $solicitud->id) }}">
                                                @csrf @method('PUT')
                                                <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-500 hover:bg-red-600 text-white transition">
                                                    Rechazar
                                                </button>
                                            </form>

                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">Proceso finalizado</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-gray-500">
                                    No hay solicitudes registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $solicitudes->links() }}
            </div>

        </div>

    </div>

</x-admin-layout>
