<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ProviEmplea') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col">

            <div class="p-6 text-2xl font-bold border-b border-slate-800">
                ProviEmplea
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <a href="/dashboard"
                    class="block px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Dashboard
                </a>
                <a href="/perfil"
                    class="block px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('perfil') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Perfil
                </a>
                <a href="/talentos"
                    class="block px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('talentos') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Talentos
                </a>
                <a href="/empresas"
                    class="block px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('empresas') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Empresas
                </a>
                <a href="/postulaciones"
                    class="block px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('postulaciones') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Postulaciones
                </a>



                <a href="/configuracion"
                    class="block px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('configuracion') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Configuración
                </a>

            </nav>

        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Topbar -->
            <header class="bg-white shadow px-8 py-4 flex justify-between items-center">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Panel Interno
                    </h1>
                </div>

                <div class="flex items-center gap-4">

                    <span class="text-gray-700 font-medium">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                            Cerrar sesión
                        </button>
                    </form>

                </div>

            </header>

            <!-- Content -->
            <main class="flex-1 p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>

</html>
