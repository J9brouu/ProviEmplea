# Módulo Empresa

El módulo de empresa permite a las organizaciones buscar talentos validados, solicitar contacto a través del administrador y hacer seguimiento de sus procesos de selección.

---

## Acceso

- **Registro:** `/registro/empresa`
- **Login:** `/login`
- **Portal:** `/empresa/dashboard`
- **Middleware:** `auth` + `role:empresa`

---

## Secciones implementadas

### Dashboard
Pantalla principal de la empresa. Muestra resumen de procesos activos y accesos rápidos.

**Ruta:** `GET /empresa/dashboard` → `empresa.dashboard`

---

### Perfil de Empresa
Información institucional de la organización.

**Rutas:**
- `GET /empresa/perfil` → Ver perfil
- `PUT /empresa/perfil` → Actualizar datos
- `PUT /empresa/perfil/password` → Cambiar contraseña

**Campos editables:**
- Nombre de la empresa (razón social)
- RUT empresa (con formato chileno XX.XXX.XXX-X automático)
- Rubro o sector
- Tipo de empresa (Contratación directa / EST / Outsourcing)
- Presentación institucional
- Beneficios ofrecidos
- Logo de empresa

**Diseño del perfil:** tarjeta con avatar circular, cards separadas para Información, Presentación y Beneficios. Estilo flat con fondo blanco y sombra suave.

---

### Ver Talentos (Vitrina)
Visualización del catálogo de talentos validados. La empresa ve un **CV ciego** sin datos personales identificables.

**Rutas:**
- `GET /empresa/talentos` → Vitrina de talentos
- `POST /empresa/talentos/solicitar` → Solicitar contacto con un talento

La solicitud queda en estado `pendiente` y debe ser aprobada por el administrador antes de proceder.

**Filtros disponibles:** nivel educacional, carrera, conocimientos técnicos, idioma, modalidad, jornada, renta mínima, discapacidad (Ley 21.015).

---

### Procesos
Seguimiento de los procesos de selección activos de la empresa.

**Rutas:**
- `GET /empresa/procesos` → Listado de procesos activos

Muestra el estado de cada talento en proceso (contactado, entrevista, seleccionado, no seleccionado, contratado).

---

### Antecedentes
Vista detallada de los antecedentes de un candidato en proceso.

**Ruta:** `GET /empresa/antecedentes` → `empresa.antecedentes`

---

### Usuarios de Empresa
Gestión de los usuarios internos asociados a la cuenta de empresa (RRHH, reclutadores).

**Rutas:**
- `GET /empresa/usuarios` → Listado de usuarios
- `POST /empresa/usuarios` → Agregar usuario
- `DELETE /empresa/usuarios/{id}` → Eliminar usuario

**Campos:** nombre (tomado de `users.name`), correo, teléfono, cargo.

---

### Documentos
Subida de documentos corporativos requeridos por el administrador.

**Rutas:**
- `GET /empresa/documentos` → Ver documentos
- `POST /empresa/documentos` → Subir documento
- `DELETE /empresa/documentos/{id}` → Eliminar documento

Los documentos tienen estado de validación asignado por el admin.

---

## Flujo de registro

1. La empresa accede a `/registro/empresa`
2. Completa datos básicos: nombre, correo, contraseña, RUT empresa
3. El RUT es validado con algoritmo Módulo 11 (servidor)
4. **Se envía correo de verificación** al email registrado
5. La empresa verifica su correo y puede ingresar al portal
6. El administrador valida la empresa antes de que pueda operar completamente

---

## Flujo de solicitud de contacto

```
Empresa navega la vitrina
        ↓
Empresa solicita contacto con talento
        ↓
Se crea Interaccion con estado = "pendiente"
        ↓
Admin revisa la solicitud en /admin/solicitudes
        ↓
Admin aprueba → estado pasa a "contactado"
        ↓
Admin gestiona el proceso: entrevista → seleccionado → contratado
```

---

## Tipos de empresa

| Valor | Descripción |
|-------|-------------|
| `contratacion_directa` | La empresa contrata directamente |
| `est` | Empresa de servicios transitorios |
| `outsourcing` | Contrata para prestación de servicios |

---

## Estado de validación

El campo `validacion` en `datos_empresa` indica si la empresa está habilitada en el sistema:

| Valor | Descripción |
|-------|-------------|
| `0` | Pendiente de validación por admin |
| `1` | Validada — puede operar en la plataforma |
