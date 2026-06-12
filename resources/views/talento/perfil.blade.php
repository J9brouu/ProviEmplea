<x-talento-layout>

    <div class="space-y-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Título -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">
                Mi Perfil
            </h1>

            <p class="text-gray-500 mt-2">
                Información profesional del talento.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 md:p-8">

            <div class="flex flex-col md:flex-row items-center gap-8">

                <div
                    class="w-32 h-32 rounded-full bg-blue-600 flex items-center justify-center text-white text-5xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="flex-1">

                    <h2 class="text-4xl font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-xl text-gray-500 mt-2">
                        {{ auth()->user()->email }}
                    </p>

                    <p class="text-gray-400 mt-2">
                        {{ $talento->direccion ?? '' }}
                    </p>

                </div>

                <div class="flex flex-col items-end gap-3">
                    <div class="flex gap-2">
                        <a href="{{ route('talento.cv.descargar') }}"
                            class="bg-gray-700 hover:bg-gray-900 text-white px-5 py-3 rounded-xl font-semibold transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Descargar CV
                        </a>
                        <button type="button" onclick="openModal()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                            Editar Perfil
                        </button>
                    </div>
                    @php
                        $colorBarra = $completitud >= 80 ? 'bg-green-500' : ($completitud >= 50 ? 'bg-blue-500' : 'bg-yellow-500');
                        $colorTexto = $completitud >= 80 ? 'text-green-600' : ($completitud >= 50 ? 'text-blue-600' : 'text-yellow-600');
                    @endphp
                    <div class="w-40 text-right">
                        <span class="text-xs font-semibold {{ $colorTexto }}">Perfil {{ $completitud }}% completo</span>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="{{ $colorBarra }} h-2 rounded-full" style="width: {{ $completitud }}%"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6 md:p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Información Personal
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <span class="text-gray-500">Edad</span>
                    <p class="font-semibold text-lg">{{ $talento->edad ?: 'N/A' }}</p>
                </div>

                <div>
                    <span class="text-gray-500">Género</span>
                    <p class="font-semibold text-lg">{{ $talento->genero ?: 'N/A' }}</p>
                </div>

                <div>
                    <span class="text-gray-500">Teléfono</span>
                    <p class="font-semibold text-lg">{{ $talento->telefono ?: 'N/A' }}</p>
                </div>

                <div>
                    <span class="text-gray-500">Dirección</span>
                    <p class="font-semibold text-lg">{{ $talento->direccion ?: 'N/A' }}</p>
                </div>

            </div>

        </div>

        <!-- Preferencias Laborales -->
        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Preferencias Laborales
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <span class="text-gray-500">Modalidad</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->condicion_modalidad ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Jornada</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->condicion_jornada ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Renta Desde</span>
                    <p class="font-semibold text-lg">
                        ${{ number_format($talento->renta_desde ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Renta Hasta</span>
                    <p class="font-semibold text-lg">
                        ${{ number_format($talento->renta_hasta ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <span class="text-gray-500">Ley 21.015</span>
                    <p class="mt-1">
                        @if($talento->discapacidad)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                ♿ Persona con discapacidad registrada
                            </span>
                        @else
                            <span class="text-gray-400 text-sm">No registrado</span>
                        @endif
                    </p>
                </div>

            </div>

        </div>

        <!-- Resumen -->
        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Resumen Profesional
            </h2>

            <p class="text-gray-600 leading-relaxed">
                {{ $talento->resumen ?: 'Aún no has completado tu resumen profesional.' }}
            </p>

        </div>
        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Competencias Técnicas</h2>
                @if(count($competencias) > 0 || $otras_competencias)
                    <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full font-medium">
                        {{ count($competencias) + (($otras_competencias) ? count(array_filter(array_map('trim', explode(',', $otras_competencias)))) : 0) }} guardadas
                    </span>
                @endif
            </div>

            {{-- Competencias actualmente guardadas --}}
            @if(count($competencias) > 0 || $otras_competencias)
                <div class="mb-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-sm text-gray-500 mb-3 font-medium">Competencias guardadas actualmente:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($competencias as $c)
                            <span class="bg-blue-600 text-white text-sm px-4 py-1.5 rounded-full font-medium">
                                {{ $c }}
                            </span>
                        @endforeach
                        @if($otras_competencias)
                            @foreach(array_filter(array_map('trim', explode(',', $otras_competencias))) as $c)
                                <span class="bg-indigo-500 text-white text-sm px-4 py-1.5 rounded-full font-medium">
                                    {{ $c }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('talento.competencias.store') }}">
                @csrf

                <p class="text-sm text-gray-500 mb-4">Selecciona las que apliquen:</p>

                {{-- Chips seleccionables --}}
                <div class="flex flex-wrap gap-3 mb-6">
                    @foreach ($lista as $comp)
                        @php $checked = in_array($comp, $competencias); @endphp
                        <label class="cursor-pointer select-none">
                            <input type="checkbox" name="competencias[]" value="{{ $comp }}"
                                {{ $checked ? 'checked' : '' }}
                                class="sr-only peer"
                                onchange="this.closest('label').querySelector('span').classList.toggle('bg-blue-600', this.checked);
                                          this.closest('label').querySelector('span').classList.toggle('text-white', this.checked);
                                          this.closest('label').querySelector('span').classList.toggle('border-blue-600', this.checked);
                                          this.closest('label').querySelector('span').classList.toggle('border-gray-300', !this.checked);
                                          this.closest('label').querySelector('span').classList.toggle('text-gray-600', !this.checked);">
                            <span class="inline-flex items-center px-4 py-2 rounded-full border-2 text-sm font-medium transition-all
                                {{ $checked ? 'bg-blue-600 text-white border-blue-600' : 'border-gray-300 text-gray-600 hover:border-blue-400' }}">
                                {{ $comp }}
                            </span>
                        </label>
                    @endforeach
                </div>

                {{-- Otras competencias con tags dinámicos --}}
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Otras competencias
                        <span class="text-gray-400 font-normal">(escribe y presiona Enter o coma para agregar)</span>
                    </label>

                    {{-- Tags dinámicos --}}
                    <div id="tagsContainer" class="flex flex-wrap gap-2 mb-3">
                        @if($otras_competencias)
                            @foreach(array_filter(array_map('trim', explode(',', $otras_competencias))) as $tag)
                                <span class="tag-item inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 text-sm px-3 py-1 rounded-full">
                                    <span class="tag-label">{{ $tag }}</span>
                                    <button type="button" class="hover:text-red-500 font-bold ml-1">&times;</button>
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <input type="hidden" name="otras_competencias" id="otrasInput"
                        value="{{ $otras_competencias ?? '' }}">

                    <input type="text" id="tagInput"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Ej: Photoshop, Softland, AutoCAD...">
                </div>

                <button type="submit"
                    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition shadow">
                    Guardar Competencias
                </button>
            </form>

        </div>

        <!-- Idiomas -->
        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Idiomas</h2>
                @if($idiomas->count() > 0)
                    <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full font-medium">
                        {{ $idiomas->count() }} {{ $idiomas->count() == 1 ? 'idioma' : 'idiomas' }}
                    </span>
                @endif
            </div>

            {{-- Idiomas guardados --}}
            @if($idiomas->count() > 0)
                <div class="mb-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-sm text-gray-500 mb-3 font-medium">Idiomas guardados actualmente:</p>
                    <div class="flex flex-wrap gap-3">
                        @foreach($idiomas as $idioma)
                            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2 shadow-sm">
                                <span class="font-semibold text-gray-800">{{ $idioma->nombre_idioma }}</span>
                                <span class="text-xs px-2 py-0.5 rounded-full
                                    @if($idioma->nivel == 'Nativo') bg-blue-600 text-white
                                    @elseif($idioma->nivel == 'Avanzado') bg-blue-100 text-blue-700
                                    @elseif($idioma->nivel == 'Intermedio') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ $idioma->nivel }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('talento.idiomas.store') }}" id="formIdiomas">
                @csrf

                <p class="text-sm text-gray-500 mb-4">Agrega los idiomas que manejas y tu nivel en cada uno:</p>

                <div id="idiomasContainer" class="space-y-3">
                    @forelse($idiomas as $i => $idioma)
                        <div class="idioma-row flex gap-3 items-center">
                            <select name="idiomas[{{ $i }}][nombre]"
                                class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                @foreach($listaIdiomas as $op)
                                    <option value="{{ $op }}" {{ $idioma->nombre_idioma == $op ? 'selected' : '' }}>{{ $op }}</option>
                                @endforeach
                            </select>
                            <select name="idiomas[{{ $i }}][nivel]"
                                class="w-40 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                @foreach($nivelesIdiomas as $nivel)
                                    <option value="{{ $nivel }}" {{ $idioma->nivel == $nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="this.closest('.idioma-row').remove()"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-100 hover:bg-red-200 text-red-500 font-bold text-lg transition">
                                &times;
                            </button>
                        </div>
                    @empty
                        <div class="idioma-row flex gap-3 items-center">
                            <select name="idiomas[0][nombre]"
                                class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                @foreach($listaIdiomas as $op)
                                    <option value="{{ $op }}">{{ $op }}</option>
                                @endforeach
                            </select>
                            <select name="idiomas[0][nivel]"
                                class="w-40 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                @foreach($nivelesIdiomas as $nivel)
                                    <option value="{{ $nivel }}">{{ $nivel }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="this.closest('.idioma-row').remove()"
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-100 hover:bg-red-200 text-red-500 font-bold text-lg transition">
                                &times;
                            </button>
                        </div>
                    @endforelse
                </div>

                <button type="button" id="btnAgregarIdioma"
                    class="mt-4 flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition">
                    <span class="text-xl leading-none">+</span> Agregar otro idioma
                </button>

                <button type="submit"
                    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition shadow">
                    Guardar Idiomas
                </button>
            </form>

        </div>

        <!-- Estado -->
        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Estado del Perfil
            </h2>

            @php
                $estado = auth()->user()->estado;
            @endphp

            @if ($estado == 'activo')
                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">
                    Perfil Activo
                </span>
            @elseif($estado == 'pendiente')
                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">
                    Pendiente de Validación
                </span>
            @elseif($estado == 'bloqueado')
                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full font-semibold">
                    Perfil Bloqueado
                </span>
            @elseif($estado == 'rechazado')
                <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full font-semibold">
                    Perfil Rechazado
                </span>
            @endif

        </div>

    </div>

    <!-- MODAL PERFIL TALENTO -->

    <div id="modalPerfil"
        class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">

        <!-- CAJA -->
        <div class="bg-white w-full max-w-5xl rounded-3xl shadow-2xl p-8 relative max-h-[90vh] overflow-y-auto">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Editar Perfil
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Actualiza tu información profesional
                    </p>

                </div>

                <!-- CERRAR -->
                <button type="button" onclick="closeModal()"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">

                    &times;

                </button>

            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('talento.perfil.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Nombre Completo
                        </label>

                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                    </div>

                    <!-- Correo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Correo Electrónico
                        </label>

                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- EDAD -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Edad
                            </label>

                            <input type="number" name="edad" min="18" max="99" step="1"
                                value="{{ $talento->edad }}"
                                oninput="if(this.value.length > 2) this.value = this.value.slice(0,2)"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <!-- GENERO -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Género
                            </label>

                            <select name="genero"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                <option value="Masculino" {{ $talento->genero == 'Masculino' ? 'selected' : '' }}>
                                    Masculino
                                </option>

                                <option value="Femenino" {{ $talento->genero == 'Femenino' ? 'selected' : '' }}>
                                    Femenino
                                </option>

                                <option value="No especificado"
                                    {{ $talento->genero == 'No especificado' ? 'selected' : '' }}>
                                    No especificado
                                </option>

                            </select>
                        </div>

                        <!-- TELEFONO -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Teléfono
                            </label>

                            <div class="flex">
                                <div
                                    class="px-4 py-3 border border-gray-300 border-r-0 rounded-l-2xl bg-gray-50 text-gray-600 font-medium">
                                    +569
                                </div>

                                <input type="text" name="telefono" maxlength="8" pattern="[0-9]{8}"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    value="{{ str_replace('+569', '', $talento->telefono ?? '') }}" placeholder="12345678"
                                    class="flex-1 border border-gray-300 rounded-r-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                        </div>

                        <!-- DIRECCION -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Dirección
                            </label>

                            <input type="text" name="direccion" value="{{ $talento->direccion }}"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                        </div>

                        <!-- MODALIDAD -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Modalidad
                            </label>

                            <select name="condicion_modalidad"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3">

                                <option value="Presencial"
                                    {{ $talento->condicion_modalidad == 'Presencial' ? 'selected' : '' }}>
                                    Presencial
                                </option>

                                <option value="Híbrido"
                                    {{ $talento->condicion_modalidad == 'Híbrido' ? 'selected' : '' }}>
                                    Híbrido
                                </option>

                                <option value="Remoto"
                                    {{ $talento->condicion_modalidad == 'Remoto' ? 'selected' : '' }}>
                                    Remoto
                                </option>

                            </select>
                        </div>

                        <!-- JORNADA -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Jornada
                            </label>

                            <select name="condicion_jornada"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3">

                                <option value="Full-Time"
                                    {{ $talento->condicion_jornada == 'Full-Time' ? 'selected' : '' }}>
                                    Full-Time
                                </option>

                                <option value="Part-Time"
                                    {{ $talento->condicion_jornada == 'Part-Time' ? 'selected' : '' }}>
                                    Part-Time
                                </option>

                                <option value="Freelance"
                                    {{ $talento->condicion_jornada == 'Freelance' ? 'selected' : '' }}>
                                    Freelance
                                </option>

                            </select>
                        </div>

                        <!-- RENTA DESDE -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Renta Desde
                            </label>
                            <select name="renta_desde" class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                                <option value="0">Sin especificar</option>
                                <option value="400000"  {{ ($talento->renta_desde ?? 0) == 400000  ? 'selected' : '' }}>$ 400.000</option>
                                <option value="500000"  {{ ($talento->renta_desde ?? 0) == 500000  ? 'selected' : '' }}>$ 500.000</option>
                                <option value="600000"  {{ ($talento->renta_desde ?? 0) == 600000  ? 'selected' : '' }}>$ 600.000</option>
                                <option value="700000"  {{ ($talento->renta_desde ?? 0) == 700000  ? 'selected' : '' }}>$ 700.000</option>
                                <option value="800000"  {{ ($talento->renta_desde ?? 0) == 800000  ? 'selected' : '' }}>$ 800.000</option>
                                <option value="900000"  {{ ($talento->renta_desde ?? 0) == 900000  ? 'selected' : '' }}>$ 900.000</option>
                                <option value="1000000" {{ ($talento->renta_desde ?? 0) == 1000000 ? 'selected' : '' }}>$ 1.000.000</option>
                                <option value="1200000" {{ ($talento->renta_desde ?? 0) == 1200000 ? 'selected' : '' }}>$ 1.200.000</option>
                                <option value="1500000" {{ ($talento->renta_desde ?? 0) == 1500000 ? 'selected' : '' }}>$ 1.500.000</option>
                                <option value="2000000" {{ ($talento->renta_desde ?? 0) == 2000000 ? 'selected' : '' }}>$ 2.000.000</option>
                                <option value="2500000" {{ ($talento->renta_desde ?? 0) == 2500000 ? 'selected' : '' }}>$ 2.500.000</option>
                                <option value="3000000" {{ ($talento->renta_desde ?? 0) == 3000000 ? 'selected' : '' }}>$ 3.000.000</option>
                            </select>
                        </div>

                        <!-- RENTA HASTA -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Renta Hasta
                            </label>
                            <select name="renta_hasta" class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                                <option value="0">Sin especificar</option>
                                <option value="500000"  {{ ($talento->renta_hasta ?? 0) == 500000  ? 'selected' : '' }}>$ 500.000</option>
                                <option value="600000"  {{ ($talento->renta_hasta ?? 0) == 600000  ? 'selected' : '' }}>$ 600.000</option>
                                <option value="700000"  {{ ($talento->renta_hasta ?? 0) == 700000  ? 'selected' : '' }}>$ 700.000</option>
                                <option value="800000"  {{ ($talento->renta_hasta ?? 0) == 800000  ? 'selected' : '' }}>$ 800.000</option>
                                <option value="900000"  {{ ($talento->renta_hasta ?? 0) == 900000  ? 'selected' : '' }}>$ 900.000</option>
                                <option value="1000000" {{ ($talento->renta_hasta ?? 0) == 1000000 ? 'selected' : '' }}>$ 1.000.000</option>
                                <option value="1200000" {{ ($talento->renta_hasta ?? 0) == 1200000 ? 'selected' : '' }}>$ 1.200.000</option>
                                <option value="1500000" {{ ($talento->renta_hasta ?? 0) == 1500000 ? 'selected' : '' }}>$ 1.500.000</option>
                                <option value="2000000" {{ ($talento->renta_hasta ?? 0) == 2000000 ? 'selected' : '' }}>$ 2.000.000</option>
                                <option value="2500000" {{ ($talento->renta_hasta ?? 0) == 2500000 ? 'selected' : '' }}>$ 2.500.000</option>
                                <option value="3000000" {{ ($talento->renta_hasta ?? 0) == 3000000 ? 'selected' : '' }}>$ 3.000.000</option>
                                <option value="4000000" {{ ($talento->renta_hasta ?? 0) == 4000000 ? 'selected' : '' }}>$ 4.000.000</option>
                            </select>
                        </div>

                        <!-- LEY 21.015 (solo lectura — validada por el admin) -->
                        <div class="md:col-span-2">
                            @if($talento->discapacidad)
                                <div class="flex items-center gap-3 p-4 bg-blue-50 border border-blue-200 rounded-2xl">
                                    <span class="text-2xl">♿</span>
                                    <div>
                                        <p class="font-semibold text-blue-800">Ley 21.015 — Certificado validado</p>
                                        <p class="text-sm text-blue-600">Tu certificado de discapacidad fue aprobado por el equipo ProviEmplea.</p>
                                    </div>
                                    <span class="ml-auto bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Validado</span>
                                </div>
                            @else
                                <div class="flex items-center gap-3 p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                                    <span class="text-2xl">♿</span>
                                    <div>
                                        <p class="font-semibold text-gray-700">Ley 21.015 — Sin certificado validado</p>
                                        <p class="text-sm text-gray-500">Para acreditar esta condición, sube tu certificado en la sección
                                            <a href="{{ route('talento.documentos') }}" class="text-blue-600 hover:underline font-medium">Documentos</a>.
                                            El equipo ProviEmplea lo revisará.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- RESUMEN -->
                    <div class="mt-6">

                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Resumen Profesional
                        </label>

                        <textarea name="resumen" rows="5" class="w-full border border-gray-300 rounded-2xl px-4 py-3">{{ $talento->resumen }}</textarea>

                    </div>
                    <!-- BOTONES -->
                    <div class="flex gap-3 pt-4">

                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow">

                            Guardar Cambios

                        </button>

                        <button type="button" onclick="closeModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">

                            Cancelar

                        </button>

                    </div>

            </form>

        </div>

    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modalPerfil');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeModal() {
            const modal = document.getElementById('modalPerfil');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        @if ($errors->any())
            openModal();
        @endif

        // --- Idiomas dinámicos ---
        const listaIdiomas  = @json($listaIdiomas);
        const nivelesIdiomas = @json($nivelesIdiomas);
        const container     = document.getElementById('idiomasContainer');
        const btnAgregar    = document.getElementById('btnAgregarIdioma');

        btnAgregar.addEventListener('click', function () {
            const idx  = container.querySelectorAll('.idioma-row').length;
            const row  = document.createElement('div');
            row.className = 'idioma-row flex gap-3 items-center';
            row.innerHTML =
                '<select name="idiomas[' + idx + '][nombre]" class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">'
                + listaIdiomas.map(op => '<option value="' + op + '">' + op + '<\/option>').join('')
                + '<\/select>'
                + '<select name="idiomas[' + idx + '][nivel]" class="w-40 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">'
                + nivelesIdiomas.map(n => '<option value="' + n + '">' + n + '<\/option>').join('')
                + '<\/select>'
                + '<button type="button" onclick="this.closest(\'.idioma-row\').remove()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-100 hover:bg-red-200 text-red-500 font-bold text-lg transition">&times;<\/button>';
            container.appendChild(row);
        });

        document.addEventListener('DOMContentLoaded', function () {
            const tagInput      = document.getElementById('tagInput');
            const tagsContainer = document.getElementById('tagsContainer');
            const otrasInput    = document.getElementById('otrasInput');
            const form          = tagsContainer.closest('form');

            function syncHidden() {
                const tags = [...tagsContainer.querySelectorAll('.tag-label')]
                    .map(el => el.textContent.trim())
                    .filter(Boolean);
                otrasInput.value = tags.join(', ');
            }

            function addTag(value) {
                const text = value.trim();
                if (!text) return;
                const span = document.createElement('span');
                span.className = 'tag-item inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 text-sm px-3 py-1 rounded-full';
                span.innerHTML = '<span class="tag-label">' + text + '<\/span>'
                    + '<button type="button" class="hover:text-red-500 font-bold ml-1">&times;<\/button>';
                span.querySelector('button').addEventListener('click', function () {
                    span.remove();
                    syncHidden();
                });
                tagsContainer.appendChild(span);
                syncHidden();
            }

            // Agregar tag con Enter o coma
            tagInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    addTag(this.value);
                    this.value = '';
                }
            });

            // Antes de enviar: convertir texto pendiente en tag y sincronizar
            form.addEventListener('submit', function () {
                if (tagInput.value.trim()) {
                    addTag(tagInput.value);
                    tagInput.value = '';
                }
                syncHidden();
            });

            // Sincronizar al cargar (para los tags precargados por Blade)
            // y vincular los botones × de los tags ya existentes
            tagsContainer.querySelectorAll('.tag-item').forEach(function (span) {
                span.querySelector('button').addEventListener('click', function () {
                    span.remove();
                    syncHidden();
                });
            });
            syncHidden();
        });
    </script>
</x-talento-layout>
