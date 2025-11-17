# ARQUITECTURA DEL PROYECTO PRODUKTUAK

## 📊 DIAGRAMA DE ARQUITECTURA

```
┌─────────────────────────────────────────────────────────────────────┐
│                           CLIENTE (NAVEGADOR)                        │
│                                                                      │
│  ┌──────────────────────┐         ┌──────────────────────────┐     │
│  │   CRUD Tradicional   │         │     CRUD con Vue.js      │     │
│  │    (Blade Views)     │         │   (SPA + API REST)       │     │
│  │                      │         │                          │     │
│  │ • Lista productos    │         │ • Vue.js 3 (CDN)        │     │
│  │ • Crear/Editar/Ver  │         │ • Axios (CDN)           │     │
│  │ • Bootstrap 5        │         │ • Reactivo sin recarga  │     │
│  └──────────────────────┘         └──────────────────────────┘     │
│           │                                    │                     │
└───────────┼────────────────────────────────────┼─────────────────────┘
            │                                    │
            │ HTTP Request                       │ API Request (JSON)
            ▼                                    ▼
┌─────────────────────────────────────────────────────────────────────┐
│                          LARAVEL (BACKEND)                           │
│                                                                      │
│  ┌─────────────────────────────────────────────────────────────┐   │
│  │                          ROUTES                              │   │
│  ├─────────────────────────────────────────────────────────────┤   │
│  │  routes/web.php              │   routes/api.php             │   │
│  │  • /produktuak               │   • /api/produktuak          │   │
│  │  • /produktuak/create        │   • /api/produktuak/{id}     │   │
│  │  • /produktuak/{id}          │   • POST, PUT, DELETE        │   │
│  │  • /produktuak-vue           │                              │   │
│  └───────────┬──────────────────┴───────────────┬──────────────┘   │
│              │                                   │                  │
│              ▼                                   ▼                  │
│  ┌───────────────────────┐         ┌───────────────────────────┐  │
│  │  ProduktuController   │         │ ProduktuApiController     │  │
│  │  (Resource CRUD)      │         │ (API Resource)            │  │
│  ├───────────────────────┤         ├───────────────────────────┤  │
│  │ • index()             │         │ • index() → JSON          │  │
│  │ • create()            │         │ • store() → JSON          │  │
│  │ • store()             │         │ • show() → JSON           │  │
│  │ • show()              │         │ • update() → JSON         │  │
│  │ • edit()              │         │ • destroy() → 204         │  │
│  │ • update()            │         │                           │  │
│  │ • destroy()           │         │ Validación en servidor    │  │
│  │                       │         │                           │  │
│  │ Retorna: Blade Views  │         │ Retorna: JSON             │  │
│  └───────────┬───────────┘         └───────────┬───────────────┘  │
│              │                                   │                  │
│              └───────────────┬───────────────────┘                  │
│                              ▼                                      │
│                  ┌───────────────────────┐                         │
│                  │   Produktu Model      │                         │
│                  │   (Eloquent ORM)      │                         │
│                  ├───────────────────────┤                         │
│                  │ • $table = 'produktuak'                         │
│                  │ • $fillable            │                         │
│                  │ • $casts               │                         │
│                  │ • Timestamps           │                         │
│                  └───────────┬───────────┘                         │
│                              │                                      │
└──────────────────────────────┼──────────────────────────────────────┘
                               │ Eloquent Queries
                               ▼
┌─────────────────────────────────────────────────────────────────────┐
│                        MYSQL DATABASE                                │
│                                                                      │
│  ┌──────────────────────────────────────────────────────────────┐  │
│  │               Tabla: produktuak                              │  │
│  ├──────────────────────────────────────────────────────────────┤  │
│  │  • id (BIGINT, AUTO_INCREMENT, PRIMARY KEY)                  │  │
│  │  • izena (VARCHAR(255), NOT NULL)                            │  │
│  │  • deskribapena (TEXT, NULL)                                 │  │
│  │  • prezioa (DECIMAL(8,2), NOT NULL)                          │  │
│  │  • created_at (TIMESTAMP, NULL)                              │  │
│  │  • updated_at (TIMESTAMP, NULL)                              │  │
│  └──────────────────────────────────────────────────────────────┘  │
│                                                                      │
└─────────────────────────────────────────────────────────────────────┘
```

## 🗂️ ESTRUCTURA DE DIRECTORIOS

