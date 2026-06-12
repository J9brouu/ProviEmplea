# Referencia de Rutas

Todas las rutas del sistema definidas en `routes/web.php` y `routes/auth.php`.

---

## Rutas públicas

| Método | URL | Nombre | Descripción |
|--------|-----|---------|-------------|
| GET | `/` | — | Página de inicio (landing) |
| GET | `/registro/talento` | `registro.talento` | Formulario de registro talento |
| POST | `/registro/talento` | `registro.talento.store` | Procesar registro talento |
| GET | `/registro/empresa` | `registro.empresa` | Formulario de registro empresa |
| POST | `/registro/empresa` | `registro.empresa.store` | Procesar registro empresa |
| GET | `/login` | `login` | Formulario de login |
| POST | `/login` | — | Procesar login |
| POST | `/logout` | `logout` | Cerrar sesión |

---

## Rutas Admin
**Middleware:** `auth` + `role:admin`

| Método | URL | Nombre | Descripción |
|--------|-----|---------|-------------|
| GET | `/admin/dashboard` | `admin.dashboard` | Panel principal |
| GET | `/admin/perfil` | `admin.perfil` | Ver perfil admin |
| PUT | `/admin/perfil/update` | `admin.perfil.update` | Actualizar nombre/correo |
| PUT | `/admin/perfil/password` | `admin.perfil.password` | Cambiar contraseña |
| GET | `/admin/talentos` | `admin.talentos` | Listado de talentos |
| PUT | `/admin/talentos/{id}` | `admin.talentos.update` | Editar talento |
| GET | `/admin/empresas` | `admin.empresas` | Listado de empresas |
| PUT | `/admin/empresas/{id}` | `admin.empresas.update` | Editar empresa |
| GET | `/admin/vitrina` | `admin.vitrina` | Vitrina de talentos |
| POST | `/admin/vitrina/enviar` | `admin.vitrina.enviar` | Publicar talento en vitrina |
| GET | `/admin/validaciones` | `admin.validaciones` | Panel de validaciones |
| PUT | `/admin/validaciones/talento/{id}/aprobar` | `admin.validaciones.talento.aprobar` | Aprobar talento |
| PUT | `/admin/validaciones/talento/{id}/rechazar` | `admin.validaciones.talento.rechazar` | Rechazar talento |
| PUT | `/admin/validaciones/archivo/{id}/aprobar` | `admin.validaciones.archivo.aprobar` | Aprobar archivo talento |
| PUT | `/admin/validaciones/archivo/{id}/rechazar` | `admin.validaciones.archivo.rechazar` | Rechazar archivo talento |
| PUT | `/admin/validaciones/empresa/{id}/aprobar` | `admin.validaciones.empresa.aprobar` | Aprobar empresa |
| PUT | `/admin/validaciones/empresa/{id}/rechazar` | `admin.validaciones.empresa.rechazar` | Rechazar empresa |
| PUT | `/admin/validaciones/archivo-empresa/{id}/aprobar` | `admin.validaciones.archivo-empresa.aprobar` | Aprobar archivo empresa |
| PUT | `/admin/validaciones/archivo-empresa/{id}/rechazar` | `admin.validaciones.archivo-empresa.rechazar` | Rechazar archivo empresa |
| GET | `/admin/solicitudes` | `admin.solicitudes` | Panel de seguimiento |
| PUT | `/admin/solicitudes/{id}/nota` | `admin.solicitudes.nota` | Agregar nota interna |
| PUT | `/admin/solicitudes/{id}/aprobar` | `admin.solicitudes.aprobar` | Aprobar solicitud |
| PUT | `/admin/solicitudes/{id}/rechazar` | `admin.solicitudes.rechazar` | Rechazar solicitud |
| PUT | `/admin/solicitudes/{id}/contactar` | `admin.solicitudes.contactar` | Marcar como contactado |
| PUT | `/admin/solicitudes/{id}/entrevista` | `admin.solicitudes.entrevista` | Marcar en entrevista |
| PUT | `/admin/solicitudes/{id}/seleccionado` | `admin.solicitudes.seleccionado` | Marcar seleccionado |
| PUT | `/admin/solicitudes/{id}/contratar` | `admin.solicitudes.contratar` | Marcar contratado |
| GET | `/admin/solicitudes/pdf` | `admin.solicitudes.pdf` | Exportar PDF |
| GET | `/admin/export/talentos` | `admin.export.talentos` | Exportar talentos a Excel |
| GET | `/admin/export/empresas` | `admin.export.empresas` | Exportar empresas a Excel |
| GET | `/admin/export/procesos` | `admin.export.procesos` | Exportar procesos a Excel |
| POST | `/admin/talentos/cvs/zip` | `admin.talentos.cvs.zip` | Descarga masiva de CVs en PDF |
| GET | `/admin/configuracion` | `admin.configuracion` | Configuración del sistema |

