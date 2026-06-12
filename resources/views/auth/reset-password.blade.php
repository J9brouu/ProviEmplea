<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Nueva Contraseña | ProviEmplea</title>
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
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Contraseña segura</h2>
                    <p class="text-gray-400 text-sm">Usa al menos 8 caracteres con letras y números.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Acceso protegido</h2>
                    <p class="text-gray-400 text-sm">El enlace de recuperación es de uso único y expira en 60 minutos.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Tu cuenta te espera</h2>
                    <p class="text-gray-400 text-sm">Una vez restablecida, podrás acceder normalmente a tu portal.</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- FORMULARIO -->
    <section class="p-8 lg:p-12 flex items-center" aria-label="Formulario de nueva contraseña">
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
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Nueva Contraseña</h2>
                <p class="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto">
                    Ingresa y confirma tu nueva contraseña para recuperar el acceso a tu cuenta.
                </p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6" role="alert">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Correo -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Correo Electrónico <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $request->email) }}"
                        placeholder="correo@ejemplo.com"
                        autocomplete="username" required aria-required="true" autofocus
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Nueva Contraseña -->
                <div x-data="{ show: false }">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nueva Contraseña <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password"
                            autocomplete="new-password" required aria-required="true"
                            placeholder="Mínimo 8 caracteres"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 pr-11 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                            :aria-label="show ? 'Ocultar contraseña' : 'Mostrar contraseña'">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Confirmar Contraseña <span class="text-red-500" aria-label="requerido">*</span>
                    </label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation"
                            autocomplete="new-password" required aria-required="true"
                            placeholder="Repite tu nueva contraseña"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 pr-11 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                            :aria-label="show ? 'Ocultar contraseña' : 'Mostrar contraseña'">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-base transition shadow-lg">
                    Restablecer Contraseña
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
