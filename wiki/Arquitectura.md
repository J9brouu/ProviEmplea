# Arquitectura y Stack Tecnológico

## Stack

| Capa | Tecnología |
|------|-----------|
| Framework backend | Laravel 12 |
| Lenguaje | PHP 8.3 |
| Motor de plantillas | Blade |
| CSS | Tailwind CSS (via Vite) |
| Interactividad frontend | Alpine.js |
| Base de datos | MySQL 8 |
| Autenticación | Laravel Breeze |
| Almacenamiento de archivos | Laravel Storage (disco `public`) |
| Gestor de dependencias PHP | Composer |
| Gestor de dependencias JS | npm |
| Entorno de desarrollo | Laragon (Windows) |

---

## Estructura de carpetas relevantes

```
proviemplea/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controladores del panel admin
│   │   │   ├── Auth/           # Registro y autenticación
│   │   │   ├── Empresa/        # Controladores del portal empresa
│   │   │   └── Talento/        # Controladores del portal talento
│   │   └── Middleware/
│   └── Models/                 # Modelos Eloquent
├── database/
│   ├── migrations/             # Migraciones de BD
│   └── seeders/                # Datos iniciales
├── resources/
│   └── views/
│       ├── admin/              # Vistas del panel admin
│       ├── auth/               # Login, registro
│       ├── components/         # Componentes Blade reutilizables
│       ├── empresa/            # Vistas del portal empresa
│       ├── layouts/            # Layouts base (admin, talento, empresa)
│       └── talento/            # Vistas del portal talento
├── routes/
│   ├── web.php                 # Rutas web principales
│   └── auth.php                # Rutas de autenticación (Breeze)
└── storage/
    └── app/public/             # Archivos subidos por usuarios
```

---

## Arquitectura de autenticación y roles

El sistema usa Laravel Breeze como base de autenticación. Los roles se controlan con un middleware personalizado `role:{tipo}` que protege cada grupo de rutas.

```
Usuario autenticado
       ↓
Middleware role:admin  → /admin/*
Middleware role:talento → /talento/*
Middleware role:empresa → /empresa/*
```

Cada rol tiene su propio layout Blade:
- `layouts/admin.blade.php` — Sidebar oscuro con navegación completa
- `layouts/talento.blade.php` — Portal del candidato
- `layouts/empresa.blade.php` — Portal de la empresa

---

## Patrones y convenciones usadas

### Controladores
Un controlador por entidad/módulo. Los controladores del mismo rol se agrupan en subdirectorios (`Admin/`, `Talento/`, `Empresa/`).

### Rutas nombradas
Todas las rutas tienen nombre con el patrón `{rol}.{recurso}.{acción}`:
```
admin.talentos.update
talento.experiencia.store
empresa.procesos
```

### Modales
Los modales de edición usan Tailwind con clases `hidden`/`flex` controladas por JavaScript vanilla:
```javascript
const m = document.getElementById('modalNombre');
m.classList.remove('hidden');
m.classList.add('flex');
```

### Almacenamiento de archivos
Los archivos se guardan en el disco `public` de Laravel Storage. La ruta física es `storage/app/public/`. El acceso web es a través del symlink `public/storage/`.

### Modelos Eloquent
Los modelos usan `$fillable` para asignación masiva y accessors para transformaciones de datos (ej: `getEstadoTextoAttribute`, `getEstadoColorAttribute` en `Interacciones`).

---

## Modelos y relaciones principales

```
User
 ├── Talento (1:1, via user_id)
 │    ├── AntecedentesEducacionales (1:N)
 │    ├── AntecedentesLaborales (1:N)
 │    ├── Perfeccionamiento (1:N)
 │    ├── CompetenciasTecnicas (1:N)
 │    ├── TalentoIdioma (1:N)
 │    ├── TalentoArchivo (1:N)
 │    └── Interacciones (1:N)
 │
 └── DatosEmpresa (1:1, via user_id)
      ├── UsuariosEmpresa (1:N)
      ├── ArchivoEmpresa (1:N)
      └── Interacciones (1:N)

Interacciones → vincula DatosEmpresa con Talento (N:M con atributos)
```

---

## Componentes Blade reutilizables

| Componente | Uso |
|-----------|-----|
| `x-admin-layout` | Layout base del panel admin |
| `x-confirm-modal` | Modal de confirmación genérico (incluido en admin layout) |
| `x-input-error` | Muestra errores de validación en formularios |
| `x-landing/navbar` | Navbar de la página de inicio pública |
