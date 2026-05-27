<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Talento | ProviEmplea</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gradient-to-br from-slate-100 via-gray-100 to-blue-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- PANEL IZQUIERDO -->
        <div class="hidden lg:flex flex-col justify-between bg-[#0B1739] text-white p-12 relative overflow-hidden">

            <div>
                <h1 class="text-4xl font-bold mb-4">
                    ProviEmplea
                </h1>

                <p class="text-gray-300 leading-relaxed text-lg">
                    Plataforma de gestión laboral y vinculación de talentos con empresas.
                </p>
            </div>

            <div class="space-y-6">

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/20 flex items-center justify-center">
                        💼
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">
                            Oportunidades laborales
                        </h3>

                        <p class="text-gray-400 text-sm">
                            Encuentra empresas y ofertas alineadas a tu perfil profesional.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/20 flex items-center justify-center">
                        🚀
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">
                            Crecimiento profesional
                        </h3>

                        <p class="text-gray-400 text-sm">
                            Construye tu perfil y aumenta tu visibilidad laboral.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/20 flex items-center justify-center">
                        🔒
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">
                            Seguridad y validación
                        </h3>

                        <p class="text-gray-400 text-sm">
                            Información protegida y perfiles verificados dentro de la plataforma.
                        </p>
                    </div>
                </div>

            </div>

            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl"></div>
        </div>

        <!-- FORMULARIO -->
        <div class="p-8 lg:p-12">

            <div class="mb-10">
                <h2 class="text-4xl font-bold text-gray-900 mb-3">
                    Registro Talento
                </h2>

                <p class="text-gray-500">
                    Crea tu cuenta y comienza a construir tu perfil laboral.
                </p>
            </div>

            <form method="POST" action="{{ route('registro.talento') }}" class="space-y-6">

                @csrf

                <!-- NOMBRE -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nombre Completo
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Ingresa tu nombre completo"
                        value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required
                    >

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Correo Electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="correo@ejemplo.com"
                        value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required
                    >

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- GRID -->
                <div >

                    <!-- TELÉFONO -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Teléfono
                        </label>

                        <input
                            type="text"
                            name="telefono"
                            placeholder="+56 9 1234 5678"
                            value="{{ old('telefono') }}"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        >
                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="********"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required
                        >

                        @error('password')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirmar Contraseña
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="********"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required
                        >
                    </div>

                </div>

                <!-- BOTÓN -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl"
                >
                    Crear Cuenta
                </button>

            </form>

            <!-- FOOTER -->
            <div class="mt-8 text-center">

                <p class="text-gray-500 text-sm">
                    ¿Ya tienes una cuenta?
                </p>

                <a
                    href="{{ route('login') }}"
                    class="text-blue-600 hover:text-blue-700 font-semibold mt-1 inline-block"
                >
                    Iniciar Sesión
                </a>

            </div>

        </div>

    </div>

</body>
</html>