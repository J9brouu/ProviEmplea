<x-admin-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-500 mt-2">Panel administrativo de ProviEmplea.</p>
        </div>

        <!-- Cifras principales -->
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">Total Talentos</p>
                <h2 class="text-5xl font-bold mt-3 text-gray-900">{{ $totalTalentos }}</h2>
                @if($talentosPendientes > 0)
                    <a href="{{ route('admin.validaciones') }}"
                        class="mt-2 inline-flex items-center gap-1 text-xs text-yellow-600 font-semibold bg-yellow-50 px-2 py-1 rounded-full">
                        {{ $talentosPendientes }} pendiente(s) de validar →
                    </a>
                @else
                    <p class="text-xs text-green-600 mt-2">Todos validados</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">Total Empresas</p>
                <h2 class="text-5xl font-bold text-green-600 mt-3">{{ $totalEmpresas }}</h2>
                @if($empresasPendientes > 0)
                    <a href="{{ route('admin.validaciones') }}"
                        class="mt-2 inline-flex items-center gap-1 text-xs text-yellow-600 font-semibold bg-yellow-50 px-2 py-1 rounded-full">
                        {{ $empresasPendientes }} pendiente(s) de validar →
                    </a>
                @else
                    <p class="text-xs text-green-600 mt-2">Todas validadas</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">Usuarios Registrados</p>
                <h2 class="text-5xl font-bold text-blue-600 mt-3">{{ $totalUsuarios }}</h2>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">Total Procesos</p>
                <h2 class="text-5xl font-bold text-purple-600 mt-3">{{ $totalProcesos }}</h2>
            </div>

        </div>

        <!-- Estados de procesos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-5">Resumen de Procesos por Estado</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach([
                    ['label' => 'Pendiente',    'key' => 'pendiente',    'color' => 'bg-yellow-100 text-yellow-700'],
                    ['label' => 'Contactado',   'key' => 'contactado',   'color' => 'bg-green-100 text-green-700'],
                    ['label' => 'Entrevista',   'key' => 'entrevista',   'color' => 'bg-purple-100 text-purple-700'],
                    ['label' => 'Seleccionado', 'key' => 'seleccionado', 'color' => 'bg-blue-100 text-blue-700'],
                    ['label' => 'Contratado',   'key' => 'contratado',   'color' => 'bg-emerald-100 text-emerald-700'],
                ] as $item)
                    <div class="text-center p-4 rounded-xl {{ $item['color'] }}">
                        <p class="text-3xl font-bold">{{ $procesosPorEstado[$item['key']] }}</p>
                        <p class="text-xs font-semibold mt-1">{{ $item['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Solicitudes pendientes de atención -->
        @if($solicitudesPendientes->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-yellow-200 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-yellow-400 animate-pulse"></span>
                    <h2 class="text-xl font-bold text-gray-800">Solicitudes pendientes de respuesta</h2>
                </div>
                <a href="{{ route('admin.solicitudes') }}" class="text-sm text-blue-600 hover:underline font-semibold">
                    Ver todas →
                </a>
            </div>
            <div class="space-y-3">
                @foreach($solicitudesPendientes as $sol)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="font-semibold text-gray-800">
                            {{ $sol->datosEmpresa?->user?->name ?? 'Empresa #'.$sol->datos_empresa_id }}
                            <span class="text-gray-400 font-normal text-sm">solicita a</span>
                            Talento #{{ str_pad($sol->talento_id, 4, '0', STR_PAD_LEFT) }}
                        </p>
                        <p class="text-xs text-gray-400">{{ $sol->created_at?->diffForHumans() }}</p>
                    </div>
                    <a href="{{ route('admin.solicitudes') }}"
                        class="text-xs bg-yellow-100 text-yellow-700 hover:bg-yellow-200 px-3 py-1.5 rounded-full font-semibold transition">
                        Revisar
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Tablas recientes -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- Empresas recientes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Empresas Recientes</h2>
                    <a href="{{ route('admin.empresas') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm">
                        Ver todas
                    </a>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 text-xs uppercase">
                            <th class="py-3 text-left">Empresa</th>
                            <th class="py-3 text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($empresa->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ $empresa->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $empresa->rubro_empresa }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if ($empresa->validacion)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Verificada</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">Pendiente</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Talentos recientes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Talentos Recientes</h2>
                    <a href="{{ route('admin.talentos') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm">
                        Ver todos
                    </a>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 text-xs uppercase">
                            <th class="py-3 text-left">Talento</th>
                            <th class="py-3 text-center">Jornada</th>
                            <th class="py-3 text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($talentos as $talento)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($talento->user?->name ?? 'T', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ $talento->user?->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $talento->condicion_modalidad }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 text-center text-xs text-gray-600">{{ $talento->condicion_jornada ?? '—' }}</td>
                            <td class="py-4 text-center">
                                @if($talento->validacion)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Validado</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">Pendiente</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</x-admin-layout>
