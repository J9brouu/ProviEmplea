# Funcionalidades del proyecto ProviEmplea

Este documento describe todas las funcionalidades del proyecto. Cada sección incluye primero una explicación en lenguaje simple para personas sin conocimientos técnicos, y luego el detalle técnico para desarrolladores.

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

**En palabras simples:**
ProviEmplea es una plataforma web que conecta personas que buscan trabajo (talentos) con empresas que buscan candidatos, todo supervisado por un equipo administrador. La plataforma tiene tres tipos de usuarios con pantallas y permisos distintos: el administrador gestiona y valida todo, los talentos completan su perfil profesional, y las empresas buscan y solicitan candidatos. La información de todos se guarda en una base de datos, y los archivos (CVs, certificados) se guardan en el servidor.

**Técnico:**
- **Framework:** Laravel 11 con Blade como motor de plantillas.
- **Autenticación:** Laravel Breeze (`routes/auth.php`) para login, logout, registro base, recuperación y verificación de email.
- **Roles:** Campo `rol` en la tabla `users` con valores `admin`, `talento`, `empresa`. Controlado por `RoleMiddleware`.
- **Estados de usuario:** Campo `estado` en `users` con valores `activo`, `pendiente`, `rechazado`, `bloqueado`, `desactivado`.
- **CSS:** Tailwind CSS compilado con Vite (`vite.config.js`).
- **PDF:** Paquete `barryvdh/laravel-dompdf` para generación de reportes.
- **Almacenamiento:** `Storage::disk('public')` para archivos subidos, accesibles vía `Storage::url()`. Solución temporal para proyecto de título (sin S3).
- **Layouts Blade:** `layouts/admin.blade.php`, `layouts/talento.blade.php`, `layouts/empresa.blade.php`, `layouts/guest.blade.php`.
- **Componentes Blade:** `x-admin-layout`, `x-talento-layout`, `x-empresa-layout`, `x-confirm-modal`, componentes de landing en `components/landing/`.

---

## 2. Middleware y control de acceso

**En palabras simples:**
Cada sección de la plataforma está protegida: solo el tipo de usuario correcto puede entrar. Si un talento intenta acceder al panel de administración, el sistema lo bloquea automáticamente. Lo mismo aplica si alguien intenta acceder sin haber iniciado sesión. Cuando un usuario inicia sesión, el sistema lo reconoce por su tipo de cuenta y lo lleva directo a su panel correspondiente.

**Técnico:**

### `RoleMiddleware` (`app/Http/Middleware/RoleMiddleware.php`)

Verifica que el usuario autenticado tenga el rol requerido. Si no está autenticado redirige a `/login`. Si el rol no coincide lanza `abort(403)`.

**Nota de seguridad:** Todos los controladores de recursos del talento (`AntecedentesLaboralesController`, `PerfeccionamientoController`) verifican además que el ID del registro pertenezca al talento autenticado antes de permitir edición o eliminación, evitando acceso cruzado entre usuarios.

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

**En palabras simples:**
La base de datos es el lugar donde se guarda toda la información de la plataforma. Cada "tabla" es como una hoja de cálculo con columnas específicas. Por ejemplo, la tabla de usuarios guarda el nombre, correo y tipo de cuenta de cada persona. La tabla de talentos guarda el currículum profesional. La tabla de interacciones registra qué empresas están interesadas en qué talentos y en qué etapa va ese proceso.

**Técnico:**

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

**En palabras simples:**
Los modelos son la forma en que el código representa cada entidad del sistema (un usuario, un talento, una empresa, etc.) y cómo están conectadas entre sí. Por ejemplo, un talento está conectado a su cuenta de usuario, a sus documentos, a sus idiomas y a los procesos de selección en los que participa. Estas conexiones permiten obtener toda la información relacionada de forma eficiente con una sola consulta.

**Técnico:**

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

**En palabras simples:**
Cualquier persona puede crear una cuenta como talento o como empresa desde la página de inicio. Al registrarse, la cuenta queda en estado "pendiente" hasta que el administrador la revise y apruebe. Esto garantiza que solo personas y empresas verificadas puedan usar la plataforma. Una vez registrado, el sistema inicia sesión automáticamente y lleva al usuario a su panel.

