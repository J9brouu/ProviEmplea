# Instalación y Configuración

## Requisitos previos

| Herramienta | Versión mínima |
|-------------|----------------|
| PHP | 8.3 |
| Composer | 2.x |
| Node.js | 18.x |
| MySQL | 8.0 |
| Git | 2.x |

> El proyecto fue desarrollado usando **Laragon** como entorno local en Windows.

---

## Instalación paso a paso

### 1. Clonar el repositorio

```bash
git clone https://github.com/J9brouu/ProviEmplea.git
cd ProviEmplea
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias JavaScript

```bash
npm install
```

### 4. Configurar variables de entorno

```bash
cp .env.example .env
php artisan key:generate
```

Editar `.env` con los datos de la base de datos:

```env
APP_NAME=ProviEmplea
APP_URL=http://proviemplea.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proviemplea
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
```

### 5. Crear la base de datos

En MySQL crear la base de datos:

```sql
CREATE DATABASE proviemplea CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Ejecutar migraciones y seeders

```bash
php artisan migrate
php artisan db:seed
```

### 7. Crear enlace de almacenamiento

```bash
php artisan storage:link
```

### 8. Compilar assets

Para desarrollo:
```bash
npm run dev
```

Para producción:
```bash
npm run build
```

### 9. Iniciar el servidor

```bash
php artisan serve
```

O con Laragon, acceder a `http://proviemplea.test`.

---

## Credenciales iniciales (Seeder)

| Rol | Email | Contraseña |
|-----|-------|------------|
| Admin | admin@proviemplea.cl | password |
| Talento (demo) | talento@demo.cl | password |
| Empresa (demo) | empresa@demo.cl | password |

> Cambiar las contraseñas después del primer acceso.

---

## Estructura de roles

Los roles se gestionan a través del campo `role` en la tabla `users`:

| Valor | Descripción |
|-------|-------------|
| `admin` | Administrador del sistema |
| `talento` | Persona en búsqueda de empleo |
| `empresa` | Empresa reclutadora |

El middleware `role:{tipo}` protege cada grupo de rutas según el rol.

---

## Configuración de almacenamiento de archivos

Los archivos subidos (documentos de talento, documentos de empresa, logos) se guardan en `storage/app/public/`. El enlace simbólico `public/storage` debe existir para que sean accesibles desde el navegador.

```bash
php artisan storage:link
```

---

## Ramas del repositorio

| Rama | Descripción |
|------|-------------|
| `main` | Rama principal estable |
| `jonathan-dev` | Desarrollo activo (rama actual) |
| `sebastian-dev` | Aportes del segundo desarrollador |
