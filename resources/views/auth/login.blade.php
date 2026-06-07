<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar Sesión | ProviEmplea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<main class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2" role="main">

    <!-- PANEL IZQUIERDO -->
    <aside class="hidden lg:flex flex-col justify-between bg-[#0B1739] text-white p-10" aria-label="Información ProviEmplea">
        <div>
            <h1 class="text-4xl font-bold mb-4">ProviEmplea</h1>
            <p class="text-gray-300 leading-relaxed">
                Plataforma de gestión laboral y vinculación de talentos con empresas de Providencia.
            </p>
        </div>
        <div class="space-y-6 mt-10">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Portal Talento</h2>
                    <p class="text-gray-400 text-sm">Accede a tu perfil y sigue tus procesos de selección.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Portal Empresa</h2>
                    <p class="text-gray-400 text-sm">Busca talentos y gestiona tus procesos de contratación.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Panel Municipalidad</h2>
                    <p class="text-gray-400 text-sm">Valida usuarios y coordina los procesos de empleo.</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- FORMULARIO -->
    <section class="p-8 lg:p-10 flex items-center" aria-label="Formulario de inicio de sesión">
        <div class="w-full">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Iniciar Sesión</h2>
                <p class="text-gray-500 text-sm">Accede a tu cuenta en ProviEmplea.</p>
            </div>

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-6" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6" role="alert" aria-live="assertive">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Correo Electrónico <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="correo@ejemplo.com"
                        autocomplete="email" required aria-required="true" autofocus
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Contraseña <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <input type="password" id="password" name="password"
                        autocomplete="current-password" required aria-required="true"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember_me"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-gray-600">Recordarme</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-base transition shadow-lg">
                    Iniciar Sesión
                </button>

                <div class="border-t border-gray-100 pt-5 space-y-2">
                    <p class="text-center text-sm text-gray-500">¿No tienes cuenta?</p>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('registro.talento') }}"
                            class="text-center text-sm border border-gray-300 hover:bg-gray-50 text-gray-700 py-2.5 rounded-xl font-medium transition">
                            Registrarme como Talento
                        </a>
                        <a href="{{ route('registro.empresa') }}"
                            class="text-center text-sm border border-gray-300 hover:bg-gray-50 text-gray-700 py-2.5 rounded-xl font-medium transition">
                            Registrar Empresa
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

</main>

</body>
</html>
