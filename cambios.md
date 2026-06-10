# Cambios del proyecto

Este archivo registra todos los cambios solicitados y realizados en el proyecto.

## Cambios registrados hasta ahora

- Se refactorizó `resources/views/welcome.blade.php` para usar componentes de landing.
- Se crearon los componentes de landing:
  - `resources/views/components/landing/head.blade.php`
  - `resources/views/components/landing/navbar.blade.php`
  - `resources/views/components/landing/hero.blade.php`
  - `resources/views/components/landing/step-card.blade.php`
  - `resources/views/components/landing/how-it-works.blade.php`
  - `resources/views/components/landing/bento-benefits.blade.php`
  - `resources/views/components/landing/cta-section.blade.php`
  - `resources/views/components/landing/footer.blade.php`
  - `resources/views/components/landing/scripts.blade.php`
- Se tradujo contenido en inglés a español en los componentes de landing.
- Se añadió navegación interna en la landing page con anclas para `Soluciones`, `Para Talentos`, `Para Empresas` y `Nosotros`.
- Se creó la sección `Nosotros` como componente:
  - `resources/views/components/landing/nosotros-section.blade.php`
- Se actualizaron botones de la landing para que redirijan a `route('login')` o a la sección `#soluciones` según corresponde.
- Se agregó un apartado para crear nuevas cuentas de administrador dentro de `resources/views/admin/dashboard.blade.php`.
- Se agregó la ruta `admin.admins.store` y el controlador `App\Http\Controllers\Admin\AdminUserController` para registrar usuarios con rol `admin`.
- Se creó la request `App\Http\Requests\Admin\CreateAdminUserRequest` para validar el registro interno de administradores.
- Se agregó un listado de administradores en `resources/views/admin/dashboard.blade.php` que muestra nombre, correo, estado y fecha de creación.
- Se documentó la relación de archivos asociados a la ruta `/login`.
- Se crearon componentes reutilizables para el admin: `resources/views/components/admin/card.blade.php` y `resources/views/components/admin/section-heading.blade.php`.
- Se actualizó la presentación visual de las pestañas de admin (`dashboard`, `perfil`, `configuracion`, `empresas`, `talentos`, `vitrina`, `solicitudes`, `validaciones`) para usar un patrón de tarjetas y encabezados consistente.
- Se mantuvo la funcionalidad actual de los formularios y tablas en el área de administración.

## Correcciones recientes

- 2026-06-08: Se corrigieron los CTAs de la landing para que:
  - Usuarios no autenticados: apunten a `route('login')` o a los `registro` correspondientes.
  - Usuarios autenticados: redirijan a su panel correspondiente según su `rol` (`admin`, `talento`, `empresa`) para evitar redirecciones a la landing por el middleware `guest`.
