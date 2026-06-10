# Funcionalidades del proyecto ProviEmplea

Este documento describe todas las funcionalidades del proyecto, cómo funcionan técnicamente a nivel de código y los conceptos clave involucrados. Se basa en el estado actual del código fuente.

---

## Índice

- 1. Arquitectura general
- 2. Middleware y control de acceso
- 3. Esquema de base de datos
- 4. Modelos y relaciones
- 5. Registro de usuarios
- 6. Panel de administrador
  - 6.1 Dashboard
  - 6.2 Administradores
  - 6.3 Perfil del admin
  - 6.4 Talentos
  - 6.5 Empresas
  - 6.6 Validaciones
  - 6.7 Seguimiento de solicitudes
  - 6.8 Configuración
- 7. Panel de talento
  - 7.1 Dashboard
  - 7.2 Perfil
  - 7.3 Competencias técnicas
  - 7.4 Idiomas
  - 7.5 Experiencia laboral
  - 7.6 Educación y perfeccionamiento
  - 7.7 Documentos
  - 7.8 Procesos
- 8. Panel de empresa
  - 8.1 Dashboard
  - 8.2 Perfil de empresa
  - 8.3 Vitrina de talentos
  - 8.4 Procesos de selección
  - 8.5 Usuarios asociados
  - 8.6 Documentos de empresa
- 9. Flujo completo de una solicitud de talento
- 10. Convenciones y decisiones técnicas

---

## 1. Arquitectura general

- **Framework:** Laravel 11 con Blade como motor de plantillas.
- **Autenticación:** Laravel Breeze (`routes/auth.php`) para login, logout, registro base, recuperación y verificación de email.
- **Roles:** Campo `rol` en la tabla `users` con valores `admin`, `talento`, `empresa`. Controlado por `RoleMiddleware`.
- **Estados de usuario:** Campo `estado` en `users` con valores `activo`, `pendiente`, `rechazado`, `bloqueado`, `desactivado`.
- **CSS:** Tailwind CSS compilado con Vite (`vite.config.js`).
- **PDF:** Paquete `barryvdh/laravel-dompdf` para generación de reportes.
- **Almacenamiento:** `Storage::disk('public')` para archivos subidos, accesibles vía `Storage::url()`.
- **Layouts Blade:** `layouts/admin.blade.php`, `layouts/talento.blade.php`, `layouts/empresa.blade.php`, `layouts/guest.blade.php`.
- **Componentes Blade:** `x-admin-layout`, `x-talento-layout`, `x-empresa-layout`, `x-confirm-modal`, componentes de landing en `components/landing/`.

---

## 2. Middleware y control de acceso

### `RoleMiddleware` (`app/Http/Middleware/RoleMiddleware.php`)

Verifica que el usuario autenticado tenga el rol requerido. Si no está autenticado redirige a `/login`. Si el rol no coincide lanza `abort(403)`.

Registrado en `bootstrap/app.php` como alias `role`. Se aplica en grupos de rutas:

```
Route::middleware(['auth', 'role:admin'])->group(...)
Route::middleware(['auth', 'role:talento'])->group(...)
Route::middleware(['auth', 'role:empresa'])->group(...)
```

### Redirección por rol (`/dashboard`)

La ruta `/dashboard` con middleware `auth` usa `match()` sobre `Auth::user()->rol` para redirigir a cada panel correspondiente. Evita que usuarios autenticados accedan a la landing con el middleware `guest`.

---

## 3. Esquema de base de datos

### Tabla `users` (migración base de Laravel)
| Columna | Tipo | Descripción |
|---|---|---|
| id | bigint PK | |
| name | string | Nombre del usuario |
| email | string unique | |
| password | string hashed | |
| rol | string | `admin`, `talento`, `empresa` |
| estado | string | `activo`, `pendiente`, `rechazado`, `bloqueado`, `desactivado` |
| email_verified_at | timestamp nullable | |
| remember_token | string nullable | |

