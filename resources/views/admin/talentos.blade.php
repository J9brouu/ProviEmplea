<x-admin-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div class="flex flex-wrap justify-between items-start gap-4">
            <div>
                <h1 class="text-3xl md:text-5xl font-bold text-slate-800">Gestión de Talentos</h1>
                <p class="text-gray-500 mt-2">Administración de perfiles registrados.</p>
            </div>
            <a href="{{ route('admin.validaciones') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow">
                Validaciones
            </a>
        </div>

        <!-- CARDS -->
        <div class="flex flex-wrap gap-4">

            <!-- TALENTOS -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border w-48">

                <p class="text-gray-500 text-sm">
                    Talentos
                </p>

                <h2 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $talentos->count() }}
                </h2>

            </div>

            <!-- ACTIVOS -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border w-48">

                <p class="text-gray-500 text-sm">
                    Activos
                </p>

                <h2 class="text-2xl font-bold text-green-600 mt-1">
                    {{ $talentos->where('user.estado', 'activo')->count() }}
                </h2>

            </div>

        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm border">

            <form method="GET" action="{{ route('admin.talentos') }}">

                <div class="flex gap-4">

                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar talento..."
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-xl">
                        Buscar
                    </button>

                </div>

            </form>

        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow-sm border overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">
                    <tr>

                        <th class="px-6 py-4 text-left w-[28%]">
                            Nombre
                        </th>

                        <th class="px-6 py-4 text-left w-[18%]">
                            Modalidad
                        </th>

                        <th class="px-6 py-4 text-center w-[18%]">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-left w-[18%]">
                            Jornada
                        </th>

                        <th class="px-6 py-4 text-center w-[10%]">
                            Ley 21.015
                        </th>

                        <th class="px-6 py-4 text-center w-[18%]">
                            Acciones
                        </th>

                    </tr>
                </thead>

                <tbody>


                    @foreach ($talentos as $talento)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium">
                                {{ $talento->user->name }}
                            </td>

                            <td>
                                {{ $talento->condicion_modalidad }}
                            </td>


                            <td class="text-center">

                                <span
                                    class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold

        @if ($talento->user->estado == 'activo') bg-green-100 text-green-700

        @elseif($talento->user->estado == 'pendiente')
            bg-yellow-100 text-yellow-700

        @elseif($talento->user->estado == 'bloqueado')
            bg-red-100 text-red-700

        @elseif($talento->user->estado == 'rechazado')
            bg-gray-200 text-gray-700 @endif
    ">

                                    {{ ucfirst($talento->user->estado) }}

                                </span>

                            </td>

                            <td>
                                {{ $talento->condicion_jornada }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($talento->discapacidad)
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        Ley 21.015</span>
                                @else
                                    <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>

                            <td class="flex gap-2 py-4">

                                <div x-data="{ open: false }">

                                    <!-- BOTON -->
                                    <button @click="open = true"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                        Ver
                                    </button>

                                    <!-- MODAL -->
                                    <!-- MODAL VER -->
                                    <div x-show="open" x-transition.opacity
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
                                        style="display: none;">

                                        <!-- CAJA -->
                                        <div @click.away="open = false" x-transition
                                            class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden">

                                            <!-- HEADER -->
                                            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">

                                                <div class="flex justify-between items-center">

                                                    <div>

                                                        <h2 class="text-3xl font-bold text-white">
                                                            {{ $talento->user->name }}
                                                        </h2>

                                                        <p class="text-blue-100 mt-1">
                                                            Información del talento
                                                        </p>

                                                    </div>

                                                    <button @click="open = false"
                                                        class="text-white text-3xl hover:rotate-90 transition">
                                                        ×
                                                    </button>

                                                </div>

                                            </div>

                                            <!-- BODY -->
                                            <div class="p-8">

                                                <div class="grid grid-cols-2 gap-6">

                                                    <!-- ESTADO -->
                                                    <div class="bg-gray-50 rounded-2xl p-5 border">

                                                        <p class="text-gray-500 text-sm mb-2">
                                                            Estado
                                                        </p>

                                                        <span
                                                            class="px-4 py-2 rounded-full text-sm font-semibold

                                                                @if ($talento->user->estado == 'activo') bg-green-100 text-green-700
                                                                @elseif($talento->user->estado == 'pendiente')
                                                                    bg-yellow-100 text-yellow-700
                                                                @elseif($talento->user->estado == 'bloqueado')
                                                                    bg-red-100 text-red-700
                                                                @else
                                                                    bg-gray-100 text-gray-700 @endif

                                                            ">

                                                            {{ $talento->user->estado }}

                                                        </span>

                                                    </div>

                                                    <!-- MODALIDAD -->
                                                    <div class="bg-gray-50 rounded-2xl p-5 border">

                                                        <p class="text-gray-500 text-sm mb-2">
                                                            Modalidad
                                                        </p>

                                                        <p class="font-semibold text-lg text-slate-800">
                                                            {{ $talento->condicion_modalidad }}
                                                        </p>

                                                    </div>

                                                    <!-- JORNADA -->
                                                    <div class="bg-gray-50 rounded-2xl p-5 border">

                                                        <p class="text-gray-500 text-sm mb-2">
                                                            Jornada
                                                        </p>

                                                        <p class="font-semibold text-lg text-slate-800">
                                                            {{ $talento->condicion_jornada }}
                                                        </p>

                                                    </div>

                                                    <!-- RESUMEN -->
                                                    <div class="col-span-2 bg-gray-50 rounded-2xl p-5 border">

                                                        <p class="text-gray-500 text-sm mb-3">
                                                            Resumen Profesional
                                                        </p>

                                                        <p class="text-slate-700 leading-relaxed">
                                                            {{ $talento->resumen }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div x-data="{ openEdit: false }">

                                    <!-- BOTON -->
                                    <button @click="openEdit = true"
                                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                                        Editar
                                    </button>

                                    <!-- MODAL -->
                                    <!-- MODAL EDITAR -->
                                    <div x-show="openEdit" x-transition.opacity
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
                                        style="display: none;">

                                        <!-- CAJA -->
                                        <div @click.away="openEdit = false" x-transition
                                            class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden">

                                            <!-- HEADER -->
                                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">

                                                <div class="flex justify-between items-center">

                                                    <div>

                                                        <h2 class="text-3xl font-bold text-white">
                                                            Editar Talento
                                                        </h2>

                                                        <p class="text-green-100 mt-1">
                                                            Modifica la información del perfil
                                                        </p>

                                                    </div>

                                                    <button @click="openEdit = false"
                                                        class="text-white text-3xl hover:rotate-90 transition">
                                                        ×
                                                    </button>

                                                </div>

                                            </div>

                                            <!-- FORM -->
                                            <form action="{{ route('admin.talentos.update', $talento->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <div class="p-8">

                                                    <div class="grid grid-cols-2 gap-6">

                                                        <!-- NOMBRE -->
                                                        <div>

                                                            <label class="block text-sm text-gray-600 mb-2">
                                                                Nombre <span class="text-red-500">*</span>
                                                            </label>

                                                            <input type="text" name="name" required
                                                                value="{{ old('name', $talento->user->name) }}"
                                                                class="w-full border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">

                                                            @error('name')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}
                                                                </p>
                                                            @enderror

                                                        </div>

                                                        <!-- ESTADO -->
                                                        <div>

                                                            <label class="block text-sm text-gray-600 mb-2">
                                                                Estado <span class="text-red-500">*</span>
                                                            </label>

                                                            <select name="estado" required
                                                                class="w-full border {{ $errors->has('estado') ? 'border-red-500' : 'border-gray-300' }} rounded-2xl px-4 py-3">

                                                                <option value="activo"
                                                                    {{ old('estado', $talento->user->estado) == 'activo' ? 'selected' : '' }}>
                                                                    Activo
                                                                </option>

                                                                <option value="pendiente"
                                                                    {{ old('estado', $talento->user->estado) == 'pendiente' ? 'selected' : '' }}>
                                                                    Pendiente
                                                                </option>

                                                                <option value="bloqueado"
                                                                    {{ old('estado', $talento->user->estado) == 'bloqueado' ? 'selected' : '' }}>
                                                                    Bloqueado
                                                                </option>

                                                                <option value="rechazado"
                                                                    {{ old('estado', $talento->user->estado) == 'rechazado' ? 'selected' : '' }}>
                                                                    Rechazado
                                                                </option>

                                                            </select>

                                                            @error('estado')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}
                                                                </p>
                                                            @enderror

                                                        </div>

                                                        <!-- MODALIDAD -->
                                                        <div>

                                                            <label class="block text-sm text-gray-600 mb-2">
                                                                Modalidad <span class="text-red-500">*</span>
                                                            </label>

                                                            <select name="condicion_modalidad" required
                                                                class="w-full border {{ $errors->has('condicion_modalidad') ? 'border-red-500' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">

                                                                <option value="Presencial"
                                                                    {{ old('condicion_modalidad', $talento->condicion_modalidad) == 'Presencial' ? 'selected' : '' }}>
                                                                    Presencial</option>
                                                                <option value="Remoto"
                                                                    {{ old('condicion_modalidad', $talento->condicion_modalidad) == 'Remoto' ? 'selected' : '' }}>
                                                                    Remoto</option>
                                                                <option value="Híbrido"
                                                                    {{ old('condicion_modalidad', $talento->condicion_modalidad) == 'Híbrido' ? 'selected' : '' }}>
                                                                    Híbrido</option>

                                                            </select>

                                                            @error('condicion_modalidad')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}
                                                                </p>
                                                            @enderror

                                                        </div>

                                                        <!-- JORNADA -->
                                                        <div>

                                                            <label class="block text-sm text-gray-600 mb-2">
                                                                Jornada <span class="text-red-500">*</span>
                                                            </label>

                                                            <select name="condicion_jornada" required
                                                                class="w-full border {{ $errors->has('condicion_jornada') ? 'border-red-500' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">

                                                                <option value="Full-Time"
                                                                    {{ old('condicion_jornada', $talento->condicion_jornada) == 'Full-Time' ? 'selected' : '' }}>
                                                                    Full-Time</option>
                                                                <option value="Part-Time"
                                                                    {{ old('condicion_jornada', $talento->condicion_jornada) == 'Part-Time' ? 'selected' : '' }}>
                                                                    Part-Time</option>
                                                                <option value="Freelance"
                                                                    {{ old('condicion_jornada', $talento->condicion_jornada) == 'Freelance' ? 'selected' : '' }}>
                                                                    Freelance</option>

                                                            </select>

                                                            @error('condicion_jornada')
                                                                <p class="text-red-500 text-sm mt-1">{{ $message }}
                                                                </p>
                                                            @enderror

                                                        </div>

                                                        <!-- RESUMEN -->
                                                        <div class="col-span-2">

                                                            <label class="block text-sm text-gray-600 mb-2">
                                                                Resumen <span class="text-red-500">*</span>
                                                            </label>

                                                            <textarea name="resumen" rows="5" required minlength="10"
                                                                class="w-full border {{ $errors->has('resumen') ? 'border-red-500' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none resize-none">{{ old('resumen', $talento->resumen) }}</textarea>

                                                            <div class="flex justify-between items-center mt-1">
                                                                @error('resumen')
                                                                    <p class="text-red-500 text-sm">{{ $message }}
                                                                    </p>
                                                                @enderror
                                                                <p class="text-gray-400 text-xs ml-auto"><span
                                                                        id="charCount-{{ $talento->id }}">{{ strlen(old('resumen', $talento->resumen)) }}</span>/5000
                                                                </p>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!-- BOTONES -->
                                                    <div class="flex justify-end gap-4 mt-8">

                                                        <button type="button" @click="openEdit = false"
                                                            class="px-6 py-3 rounded-2xl border hover:bg-gray-100 transition">
                                                            Cancelar
                                                        </button>

                                                        <button type="submit"
                                                            class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-2xl shadow-lg transition">
                                                            Guardar Cambios
                                                        </button>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
            <!-- PAGINACION -->
            <div class="p-6 border-t bg-gray-50">
                {{ $talentos->links() }}
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('textarea[name="resumen"]').forEach(function(textarea) {
                const talentoId = textarea.closest('form').action.match(/\/([0-9]+)$/)?.[1];
                const counter = document.getElementById('charCount-' + talentoId);
                if (counter) {
                    textarea.addEventListener('input', function() {
                        counter.textContent = this.value.length;
                    });
                }
            });
        });
    </script>

</x-admin-layout>
