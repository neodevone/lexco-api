# Lexco API - Sistema de Gestión de Usuarios y Productos

API REST desarrollada en Laravel 13 con PostgreSQL.

**Autor:** Cristhian David Roncancio  
**Fecha:** Abril 2026

## Tecnologías
- Laravel 13
- PostgreSQL 16
- PHP 8.3
- Laravel Sanctum (autenticación con cookies HttpOnly)

## Instalación

### 1. Clonar repositorio
```bash
git clone https://github.com/neodevone/lexco-api.git
cd lexco-api
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Variables de entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar .env
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=lexco_db
DB_USERNAME=postgres
DB_PASSWORD=tu_password

SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1,localhost:4200
FRONTEND_URL=http://localhost:4200
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

### 6. Iniciar servidor
```bash
php artisan serve
```

## Endpoints principales

### Auth
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| POST | /api/auth/register | Registro (primer usuario = ADMIN) |
| POST | /api/auth/login | Iniciar sesión |
| POST | /api/auth/logout | Cerrar sesión |
| GET | /api/auth/me | Usuario autenticado |

### Usuarios (solo ADMIN)
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | /api/users | Listar usuarios |
| GET | /api/users/{id} | Ver usuario |
| POST | /api/users | Crear usuario |
| PUT | /api/users/{id} | Actualizar usuario |
| DELETE | /api/users/{id} | Eliminar usuario |

### Productos
| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | /api/products | Listar productos |
| GET | /api/products/{id} | Ver producto |
| POST | /api/products | Crear producto (ADMIN) |
| PUT | /api/products/{id} | Actualizar producto (ADMIN) |
| DELETE | /api/products/{id} | Eliminar producto (ADMIN) |
| POST | /api/products/purchase | Comprar producto |

## Seguridad
- Cookies HttpOnly para manejo de sesión
- Validación de contraseña: mínimo 8 caracteres, mayúscula, minúscula, número y carácter especial
- Control de roles: ADMIN y USER
- Máximo 2 usuarios autenticados simultáneamente
- Protección contra SQL Injection via Eloquent ORM

## Arquitectura
```
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Services/
└── Repositories/
routes/
├── auth.php
├── users.php
└── products.php
```