### Tabla `talento`
| Columna | Tipo | Descripción |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users | |
| edad | tinyint unsigned | |
| genero | string(20) | |
| telefono | string(50) | Formato `+569XXXXXXXX` |
| direccion | string(200) | |
| resumen | text | |
| renta_desde | bigint unsigned | Entero positivo |
| renta_hasta | bigint unsigned | Entero positivo |
| condicion_jornada | string(20) | `Full-Time`, `Part-Time`, `Freelance` |
| condicion_modalidad | string(20) | `Presencial`, `Híbrido`, `Remoto` |
| discapacidad | tinyint unsigned | 0 o 1 (Ley 21.015) |
| validacion | boolean | |

### Tabla `antecedentes_educacionales`
| Columna | Tipo |
|---|---|
| talento_id | FK → talento |
| nombre_institucion | string |
| titulo | string(100) |
| ingreso | date |
| egreso | date nullable |
| completo | boolean |

### Tabla `perfeccionamiento`
| Columna | Tipo |
|---|---|
| talento_id | FK → talento |
| tipo | string |
| institucion | string |
| nombre_curso | string |
| ingreso | date |
| egreso | date nullable |

### Tabla `antecedentes_laborales`
| Columna | Tipo |
|---|---|
| talento_id | FK → talento |
| institucion_o_empresa | string(100) |
| cargo | string |
| ingreso | date |
| egreso | date nullable |
| funciones | text nullable |
| referencia_nombre | string(100) nullable |
| referencia_telefono | string(50) nullable |
| referencia_correo | string(255) nullable |
| referencia_cargo | string(255) nullable |

### Tabla `competencias_tecnicas`
| Columna | Tipo |
|---|---|
| talento_id | FK → talento |
| nombre_competencia | string |

### Tabla `talento_idiomas`
| Columna | Tipo |
|---|---|
| talento_id | FK → talento |
| nombre_idioma | string |
| nivel | string (`Básico`, `Intermedio`, `Avanzado`, `Nativo`) |

### Tabla `talento_archivo`
| Columna | Tipo |
|---|---|
| talento_id | FK → talento |
| tipo_archivo | string(20) (`cv`, `residencia`, `discapacidad`) |
| nombre_archivo | string |
| url_archivo | text |
| estado | string (`pendiente`, `aprobado`, `rechazado`) |
| motivo_rechazo | text nullable |

### Tabla `datos_empresa`
| Columna | Tipo |
|---|---|
| user_id | FK → users |
| rut_empresa | string(20) |
| rubro_empresa | string |
| tipo_empresa | string |
| presentacion_empresa | text |
| beneficios_empresa | text |
| logo_empresa | string nullable |
| validacion | boolean |

### Tabla `usuarios_empresa`
| Columna | Tipo |
|---|---|
| datos_empresa_id | FK → datos_empresa |
| user_id | FK → users |
| telefono | string(50) nullable |
| cargo | string (`RRHH`, `Reclutador`, `Supervisor`, `Jefe de Area`) |

### Tabla `archivo_empresa`
| Columna | Tipo |
|---|---|
| datos_empresa_id | FK → datos_empresa |
| tipo_archivo | string |
| nombre_archivo | string |
| url_archivo | text |
| estado | string (`pendiente`, `aprobado`, `rechazado`) |
| motivo_rechazo | text nullable |

### Tabla `interacciones`
| Columna | Tipo |
|---|---|
| datos_empresa_id | FK → datos_empresa |
| talento_id | FK → talento |
| estado | string(50) |
| notas | text nullable |
| fecha_contacto | timestamp nullable |

Estados posibles de `interacciones.estado`: `pendiente`, `contactado`, `entrevista`, `seleccionado`, `rechazado`, `contratado`.

---

## 4. Modelos y relaciones

### `User`
- Scopes: `scopeNotDesactivado()`, `scopeDesactivados()`
- Relaciones: `hasOne Talento`, `hasOne DatosEmpresa`, `hasMany UsuariosEmpresa`
- Cast: `email_verified_at` → datetime, `password` → hashed