**Técnico:**

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

**En palabras simples:**
El panel de administrador es el centro de control de toda la plataforma. Desde aquí, el equipo de ProviEmplea puede ver estadísticas generales, gestionar las cuentas de talentos y empresas, aprobar o rechazar documentos, y hacer seguimiento de todos los procesos de selección activos. Solo los usuarios con rol de administrador pueden acceder a esta sección.

Rutas protegidas con `['auth', 'role:admin']`. Layout: `x-admin-layout` → `layouts/admin.blade.php`.

### 6.1 Dashboard (`admin/dashboard`)

**En palabras simples:**
Es la pantalla de inicio del administrador. Muestra un resumen rápido de todo lo que está pasando en la plataforma: cuántos talentos y empresas están registrados, cuántos procesos de selección hay activos, las empresas y talentos más recientes, y la lista de otros administradores del sistema. También permite ver y reactivar cuentas desactivadas.

**Técnico:**

**Controlador:** `Admin\DashboardController@index`

- Cuenta totales globales: `Talento::count()`, `DatosEmpresa::count()`, `User::count()`, `Interacciones::count()`
- Carga últimas 4 empresas y 4 talentos excluyendo desactivados con `whereHas('user', fn($q) => $q->where('estado', '!=', 'desactivado'))`
- Lista todos los admins activos: `User::where('rol', 'admin')->where('estado', '!=', 'desactivado')`
- Lista usuarios desactivados: `User::where('estado', 'desactivado')`
- Vista: `admin/dashboard.blade.php`

### 6.2 Administradores (`admin/admins`)

**En palabras simples:**
Permite crear nuevas cuentas de administrador para que otros miembros del equipo de ProviEmplea puedan gestionar la plataforma. También permite desactivar temporalmente a un administrador (por ejemplo si deja el equipo) o reactivarlo. Un administrador no puede desactivarse a sí mismo.

**Técnico:**

**Controlador:** `Admin\AdminUserController`

- `store(CreateAdminUserRequest)`: valida con `FormRequest` (nombre, email único, password confirmado). Crea `User` con `rol = 'admin'`, `email_verified_at = now()`, `remember_token = Str::random(60)`.
- `deactivate($id)`: verifica que el admin no se autodesactive (`Auth::id() !== $id`). Actualiza `estado = 'desactivado'`.
- `reactivate($id)`: busca usuario desactivado, actualiza `estado = 'activo'`.
- Rutas: `POST admin/admins`, `PUT admin/admins/{id}/desactivar`, `PUT admin/admins/{id}/reactivar`

### 6.3 Perfil del admin (`admin/perfil`)

**En palabras simples:**
Cada administrador puede actualizar su propio nombre y correo electrónico, y también cambiar su contraseña cuando lo necesite.

**Técnico:**

**Controlador:** `Admin\PerfilController`

- `index()`: retorna vista `admin/perfil`
- `update(Request)`: valida `name` y `email`, actualiza `User`
- `password(Request)`: valida `password` con `confirmed`, hashea con `Hash::make()` y actualiza
- Rutas: `GET admin/perfil`, `PUT admin/perfil/update`, `PUT admin/perfil/password`

### 6.4 Talentos (`admin/talentos`)

**En palabras simples:**
El administrador puede ver la lista completa de talentos registrados, buscarlos por nombre o tipo de trabajo, y editar sus datos principales como el nombre, el estado de la cuenta, la modalidad de trabajo preferida o el resumen profesional. Esto es útil para corregir información incorrecta o gestionar el estado de una cuenta.

**Técnico:**

**Controlador:** `Admin\TalentosController`

- `index()`: carga talentos paginados (5 por página) con `with('user')`, excluye desactivados. Acepta parámetro `buscar` que filtra por `user.name`, `condicion_modalidad`, `condicion_jornada` usando `LIKE`.
- `update($id)`: valida nombre, estado, modalidad, jornada y resumen. Actualiza `Talento` y `Talento->user`. Estados permitidos: `activo`, `pendiente`, `desactivado`, `bloqueado`, `rechazado`.
- Ruta: `GET admin/talentos`, `PUT admin/talentos/{id}`

### 6.5 Empresas (`admin/empresas`)

