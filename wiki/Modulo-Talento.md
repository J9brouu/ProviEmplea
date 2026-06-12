# Módulo Talento

El módulo de talento permite a las personas en búsqueda de empleo construir su perfil profesional, subir documentos y hacer seguimiento de sus procesos.

---

## Acceso

- **Registro:** `/registro/talento`
- **Login:** `/login`
- **Portal:** `/talento/dashboard`
- **Middleware:** `auth` + `role:talento`

---

## Secciones implementadas

### Dashboard
Pantalla principal del talento. Muestra un resumen del estado del perfil y accesos rápidos a las secciones.

**Ruta:** `GET /talento/dashboard` → `talento.dashboard`

---

### Perfil
Datos personales y condiciones laborales deseadas.

**Rutas:**
- `GET /talento/perfil` → Ver perfil
- `PUT /talento/perfil` → Actualizar perfil

**Campos editables:**
- Nombre, correo, teléfono, dirección
- Edad, género
- Resumen profesional
- Pretensión de renta (desde/hasta)
- Condición de jornada (completa, parcial, por hora)
- Condición de modalidad (presencial, remoto, híbrido)
- Marcación de discapacidad (Ley 21.015)

**También desde el perfil:**
- Gestión de competencias técnicas (agregar/eliminar tags)
- Gestión de idiomas con nivel

---

### Competencias Técnicas
Tags de habilidades técnicas asociados al perfil del talento.

**Rutas:**
- `POST /talento/competencias` → Agregar competencia
- `DELETE /talento/competencias/{id}` → Eliminar competencia

---

### Experiencia Laboral
CRUD completo de antecedentes laborales con datos de referencia.

**Rutas:**
- `GET /talento/experiencia` → Listado
- `POST /talento/experiencia` → Agregar
- `PUT /talento/experiencia/{id}` → Editar
- `DELETE /talento/experiencia/{id}` → Eliminar

**Campos:** empresa, cargo, período (ingreso/egreso), funciones, datos de referencia (nombre, teléfono, correo, cargo).

---

### Educación
Antecedentes educacionales y cursos de perfeccionamiento.

**Rutas:**
- `GET /talento/educacion` → Listado
- `POST /talento/educacion` → Agregar formación
- `PUT /talento/educacion/{id}` → Editar formación
- `DELETE /talento/educacion/{id}` → Eliminar formación
- `PUT /talento/educacion/curso/{id}` → Editar curso
- `DELETE /talento/educacion/curso/{id}` → Eliminar curso

**Campos formación:** institución, período, título, estado de completitud.
**Campos curso (perfeccionamiento):** tipo, institución, nombre del curso, período.

---

### Documentos
Subida y gestión de documentos requeridos (comprobantes, certificados, CV, etc.).

**Rutas:**
- `GET /talento/documentos` → Ver documentos subidos
- `POST /talento/documentos` → Subir documento
- `DELETE /talento/documentos/{id}` → Eliminar documento
- `GET /talento/archivos/{id}` → Descargar/ver archivo

Los archivos se almacenan en `storage/app/public/` y tienen un estado de validación asignado por el administrador.

**Estados de documento:**
- Pendiente
- Aprobado
- Rechazado

---

### Procesos
Historial de los procesos de selección en los que el talento está involucrado.

**Ruta:** `GET /talento/procesos` → `talento.procesos`

Muestra la empresa, el estado actual del proceso y la fecha de contacto.

---

### CV Descargable (PDF)

El talento puede descargar su propio CV en formato PDF desde la sección de perfil.

**Ruta:** `GET /talento/cv/descargar` → `talento.cv.descargar`

Genera un PDF con diseño profesional (encabezado azul oscuro, layout de dos columnas) usando DomPDF. El archivo se nombra `CV_Nombre_Talento_ProviEmplea.pdf`.

---

## Flujo de registro

1. El talento accede a `/registro/talento`
2. Completa datos básicos: nombre, correo, contraseña
3. Se crea el usuario con `role = talento`
4. Se crea el registro en la tabla `talento` con valores por defecto
5. **Se envía correo de verificación** al email registrado (Gmail SMTP)
6. El talento verifica su correo haciendo clic en el enlace recibido
7. El talento puede comenzar a completar su perfil
8. El administrador debe validar el perfil para que aparezca en la vitrina

---

## Estado de validación

El campo `validacion` en la tabla `talento` controla si el perfil es visible en la vitrina pública para empresas:

| Valor | Descripción |
|-------|-------------|
| `0` | Pendiente de validación |
| `1` | Validado — visible en vitrina |

El administrador puede aprobar o rechazar el perfil desde el módulo de Validaciones.