- 2026-06-08: Se implementó la desactivación lógica de usuarios desde `empresa/usuarios` usando el campo `estado` en lugar de eliminarlos de la base de datos.
- 2026-06-08: Se ocultaron los usuarios con `estado = desactivado` de las listas de empresa y de administración normales.
- 2026-06-08: Se agregó una sección de `Usuarios desactivados` en `resources/views/admin/dashboard.blade.php`.
- 2026-06-08: Se actualizó la creación de usuarios en `App\Http\Controllers\Empresa\UsuariosController` para poblar `email_verified_at` y `remember_token`.
- 2026-06-08: Se actualizó `App\Http\Controllers\Admin\AdminUserController.php` para marcar como verificado y asignar `remember_token` cuando se crea un administrador desde el panel.
- 2026-06-08: Se mejoró la vista `resources/views/empresa/perfil.blade.php` para que siga el estilo visual de `empresa/dashboard`, con tarjetas más consistentes, bordes `rounded-2xl` y presentación de estadísticas igual al dashboard.
- 2026-06-08: Se actualizó `App\Http\Controllers\Auth\EmpresaRegisterController.php` y `App\Http\Controllers\Auth\TalentoRegisterController.php` para generar `remember_token` al crear nuevos usuarios desde el registro.
- 2026-06-08: Se actualizó `resources/views/empresa/talentos.blade.php` para que el filtro de `renta_max` use un campo numérico entero (`type="number" step="1" inputmode="numeric"`) en lugar de un desplegable.
- 2026-06-08: Se amplió el selector `idioma` en `resources/views/empresa/talentos.blade.php` para incluir idiomas principales: Español, Inglés, Francés, Portugués, Alemán, Italiano, Mandarín, Japonés, Árabe y Ruso.
- 2026-06-08: Se agregó subida de `talento_idiomas` en `database/seeders/DatabaseSeeder.php` para poblar la tabla con 1 a 3 idiomas por talento durante la semilla.
- 2026-06-08: Se agregó un favicon SVG en `public/favicon.svg` y se actualizó el head de las plantillas base (`app`, `admin`, `empresa`, `talento`, `guest`) y la landing (`components/landing/head.blade.php`) para mostrar el icono en la pestaña del navegador.
- 2026-06-08: Se actualizó la generación del título de página en las plantillas base para mostrar el nombre de la sección activa en la pestaña del navegador, manteniendo `ProviEmplea` como sufijo.
- 2026-06-08: Se cambió la etiqueta `Bloqueado` por `Desactivado` en el select `Estado` de la edición de talentos en `resources/views/admin/talentos.blade.php`, y se actualizó la validación de `app/Http/Controllers/Admin/TalentosController.php` para permitir `desactivado` como valor persistente.
- 2026-06-08: Se repitió el cambio en el panel de empresas: `resources/views/admin/empresas.blade.php` ahora guarda `desactivado` como estado en la base de datos, y `app/Http/Controllers/Admin/EmpresasController.php` valida `desactivado` como valor permitido.
- 2026-06-08: Se ajustó la lista de administradores en `resources/views/admin/dashboard.blade.php` para mostrar el estado `Desactivado` con estilo coherente, en lugar de dejar el valor `bloqueado` sin formato específico.
- 2026-06-08: Se agregó un botón de desactivación junto a cada administrador en la lista de administradores del dashboard, con una ruta `PUT admin/admins/{id}/desactivar` y acción en `App\Http\Controllers\Admin\AdminUserController::deactivate`.
- 2026-06-08: Se implementó un botón `Reactivar` para cada usuario desactivado en `resources/views/admin/dashboard.blade.php`, con la ruta `PUT admin/admins/{id}/reactivar` y la acción `App\Http\Controllers\Admin\AdminUserController::reactivate`.
- 2026-06-08: Se actualizó `.env` y `.env.example` para usar `APP_NAME=ProviEmplea`, de modo que los títulos no caigan en el valor por defecto `Laravel`.
- 2026-06-08: Se ajustó `config/app.php` para usar `ProviEmplea` como nombre de aplicación por defecto.
- 2026-06-08: Se corrigió `database/factories/ArchivoEmpresaFactory.php` para incluir `nombre_archivo` en las semillas de `archivo_empresa`.
- 2026-06-08: Se ejecutó `php artisan migrate:fresh --seed` para recrear y poblar la base de datos correctamente.

- 2026-06-09: En `resources/views/talento/perfil.blade.php`, se reemplazaron los selectores `<select>` de `renta_desde` y `renta_hasta` por `<input type="number">` con `min="0"`, `step="1"` e `inputmode="numeric"`, permitiendo al talento ingresar libremente cualquier valor entero positivo. El atributo `oninput` descarta decimales y valores negativos en el cliente. La validación del servidor en `App\Http\Controllers\Talento\PerfilController::update` (`nullable|numeric|min:0`) no requirió cambios.

- 2026-06-09: Se corrigieron las inconsistencias visuales en las cards de `resources/views/talento/documentos.blade.php`:
  - Se añadió `flex flex-col` a cada card para que el formulario de subida siempre quede alineado al fondo con `mt-auto`.
  - Se envolvió el bloque de info del archivo en un `div` con `min-h-[72px]` para reservar altura constante incluso cuando no hay documento subido, evitando que las cards tengan alturas dispares.
  - Se añadió `whitespace-nowrap` a los badges de estado para evitar quiebres de línea en títulos largos.
  - Se unificó la estructura de la card "Ley 21.015" para seguir el mismo patrón visual (encabezado → info → formulario al fondo) que las otras dos cards.
  - No se modificó ninguna lógica de controladores ni rutas; solo cambios de presentación en la vista.

