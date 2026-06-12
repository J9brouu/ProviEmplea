<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Registro Empresa | ProviEmplea</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<main class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2" role="main">

    <!-- PANEL IZQUIERDO -->
    <aside class="bg-[#071847] text-white p-10 flex flex-col justify-between" aria-label="Información ProviEmplea">
        <div>
            <h1 class="text-4xl font-bold mb-4">ProviEmplea</h1>
            <p class="text-gray-300 leading-relaxed">
                Plataforma de gestión laboral y vinculación entre empresas y talentos de Providencia.
            </p>
        </div>
        <div class="space-y-6 mt-10">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Busca talentos</h2>
                    <p class="text-gray-400 text-sm">Encuentra candidatos alineados a las necesidades de tu empresa.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Gestión empresarial</h2>
                    <p class="text-gray-400 text-sm">Administra postulaciones y perfiles laborales fácilmente.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-800 flex items-center justify-center shrink-0" aria-hidden="true">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Perfiles verificados</h2>
                    <p class="text-gray-400 text-sm">Información protegida y cuentas validadas por el municipio.</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- FORMULARIO -->
    <section class="p-8 lg:p-10 flex items-center" aria-label="Formulario de registro">
        <div class="w-full">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Registro Empresa</h2>
            <p class="text-gray-500 mb-8 text-sm">Crea tu cuenta empresarial en ProviEmplea.</p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6" role="alert">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('registro.empresa.store') }}" novalidate>
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Nombre Empresa <span class="text-red-500" aria-label="campo requerido">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            autocomplete="organization" required
                            aria-required="true"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Correo Electrónico <span class="text-red-500" aria-label="campo requerido">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            autocomplete="email" required aria-required="true"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    </div>

                    <div>
                        <label for="rut" class="block text-sm font-semibold text-gray-700 mb-1.5">RUT Empresa</label>
                        <input type="text" id="rut" name="rut" value="{{ old('rut') }}"
                            placeholder="76.123.456-7"
                            maxlength="12"
                            autocomplete="off"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm transition">
                    </div>

                    <div>
                        <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1.5">Teléfono</label>
                        <div class="flex rounded-xl overflow-hidden border border-gray-300 focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500">
                            <span class="inline-flex items-center px-4 py-3 bg-gray-50 text-gray-500 text-sm font-medium select-none border-r border-gray-300 shrink-0">+569</span>
                            <input type="tel" id="telefono" name="telefono"
                                value="{{ old('telefono') }}"
                                placeholder="12345678"
                                maxlength="8"
                                autocomplete="tel"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,8)"
                                class="flex-1 px-4 py-3 outline-none text-sm bg-white">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Ingresa los 8 dígitos de tu número celular</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Contraseña <span class="text-red-500" aria-label="campo requerido">*</span>
                            </label>
                            <input type="password" id="password" name="password"
                                autocomplete="new-password" required aria-required="true"
                                aria-describedby="password-hint"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm transition">
                            <p id="password-hint" class="text-xs text-gray-400 mt-1">Mínimo 8 caracteres</p>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Confirmar Contraseña <span class="text-red-500" aria-label="campo requerido">*</span>
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                autocomplete="new-password" required aria-required="true"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none text-sm transition">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-base transition shadow-lg mt-2">
                        Crear Cuenta Empresa
                    </button>

                    <p class="text-center text-sm text-gray-500">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Iniciar Sesión</a>
                    </p>
                </div>
            </form>
        </div>
    </section>

</main>

<script>
    (function () {
        var rutInput = document.getElementById('rut');
        if (!rutInput) return;

        rutInput.addEventListener('input', function () {
            var clean = this.value.replace(/[^0-9kK]/g, '').toUpperCase();
            if (clean.length === 0) { this.value = ''; return; }

            var dv   = clean.slice(-1);
            var body = clean.slice(0, -1);

            // Insert dots every 3 digits from right
            var formatted = '';
            var count = 0;
            for (var i = body.length - 1; i >= 0; i--) {
                formatted = body[i] + formatted;
                count++;
                if (count === 3 && i > 0) { formatted = '.' + formatted; count = 0; }
            }

            this.value = formatted + (clean.length > 1 ? '-' + dv : dv);
        });
    })();
</script>
</body>
</html>
