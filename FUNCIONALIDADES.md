# Funcionalidades del proyecto ProviEmplea

Este documento describe todas las funcionalidades del proyecto, incluyendo los distintos paneles, subpaneles y cómo funcionan a nivel de código.

## Índice

- 1. Arquitectura general
- 2. Rutas principales
  - 2.1 Landing y registro
  - 2.2 Autenticación y perfil global
- 3. Panel de administrador
  - 3.1 Dashboard principal
  - 3.2 Administradores
  - 3.3 Perfil del admin
  - 3.4 Empresas
  - 3.5 Talentos
  - 3.6 Validaciones
  - 3.7 Solicitudes
  - 3.8 Vitrina
  - 3.9 Configuración
- 4. Panel de talento
  - 4.1 Dashboard de talento
  - 4.2 Perfil de talento
  - 4.3 Competencias técnicas
  - 4.4 Idiomas
  - 4.5 Experiencia laboral y educación
  - 4.6 Documentos
  - 4.7 Procesos
- 5. Panel de empresa
  - 5.1 Dashboard de empresa
  - 5.2 Perfil de empresa
  - 5.3 Talentos
  - 5.4 Procesos
  - 5.5 Usuarios de empresa
  - 5.6 Documentos de empresa
- 6. Modelos y relaciones clave
- 7. Valores y convenciones
- 8. Experiencia de usuario y UI
- 9. Flujo técnico completo de una petición
- 10. Notas técnicas importantes

## 1. Arquitectura general

- Laravel 11 (o similar) con rutas definidas en `routes/web.php` y `routes/auth.php`.
- Autenticación básica con `routes/auth.php` para login, registro, recuperación de contraseña y verificación de email.
- Paneles con middleware `auth` y `role:<rol>` para restringir acceso según rol de usuario (`admin`, `talento`, `empresa`).
- Blade como motor de plantillas, con componentes reusable para landing, admin, empresa y talento.
- Uso de `User.estado` para manejar estado lógico de cuentas y `desactivado` como estado de eliminación suave.

## 2. Rutas principales

### 2.1 Landing y registro

- `/` - landing page (welcome) con componentes de landing.
- `/registro/talento` - formulario de registro de talento.
- `/registro/talento` (POST) - guarda el talento.
- `/registro/empresa` - formulario de registro de empresa.
- `/registro/empresa` (POST) - guarda la empresa.

### 2.2 Autenticación y perfil global

- `/login` - login de usuario.
- `/register` - registro estándar (Laravel Breeze/Jetstream puro).
- `/profile` - editar perfil del usuario autenticado.
- `/profile` (PATCH) - actualizar perfil.
- `/profile` (DELETE) - eliminar cuenta.
- `/dashboard` - redirige según rol: admin, talento o empresa.

## 3. Panel de administrador

### 3.1 Dashboard principal (`admin.dashboard`)

Funcionalidades:
- Estadísticas generales: talentos, empresas, usuarios, postulaciones.
- Resumen de empresas recientes y talentos recientes.
- Listado de administradores del sistema con estado y acciones.
- Sección de usuarios desactivados con botón para reactivar.

Cómo funciona:
- `App\Http\Controllers\Admin\DashboardController@index` obtiene métricas con `count()` y consultas Eloquent.
- Usa relaciones `with('user')` y `whereHas('user', fn($q) => $q->where('estado', '!=', 'desactivado'))` para excluir usuarios lógicos desactivados.
- Despliega la vista `resources/views/admin/dashboard.blade.php`.

### 3.2 Administradores (`admin.admins`)

Funcionalidades:
- Registro de nuevos administradores.
- Desactivar administradores.
- Reactivar administradores.

Cómo funciona:
- `App\Http\Controllers\Admin\AdminUserController@store` valida con `App\Http\Requests\Admin\CreateAdminUserRequest`.
- Crea `User` con `rol = 'admin'`, `email_verified_at = now()` y `remember_token`.
- `deactivate($id)` actualiza `estado = 'desactivado'`.
- `reactivate($id)` actualiza `estado = 'activo'`.
- El botón de desactivar/reactivar en `resources/views/admin/dashboard.blade.php` envía formularios `PUT` a las rutas correspondientes.

