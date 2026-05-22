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

                <a href="/talento/dashboard"
                    class="block px-4 py-3 rounded-xl transition
        {{ request()->routeIs('talento.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Dashboard
                </a>

                <a href="/talento/perfil"
                    class="block px-4 py-3 rounded-xl transition
        {{ request()->routeIs('talento.perfil') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Mi Perfil
                </a>

                <a href="/talento/experiencia"
                    class="block px-4 py-3 rounded-xl transition
        {{ request()->routeIs('talento.experiencia') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Experiencia
                </a>

                <a href="/talento/educacion"
                    class="block px-4 py-3 rounded-xl transition
        {{ request()->routeIs('talento.educacion') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Educación
                </a>

                <a href="/talento/documentos"
                    class="block px-4 py-3 rounded-xl transition
        {{ request()->routeIs('talento.documentos') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Documentos
                </a>

                <a href="/talento/procesos"
                    class="block px-4 py-3 rounded-xl transition
        {{ request()->routeIs('talento.procesos') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Procesos
                </a>

            </nav>

        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col">

            <!-- Topbar -->
            <header class="bg-white shadow px-8 py-4 flex justify-between items-center">

                <h1 class="text-2xl font-bold text-gray-800">
                    Portal Talento
                </h1>

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
