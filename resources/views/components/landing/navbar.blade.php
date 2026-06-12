<nav class="bg-surface-container-lowest/95 backdrop-blur-md docked full-width top-0 sticky z-50 border-b border-outline-variant shadow-sm">
    <div class="flex justify-between items-center px-margin-desktop py-4 max-w-container-max mx-auto">
        <div class="font-headline-md text-headline-md font-bold text-primary">ProviEmplea</div>
        <div class="hidden md:flex items-center gap-8">
            <a class="text-primary font-bold border-b-2 border-primary font-body-md text-body-md transition-colors"
                href="#soluciones">Soluciones</a>
            <a class="text-on-surface-variant font-medium font-body-md text-body-md hover:text-primary transition-colors"
                href="#nosotros">Nosotros</a>
        </div>
        <div class="flex items-center gap-4">
            @php
                $navHref = auth()->check()
                    ? (Auth::user()->rol === 'admin' ? route('admin.dashboard') : (Auth::user()->rol === 'talento' ? route('talento.dashboard') : (Auth::user()->rol === 'empresa' ? route('empresa.dashboard') : route('login'))))
                    : route('login');
            @endphp
            <a href="{{ $navHref }}"
                class="px-6 py-2 rounded-lg font-label-md text-label-md text-primary hover:bg-surface-container transition-all">
                @auth
                    Ir al Panel
                @else
                    Iniciar Sesión / Registrarse
                @endauth
            </a>
        </div>
    </div>
</nav>
