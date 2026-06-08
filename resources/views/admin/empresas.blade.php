<x-admin-layout>

    <div class="space-y-8">

        <div>
            <h1 class="text-5xl font-bold text-gray-800">Gestión de Empresas</h1>
            <p class="text-gray-500 mt-2">Administración de empresas registradas.</p>
        </div>

        <div class="flex flex-wrap gap-4">

            <!-- TOTAL -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border w-48">
                <p class="text-gray-500 text-sm">Empresas</p>
                <h2 class="text-2xl font-bold text-slate-800 mt-1">{{ $empresas->count() }}</h2>
            </div>

            <!-- ACTIVAS -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border w-48">
                <p class="text-gray-500 text-sm">Activas</p>
                <h2 class="text-2xl font-bold text-green-600 mt-1">{{ $empresas->where('user.estado', 'activo')->count() }}</h2>
            </div>

        </div>

        <!-- BUSCADOR -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border">
            <form method="GET" action="{{ route('admin.empresas') }}">
                <div class="flex gap-4">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar empresa..." class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-xl">Buscar</button>
                </div>
            </form>
        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow-sm border overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left w-[25%]">Empresa</th>
                        <th class="px-6 py-4 text-left w-[20%]">Rubro</th>
                        <th class="px-6 py-4 text-left w-[20%]">Tipo</th>
                        <th class="px-6 py-4 text-center w-[15%]">Estado</th>
                        <th class="px-6 py-4 text-center w-[20%]">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">{{ $empresa->user->name }}</td>
                            <td class="px-6 py-4">{{ $empresa->rubro_empresa }}</td>
                            <td class="px-6 py-4">{{ $empresa->tipo_empresa }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold
                                    @if ($empresa->user->estado == 'activo') bg-green-100 text-green-700
                                    @elseif($empresa->user->estado == 'pendiente') bg-yellow-100 text-yellow-700
                                    @elseif($empresa->user->estado == 'bloqueado') bg-red-100 text-red-700
                                    @elseif($empresa->user->estado == 'rechazado') bg-gray-200 text-gray-700 @endif">
                                    {{ ucfirst($empresa->user->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <div x-data="{ open: false }">
                                        <button @click="open = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Ver</button>
                                        <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
                                            <div @click.away="open = false" class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden">
                                                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <h2 class="text-3xl font-bold text-white">{{ $empresa->user->name }}</h2>
                                                            <p class="text-blue-100 mt-1">Información de la empresa</p>
                                                        </div>
                                                        <button @click="open = false" class="text-white text-3xl">×</button>
                                                    </div>
                                                </div>
                                                <div class="p-8">
                                                    <div class="grid grid-cols-2 gap-6">
                                                        <div class="bg-gray-50 rounded-2xl p-5 border">
                                                            <p class="text-gray-500 text-sm mb-2">Estado</p>
                                                            <span class="px-4 py-2 rounded-full text-sm font-semibold @if ($empresa->user->estado == 'activo') bg-green-100 text-green-700 @elseif($empresa->user->estado == 'pendiente') bg-yellow-100 text-yellow-700 @elseif($empresa->user->estado == 'bloqueado') bg-red-100 text-red-700 @endif">{{ ucfirst($empresa->user->estado) }}</span>
                                                        </div>
                                                        <div class="bg-gray-50 rounded-2xl p-5 border">
                                                            <p class="text-gray-500 text-sm mb-2">Rubro</p>
                                                            <p class="font-semibold text-lg text-slate-800">{{ $empresa->rubro_empresa }}</p>
                                                        </div>
                                                        <div class="bg-gray-50 rounded-2xl p-5 border">
                                                            <p class="text-gray-500 text-sm mb-2">Tipo Empresa</p>
                                                            <p class="font-semibold text-lg text-slate-800">{{ $empresa->tipo_empresa }}</p>
                                                        </div>
                                                        <div class="col-span-2 bg-gray-50 rounded-2xl p-5 border">
                                                            <p class="text-gray-500 text-sm mb-3">Presentación</p>
                                                            <p class="text-slate-700 leading-relaxed">{{ $empresa->presentacion_empresa }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-data="{ openEdit: false }">
                                        <button @click="openEdit = true" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Editar</button>
                                        <div x-show="openEdit" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" style="display: none;">
                                            <div @click.away="openEdit = false" class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden">
                                                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <h2 class="text-3xl font-bold text-white">Editar Empresa</h2>
                                                            <p class="text-green-100 mt-1">Modifica la información de la empresa</p>
                                                        </div>
                                                        <button @click="openEdit = false" class="text-white text-3xl">×</button>
                                                    </div>
                                                </div>
                                                <form action="{{ route('admin.empresas.update', $empresa->id) }}" method="POST">@csrf @method('PUT')
                                                    <div class="p-8">
                                                        <div class="grid grid-cols-2 gap-6">
                                                            <div>
                                                                <label class="block text-sm text-gray-600 mb-2">Empresa</label>
                                                                <input type="text" name="name" value="{{ $empresa->user->name }}" class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm text-gray-600 mb-2">Estado</label>
                                                                <select name="estado" class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                                                                    <option value="activo" {{ $empresa->user->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                                                    <option value="pendiente" {{ $empresa->user->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                                    <option value="bloqueado" {{ $empresa->user->estado == 'bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                                                                    <option value="rechazado" {{ $empresa->user->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm text-gray-600 mb-2">Rubro</label>
                                                                <input type="text" name="rubro_empresa" value="{{ $empresa->rubro_empresa }}" class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm text-gray-600 mb-2">Tipo Empresa</label>
                                                                <input type="text" name="tipo_empresa" value="{{ $empresa->tipo_empresa }}" class="w-full border border-gray-300 rounded-2xl px-4 py-3">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label class="block text-sm text-gray-600 mb-2">Presentación</label>
                                                                <textarea name="presentacion_empresa" rows="5" class="w-full border border-gray-300 rounded-2xl px-4 py-3 resize-none">{{ $empresa->presentacion_empresa }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-end gap-4 mt-8">
                                                            <button type="button" @click="openEdit = false" class="px-6 py-3 rounded-2xl border hover:bg-gray-100">Cancelar</button>
                                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-2xl shadow-lg">Guardar Cambios</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-6 border-t bg-gray-50">{{ $empresas->links() }}</div>
        </div>
    </div>
</x-admin-layout>