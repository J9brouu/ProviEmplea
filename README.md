# ProviEmplea

Plataforma web de intermediación laboral para la **Municipalidad de Providencia**. Conecta talentos de la comuna con empresas mediante un sistema de **CV ciego**: las empresas no ven la identidad de los candidatos hasta que el administrador aprueba el contacto.

---

## Descripción general

ProviEmplea tiene tres tipos de usuarios con paneles independientes:

| Rol | Descripción |
|-----|-------------|
| **Admin** | Gestiona y valida toda la plataforma. Aprueba/rechaza usuarios y documentos, avanza los procesos de selección. |
| **Talento** | Persona que busca trabajo. Completa su perfil profesional, sube documentos y sigue sus procesos. |
| **Empresa** | Busca candidatos desde la vitrina anónima y solicita contacto al equipo de ProviEmplea. |

---

## Stack tecnológico

- **Framework:** Laravel 11
- **Frontend:** Blade + Tailwind CSS (compilado con Vite)
- **Base de datos:** MySQL
- **Almacenamiento de archivos:** disco `public` (almacenamiento en servidor — temporal para proyecto de título)
- **PDF:** `barryvdh/laravel-dompdf`
- **Deploy objetivo:** Laravel Cloud

---

## Requisitos

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+

---

## Instalación local

```bash
# 1. Clonar el repositorio
git clone <url-del-repo>
cd ProviEmplea

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS
npm install

# 4. Configurar entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar la base de datos en .env
#    DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Crear enlace simbólico para storage
php artisan storage:link

# 8. Compilar assets
npm run dev
```

---

## Credenciales de prueba (seeder)

| Rol | Email | Contraseña |
|-----|-------|------------|
| Admin | admin@proviemplea.cl | password |
| Talento | (generado por seeder) | password |
| Empresa | (generado por seeder) | password |

---

## Estructura de directorios relevante

```
app/
  Http/
    Controllers/
      Admin/       → Panel de administración
      Talento/     → Panel del talento
      Empresa/     → Panel de empresa
      Auth/        → Registro y autenticación
    Middleware/
      RoleMiddleware.php   → Control de acceso por rol
resources/views/
  admin/           → Vistas del panel admin
  talento/         → Vistas del panel talento
  empresa/         → Vistas del panel empresa
  layouts/         → Layouts base por rol
  components/      → Componentes reutilizables (landing, admin, etc.)
database/
  migrations/      → Estructura de base de datos
  seeders/         → Datos de prueba
  factories/       → Fábricas para testing
```

---

## Documentación del proyecto

- [FUNCIONALIDADES.md](FUNCIONALIDADES.md) — Descripción detallada de todas las funcionalidades (técnico + lenguaje simple).
- [cambios.md](cambios.md) — Historial de cambios y correcciones.

---

## Notas de despliegue (Laravel Cloud)

- El almacenamiento de archivos usa el disco `public` local. Para producción en Laravel Cloud se debe configurar un disco persistente o migrar a almacenamiento externo.
- Asegurarse de ejecutar `php artisan migrate` en el entorno de Cloud (sin `--seed` en producción).
- Configurar `APP_ENV=production`, `APP_DEBUG=false` y `APP_KEY` en las variables de entorno del proyecto Cloud.
- El seeder crea datos de prueba únicamente para entornos de desarrollo.

---

## Licencia

Proyecto de título — Municipalidad de Providencia. Todos los derechos reservados.