---

## Rutas Talento
**Middleware:** `auth` + `verified` + `role:talento`

| Método | URL | Nombre | Descripción |
|--------|-----|---------|-------------|
| GET | `/talento/dashboard` | `talento.dashboard` | Dashboard talento |
| GET | `/talento/perfil` | `talento.perfil` | Ver perfil |
| PUT | `/talento/perfil` | `talento.perfil.update` | Actualizar perfil |
| POST | `/talento/competencias` | `talento.competencias.store` | Agregar competencia |
| DELETE | `/talento/competencias/{id}` | `talento.competencias.destroy` | Eliminar competencia |
| POST | `/talento/idiomas` | `talento.idiomas.store` | Agregar idioma |
| GET | `/talento/experiencia` | `talento.experiencia` | Ver experiencia laboral |
| POST | `/talento/experiencia` | `talento.experiencia.store` | Agregar experiencia |
| PUT | `/talento/experiencia/{id}` | `talento.experiencia.update` | Editar experiencia |
| DELETE | `/talento/experiencia/{id}` | `talento.experiencia.destroy` | Eliminar experiencia |
| GET | `/talento/educacion` | `talento.educacion` | Ver educación |
| POST | `/talento/educacion` | `talento.educacion.store` | Agregar formación |
| PUT | `/talento/educacion/{id}` | `talento.educacion.update` | Editar formación |
| DELETE | `/talento/educacion/{id}` | `talento.educacion.destroy` | Eliminar formación |
| PUT | `/talento/educacion/curso/{id}` | `talento.educacion.curso.update` | Editar curso |
| DELETE | `/talento/educacion/curso/{id}` | `talento.educacion.curso.destroy` | Eliminar curso |
| GET | `/talento/documentos` | `talento.documentos` | Ver documentos |
| POST | `/talento/documentos` | `talento.documentos.store` | Subir documento |
| DELETE | `/talento/documentos/{id}` | `talento.documentos.destroy` | Eliminar documento |
| GET | `/talento/archivos/{id}` | `archivos.talento` | Descargar/ver archivo |
| GET | `/talento/procesos` | `talento.procesos` | Ver procesos |
| GET | `/talento/cv/descargar` | `talento.cv.descargar` | Descargar CV en PDF |

---

## Rutas Empresa
**Middleware:** `auth` + `verified` + `role:empresa`

| Método | URL | Nombre | Descripción |
|--------|-----|---------|-------------|
| GET | `/empresa/dashboard` | `empresa.dashboard` | Dashboard empresa |
| GET | `/empresa/perfil` | `empresa.perfil` | Ver perfil |
| PUT | `/empresa/perfil` | `empresa.perfil.update` | Actualizar perfil |
| PUT | `/empresa/perfil/password` | `empresa.perfil.password` | Cambiar contraseña |
| GET | `/empresa/talentos` | `empresa.talentos` | Vitrina de talentos |
| POST | `/empresa/talentos/solicitar` | `empresa.talentos.solicitar` | Solicitar contacto |
| GET | `/empresa/procesos` | `empresa.procesos` | Ver procesos activos |
| GET | `/empresa/antecedentes` | `empresa.antecedentes` | Ver antecedentes candidato |
| GET | `/empresa/usuarios` | `empresa.usuarios` | Gestión de usuarios |
| POST | `/empresa/usuarios` | `empresa.usuarios.store` | Agregar usuario |
| DELETE | `/empresa/usuarios/{id}` | `empresa.usuarios.destroy` | Eliminar usuario |
| GET | `/empresa/documentos` | `empresa.documentos` | Ver documentos |
| POST | `/empresa/documentos` | `empresa.documentos.store` | Subir documento |
| DELETE | `/empresa/documentos/{id}` | `empresa.documentos.destroy` | Eliminar documento |