### `Talento`
- Tabla: `talento`
- Relaciones: `belongsTo User`, `hasMany AntecedentesEducacionales`, `hasMany AntecedentesLaborales`, `hasMany CompetenciasTecnicas`, `hasMany Perfeccionamiento`, `hasMany TalentoArchivo`, `hasMany TalentoIdioma`, `hasMany Interacciones`

### `DatosEmpresa`
- Tabla: `datos_empresa`
- Relaciones: `belongsTo User`, `hasMany ArchivoEmpresa`, `hasMany UsuariosEmpresa`, `hasMany Interacciones`

### `Interacciones`
- Tabla: `interacciones`
- Relaciones: `belongsTo DatosEmpresa`, `belongsTo Talento`
- Accessors: `getEstadoTextoAttribute()` — texto legible del estado; `getEstadoColorAttribute()` — clases Tailwind para el badge de color

### `TalentoArchivo`
- Tabla: `talento_archivo`
- Relación: `belongsTo Talento` (implícita vía `talento_id`)

### `ArchivoEmpresa`
- Tabla: `archivo_empresa`

### `UsuariosEmpresa`
- Tabla: `usuarios_empresa`
- Relaciones: `belongsTo DatosEmpresa`, `belongsTo User`

---

## 5. Registro de usuarios

### Talento (`TalentoRegisterController`)
- Ruta GET `/registro/talento` → formulario
- Ruta POST `/registro/talento` → crea `User` con `rol = 'talento'`, `estado = 'pendiente'`, genera `remember_token` y marca `email_verified_at`
- Crea registro en `talento` con datos iniciales
- Autentica al usuario con `Auth::login()` y redirige al dashboard

### Empresa (`EmpresaRegisterController`)
- Ruta GET `/registro/empresa` → formulario
- Ruta POST `/registro/empresa` → crea `User` con `rol = 'empresa'`, `estado = 'pendiente'`, genera `remember_token` y marca `email_verified_at`
- Crea registro en `datos_empresa` con datos iniciales
- Autentica y redirige

Ambos arrancan en estado `pendiente` hasta que el admin los valide.

---

## 6. Panel de administrador

Rutas protegidas con `['auth', 'role:admin']`. Layout: `x-admin-layout` → `layouts/admin.blade.php`.

### 6.1 Dashboard (`admin/dashboard`)

**Controlador:** `Admin\DashboardController@index`

- Cuenta totales globales: `Talento::count()`, `DatosEmpresa::count()`, `User::count()`, `Interacciones::count()`
- Carga últimas 4 empresas y 4 talentos excluyendo desactivados con `whereHas('user', fn($q) => $q->where('estado', '!=', 'desactivado'))`
- Lista todos los admins activos: `User::where('rol', 'admin')->where('estado', '!=', 'desactivado')`
- Lista usuarios desactivados: `User::where('estado', 'desactivado')`
- Vista: `admin/dashboard.blade.php`

### 6.2 Administradores (`admin/admins`)

**Controlador:** `Admin\AdminUserController`

- `store(CreateAdminUserRequest)`: valida con `FormRequest` (nombre, email único, password confirmado). Crea `User` con `rol = 'admin'`, `email_verified_at = now()`, `remember_token = Str::random(60)`.
- `deactivate($id)`: verifica que el admin no se autodesactive (`Auth::id() !== $id`). Actualiza `estado = 'desactivado'`.
- `reactivate($id)`: busca usuario desactivado, actualiza `estado = 'activo'`.
- Rutas: `POST admin/admins`, `PUT admin/admins/{id}/desactivar`, `PUT admin/admins/{id}/reactivar`

### 6.3 Perfil del admin (`admin/perfil`)

**Controlador:** `Admin\PerfilController`

