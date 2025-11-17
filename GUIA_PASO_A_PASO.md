# GUÍA PASO A PASO - PRODUKTUAK

Esta guía te ayudará a poner en marcha el proyecto desde cero.

## 📋 PRERREQUISITOS

Antes de empezar, asegúrate de tener instalado:

- ✅ PHP >= 8.1
- ✅ Composer
- ✅ MySQL >= 5.7
- ✅ Un editor de código (VS Code recomendado)

### Verificar instalaciones

```bash
php --version
composer --version
mysql --version
```

## 🚀 INSTALACIÓN PASO A PASO

### Paso 1: Crear la base de datos

Opción A - Usando el archivo SQL:
```bash
mysql -u root -p < database_completo.sql
```

Opción B - Manualmente en MySQL:
```sql
mysql -u root -p
CREATE DATABASE produktuak CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Paso 2: Configurar el archivo .env

```bash
# Copiar el archivo de ejemplo
cp .env.example .env

# Generar la clave de aplicación
php artisan key:generate
```

Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=produktuak
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### Paso 3: Ejecutar las migraciones

```bash
php artisan migrate
```

Deberías ver algo como:
```
Migration table created successfully.
Migrating: 2025_11_16_000001_create_produktuak_table
Migrated:  2025_11_16_000001_create_produktuak_table (XX.XXms)
```

### Paso 4: Insertar datos de ejemplo (opcional)

Opción A - Usando SQL:
```bash
mysql -u root -p produktuak < database.sql
```

Opción B - Usando Tinker:
```bash
php artisan tinker
```

Luego ejecuta:
```php
App\Models\Produktu::create(['izena' => 'Laptop', 'deskribapena' => 'Portátil gaming', 'prezioa' => 999.99]);
exit
```

### Paso 5: Iniciar el servidor

```bash
php artisan serve
```

✅ Abre tu navegador en: `http://localhost:8000`

## 🎯 PROBANDO LA APLICACIÓN

### 1. CRUD Clásico (Blade)

Visita: `http://localhost:8000/produktuak`

- Ver lista de productos
- Crear nuevo producto (botón "Produktu Berria")
- Editar un producto
- Ver detalles de un producto
- Eliminar un producto

### 2. CRUD con Vue.js

Visita: `http://localhost:8000/produktuak-vue`

- Mismas funcionalidades pero con Vue.js
- Sin recarga de página
- Interfaz más dinámica

### 3. API REST

Prueba los endpoints con curl o Postman:

#### Listar productos
```bash
curl http://localhost:8000/api/produktuak
```

#### Crear producto
```bash
curl -X POST http://localhost:8000/api/produktuak \
  -H "Content-Type: application/json" \
  -d '{"izena":"Test","deskribapena":"Descripción","prezioa":99.99}'
```

#### Ver producto (ID 1)
```bash
curl http://localhost:8000/api/produktuak/1
```

#### Actualizar producto (ID 1)
```bash
curl -X PUT http://localhost:8000/api/produktuak/1 \
  -H "Content-Type: application/json" \
  -d '{"izena":"Actualizado","deskribapena":"Nueva desc","prezioa":149.99}'
```

#### Eliminar producto (ID 1)
```bash
curl -X DELETE http://localhost:8000/api/produktuak/1
```

## 🔍 EXPLORANDO EL CÓDIGO

### Arquitectura MVC

1. **Modelo** (`app/Models/Produktu.php`)
   - Define la estructura de datos
   - Relación con la tabla `produktuak`
   - Campos editables ($fillable)

2. **Controladores**
   - `ProduktuController.php` - CRUD web
   - `Api/ProduktuApiController.php` - API REST

3. **Vistas** (`resources/views/produktuak/`)
   - `index.blade.php` - Lista
   - `create.blade.php` - Formulario crear
   - `edit.blade.php` - Formulario editar
   - `show.blade.php` - Detalle
   - `vue.blade.php` - Versión Vue.js

