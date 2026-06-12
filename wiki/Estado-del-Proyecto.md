# Estado del Proyecto

Última actualización: junio 2026 — rama `jonathan-dev`

---

## Resumen de avance general

El proyecto está en un **75–80% del total de requerimientos**. Las funcionalidades del flujo principal están operativas. Lo que falta son funcionalidades de valor agregado (exportaciones, estadísticas avanzadas, IA) y algunos detalles del registro.

---

## Módulo Talento

| Requerimiento | Estado |
|---------------|--------|
| Registro con correo y contraseña | Completo |
| Comprobante de residencia en registro | Completo |
| Validación de cuenta por correo | Completo |
| Perfil: datos de contacto, resumen | Completo |
| Antecedentes educacionales | Completo |
| Antecedentes laborales con referencias | Completo |
| Perfeccionamiento y cursos | Completo |
| Competencias técnicas | Completo |
| Idiomas con nivel | Completo |
| Condiciones laborales (renta, jornada, modalidad) | Completo |
| Marcación discapacidad Ley 21.015 | Completo |
| Indicador % completitud del perfil | Completo |
| Subida de documentos con validación | Completo |
| Historial de procesos con estados | Completo |
| CV universal generado (PDF descargable) | Completo |
| Análisis de CV con IA | Pendiente |
| Test de competencias (1 vez cada 6 meses) | Pendiente |

---

## Módulo Empresa

| Requerimiento | Estado |
|---------------|--------|
| Registro con correo | Completo |
| Validación de cuenta por correo | Completo |
| Usuarios asociados (RRHH, reclutadores) con cargo | Completo |
| Perfil: nombre, RUT, rubro, tipo de empresa | Completo |
| Perfil: presentación, beneficios, logo | Completo |
| Ver talentos con CV ciego (sin datos personales) | Completo |
| Filtros: educación, competencias, idioma, modalidad, jornada, renta, discapacidad | Completo |
| Solicitar contacto al administrador | Completo |
| Seguimiento de procesos con estados | Completo |
| Documentos corporativos | Completo |

---

## Módulo Admin

| Requerimiento | Estado |
|---------------|--------|
| Inscripción y modificación de talentos | Completo |
| Validación de perfiles y documentos (talento y empresa) | Completo |
| Procesos en curso | Completo |
| Modificación de datos de empresa | Completo |
| Modificar estado de proceso por talento | Completo |
| Notas internas por proceso | Completo |
| Revisión de contactos solicitados | Completo |
| Seguimiento a CVs enviados | Completo |
| Dashboard con resumen de procesos por estado | Completo |
| Alertas de pendientes de validación en dashboard | Completo |
| Exportación PDF de solicitudes | Completo |
| Descarga masiva de CVs en PDF desde admin | Completo — ver nota |
| Exportación de datos a Excel | Completo |
| Estadísticas avanzadas con gráficos | Completo |
| Tiempo promedio de contratación | Pendiente |
| Perfiles más buscados | Pendiente |

---

## Orden recomendado para lo pendiente

| Prioridad | Tarea | Dificultad |
|-----------|-------|-----------|
| ~~1~~ | ~~Verificación de email al registrarse~~ | ~~Baja~~ ✓ |
| ~~1~~ | ~~Comprobante de residencia en registro talento~~ | ~~Baja~~ ✓ |
| ~~3~~ | ~~CV descargable en PDF del talento~~ | ~~Media~~ ✓ |
| ~~4~~ | ~~Exportación Excel~~ | ~~Media~~ ✓ |
| ~~5~~ | ~~Estadísticas con gráficos~~ | ~~Media~~ ✓ |
| ~~6~~ | ~~Envío masivo de CVs desde admin~~ | ~~Media~~ ✓ |
| — | Test de competencias | Postergado para mejoras futuras |
| — | Análisis CV con IA | Postergado para mejoras futuras |
| — | Envío masivo de CVs por email a empresa | Postergado para mejoras futuras |