- `index()`: retorna vista `admin/perfil`
- `update(Request)`: valida `name` y `email`, actualiza `User`
- `password(Request)`: valida `password` con `confirmed`, hashea con `Hash::make()` y actualiza
- Rutas: `GET admin/perfil`, `PUT admin/perfil/update`, `PUT admin/perfil/password`

### 6.4 Talentos (`admin/talentos`)

**Controlador:** `Admin\TalentosController`

- `index()`: carga talentos paginados (5 por página) con `with('user')`, excluye desactivados. Acepta parámetro `buscar` que filtra por `user.name`, `condicion_modalidad`, `condicion_jornada` usando `LIKE`.
- `update($id)`: valida nombre, estado, modalidad, jornada y resumen. Actualiza `Talento` y `Talento->user`. Estados permitidos: `activo`, `pendiente`, `desactivado`, `bloqueado`, `rechazado`.
- Ruta: `GET admin/talentos`, `PUT admin/talentos/{id}`

### 6.5 Empresas (`admin/empresas`)

**Controlador:** `Admin\EmpresasController`

- `index()`: carga empresas paginadas (5 por página) con `with('user')`, excluye desactivadas. Acepta `buscar` que filtra por `user.name`.
- `update($id)`: valida nombre, estado, rubro, tipo y presentación. Actualiza `DatosEmpresa` y `DatosEmpresa->user`. Estados permitidos: `activo`, `pendiente`, `desactivado`, `bloqueado`, `rechazado`.
- Ruta: `GET admin/empresas`, `PUT admin/empresas/{id}`

### 6.6 Validaciones (`admin/validaciones`)

**Controlador:** `Admin\ValidacionesController`

Muestra talentos y empresas que tienen `user.estado = 'pendiente'` O archivos con `estado = 'pendiente'` (paginación separada con keys `talentos_page` y `empresas_page`).

**Regla de negocio clave:** No se puede aprobar un talento o empresa si tiene documentos con `estado = 'pendiente'`. El método `aprobarTalento` y `aprobarEmpresa` verifican `->contains('estado', 'pendiente')` en la colección de archivos antes de proceder. Si los hay, redirige con `session('error_aprobacion')` en lugar de cambiar el estado.

La vista tiene un modal de advertencia (`#modal-pendientes`) que se activa en el cliente al pulsar "Aprobar" si el atributo `data-pendientes="1"` está presente en el botón. El submit real se hace desde un `<form>` oculto.

Métodos disponibles:
| Método | Acción |
|---|---|
| `aprobarTalento($id)` | `users.estado = 'activo'` (si no hay docs pendientes) |
| `rechazarTalento($id)` | `users.estado = 'rechazado'` |
| `aprobarArchivo($id)` | `talento_archivo.estado = 'aprobado'`; si es `discapacidad`, activa `talento.discapacidad = 1` |
| `rechazarArchivo($id)` | `talento_archivo.estado = 'rechazado'` con motivo; si es `discapacidad`, limpia `talento.discapacidad = 0` |
| `aprobarEmpresa($id)` | `users.estado = 'activo'` (si no hay docs pendientes) |
| `rechazarEmpresa($id)` | `users.estado = 'rechazado'` |
| `aprobarArchivoEmpresa($id)` | `archivo_empresa.estado = 'aprobado'` |
| `rechazarArchivoEmpresa($id)` | `archivo_empresa.estado = 'rechazado'` con motivo |

### 6.7 Seguimiento de solicitudes (`admin/solicitudes`)

**Controlador:** `Admin\SolicitudesController`

- `index(Request)`: carga todas las `Interacciones` con `with(['talento.user', 'datosEmpresa.user'])`, paginadas (5 por página), ordenadas por `latest()`. Acepta parámetro `buscar` que filtra por nombre de empresa (`whereHas('datosEmpresa.user', ...)`). Calcula totales globales por estado.
- Acciones sobre una interacción (todas vía `PUT`):