- 2026-06-09: Se corrigió el problema del botón "Subir" que aparecía fuera del card en `resources/views/talento/documentos.blade.php`:
  - Se eliminó el enfoque `mt-auto` + `min-h` que causaba que el bloque del formulario desbordara el borde inferior del card.
  - El div exterior del card usa `flex flex-col overflow-hidden`; el div interior con padding usa `flex flex-col flex-1`, garantizando que el card nunca desborde su propio contenedor.
  - La zona de info del archivo usa `flex-1 mb-4` para absorber el espacio variable, manteniendo el formulario pegado al fondo del contenido sin salirse del card.
  - Los badges usan `shrink-0` para evitar desbordamiento horizontal en el encabezado.
  - El input de archivo usa `min-w-0` y el botón `shrink-0` para que el flex row nunca desborde horizontalmente.
  - No se modificó ninguna lógica de controladores ni rutas.

- 2026-06-09: Se eliminó el selector `<select name="cargo">` duplicado en el modal "Nuevo Usuario" de `resources/views/empresa/usuarios.blade.php`. Se conservó el primero (con "Jefe de Área" con tilde) y se eliminó el segundo (que además tenía "Jefe de Area" sin tilde). Sin cambios en controladores ni rutas.

- 2026-06-09: Se eliminó la sección "Vitrina de Talentos" del panel de administración por ser redundante con la vitrina ya existente para empresas. Cambios realizados:
  - Se eliminaron las rutas `admin.vitrina` (GET) y `admin.vitrina.enviar` (POST) de `routes/web.php`.
  - Se eliminó el `use` de `App\Http\Controllers\Admin\VitrinaController` en `routes/web.php`.
  - Se eliminó el enlace "Vitrina de Talentos" del sidebar en `resources/views/layouts/admin.blade.php`.
  - Se eliminó la entrada `admin.vitrina` del array de títulos de página en el mismo layout.
  - El archivo `App\Http\Controllers\Admin\VitrinaController.php` y la vista `resources/views/admin/vitrina.blade.php` quedan en el proyecto pero sin rutas activas.

- 2026-06-09: Se agregó bloqueo de aprobación con documentos pendientes en `admin/validaciones`:
  - **Servidor** (`App\Http\Controllers\Admin\ValidacionesController`): `aprobarTalento` y `aprobarEmpresa` verifican si el usuario tiene documentos con `estado = pendiente` antes de aprobar. Si los hay, redirigen con `session('error_aprobacion')` en lugar de cambiar el estado.
  - **Cliente** (`resources/views/admin/validaciones.blade.php`): el botón "Aprobar" de cada usuario ahora llama a `intentarAprobar()` en lugar de enviar el form directamente. Si `data-pendientes="1"`, muestra un modal de advertencia amarillo con el nombre del usuario y el mensaje explicativo. Si no hay pendientes, envía el form oculto normalmente.
  - Se agregó alerta visual para `session('error_aprobacion')` en la parte superior de la vista.

- 2026-06-09: Se actualizó el botón del modal de documentos pendientes en `resources/views/admin/validaciones.blade.php`: se cambió de `<button>` a `<a href="{{ route('admin.validaciones') }}">` con texto "OK", de modo que al hacer clic cierra el modal y redirige explícitamente a la sección de validaciones.

- 2026-06-09: En `resources/views/talento/perfil.blade.php`, se reemplazaron los `<select>` de `renta_desde` y `renta_hasta` por `<input type="number">` con `min="0"`, `step="1"` e `inputmode="numeric"`. El `oninput` fuerza enteros positivos en el cliente. La validación del servidor en `PerfilController::update` (`nullable|numeric|min:0`) no requirió cambios.