### Rutas

Ver todas las rutas:
```bash
php artisan route:list
```

Ver solo rutas de produktuak:
```bash
php artisan route:list --name=produktuak
```

## 🛠️ COMANDOS ÚTILES

### Desarrollo

```bash
# Iniciar servidor
php artisan serve

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver logs
tail -f storage/logs/laravel.log
```

### Base de datos

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Resetear base de datos
php artisan migrate:fresh

# Ver estado de migraciones
php artisan migrate:status
```

### Tinker (Consola interactiva)

```bash
php artisan tinker
```

Comandos útiles en Tinker:
```php
// Listar todos los productos
App\Models\Produktu::all();

// Contar productos
App\Models\Produktu::count();

// Buscar por ID
App\Models\Produktu::find(1);

// Crear producto
App\Models\Produktu::create([
    'izena' => 'Nuevo Producto',
    'deskribapena' => 'Descripción',
    'prezioa' => 29.99
]);

// Actualizar producto
$p = App\Models\Produktu::find(1);
$p->prezioa = 39.99;
$p->save();

// Eliminar producto
App\Models\Produktu::find(1)->delete();

// Salir
exit
```

## 🐛 SOLUCIÓN DE PROBLEMAS

### Error: "Database does not exist"
```bash
# Crear la base de datos manualmente
mysql -u root -p
CREATE DATABASE produktuak;
EXIT;
php artisan migrate
```

### Error: "Access denied for user"
- Verifica tu usuario y contraseña en `.env`
- Asegúrate de que MySQL esté ejecutándose

### Error: "Class 'Produktu' not found"
```bash
composer dump-autoload
```

### Error de permisos en storage/
```bash
chmod -R 775 storage bootstrap/cache
```

### La página no carga estilos
- Verifica que Bootstrap esté cargando desde CDN
- Revisa la consola del navegador (F12)

## 📚 RECURSOS DE APRENDIZAJE

### Documentación oficial
- Laravel: https://laravel.com/docs
- Vue.js: https://vuejs.org/guide/
- Bootstrap: https://getbootstrap.com/docs

### Conceptos clave

1. **Eloquent ORM**: Sistema de mapeo objeto-relacional de Laravel
2. **Blade Templates**: Motor de plantillas de Laravel
3. **Resource Controllers**: Controladores con métodos CRUD predefinidos
4. **Route Model Binding**: Inyección automática de modelos en rutas
5. **API REST**: Arquitectura para servicios web
6. **SPA (Single Page Application)**: Aplicación de una sola página con Vue.js

## 🎓 EJERCICIOS PRÁCTICOS

### Nivel Básico
1. ✏️ Añadir un nuevo producto manualmente
2. ✏️ Editar el precio de un producto existente
3. ✏️ Cambiar el número de productos por página en la paginación

### Nivel Intermedio
4. ✏️ Añadir un campo "stock" (cantidad disponible) a los productos
5. ✏️ Implementar búsqueda por nombre de producto
6. ✏️ Añadir ordenación por columnas (nombre, precio, fecha)

### Nivel Avanzado
7. ✏️ Crear un sistema de categorías para productos
8. ✏️ Implementar carga de imágenes para productos
9. ✏️ Añadir autenticación de usuarios
10. ✏️ Crear un carrito de compra

## 💡 TIPS

- Usa `dd()` para debuggear: `dd($variable);`
- Revisa siempre los logs: `storage/logs/laravel.log`
- La consola del navegador (F12) es tu amiga
- Lee los mensajes de error, suelen ser claros
- Practica modificando el código poco a poco

## 🤝 SOPORTE

Si tienes dudas:
1. Lee la documentación oficial
2. Busca en Stack Overflow
3. Pregunta a tu profesor/a
4. Revisa los comentarios en el código

---

**¡Buena suerte con tu aprendizaje!** 🚀
