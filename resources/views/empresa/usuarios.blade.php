<x-empresa-layout>

    <div class="space-y-6">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div class="flex flex-wrap justify-between items-start gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Usuarios Asociados</h1>
                <p class="text-gray-500 mt-1">Gestión de usuarios vinculados a la empresa.</p>
            </div>
            <button onclick="document.getElementById('modalNuevo').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow text-sm">
                + Nuevo Usuario
            </button>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-sm mb-3">Total</p>
                <h2 class="text-3xl font-bold text-blue-600">{{ $usuarios->count() }}</h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-sm mb-3">Activos</p>
                <h2 class="text-3xl font-bold text-green-600">
                    {{ $usuarios->filter(fn($u) => $u->user?->estado === 'activo')->count() }}
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-sm mb-3">Con Teléfono</p>
                <h2 class="text-3xl font-bold text-yellow-500">
                    {{ $usuarios->filter(fn($u) => $u->telefono)->count() }}
                </h2>
            </div>
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <p class="text-gray-500 text-sm mb-3">Pendientes</p>
                <h2 class="text-3xl font-bold text-purple-600">
                    {{ $usuarios->filter(fn($u) => $u->user?->estado === 'pendiente')->count() }}
                </h2>
            </div>
        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Usuarios de la Empresa</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Correo</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Cargo</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Teléfono</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Estado</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($usuarios as $u)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($u->user?->name ?? '?', 0, 2)) }}
                                        </div>
                                        <span class="font-medium text-gray-800 text-sm">{{ $u->user?->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $u->user?->email ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $cargoColors = [
                                            'RRHH'         => 'bg-blue-100 text-blue-700',
                                            'Reclutador'   => 'bg-purple-100 text-purple-700',
                                            'Supervisor'   => 'bg-yellow-100 text-yellow-700',
                                            'Jefe de Area' => 'bg-green-100 text-green-700',
                                        ];
                                        $color = $cargoColors[$u->cargo ?? ''] ?? 'bg-gray-100 text-gray-600';
                                    @endphp
                                    <span class="{{ $color }} px-2.5 py-1 rounded-full text-xs font-semibold">
                                        {{ $u->cargo ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $u->telefono ? '+569'.$u->telefono : '—' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @php $estado = $u->user?->estado ?? 'pendiente'; @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $estado === 'activo' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($estado) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST" action="{{ route('empresa.usuarios.destroy', $u->id) }}" id="form-usr-{{ $u->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            @click="$dispatch('confirm-delete', { title: 'Eliminar Usuario', message: '¿Eliminar a {{ addslashes($u->user?->name ?? 'este usuario') }}?', formId: 'form-usr-{{ $u->id }}' })"
                                            class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    No hay usuarios asociados. Agrega uno con el botón de arriba.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- MODAL NUEVO USUARIO -->
    <div id="modalNuevo" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-white">Nuevo Usuario</h2>
                    <p class="text-blue-100 text-xs mt-0.5">Agrega un usuario asociado a tu empresa</p>
                </div>
                <button onclick="document.getElementById('modalNuevo').classList.add('hidden')"
                    class="text-white text-2xl hover:rotate-90 transition leading-none">×</button>
            </div>
            <form method="POST" action="{{ route('empresa.usuarios.store') }}" class="p-6 space-y-4">
                @csrf
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <ul class="list-disc pl-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nombre <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Correo <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Cargo <span class="text-red-500">*</span></label>
                    <select name="cargo" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none text-sm" required>
                        <option value="RRHH"          {{ old('cargo') == 'RRHH'          ? 'selected' : '' }}>RRHH</option>
                        <option value="Reclutador"    {{ old('cargo') == 'Reclutador'    ? 'selected' : '' }}>Reclutador</option>
                        <option value="Supervisor"    {{ old('cargo') == 'Supervisor'    ? 'selected' : '' }}>Supervisor</option>
                        <option value="Jefe de Área" {{ old('cargo') == 'Jefe de Área' ? 'selected' : '' }}>Jefe de Área</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Teléfono</label>
                    <div class="flex">
                        <span class="px-3 py-2.5 border border-r-0 border-gray-300 rounded-l-xl bg-gray-50 text-gray-600 text-sm">+569</span>
                        <input type="text" name="telefono" maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                            value="{{ old('telefono') }}" placeholder="12345678"
                            class="flex-1 border border-gray-300 rounded-r-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Contraseña <span class="text-red-500">*</span></label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Confirmar Contraseña <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none text-sm" required>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('modalNuevo').classList.add('hidden')"
                        class="px-5 py-2.5 rounded-xl border hover:bg-gray-100 transition text-sm">Cancelar</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl shadow transition text-sm font-semibold">Crear</button>
                </div>
            </form>
        </div>
    </div>

    @if($errors->any())
        <script>document.getElementById('modalNuevo').classList.remove('hidden');</script>
    @endif

</x-empresa-layout>