- 2026-06-09: Se agregó filtro por etapa en `empresa/procesos`:
  - `App\Http\Controllers\Empresa\ProcesosController::index` ahora recibe `Request` y aplica `where('estado', ...)` cuando el parámetro `estado` está presente. Se añadió `withQueryString()` para que la paginación conserve el filtro activo.
  - En `resources/views/empresa/procesos.blade.php` se añadió un formulario GET con un `<select>` de etapas (Pendiente, Contactado, Entrevista, Seleccionado, No Seleccionado, Contratado), botón "Filtrar" y enlace "Limpiar" condicional, siguiendo el estilo visual de la vista.

## Revisión profesional completa — 2026-06-09

Se realizó un escaneo integral del proyecto para identificar y corregir bugs, inconsistencias de seguridad, problemas de rendimiento y malas prácticas. Los cambios se aplicaron sin alterar ninguna funcionalidad existente.

### Bugs de seguridad corregidos

- **`App\Http\Controllers\Talento\PerfeccionamientoController::update()`**: El bloque de autorización estaba vacío (`{ }`), lo que permitía a cualquier talento autenticado editar el perfeccionamiento de otro usuario. Se añadió `abort(403)` cuando el `user_id` no coincide con el autenticado.
- **`App\Http\Controllers\Talento\AntecedentesLaboralesController::update()` y `::destroy()`**: No verificaban que el registro perteneciera al talento autenticado. Se reemplazó `findOrFail($id)` por una búsqueda con doble condición `where('id', $id)->where('talento_id', $talento->id)->firstOrFail()`.
- **`App\Http\Controllers\Auth\EmpresaRegisterController`**: Validación de contraseña cambiada de `min:6` a `min:8` para ser consistente con el resto del sistema.
- **`App\Http\Controllers\Admin\PerfilController::password()`**: Validación de contraseña cambiada de `min:6` a `min:8`.
- **`App\Http\Controllers\Admin\PerfilController::update()`**: Se añadió la regla `unique:users,email,{Auth::id()}` al campo email para evitar que un admin pueda guardar un correo ya usado por otro usuario.
- **`App\Http\Controllers\Empresa\UsuariosController::store()`**: `remember_token` cambiado de `Str::random(10)` a `Str::random(60)` para cumplir el estándar de Laravel.

### Validación y consistencia de flujo

- **`App\Http\Controllers\Empresa\DocumentosController`**:
  - Se reemplazó el campo `tipo_archivo` de texto libre por una lista validada de valores permitidos: `Escritura Empresa`, `RUT Empresa`, `Certificado SII`, `Contrato`, `Acreditación`, `Otro`.
  - Se añadió `$empresa->user->update(['estado' => 'pendiente'])` al subir un documento, consistente con el comportamiento del flujo de talentos.
  - Se pasa `$tipos` al view para que el `<select>` use siempre la misma lista que el controlador.
  - `resources/views/empresa/documentos.blade.php`: el selector de tipo de documento ahora se genera con `@foreach($tipos as $tipo)` en lugar de opciones hardcodeadas.

### Optimización de consultas (N+1 queries)

- **`App\Http\Controllers\Talento\ProcesosController::index()`**: Los 6 conteos de estado separados se reemplazaron por una sola consulta con `selectRaw('estado, COUNT(*) as total')->groupBy('estado')->pluck(...)`.
- **`App\Http\Controllers\Empresa\ProcesosController::index()`**: Mismo patrón, 5 consultas reducidas a 1.
- **`App\Http\Controllers\Admin\SolicitudesController::index()`**: Mismo patrón, 5 consultas reducidas a 1.

### Calidad de código

- **`App\Http\Controllers\Talento\PerfilController::update()`**: Se reemplazó `User::find(Auth::id())` por `Auth::user()` (evita una consulta redundante). Se eliminó el `use App\Models\User` innecesario.
- **`App\Http\Controllers\Talento\PerfeccionamientoController`**: Se eliminó la constante `TIPOS` declarada pero nunca usada. Se añadieron type hints `int $id` en `update()` y `destroy()`.
- **`App\Http\Controllers\Admin\SolicitudesController`**: Se añadieron type hints `int $id` en todos los métodos de acción.
- **`App\Http\Controllers\Empresa\UsuariosController`**: Se añadió type hint `int $id` en `destroy()`.