| Método | Estado resultante |
|---|---|
| `aprobar($id)` | `contactado` |
| `contactar($id)` | `contactado` |
| `entrevista($id)` | `entrevista` |
| `seleccionado($id)` | `seleccionado` |
| `contratar($id)` | `contratado` |
| `rechazar($id)` | `rechazado` |
| `nota($id)` | Actualiza `notas` sin cambiar estado |

- `pdf()`: genera PDF con todas las interacciones usando `barryvdh/laravel-dompdf` y la vista `admin/pdf/solicitudes`. Se descarga como `reporte-solicitudes.pdf`.

**Efecto de `contratado`:** El talento ya no aparece en la vitrina de empresas porque `Empresa\TalentosController` aplica `whereDoesntHave('interacciones', fn($q) => $q->whereIn('estado', ['seleccionado', 'contratado']))`.

### 6.8 Configuración (`admin/configuracion`)

Vista estática `admin/configuracion.blade.php`. Sin lógica de controlador, retornada directamente desde la ruta.

---

## 7. Panel de talento

Rutas protegidas con `['auth', 'role:talento']`. Layout: `x-talento-layout` → `layouts/talento.blade.php`.

### 7.1 Dashboard (`talento/dashboard`)

**Controlador:** `Talento\DashboardController@index`

- Busca el `Talento` asociado al usuario autenticado con `Talento::where('user_id', Auth::id())->first()` (no falla si no existe aún).
- Carga las últimas 5 interacciones con `with('datosEmpresa.user')`.
- Calcula totales por estado: `contactado`, `entrevista`, `seleccionado`, `rechazado`.
- Carga documentos del talento desde `TalentoArchivo`.

### 7.2 Perfil (`talento/perfil`)

**Controlador:** `Talento\PerfilController`

- `index()`: carga `Talento`, separa competencias en predefinidas (`LISTA_COMPETENCIAS`) y "otras" usando `array_intersect` / `array_diff`. Carga idiomas y listas de referencia de `IdiomasController::LISTA_IDIOMAS` y `IdiomasController::NIVELES`.
- `update(Request)`: valida y actualiza `User` (nombre, email) y `Talento` (edad, teléfono, dirección, género, resumen, renta_desde, renta_hasta, condicion_jornada, condicion_modalidad, discapacidad). El teléfono se formatea como `+569XXXXXXXX` con `preg_replace`. `renta_desde` y `renta_hasta` son inputs numéricos enteros positivos (`nullable|numeric|min:0`).

El formulario de edición está en un modal (`#modalPerfil`) dentro de la misma vista. Si hay errores de validación, el modal se abre automáticamente vía JS (`@if($errors->any()) openModal(); @endif`).

**Lista de competencias predefinidas (`LISTA_COMPETENCIAS`):**
Excel, Word, Power BI, SAP, ERP, CRM, Trabajo en Equipo, Liderazgo, Comunicación.

### 7.3 Competencias técnicas

**Controlador:** `Talento\CompetenciasController@store`

- Elimina todas las competencias existentes del talento con `CompetenciasTecnicas::where('talento_id', ...)->delete()`.
- Combina las competencias del checkbox (`competencias[]`) con las "otras" (campo de texto libre separado por comas).
- Recrea todos los registros en `competencias_tecnicas`.
- Ruta: `POST /talento/competencias`

### 7.4 Idiomas

**Controlador:** `Talento\IdiomasController@store`

- Elimina todos los idiomas existentes con `TalentoIdioma::where('talento_id', ...)->delete()`.
- Recrea los idiomas del array `idiomas[n][nombre]` / `idiomas[n][nivel]`.
- Lista predefinida: Español, Inglés, Portugués, Francés, Alemán, Italiano, Chino Mandarín, Otro.
- Niveles: Básico, Intermedio, Avanzado, Nativo.
- Ruta: `POST /talento/idiomas`

### 7.5 Experiencia laboral (`talento/experiencia`)

**Controlador:** `Talento\AntecedentesLaboralesController`

