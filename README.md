# ProviEmplea

Plataforma web de gestión laboral y vinculación de talentos con empresas de la comuna de Providencia. Permite a la municipalidad administrar procesos de selección, validar perfiles de candidatos y conectar empresas con trabajadores.

## Roles

| Rol | Descripción |
|-----|-------------|
| **Admin** | Panel de administración completo: gestión de talentos, empresas, validaciones, procesos de selección y configuración. |
| **Talento** | Registro de perfil profesional, documentos, experiencia, educación, idiomas y seguimiento de postulaciones. |
| **Empresa** | Publicación de búsquedas, revisión de vitrina de talentos, gestión de usuarios internos y documentos. |

## Stack tecnológico

- **Backend:** Laravel 12 · PHP 8.3+
- **Frontend:** Tailwind CSS · Alpine.js
- **Base de datos:** MySQL 8.4
- **PDF:** barryvdh/laravel-dompdf
- **Excel:** maatwebsite/excel
- **Deploy:** Laravel Cloud
- **Dev local:** Laragon

## Requisitos

- PHP >= 8.2
- Composer
- Node.js y npm
- MySQL

## Instalación local

```bash
git clone https://github.com/J9brouu/ProviEmplea.git
cd ProviEmplea

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configura la base de datos en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proviemplea
DB_USERNAME=root
DB_PASSWORD=
```

Configura el correo en `.env` (Gmail con app password):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_SCHEME=smtps
MAIL_USERNAME=tu@gmail.com
MAIL_PASSWORD="xxxx xxxx xxxx xxxx"
MAIL_FROM_ADDRESS=tu@gmail.com
MAIL_FROM_NAME=ProviEmplea
```

Ejecuta las migraciones y levanta el servidor:

```bash
php artisan migrate
npm run dev
php artisan serve
```

## Despliegue en Laravel Cloud

Variables de entorno requeridas en el dashboard (Settings → Environment):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_SCHEME=smtps
MAIL_USERNAME=tu@gmail.com
MAIL_PASSWORD="xxxx xxxx xxxx xxxx"
MAIL_FROM_ADDRESS=tu@gmail.com
MAIL_FROM_NAME=ProviEmplea
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
```

## Estructura de carpetas relevante

```
app/Http/Controllers/
├── Admin/          # Dashboard, talentos, empresas, validaciones, procesos, configuración
├── Talento/        # Perfil, educación, experiencia, documentos, CV, procesos
├── Empresa/        # Perfil, talentos, procesos, usuarios, documentos
└── Auth/           # Registro por rol, verificación de correo

resources/views/
├── admin/
├── talento/
├── empresa/
├── auth/
└── layouts/        # admin.blade.php, talento.blade.php, empresa.blade.php
```

## Licencia

Proyecto desarrollado para la Municipalidad de Providencia. Todos los derechos reservados.