```
laravel-vue/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ProduktuController.php          # CRUD web
│   │       └── Api/
│   │           └── ProduktuApiController.php   # API REST
│   │
│   └── Models/
│       └── Produktu.php                         # Modelo Eloquent
│
├── database/
│   └── migrations/
│       └── 2025_11_16_000001_create_produktuak_table.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php                    # Layout principal
│       │   └── nav.blade.php                    # Navegación
│       │
│       └── produktuak/
│           ├── index.blade.php                  # Lista
│           ├── create.blade.php                 # Crear
│           ├── edit.blade.php                   # Editar
│           ├── show.blade.php                   # Ver
│           └── vue.blade.php                    # Vue SPA
│
├── routes/
│   ├── web.php                                  # Rutas web
│   └── api.php                                  # Rutas API
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── .env.example                                 # Configuración
├── .gitignore
│
├── database.sql                                 # SQL básico
├── database_completo.sql                        # SQL completo
│
├── README.md                                    # Documentación
├── GUIA_PASO_A_PASO.md                         # Tutorial
├── COMPARATIVA_CRUD.md                          # Blade vs Vue
├── INSTALACION.txt                              # Instalación
├── COMANDOS.sh                                  # Comandos útiles
├── EJEMPLOS_API.md                              # Ejemplos API
├── RESUMEN_PROYECTO.txt                         # Resumen
└── ARQUITECTURA.md                              # Este archivo
```

## 🔄 FLUJO DE DATOS

### CRUD Tradicional (Blade)

```
1. Usuario visita /produktuak
   ↓
2. Route: GET /produktuak
   ↓
3. ProduktuController@index
   ↓
4. Produktu::latest()->paginate(10)
   ↓
5. Base de datos: SELECT * FROM produktuak
   ↓
6. Eloquent devuelve colección
   ↓
7. Controller pasa datos a vista
   ↓
8. Blade renderiza index.blade.php
   ↓
9. HTML completo → Usuario
```

### CRUD con Vue.js (SPA)

```
1. Usuario visita /produktuak-vue
   ↓
2. Route: GET /produktuak-vue
   ↓
3. Renderiza vue.blade.php (una sola vez)
   ↓
4. Vue.js se monta en #app
   ↓
5. mounted() → fetchProducts()
   ↓
6. Axios: GET /api/produktuak
   ↓
7. Route: GET /api/produktuak
   ↓
8. ProduktuApiController@index
   ↓
9. Produktu::latest()->paginate(10)
   ↓
10. Base de datos: SELECT * FROM produktuak
   ↓
11. Controller devuelve JSON
   ↓
12. Axios recibe respuesta
   ↓
13. Vue actualiza this.produktuak
   ↓
14. DOM se actualiza automáticamente
   ↓
15. Usuario ve la lista
```

## 🎯 OPERACIONES CRUD

### CREATE (Crear)

**Blade:**
```
Usuario → /produktuak/create → Formulario HTML
         ↓ POST /produktuak
ProduktuController@store → Validación → Produktu::create()
         ↓
Base de datos → INSERT INTO produktuak
         ↓
Redirect → /produktuak (con mensaje de éxito)
```

**Vue.js:**
```
Usuario → Llena formulario → Clic en "Gorde"
         ↓ @submit.prevent="saveProduct()"
Axios → POST /api/produktuak (JSON)
         ↓
ProduktuApiController@store → Validación → Produktu::create()
         ↓
Base de datos → INSERT INTO produktuak
         ↓
JSON Response (201 Created)
         ↓
Vue → Actualiza lista sin recargar
```

### READ (Leer)

**Blade:**
```
GET /produktuak/{id}
         ↓
ProduktuController@show($produktua)
         ↓
Produktu::find($id)
         ↓
Base de datos → SELECT * FROM produktuak WHERE id = ?
         ↓
Blade → show.blade.php → HTML
```

**Vue.js:**
```
Axios → GET /api/produktuak
         ↓
ProduktuApiController@index()
         ↓
Produktu::latest()->paginate(10)
         ↓
Base de datos → SELECT * FROM produktuak
         ↓
JSON Response (paginado)
         ↓
Vue → Renderiza en tabla
```

### UPDATE (Actualizar)

**Blade:**
```
GET /produktuak/{id}/edit → Formulario prellenado
         ↓ PUT /produktuak/{id}
ProduktuController@update($request, $produktua)
         ↓
Validación → $produktua->update($validated)
         ↓
Base de datos → UPDATE produktuak SET ... WHERE id = ?
         ↓
Redirect → /produktuak (con mensaje de éxito)
```

**Vue.js:**
```
Clic en "Editatu" → Carga datos en formulario
         ↓
Usuario modifica → Clic en "Eguneratu"
         ↓ @submit.prevent="saveProduct()"
Axios → PUT /api/produktuak/{id} (JSON)
         ↓
ProduktuApiController@update($request, $produktua)
         ↓
Validación → $produktua->update($validated)
         ↓
Base de datos → UPDATE produktuak SET ... WHERE id = ?
         ↓
JSON Response (200 OK)
         ↓
Vue → Actualiza lista sin recargar
```

### DELETE (Eliminar)

**Blade:**
```
Formulario con @method('DELETE')
         ↓ DELETE /produktuak/{id}
ProduktuController@destroy($produktua)
         ↓
$produktua->delete()
         ↓
Base de datos → DELETE FROM produktuak WHERE id = ?
         ↓
Redirect → /produktuak (con mensaje de éxito)
```

