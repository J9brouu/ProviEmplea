<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ProviEmplea | El talento busca a las empresas</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid #E2E8F0;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary": "#ffffff",
                        "secondary": "#006c49",
                        "on-tertiary-fixed-variant": "#3c475a",
                        "surface": "#f7f9fb",
                        "surface-container": "#eceef0",
                        "on-surface": "#191c1e",
                        "inverse-on-surface": "#eff1f3",
                        "surface-bright": "#f7f9fb",
                        "surface-tint": "#105ac0",
                        "on-surface-variant": "#424753",
                        "error-container": "#ffdad6",
                        "on-primary-fixed-variant": "#004396",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#c6d1e9",
                        "secondary-fixed": "#6ffbbe",
                        "on-secondary-fixed-variant": "#005236",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#d8e3fb",
                        "secondary-container": "#6cf8bb",
                        "outline-variant": "#c2c6d5",
                        "on-secondary-fixed": "#002113",
                        "primary-fixed": "#d8e2ff",
                        "outline": "#737784",
                        "on-primary": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "surface-container-low": "#f2f4f6",
                        "inverse-surface": "#2d3133",
                        "surface-container-highest": "#e0e3e5",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#001a42",
                        "on-secondary-container": "#00714d",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#bed1ff",
                        "surface-dim": "#d8dadc",
                        "background": "#f7f9fb",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-container": "#4f5a6e",
                        "primary-fixed-dim": "#aec6ff",
                        "tertiary-fixed-dim": "#bcc7de",
                        "surface-container-high": "#e6e8ea",
                        "tertiary": "#384356",
                        "inverse-primary": "#aec6ff",
                        "on-tertiary-fixed": "#111c2d",
                        "primary": "#003f8d",
                        "secondary-fixed-dim": "#4edea3",
                        "on-background": "#191c1e",
                        "primary-container": "#0055bb"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-desktop": "2.5rem",
                        "margin-mobile": "1rem",
                        "stack-sm": "0.5rem",
                        "gutter": "1.5rem",
                        "stack-md": "1rem",
                        "container-max": "1280px",
                        "stack-lg": "2rem"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "title-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "display": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "title-lg": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "label-md": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.01em",
                            "fontWeight": "500"
                        }],
                        "display": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
</head>

