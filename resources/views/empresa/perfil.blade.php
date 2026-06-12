<x-empresa-layout>

    <div class="space-y-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Título -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">Perfil Empresa</h1>
            <p class="text-gray-500 mt-2">Información general y presentación de la empresa.</p>
        </div>

        <!-- Card principal -->
        <div class="bg-white rounded-2xl shadow p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center gap-8">

                <div class="w-32 h-32 rounded-full bg-blue-600 flex items-center justify-center text-white text-5xl font-bold shrink-0">
                    {{ strtoupper(substr($empresa->user->name, 0, 1)) }}
                </div>

                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center gap-3 flex-wrap">
                        <h2 class="text-4xl font-bold text-gray-800">{{ $empresa->user->name }}</h2>
                        @if($empresa->validacion)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Empresa Validada</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Pendiente de Validación</span>
                        @endif
                    </div>
                    <p class="text-xl text-gray-500 mt-2">{{ $empresa->user->email }}</p>
                    <p class="text-gray-400 mt-1">{{ $empresa->rubro_empresa ?? '' }}</p>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="button"
                        onclick="const m=document.getElementById('modalEditar'); m.classList.remove('hidden'); m.classList.add('flex');"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                        Editar Perfil
                    </button>
                    <button type="button"
                        onclick="const m=document.getElementById('modalPassword'); m.classList.remove('hidden'); m.classList.add('flex');"
                        class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-xl font-semibold transition">
                        Cambiar Contraseña
                    </button>
                </div>

            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow p-6 md:p-8">
                <p class="text-gray-500">Procesos Activos</p>
                <h3 class="text-4xl font-bold text-blue-600 mt-2">{{ $totales['procesos'] }}</h3>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 md:p-8">
                <p class="text-gray-500">Talentos Contactados</p>
                <h3 class="text-4xl font-bold text-green-600 mt-2">{{ $totales['contactados'] }}</h3>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 md:p-8">
                <p class="text-gray-500">Usuarios Empresa</p>
                <h3 class="text-4xl font-bold text-purple-600 mt-2">{{ $totales['usuarios'] }}</h3>
            </div>
        </div>

        <!-- Información Empresa -->
        <div class="bg-white rounded-2xl shadow p-6 md:p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Información Empresa</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <span class="text-gray-500">RUT Empresa</span>
                    @php
                        $rut = preg_replace('/[^0-9kK]/i', '', $empresa->rut_empresa ?? '');
                        if (strlen($rut) > 1) {
                            $dv   = strtoupper(substr($rut, -1));
                            $body = substr($rut, 0, -1);
                            $fmt  = '';
                            while (strlen($body) > 3) { $fmt = '.' . substr($body, -3) . $fmt; $body = substr($body, 0, -3); }
                            $rutFormateado = $body . $fmt . '-' . $dv;
                        } else { $rutFormateado = $empresa->rut_empresa ?? 'N/A'; }
                    @endphp
                    <p class="font-semibold text-lg">{{ $rutFormateado }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Rubro</span>
                    <p class="font-semibold text-lg">{{ $empresa->rubro_empresa ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Tipo Empresa</span>
                    <p class="font-semibold text-lg">{{ $empresa->tipo_empresa ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Correo</span>
                    <p class="font-semibold text-lg">{{ $empresa->user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Presentación -->
        <div class="bg-white rounded-2xl shadow p-6 md:p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Presentación</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $empresa->presentacion_empresa ?? 'Sin presentación registrada.' }}
            </p>
        </div>

        <!-- Beneficios -->
        @if($empresa->beneficios_empresa)
        <div class="bg-white rounded-2xl shadow p-6 md:p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Beneficios</h2>
            <p class="text-gray-600 leading-relaxed">{{ $empresa->beneficios_empresa }}</p>
        </div>
        @endif

    </div>

    <!-- MODAL EDITAR PERFIL -->
    <div id="modalEditar"
        class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">
        <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">

            <div class="flex items-center justify-between px-8 py-6 border-b">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Editar Perfil</h2>
                    <p class="text-gray-500 text-sm mt-1">Actualiza la información de tu empresa</p>
                </div>
                <button type="button"
                    onclick="const m=document.getElementById('modalEditar'); m.classList.add('hidden'); m.classList.remove('flex');"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">
                    &times;
                </button>
            </div>

            <form method="POST" action="{{ route('empresa.perfil.update') }}" class="p-8 space-y-5">
                @csrf
                @method('PUT')

                @if($errors->any() && !$errors->has('current_password') && !$errors->has('password') && !$errors->has('password_confirmation'))
                    <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Nombre Empresa <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $empresa->user->name) }}"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">RUT Empresa <span class="text-red-500">*</span></label>
                        <input type="text" name="rut_empresa" id="rut_empresa"
                            value="{{ old('rut_empresa', $empresa->rut_empresa) }}"
                            placeholder="Ej: 12.345.678-9"
                            maxlength="12"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Rubro <span class="text-red-500">*</span></label>
                        <input type="text" name="rubro_empresa" value="{{ old('rubro_empresa', $empresa->rubro_empresa) }}"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Tipo Empresa <span class="text-red-500">*</span></label>
                        <select name="tipo_empresa" class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                            <option value="Contratación Directa" {{ old('tipo_empresa', $empresa->tipo_empresa) == 'Contratación Directa' ? 'selected' : '' }}>Contratación Directa</option>
                            <option value="EST"                   {{ old('tipo_empresa', $empresa->tipo_empresa) == 'EST'                   ? 'selected' : '' }}>EST</option>
                            <option value="Outsourcing"           {{ old('tipo_empresa', $empresa->tipo_empresa) == 'Outsourcing'           ? 'selected' : '' }}>Outsourcing</option>
                            <option value="Pyme"                  {{ old('tipo_empresa', $empresa->tipo_empresa) == 'Pyme'                  ? 'selected' : '' }}>Pyme</option>
                            <option value="Startup"               {{ old('tipo_empresa', $empresa->tipo_empresa) == 'Startup'               ? 'selected' : '' }}>Startup</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Presentación Empresa</label>
                        <textarea name="presentacion_empresa" rows="4"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('presentacion_empresa', $empresa->presentacion_empresa) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Beneficios</label>
                        <textarea name="beneficios_empresa" rows="3"
                            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('beneficios_empresa', $empresa->beneficios_empresa) }}</textarea>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow">
                        Guardar Cambios
                    </button>
                    <button type="button"
                        onclick="const m=document.getElementById('modalEditar'); m.classList.add('hidden'); m.classList.remove('flex');"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL CAMBIAR CONTRASEÑA -->
    <div id="modalPassword"
        class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">
        <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Cambiar Contraseña</h2>
                    <p class="text-gray-500 text-sm mt-1">Actualiza tu contraseña de acceso</p>
                </div>
                <button type="button"
                    onclick="const m=document.getElementById('modalPassword'); m.classList.add('hidden'); m.classList.remove('flex');"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-2xl text-gray-400 hover:text-red-500 transition">
                    &times;
                </button>
            </div>

            @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-5">
                    <ul class="space-y-1">
                        @error('current_password')<li>• {{ $message }}</li>@enderror
                        @error('password')<li>• {{ $message }}</li>@enderror
                        @error('password_confirmation')<li>• {{ $message }}</li>@enderror
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('empresa.perfil.password') }}" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Contraseña Actual</label>
                    <input type="password" name="current_password"
                        class="w-full border {{ $errors->has('current_password') ? 'border-red-400' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Nueva Contraseña</label>
                    <input type="password" name="password"
                        class="w-full border {{ $errors->has('password') ? 'border-red-400' : 'border-gray-300' }} rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow">
                        Actualizar Contraseña
                    </button>
                    <button type="button"
                        onclick="const m=document.getElementById('modalPassword'); m.classList.add('hidden'); m.classList.remove('flex');"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-2xl font-semibold transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formatRut(value) {
            let clean = value.replace(/[^0-9kK]/g, '').toUpperCase();
            if (clean.length === 0) return '';
            let dv   = clean.slice(-1);
            let body = clean.slice(0, -1);
            let formatted = '';
            while (body.length > 3) {
                formatted = '.' + body.slice(-3) + formatted;
                body = body.slice(0, -3);
            }
            return body + formatted + '-' + dv;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('rut_empresa');
            if (!input) return;
            input.value = formatRut(input.value);
            input.addEventListener('input', function () {
                this.value = formatRut(this.value);
            });
        });
    </script>

    @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const m = document.getElementById('modalPassword');
                m.classList.remove('hidden'); m.classList.add('flex');
            });
        </script>
    @elseif($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const m = document.getElementById('modalEditar');
                m.classList.remove('hidden'); m.classList.add('flex');
            });
        </script>
    @endif

</x-empresa-layout>
