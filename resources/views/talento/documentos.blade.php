<x-talento-layout>

    <div class="space-y-8">

        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Documentos</h1>
            <p class="text-gray-500 mt-2">Sube tus documentos. El equipo de ProviEmplea los revisará y validará.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        @php
            $cv         = $documentos->firstWhere('tipo_archivo', 'cv');
            $residencia = $documentos->firstWhere('tipo_archivo', 'residencia');
            $certDisc   = $documentos->firstWhere('tipo_archivo', 'discapacidad');
        @endphp

        <!-- CARDS DE SUBIDA: items-stretch (default) para que todas midan lo mismo -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- ====== CV ====== --}}
            @php $borderCv = $cv ? ($cv->estado === 'aprobado' ? 'border-green-500' : ($cv->estado === 'rechazado' ? 'border-red-500' : 'border-yellow-400')) : 'border-gray-200'; @endphp
            <div class="bg-white rounded-2xl shadow border-t-4 {{ $borderCv }} flex flex-col overflow-hidden">
                <div class="flex flex-col flex-1 p-6">

                    {{-- Encabezado --}}
                    <div class="flex items-start justify-between gap-2 mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Curriculum Vitae</h2>
                            <p class="text-xs text-gray-400 mt-1">PDF, Word — máx. 5MB</p>
                        </div>
                        @include('talento.partials.doc-estado', ['doc' => $cv])
                    </div>

                    {{-- Info del archivo — crece para ocupar el espacio disponible --}}
                    <div class="flex-1 mb-4">
                        @include('talento.partials.doc-info', ['doc' => $cv])
                    </div>

                    {{-- Formulario de subida — siempre pegado al fondo del contenido --}}
                    <div class="space-y-3">
                        <form method="POST" action="{{ route('talento.documentos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tipo_archivo" value="cv">
                            <div class="flex gap-2">
                                <input type="file" name="archivo" accept=".pdf,.doc,.docx"
                                    class="flex-1 min-w-0 text-sm text-gray-500 file:mr-2 file:py-2 file:px-3 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-medium hover:file:bg-blue-100 border border-gray-200 rounded-xl px-3 py-2">
                                <button type="submit"
                                    class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition text-sm">
                                    {{ $cv ? 'Reemplazar' : 'Subir' }}
                                </button>
                            </div>
                        </form>
                        @if($cv)
                            <form method="POST" action="{{ route('talento.documentos.destroy', $cv->id) }}" id="form-cv-del">
                                @csrf @method('DELETE')
                                <button type="button"
                                    @click="$dispatch('confirm-delete', { title: 'Eliminar CV', message: '¿Eliminar tu Curriculum Vitae?', formId: 'form-cv-del' })"
                                    class="text-sm text-red-500 hover:text-red-600 font-medium">
                                    Eliminar documento
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>

            {{-- ====== RESIDENCIA ====== --}}
            @php $borderRes = $residencia ? ($residencia->estado === 'aprobado' ? 'border-green-500' : ($residencia->estado === 'rechazado' ? 'border-red-500' : 'border-yellow-400')) : 'border-gray-200'; @endphp
            <div class="bg-white rounded-2xl shadow border-t-4 {{ $borderRes }} flex flex-col overflow-hidden">
                <div class="flex flex-col flex-1 p-6">

                    {{-- Encabezado --}}
                    <div class="flex items-start justify-between gap-2 mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Certificado de Residencia</h2>
                            <p class="text-xs text-gray-400 mt-1">PDF, Word, PNG, JPG — máx. 5MB</p>
                        </div>
                        @include('talento.partials.doc-estado', ['doc' => $residencia])
                    </div>

                    {{-- Info del archivo --}}
                    <div class="flex-1 mb-4">
                        @include('talento.partials.doc-info', ['doc' => $residencia])
                    </div>

                    {{-- Formulario de subida --}}
                    <div class="space-y-3">
                        <form method="POST" action="{{ route('talento.documentos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tipo_archivo" value="residencia">
                            <div class="flex gap-2">
                                <input type="file" name="archivo" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                    class="flex-1 min-w-0 text-sm text-gray-500 file:mr-2 file:py-2 file:px-3 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-medium hover:file:bg-blue-100 border border-gray-200 rounded-xl px-3 py-2">
                                <button type="submit"
                                    class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition text-sm">
                                    {{ $residencia ? 'Reemplazar' : 'Subir' }}
                                </button>
                            </div>
                        </form>
                        @if($residencia)
                            <form method="POST" action="{{ route('talento.documentos.destroy', $residencia->id) }}" id="form-res-del">
                                @csrf @method('DELETE')
                                <button type="button"
                                    @click="$dispatch('confirm-delete', { title: 'Eliminar Residencia', message: '¿Eliminar tu certificado de residencia?', formId: 'form-res-del' })"
                                    class="text-sm text-red-500 hover:text-red-600 font-medium">
                                    Eliminar documento
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>

            {{-- ====== LEY 21.015 ====== --}}
            @php
                $borderDisc = $certDisc
                    ? ($certDisc->estado === 'aprobado' ? 'border-blue-500' : ($certDisc->estado === 'rechazado' ? 'border-red-500' : 'border-yellow-400'))
                    : 'border-gray-200';
            @endphp
            <div class="bg-white rounded-2xl shadow border-t-4 {{ $borderDisc }} flex flex-col overflow-hidden">
                <div class="flex flex-col flex-1 p-6">

                    {{-- Encabezado --}}
                    <div class="flex items-start justify-between gap-2 mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Certificado Ley 21.015</h2>
                            <p class="text-xs text-gray-400 mt-1">Inclusión Laboral — PDF, PNG, JPG — máx. 5MB</p>
                        </div>
                        @if($certDisc)
                            @if($certDisc->estado === 'aprobado')
                                <span class="shrink-0 bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-semibold">✓ Verificado</span>
                            @elseif($certDisc->estado === 'rechazado')
                                <span class="shrink-0 bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-semibold">✗ Rechazado</span>
                            @else
                                <span class="shrink-0 bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">En revisión</span>
                            @endif
                        @else
                            <span class="shrink-0 bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full font-semibold">Opcional</span>
                        @endif
                    </div>

                    {{-- Info del archivo --}}
                    <div class="flex-1 mb-4">
                        @if($certDisc)
                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl border border-blue-100 mb-3">
                                <span class="text-xl shrink-0">📄</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-700 truncate">{{ $certDisc->nombre_archivo }}</p>
                                    <p class="text-xs text-gray-400">{{ $certDisc->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <a href="{{ Storage::url($certDisc->url_archivo) }}" target="_blank"
                                    class="shrink-0 text-blue-600 hover:text-blue-700 text-sm font-medium">Ver</a>
                            </div>
                            @if($certDisc->estado === 'rechazado' && $certDisc->motivo_rechazo)
                                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-3">
                                    <strong>Motivo:</strong> {{ $certDisc->motivo_rechazo }}
                                </div>
                            @endif
                            @if($certDisc->estado === 'aprobado')
                                <div class="bg-blue-50 border border-blue-200 text-blue-700 text-sm rounded-xl px-4 py-3 mb-3">
                                    Tu perfil aparece con la marcación Ley 21.015 en la vitrina de talentos.
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- Formulario de subida --}}
                    <div class="space-y-3">
                        <form method="POST" action="{{ route('talento.documentos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tipo_archivo" value="discapacidad">
                            <div class="flex gap-2">
                                <input type="file" name="archivo" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                    class="flex-1 min-w-0 text-sm text-gray-500 file:mr-2 file:py-2 file:px-3 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-medium hover:file:bg-blue-100 border border-gray-200 rounded-xl px-3 py-2">
                                <button type="submit"
                                    class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition text-sm">
                                    {{ $certDisc ? 'Reemplazar' : 'Subir' }}
                                </button>
                            </div>
                        </form>
                        @if($certDisc)
                            <form method="POST" action="{{ route('talento.documentos.destroy', $certDisc->id) }}" id="form-disc-del">
                                @csrf @method('DELETE')
                                <button type="button"
                                    @click="$dispatch('confirm-delete', { title: 'Eliminar Certificado', message: '¿Eliminar el certificado Ley 21.015?', formId: 'form-disc-del' })"
                                    class="text-sm text-red-500 hover:text-red-600 font-medium">
                                    Eliminar documento
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>

        </div>

        <!-- HISTORIAL -->
        @if($documentos->count() > 0)
            <div class="bg-white rounded-2xl shadow p-6 md:p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Historial de Documentos</h2>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[500px]">
                        <thead>
                            <tr class="border-b text-left text-gray-500 text-sm">
                                <th class="pb-4">Archivo</th>
                                <th class="pb-4">Tipo</th>
                                <th class="pb-4">Estado</th>
                                <th class="pb-4">Fecha</th>
                                <th class="pb-4 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($documentos as $doc)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-4 font-medium text-sm">{{ $doc->nombre_archivo }}</td>
                                    <td class="py-4">
                                        @php
                                            $labels = [
                                                'cv'           => 'Curriculum Vitae',
                                                'residencia'   => 'Cert. Residencia',
                                                'discapacidad' => 'Ley 21.015',
                                            ];
                                        @endphp
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $labels[$doc->tipo_archivo] ?? $doc->tipo_archivo }}
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        @if($doc->estado === 'aprobado')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">✓ Aprobado</span>
                                        @elseif($doc->estado === 'rechazado')
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">✗ Rechazado</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">En revisión</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-gray-500 text-sm">{{ $doc->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 text-center">
                                        <a href="{{ Storage::url($doc->url_archivo) }}" target="_blank"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition text-sm">
                                            Ver
                                        </a>
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