### 3.3 Perfil del admin (`admin.perfil`)

Funcionalidades:
- Ver y editar datos personales.
- Cambiar contraseña.

Cómo funciona:
- `App\Http\Controllers\Admin\PerfilController` maneja `index`, `update` y `password`.
- Valida datos y actualiza el modelo `User`.

### 3.4 Empresas (`admin.empresas`)

Funcionalidades:
- Ver listado de empresas activas.
- Filtrar por nombre.
- Editar datos de empresa y estado.

Cómo funciona:
- `App\Http\Controllers\Admin\EmpresasController@index` busca empresas con `DatosEmpresa::with('user')` y filtro por `user.name`.
- `update($id)` valida campos y actualiza tanto `DatosEmpresa` como el usuario relacionado.
- La vista usa un select de `estado` que ahora incluye `desactivado`.

### 3.5 Talentos (`admin.talentos`)

Funcionalidades:
- Ver listado de talentos activos.
- Buscar talento por nombre, modalidad, jornada.
- Editar perfil de talento, estado y resumen.

Cómo funciona:
- `App\Http\Controllers\Admin\TalentosController@index` carga talentos con usuario activo y filtros de búsqueda.
- `update($id)` valida datos y actualiza `Talento` y `Talento->user`.
- También usa `whereHas('user', fn($q) => $q->where('estado', '!=', 'desactivado'))`.

### 3.6 Validaciones (`admin.validaciones`)

Funcionalidades:
- Validar talentos, archivos de talento, empresas y archivos de empresa.
- Acciones: aprobar / rechazar.

Cómo funciona:
- `App\Http\Controllers\Admin\ValidacionesController` contiene métodos como `aprobarTalento`, `rechazarTalento`, `aprobarArchivo`, `rechazarArchivo`, `aprobarEmpresa`, `rechazarEmpresa`, `aprobarArchivoEmpresa`, `rechazarArchivoEmpresa`.
- Estas acciones cambian estados de modelos específicos y persisten cambios.

### 3.7 Solicitudes (`admin.solicitudes`)

Funcionalidades:
- Revisar solicitudes de talento y empresas.
- Añadir notas.
- Aprobar, rechazar, contactar, agendar entrevista, marcar como seleccionado o contratar.
- Generar PDF de solicitudes.

Cómo funciona:
- `App\Http\Controllers\Admin\SolicitudesController` recibe `PUT` para varias acciones.
- Actualiza registros de `Interacciones` con nuevos estados.
- `pdf()` genera salida PDF, probablemente usando un paquete de PDF (no inspeccionado en este documento, pero está enlazado en rutas). 

### 3.8 Vitrina (`admin.vitrina`)

Funcionalidades:
- Ver talentos con filtros similares a la plataforma de empresa.
- Seleccionar talentos y enviarlos a una empresa.

Cómo funciona:
- `App\Http\Controllers\Admin\VitrinaController@index` construye consulta con filtros sobre `Talento` y obtiene empresas activas.
- `enviar(Request $request)` valida `talento_ids` y `datos_empresa_id`, crea `Interacciones` con estado `contactado`.

### 3.9 Configuración (`admin.configuracion`)

Funcionalidades:
- Vista estática de configuración administrativa.

Cómo funciona:
- Ruta simple que devuelve `view('admin.configuracion')`.

## 4. Panel de talento

### 4.1 Dashboard de talento (`talento.dashboard`)

Funcionalidades:
- Mostrar procesos recientes del talento.
- Mostrar totales por estado: contactado, entrevista, seleccionado, rechazado.
- Mostrar documentos cargados por el talento.

Cómo funciona:
- `App\Http\Controllers\Talento\DashboardController@index` consulta `Talento` por `user_id`.
- Usa `Interacciones::where('talento_id', $talento->id)->with('datosEmpresa.user')->latest()->take(5)->get()`.
- Calcula totales por estado con `count()`.
- Carga archivos desde `TalentoArchivo`.

