# ProviEmplea — Documentación General

**ProviEmplea** es una plataforma web de intermediación laboral desarrollada para el Departamento de Empleo. Conecta personas en búsqueda de trabajo con empresas que requieren talento, con el Departamento de Empleo como intermediario que valida perfiles y gestiona el proceso.

---

## Descripción General

La plataforma opera con tres roles principales:

| Rol | Descripción |
|-----|-------------|
| **Talento** | Persona que busca empleo. Construye su perfil y CV, sube documentos y hace seguimiento de sus postulaciones. |
| **Empresa** | Organización que busca candidatos. Navega la vitrina de talentos y solicita contacto a través del administrador. |
| **Admin** | Departamento de Empleo. Valida perfiles, gestiona solicitudes y administra todo el proceso de selección. |

### Flujo principal

```
Talento se registra
       ↓
Admin valida el perfil
       ↓
Empresa navega la vitrina (CV ciego, sin datos personales)
       ↓
Empresa solicita contacto con un talento
       ↓
Admin aprueba y gestiona el proceso
       ↓
Estados: Contactado → Entrevista → Seleccionado → Contratado
```

---

## Navegación de la Wiki

| Página | Contenido |
|--------|-----------|
| [Instalación y Configuración](Instalacion) | Requisitos, instalación local, variables de entorno |
| [Arquitectura y Stack](Arquitectura) | Stack tecnológico, estructura de carpetas, patrones usados |
| [Base de Datos](Base-de-Datos) | Diagrama de tablas, relaciones, descripción de campos |
| [Módulo Talento](Modulo-Talento) | Funcionalidades del portal del talento |
| [Módulo Empresa](Modulo-Empresa) | Funcionalidades del portal de empresa |
| [Módulo Admin](Modulo-Admin) | Panel administrativo, validaciones y seguimiento |
| [Referencia de Rutas](Rutas) | Listado completo de rutas HTTP |
| [Estado del Proyecto](Estado-del-Proyecto) | Qué está implementado y qué está pendiente |

---

## Stack Rápido

- **Backend:** Laravel 12 (PHP 8.3)
- **Frontend:** Blade + Tailwind CSS + Alpine.js
- **Base de datos:** MySQL
- **Autenticación:** Laravel Breeze con roles personalizados
- **Almacenamiento:** Laravel Storage (disco `public`)