**En palabras simples:**
Similar a la gestión de talentos, pero para empresas. El administrador puede buscar empresas, editar sus datos (nombre, rubro, tipo de empresa, presentación) y cambiar el estado de su cuenta.

**Técnico:**

**Controlador:** `Admin\EmpresasController`

- `index()`: carga empresas paginadas (5 por página) con `with('user')`, excluye desactivadas. Acepta `buscar` que filtra por `user.name`.
- `update($id)`: valida nombre, estado, rubro, tipo y presentación. Actualiza `DatosEmpresa` y `DatosEmpresa->user`. Estados permitidos: `activo`, `pendiente`, `desactivado`, `bloqueado`, `rechazado`.
- Ruta: `GET admin/empresas`, `PUT admin/empresas/{id}`

### 6.6 Validaciones (`admin/validaciones`)

**En palabras simples:**
Esta es una de las secciones más importantes. Cuando un talento o empresa se registra o sube documentos, queda en estado "pendiente" hasta que el administrador los revise. Aquí el admin puede ver los documentos subidos (CV, certificado de residencia, certificados de empresa) y decidir si aprobarlos o rechazarlos con un motivo. Solo cuando todos los documentos de un usuario están revisados (aprobados o rechazados), se puede aprobar la cuenta completa. Si se intenta aprobar una cuenta con documentos aún pendientes, el sistema muestra un aviso de advertencia y bloquea la acción.

**Técnico:**

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

**En palabras simples:**
Aquí el administrador gestiona todos los procesos de selección activos. Cuando una empresa solicita contacto con un talento, esa solicitud llega a esta sección. El admin es quien mueve el proceso de etapa en etapa: primero aprueba la solicitud, luego marca si se realizó contacto, si hubo entrevista, si el talento fue seleccionado y finalmente si fue contratado. También puede agregar notas internas a cada proceso y rechazar solicitudes. Además, puede generar un reporte en PDF con todos los procesos.

**Técnico:**

**Controlador:** `Admin\SolicitudesController`

- `index(Request)`: carga todas las `Interacciones` con `with(['talento.user', 'datosEmpresa.user'])`, paginadas (5 por página), ordenadas por `latest()`. Acepta parámetro `buscar` que filtra por nombre de empresa. Calcula totales globales por estado.
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

**En palabras simples:**
Sección reservada para futuras opciones de configuración general de la plataforma. Actualmente es una página informativa sin funcionalidad activa.

**Técnico:**

Vista estática `admin/configuracion.blade.php`. Sin lógica de controlador, retornada directamente desde la ruta.

---

## 7. Panel de talento

**En palabras simples:**
El panel de talento es el espacio personal de cada persona que busca trabajo. Desde aquí puede completar y actualizar su perfil profesional, subir sus documentos, ver en qué procesos de selección está participando y conocer el estado de cada uno.

Rutas protegidas con `['auth', 'role:talento']`. Layout: `x-talento-layout` → `layouts/talento.blade.php`.

### 7.1 Dashboard (`talento/dashboard`)

**En palabras simples:**
La pantalla de inicio del talento. Muestra un resumen rápido: en cuántos procesos está participando, cuántos están en etapa de entrevista o selección, y qué documentos tiene subidos. Es la primera pantalla que ve al iniciar sesión.

**Técnico:**

**Controlador:** `Talento\DashboardController@index`

- Busca el `Talento` asociado al usuario autenticado con `Talento::where('user_id', Auth::id())->first()` (no falla si no existe aún).
- Carga las últimas 5 interacciones con `with('datosEmpresa.user')`.
- Calcula totales por estado: `contactado`, `entrevista`, `seleccionado`, `rechazado`.
- Carga documentos del talento desde `TalentoArchivo`.

### 7.2 Perfil (`talento/perfil`)

**En palabras simples:**
Aquí el talento puede ver y editar toda su información personal y profesional: nombre, correo, edad, género, teléfono, dirección, resumen profesional, preferencias de trabajo (modalidad, jornada, rango de renta) y si está acogido a la Ley 21.015 de inclusión laboral. El formulario de edición se abre en una ventana emergente (modal) sobre la misma página. También puede gestionar sus competencias técnicas e idiomas desde esta misma sección.

**Técnico:**

**Controlador:** `Talento\PerfilController`

