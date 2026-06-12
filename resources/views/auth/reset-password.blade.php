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
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="font-semibold text-xl mb-2">Crea tu nueva contraseña</h2>
            <p class="text-gray-400 text-sm leading-relaxed">
                Elige una contraseña segura de al menos 8 caracteres para proteger tu cuenta.
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
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
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
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Correo Electrónico <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $request->email) }}"
                        autocomplete="username" required autofocus
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nueva Contraseña <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password" name="password"
                        autocomplete="new-password" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    <p class="text-xs text-gray-400 mt-1">Mínimo 8 caracteres</p>
                    @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Confirmar Contraseña <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        autocomplete="new-password" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
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
