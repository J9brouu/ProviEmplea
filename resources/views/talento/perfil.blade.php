<x-talento-layout>

    <div class="space-y-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif
        <!-- Título -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Mi Perfil
            </h1>

            <p class="text-gray-500 mt-2">
                Información profesional del talento.
            </p>
        </div>

        <!-- Perfil Principal -->
        <div class="bg-white rounded-2xl shadow p-8">

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
                        {{ $talento->direccion }}
                    </p>

                </div>

                <button type="button"
                    onclick=" document.getElementById('modalPerfil').classList.remove('hidden'); document.getElementById('modalPerfil').classList.add('flex');"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                    Editar Perfil
                </button>

            </div>

        </div>

        <!-- Información Personal -->
        <div class="bg-white rounded-2xl shadow p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Información Personal
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <span class="text-gray-500">Edad</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->edad }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Género</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->genero }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Teléfono</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->telefono }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Dirección</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->direccion }}
                    </p>
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
                        {{ $talento->condicion_modalidad }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Jornada</span>
                    <p class="font-semibold text-lg">
                        {{ $talento->condicion_jornada }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Renta Desde</span>
                    <p class="font-semibold text-lg">
                        ${{ number_format($talento->renta_desde, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Renta Hasta</span>
                    <p class="font-semibold text-lg">
                        ${{ number_format($talento->renta_hasta, 0, ',', '.') }}
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
                <button type="button"
                    onclick="
                    const modal = document.getElementById('modalPerfil');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                "
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">

                    &times;

                </button>

            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('talento.perfil.update') }}" class="space-y-5">
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('talento.perfil.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
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
                                    value="{{ str_replace('+569', '', $talento->telefono) }}" placeholder="12345678"
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

                            <input type="number" name="renta_desde" value="{{ $talento->renta_desde }}"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                        </div>

                        <!-- RENTA HASTA -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Renta Hasta
                            </label>

                            <input type="number" name="renta_hasta" value="{{ $talento->renta_hasta }}"
                                class="w-full border border-gray-300 rounded-2xl px-4 py-3">
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

                        <button type="button"
                            onclick="
                        const modal = document.getElementById('modalPerfil');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    "
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">

                            Cancelar

                        </button>

                    </div>

                </form>

        </div>

    </div>
</x-talento-layout>