- `index()`: carga `Talento`, separa competencias en predefinidas (`LISTA_COMPETENCIAS`) y "otras" usando `array_intersect` / `array_diff`. Carga idiomas y listas de referencia de `IdiomasController::LISTA_IDIOMAS` y `IdiomasController::NIVELES`.
- `update(Request)`: valida y actualiza `User` (nombre, email) y `Talento` (edad, teléfono, dirección, género, resumen, renta_desde, renta_hasta, condicion_jornada, condicion_modalidad, discapacidad). El teléfono se formatea como `+569XXXXXXXX` con `preg_replace`. `renta_desde` y `renta_hasta` son inputs numéricos enteros positivos (`nullable|numeric|min:0`).

El formulario de edición está en un modal (`#modalPerfil`) dentro de la misma vista. Si hay errores de validación, el modal se abre automáticamente vía JS (`@if($errors->any()) openModal(); @endif`).

**Lista de competencias predefinidas (`LISTA_COMPETENCIAS`):**
Excel, Word, Power BI, SAP, ERP, CRM, Trabajo en Equipo, Liderazgo, Comunicación.

### 7.3 Competencias técnicas

**En palabras simples:**
El talento puede seleccionar sus habilidades técnicas de una lista predefinida (como Excel, SAP, Power BI, etc.) y también agregar habilidades personalizadas escribiéndolas a mano. Cada vez que guarda, la lista se reemplaza completamente con la nueva selección.

**Técnico:**

**Controlador:** `Talento\CompetenciasController@store`

- Elimina todas las competencias existentes del talento con `CompetenciasTecnicas::where('talento_id', ...)->delete()`.
- Combina las competencias del checkbox (`competencias[]`) con las "otras" (campo de texto libre separado por comas).
- Recrea todos los registros en `competencias_tecnicas`.
- Ruta: `POST /talento/competencias`

### 7.4 Idiomas

**En palabras simples:**
El talento puede indicar qué idiomas habla y a qué nivel (Básico, Intermedio, Avanzado o Nativo). Puede agregar varios idiomas y eliminarlos. Al guardar, la lista se reemplaza completamente.

**Técnico:**

**Controlador:** `Talento\IdiomasController@store`

- Elimina todos los idiomas existentes con `TalentoIdioma::where('talento_id', ...)->delete()`.
- Recrea los idiomas del array `idiomas[n][nombre]` / `idiomas[n][nivel]`.
- Lista predefinida: Español, Inglés, Portugués, Francés, Alemán, Italiano, Chino Mandarín, Otro.
- Niveles: Básico, Intermedio, Avanzado, Nativo.
- Ruta: `POST /talento/idiomas`

### 7.5 Experiencia laboral (`talento/experiencia`)

**En palabras simples:**
El talento puede registrar todos sus trabajos anteriores: empresa, cargo, fechas de inicio y término, funciones que realizaba y datos de una referencia laboral (nombre, teléfono, correo y cargo). Si todavía trabaja en un lugar, puede marcar la opción "actualidad" para dejar la fecha de término en blanco. Puede editar o eliminar cada experiencia.

**Técnico:**

**Controlador:** `Talento\AntecedentesLaboralesController`

- `index()`: lista experiencias laborales del talento ordenadas por `latest()`.
- `store(Request)`: valida institución, cargo, fechas, funciones y datos de referencia. Si se marca `actualidad`, `egreso = null`. El teléfono de referencia se formatea con `+569`.
- `update($id)`: misma validación, actualiza registro existente.
- `destroy($id)`: elimina registro.
- Rutas: `GET /talento/experiencia`, `POST`, `PUT /talento/experiencia/{id}`, `DELETE /talento/experiencia/{id}`

### 7.6 Educación y perfeccionamiento (`talento/educacion`)

**En palabras simples:**
El talento puede registrar sus estudios formales (carreras universitarias, técnicas, etc.) y también cursos de perfeccionamiento (diplomados, talleres, certificaciones). Para los estudios en curso, puede marcar "actualidad" y dejar la fecha de término vacía. Puede editar o eliminar cada registro independientemente.

**Técnico:**

**Controlador:** `Talento\AntecedentesEducacionalesController`

