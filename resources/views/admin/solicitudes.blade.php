<x-admin-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-5xl font-bold text-gray-800">
                    Solicitudes Empresariales
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestión y seguimiento de contactos entre empresas y talentos.
                </p>

            </div>

            <a href="{{ route('admin.solicitudes.pdf') }}"
                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition shadow">

                Exportar PDF

            </a>

        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- TOTAL -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Total Solicitudes
                </p>

                <h2 class="text-4xl font-bold text-blue-600 mt-4">
                    {{ $solicitudes->count() }}
                </h2>

            </div>

            <!-- PENDIENTE -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Pendientes
                </p>

                <h2 class="text-4xl font-bold text-yellow-500 mt-4">
                    {{ $solicitudes->where('estado', 'pendiente')->count() }}
                </h2>

            </div>

            <!-- CONTACTADO -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Contactados
                </p>

                <h2 class="text-4xl font-bold text-green-600 mt-4">
                    {{ $solicitudes->where('estado', 'contactado')->count() }}
                </h2>

            </div>

            <!-- ENTREVISTA -->
            <div class="bg-white p-6 rounded-2xl shadow">

                <p class="text-gray-500">
                    Entrevistas
                </p>

                <h2 class="text-4xl font-bold text-purple-600 mt-4">
                    {{ $solicitudes->where('estado', 'entrevista')->count() }}
                </h2>

            </div>

        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow p-6">

            <!-- TOP -->
            <div class="flex justify-between items-center mb-6">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Historial de Solicitudes
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Seguimiento de interacciones entre empresas y talentos.
                    </p>

                </div>

                <!-- BUSCADOR -->
                <form method="GET" action="{{ route('admin.solicitudes') }}">

                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar talento..."
                        class="border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                </form>

            </div>

            <!-- TABLE -->
            <table class="w-full">

                <thead>

                    <tr class="border-b text-gray-500">

                        <th class="text-left py-4">
                            Talento
                        </th>

                        <th class="text-left py-4">
                            Empresa
                        </th>

                        <th class="text-left py-4">
                            Estado
                        </th>

                        <th class="text-left py-4">
                            Fecha
                        </th>

                        <th class="text-left py-4">
                            Notas
                        </th>

                        <th class="text-left py-4">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody class="text-gray-700">

                    @forelse($solicitudes as $solicitud)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- TALENTO -->
                            <td class="py-5 font-medium">

                                {{ $solicitud->talento->user->name }}

                            </td>

                            <!-- EMPRESA -->
                            <td>

                                {{ $solicitud->datosEmpresa->user->name }}

                            </td>

                            <!-- ESTADO -->
                            <td>

                                @if ($solicitud->estado == 'pendiente')
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm font-semibold">
                                        Pendiente
                                    </span>
                                @elseif($solicitud->estado == 'contactado')
                                    <span
                                        class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-semibold">
                                        Contactado
                                    </span>
                                @elseif($solicitud->estado == 'entrevista')
                                    <span
                                        class="bg-purple-100 text-purple-700 px-4 py-1 rounded-full text-sm font-semibold">
                                        Entrevista
                                    </span>
                                @elseif($solicitud->estado == 'seleccionado')
                                    <span
                                        class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold">
                                        Seleccionado
                                    </span>
                                @elseif($solicitud->estado == 'rechazado')
                                    <span class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm font-semibold">
                                        Rechazado
                                    </span>
                                @endif

                            </td>

                            <!-- FECHA -->
                            <td class="text-gray-500">

                                {{ optional($solicitud->created_at)->format('d/m/Y') }}

                            </td>

                            <!-- NOTAS -->
                            <td>

                                {{ $solicitud->notas ?? 'Sin notas' }}

                            </td>

                            <!-- ACCIONES -->
                            <td>

                                <div class="flex flex-wrap gap-2">

                                    <!-- CONTACTAR -->
                                    <form method="POST"
                                        action="{{ route('admin.solicitudes.contactar', $solicitud->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="
                px-4 py-2 rounded-xl text-sm font-medium transition

                {{ $solicitud->estado == 'contactado'
                    ? 'bg-gray-200 text-gray-500 cursor-not-allowed'
                    : 'bg-green-600 hover:bg-green-700 text-white shadow' }}
            "
                                            {{ $solicitud->estado == 'contactado' ? 'disabled' : '' }}>

                                            {{ $solicitud->estado == 'contactado' ? 'Contactado' : 'Contactar' }}

                                        </button>

                                    </form>


                                    <!-- ENTREVISTA -->
                                    <form method="POST"
                                        action="{{ route('admin.solicitudes.entrevista', $solicitud->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="
                px-4 py-2 rounded-xl text-sm font-medium transition

                {{ $solicitud->estado == 'entrevista'
                    ? 'bg-gray-200 text-gray-500 cursor-not-allowed'
                    : 'bg-purple-600 hover:bg-purple-700 text-white shadow' }}
            "
                                            {{ $solicitud->estado == 'entrevista' ? 'disabled' : '' }}>

                                            {{ $solicitud->estado == 'entrevista' ? 'En entrevista' : 'Entrevista' }}

                                        </button>

                                    </form>


                                    <!-- SELECCIONADO -->
                                    <form method="POST"
                                        action="{{ route('admin.solicitudes.seleccionado', $solicitud->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="
                px-4 py-2 rounded-xl text-sm font-medium transition

                {{ $solicitud->estado == 'seleccionado'
                    ? 'bg-gray-200 text-gray-500 cursor-not-allowed'
                    : 'bg-blue-600 hover:bg-blue-700 text-white shadow' }}
            "
                                            {{ $solicitud->estado == 'seleccionado' ? 'disabled' : '' }}>

                                            {{ $solicitud->estado == 'seleccionado' ? 'Seleccionado' : 'Seleccionar' }}

                                        </button>

                                    </form>


                                    <!-- RECHAZAR -->
                                    <form method="POST"
                                        action="{{ route('admin.solicitudes.rechazar', $solicitud->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="px-4 py-2 rounded-xl text-sm font-medium transition {{ $solicitud->estado == 'rechazado' ? 'bg-gray-200 text-gray-500 cursor-not-allowed': 'bg-red-500 hover:bg-red-600 text-white shadow' }}"{{ $solicitud->estado == 'rechazado' ? 'disabled' : '' }}>
                                            {{ $solicitud->estado == 'rechazado' ? 'Rechazado' : 'Rechazar' }}
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="py-10 text-center text-gray-500">

                                No hay solicitudes registradas.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

            <!-- PAGINACION -->
            <div class="mt-6">

                {{ $solicitudes->links() }}

            </div>

        </div>

    </div>

</x-admin-layout>