- `index()`: lista experiencias laborales del talento ordenadas por `latest()`.
- `store(Request)`: valida institución, cargo, fechas, funciones y datos de referencia. Si se marca `actualidad`, `egreso = null`. El teléfono de referencia se formatea con `+569`.
- `update($id)`: misma validación, actualiza registro existente.
- `destroy($id)`: elimina registro.
- Rutas: `GET /talento/experiencia`, `POST`, `PUT /talento/experiencia/{id}`, `DELETE /talento/experiencia/{id}`

### 7.6 Educación y perfeccionamiento (`talento/educacion`)

**Controlador:** `Talento\AntecedentesEducacionalesController`

- `index()`: carga `AntecedentesEducacionales` y `Perfeccionamiento` del talento.
- `store(Request)`: según el campo `categoria` del formulario (`educacion` o `perfeccionamiento`), crea en la tabla correspondiente. Para educación con `actualidad` marcado, `egreso = null` y `completo = 0`.
- `updateEducacion($id)`: actualiza antecedente educacional.
- `updateCurso($id)`: actualiza perfeccionamiento.
- `destroy($id)`: elimina antecedente educacional.
- `destroyCurso($id)`: elimina perfeccionamiento.
- Rutas: `GET talento/educacion`, `POST /talento/educacion`, `PUT /talento/educacion/{id}`, `PUT /talento/educacion/curso/{id}`, `DELETE /talento/educacion/{id}`, `DELETE /talento/educacion/curso/{id}`

### 7.7 Documentos (`talento/documentos`)

**Controlador:** `Talento\DocumentosController`

Tipos permitidos definidos en la constante `TIPOS`:
| Tipo | Label | Formatos |
|---|---|---|
| `cv` | Curriculum Vitae | pdf, doc, docx |
| `residencia` | Certificado de Residencia | pdf, doc, docx, png, jpg, jpeg |
| `discapacidad` | Certificado Ley 21.015 | pdf, doc, docx, png, jpg, jpeg |

- `index()`: carga documentos del talento desde `TalentoArchivo`.
- `store(Request)`: valida tipo y archivo (máx. 5MB). Si ya existe un documento del mismo tipo, elimina el archivo físico con `Storage::disk('public')->delete()` y borra el registro anterior. Guarda el nuevo en `documentos/talento/{id}/`. **Importante:** actualiza `user.estado = 'pendiente'` para que el admin lo revise.
- `destroy($id)`: elimina archivo físico y registro. Si es de tipo `discapacidad`, limpia `talento.discapacidad = 0`.
- Rutas: `GET talento/documentos`, `POST talento/documentos`, `DELETE talento/documentos/{id}`

### 7.8 Procesos (`talento/procesos`)

**Controlador:** `Talento\ProcesosController@index`

- Carga todas las `Interacciones` donde `talento_id` = talento autenticado.
- Pagina (10 por página) con `with('datosEmpresa.user')`.
- Calcula totales por los 6 estados: `pendiente`, `contactado`, `entrevista`, `seleccionado`, `contratado`, `rechazado`.
- Vista muestra el estado de cada proceso usando los accessors `estado_texto` y `estado_color` del modelo `Interacciones`.

---

## 8. Panel de empresa

Rutas protegidas con `['auth', 'role:empresa']`. Layout: `x-empresa-layout` → `layouts/empresa.blade.php`.

### 8.1 Dashboard (`empresa/dashboard`)

**Controlador:** `Empresa\DashboardController@index`

- Usa `firstOrCreate` para asegurar que siempre exista un registro en `datos_empresa` para el usuario autenticado.
- Calcula totales: `solicitados` (total interacciones), `activos` (contactado + entrevista), `seleccionados`, `usuarios` (activos no desactivados).
- Carga los últimos 5 procesos con `with(['talento.antecedentesEducacionales'])`.

### 8.2 Perfil de empresa (`empresa/perfil`)

**Controlador:** `Empresa\PerfilController`