<body class="bg-surface text-on-surface">
    <!-- TopNavBar -->
    <nav
        class="bg-surface-container-lowest/95 backdrop-blur-md docked full-width top-0 sticky z-50 border-b border-outline-variant shadow-sm">
        <div class="flex justify-between items-center px-margin-desktop py-4 max-w-container-max mx-auto">
            <div class="font-headline-md text-headline-md font-bold text-primary">ProviEmplea</div>
            <div class="hidden md:flex items-center gap-8">
                <a class="text-primary font-bold border-b-2 border-primary font-body-md text-body-md transition-colors"
                    href="#">Soluciones</a>
                <a class="text-on-surface-variant font-medium font-body-md text-body-md hover:text-primary transition-colors"
                    href="#">Para Talentos</a>
                <a class="text-on-surface-variant font-medium font-body-md text-body-md hover:text-primary transition-colors"
                    href="#">Para Empresas</a>
                <a class="text-on-surface-variant font-medium font-body-md text-body-md hover:text-primary transition-colors"
                    href="#">Nosotros</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="px-6 py-2 rounded-lg font-label-md text-label-md text-primary hover:bg-surface-container transition-all">
                    Iniciar Sesión
                </a>

                <a href="{{ route('register') }}"
                    class="px-6 py-2 rounded-lg font-label-md text-label-md bg-primary text-on-primary hover:opacity-90 transition-all shadow-md">
                    Registrarse
                </a>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-20 pb-32">
        <div class="max-w-container-max mx-auto px-margin-desktop grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="z-10">
                <span
                    class="inline-block px-4 py-1.5 mb-6 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
                    REVERSE JOB SEARCH
                </span>
                <h1 class="font-display text-display text-on-surface mb-6 leading-tight">
                    El talento busca a las <span class="text-primary">empresas</span>.
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-lg">
                    Cambiamos las reglas del juego. En ProviEmplea, los profesionales destacan por sus habilidades
                    reales a través de CVs anónimos, permitiendo que las empresas compitan por el mejor talento.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button
                        class="px-8 py-4 rounded-xl bg-primary text-on-primary font-title-lg text-title-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all">
                        Empezar Ahora
                    </button>
                    <button
                        class="px-8 py-4 rounded-xl border-2 border-outline-variant text-on-surface font-title-lg text-title-lg hover:bg-surface-container transition-all">
                        Saber más
                    </button>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-primary-fixed rounded-full blur-3xl opacity-30">
                </div>
                <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-secondary-fixed rounded-full blur-3xl opacity-20">
                </div>
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-outline-variant aspect-[4/3]">
                    <img alt="Professional growth and community collaboration" class="w-full h-full object-cover"
                        data-alt="A modern office environment with a diverse team of young professionals collaborating around a light-colored wooden table. Natural morning light streams through large industrial windows, highlighting the clean and professional atmosphere. The scene captures a moment of creative synergy and growth, using a palette of soft whites, slate blues, and corporate deep blues to reflect an institutional yet innovative vibe."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvWN-HQHwctCbohFEdMszZ6E9FPtv6ZoWgInhoXGWm_ZoDyutH4H9Rnj4sZUy8J0AJGygjxY-sfkkeuXBBdSnHpJ3ADsb7BbRwdayEW5kDE-2OW4A4Uw3UnTaQpmuS_PWfJO1y-KoxaeksHpHlqluJPW6obTyqwSBKONeuyU-_-aDoj-XtI7GvrsRmrSNlF7h7GEbqLlNeHxNPxeVQYRnnBAHPHMBAoF9IAKnqva1gYRKIXbzzl7Pfgf9EMA3gBXNoJJ5XwqGIdTc" />
                </div>
            </div>
        </div>
    </section>
    <!-- How it Works (Blind CV) -->
    <section class="bg-surface-container-low py-24">
        <div class="max-w-container-max mx-auto px-margin-desktop">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-4">¿Cómo funciona el Blind CV?</h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">
                    Eliminamos los sesgos inconscientes para centrarnos en lo que realmente importa: tu experiencia y
                    competencias técnicas.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div
                    class="glass-card p-8 rounded-2xl flex flex-col items-start gap-4 hover:shadow-lg transition-all border border-outline-variant">
                    <div class="w-12 h-12 rounded-lg bg-primary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary-container"
                            style="font-variation-settings: 'FILL' 1;">person_off</span>
                    </div>
                    <h3 class="font-title-lg text-title-lg text-on-surface">Perfil Anónimo</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Tus datos personales, foto y género permanecen ocultos. Las empresas solo ven tu trayectoria,
                        habilidades y proyectos destacados.
                    </p>
                </div>
                <!-- Step 2 -->
                <div
                    class="glass-card p-8 rounded-2xl flex flex-col items-start gap-4 hover:shadow-lg transition-all border border-outline-variant">
                    <div class="w-12 h-12 rounded-lg bg-secondary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-secondary-container"
                            style="font-variation-settings: 'FILL' 1;">analytics</span>
                    </div>
                    <h3 class="font-title-lg text-title-lg text-on-surface">Validación Municipal</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Nuestro equipo institucional verifica tus competencias para darte el sello de calidad
                        ProviEmplea, aumentando tu visibilidad.
                    </p>
                </div>
                <!-- Step 3 -->
                <div
                    class="glass-card p-8 rounded-2xl flex flex-col items-start gap-4 hover:shadow-lg transition-all border border-outline-variant">
                    <div class="w-12 h-12 rounded-lg bg-tertiary-fixed flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-tertiary-fixed"
                            style="font-variation-settings: 'FILL' 1;">handshake</span>
                    </div>
                    <h3 class="font-title-lg text-title-lg text-on-surface">Match de Valor</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Cuando una empresa se interesa por tu perfil técnico, tú decides si quieres revelar tus datos y
                        avanzar a la entrevista.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Bento Grid Benefits -->
    <section class="py-24 bg-surface">
        <div class="max-w-container-max mx-auto px-margin-desktop">
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-12 text-center">Beneficios para el
                ecosistema</h2>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Talent High card -->
                <div
                    class="lg:col-span-8 bg-primary rounded-[2rem] p-10 text-on-primary flex flex-col justify-between min-h-[400px] shadow-xl">
                    <div>
                        <span
                            class="text-on-primary-container bg-primary-container px-4 py-1 rounded-full text-label-sm font-label-sm inline-block mb-6">PARA
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
                                    <span class="font-body-md text-body-md">Feedback real sobre tu perfil</span>
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
                        <button class="bg-white text-primary px-6 py-2 rounded-lg font-bold">Crear Perfil</button>
                    </div>
                </div>
                <!-- Small Company Card -->
                <div
                    class="lg:col-span-4 bg-secondary rounded-[2rem] p-10 text-on-secondary flex flex-col items-center justify-center text-center shadow-xl">
                    <span
                        class="text-secondary-fixed bg-on-secondary-fixed px-4 py-1 rounded-full text-label-sm font-label-sm inline-block mb-6">PARA
                        EMPRESAS</span>
                    <h3 class="text-3xl font-bold mb-4">Calidad sobre cantidad</h3>
                    <p class="font-body-sm text-body-sm mb-8">Acceda a un pool de talento pre-calificado y reduzca sus
                        tiempos de contratación en un 40%.</p>
                    <button
                        class="w-full bg-secondary-fixed text-on-secondary-fixed px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">Ver
                        Planes</button>
                </div>
                <!-- Talent Support Card -->
                <div class="lg:col-span-4 bg-surface-container p-8 rounded-[2rem] border border-outline-variant">
                    <h4 class="font-title-lg text-title-lg text-on-surface mb-2">Soporte Municipal</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Contamos con oficinas físicas para
                        ayudarte a optimizar tu CV y prepararte para entrevistas.</p>
                </div>
                <!-- Stats Card -->
                <div
                    class="lg:col-span-8 bg-surface-container-highest p-8 rounded-[2rem] border border-outline-variant flex items-center justify-around gap-4 flex-wrap">
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
    <!-- Final CTA Section -->
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
                        <button
                            class="px-10 py-5 rounded-2xl bg-primary text-on-primary font-headline-md text-headline-md shadow-xl hover:scale-105 transition-all">
                            Registrarme como Talento
                        </button>
                        <button
                            class="px-10 py-5 rounded-2xl border-2 border-primary text-primary font-headline-md text-headline-md hover:bg-primary-container hover:text-on-primary-container transition-all">
                            Registrar Empresa
                        </button>
                    </div>
                </div>
                <!-- Abstract UI background element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-full -mr-16 -mt-16 blur-xl"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-primary/10 rounded-full -ml-16 -mb-16 blur-xl"></div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-surface-container border-t border-outline-variant">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center px-margin-desktop py-stack-lg max-w-container-max mx-auto gap-12">
            <div class="max-w-xs">
                <div class="font-title-lg text-title-lg font-bold text-primary mb-4">ProviEmplea</div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 ProviEmplea. Municipal Excellence
                    in Career Growth. Impulsando el empleo local con tecnología de vanguardia.</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 w-full md:w-auto">
                <div class="flex flex-col gap-3">
                    <span class="font-label-md text-label-md font-bold text-on-surface">Ecosistema</span>
                    <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors"
                        href="#">Talentos</a>
                    <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors"
                        href="#">Empresas</a>
                </div>
                <div class="flex flex-col gap-3">
                    <span class="font-label-md text-label-md font-bold text-on-surface">Legal</span>
                    <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors"
                        href="#">Política de Privacidad</a>
                    <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors"
                        href="#">Términos de Servicio</a>
                </div>
                <div class="flex flex-col gap-3">
                    <span class="font-label-md text-label-md font-bold text-on-surface">Soporte</span>
                    <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors"
                        href="#">Contacto Institucional</a>
                    <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-secondary transition-colors"
                        href="#">Documentación API</a>
                </div>
                <div class="flex flex-col gap-4">
                    <span class="font-label-md text-label-md font-bold text-on-surface">Social</span>
                    <div class="flex gap-4">
                        <div
                            class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center hover:bg-primary hover:text-on-primary cursor-pointer transition-all">
                            <span class="material-symbols-outlined text-[20px]">share</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center hover:bg-primary hover:text-on-primary cursor-pointer transition-all">
                            <span class="material-symbols-outlined text-[20px]">link</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-container-max mx-auto px-margin-desktop py-6 border-t border-outline-variant/30 text-center">
            <span class="font-label-sm text-label-sm text-on-surface-variant">Una iniciativa de excelencia municipal
                para el crecimiento profesional regional.</span>
        </div>
    </footer>
    <script>
        // Micro-interactions and subtle effects
        document.addEventListener('DOMContentLoaded', () => {
            // Header scroll effect
            const nav = document.querySelector('nav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    nav.classList.add('shadow-md', 'py-2');
                    nav.classList.remove('py-4');
                } else {
                    nav.classList.remove('shadow-md', 'py-2');
                    nav.classList.add('py-4');
                }
            });

            // Intersection Observer for fade-in elements
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.glass-card, section h2, .lg\\:col-span-8, .lg\\:col-span-4').forEach(el => {
                el.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
