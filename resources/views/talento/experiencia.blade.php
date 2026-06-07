<x-talento-layout>

    <div class="space-y-8">

        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Experiencia Laboral</h1>
                <p class="text-gray-500 mt-2">Tus cargos y posiciones laborales anteriores.</p>
            </div>
            <button onclick="document.getElementById('modalCrear').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition shadow active:scale-95">
                Agregar experiencia
            </button>
        </div>

        <!-- ALERTAS -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm">
                <div class="flex items-start gap-3">
                    <span class="text-xl mt-1">⚠</span>
                    <div>
                        <p class="font-semibold">Error en el formulario:</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- LISTADO DE EXPERIENCIAS -->
        @forelse($experiencias as $item)
            <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-8 border-t-4 border-blue-600">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="mb-3 flex items-center gap-2">
                            <span>{{ $item->egreso ? 'Finalizada' : 'Actual' }}</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $item->institucion_o_empresa }}</h2>
                        <p class="text-blue-600 font-semibold mt-2">{{ $item->cargo }}</p>
                        @if ($item->funciones)
                            <p class="text-gray-600 mt-3 text-sm line-clamp-2">{{ $item->funciones }}</p>
                        @endif
                        @if ($item->referencia_nombre)
                            <div class="mt-4 pt-4 border-t">
                                <h4 class="font-semibold text-gray-800">Referencia Laboral</h4>
                                <p><strong>Nombre:</strong> {{ $item->referencia_nombre }}</p>
                                <p><strong>Cargo:</strong> {{ $item->referencia_cargo }}</p>
                                <p><strong>Teléfono:</strong> {{ $item->referencia_telefono }}</p>
                                <p><strong>Correo:</strong> {{ $item->referencia_correo }}</p>
                            </div>
                        @endif
                        <p class="text-gray-500 mt-3 text-sm">
                            {{ \Carbon\Carbon::parse($item->ingreso)->format('M Y') }} -
                            {{ $item->egreso ? \Carbon\Carbon::parse($item->egreso)->format('M Y') : 'Actualidad' }}
                        </p>
                    </div>
                    <div class="flex gap-2 ml-4 flex-shrink-0">
                        <button onclick="document.getElementById('editar{{ $item->id }}').classList.remove('hidden')"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg transition font-medium active:scale-95 text-sm">
                            Editar
                        </button>
                        <form action="{{ route('talento.experiencia.destroy', $item->id) }}" method="POST"
                            id="form-exp-{{ $item->id }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                @click="$dispatch('confirm-delete', { title: 'Eliminar Experiencia', message: '¿Eliminar esta experiencia laboral?', formId: 'form-exp-{{ $item->id }}' })"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition font-medium active:scale-95 text-sm">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow p-16 text-center">
                <h3 class="text-2xl font-semibold text-gray-700">No tienes experiencias registradas</h3>
                <p class="text-gray-500 mt-3 mb-8">Agrega tus experiencias laborales para destacar tu perfil profesional.</p>
                <button onclick="document.getElementById('modalCrear').classList.remove('hidden')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition shadow">
                    Agregar primera experiencia
                </button>
            </div>
        @endforelse

    </div>

    <!-- MODALES EDITAR -->
    @foreach ($experiencias as $item)
        <div id="editar{{ $item->id }}"
            class="hidden fixed top-0 left-0 w-screen h-screen z-[99999] bg-black/80 flex items-center justify-center">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
                <div class="bg-blue-600 px-8 py-6 text-white flex items-center justify-between rounded-t-3xl">
                    <div>
                        <h2 class="text-3xl font-bold">Editar Experiencia</h2>
                        <p class="text-blue-100 mt-1 text-sm">Actualiza tus datos laborales.</p>
                    </div>
                    <button type="button"
                        onclick="document.getElementById('editar{{ $item->id }}').classList.add('hidden')"
                        class="text-white hover:rotate-90 transition text-3xl">×</button>
                </div>

                <form action="{{ route('talento.experiencia.update', $item->id) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Cargo / Posición <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="cargo" value="{{ old('cargo', $item->cargo) }}" required
                                minlength="3" maxlength="100"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="Ej: Desarrollador Senior">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Empresa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="institucion_o_empresa"
                                value="{{ old('institucion_o_empresa', $item->institucion_o_empresa) }}" required
                                minlength="3" maxlength="100"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                                placeholder="Ej: Acme Corp">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Fecha Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="ingreso"
                                value="{{ old('ingreso', \Carbon\Carbon::parse($item->ingreso)->format('Y-m-d')) }}"
                                required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha Término</label>
                            <input type="date" id="egreso{{ $item->id }}" name="egreso"
                                value="{{ old('egreso', $item->egreso) }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="actualidad" id="actualidad{{ $item->id }}"
                                    class="w-5 h-5 text-blue-600 rounded"
                                    {{ $item->egreso == null ? 'checked' : '' }}>
                                <span class="font-medium text-gray-700">Actualmente trabajo aquí</span>
                            </label>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Funciones</label>
                            <textarea name="funciones" rows="4"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3"
                                placeholder="Describe tus funciones principales">{{ old('funciones', $item->funciones) }}</textarea>
                        </div>

                        <div class="md:col-span-2"><hr class="my-2"></div>

                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Referencia Laboral (Opcional)</h3>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
                            <input type="text" name="referencia_nombre"
                                value="{{ old('referencia_nombre', $item->referencia_nombre) }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Cargo</label>
                            <input type="text" name="referencia_cargo"
                                value="{{ old('referencia_cargo', $item->referencia_cargo) }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono</label>
                            <div class="flex">
                                <span class="px-4 py-3 border border-r-0 border-gray-300 rounded-l-xl bg-gray-100">+569</span>
                                <input type="text" name="referencia_telefono" maxlength="8"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    value="{{ old('referencia_telefono', str_replace('+569', '', $item->referencia_telefono ?? '')) }}"
                                    class="w-full border border-gray-300 rounded-r-xl px-4 py-3">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Correo</label>
                            <input type="email" name="referencia_correo"
                                value="{{ old('referencia_correo', $item->referencia_correo) }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t">
                        <button type="button"
                            onclick="document.getElementById('editar{{ $item->id }}').classList.add('hidden')"
                            class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium transition active:scale-95">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium transition active:scale-95">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- MODAL CREAR -->
    <div id="modalCrear"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="bg-blue-600 px-8 py-6 text-white flex items-center justify-between sticky top-0">
                <div>
                    <h2 class="text-3xl font-bold">Nueva Experiencia</h2>
                    <p class="text-blue-100 mt-1 text-sm">Agrega un cargo o posición laboral.</p>
                </div>
                <button type="button" onclick="document.getElementById('modalCrear').classList.add('hidden')"
                    class="text-white hover:rotate-90 transition text-3xl">×</button>
            </div>

            <form action="{{ route('talento.experiencia.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Cargo / Posición <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="cargo" value="{{ old('cargo') }}" required minlength="3" maxlength="100"
                            class="w-full border {{ $errors->has('cargo') ? 'border-red-500 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                            placeholder="Ej: Desarrollador Senior">
                        @error('cargo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Empresa <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="institucion_o_empresa" value="{{ old('institucion_o_empresa') }}"
                            required minlength="3" maxlength="100"
                            class="w-full border {{ $errors->has('institucion_o_empresa') ? 'border-red-500 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                            placeholder="Ej: Acme Corp">
                        @error('institucion_o_empresa')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Fecha Inicio <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="ingreso" value="{{ old('ingreso') }}" required
                            class="w-full border {{ $errors->has('ingreso') ? 'border-red-500 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @error('ingreso')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Fecha Término <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="egresoCrear" name="egreso" value="{{ old('egreso') }}" required
                            class="w-full border {{ $errors->has('egreso') ? 'border-red-500 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @error('egreso')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="actualidad" id="actualidadCrear" class="w-5 h-5 text-blue-600 rounded">
                            <span class="font-medium text-gray-700">Actualmente trabajo aquí</span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Funciones</label>
                        <textarea name="funciones" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3"
                            placeholder="Describe tus funciones principales"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <div class="border-t pt-6 mt-2">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Referencia Laboral (Opcional)</h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Nombre Referencia</label>
                                    <input type="text" name="referencia_nombre" value="{{ old('referencia_nombre') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Cargo Referencia</label>
                                    <input type="text" name="referencia_cargo" value="{{ old('referencia_cargo') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3">
                                </div>
                                <div class="flex">
                                    <span class="px-4 py-3 border border-r-0 rounded-l-xl bg-gray-100">+569</span>
                                    <input type="text" name="referencia_telefono" maxlength="8" pattern="[0-9]{8}"
                                        placeholder="12345678" value="{{ old('referencia_telefono') }}"
                                        class="w-full border rounded-r-xl px-4 py-3">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Correo</label>
                                    <input type="email" name="referencia_correo" value="{{ old('referencia_correo') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-4 mt-8 pt-6 border-t">
                    <button type="button" onclick="document.getElementById('modalCrear').classList.add('hidden')"
                        class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium transition active:scale-95">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium transition active:scale-95">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Checkbox "actualmente trabajo aquí" del modal crear
            const checkbox = document.getElementById('actualidadCrear');
            const fechaTermino = document.getElementById('egresoCrear');
            if (checkbox && fechaTermino) {
                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        fechaTermino.value = '';
                        fechaTermino.disabled = true;
                        fechaTermino.required = false;
                    } else {
                        fechaTermino.disabled = false;
                        fechaTermino.required = true;
                    }
                });
            }

            // Checkboxes de modales editar
            @foreach ($experiencias as $item)
                (function () {
                    const cb = document.getElementById('actualidad{{ $item->id }}');
                    const fe = document.getElementById('egreso{{ $item->id }}');
                    if (cb && fe) {
                        if (cb.checked) fe.disabled = true;
                        cb.addEventListener('change', function () {
                            if (this.checked) {
                                fe.value = '';
                                fe.disabled = true;
                            } else {
                                fe.disabled = false;
                            }
                        });
                    }
                })();
            @endforeach
        });
    </script>

</x-talento-layout>
