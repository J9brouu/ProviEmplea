<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Empresa</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

    <!-- PANEL IZQUIERDO -->
    <div class="bg-[#071847] text-white p-12 flex flex-col justify-between">

        <div>
            <h1 class="text-5xl font-bold mb-6">
                ProviEmplea
            </h1>

            <p class="text-lg text-gray-200 leading-relaxed">
                Plataforma de gestión laboral y vinculación entre empresas y talentos.
            </p>
        </div>

        <div class="space-y-8 mt-16">

            <div class="flex items-start gap-4">
                <div class="bg-blue-900 p-4 rounded-2xl">
                    🏢
                </div>

                <div>
                    <h3 class="font-bold text-2xl">
                        Publica vacantes
                    </h3>

                    <p class="text-gray-300">
                        Encuentra talentos alineados a las necesidades de tu empresa.
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="bg-blue-900 p-4 rounded-2xl">
                    📈
                </div>

                <div>
                    <h3 class="font-bold text-2xl">
                        Gestión empresarial
                    </h3>

                    <p class="text-gray-300">
                        Administra postulaciones y perfiles laborales fácilmente.
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="bg-blue-900 p-4 rounded-2xl">
                    🔒
                </div>

                <div>
                    <h3 class="font-bold text-2xl">
                        Seguridad
                    </h3>

                    <p class="text-gray-300">
                        Información protegida y perfiles verificados.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- FORMULARIO -->
    <div class="p-12 flex items-center">

        <div class="w-full">

            <h2 class="text-5xl font-bold text-gray-900 mb-3">
                Registro Empresa
            </h2>

            <p class="text-gray-500 mb-10 text-lg">
                Crea tu cuenta empresarial en ProviEmplea.
            </p>

            <form method="POST" action="{{ route('registro.empresa.store') }}">

                @csrf

                <!-- NOMBRE -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Nombre Empresa
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Correo Electrónico
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- GRID -->
                <div class="grid grid-cols-2 gap-6 mb-6">

                    <!-- RUT -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            RUT Empresa
                        </label>

                        <input type="text"
                               name="rut"
                               value="{{ old('rut') }}"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- TELEFONO -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Teléfono
                        </label>

                        <input type="text"
                               name="telefono"
                               value="{{ old('telefono') }}"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="grid grid-cols-2 gap-6 mb-8">

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Contraseña
                        </label>

                        <input type="password"
                               name="password"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            Confirmar Contraseña
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                </div>

                <!-- BOTON -->
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-4 rounded-2xl font-bold text-lg shadow-lg">
                    Crear Cuenta Empresa
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>