<section class="py-24 bg-surface">
    <div class="max-w-container-max mx-auto px-margin-desktop">
        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-12 text-center">Beneficios para el
            ecosistema</h2>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div id="talentos" class="lg:col-span-8 bg-primary rounded-[2rem] p-10 text-on-primary flex flex-col justify-between min-h-[400px] shadow-xl">
                <div>
                    <span class="text-on-primary-container bg-primary-container px-4 py-1 rounded-full text-label-sm font-label-sm inline-block mb-6">PARA
                        TALENTOS</span>
                    <h3 class="text-4xl font-bold mb-6">Tu carrera, tus reglas.</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                                <span class="font-body-md text-body-md">Visibilidad ante empresas TOP</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                                <span class="font-body-md text-body-md">Sin discriminación por edad o género</span>
                            </li>
                        </ul>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                                <span class="font-body-md text-body-md">Retroalimentación real sobre tu perfil</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                                <span class="font-body-md text-body-md">Acceso a formación exclusiva</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 flex items-center justify-between">
                    <p class="font-body-md text-on-primary-container italic">"Más de 500 profesionales ya han
                        encontrado su lugar."</p>
                    @php
                        $talentoHref = auth()->check() ? (Auth::user()->rol === 'talento' ? route('talento.dashboard') : route('talento.educacion')) : route('login');
                    @endphp
                    <a href="{{ $talentoHref }}" class="bg-white text-primary px-6 py-2 rounded-lg font-bold inline-flex items-center justify-center">Crear Perfil</a>
                </div>
            </div>
            <div id="empresas" class="lg:col-span-4 bg-secondary rounded-[2rem] p-10 text-on-secondary flex flex-col items-center justify-center text-center shadow-xl">
                <span class="text-secondary-fixed bg-on-secondary-fixed px-4 py-1 rounded-full text-label-sm font-label-sm inline-block mb-6">PARA
                    EMPRESAS</span>
                <h3 class="text-3xl font-bold mb-4">Calidad sobre cantidad</h3>
                <p class="font-body-sm text-body-sm mb-8">Acceda a un banco de talento pre-calificado y reduzca sus
                    tiempos de contratación en un 40%.</p>
                @php
                    $empresaHref = auth()->check() ? (Auth::user()->rol === 'empresa' ? route('empresa.dashboard') : route('empresa.documentos')) : route('login');
                @endphp
                <a href="{{ $empresaHref }}" class="w-full inline-flex items-center justify-center bg-secondary-fixed text-on-secondary-fixed px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">Comenzar</a>
            </div>
            <div class="lg:col-span-4 bg-surface-container p-8 rounded-[2rem] border border-outline-variant">
                <h4 class="font-title-lg text-title-lg text-on-surface mb-2">Soporte Municipal</h4>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Contamos con oficinas físicas para
                    ayudarte a optimizar tu CV y prepararte para entrevistas.</p>
            </div>
            <div class="lg:col-span-8 bg-surface-container-highest p-8 rounded-[2rem] border border-outline-variant flex items-center justify-around gap-4 flex-wrap">
                <div class="text-center">
                    <div class="text-4xl font-black text-primary">+1.2k</div>
                    <div class="font-label-md text-label-md text-on-surface-variant uppercase">Talentos Activos
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-secondary">85%</div>
                    <div class="font-label-md text-label-md text-on-surface-variant uppercase">Tasa de Contratación
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-tertiary">150+</div>
                    <div class="font-label-md text-label-md text-on-surface-variant uppercase">Empresas Aliadas
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
