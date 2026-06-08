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
- 2026-06-08: Se corrigió `database/factories/ArchivoEmpresaFactory.php` para incluir `nombre_archivo` en las semillas de `archivo_empresa`.
- 2026-06-08: Se ejecutó `php artisan migrate:fresh --seed` para recrear y poblar la base de datos correctamente.

## Nota

A partir de ahora, cualquier cambio o adición solicitado debe registrarse en este archivo.
