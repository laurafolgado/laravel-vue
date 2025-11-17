# EJEMPLOS DE USO DE LA API REST - PRODUKTUAK

Este documento contiene ejemplos prácticos para probar la API REST del proyecto.

## 🌐 BASE URL

```
http://localhost:8000/api
```

## 📋 ENDPOINTS DISPONIBLES

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | /produktuak | Listar todos los productos (paginado) |
| POST | /produktuak | Crear un nuevo producto |
| GET | /produktuak/{id} | Ver un producto específico |
| PUT | /produktuak/{id} | Actualizar un producto |
| DELETE | /produktuak/{id} | Eliminar un producto |

---

## 1️⃣ LISTAR PRODUCTOS

### cURL
```bash
curl -X GET http://localhost:8000/api/produktuak
```

### cURL (con formato bonito)
```bash
curl -X GET http://localhost:8000/api/produktuak | json_pp
```

### JavaScript (Axios)
```javascript
axios.get('/api/produktuak')
  .then(response => {
    console.log(response.data);
  });
```

### JavaScript (Fetch)
```javascript
fetch('http://localhost:8000/api/produktuak')
  .then(response => response.json())
  .then(data => console.log(data));
```

### PHP
```php
$response = file_get_contents('http://localhost:8000/api/produktuak');
$produktuak = json_decode($response);
```

### Python
```python
import requests

response = requests.get('http://localhost:8000/api/produktuak')
print(response.json())
```

### Respuesta esperada (JSON)
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "izena": "Laptop Dell XPS 13",
      "deskribapena": "Ordenador portátil ultraligero",
      "prezioa": "1299.99",
      "created_at": "2025-11-16T10:00:00.000000Z",
      "updated_at": "2025-11-16T10:00:00.000000Z"
    }
  ],
  "first_page_url": "http://localhost:8000/api/produktuak?page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://localhost:8000/api/produktuak?page=2",
  "links": [...],
  "next_page_url": "http://localhost:8000/api/produktuak?page=2",
  "path": "http://localhost:8000/api/produktuak",
  "per_page": 10,
  "prev_page_url": null,
  "to": 10,
  "total": 15
}
```

---

## 2️⃣ VER UN PRODUCTO ESPECÍFICO

### cURL
```bash
curl -X GET http://localhost:8000/api/produktuak/1
```

### JavaScript (Axios)
```javascript
axios.get('/api/produktuak/1')
  .then(response => {
    console.log(response.data);
  });
```

### Respuesta esperada (JSON)
```json
{
  "id": 1,
  "izena": "Laptop Dell XPS 13",
  "deskribapena": "Ordenador portátil ultraligero con procesador Intel i7",
  "prezioa": "1299.99",
  "created_at": "2025-11-16T10:00:00.000000Z",
  "updated_at": "2025-11-16T10:00:00.000000Z"
}
```

---

## 3️⃣ CREAR UN PRODUCTO

### cURL
```bash
curl -X POST http://localhost:8000/api/produktuak \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "izena": "iPhone 15 Pro",
    "deskribapena": "Smartphone de última generación con chip A17 Pro",
    "prezioa": 1199.99
  }'
```

### cURL (versión simplificada)
```bash
curl -X POST http://localhost:8000/api/produktuak \
  -H "Content-Type: application/json" \
  -d '{"izena":"Test Product","prezioa":99.99}'
```

### JavaScript (Axios)
```javascript
axios.post('/api/produktuak', {
  izena: 'iPhone 15 Pro',
  deskribapena: 'Smartphone de última generación',
  prezioa: 1199.99
})
.then(response => {
  console.log('Producto creado:', response.data);
})
.catch(error => {
  console.error('Error:', error.response.data);
});
```

### JavaScript (Fetch)
```javascript
fetch('http://localhost:8000/api/produktuak', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    izena: 'iPhone 15 Pro',
    deskribapena: 'Smartphone de última generación',
    prezioa: 1199.99
  })
})
.then(response => response.json())
.then(data => console.log('Producto creado:', data));
```

### Python
```python
import requests

data = {
    'izena': 'iPhone 15 Pro',
    'deskribapena': 'Smartphone de última generación',
    'prezioa': 1199.99
}

response = requests.post('http://localhost:8000/api/produktuak', json=data)
print(response.json())
```

### Respuesta exitosa (JSON - Status 201)
```json
{
  "id": 16,
  "izena": "iPhone 15 Pro",
  "deskribapena": "Smartphone de última generación con chip A17 Pro",
  "prezioa": "1199.99",
  "created_at": "2025-11-16T14:30:00.000000Z",
  "updated_at": "2025-11-16T14:30:00.000000Z"
}
```

### Respuesta con error de validación (JSON - Status 422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "izena": [
      "The izena field is required."
    ],
    "prezioa": [
      "The prezioa field is required.",
      "The prezioa must be at least 0."
    ]
  }
}
```

