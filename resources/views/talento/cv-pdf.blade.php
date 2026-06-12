<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1a1a2e; background: #fff; }

        .header { background: #0B1739; color: #fff; padding: 28px 36px; }
        .header h1 { font-size: 22px; font-weight: bold; margin-bottom: 4px; }
        .header .subtitulo { font-size: 12px; color: #94a3b8; }
        .header .datos-contacto { margin-top: 12px; font-size: 10px; color: #cbd5e1; }
        .header .datos-contacto span { margin-right: 20px; }

        .badge-validado { display: inline-block; background: #16a34a; color: #fff; font-size: 9px;
            padding: 2px 8px; border-radius: 999px; margin-left: 10px; vertical-align: middle; }

        .body { padding: 24px 36px; }

        .seccion { margin-bottom: 20px; }
        .seccion-titulo { font-size: 10px; font-weight: bold; color: #0B1739; text-transform: uppercase;
            letter-spacing: 1px; border-bottom: 2px solid #0B1739; padding-bottom: 4px; margin-bottom: 12px; }

        .resumen { font-size: 11px; color: #374151; line-height: 1.6; }

        .item { margin-bottom: 12px; }
        .item-header { display: flex; justify-content: space-between; align-items: flex-start; }
        .item-titulo { font-weight: bold; font-size: 11px; color: #111827; }
        .item-fecha { font-size: 10px; color: #6b7280; white-space: nowrap; margin-left: 8px; }
        .item-subtitulo { font-size: 10px; color: #4b5563; margin-top: 2px; }
        .item-desc { font-size: 10px; color: #6b7280; margin-top: 4px; line-height: 1.5; }

        .grid-2 { display: table; width: 100%; }
        .col { display: table-cell; vertical-align: top; width: 50%; }
        .col:first-child { padding-right: 16px; }

        .tag { display: inline-block; background: #e0e7ff; color: #3730a3; font-size: 9px;
            padding: 2px 8px; border-radius: 4px; margin: 2px 2px 2px 0; }

        .condicion-item { margin-bottom: 5px; font-size: 10px; }
        .condicion-label { color: #6b7280; }
        .condicion-valor { color: #111827; font-weight: bold; }

        .ref { font-size: 9.5px; color: #6b7280; margin-top: 4px; }

        .footer { background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 10px 36px;
            font-size: 9px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>

<!-- ENCABEZADO -->
<div class="header">
    <h1>
        {{ $talento->user->name }}
        @if($talento->validacion)
            <span class="badge-validado">✓ Validado ProviEmplea</span>
        @endif
    </h1>
    <div class="subtitulo">
        {{ $talento->genero !== 'No especificado' ? $talento->genero : '' }}
        {{ $talento->edad > 0 ? '· ' . $talento->edad . ' años' : '' }}
    </div>
    <div class="datos-contacto">
        @if($talento->user->email)
            <span>✉ {{ $talento->user->email }}</span>
        @endif
        @if($talento->telefono)
            <span>✆ {{ $talento->telefono }}</span>
        @endif
        @if($talento->direccion && $talento->direccion !== 'No especificado')
            <span>⌂ {{ $talento->direccion }}</span>
        @endif
    </div>
</div>

<div class="body">

    <!-- RESUMEN -->
    @if($talento->resumen)
    <div class="seccion">
        <div class="seccion-titulo">Resumen Profesional</div>
        <div class="resumen">{{ $talento->resumen }}</div>
    </div>
    @endif

    <!-- DOS COLUMNAS: EDUCACIÓN + CONDICIONES -->
    <div class="grid-2">

        <!-- EDUCACIÓN -->
        <div class="col">
            @if($educacion->count())
            <div class="seccion">
                <div class="seccion-titulo">Educación</div>
                @foreach($educacion as $edu)
                <div class="item">
                    <div class="item-header">
                        <div class="item-titulo">{{ $edu->titulo ?: 'Sin título registrado' }}</div>
                        <div class="item-fecha">
                            {{ $edu->ingreso }}{{ $edu->egreso ? ' – ' . $edu->egreso : ($edu->completo ? '' : ' – Cursando') }}
                        </div>
                    </div>
                    <div class="item-subtitulo">{{ $edu->nombre_institucion }}</div>
                </div>
                @endforeach
            </div>
            @endif

            @if($perfeccionamientos->count())
            <div class="seccion">
                <div class="seccion-titulo">Perfeccionamiento y Cursos</div>
                @foreach($perfeccionamientos as $p)
                <div class="item">
                    <div class="item-header">
                        <div class="item-titulo">{{ $p->nombre_curso }}</div>
                        <div class="item-fecha">{{ $p->ingreso }}{{ $p->egreso ? ' – ' . $p->egreso : '' }}</div>
                    </div>
                    <div class="item-subtitulo">{{ $p->institucion }}</div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- CONDICIONES + IDIOMAS + COMPETENCIAS -->
        <div class="col">
            @if($talento->condicion_jornada !== 'No especificado' || $talento->condicion_modalidad !== 'No especificado' || $talento->renta_desde > 0)
            <div class="seccion">
                <div class="seccion-titulo">Condiciones Laborales</div>
                @if($talento->condicion_jornada && $talento->condicion_jornada !== 'No especificado')
                <div class="condicion-item">
                    <span class="condicion-label">Jornada: </span>
                    <span class="condicion-valor">{{ $talento->condicion_jornada }}</span>
                </div>
                @endif
                @if($talento->condicion_modalidad && $talento->condicion_modalidad !== 'No especificado')
                <div class="condicion-item">
                    <span class="condicion-label">Modalidad: </span>
                    <span class="condicion-valor">{{ $talento->condicion_modalidad }}</span>
                </div>
                @endif
                @if($talento->renta_desde > 0)
                <div class="condicion-item">
                    <span class="condicion-label">Renta esperada: </span>
                    <span class="condicion-valor">
                        ${{ number_format($talento->renta_desde, 0, ',', '.') }}
                        @if($talento->renta_hasta > 0) – ${{ number_format($talento->renta_hasta, 0, ',', '.') }}@endif
                    </span>
                </div>
                @endif
                @if($talento->discapacidad)
                <div class="condicion-item">
                    <span class="condicion-valor">Ley 21.015 — Persona con discapacidad</span>
                </div>
                @endif
            </div>
            @endif

            @if($idiomas->count())
            <div class="seccion">
                <div class="seccion-titulo">Idiomas</div>
                @foreach($idiomas as $idioma)
                <div class="condicion-item">
                    <span class="condicion-label">{{ $idioma->nombre_idioma }}: </span>
                    <span class="condicion-valor">{{ $idioma->nivel }}</span>
                </div>
                @endforeach
            </div>
            @endif

            @if($competencias->count())
            <div class="seccion">
                <div class="seccion-titulo">Competencias Técnicas</div>
                @foreach($competencias as $c)
                    <span class="tag">{{ $c->nombre_competencia }}</span>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- EXPERIENCIA LABORAL -->
    @if($experiencia->count())
    <div class="seccion">
        <div class="seccion-titulo">Experiencia Laboral</div>
        @foreach($experiencia as $exp)
        <div class="item">
            <div class="item-header">
                <div class="item-titulo">{{ $exp->cargo }}</div>
                <div class="item-fecha">{{ $exp->ingreso }}{{ $exp->egreso ? ' – ' . $exp->egreso : ' – Actualidad' }}</div>
            </div>
            <div class="item-subtitulo">{{ $exp->institucion_o_empresa }}</div>
            @if($exp->funciones)
            <div class="item-desc">{{ $exp->funciones }}</div>
            @endif
            @if($exp->referencia_nombre)
            <div class="ref">
                Referencia: {{ $exp->referencia_nombre }}
                {{ $exp->referencia_cargo ? '(' . $exp->referencia_cargo . ')' : '' }}
                {{ $exp->referencia_telefono ? '· ' . $exp->referencia_telefono : '' }}
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

</div>

<div class="footer">
    Curriculum Vitae generado por ProviEmplea · {{ now()->format('d/m/Y') }} · Municipalidad de Providencia
</div>

</body>
</html>
