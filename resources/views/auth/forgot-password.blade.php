<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Recuperar Contraseña | ProviEmplea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<main class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

    <!-- PANEL IZQUIERDO -->
    <aside class="hidden lg:flex flex-col justify-between bg-[#0B1739] text-white p-10">
        <div>
            <h1 class="text-4xl font-bold mb-4">ProviEmplea</h1>
            <p class="text-gray-300 leading-relaxed">
                Plataforma de gestión laboral y vinculación de talentos con empresas de Providencia.
            </p>
        </div>
        <div class="bg-blue-900/40 rounded-2xl p-6 mt-10">
            <div class="w-14 h-14 rounded-2xl bg-blue-700 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <h2 class="font-semibold text-xl mb-2">¿Olvidaste tu contraseña?</h2>
            <p class="text-gray-400 text-sm leading-relaxed">
                Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña de forma segura.
            </p>
        </div>
    </aside>

    <!-- FORMULARIO -->
    <section class="p-8 lg:p-12 flex items-center">
        <div class="w-full">

            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Recuperar Contraseña</h2>
                <p class="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto">
                    Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
                </p>
            </div>

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Correo Electrónico <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="correo@ejemplo.com"
                        autocomplete="email" required autofocus
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-base transition shadow-lg">
                    Enviar enlace de recuperación
                </button>

                <p class="text-center text-sm text-gray-500">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        ← Volver al inicio de sesión
                    </a>
                </p>
            </form>

        </div>
    </section>

</main>

</body>
</html>
