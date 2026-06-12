# Base de Datos

## Diagrama de relaciones

```
users
  ├── id, name, email, password, role, estado
  │
  ├── talento (1:1)
  │     ├── id, user_id, edad, genero, telefono, direccion
  │     ├── resumen, renta_desde, renta_hasta
  │     ├── condicion_jornada, condicion_modalidad
  │     ├── discapacidad (0/1), validacion (0/1)
  │     │
  │     ├── antecedentes_educacionales (1:N)
  │     │     └── nombre_institucion, ingreso, egreso, completo, titulo
  │     │
  │     ├── antecedentes_laborales (1:N)
  │     │     └── institucion_o_empresa, ingreso, egreso, cargo, funciones
  │     │         referencia_nombre, referencia_telefono, referencia_correo, referencia_cargo
  │     │
  │     ├── perfeccionamiento (1:N)
  │     │     └── tipo, institucion, nombre_curso, ingreso, egreso
  │     │
  │     ├── competencias_tecnicas (1:N)
  │     │     └── nombre_competencia
  │     │
  │     ├── talento_idiomas (1:N)
  │     │     └── idioma, nivel
  │     │
  │     ├── talento_archivo (1:N)
  │     │     └── tipo_archivo, url_archivo, nombre_archivo, estado
  │     │
  │     └── interacciones (1:N) ←→ datos_empresa
  │
  └── datos_empresa (1:1)
        ├── id, user_id, rut_empresa, nombre_empresa*
        ├── rubro_empresa, tipo_empresa, presentacion_empresa
        ├── beneficios_empresa, logo, validacion (0/1)
        │
        ├── usuarios_empresa (1:N)
        │     └── datos_empresa_id, user_id*, telefono, cargo
        │
        ├── archivo_empresa (1:N)
        │     └── tipo_archivo, url_archivo, nombre_archivo, estado
        │
        └── interacciones (1:N) ←→ talento
              └── datos_empresa_id, talento_id, estado, notas, fecha_contacto
```

> `*` El nombre de empresa se toma de `users.name` asociado a `datos_empresa.user_id`.

---

## Descripción de tablas

### `users`
Tabla base de autenticación. Extendida con campos de rol y estado.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigint | PK |
| `name` | string | Nombre completo (o razón social para empresa) |
| `email` | string | Correo único |
| `password` | string | Hash bcrypt |
| `role` | string | `admin`, `talento`, `empresa` |
| `estado` | string/bool | Estado del usuario |

---

### `talento`
Perfil profesional del candidato.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `user_id` | FK | Relación con `users` |
| `edad` | tinyint | Edad en años |
| `genero` | string(20) | Género |
| `telefono` | string(50) | Teléfono de contacto |
| `direccion` | string(200) | Dirección |
| `resumen` | text | Resumen profesional |
| `renta_desde` | bigint | Pretensión de renta mínima (CLP) |
| `renta_hasta` | bigint | Pretensión de renta máxima (CLP) |
| `condicion_jornada` | string(20) | Jornada deseada (completa, parcial, etc.) |
| `condicion_modalidad` | string(20) | Modalidad deseada (presencial, remoto, híbrido) |
| `discapacidad` | tinyint | 1 = tiene discapacidad (Ley 21.015) |
| `validacion` | boolean | 1 = validado por admin |

---

### `antecedentes_educacionales`
Historial académico del talento.

| Campo | Descripción |
|-------|-------------|
| `nombre_institucion` | Universidad, instituto o colegio |
| `ingreso` | Fecha de inicio |
| `egreso` | Fecha de término (nullable si en curso) |
| `completo` | Si terminó los estudios |
| `titulo` | Título o grado obtenido |

---

### `antecedentes_laborales`
Historial de experiencia laboral con referencias.

| Campo | Descripción |
|-------|-------------|
| `institucion_o_empresa` | Nombre del empleador |
| `cargo` | Puesto desempeñado |
| `funciones` | Descripción de funciones |
| `referencia_nombre/telefono/correo/cargo` | Datos de referencia laboral |

---

### `datos_empresa`
Perfil institucional de la empresa.

| Campo | Descripción |
|-------|-------------|
| `rut_empresa` | RUT en formato XX.XXX.XXX-X |
| `rubro_empresa` | Sector o industria |
| `tipo_empresa` | Contratación directa / EST / Outsourcing |
| `presentacion_empresa` | Descripción institucional |
| `beneficios_empresa` | Beneficios ofrecidos |
| `logo` | Ruta al logo subido |
| `validacion` | 1 = validada por admin |

---

### `interacciones`
Registro central del proceso de selección entre empresa y talento.

| Campo | Descripción |
|-------|-------------|
| `datos_empresa_id` | FK a la empresa |
| `talento_id` | FK al talento |
| `estado` | Estado actual del proceso |
| `notas` | Notas internas del administrador |
| `fecha_contacto` | Timestamp del primer contacto |

**Estados posibles:**

| Estado BD | Texto mostrado | Color |
|-----------|----------------|-------|
| `pendiente` | Pendiente | Amarillo |
| `contactado` | Contactado | Verde |
| `entrevista` | Entrevista | Morado |
| `seleccionado` | Seleccionado | Azul |
| `rechazado` | No Seleccionado | Rojo |
| `contratado` | Contratado | Esmeralda |

---

### `talento_archivo` / `archivo_empresa`
Documentos subidos por talento o empresa.

| Campo | Descripción |
|-------|-------------|
| `tipo_archivo` | Categoría del documento |
| `url_archivo` | Ruta relativa en Storage |
| `nombre_archivo` | Nombre original del archivo |
| `estado` | Estado de validación (pendiente/aprobado/rechazado) |

---

## Migraciones en orden cronológico

| Archivo | Descripción |
|---------|-------------|
| `0001_01_01_000000` | Tabla users, password_resets, sessions |
| `0001_01_01_000001` | Tabla cache |
| `0001_01_01_000002` | Tabla jobs (colas) |
| `2026_05_22_005309` | Tablas principales: talento, empresa, interacciones, archivos |
| `2026_05_23_000000` | user_id en usuarios_empresa, campo estado en users |
| `2026_05_24_000000` | Tabla talento_idiomas |
| `2026_05_24_000001` | Campo nombre_archivo en talento_archivo |
| `2026_06_06_190419` | Campo estado en talento_archivo |
| `2026_06_06_194201` | egreso nullable en antecedentes_educacionales |
| `2026_06_07_000000` | Campo nombre_archivo en archivo_empresa |
| `2026_06_07_000001` | Campo estado en archivo_empresa |
| `2026_06_07_000002` | Estado contratado en interacciones |
| `2026_06_07_000003` | Campo cargo en usuarios_empresa |
| `2026_06_07_000004` | Campo logo en datos_empresa |