---

## Deuda técnica conocida

| Ítem | Estado |
|------|--------|
| ~~Sin paginación en listados admin~~ | ✓ Resuelto — `paginate(5)` en talentos y empresas |
| ~~Validación de RUT solo en frontend~~ | ✓ Resuelto — Rule `RutChileno` (módulo 11) en registro y perfil empresa |
| ~~Sin límite de tamaño en subida de archivos~~ | ✓ Resuelto — `max:5120` (5MB) en ambos controladores de documentos |
| ~~Sin confirmación en algunos deletes~~ | ✓ Resuelto — componente `confirm-delete` aplicado en todas las vistas |

---

## Configuración para producción

### Correo (verificación de email)

El sistema usa Gmail SMTP. Para configurarlo en cualquier entorno:

1. Ir a [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
2. Crear una contraseña de aplicación con el nombre `ProviEmplea`
3. Configurar el `.env` con los siguientes valores:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@gmail.com
MAIL_PASSWORD="clave de 16 caracteres generada por Google"
MAIL_FROM_ADDRESS="tu_correo@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

4. Ejecutar `php artisan config:clear`

> Las credenciales reales **nunca** se suben al repositorio. Cada entorno (local, producción) tiene su propio `.env`.

### Variables clave al desplegar

| Variable | Valor en producción |
|----------|-------------------|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://tu-dominio.cl` |
| `MAIL_USERNAME` | correo Gmail del remitente |
| `MAIL_PASSWORD` | contraseña de aplicación Google |

---

## Historial de cambios relevantes

| Fecha | Cambio |
|-------|--------|
| Mayo 2026 | Estructura base, autenticación, tablas principales |
| Junio 2026 | Integración frontend-backend, módulo admin, experiencia laboral |
| Junio 2026 | Merge `sebastian-dev` + correcciones post-merge |
| Junio 2026 | Perfil empresa rediseñado, RUT formateado, modales admin corregidos |
| Junio 2026 | % completitud de perfil talento (dashboard + perfil) |
| Junio 2026 | Modal CV ciego expandido en vitrina empresa |
| Junio 2026 | Dashboard admin con estadísticas de procesos y alertas de pendientes |
| Junio 2026 | Rediseño de cards en vitrina de talentos |
| Junio 2026 | Verificación de email activada (talento y empresa) |
| Junio 2026 | CV descargable en PDF generado con DomPDF |
| Junio 2026 | Deuda técnica resuelta: paginación, límite archivos, confirmación deletes, validación RUT servidor |
| Junio 2026 | Exportación a Excel de talentos, empresas y procesos (maatwebsite/excel) |
| Junio 2026 | Estadísticas con gráficos en dashboard admin (Chart.js: procesos, género, jornada, modalidad, rubro) |
| Junio 2026 | Descarga masiva de CVs en PDF desde admin (checkboxes + DomPDF, un PDF por página) |

---

## Notas de mejoras futuras

### Envío masivo de CVs a empresa (pendiente)

**Lo que hay actualmente:** el admin selecciona talentos con checkboxes en la lista y descarga un PDF con todos los CVs (uno por página). Lo debe enviar manualmente.

**Lo que pide el requerimiento original:** el sistema debería enviar los CVs directamente por correo al email de la empresa seleccionada, sin que el admin tenga que hacerlo manualmente.

**Flujo ideal a implementar en una mejora:**
1. Admin selecciona talentos + elige empresa destino
2. Clic en "Enviar CVs a empresa"
3. Sistema genera los PDFs y envía correo automático al email de la empresa con los archivos adjuntos
4. Queda registrado en el sistema qué CVs se enviaron a qué empresa y cuándo (seguimiento)

**Tecnología:** ya está disponible Gmail SMTP configurado — solo falta el formulario de selección de empresa + el `Mailable` con adjuntos.
