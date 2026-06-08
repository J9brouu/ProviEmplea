<section class="relative overflow-hidden pt-20 pb-32">
    <div class="max-w-container-max mx-auto px-margin-desktop grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="z-10">
            <span
                class="inline-block px-4 py-1.5 mb-6 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
                BÚSQUEDA INVERSA DE EMPLEO
            </span>
            <h1 class="font-display text-display text-on-surface mb-6 leading-tight">
                El talento busca a las <span class="text-primary">empresas</span>.
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-lg">
                Cambiamos las reglas del juego. En ProviEmplea, los profesionales destacan por sus habilidades
                reales a través de CVs anónimos, permitiendo que las empresas compitan por el mejor talento.
            </p>
            <div class="flex flex-wrap gap-4">
                @php
                    $ctaHref = auth()->check()
                        ? (Auth::user()->rol === 'admin' ? route('admin.dashboard') : (Auth::user()->rol === 'talento' ? route('talento.dashboard') : (Auth::user()->rol === 'empresa' ? route('empresa.dashboard') : route('login'))))
                        : route('login');
                @endphp
                <a href="{{ $ctaHref }}"
                    class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-primary text-on-primary font-title-lg text-title-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all">
                    Empezar Ahora
                </a>
                <a href="#soluciones"
                    class="inline-flex items-center justify-center px-8 py-4 rounded-xl border-2 border-outline-variant text-on-surface font-title-lg text-title-lg hover:bg-surface-container transition-all">
                    Saber más
                </a>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -top-12 -right-12 w-64 h-64 bg-primary-fixed rounded-full blur-3xl opacity-30"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-secondary-fixed rounded-full blur-3xl opacity-20"></div>
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-outline-variant aspect-[4/3]">
                <img alt="Crecimiento profesional y colaboración en equipo" class="w-full h-full object-cover"
                    data-alt="Un entorno de oficina moderno con un equipo diverso de jóvenes profesionales colaborando alrededor de una mesa de madera clara. La luz natural de la mañana entra por grandes ventanales industriales, resaltando un ambiente limpio y profesional. La escena refleja un momento de sinergia creativa y crecimiento con una paleta de tonos blancos suaves, azules pizarra y azules profundos corporativos para transmitir una vibra institucional e innovadora."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvWN-HQHwctCbohFEdMszZ6E9FPtv6ZoWgInhoXGWm_ZoDyutH4H9Rnj4sZUy8J0AJGygjxY-sfkkeuXBBdSnHpJ3ADsb7BbRwdayEW5kDE-2OW4A4Uw3UnTaQpmuS_PWfJO1y-KoxaeksHpHlqluJPW6obTyqwSBKONeuyU-_-aDoj-XtI7GvrsRmrSNlF7h7GEbqLlNeHxNPxeVQYRnnBAHPHMBAoF9IAKnqva1gYRKIXbzzl7Pfgf9EMA3gBXNoJJ5XwqGIdTc" />
            </div>
        </div>
    </div>
</section>