---

## 4️⃣ ACTUALIZAR UN PRODUCTO

### cURL
```bash
curl -X PUT http://localhost:8000/api/produktuak/1 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "izena": "Laptop Dell XPS 13 (Actualizado)",
    "deskribapena": "Nueva descripción del producto",
    "prezioa": 1399.99
  }'
```

### JavaScript (Axios)
```javascript
axios.put('/api/produktuak/1', {
  izena: 'Laptop Dell XPS 13 (Actualizado)',
  deskribapena: 'Nueva descripción',
  prezioa: 1399.99
})
.then(response => {
  console.log('Producto actualizado:', response.data);
});
```

### Python
```python
import requests

data = {
    'izena': 'Laptop Dell XPS 13 (Actualizado)',
    'deskribapena': 'Nueva descripción',
    'prezioa': 1399.99
}

response = requests.put('http://localhost:8000/api/produktuak/1', json=data)
print(response.json())
```

### Respuesta esperada (JSON)
```json
{
  "id": 1,
  "izena": "Laptop Dell XPS 13 (Actualizado)",
  "deskribapena": "Nueva descripción del producto",
  "prezioa": "1399.99",
  "created_at": "2025-11-16T10:00:00.000000Z",
  "updated_at": "2025-11-16T14:35:00.000000Z"
}
```

---

## 5️⃣ ELIMINAR UN PRODUCTO

### cURL
```bash
curl -X DELETE http://localhost:8000/api/produktuak/1
```

### cURL (con verificación de respuesta)
```bash
curl -X DELETE http://localhost:8000/api/produktuak/1 \
  -w "\nHTTP Status: %{http_code}\n"
```

### JavaScript (Axios)
```javascript
axios.delete('/api/produktuak/1')
  .then(response => {
    console.log('Producto eliminado (Status 204)');
  });
```

### JavaScript (Fetch)
```javascript
fetch('http://localhost:8000/api/produktuak/1', {
  method: 'DELETE'
})
.then(response => {
  if (response.status === 204) {
    console.log('Producto eliminado exitosamente');
  }
});
```

### Python
```python
import requests

response = requests.delete('http://localhost:8000/api/produktuak/1')
print(f'Status: {response.status_code}')  # Debería ser 204
```

### Respuesta esperada
```
HTTP Status: 204 No Content
(Sin contenido en el cuerpo de la respuesta)
```

---

## 🧪 TESTING CON POSTMAN

### Colección de Postman

Puedes importar esta colección en Postman:

```json
{
  "info": {
    "name": "Produktuak API",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Listar Productos",
      "request": {
        "method": "GET",
        "header": [],
        "url": {
          "raw": "http://localhost:8000/api/produktuak",
          "protocol": "http",
          "host": ["localhost"],
          "port": "8000",
          "path": ["api", "produktuak"]
        }
      }
    },
    {
      "name": "Ver Producto",
      "request": {
        "method": "GET",
        "header": [],
        "url": {
          "raw": "http://localhost:8000/api/produktuak/1",
          "protocol": "http",
          "host": ["localhost"],
          "port": "8000",
          "path": ["api", "produktuak", "1"]
        }
      }
    },
    {
      "name": "Crear Producto",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"izena\": \"Producto Test\",\n  \"deskribapena\": \"Descripción de prueba\",\n  \"prezioa\": 99.99\n}"
        },
        "url": {
          "raw": "http://localhost:8000/api/produktuak",
          "protocol": "http",
          "host": ["localhost"],
          "port": "8000",
          "path": ["api", "produktuak"]
        }
      }
    },
    {
      "name": "Actualizar Producto",
      "request": {
        "method": "PUT",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"izena\": \"Producto Actualizado\",\n  \"deskribapena\": \"Nueva descripción\",\n  \"prezioa\": 149.99\n}"
        },
        "url": {
          "raw": "http://localhost:8000/api/produktuak/1",
          "protocol": "http",
          "host": ["localhost"],
          "port": "8000",
          "path": ["api", "produktuak", "1"]
        }
      }
    },
    {
      "name": "Eliminar Producto",
      "request": {
        "method": "DELETE",
        "header": [],
        "url": {
          "raw": "http://localhost:8000/api/produktuak/1",
          "protocol": "http",
          "host": ["localhost"],
          "port": "8000",
          "path": ["api", "produktuak", "1"]
        }
      }
    }
  ]
}
```