- `index()`: usa `firstOrCreate` para garantizar existencia del registro. Calcula totales de procesos y usuarios.
- `update(Request)`: valida y actualiza `DatosEmpresa` (rut, rubro, tipo, presentación, beneficios). Soporta subida de logo (`nullable|image|max:2048`): si ya existe uno, lo elimina del storage antes de guardar el nuevo en `logos/empresas/`. Actualiza `user.name`.
- `password(Request)`: valida `current_password` (regla nativa de Laravel), hashea y actualiza.
- Rutas: `GET empresa/perfil`, `PUT empresa/perfil`, `PUT empresa/perfil/password`

### 8.3 Vitrina de talentos (`empresa/talentos`)

**Controlador:** `Empresa\TalentosController`

- `index(Request)`: construye query sobre `Talento` con eager loading de relaciones (`competenciasTecnicas`, `idiomas`, `antecedentesEducacionales`, `antecedentesLaborales`).
- Solo muestra talentos con `user.estado = 'activo'`.
- Excluye talentos con interacciones en estado `seleccionado` o `contratado` mediante `whereDoesntHave`.
- Filtros disponibles (todos opcionales, vía `GET`):

| Parámetro | Lógica |
|---|---|
| `carrera` | `whereHas antecedentesEducacionales` con `titulo LIKE %valor%` |
| `competencia` | `whereHas competenciasTecnicas` con `nombre_competencia LIKE %valor%` |
| `idioma` | `whereHas idiomas` con `nombre_idioma = valor` (exacto) |
| `modalidad` | `where condicion_modalidad = valor` |
| `jornada` | `where condicion_jornada = valor` |
| `discapacidad` | `where discapacidad = 1` |
| `renta_max` | `where renta_desde <= valor` |

- Paginación: 9 por página con `withQueryString()`.
- Marca los talentos ya solicitados por la empresa (`$solicitados`) para mostrar badge en lugar de checkbox.
- Los perfiles son **anónimos** (CV ciego): no se muestra nombre real, solo `Talento #XXXX`.

- `solicitar(Request)`: recibe array `talentos[]` de IDs. Por cada ID, verifica si ya existe interacción con esa empresa (evita duplicados). Crea `Interacciones` con `estado = 'pendiente'` y `fecha_contacto = now()`.
- Ruta: `GET empresa/talentos`, `POST empresa/talentos/solicitar`

### 8.4 Procesos de selección (`empresa/procesos`)

**Controlador:** `Empresa\ProcesosController@index`

- Carga `Interacciones` de la empresa con `with(['talento.competenciasTecnicas', 'talento.antecedentesEducacionales'])`.
- Acepta parámetro GET `estado` para filtrar por etapa específica (`pendiente`, `contactado`, `entrevista`, `seleccionado`, `rechazado`, `contratado`).
- Paginación: 10 por página con `withQueryString()` para preservar el filtro activo.
- Calcula totales por 5 estados (sin `contratado`) para las tarjetas de resumen.
- Vista incluye un selector de filtro por etapa con opción "Todas" y enlace "Limpiar" condicional.

### 8.5 Usuarios asociados (`empresa/usuarios`)

**Controlador:** `Empresa\UsuariosController`

- `index()`: lista `UsuariosEmpresa` de la empresa autenticada con `with('user')`, excluyendo usuarios con `estado = 'desactivado'`.
- `store(Request)`: valida nombre, email único, teléfono, cargo (RRHH, Reclutador, Supervisor, Jefe de Area) y password. Crea `User` con `rol = 'empresa'`, `estado = 'activo'`, `email_verified_at = now()`, `remember_token`. Crea `UsuariosEmpresa` vinculado.
- `destroy($id)`: **no elimina físicamente**; actualiza `user.estado = 'desactivado'` (eliminación lógica).
- Rutas: `GET empresa/usuarios`, `POST empresa/usuarios`, `DELETE empresa/usuarios/{id}`

