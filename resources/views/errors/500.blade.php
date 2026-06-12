<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Error del servidor | ProviEmplea</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<main class="w-full max-w-lg bg-white rounded-3xl shadow-2xl p-12 text-center">

    <div class="w-24 h-24 rounded-full bg-orange-50 flex items-center justify-center mx-auto mb-6">
        <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
    </div>

    <h1 class="text-6xl font-black text-gray-800 mb-3">500</h1>
    <h2 class="text-2xl font-bold text-gray-700 mb-3">Error del servidor</h2>
    <p class="text-gray-500 text-sm mb-8 leading-relaxed">
        Ocurrió un problema inesperado en el servidor.<br>
        Estamos trabajando para solucionarlo. Intenta de nuevo en unos minutos.
    </p>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="/" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-sm transition">
            Ir al inicio
        </a>
        <button onclick="window.location.reload()" class="px-6 py-3 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-xl font-semibold text-sm transition">
            Intentar de nuevo
        </button>
    </div>

    <p class="text-xs text-gray-400 mt-8 font-semibold">ProviEmplea</p>
</main>

</body>
</html>
