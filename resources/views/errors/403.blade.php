<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Acceso no permitido | ProviEmplea</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<main class="w-full max-w-lg bg-white rounded-3xl shadow-2xl p-12 text-center">

    <div class="w-24 h-24 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-6">
        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
    </div>

    <h1 class="text-6xl font-black text-gray-800 mb-3">403</h1>
    <h2 class="text-2xl font-bold text-gray-700 mb-3">Acceso no permitido</h2>
    <p class="text-gray-500 text-sm mb-8 leading-relaxed">
        No tienes permisos para acceder a esta página.<br>
        Si crees que es un error, contacta al administrador.
    </p>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="/" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-sm transition">
            Ir al inicio
        </a>
        <a href="{{ route('login') }}" class="px-6 py-3 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-xl font-semibold text-sm transition">
            Iniciar sesión
        </a>
    </div>

    <p class="text-xs text-gray-400 mt-8 font-semibold">ProviEmplea</p>
</main>

</body>
</html>
