<x-admin-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Validaciones
            </h1>

            <p class="text-gray-500 mt-2">
                Gestión de aprobación de talentos y empresas pendientes.
            </p>

        </div>

        <!-- CARDS -->
        <div class="flex gap-4">

            <!-- TALENTOS -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border w-52">

                <p class="text-gray-500 text-sm">
                    Talentos Pendientes
                </p>

                <h2 class="text-2xl font-bold text-yellow-500 mt-1">
                    {{ $talentos->count() }}
                </h2>

            </div>

            <!-- EMPRESAS -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border w-52">

                <p class="text-gray-500 text-sm">
                    Empresas Pendientes
                </p>

                <h2 class="text-2xl font-bold text-yellow-500 mt-1">
                    {{ $empresas->count() }}
                </h2>

            </div>

        </div>

        <!-- TALENTOS -->
        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

            <!-- TITULO -->
            <div class="p-6 border-b bg-gray-50">

                <h2 class="text-2xl font-bold text-slate-800">
                    Talentos Pendientes
                </h2>

            </div>

            <!-- TABLA -->
            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-gray-500">
                            Nombre
                        </th>

                        <th class="px-6 py-4 text-left text-gray-500">
                            Modalidad
                        </th>

                        <th class="px-6 py-4 text-left text-gray-500">
                            Jornada
                        </th>

                        <th class="px-6 py-4 text-center text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-center text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($talentos as $talento)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- NOMBRE -->
                            <td class="px-6 py-4 font-medium">

                                {{ $talento->user->name }}

                            </td>

                            <!-- MODALIDAD -->
                            <td class="px-6 py-4">

                                {{ $talento->condicion_modalidad }}

                            </td>

                            <!-- JORNADA -->
                            <td class="px-6 py-4">

                                {{ $talento->condicion_jornada }}

                            </td>

                            <!-- ESTADO -->
                            <td class="px-6 py-4 text-center">

                                <span
                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    Pendiente

                                </span>

                            </td>

                            <!-- ACCIONES -->
                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <!-- APROBAR -->
                                    <form method="POST"
                                        action="{{ route('admin.validaciones.talento.aprobar', $talento->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">

                                            Aprobar

                                        </button>

                                    </form>

                                    <!-- RECHAZAR -->
                                    <form method="POST"
                                        action="{{ route('admin.validaciones.talento.rechazar', $talento->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                            Rechazar

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-10 text-gray-500">

                                No hay talentos pendientes.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>
            <!-- PAGINACION -->
            <div class="p-6 border-t bg-gray-50">

                {{ $talentos->links() }}

            </div>
        </div>

        <!-- EMPRESAS -->
        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

            <!-- TITULO -->
            <div class="p-6 border-b bg-gray-50">

                <h2 class="text-2xl font-bold text-slate-800">
                    Empresas Pendientes
                </h2>

            </div>

            <!-- TABLA -->
            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-gray-500">
                            Empresa
                        </th>

                        <th class="px-6 py-4 text-left text-gray-500">
                            Rubro
                        </th>

                        <th class="px-6 py-4 text-left text-gray-500">
                            Tipo
                        </th>

                        <th class="px-6 py-4 text-center text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-center text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($empresas as $empresa)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- EMPRESA -->
                            <td class="px-6 py-4 font-medium">

                                {{ $empresa->user->name }}

                            </td>

                            <!-- RUBRO -->
                            <td class="px-6 py-4">

                                {{ $empresa->rubro_empresa }}

                            </td>

                            <!-- TIPO -->
                            <td class="px-6 py-4">

                                {{ $empresa->tipo_empresa }}

                            </td>

                            <!-- ESTADO -->
                            <td class="px-6 py-4 text-center">

                                <span
                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    Pendiente

                                </span>

                            </td>

                            <!-- ACCIONES -->
                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <!-- APROBAR -->
                                    <form method="POST"
                                        action="{{ route('admin.validaciones.empresa.aprobar', $empresa->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">

                                            Aprobar

                                        </button>

                                    </form>

                                    <!-- RECHAZAR -->
                                    <form method="POST"
                                        action="{{ route('admin.validaciones.empresa.rechazar', $empresa->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                                            Rechazar

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-10 text-gray-500">

                                No hay empresas pendientes.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>
         <!-- PAGINACION -->
            <div class="p-6 border-t bg-gray-50">

                {{ $talentos->links() }}

            </div>
        </div>

    </div>

</x-admin-layout>
