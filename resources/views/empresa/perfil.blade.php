<x-empresa-layout>

    <div class="space-y-8">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Perfil Empresa</h1>
            <p class="text-gray-500 mt-1">Información general y presentación de la empresa.</p>
        </div>

        <!-- Card principal -->
        <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <div class="px-6 py-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center gap-5">
                        @if($empresa->logo_contenido)
                            <img src="{{ route('archivos.logo', $empresa->id) }}"
                                alt="Logo {{ $empresa->user->name }}"
                                class="w-20 h-20 rounded-3xl object-cover border border-gray-200">
                        @else
                            <div class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-700 flex items-center justify-center text-3xl font-bold">
                                {{ strtoupper(substr($empresa->user->name, 0, 2)) }}
                            </div>
                        @endif
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $empresa->user->name }}</h2>
                            <p class="text-gray-500 mt-1">{{ $empresa->rubro_empresa ?? '—' }}</p>
                            @if($empresa->validacion)
                                <span class="inline-flex items-center mt-3 rounded-full bg-green-100 text-green-700 px-3 py-1 text-sm font-medium">Empresa Validada</span>
                            @else
                                <span class="inline-flex items-center mt-3 rounded-full bg-yellow-100 text-yellow-700 px-3 py-1 text-sm font-medium">Pendiente de Validación</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-end gap-3">
                        <button onclick="document.getElementById('modalEditar').classList.remove('hidden')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition shadow text-sm">
                            Editar Perfil
                        </button>
                        <button onclick="document.getElementById('modalPassword').classList.remove('hidden')"
                            class="bg-slate-700 hover:bg-slate-800 text-white px-5 py-3 rounded-xl font-semibold transition shadow text-sm">
                            Cambiar Contraseña
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                        <p class="text-gray-500 text-sm">Procesos Activos</p>
                        <h3 class="text-3xl font-bold text-blue-600 mt-3">{{ $totales['procesos'] }}</h3>
                    </div>
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                        <p class="text-gray-500 text-sm">Talentos Contactados</p>
                        <h3 class="text-3xl font-bold text-green-600 mt-3">{{ $totales['contactados'] }}</h3>
                    </div>
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                        <p class="text-gray-500 text-sm">Usuarios Empresa</p>
                        <h3 class="text-3xl font-bold text-purple-600 mt-3">{{ $totales['usuarios'] }}</h3>
                    </div>
                </div>

                <!-- Info -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">
                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Información Empresa</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">RUT Empresa</p>
                                <p class="font-semibold text-gray-800">{{ $empresa->rut_empresa ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Rubro</p>
                                <p class="font-semibold text-gray-800">{{ $empresa->rubro_empresa ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tipo Empresa</p>
                                <p class="font-semibold text-gray-800">{{ $empresa->tipo_empresa ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Correo</p>
                                <p class="font-semibold text-gray-800">{{ $empresa->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Presentación</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $empresa->presentacion_empresa ?? 'Sin presentación registrada.' }}
                        </p>
                        @if($empresa->beneficios_empresa)
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Beneficios</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $empresa->beneficios_empresa }}</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- MODAL EDITAR -->
    <div id="modalEditar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white">Editar Perfil Empresa</h2>
                    <p class="text-blue-100 text-sm mt-1">Actualiza la información de tu empresa</p>
                </div>
                <button onclick="document.getElementById('modalEditar').classList.add('hidden')"
                    class="text-white text-3xl hover:rotate-90 transition">×</button>
            </div>

            <form method="POST" action="{{ route('empresa.perfil.update') }}" class="p-8 space-y-5">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <ul class="list-disc pl-4">
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
                        <input type="text" name="rut_empresa" value="{{ old('rut_empresa', $empresa->rut_empresa) }}"
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
                            <option value="EST" {{ old('tipo_empresa', $empresa->tipo_empresa) == 'EST' ? 'selected' : '' }}>EST</option>
                            <option value="Outsourcing" {{ old('tipo_empresa', $empresa->tipo_empresa) == 'Outsourcing' ? 'selected' : '' }}>Outsourcing</option>
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

                <div class="flex justify-end gap-4 pt-2">
                    <button type="button" onclick="document.getElementById('modalEditar').classList.add('hidden')"
                        class="px-6 py-3 rounded-2xl border hover:bg-gray-100 transition">Cancelar</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl shadow transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    @if($errors->any())
        <script>document.getElementById('modalEditar').classList.remove('hidden');</script>
    @endif

    <!-- MODAL CAMBIAR CONTRASEÑA -->
    <div id="modalPassword" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-slate-700 to-slate-900 px-8 py-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white">Cambiar Contraseña</h2>
                    <p class="text-slate-300 text-sm mt-1">Actualiza tu contraseña de acceso</p>
                </div>
                <button onclick="document.getElementById('modalPassword').classList.add('hidden')"
                    class="text-white text-3xl hover:rotate-90 transition">&times;</button>
            </div>
            <form method="POST" action="{{ route('empresa.perfil.password') }}" class="p-8 space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Contraseña Actual <span class="text-red-500">*</span></label>
                    <input type="password" name="current_password"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Nueva Contraseña <span class="text-red-500">*</span></label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Confirmar Contraseña <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="flex justify-end gap-4 pt-2">
                    <button type="button" onclick="document.getElementById('modalPassword').classList.add('hidden')"
                        class="px-6 py-3 rounded-2xl border hover:bg-gray-100 transition">Cancelar</button>
                    <button type="submit"
                        class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-2xl shadow transition">Guardar</button>
                </div>
            </form>
        </div>
    </div>

</x-empresa-layout>
