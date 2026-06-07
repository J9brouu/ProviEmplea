<x-talento-layout>

    <div class="space-y-8">

        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800">
                    Formación Académica y Cursos
                </h1>
                <p class="text-gray-500 mt-2">
                    Formación académica, cursos y certificaciones que has realizado. Mantén esta sección actualizada
                    para destacar tu perfil profesional.
                </p>
            </div>

            <button onclick="document.getElementById('modalEducacion').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition shadow">
                Agregar Formación / Curso
            </button>

        </div>
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="text-2xl font-bold text-gray-800">
            Formación Académica
        </h2>
        <!-- LISTADO EDUCACIÓN -->
        @forelse($educaciones as $educacion)
            <div class="bg-white rounded-2xl shadow p-8 border-t-4 border-green-500">

                <div class="flex justify-between items-start">

                    <div>

                        <span class="inline-block bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">
                            Educación
                        </span>

                        <h2 class="text-3xl font-bold text-gray-800 mt-4">
                            {{ $educacion->titulo }}
                        </h2>

                        <p class="text-blue-600 font-semibold mt-2">
                            {{ $educacion->nombre_institucion }}
                        </p>

                        <p class="text-gray-500 mt-3 text-sm">
                            {{ \Carbon\Carbon::parse($educacion->ingreso)->format('M Y') }}
                            -
                            {{ $educacion->egreso ? \Carbon\Carbon::parse($educacion->egreso)->format('M Y') : 'En Curso' }}
                        </p>

                    </div>

                    <div class="flex gap-3">

                        <button
                            onclick="document.getElementById('editarEducacion{{ $educacion->id }}').classList.remove('hidden')"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg">
                            Editar
                        </button>

                        <form action="{{ route('talento.educacion.destroy', $educacion->id) }}" method="POST" id="form-edu-{{ $educacion->id }}">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                @click="$dispatch('confirm-delete', { title: 'Eliminar Formación', message: '¿Eliminar esta formación académica?', formId: 'form-edu-{{ $educacion->id }}' })"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                Eliminar
                            </button>

                        </form>

                    </div>

                </div>

            </div>


        @empty

            <div class="bg-white rounded-2xl shadow p-8">
                No tienes educación registrada.
            </div>
        @endforelse
        <!-- LISTADO CURSOS -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Cursos y Certificaciones
            </h2>

            @forelse($perfeccionamientos as $curso)
                <div class="bg-white rounded-2xl shadow p-8 border-t-4 border-blue-500">

                    <div class="flex justify-between items-start">

                        <div>

                            <span class="inline-block bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
                                {{ $curso->tipo }}
                            </span>

                            <h2 class="text-3xl font-bold text-gray-800 mt-4">
                                {{ $curso->nombre_curso }}
                            </h2>

                            <p class="text-green-600 font-semibold mt-2">
                                {{ $curso->institucion }}
                            </p>

                            <p class="text-gray-500 mt-3 text-sm">
                                {{ \Carbon\Carbon::parse($curso->ingreso)->format('M Y') }}
                                -
                                {{ $curso->egreso ? \Carbon\Carbon::parse($curso->egreso)->format('M Y') : 'Actualidad' }}
                            </p>

                        </div>

                        <div class="flex gap-3">

                            <button
                                onclick="document.getElementById('editarCurso{{ $curso->id }}').classList.remove('hidden')"
                                class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg">
                                Editar
                            </button>

                            <form action="{{ route('talento.educacion.curso.destroy', $curso->id) }}" method="POST" id="form-curso-{{ $curso->id }}">

                                @csrf
                                @method('DELETE')

                                <button type="button"
                                    @click="$dispatch('confirm-delete', { title: 'Eliminar Curso', message: '¿Eliminar este curso o certificación?', formId: 'form-curso-{{ $curso->id }}' })"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                    Eliminar
                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            @empty
                <div class="bg-white rounded-2xl shadow p-8">
                    No tienes certificaciones registradas.
                </div>
            @endforelse

        </div>

    </div>
    <!-- MODAL CREAR -->
    <div id="modalEducacion"
        class="hidden fixed top-0 left-0 w-screen h-screen z-[9999] bg-black/80 flex items-center justify-center">

        <div class="bg-white rounded-3xl w-full max-w-3xl shadow-2xl overflow-hidden">

            <div class="bg-blue-600 text-white p-8 flex justify-between items-center">

                <div>
                    <h2 class="text-4xl font-bold">
                        Nueva Educación
                    </h2>

                    <p class="opacity-90">
                        Agrega un curso o certificación.
                    </p>
                </div>

                <button onclick="document.getElementById('modalEducacion').classList.add('hidden')" class="text-3xl">
                    ×
                </button>

            </div>

            <form method="POST" action="{{ route('talento.educacion.store') }}" class="p-8 space-y-6">

                @csrf
                <div>
                    <label class="font-semibold">
                        Tipo de Registro
                    </label>

                    <select name="categoria" id="categoria" class="w-full border rounded-xl px-4 py-3 mt-2">
                        <option value="educacion">
                            Formación Académica
                        </option>

                        <option value="certificacion">
                            Curso / Certificación
                        </option>
                    </select>
                </div>

                <div>
                    <label class="font-semibold">
                        Nombre Curso
                    </label>

                    <input type="text" name="nombre_curso" class="w-full border rounded-xl px-4 py-3 mt-2" required>
                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold">
                            Institución
                        </label>

                        <input type="text" name="institucion" class="w-full border rounded-xl px-4 py-3 mt-2"
                            required>
                    </div>
                    <div id="bloqueTipo">
                        <div>
                            <label class="font-semibold">
                                Tipo
                            </label>

                            <select id="tipo" name="tipo" class="w-full border rounded-xl px-4 py-3 mt-2">

                                <option value="">
                                    Seleccionar
                                </option>

                                <option value="Curso">
                                    Curso
                                </option>

                                <option value="Certificación">
                                    Certificación
                                </option>

                                <option value="Diplomado">
                                    Diplomado
                                </option>

                                <option value="Bootcamp">
                                    Bootcamp
                                </option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold">
                            Fecha Inicio
                        </label>

                        <input type="date" name="ingreso" class="w-full border rounded-xl px-4 py-3 mt-2" required>
                    </div>

                    <div>
                        <label class="font-semibold">
                            Fecha Término
                        </label>

                        <input type="date" id="egresoCrear" name="egreso"
                            class="w-full border rounded-xl px-4 py-3 mt-2">
                    </div>

                </div>

                <label id="bloqueActualidad" class="flex items-center gap-3">

                    <input type="checkbox" id="actualidadCrear" name="actualidad">

                    Actualmente estudio aquí

                </label>

                <div class="flex justify-end gap-4 pt-6">

                    <button type="button" onclick="document.getElementById('modalEducacion').classList.add('hidden')"
                        class="px-6 py-3 bg-gray-200 rounded-xl">

                        Cancelar

                    </button>

                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl">

                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>
    @foreach ($educaciones as $educacion)
        <!-- MODAL EDITAR -->
        <div id="editarEducacion{{ $educacion->id }}"
            class="hidden fixed inset-0 z-[9999] bg-black/80 flex items-center justify-center p-4">

            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">

                <!-- HEADER -->
                <div class="bg-blue-600 px-8 py-6 text-white flex items-center justify-between rounded-t-3xl">

                    <div>
                        <h2 class="text-3xl font-bold">
                            Editar Educación
                        </h2>

                        <p class="text-blue-100 mt-1 text-sm">
                            Actualiza tu formación académica.
                        </p>
                    </div>

                    <button type="button"
                        onclick="document.getElementById('editarEducacion{{ $educacion->id }}').classList.add('hidden')"
                        class="text-white hover:rotate-90 transition text-3xl">
                        ×
                    </button>

                </div>

                <form action="{{ route('talento.educacion.update', $educacion->id) }}" method="POST"
                    class="p-8">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Título
                            </label>

                            <input type="text" name="nombre_curso" value="{{ $educacion->titulo }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Institución
                            </label>

                            <input type="text" name="institucion" value="{{ $educacion->nombre_institucion }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Fecha Inicio
                            </label>

                            <input type="date" name="ingreso" value="{{ $educacion->ingreso }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Fecha Término
                            </label>

                            <input type="date" id="egresoEducacion{{ $educacion->id }}" name="egreso"
                                value="{{ $educacion->egreso }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center gap-3">

                                <input type="checkbox" id="actualidadEducacion{{ $educacion->id }}"
                                    name="actualidad" {{ $educacion->egreso == null ? 'checked' : '' }}>

                                Actualmente estudio aquí

                            </label>
                        </div>

                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t">

                        <button type="button"
                            onclick="document.getElementById('editarEducacion{{ $educacion->id }}').classList.add('hidden')"
                            class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                            Cancelar

                        </button>

                        <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white">

                            Guardar Cambios

                        </button>

                    </div>

                </form>

            </div>

        </div>
    @endforeach
    <!-- MODALES EDITAR CURSOS -->
    @foreach ($perfeccionamientos as $curso)
        <div id="editarCurso{{ $curso->id }}"
            class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">

            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">

                <div class="bg-blue-600 px-8 py-6 text-white flex items-center justify-between rounded-t-3xl">

                    <div>
                        <h2 class="text-3xl font-bold">
                            Editar Certificación
                        </h2>

                        <p class="text-blue-100 mt-1 text-sm">
                            Actualiza tu curso o certificación.
                        </p>
                    </div>

                    <button type="button"
                        onclick="document.getElementById('editarCurso{{ $curso->id }}').classList.add('hidden')"
                        class="text-white hover:rotate-90 transition text-3xl">
                        ×
                    </button>

                </div>

                <form action="{{ route('talento.educacion.curso.update', $curso->id) }}" method="POST"
                    class="p-8">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nombre Curso
                            </label>

                            <input type="text" name="nombre_curso" value="{{ $curso->nombre_curso }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Institución
                            </label>

                            <input type="text" name="institucion" value="{{ $curso->institucion }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tipo
                            </label>

                            <select name="tipo" class="w-full border border-gray-300 rounded-xl px-4 py-3">

                                <option value="Curso" {{ $curso->tipo == 'Curso' ? 'selected' : '' }}>
                                    Curso
                                </option>

                                <option value="Certificación" {{ $curso->tipo == 'Certificación' ? 'selected' : '' }}>
                                    Certificación
                                </option>

                                <option value="Diplomado" {{ $curso->tipo == 'Diplomado' ? 'selected' : '' }}>
                                    Diplomado
                                </option>

                                <option value="Bootcamp" {{ $curso->tipo == 'Bootcamp' ? 'selected' : '' }}>
                                    Bootcamp
                                </option>

                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Fecha Inicio
                            </label>

                            <input type="date" name="ingreso" value="{{ $curso->ingreso }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Fecha Término
                            </label>

                            <input type="date" name="egreso" value="{{ $curso->egreso }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>

                    </div>
                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t">

                        <button type="button"
                            onclick="document.getElementById('editarCurso{{ $curso->id }}').classList.add('hidden')"
                            class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                            Cancelar

                        </button>

                        <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white">

                            Guardar Cambios

                        </button>

                    </div>

                </form>

            </div>

        </div>
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const categoria = document.getElementById('categoria');
            const bloqueTipo = document.getElementById('bloqueTipo');
            const tipo = document.getElementById('tipo');
            const bloqueActualidad = document.getElementById('bloqueActualidad');

            function actualizarFormulario() {
                if (categoria.value === 'educacion') {
                    bloqueTipo.style.display = 'none';
                    bloqueActualidad.style.display = 'flex';
                    tipo.removeAttribute('required');
                } else {
                    bloqueTipo.style.display = 'block';
                    bloqueActualidad.style.display = 'none';
                    tipo.setAttribute('required', 'required');
                }
            }

            categoria.addEventListener('change', actualizarFormulario);

            actualizarFormulario();

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            @foreach ($educaciones as $educacion)

                const check{{ $educacion->id }} =
                    document.getElementById('actualidadEducacion{{ $educacion->id }}');

                const egreso{{ $educacion->id }} =
                    document.getElementById('egresoEducacion{{ $educacion->id }}');

                function actualizarEstado{{ $educacion->id }}() {

                    if (check{{ $educacion->id }}.checked) {

                        egreso{{ $educacion->id }}.value = '';
                        egreso{{ $educacion->id }}.disabled = true;

                    } else {

                        egreso{{ $educacion->id }}.disabled = false;

                    }
                }

                check{{ $educacion->id }}.addEventListener(
                    'change',
                    actualizarEstado{{ $educacion->id }}
                );

                actualizarEstado{{ $educacion->id }}();
            @endforeach

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkCrear = document.getElementById('actualidadCrear');
            const egresoCrear = document.getElementById('egresoCrear');
            if (checkCrear && egresoCrear) {
                checkCrear.addEventListener('change', function () {
                    if (this.checked) {
                        egresoCrear.value = '';
                        egresoCrear.disabled = true;
                    } else {
                        egresoCrear.disabled = false;
                    }
                });
            }
        });
    </script>

</x-talento-layout>