### 4.2 Perfil de talento (`talento.perfil`)

Funcionalidades:
- Ver detalle del perfil de talento.
- Editar datos personales y condiciones laborales.
- Ver lista de competencias técnicas y de idiomas.

Cómo funciona:
- `App\Http\Controllers\Talento\PerfilController@index` carga talento y datos relacionados (`CompetenciasTecnicas`, `TalentoIdioma`).
- Usa listas estáticas como `LISTA_COMPETENCIAS` y `IdiomasController::LISTA_IDIOMAS`.
- `update(Request $request)` valida y actualiza tanto `User` como `Talento`.
- Formatea teléfono con regex y guarda `discapacidad` como booleano.

### 4.3 Competencias técnicas

Funcionalidades:
- Agregar nuevas competencias técnicas.
- Eliminar competencias existentes.

Cómo funciona:
- `App\Http\Controllers\Talento\CompetenciasController@store` crea `CompetenciasTecnicas`.
- `destroy($id)` elimina el registro.

### 4.4 Idiomas

Funcionalidades:
- Añadir idioma y nivel.

Cómo funciona:
- `App\Http\Controllers\Talento\IdiomasController@store` valida y crea `TalentoIdioma`.
- La vista de perfil usa la lista de idiomas y niveles de `IdiomasController`.

### 4.5 Experiencia laboral y educación

Funcionalidades:
- Ver y gestionar experiencia laboral.
- Ver y gestionar antecedentes educacionales.

Cómo funciona:
- `App\Http\Controllers\Talento\AntecedentesLaboralesController`, `AntecedentesEducacionalesController` exponen rutas `index`, `store`, `update`, `destroy`.
- Pueden existir métodos para actualizar cursos, etc.

### 4.6 Documentos (`talento.documentos`)

Funcionalidades:
- Subir documentos de talento.
- Eliminar documentos.

Cómo funciona:
- `App\Http\Controllers\Talento\DocumentosController@index` y `store` gestionan archivos.
- `destroy($id)` elimina registros y posiblemente el archivo asociado.

### 4.7 Procesos (`talento.procesos`)

Funcionalidades:
- Ver procesos y solicitudes en curso.

Cómo funciona:
- `App\Http\Controllers\Talento\ProcesosController@index` muestra todas las interacciones para el talento.

## 5. Panel de empresa

### 5.1 Dashboard de empresa (`empresa.dashboard`)

Funcionalidades:
- Muestra resúmenes e indicadores para la empresa.
- Generalmente similar al admin pero centrado en la empresa.

Cómo funciona:
- `App\Http\Controllers\Empresa\DashboardController@index` carga datos de empresa y usuarios asociados.

### 5.2 Perfil de empresa (`empresa.perfil`)

Funcionalidades:
- Ver y actualizar datos de la empresa.
- Cambiar contraseña.

Cómo funciona:
- `App\Http\Controllers\Empresa\PerfilController@index` muestra datos de la empresa.
- `update` y `password` actualizan `DatosEmpresa` y `User`.

### 5.3 Talentos (`empresa.talentos`)

Funcionalidades:
- Listar talentos activos disponibles.
- Filtrar por nivel educacional, carrera, modalidad, jornada, discapacidad, renta, competencia, idioma.
- Solicitar talentos para la empresa.

Cómo funciona:
- `App\Http\Controllers\Empresa\TalentosController@index` construye consultas con `whereHas` y `when`.
- Filtra `Talento` con estado de usuario `activo` y excluye talentos ya solicitados mediante `whereDoesntHave('interacciones', fn($q) => $q->whereIn('estado', ['seleccionado', 'contratado']))`.
- `solicitar(Request $request)` crea `Interacciones` para cada talento seleccionado, evitando duplicados.

### 5.4 Procesos (`empresa.procesos`)

Funcionalidades:
- Mostrar solicitudes e interacciones de la empresa.

Cómo funciona:
- `App\Http\Controllers\Empresa\ProcesosController@index` consulta `Interacciones` por `datos_empresa_id`.