- `index()`: carga `AntecedentesEducacionales` y `Perfeccionamiento` del talento.
- `store(Request)`: según el campo `categoria` del formulario (`educacion` o `perfeccionamiento`), crea en la tabla correspondiente. Para educación con `actualidad` marcado, `egreso = null` y `completo = 0`.
- `updateEducacion($id)`: actualiza antecedente educacional.
- `updateCurso($id)`: actualiza perfeccionamiento.
- `destroy($id)`: elimina antecedente educacional.
- `destroyCurso($id)`: elimina perfeccionamiento.
- Rutas: `GET talento/educacion`, `POST /talento/educacion`, `PUT /talento/educacion/{id}`, `PUT /talento/educacion/curso/{id}`, `DELETE /talento/educacion/{id}`, `DELETE /talento/educacion/curso/{id}`

### 7.7 Documentos (`talento/documentos`)

**En palabras simples:**
El talento puede subir tres tipos de documentos: su Curriculum Vitae, un Certificado de Residencia y (opcionalmente) el Certificado de Discapacidad para la Ley 21.015. Cada documento pasa por revisión del administrador, quien puede aprobarlo o rechazarlo con un motivo. Solo puede haber un documento activo por tipo: si se sube uno nuevo, reemplaza automáticamente al anterior. Al subir un documento, la cuenta vuelve a estado "pendiente" para que el administrador lo revise.

**Técnico:**

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

**En palabras simples:**
El talento puede ver en qué procesos de selección está participando y en qué etapa va cada uno. Las etapas van desde "Pendiente" (recién solicitado) hasta "Contratado". También ve un resumen con cuántos procesos tiene en cada etapa.

**Técnico:**

**Controlador:** `Talento\ProcesosController@index`

- Carga todas las `Interacciones` donde `talento_id` = talento autenticado.
- Pagina (10 por página) con `with('datosEmpresa.user')`.
- Calcula totales por los 6 estados: `pendiente`, `contactado`, `entrevista`, `seleccionado`, `contratado`, `rechazado`.
- Vista muestra el estado de cada proceso usando los accessors `estado_texto` y `estado_color` del modelo `Interacciones`.

---

## 8. Panel de empresa

**En palabras simples:**
El panel de empresa es el espacio desde donde las empresas pueden buscar candidatos, solicitar contacto con ellos, hacer seguimiento de sus procesos de selección y gestionar los usuarios de su equipo que tienen acceso a la plataforma.

Rutas protegidas con `['auth', 'role:empresa']`. Layout: `x-empresa-layout` → `layouts/empresa.blade.php`.

### 8.1 Dashboard (`empresa/dashboard`)

**En palabras simples:**
La pantalla de inicio de la empresa. Muestra cuántos talentos ha solicitado, cuántos están en proceso activo (contactados o en entrevista), cuántos han sido seleccionados y cuántos usuarios de la empresa tienen acceso a la plataforma. También muestra los últimos 5 procesos recientes.

**Técnico:**

**Controlador:** `Empresa\DashboardController@index`

- Usa `firstOrCreate` para asegurar que siempre exista un registro en `datos_empresa` para el usuario autenticado.
- Calcula totales: `solicitados` (total interacciones), `activos` (contactado + entrevista), `seleccionados`, `usuarios` (activos no desactivados).
- Carga los últimos 5 procesos con `with(['talento.antecedentesEducacionales'])`.

### 8.2 Perfil de empresa (`empresa/perfil`)

**En palabras simples:**
La empresa puede actualizar su información institucional: nombre, RUT, rubro, tipo de empresa, presentación corporativa, beneficios que ofrece a sus empleados y logo. También puede cambiar su contraseña, pero en este caso debe ingresar la contraseña actual para confirmar el cambio.

**Técnico:**

**Controlador:** `Empresa\PerfilController`

- `index()`: usa `firstOrCreate` para garantizar existencia del registro. Calcula totales de procesos y usuarios.
- `update(Request)`: valida y actualiza `DatosEmpresa` (rut, rubro, tipo, presentación, beneficios). Soporta subida de logo (`nullable|image|max:2048`): si ya existe uno, lo elimina del storage antes de guardar el nuevo en `logos/empresas/`. Actualiza `user.name`.
- `password(Request)`: valida `current_password` (regla nativa de Laravel), hashea y actualiza.
- Rutas: `GET empresa/perfil`, `PUT empresa/perfil`, `PUT empresa/perfil/password`

