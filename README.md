# Produktuak - Laravel + Vue.js CRUD Application

Aplicación completa de gestión de productos con Laravel y Vue.js para enseñanza.

## Características

- **Backend Laravel** con MySQL
- **CRUD clásico** con vistas Blade
- **API REST** completa
- **Frontend Vue.js 3** consumiendo la API (usando CDN)
- **Bootstrap 5** para el diseño
- Validación de formularios
- Paginación
- Mensajes de éxito/error

## Requisitos

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js y NPM (opcional, para desarrollo)

## Instalación

### 1. Configurar el proyecto Laravel

Si aún no has creado el proyecto:

```bash
composer create-project laravel/laravel produktuak
cd produktuak
```

### 2. Configurar la base de datos

Crear la base de datos MySQL usando el archivo `database.sql` incluido:

```bash
mysql -u tu_usuario -p < database.sql
```

O ejecutar manualmente:

```sql
CREATE DATABASE produktuak CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Configurar el archivo .env

Copiar el archivo de ejemplo y configurar las credenciales:

```bash
cp .env.example .env
php artisan key:generate
```

Editar `.env` con tus credenciales de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=produktuak
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 4. Ejecutar las migraciones

```bash
php artisan migrate
```

### 5. Iniciar el servidor

```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

## Estructura del proyecto

### Archivos creados/modificados

#### Modelos y Migraciones
- `app/Models/Produktu.php` - Modelo Eloquent
- `database/migrations/2025_11_16_000001_create_produktuak_table.php` - Migración

#### Controladores
- `app/Http/Controllers/ProduktuController.php` - Controlador web (CRUD clásico)
- `app/Http/Controllers/Api/ProduktuApiController.php` - Controlador API REST

#### Rutas
- `routes/web.php` - Rutas web
- `routes/api.php` - Rutas API

#### Vistas Blade
- `resources/views/layouts/app.blade.php` - Layout principal
- `resources/views/layouts/nav.blade.php` - Barra de navegación
- `resources/views/produktuak/index.blade.php` - Lista de productos
- `resources/views/produktuak/create.blade.php` - Crear producto
- `resources/views/produktuak/edit.blade.php` - Editar producto
- `resources/views/produktuak/show.blade.php` - Ver producto
- `resources/views/produktuak/vue.blade.php` - Vista con Vue.js

## Rutas principales

### Rutas Web (CRUD clásico con Blade)

- `GET /` - Redirige a la lista de productos
- `GET /produktuak` - Lista de productos (paginada)
- `GET /produktuak/create` - Formulario crear producto
- `POST /produktuak` - Guardar nuevo producto
- `GET /produktuak/{id}` - Ver detalle del producto
- `GET /produktuak/{id}/edit` - Formulario editar producto
- `PUT /produktuak/{id}` - Actualizar producto
- `DELETE /produktuak/{id}` - Eliminar producto

### Ruta Vue.js

- `GET /produktuak-vue` - CRUD con Vue.js + API

### Endpoints API REST

- `GET /api/produktuak` - Listar productos (paginado)
- `POST /api/produktuak` - Crear producto
- `GET /api/produktuak/{id}` - Ver producto
- `PUT /api/produktuak/{id}` - Actualizar producto
- `DELETE /api/produktuak/{id}` - Eliminar producto

## Funcionalidades

### CRUD Clásico (Blade)
- Lista de productos con paginación
- Crear nuevos productos
- Editar productos existentes
- Ver detalles de un producto
- Eliminar productos con confirmación
- Validación de formularios
- Mensajes de éxito

### CRUD con Vue.js
- Interfaz SPA (Single Page Application)
- Consumo de API REST
- Operaciones CRUD en tiempo real
- Sin recarga de página
- Manejo de errores
- Loading states

## Validaciones

Todos los formularios (web y API) incluyen validación:

- **izena**: requerido, string, máximo 255 caracteres
- **deskribapena**: opcional, texto
- **prezioa**: requerido, numérico, mínimo 0

## Tecnologías utilizadas

- **Laravel 10+** - Framework PHP
- **Vue.js 3** - Framework JavaScript (vía CDN)
- **Axios** - Cliente HTTP (vía CDN)
- **Bootstrap 5** - Framework CSS (vía CDN)
- **MySQL** - Base de datos
- **Blade** - Motor de plantillas

## Notas para el alumnado

### Conceptos cubiertos

1. **MVC en Laravel**
   - Modelos (Eloquent ORM)
   - Vistas (Blade templates)
   - Controladores (Resource Controllers)

2. **Base de datos**
   - Migraciones
   - Eloquent relationships
   - Query Builder

3. **Routing**
   - Rutas web
   - Rutas API
   - Route Model Binding

4. **Validación**
   - Request validation
   - Error handling

5. **API REST**
   - Verbos HTTP (GET, POST, PUT, DELETE)
   - Respuestas JSON
   - Status codes

6. **Frontend**
   - Blade templating
   - Vue.js reactivity
   - Axios HTTP requests
   - Bootstrap styling

### Ejercicios sugeridos

1. Añadir campo "stock" a los productos
2. Implementar búsqueda de productos
3. Añadir ordenación por columnas
4. Crear categorías de productos
5. Implementar autenticación
6. Añadir imágenes a los productos
7. Crear un carrito de compra

## Soporte

Para dudas o problemas:
- Revisar la documentación de Laravel: https://laravel.com/docs
- Revisar la documentación de Vue.js: https://vuejs.org/guide/

## Licencia

Este proyecto es material educativo de código abierto.