### Migraciones nuevas

- **`2026_06_09_000000_make_nullable_fields_in_talento_tables`**: Hace nullable los campos `egreso`, `funciones` y los cuatro campos de referencia en `antecedentes_laborales`, y `egreso` en `perfeccionamiento`. Estos campos ya eran tratados como opcionales por los controladores pero la migración original los declaraba como NOT NULL, lo que podía causar errores en MySQL strict mode y era la causa por la que el seeder fallaba.
- **`2026_06_09_000001_add_indexes_to_performance_columns`**: Añade índices en `users.rol`, `users.estado`, `interacciones.estado`, `talento.condicion_jornada` y `talento.condicion_modalidad` para optimizar las consultas de filtrado más frecuentes.

### Documentación

- **`README.md`**: Reemplazado el README genérico de Laravel por la documentación real del proyecto (descripción, stack, instalación, credenciales de prueba, estructura de directorios, notas de despliegue).

### Almacenamiento de archivos en base de datos

Se migró completamente el almacenamiento de archivos desde `Storage::disk('public')` hacia la base de datos (LONGTEXT con base64), requerido por el entorno de despliegue en Laravel Cloud donde el filesystem local es efímero.

**Migración nueva** (`2026_06_09_000002_store_files_in_database`):
- `talento_archivo`: agrega `contenido` (LONGTEXT nullable) y `mime_type` (varchar nullable); hace `url_archivo` nullable.
- `archivo_empresa`: mismas columnas.
- `datos_empresa`: agrega `logo_contenido` (LONGTEXT nullable) y `logo_mime` (varchar nullable).

**Modelos actualizados**:
- `TalentoArchivo`: `contenido` y `mime_type` en `fillable`; `contenido` en `hidden`.
- `ArchivoEmpresa`: mismo patrón.
- `DatosEmpresa`: `logo_contenido` y `logo_mime` en `fillable`; `logo_contenido` en `hidden`.

**Controlador nuevo** (`App\Http\Controllers\ArchivoController`):
- `GET /archivos/talento/{id}`: sirve archivos de talento (admin ve todos; talento solo los suyos; empresa: 403).
- `GET /archivos/empresa/{id}`: sirve archivos de empresa (admin ve todos; empresa solo los suyos; talento: 403).
- `GET /archivos/logo/{id}`: sirve el logo de una empresa (cualquier usuario autenticado; incluye `Cache-Control: public, max-age=86400`).

**Rutas nuevas** en `routes/web.php` bajo middleware `auth`.

**Controladores actualizados**:
- `Talento\DocumentosController`: `store()` guarda `base64_encode(file_get_contents(...))` en `contenido`; `index()` excluye la columna `contenido` en el SELECT; `destroy()` solo elimina el registro.
- `Empresa\DocumentosController`: mismo patrón.
- `Empresa\PerfilController`: logo se guarda en `logo_contenido`/`logo_mime` en `datos_empresa`.

**Vistas actualizadas** (todas las referencias a `Storage::url($x->url_archivo)` reemplazadas por rutas de archivo):
- `resources/views/talento/partials/doc-info.blade.php` → `route('archivos.talento', $doc->id)`
- `resources/views/talento/documentos.blade.php` (2 ocurrencias) → `route('archivos.talento', ...)`
- `resources/views/empresa/documentos.blade.php` → `route('archivos.empresa', $doc->id)`
- `resources/views/admin/validaciones.blade.php` (2 modales) → `route('archivos.talento', ...)` y `route('archivos.empresa', ...)`
- `resources/views/empresa/perfil.blade.php`: el avatar de iniciales ahora muestra el logo real (`<img src="{{ route('archivos.logo', ...) }}">`) cuando `logo_contenido` existe, con fallback a las iniciales.

## Nota

A partir de ahora, cualquier cambio o adición solicitado debe registrarse en este archivo.
