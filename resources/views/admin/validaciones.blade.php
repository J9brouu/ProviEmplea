<x-admin-layout>

    <div class="space-y-8">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error_aprobacion'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl">
                {{ session('error_aprobacion') }}
            </div>
        @endif

        <div>
            <h1 class="text-5xl font-bold text-gray-800">Validaciones</h1>
            <p class="text-gray-500 mt-2">Gestión de aprobación de talentos y empresas pendientes.</p>
        </div>

        <!-- CARDS -->
        <div class="flex flex-wrap gap-4">
            <div class="bg-white rounded-2xl p-5 shadow-sm border">
                <p class="text-gray-500 text-sm">Talentos Pendientes</p>
                <h2 class="text-3xl font-bold text-yellow-500 mt-1">{{ $talentos->total() }}</h2>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border">
                <p class="text-gray-500 text-sm">Empresas Pendientes</p>
                <h2 class="text-3xl font-bold text-yellow-500 mt-1">{{ $empresas->total() }}</h2>
            </div>
        </div>

        <!-- TALENTOS PENDIENTES -->
        <div class="bg-white rounded-2xl overflow-hidden">
            <div class="p-6 border-b bg-gray-50">
                <h2 class="text-xl font-bold text-slate-800">Talentos Pendientes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Modalidad</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Jornada</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Ley 21.015</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Documentos</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($talentos as $talento)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-medium text-sm">{{ $talento->user->name }}</td>

                                <td class="px-6 py-4 text-sm text-gray-600">{{ $talento->condicion_modalidad }}</td>

                                <td class="px-6 py-4 text-sm text-gray-600">{{ $talento->condicion_jornada }}</td>

                                <td class="px-6 py-4 text-center">
                                    @if($talento->discapacidad)
                                        <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">Si</span>
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>

                                <!-- DOCUMENTOS: contador + botón modal -->
                                <td class="px-6 py-4 text-center">
                                    @if($talento->talentoArchivos->isEmpty())
                                        <span class="text-gray-400 text-xs">Sin documentos</span>
                                    @else
                                        @php
                                            $pendientes = $talento->talentoArchivos->where('estado', 'pendiente')->count();
                                            $aprobados  = $talento->talentoArchivos->where('estado', 'aprobado')->count();
                                            $rechazados = $talento->talentoArchivos->where('estado', 'rechazado')->count();
                                        @endphp
                                        <div class="flex flex-wrap justify-center gap-1 mb-2">
                                            @if($aprobados)  <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs">{{ $aprobados }} aprobado(s)</span> @endif
                                            @if($pendientes) <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded text-xs">{{ $pendientes }} pendiente(s)</span> @endif
                                            @if($rechazados) <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs">{{ $rechazados }} rechazado(s)</span> @endif
                                        </div>
                                        <button onclick="document.getElementById('docs-talento-{{ $talento->id }}').classList.remove('hidden')"
                                            class="bg-slate-600 hover:bg-slate-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                            Ver documentos
                                        </button>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        @php $pendientesTalento = $talento->talentoArchivos->contains('estado', 'pendiente'); @endphp
                                        <button type="button"
                                            data-pendientes="{{ $pendientesTalento ? '1' : '0' }}"
                                            data-form="aprobar-talento-{{ $talento->id }}"
                                            data-nombre="{{ $talento->user->name }}"
                                            onclick="intentarAprobar(this)"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">Aprobar</button>
                                        <form id="aprobar-talento-{{ $talento->id }}" method="POST" action="{{ route('admin.validaciones.talento.aprobar', $talento->id) }}" class="hidden">
                                            @csrf @method('PUT')
                                        </form>
                                        <form method="POST" action="{{ route('admin.validaciones.talento.rechazar', $talento->id) }}">
                                            @csrf @method('PUT')
                                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">Rechazar</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">No hay talentos pendientes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t bg-gray-50">{{ $talentos->links() }}</div>
        </div>

        <!-- EMPRESAS PENDIENTES -->
        <div class="bg-white rounded-2xl overflow-hidden">
            <div class="p-6 border-b bg-gray-50">
                <h2 class="text-xl font-bold text-slate-800">Empresas Pendientes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Rubro</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Tipo</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Documentos</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($empresas as $empresa)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-medium text-sm">{{ $empresa->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $empresa->rubro_empresa }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $empresa->tipo_empresa }}</td>

                                <td class="px-6 py-4 text-center">
                                    @if($empresa->archivosEmpresa->isEmpty())
                                        <span class="text-gray-400 text-xs">Sin documentos</span>
                                    @else
                                        @php
                                            $pendientes = $empresa->archivosEmpresa->where('estado', 'pendiente')->count();
                                            $aprobados  = $empresa->archivosEmpresa->where('estado', 'aprobado')->count();
                                            $rechazados = $empresa->archivosEmpresa->where('estado', 'rechazado')->count();
                                        @endphp
                                        <div class="flex flex-wrap justify-center gap-1 mb-2">
                                            @if($aprobados)  <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs">{{ $aprobados }} aprobado(s)</span> @endif
                                            @if($pendientes) <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded text-xs">{{ $pendientes }} pendiente(s)</span> @endif
                                            @if($rechazados) <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs">{{ $rechazados }} rechazado(s)</span> @endif
                                        </div>
                                        <button onclick="document.getElementById('docs-empresa-{{ $empresa->id }}').classList.remove('hidden')"
                                            class="bg-slate-600 hover:bg-slate-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                            Ver documentos
                                        </button>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        @php $pendientesEmpresa = $empresa->archivosEmpresa->contains('estado', 'pendiente'); @endphp
                                        <button type="button"
                                            data-pendientes="{{ $pendientesEmpresa ? '1' : '0' }}"
                                            data-form="aprobar-empresa-{{ $empresa->id }}"
                                            data-nombre="{{ $empresa->user->name }}"
                                            onclick="intentarAprobar(this)"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">Aprobar</button>
                                        <form id="aprobar-empresa-{{ $empresa->id }}" method="POST" action="{{ route('admin.validaciones.empresa.aprobar', $empresa->id) }}" class="hidden">
                                            @csrf @method('PUT')
                                        </form>
                                        <form method="POST" action="{{ route('admin.validaciones.empresa.rechazar', $empresa->id) }}">
                                            @csrf @method('PUT')
                                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">Rechazar</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">No hay empresas pendientes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t bg-gray-50">{{ $empresas->links() }}</div>
        </div>

    </div>

    {{-- MODALES DOCUMENTOS TALENTO --}}
    @foreach($talentos as $talento)
        <div id="docs-talento-{{ $talento->id }}"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden max-h-[85vh] flex flex-col">

                <div class="bg-slate-700 px-6 py-5 flex justify-between items-center shrink-0">
                    <div>
                        <h2 class="text-lg font-bold text-white">Documentos — {{ $talento->user->name }}</h2>
                        <p class="text-slate-300 text-xs mt-0.5">{{ $talento->talentoArchivos->count() }} documento(s)</p>
                    </div>
                    <button onclick="document.getElementById('docs-talento-{{ $talento->id }}').classList.add('hidden')"
                        class="text-white text-2xl hover:opacity-75 leading-none">×</button>
                </div>

                <div class="p-6 space-y-4 overflow-y-auto">
                    @foreach($talento->talentoArchivos as $archivo)
                        @php
                            $labels = ['cv' => 'Curriculum Vitae', 'residencia' => 'Cert. Residencia', 'discapacidad' => 'Ley 21.015'];
                        @endphp
                        <div class="border rounded-xl p-4 bg-gray-50">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $labels[$archivo->tipo_archivo] ?? $archivo->tipo_archivo }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-[200px]">{{ $archivo->nombre_archivo }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('archivos.talento', $archivo->id) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-700 text-xs font-medium">Ver</a>
                                    @if($archivo->estado === 'aprobado')
                                        <span class="bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-full font-semibold">Aprobado</span>
                                    @elseif($archivo->estado === 'rechazado')
                                        <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-semibold">Rechazado</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-2.5 py-1 rounded-full font-semibold">Pendiente</span>
                                    @endif
                                </div>
                            </div>
                            @if($archivo->estado !== 'aprobado')
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.validaciones.archivo.aprobar', $archivo->id) }}">
                                        @csrf @method('PUT')
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Aprobar</button>
                                    </form>
                                    <button onclick="document.getElementById('rechazo-{{ $archivo->id }}').classList.toggle('hidden')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Rechazar</button>
                                </div>
                                <form method="POST" action="{{ route('admin.validaciones.archivo.rechazar', $archivo->id) }}"
                                    id="rechazo-{{ $archivo->id }}" class="hidden mt-3">
                                    @csrf @method('PUT')
                                    <input type="text" name="motivo" placeholder="Motivo del rechazo"
                                        class="w-full text-xs border rounded-lg px-3 py-2 mb-2 focus:ring-2 focus:ring-red-400 outline-none" required>
                                    <button class="w-full text-xs bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg font-medium transition">Confirmar rechazo</button>
                                </form>
                            @endif
                            @if($archivo->estado === 'rechazado' && $archivo->motivo_rechazo)
                                <p class="text-xs text-red-500 mt-2 bg-red-50 rounded p-2">{{ $archivo->motivo_rechazo }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach

    {{-- MODALES DOCUMENTOS EMPRESA --}}
    @foreach($empresas as $empresa)
        <div id="docs-empresa-{{ $empresa->id }}"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden max-h-[85vh] flex flex-col">

                <div class="bg-slate-700 px-6 py-5 flex justify-between items-center shrink-0">
                    <div>
                        <h2 class="text-lg font-bold text-white">Documentos — {{ $empresa->user->name }}</h2>
                        <p class="text-slate-300 text-xs mt-0.5">{{ $empresa->archivosEmpresa->count() }} documento(s)</p>
                    </div>
                    <button onclick="document.getElementById('docs-empresa-{{ $empresa->id }}').classList.add('hidden')"
                        class="text-white text-2xl hover:opacity-75 leading-none">×</button>
                </div>

                <div class="p-6 space-y-4 overflow-y-auto">
                    @foreach($empresa->archivosEmpresa as $archivo)
                        <div class="border rounded-xl p-4 bg-gray-50">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $archivo->tipo_archivo }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-[200px]">{{ $archivo->nombre_archivo }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('archivos.empresa', $archivo->id) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-700 text-xs font-medium">Ver</a>
                                    @if($archivo->estado === 'aprobado')
                                        <span class="bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-full font-semibold">Aprobado</span>
                                    @elseif($archivo->estado === 'rechazado')
                                        <span class="bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-semibold">Rechazado</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-2.5 py-1 rounded-full font-semibold">Pendiente</span>
                                    @endif
                                </div>
                            </div>
                            @if($archivo->estado !== 'aprobado')
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.validaciones.archivo-empresa.aprobar', $archivo->id) }}">
                                        @csrf @method('PUT')
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Aprobar</button>
                                    </form>
                                    <button onclick="document.getElementById('rechazo-emp-{{ $archivo->id }}').classList.toggle('hidden')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">Rechazar</button>
                                </div>
                                <form method="POST" action="{{ route('admin.validaciones.archivo-empresa.rechazar', $archivo->id) }}"
                                    id="rechazo-emp-{{ $archivo->id }}" class="hidden mt-3">
                                    @csrf @method('PUT')
                                    <input type="text" name="motivo" placeholder="Motivo del rechazo"
                                        class="w-full text-xs border rounded-lg px-3 py-2 mb-2 focus:ring-2 focus:ring-red-400 outline-none" required>
                                    <button class="w-full text-xs bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg font-medium transition">Confirmar rechazo</button>
                                </form>
                            @endif
                            @if($archivo->estado === 'rechazado' && $archivo->motivo_rechazo)
                                <p class="text-xs text-red-500 mt-2 bg-red-50 rounded p-2">{{ $archivo->motivo_rechazo }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach

    {{-- MODAL: documentos pendientes --}}
    <div id="modal-pendientes" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-yellow-500 px-6 py-5 flex items-center gap-3">
                <span class="text-2xl">⚠️</span>
                <div>
                    <h2 class="text-lg font-bold text-white">Documentos pendientes</h2>
                    <p class="text-yellow-100 text-xs mt-0.5">No es posible aprobar este usuario</p>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 text-sm mb-1">
                    El usuario <strong id="modal-pendientes-nombre"></strong> tiene documentos pendientes de validar.
                </p>
                <p class="text-gray-500 text-sm">Debes aprobar o rechazar todos los documentos antes de aprobar al usuario.</p>
            </div>
            <div class="px-6 py-6 flex justify-center">
                <a href="{{ route('admin.validaciones') }}"
                    style="background-color:#2563eb;color:#ffffff;display:inline-block;padding:0.625rem 1.5rem;border-radius:0.75rem;font-weight:600;font-size:0.875rem;text-decoration:none;">
                    OK
                </a>
            </div>
        </div>
    </div>

    <script>
        function intentarAprobar(btn) {
            if (btn.dataset.pendientes === '1') {
                document.getElementById('modal-pendientes-nombre').textContent = btn.dataset.nombre;
                document.getElementById('modal-pendientes').classList.remove('hidden');
            } else {
                document.getElementById(btn.dataset.form).submit();
            }
        }
    </script>

</x-admin-layout>