---

## 📊 VALIDACIONES DE LA API

| Campo | Reglas |
|-------|--------|
| `izena` | Requerido, string, máximo 255 caracteres |
| `deskribapena` | Opcional, string |
| `prezioa` | Requerido, numérico, mínimo 0 |

---

## ⚠️ CÓDIGOS DE RESPUESTA HTTP

| Código | Significado | Cuándo ocurre |
|--------|-------------|---------------|
| 200 | OK | GET, PUT exitosos |
| 201 | Created | POST exitoso |
| 204 | No Content | DELETE exitoso |
| 404 | Not Found | Producto no existe |
| 422 | Unprocessable Entity | Error de validación |
| 500 | Internal Server Error | Error en el servidor |

---

## 🧪 SCRIPT DE PRUEBAS AUTOMÁTICAS

### Bash Script
```bash
#!/bin/bash

echo "Testing Produktuak API..."
echo "========================="
echo ""

# Listar productos
echo "1. Listando productos..."
curl -s http://localhost:8000/api/produktuak | json_pp
echo ""

# Crear producto
echo "2. Creando producto..."
curl -s -X POST http://localhost:8000/api/produktuak \
  -H "Content-Type: application/json" \
  -d '{"izena":"Test API","deskribapena":"Prueba automática","prezioa":49.99}' \
  | json_pp
echo ""

# Ver producto (asumiendo ID 1)
echo "3. Viendo producto ID 1..."
curl -s http://localhost:8000/api/produktuak/1 | json_pp
echo ""

# Actualizar producto
echo "4. Actualizando producto ID 1..."
curl -s -X PUT http://localhost:8000/api/produktuak/1 \
  -H "Content-Type: application/json" \
  -d '{"izena":"Test Actualizado","deskribapena":"Descripción nueva","prezioa":59.99}' \
  | json_pp
echo ""

echo "Tests completados!"
```

### Python Script
```python
import requests
import json

BASE_URL = 'http://localhost:8000/api'

def test_api():
    print("Testing Produktuak API...")
    print("=" * 50)
    
    # 1. Listar productos
    print("\n1. Listando productos...")
    response = requests.get(f'{BASE_URL}/produktuak')
    print(json.dumps(response.json(), indent=2))
    
    # 2. Crear producto
    print("\n2. Creando producto...")
    new_product = {
        'izena': 'Test API Python',
        'deskribapena': 'Producto de prueba',
        'prezioa': 79.99
    }
    response = requests.post(f'{BASE_URL}/produktuak', json=new_product)
    product_id = response.json()['id']
    print(f"Producto creado con ID: {product_id}")
    
    # 3. Ver producto
    print(f"\n3. Viendo producto ID {product_id}...")
    response = requests.get(f'{BASE_URL}/produktuak/{product_id}')
    print(json.dumps(response.json(), indent=2))
    
    # 4. Actualizar producto
    print(f"\n4. Actualizando producto ID {product_id}...")
    updated_product = {
        'izena': 'Test Actualizado Python',
        'deskribapena': 'Descripción actualizada',
        'prezioa': 89.99
    }
    response = requests.put(f'{BASE_URL}/produktuak/{product_id}', json=updated_product)
    print(json.dumps(response.json(), indent=2))
    
    # 5. Eliminar producto
    print(f"\n5. Eliminando producto ID {product_id}...")
    response = requests.delete(f'{BASE_URL}/produktuak/{product_id}')
    print(f"Status: {response.status_code}")
    
    print("\nTests completados!")

if __name__ == '__main__':
    test_api()
```

---

## 💡 TIPS Y BUENAS PRÁCTICAS

1. **Siempre incluye el header `Content-Type: application/json`** en peticiones POST/PUT
2. **Maneja los errores de validación (422)** apropiadamente
3. **Verifica el código de respuesta HTTP** antes de procesar la respuesta
4. **Usa paginación** para grandes conjuntos de datos
5. **Implementa reintentos** para peticiones fallidas
6. **Valida datos en el cliente** antes de enviar a la API
7. **Usa tokens de autenticación** en producción (este proyecto no los incluye por simplicidad)

---

## 🔒 SEGURIDAD (Para Producción)

Este proyecto es educativo y no incluye autenticación. En producción, deberías:

- ✅ Implementar autenticación (Laravel Sanctum/Passport)
- ✅ Usar tokens de API
- ✅ Validar permisos de usuario
- ✅ Implementar rate limiting
- ✅ Usar HTTPS
- ✅ Sanitizar entradas
- ✅ Proteger contra CSRF

---

¡Disfruta probando la API! 🚀