### 5.5 Usuarios de empresa (`empresa.usuarios`)

Funcionalidades:
- Listar usuarios de la empresa.
- Crear nuevos usuarios para la empresa.
- Desactivar usuarios.

Cómo funciona:
- `App\Http\Controllers\Empresa\UsuariosController@index` busca usuarios relacionados con la empresa usando `UsuariosEmpresa` y `whereHas('user', fn($query) => $query->where('estado', '!=', 'desactivado'))`.
- `store(Request $request)` valida datos, crea un `User` con `rol = 'empresa'`, `estado = 'activo'`, y crea el registro `UsuariosEmpresa` asociado.
- `destroy($id)` actualiza `user.estado = 'desactivado'` en lugar de borrar.

### 5.6 Documentos de empresa (`empresa.documentos`)

Funcionalidades:
- Subir documentos asociados a la empresa.
- Eliminar documentos.

Cómo funciona:
- `App\Http\Controllers\Empresa\DocumentosController` guarda y elimina registros en la tabla de documentos de empresa.

## 6. Modelos y relaciones clave

### 6.1 `App\Models\User`

- Contiene campo `rol` para distinguir `admin`, `talento`, `empresa`.
- Contiene campo `estado` para `activo`, `pendiente`, `desactivado`, `bloqueado`, `rechazado`.
- Define scopes `notDesactivado` y `desactivados` para filtrar fácilmente por estado.

### 6.2 `App\Models\Talento`

- Relación `user()` con `User`.
- Relación con habilidades, idiomas, antecedentes y archivos.

### 6.3 `App\Models\DatosEmpresa`

- Relación `user()` con `User`.
- Relación con `UsuariosEmpresa`.

### 6.4 `App\Models\Interacciones`

- Registra la comunicación entre empresas y talentos.
- Incluye estados como `pendiente`, `contactado`, `entrevista`, `seleccionado`, `contratado`, `rechazado`.

## 7. Valores y convenciones

- `estado = desactivado` se utiliza como eliminación lógica en lugar de borrar registros.
- `remember_token` se genera al registrar usuarios para persistencia del login.
- `email_verified_at` se marca en ciertas creaciones para que el usuario quede verificado automáticamente.
- `whereHas('user', fn($q) => $q->where('estado', '!=', 'desactivado'))` se usa ampliamente para ocultar cuentas inactivas.
- Los formularios `PUT` se envían usando `@method('PUT')` en Blade.

## 8. Experiencia de usuario y UI

- Uso de componentes Blade para landing y paneles.
- Títulos dinámicos en la pestaña del navegador basados en rutas y `APP_NAME=ProviEmplea`.
- favicon en `public/favicon.svg` incluido en el `<head>` de las plantillas.
- Diseño consistente con tarjetas redondeadas `rounded-2xl`, colores y botones de acción.

## 9. Flujo técnico completo de una petición

1. El usuario accede a una ruta protegida por `auth` y `role:<rol>`.
2. Laravel resuelve la ruta en `routes/web.php` y ejecuta el método del controlador.
3. El controlador consulta modelos Eloquent y relaciones, aplica filtros y validaciones.
4. Los datos se pasan a la vista Blade.
5. El navegador renderiza HTML con componentes y formularios.
6. Si el usuario envía un formulario, el controlador valida con `$request->validate()` o `FormRequest`.
7. El controlador actualiza modelos y redirige con mensajes de sesión `with('success', ...)`.

## 10. Notas técnicas importantes

- No se utiliza borrado físico para usuarios activos: en su lugar, se actualiza `estado = 'desactivado'`.
- Las búsquedas en listas usan `whereHas` sobre relaciones para filtrar por campos de usuario.
- El panel de empresa evita mostrar talentos ya solicitados con `whereDoesntHave('interacciones', ...)`.
- El administrador puede enviar talentos a empresas desde la vitrina usando `Interacciones`.

---

Este documento cubre las funcionalidades y la lógica técnica principal del proyecto ProviEmplea. Si deseas, puedo expandirlo con diagramas de rutas o tablas de relaciones de modelos.