<x-talento-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Documentos</h1>
            <p class="text-gray-500 mt-2">Sube tus documentos. El equipo ProviEmplea los revisará y validará.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        @php
            $cv         = $documentos->firstWhere('tipo_archivo', 'cv');
            $residencia = $documentos->firstWhere('tipo_archivo', 'residencia');
            $certDisc   = $documentos->firstWhere('tipo_archivo', 'discapacidad');

            $cards = [
                [
                    'doc'        => $cv,
                    'tipo'       => 'cv',
                    'titulo'     => 'Curriculum Vitae',
                    'subtitulo'  => 'PDF o Word — máx. 5 MB',
                    'accept'     => '.pdf,.doc,.docx',
                    'form_id'    => 'form-cv-del',
                    'del_title'  => 'Eliminar CV',
                    'del_msg'    => '¿Eliminar tu Curriculum Vitae?',
                    'input_id'   => 'file-cv',
                ],
                [
                    'doc'        => $residencia,
                    'tipo'       => 'residencia',
                    'titulo'     => 'Certificado de Residencia',
                    'subtitulo'  => 'PDF, Word, PNG o JPG — máx. 5 MB',
                    'accept'     => '.pdf,.doc,.docx,.png,.jpg,.jpeg',
                    'form_id'    => 'form-res-del',
                    'del_title'  => 'Eliminar Residencia',
                    'del_msg'    => '¿Eliminar tu certificado de residencia?',
                    'input_id'   => 'file-res',
                ],
                [
                    'doc'        => $certDisc,
                    'tipo'       => 'discapacidad',
                    'titulo'     => 'Certificado Ley 21.015',
                    'subtitulo'  => 'Inclusión Laboral — PDF, PNG o JPG — máx. 5 MB',
                    'accept'     => '.pdf,.doc,.docx,.png,.jpg,.jpeg',
                    'form_id'    => 'form-disc-del',
                    'del_title'  => 'Eliminar Certificado',
                    'del_msg'    => '¿Eliminar el certificado Ley 21.015?',
                    'input_id'   => 'file-disc',
                ],
            ];
        @endphp

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($cards as $card)
                @php
                    $doc = $card['doc'];
                    if ($doc) {
                        $borderColor = match($doc->estado) {
                            'aprobado'  => 'border-green-500',
                            'rechazado' => 'border-red-400',
                            default     => 'border-yellow-400',
                        };
                    } else {
                        $borderColor = 'border-gray-200';
                    }
                @endphp
                <div class="bg-white rounded-2xl shadow border-t-4 {{ $borderColor }} flex flex-col">
                    <div class="flex flex-col flex-1 p-6 gap-4">

                        {{-- Encabezado --}}
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h2 class="text-base font-bold text-gray-800">{{ $card['titulo'] }}</h2>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $card['subtitulo'] }}</p>
                            </div>
                            @if($doc)
                                @if($doc->estado === 'aprobado')
                                    <span class="shrink-0 bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-full font-semibold whitespace-nowrap">Aprobado</span>
                                @elseif($doc->estado === 'rechazado')
                                    <span class="shrink-0 bg-red-100 text-red-700 text-xs px-2.5 py-1 rounded-full font-semibold whitespace-nowrap">Rechazado</span>
                                @else
                                    <span class="shrink-0 bg-yellow-100 text-yellow-700 text-xs px-2.5 py-1 rounded-full font-semibold whitespace-nowrap">En revisión</span>
                                @endif
                            @else
                                <span class="shrink-0 bg-gray-100 text-gray-400 text-xs px-2.5 py-1 rounded-full font-semibold whitespace-nowrap">Sin subir</span>
                            @endif
                        </div>

                        {{-- Archivo actual --}}
                        <div class="flex-1">
                            @if($doc)
                                <div class="flex items-center gap-3 bg-gray-50 border border-gray-100 rounded-xl px-4 py-3">
                                    <svg class="w-8 h-8 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-700 truncate">{{ $doc->nombre_archivo }}</p>
                                        <p class="text-xs text-gray-400">{{ $doc->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <a href="{{ route('archivos.talento', $doc->id) }}" target="_blank"
                                        class="shrink-0 text-blue-600 hover:text-blue-700 text-sm font-semibold">Ver</a>
                                </div>
                                @if($doc->estado === 'rechazado' && $doc->motivo_rechazo)
                                    <div class="mt-2 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl px-4 py-3">
                                        <strong>Motivo:</strong> {{ $doc->motivo_rechazo }}
                                    </div>
                                @endif
                                @if($doc->estado === 'aprobado' && $card['tipo'] === 'discapacidad')
                                    <div class="mt-2 bg-blue-50 border border-blue-200 text-blue-700 text-xs rounded-xl px-4 py-3">
                                        Tu perfil aparece con la marcación Ley 21.015 en la vitrina.
                                    </div>
                                @endif
                            @else
                                <div class="flex items-center justify-center h-16 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                    <p class="text-sm text-gray-400">No hay documento subido</p>
                                </div>
                            @endif
                        </div>

                        {{-- Upload --}}
                        <form method="POST" action="{{ route('talento.documentos.store') }}"
                            enctype="multipart/form-data" id="form-up-{{ $card['tipo'] }}">
                            @csrf
                            <input type="hidden" name="tipo_archivo" value="{{ $card['tipo'] }}">

                            <div class="flex items-center gap-2">
                                <label for="{{ $card['input_id'] }}"
                                    class="flex-1 min-w-0 flex items-center gap-2 cursor-pointer border border-gray-300 rounded-xl px-3 py-2.5 bg-white hover:bg-gray-50 transition">
                                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    <span id="label-{{ $card['input_id'] }}" class="text-sm text-gray-400 truncate">Seleccionar archivo...</span>
                                    <input type="file" id="{{ $card['input_id'] }}" name="archivo"
                                        accept="{{ $card['accept'] }}" class="sr-only"
                                        onchange="document.getElementById('label-{{ $card['input_id'] }}').textContent = this.files[0]?.name ?? 'Seleccionar archivo...'">
                                </label>
                                <button type="submit"
                                    class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">
                                    {{ $doc ? 'Reemplazar' : 'Subir' }}
                                </button>
                            </div>
                        </form>

                        {{-- Eliminar --}}
                        @if($doc)
                            <form method="POST" action="{{ route('talento.documentos.destroy', $doc->id) }}" id="{{ $card['form_id'] }}">
                                @csrf @method('DELETE')
                                <button type="button"
                                    @click="$dispatch('confirm-delete', { title: '{{ $card['del_title'] }}', message: '{{ $card['del_msg'] }}', formId: '{{ $card['form_id'] }}' })"
                                    class="text-sm text-red-500 hover:text-red-600 font-medium">
                                    Eliminar documento
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

        <!-- HISTORIAL -->
        @if($documentos->count() > 0)
            <div class="bg-white rounded-2xl shadow p-6 md:p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Historial de Documentos</h2>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[500px]">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                <th class="px-4 py-3 rounded-l-xl">Archivo</th>
                                <th class="px-4 py-3">Tipo</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3 text-center rounded-r-xl">Ver</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($documentos as $doc)
                                @php
                                    $labels = [
                                        'cv'           => 'Curriculum Vitae',
                                        'residencia'   => 'Cert. Residencia',
                                        'discapacidad' => 'Ley 21.015',
                                    ];
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 max-w-[180px] truncate">
                                        {{ $doc->nombre_archivo }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                            {{ $labels[$doc->tipo_archivo] ?? $doc->tipo_archivo }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($doc->estado === 'aprobado')
                                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Aprobado</span>
                                        @elseif($doc->estado === 'rechazado')
                                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Rechazado</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">En revisión</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $doc->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="{{ route('archivos.talento', $doc->id) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

</x-talento-layout>
