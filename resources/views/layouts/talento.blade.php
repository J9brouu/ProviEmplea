<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>{{ config('app.name', 'ProviEmplea') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

        <!-- Overlay móvil -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black/50 lg:hidden"
            x-transition.opacity style="display:none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed z-30 inset-y-0 left-0 w-64 bg-slate-900 text-white flex flex-col transform transition-transform duration-300 lg:relative lg:translate-x-0">

            <div class="p-6 text-2xl font-bold border-b border-slate-800 flex items-center justify-between">
                ProviEmplea
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="/talento/dashboard" @click="sidebarOpen = false"
                    class="block px-4 py-3 rounded-xl transition {{ request()->routeIs('talento.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Dashboard
                </a>
                <a href="/talento/perfil" @click="sidebarOpen = false"
                    class="block px-4 py-3 rounded-xl transition {{ request()->routeIs('talento.perfil') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Mi Perfil
                </a>
                <a href="/talento/experiencia" @click="sidebarOpen = false"
                    class="block px-4 py-3 rounded-xl transition {{ request()->routeIs('talento.experiencia') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Experiencia
                </a>
                <a href="/talento/educacion" @click="sidebarOpen = false"
                    class="block px-4 py-3 rounded-xl transition {{ request()->routeIs('talento.educacion') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Educación
                </a>
                <a href="/talento/documentos" @click="sidebarOpen = false"
                    class="block px-4 py-3 rounded-xl transition {{ request()->routeIs('talento.documentos') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Documentos
                </a>
                <a href="/talento/procesos" @click="sidebarOpen = false"
                    class="block px-4 py-3 rounded-xl transition {{ request()->routeIs('talento.procesos') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-white' }}">
                    Procesos
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Topbar -->
            <header class="bg-white shadow px-4 md:px-8 py-4 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Portal Talento</h1>
                </div>

                <div class="flex items-center gap-3">
                    <span class="hidden sm:block text-gray-700 font-medium truncate max-w-[150px]">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 md:px-4 py-2 rounded-lg transition text-sm">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 md:p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

    <x-confirm-modal />

</body>

</html>