### 8.3 Vitrina de talentos (`empresa/talentos`)

**En palabras simples:**
Es el catálogo de candidatos disponibles. La empresa puede buscar talentos usando filtros como carrera, competencias técnicas, idioma, modalidad de trabajo, jornada, rango de renta y si el candidato está acogido a la Ley 21.015. Los perfiles son anónimos: no se muestra el nombre real del talento, solo un número identificador (ej: "Talento #0042"), para proteger la privacidad hasta que el administrador apruebe el contacto. La empresa puede seleccionar varios talentos a la vez y enviar una solicitud de contacto al equipo de ProviEmplea.

**Técnico:**

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

**En palabras simples:**
Aquí la empresa puede ver todos los talentos con los que está en proceso de selección y en qué etapa va cada uno. Puede filtrar la lista por etapa (por ejemplo, ver solo los que están en entrevista) usando un selector en la parte superior. Las tarjetas de resumen muestran cuántos procesos hay en cada etapa. La paginación recuerda el filtro activo al pasar de página.

**Técnico:**

**Controlador:** `Empresa\ProcesosController@index`

- Carga `Interacciones` de la empresa con `with(['talento.competenciasTecnicas', 'talento.antecedentesEducacionales'])`.
- Acepta parámetro GET `estado` para filtrar por etapa específica (`pendiente`, `contactado`, `entrevista`, `seleccionado`, `rechazado`, `contratado`).
- Paginación: 10 por página con `withQueryString()` para preservar el filtro activo.
- Calcula totales por 5 estados (sin `contratado`) para las tarjetas de resumen.
- Vista incluye un selector de filtro por etapa con opción "Todas" y enlace "Limpiar" condicional.

### 8.5 Usuarios asociados (`empresa/usuarios`)

**En palabras simples:**
Una empresa puede tener varios miembros del equipo con acceso a la plataforma (por ejemplo, el área de RRHH, un reclutador o un supervisor). Desde aquí se pueden crear nuevas cuentas para esos usuarios, asignarles un cargo y gestionar su acceso. Eliminar a un usuario no borra su cuenta, solo la desactiva para que no pueda ingresar.

**Técnico:**

**Controlador:** `Empresa\UsuariosController`

- `index()`: lista `UsuariosEmpresa` de la empresa autenticada con `with('user')`, excluyendo usuarios con `estado = 'desactivado'`.
- `store(Request)`: valida nombre, email único, teléfono, cargo (RRHH, Reclutador, Supervisor, Jefe de Area) y password. Crea `User` con `rol = 'empresa'`, `estado = 'activo'`, `email_verified_at = now()`, `remember_token`. Crea `UsuariosEmpresa` vinculado.
- `destroy($id)`: **no elimina físicamente**; actualiza `user.estado = 'desactivado'` (eliminación lógica).
- Rutas: `GET empresa/usuarios`, `POST empresa/usuarios`, `DELETE empresa/usuarios/{id}`

### 8.6 Documentos de empresa (`empresa/documentos`)

**En palabras simples:**
La empresa puede subir documentos institucionales (contrato, acreditaciones, RUT, etc.) que el administrador puede revisar y validar. Cada documento puede eliminarse cuando ya no sea necesario. Al subir un documento nuevo, la cuenta vuelve a estado "pendiente" para que el admin lo revise.

**Técnico:**

**Controlador:** `Empresa\DocumentosController`

Tipos permitidos (definidos en la constante `TIPOS_PERMITIDOS`): `Escritura Empresa`, `RUT Empresa`, `Certificado SII`, `Contrato`, `Acreditación`, `Otro`.

- `index()`: carga `ArchivoEmpresa` de la empresa autenticada. Pasa `$tipos` al view.
- `store(Request)`: valida archivo (pdf, doc, docx, png, jpg, jpeg; máx. 5MB) y `tipo_archivo` contra la lista `TIPOS_PERMITIDOS`. Almacena en `empresa/documentos/` vía `Storage::disk('public')`. Crea registro en `archivo_empresa`. Actualiza `user.estado = 'pendiente'` para que el admin lo revise.
- `destroy(int $id)`: elimina archivo físico del storage y el registro de la BD.
- Rutas: `GET empresa/documentos`, `POST empresa/documentos`, `DELETE empresa/documentos/{id}`

