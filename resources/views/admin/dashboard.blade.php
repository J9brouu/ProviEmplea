<x-admin-layout>

    <div class="space-y-8">

        <!-- Header -->
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800">
                Dashboard Principal
            </h1>

            <p class="text-gray-500 mt-2">
                Bienvenido al panel administrativo de ProviEmplea.
            </p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Talentos Activos
                </p>

                <h2 class="text-5xl font-bold mt-4 text-gray-900">
                    {{ $totalTalentos }}
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Empresas Asociadas
                </p>

                <h2 class="text-5xl font-bold text-green-600 mt-4">
                    {{ $totalEmpresas }}
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Usuarios Registrados
                </p>

                <h2 class="text-5xl font-bold text-blue-600 mt-4">
                    {{ $totalUsuarios }}
                </h2>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm">
                    Postulaciones
                </p>

                <h2 class="text-5xl font-bold text-purple-600 mt-4">
                    {{ $totalPostulaciones }}
                </h2>
            </div>

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <x-admin.register-admin-user />

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Administradores del sistema</h2>
                        <p class="text-gray-500 mt-2">
                            Revisa las cuentas administrativas con acceso al panel.
                        </p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-blue-100 text-blue-700 px-4 py-2 text-sm font-medium">
                        {{ $admins->count() }} administradores
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse min-w-[420px]">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-500 text-sm">
                                <th class="py-4 text-left">Nombre</th>
                                <th class="py-4 text-left">Correo</th>
                                <th class="py-4 text-center">Estado</th>
                                <th class="py-4 text-center">Acción</th>
                                <th class="py-4 text-right">Creado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="py-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-11 h-11 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                                {{ substr($admin->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $admin->name }}</p>
                                                <p class="text-sm text-gray-500">Administrador</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 text-gray-700">{{ $admin->email }}</td>
                                    <td class="py-5 text-center">
                                        @php
                                            $adminEstadoLabel = $admin->estado === 'bloqueado' ? 'Desactivado' : ucfirst($admin->estado);
                                            $adminEstadoClass = $admin->estado === 'activo'
                                                ? 'bg-green-100 text-green-700'
                                                : ($admin->estado === 'pendiente'
                                                    ? 'bg-yellow-100 text-yellow-700'
                                                    : 'bg-red-100 text-red-700');
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $adminEstadoClass }}">
                                            {{ $adminEstadoLabel }}
                                        </span>
                                    </td>
                                    <td class="py-5 text-center">
                                        @if(auth()->id() !== $admin->id)
                                            <form action="{{ route('admin.admins.deactivate', $admin->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition">
                                                    Desactivar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-sm">No disponible</span>
                                        @endif
                                    </td>
                                    <td class="py-5 text-right text-sm text-gray-500">{{ $admin->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-gray-500">
                                        No hay administradores registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tablas -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- Empresas -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex justify-between items-center mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">
                        Empresas Recientes
                    </h2>

                    <a href="{{ route('admin.empresas') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">

                        Ver todas

                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse min-w-[400px]">

                        <thead>

                            <tr class="border-b border-gray-200 text-gray-500 text-sm">

                                <th class="py-4 text-left">
                                    Empresa
                                </th>

                                <th class="py-4 text-center">
                                    Estado
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($empresas as $empresa)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                    <td class="py-5">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="w-11 h-11 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">

                                                {{ substr($empresa->user->name, 0, 1) }}

                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-900">
                                                    {{ $empresa->user->name }}
                                                </p>

                                                <p class="text-sm text-gray-500">
                                                    {{ $empresa->rubro_empresa }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="text-center">

                                        @if ($empresa->validacion)
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">

                                                Verificada

                                            </span>
                                        @else
                                            <span
                                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                                Pendiente
                                            </span>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Usuarios -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex justify-between items-center mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">
                        Talentos Recientes
                    </h2>
                    <a href="{{ route('admin.talentos') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">
                        Ver todas
                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>
                            <tr>
                                <th class="pb-4 text-left text-sm font-semibold text-gray-500">
                                    Usuario
                                </th>

                                <th class="pb-4 text-center text-sm font-semibold text-gray-500">
                                    Jornada
                                </th>

                                <th class="pb-4 text-center text-sm font-semibold text-gray-500">
                                    Modalidad
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($talentos as $talento)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                    <td class="py-5">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="w-11 h-11 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center font-bold">

                                                {{ substr($talento->user?->name ?? 'T', 0, 1) }}
                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-900">
                                                    {{ $talento->user?->name }}
                                                </p>

                                                <p class="text-sm text-gray-500">
                                                    {{ $talento->user?->email }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="py-4 text-center">
                                        <span class="text-sm text-gray-700">
                                            {{ $talento->condicion_jornada }}
                                        </span>
                                    </td>

                                    <td class="py-4 text-center">
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                            {{ $talento->condicion_modalidad }}
                                        </span>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Usuarios desactivados</h2>
                    <p class="text-gray-500 mt-1">Solo los administradores pueden ver y revisar estas cuentas.</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-red-100 text-red-700 px-4 py-2 text-sm font-medium">
                    {{ $disabledUsers->count() }} desactivados
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse min-w-[420px]">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 text-sm">
                            <th class="py-4 text-left">Nombre</th>
                            <th class="py-4 text-left">Correo</th>
                            <th class="py-4 text-center">Rol</th>
                            <th class="py-4 text-center">Acción</th>
                            <th class="py-4 text-right">Desactivado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($disabledUsers as $disabledUser)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="py-5 text-gray-900">{{ $disabledUser->name }}</td>
                                <td class="py-5 text-gray-700">{{ $disabledUser->email }}</td>
                                <td class="py-5 text-center text-sm text-gray-500">{{ ucfirst($disabledUser->rol) }}</td>
                                <td class="py-5 text-center">
                                    <form action="{{ route('admin.admins.reactivate', $disabledUser->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                                            Reactivar
                                        </button>
                                    </form>
                                </td>
                                <td class="py-5 text-right text-sm text-gray-500">{{ $disabledUser->updated_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-gray-500">
                                    No hay usuarios desactivados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-admin-layout>