### 8.6 Documentos de empresa (`empresa/documentos`)

**Controlador:** `Empresa\DocumentosController`

- `index()`: carga `ArchivoEmpresa` de la empresa autenticada.
- `store(Request)`: valida archivo (pdf, doc, docx, png, jpg, jpeg; máx. 5MB) y tipo de archivo (string libre). Almacena en `empresa/documentos/` vía `Storage::disk('public')`. Crea registro en `archivo_empresa`.
- `destroy($id)`: elimina archivo físico del storage y el registro de la BD.
- Rutas: `GET empresa/documentos`, `POST empresa/documentos`, `DELETE empresa/documentos/{id}`

---

## 9. Flujo completo de una solicitud de talento

1. **Empresa** accede a `empresa/talentos`, aplica filtros y selecciona talentos mediante checkboxes.
2. Envía formulario POST a `empresa/talentos/solicitar` → se crean registros en `interacciones` con `estado = 'pendiente'`.
3. **Admin** accede a `admin/solicitudes`, ve las interacciones pendientes.
4. Admin puede avanzar el estado: `pendiente` → `contactado` → `entrevista` → `seleccionado` → `contratado` (o `rechazado` en cualquier punto).
5. El campo `interacciones.estado` es la única fuente de verdad del estado del proceso; no se modifica el `User` del talento.
6. Cuando `estado = 'contratado'` o `estado = 'seleccionado'`, el talento **desaparece de la vitrina** de empresa por el `whereDoesntHave` aplicado en `Empresa\TalentosController`.
7. **Talento** puede ver el estado de sus procesos en `talento/procesos` usando los accessors `estado_texto` y `estado_color` de `Interacciones`.

---

## 10. Convenciones y decisiones técnicas

- **Eliminación lógica:** nunca se borra un usuario de la BD. `estado = 'desactivado'` actúa como soft delete. Todos los listados excluyen desactivados con `where('estado', '!=', 'desactivado')` o `whereHas('user', ...)`.
- **`remember_token`:** se genera con `Str::random(10)` (o `60` en admins) al crear usuarios programáticamente para garantizar la persistencia de sesión.
- **`email_verified_at`:** se establece a `now()` al crear usuarios desde el panel (admin, empresa, usuarios de empresa) para que queden verificados sin flujo de email.
- **Teléfono:** se almacena con prefijo `+569` concatenado. En el formulario se muestra solo los 8 dígitos y se ensambla en el controlador.
- **Competencias:** el `store` de competencias hace un delete-all + re-insert en lugar de diff individual. Es simple y evita estados inconsistentes.
- **Idiomas:** igual que competencias, delete-all + re-insert por cada guardado.
- **Documentos talento:** solo puede existir uno de cada tipo (`cv`, `residencia`, `discapacidad`). Al subir uno nuevo del mismo tipo, el anterior se elimina físicamente del storage y lógicamente de la BD.
- **Discapacidad (Ley 21.015):** el campo `talento.discapacidad` se sincroniza con el estado del documento de discapacidad: se activa al aprobar el archivo y se desactiva al rechazarlo o eliminarlo.
- **Renta:** almacenada como enteros en `renta_desde` y `renta_hasta`. Los formularios usan `input[type=number]` con `min=0`, `step=1` e `inputmode=numeric`.
- **CV ciego:** en la vitrina de empresas, los talentos se muestran con ID anónimo (`Talento #XXXX`) sin exponer nombre ni email.
- **Paginación con filtros:** se usa `->withQueryString()` para que los parámetros GET se preserven en los links de paginación.
- **Títulos de pestaña:** cada layout lee la ruta actual con `Route::currentRouteName()` y la mapea a un título legible. `APP_NAME=ProviEmplea` definido en `.env`.
- **Validación de aprobación con documentos pendientes:** doble capa — servidor (controlador bloquea y devuelve `session('error_aprobacion')`) y cliente (JS intercepta el submit y muestra modal de advertencia).