---

## 9. Flujo completo de una solicitud de talento

**En palabras simples:**
Así funciona el proceso completo desde que una empresa encuentra un candidato hasta que lo contrata:

1. La empresa navega por la vitrina, filtra candidatos y selecciona los que le interesan.
2. Envía una solicitud de contacto al equipo de ProviEmplea.
3. El administrador revisa la solicitud y la aprueba, lo que pone el proceso en marcha.
4. El admin va avanzando el estado del proceso según lo que ocurra: se contacta al talento, se agenda una entrevista, se lo selecciona y finalmente se lo marca como contratado.
5. Una vez que un talento está seleccionado o contratado, desaparece de la vitrina para que otras empresas no lo vean.
6. El talento puede ver en su propio panel en qué etapa está cada proceso.

**Técnico:**

1. **Empresa** accede a `empresa/talentos`, aplica filtros y selecciona talentos mediante checkboxes.
2. Envía formulario POST a `empresa/talentos/solicitar` → se crean registros en `interacciones` con `estado = 'pendiente'`.
3. **Admin** accede a `admin/solicitudes`, ve las interacciones pendientes.
4. Admin puede avanzar el estado: `pendiente` → `contactado` → `entrevista` → `seleccionado` → `contratado` (o `rechazado` en cualquier punto).
5. El campo `interacciones.estado` es la única fuente de verdad del estado del proceso; no se modifica el `User` del talento.
6. Cuando `estado = 'contratado'` o `estado = 'seleccionado'`, el talento **desaparece de la vitrina** de empresa por el `whereDoesntHave` aplicado en `Empresa\TalentosController`.
7. **Talento** puede ver el estado de sus procesos en `talento/procesos` usando los accessors `estado_texto` y `estado_color` de `Interacciones`.

---

## 10. Convenciones y decisiones técnicas

**En palabras simples:**
Esta sección describe decisiones de diseño importantes que afectan cómo funciona el sistema internamente y por qué se tomaron así:

- **Las cuentas nunca se borran:** cuando se "elimina" un usuario, en realidad solo se marca como desactivado. Esto permite recuperar la cuenta y mantener el historial.
- **Los nuevos usuarios quedan verificados automáticamente:** cuando el admin o la empresa crea una cuenta nueva, no necesita confirmar el correo; queda activa de inmediato.
- **El teléfono siempre incluye el prefijo +569:** el sistema lo agrega automáticamente al guardar, el usuario solo escribe los 8 dígitos.
- **Las competencias e idiomas se guardan de una sola vez:** cada vez que se guarda, se borra todo lo anterior y se escribe la nueva lista. Esto evita inconsistencias.
- **Un solo documento por tipo:** si el talento sube un CV nuevo, el anterior se elimina automáticamente del servidor.
- **La Ley 21.015 se sincroniza con el documento:** si el administrador aprueba el certificado de discapacidad, el perfil del talento se marca automáticamente. Si se rechaza o elimina, se desmarca.
- **El perfil del talento es anónimo en la vitrina:** las empresas solo ven un número identificador, nunca el nombre real del candidato.
- **Los filtros se recuerdan al cambiar de página:** al paginar los resultados filtrados, los filtros activos no se pierden.

**Técnico:**

- **Eliminación lógica:** nunca se borra un usuario de la BD. `estado = 'desactivado'` actúa como soft delete. Todos los listados excluyen desactivados con `where('estado', '!=', 'desactivado')` o `whereHas('user', ...)`.
- **Conteos de estado optimizados:** los dashboards y paneles de procesos usan una sola consulta con `selectRaw('estado, COUNT(*) as total')->groupBy('estado')->pluck('total', 'estado')` en lugar de múltiples queries separadas por estado.
- **Autorización de recursos del talento:** `AntecedentesLaboralesController` y `PerfeccionamientoController` verifican que el ID del registro pertenezca al talento autenticado antes de editar o eliminar, usando `where('talento_id', $talento->id)` en lugar de solo `findOrFail`.
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
