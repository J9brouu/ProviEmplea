<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo | ProviEmplea</title>
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
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="font-semibold text-xl mb-2">¿Por qué verificar?</h2>
            <p class="text-gray-400 text-sm leading-relaxed">
                La verificación de correo nos permite proteger tu cuenta y asegurarnos de que eres tú quien accede a ProviEmplea.
            </p>
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <section class="p-8 lg:p-12 flex items-center">
        <div class="w-full">

            <!-- Ícono central -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Verifica tu correo</h2>
                <p class="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto">
                    Te enviamos un enlace de verificación. Revisa tu bandeja de entrada y haz clic en el enlace para activar tu cuenta.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Se envió un nuevo enlace de verificación a tu correo.
                </div>
            @endif

            <!-- Pasos -->
            <div class="bg-gray-50 rounded-2xl p-5 mb-8 space-y-3">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center font-bold shrink-0">1</span>
                    Abre tu correo electrónico
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center font-bold shrink-0">2</span>
                    Busca el mensaje de <strong>ProviEmplea</strong>
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center font-bold shrink-0">3</span>
                    Haz clic en <strong>"Verificar correo"</strong>
                </div>
            </div>

            <!-- Acciones -->
            <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                @csrf
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-base transition shadow-lg">
                    Reenviar correo de verificación
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 transition">
                    Cerrar sesión
                </button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-6">
                Esta página se actualizará automáticamente cuando verifiques tu correo.
            </p>

        </div>
    </section>

</main>

<script>
    setInterval(function () {
        fetch('/verificacion/estado')
            .then(r => r.json())
            .then(data => {
                if (data.verified) window.location.href = data.redirect;
            })
            .catch(() => {});
    }, 5000);
</script>

</body>
</html>
