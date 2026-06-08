<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary-container/10 -z-10"></div>
    <div class="max-w-container-max mx-auto px-margin-desktop text-center">
        <h2 class="font-display text-headline-lg text-on-surface mb-8">¿Listo para dar el siguiente paso
            profesional?</h2>
        <div
            class="max-w-3xl mx-auto glass-card p-12 rounded-3xl border border-outline-variant shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-10">
                    Únete a la plataforma que está humanizando la tecnología de reclutamiento. Registro gratuito
                    para talentos.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @php
                        $talentoHref = auth()->check() ? (Auth::user()->rol === 'talento' ? route('talento.dashboard') : route('talento.educacion')) : route('registro.talento');
                        $empresaHref = auth()->check() ? (Auth::user()->rol === 'empresa' ? route('empresa.dashboard') : route('empresa.documentos')) : route('registro.empresa');
                    @endphp
                    <a href="{{ $talentoHref }}"
                        class="inline-flex items-center justify-center px-10 py-5 rounded-2xl bg-primary text-on-primary font-headline-md text-headline-md shadow-xl hover:scale-105 transition-all">
                        Registrarme como Talento
                    </a>
                    <a href="{{ $empresaHref }}"
                        class="inline-flex items-center justify-center px-10 py-5 rounded-2xl border-2 border-primary text-primary font-headline-md text-headline-md hover:bg-primary-container hover:text-on-primary-container transition-all">
                        Registrar Empresa
                    </a>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-full -mr-16 -mt-16 blur-xl"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-primary/10 rounded-full -ml-16 -mb-16 blur-xl"></div>
        </div>
    </div>
</section>
