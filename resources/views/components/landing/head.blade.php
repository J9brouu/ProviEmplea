<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}" />
    <meta name="application-name" content="ProviEmplea" />
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
