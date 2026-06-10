<x-empresa-layout>

    <div class="space-y-8">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl text-sm">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Documentos Empresa</h1>
            <p class="text-gray-500 mt-2">Sube los documentos requeridos. El equipo de ProviEmplea los revisará y validará.</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Total</p>
                <h2 class="text-4xl font-bold text-blue-600 mt-3">{{ $documentos->count() }}</h2>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Aprobados</p>
                <h2 class="text-4xl font-bold text-green-600 mt-3">{{ $documentos->where('estado', 'aprobado')->count() }}</h2>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Pendientes</p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-3">{{ $documentos->where('estado', 'pendiente')->count() }}</h2>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow border">
                <p class="text-gray-500 text-sm">Rechazados</p>
                <h2 class="text-4xl font-bold text-red-500 mt-3">{{ $documentos->where('estado', 'rechazado')->count() }}</h2>
            </div>
        </div>

        <!-- Subir documento -->
        <div class="bg-white rounded-2xl shadow border p-6 md:p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Subir Nuevo Documento</h2>
            <form method="POST" action="{{ route('empresa.documentos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Tipo de Documento</label>
                        <select name="tipo_archivo"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                            <option value="">Seleccionar tipo</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo }}" {{ old('tipo_archivo') === $tipo ? 'selected' : '' }}>
                                    {{ $tipo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Archivo <span class="text-gray-400 text-xs">(PDF, Word, PNG, JPG — máx. 5MB)</span>
                        </label>
                        <input type="file" name="archivo" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                            class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-medium hover:file:bg-blue-100 border border-gray-200 rounded-xl px-3 py-2" required>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                            Subir Documento
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Listado -->
        @if($documentos->count() > 0)
            <div class="bg-white rounded-2xl shadow border overflow-x-auto">
                <div class="p-6 border-b bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-800">Documentos Subidos</h2>
                    <p class="text-gray-500 text-sm mt-1">El estado es actualizado por el equipo de ProviEmplea.</p>
                </div>
                <table class="w-full min-w-[620px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-500 text-sm">Archivo</th>
                            <th class="px-6 py-4 text-left text-gray-500 text-sm">Tipo</th>
                            <th class="px-6 py-4 text-center text-gray-500 text-sm">Estado</th>
                            <th class="px-6 py-4 text-left text-gray-500 text-sm">Fecha</th>
                            <th class="px-6 py-4 text-center text-gray-500 text-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $doc)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="font-medium text-gray-800 text-sm truncate max-w-[180px]">{{ $doc->nombre_archivo }}</p>
                                            @if($doc->estado === 'rechazado' && $doc->motivo_rechazo)
                                                <p class="text-xs text-red-500 mt-0.5">{{ $doc->motivo_rechazo }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $doc->tipo_archivo }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($doc->estado === 'aprobado')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✓ Aprobado</span>
                                    @elseif($doc->estado === 'rechazado')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">✗ Rechazado</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">En revisión</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $doc->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('archivos.empresa', $doc->id) }}" target="_blank"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                                            Ver
                                        </a>
                                        <form method="POST" action="{{ route('empresa.documentos.destroy', $doc->id) }}"
                                            id="form-doc-emp-{{ $doc->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                @click="$dispatch('confirm-delete', { title: 'Eliminar Documento', message: '¿Eliminar {{ $doc->nombre_archivo }}?', formId: 'form-doc-emp-{{ $doc->id }}' })"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow border p-12 text-center text-gray-400">
                No hay documentos subidos aún.
            </div>
        @endif

    </div>

</x-empresa-layout>
