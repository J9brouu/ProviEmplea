# Módulo Admin

El módulo de administración es usado por el Departamento de Empleo para gestionar perfiles, validar documentos y coordinar todo el proceso de selección entre talentos y empresas.

---

## Acceso

- **Login:** `/login`
- **Panel:** `/admin/dashboard`
- **Middleware:** `auth` + `role:admin`

---

## Secciones implementadas

### Dashboard
Vista general del sistema con métricas, alertas y gráficos estadísticos.

**Ruta:** `GET /admin/dashboard` → `admin.dashboard`

**Cifras principales:** total talentos, total empresas, usuarios registrados, total procesos.

**Alertas:** si hay talentos o empresas pendientes de validación aparece una alerta con enlace directo al panel de validaciones.

**Gráficos (Chart.js):**
- Donut — distribución de procesos por estado
- Barras — talentos por género
- Barras — talentos por jornada laboral
- Barras — talentos por modalidad de trabajo
- Barras horizontales — top rubros de empresas

---

### Perfil Administrativo
Gestión del perfil y contraseña del administrador.

**Rutas:**
- `GET /admin/perfil` → Ver perfil
- `PUT /admin/perfil/update` → Actualizar nombre y correo
- `PUT /admin/perfil/password` → Cambiar contraseña

**Funcionalidades:** Modal de edición de perfil, modal de cambio de contraseña con validación de contraseña actual. Si hay errores de contraseña, el modal se abre automáticamente al recargar.

---

### Talentos
Gestión de todos los perfiles de talento registrados en el sistema.

**Rutas:**
- `GET /admin/talentos` → Listado con búsqueda
- `PUT /admin/talentos/{id}` → Actualizar datos del talento
- `POST /admin/talentos/cvs/zip` → Descarga masiva de CVs en PDF

El admin puede ver el perfil completo de cada talento (incluyendo datos personales) y editar su información.

**Descarga masiva de CVs:** el admin selecciona talentos con checkboxes (incluyendo "seleccionar todos"), hace clic en "Descargar CVs (N)" y recibe un único PDF con todos los CVs seleccionados, uno por página. El botón muestra el conteo de seleccionados en tiempo real.

---

### Empresas
Gestión de todas las empresas registradas.

**Rutas:**
- `GET /admin/empresas` → Listado de empresas
- `PUT /admin/empresas/{id}` → Actualizar datos de empresa

---

### Validaciones
Aprobación o rechazo de perfiles y documentos antes de que aparezcan en la plataforma.

**Rutas:**

| Acción | Ruta |
|--------|------|
| Ver panel | `GET /admin/validaciones` |
| Aprobar talento | `PUT /admin/validaciones/talento/{id}/aprobar` |
| Rechazar talento | `PUT /admin/validaciones/talento/{id}/rechazar` |
| Aprobar archivo talento | `PUT /admin/validaciones/archivo/{id}/aprobar` |
| Rechazar archivo talento | `PUT /admin/validaciones/archivo/{id}/rechazar` |
| Aprobar empresa | `PUT /admin/validaciones/empresa/{id}/aprobar` |
| Rechazar empresa | `PUT /admin/validaciones/empresa/{id}/rechazar` |
| Aprobar archivo empresa | `PUT /admin/validaciones/archivo-empresa/{id}/aprobar` |
| Rechazar archivo empresa | `PUT /admin/validaciones/archivo-empresa/{id}/rechazar` |

---

### Solicitudes (Seguimiento)
Panel central de gestión del proceso de selección. Permite ver todas las interacciones empresa-talento y avanzar sus estados.

**Rutas:**

| Acción | Ruta |
|--------|------|
| Ver listado | `GET /admin/solicitudes` |
| Agregar/editar nota | `PUT /admin/solicitudes/{id}/nota` |
| Aprobar solicitud | `PUT /admin/solicitudes/{id}/aprobar` |
| Rechazar solicitud | `PUT /admin/solicitudes/{id}/rechazar` |
| Marcar contactado | `PUT /admin/solicitudes/{id}/contactar` |
| Marcar entrevista | `PUT /admin/solicitudes/{id}/entrevista` |
| Marcar seleccionado | `PUT /admin/solicitudes/{id}/seleccionado` |
| Marcar contratado | `PUT /admin/solicitudes/{id}/contratar` |
| Exportar PDF | `GET /admin/solicitudes/pdf` |

**Flujo de estados:**

```
pendiente → contactado → entrevista → seleccionado → contratado
                                                  ↘ rechazado
```

Cada solicitud puede tener **notas internas** que solo ve el administrador.

---

### Vitrina
Gestión de qué talentos están publicados en la vitrina visible para empresas.

**Rutas:**
- `GET /admin/vitrina` → Ver vitrina
- `POST /admin/vitrina/enviar` → Enviar/publicar talento en vitrina

---

## Navegación del sidebar admin

El layout `layouts/admin.blade.php` incluye el sidebar con estas secciones:

| Ítem | Ruta |
|------|------|
| Dashboard | `/admin/dashboard` |
| Perfil | `/admin/perfil` |
| Talentos | `/admin/talentos` |
| Vitrina | `/admin/vitrina` |
| Empresas | `/admin/empresas` |
| Validaciones | `/admin/validaciones` |
| Seguimiento | `/admin/solicitudes` |

El sidebar es responsive: colapsa en móvil con un overlay oscuro y se abre con el botón hamburguesa. Usa Alpine.js para el estado `sidebarOpen`.

---

## Exportación PDF

El admin puede generar un PDF con el resumen de solicitudes usando la ruta `GET /admin/solicitudes/pdf`. La vista PDF está en `resources/views/admin/pdf/solicitudes.blade.php`.

---

## Exportación Excel

Descarga de datos en formato `.xlsx` con estilos (encabezado azul oscuro, filas alternadas, bordes, filtros automáticos).

| Acción | Ruta |
|--------|------|
| Exportar talentos | `GET /admin/export/talentos` |
| Exportar empresas | `GET /admin/export/empresas` |
| Exportar procesos | `GET /admin/export/procesos` |

Clases en `app/Exports/`: `TalentosExport`, `EmpresasExport`, `ProcesosExport` (maatwebsite/excel).

---

## Mejoras futuras documentadas

- **Envío masivo de CVs por email a empresa:** actualmente el admin descarga los CVs localmente. El requerimiento original contempla que el sistema envíe los CVs directamente al correo de la empresa seleccionada. La infraestructura SMTP (Gmail) ya está configurada; falta el formulario de selección de empresa + Mailable con adjuntos. Ver detalle en [Estado del Proyecto](Estado-del-Proyecto).
