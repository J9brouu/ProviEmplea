<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Talento | ProviEmplea</title>
    @vite(['resources/css/app.css'])
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Oportunidades laborales</h2>
                    <p class="text-gray-400 text-sm">Encuentra empresas alineadas a tu perfil profesional.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Crecimiento profesional</h2>
                    <p class="text-gray-400 text-sm">Construye tu perfil y aumenta tu visibilidad laboral.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Perfiles verificados</h2>
                    <p class="text-gray-400 text-sm">Información protegida y cuentas validadas por el municipio.</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- FORMULARIO -->
    <section class="p-8 lg:p-10" aria-label="Formulario de registro">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Registro Talento</h2>
            <p class="text-gray-500 text-sm">Crea tu cuenta y comienza a construir tu perfil laboral.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6" role="alert" aria-live="assertive">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('registro.talento') }}" class="space-y-5" novalidate>
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Nombre Completo <span class="text-red-500" aria-label="requerido">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Ingresa tu nombre completo"
                    autocomplete="name" required aria-required="true"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Correo Electrónico <span class="text-red-500" aria-label="requerido">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="correo@ejemplo.com"
                    autocomplete="email" required aria-required="true"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
            </div>

            <div>
                <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1.5">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                    placeholder="+56 9 1234 5678" autocomplete="tel"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Contraseña <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <input type="password" id="password" name="password"
                        autocomplete="new-password" required aria-required="true"
                        aria-describedby="pw-hint"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm transition">
                    <p id="pw-hint" class="text-xs text-gray-400 mt-1">Mínimo 8 caracteres</p>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Confirmar Contraseña <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        autocomplete="new-password" required aria-required="true"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm transition">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-base transition shadow-lg">
                Crear Cuenta
            </button>

            <p class="text-center text-sm text-gray-500">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Iniciar Sesión</a>
            </p>
        </form>
    </section>

</main>

</body>
</html>