**Vue.js:**
```
Clic en "Ezabatu" → confirm()
         ↓ Si confirma
Axios → DELETE /api/produktuak/{id}
         ↓
ProduktuApiController@destroy($produktua)
         ↓
$produktua->delete()
         ↓
Base de datos → DELETE FROM produktuak WHERE id = ?
         ↓
Response (204 No Content)
         ↓
Vue → Elimina de la lista sin recargar
```

## 🔐 VALIDACIONES

### En el Servidor (Ambos enfoques)

```php
$validated = $request->validate([
    'izena' => 'required|string|max:255',
    'deskribapena' => 'nullable|string',
    'prezioa' => 'required|numeric|min:0',
]);
```

**Errores en Blade:**
```blade
@error('izena')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
```

**Errores en Vue.js:**
```javascript
.catch(error => {
    if (error.response?.data?.errors) {
        this.error = Object.values(error.response.data.errors).flat().join(', ');
    }
});
```

## 📦 COMPONENTES PRINCIPALES

### 1. Modelo (Produktu)
- Define estructura de datos
- Relación con tabla `produktuak`
- Campos permitidos ($fillable)
- Casting de tipos ($casts)

### 2. Controladores
- **ProduktuController**: CRUD web tradicional
- **ProduktuApiController**: API REST JSON

### 3. Rutas
- **web.php**: Rutas para navegación tradicional
- **api.php**: Endpoints API REST

### 4. Vistas
- **Layouts**: Estructura común (app.blade.php, nav.blade.php)
- **CRUD Blade**: index, create, edit, show
- **Vue SPA**: vue.blade.php (aplicación de una sola página)

### 5. Base de datos
- **Migración**: Define esquema de tabla
- **Tabla produktuak**: Almacena productos

## 🚀 TECNOLOGÍAS

### Backend
- **Laravel 10+**: Framework PHP
- **Eloquent ORM**: Mapeo objeto-relacional
- **Blade**: Motor de plantillas
- **Route Model Binding**: Inyección automática de modelos

### Frontend Tradicional
- **Blade Templates**: Renderizado en servidor
- **Bootstrap 5**: Framework CSS
- **HTML/CSS/JS**: Estándar web

### Frontend Moderno (SPA)
- **Vue.js 3**: Framework JavaScript reactivo
- **Axios**: Cliente HTTP para API
- **Bootstrap 5**: Framework CSS

### Base de datos
- **MySQL**: Sistema de gestión de base de datos
- **InnoDB**: Motor de almacenamiento

## 📊 PAGINACIÓN

**En Blade:**
```php
$produktuak = Produktu::latest()->paginate(10);
```
```blade
{{ $produktuak->links() }}
```

**En API:**
```php
$produktuak = Produktu::latest()->paginate(10);
return response()->json($produktuak);
```
```json
{
  "current_page": 1,
  "data": [...],
  "per_page": 10,
  "total": 50
}
```

## 🎨 ESTILOS Y UX

- **Bootstrap 5**: Diseño responsive
- **Clases de utilidad**: Espaciado, colores, tipografía
- **Componentes**: Cards, tables, forms, buttons, alerts
- **Validación visual**: Estados is-invalid/is-valid
- **Feedback**: Mensajes de éxito/error
- **Confirmaciones**: Antes de eliminar

## 🧩 PATRONES DE DISEÑO

### MVC (Model-View-Controller)
- **Model**: Produktu.php
- **View**: Archivos .blade.php
- **Controller**: ProduktuController.php

### RESTful API
- GET /api/produktuak → Listar
- POST /api/produktuak → Crear
- GET /api/produktuak/{id} → Ver
- PUT /api/produktuak/{id} → Actualizar
- DELETE /api/produktuak/{id} → Eliminar

### Repository Pattern (Implícito con Eloquent)
- Eloquent actúa como capa de abstracción
- Facilita cambios en la capa de datos

## 🔄 CICLO DE VIDA

### Request Lifecycle (Blade)
```
1. Usuario → HTTP Request
2. Routing → web.php
3. Controller → Lógica de negocio
4. Model → Consulta base de datos
5. View → Blade renderiza HTML
6. Response → HTML completo
```

### Request Lifecycle (API + Vue)
```
1. Usuario → Interacción en Vue
2. Vue → Axios request
3. Routing → api.php
4. Controller → Lógica de negocio
5. Model → Consulta base de datos
6. Response → JSON
7. Vue → Actualiza DOM reactivamente
```

## 📈 ESCALABILIDAD

### Posibles mejoras futuras:
- Autenticación con Laravel Sanctum
- Autorización con Policies
- Caché con Redis
- Cola de trabajos
- Eventos y Listeners
- Testing (PHPUnit, Pest)
- API Resources para transformar datos
- Seeders y Factories
- Búsqueda avanzada
- Filtros y ordenamiento
- Exportación de datos
- Subida de imágenes

---

**Este diagrama muestra la arquitectura completa del proyecto Produktuak, facilitando la comprensión de cómo interactúan todos los componentes.** 🎯
