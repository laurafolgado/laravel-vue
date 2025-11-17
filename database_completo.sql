-- ============================================
-- PRODUKTUAK - SQL COMPLETO
-- Base de datos para el proyecto Laravel + Vue
-- ============================================

-- ============================================
-- 1. CREAR Y USAR LA BASE DE DATOS
-- ============================================

DROP DATABASE IF EXISTS produktuak;

CREATE DATABASE produktuak 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE produktuak;

-- ============================================
-- 2. CREAR LA TABLA PRODUKTUAK
-- ============================================

CREATE TABLE produktuak (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    izena VARCHAR(255) NOT NULL COMMENT 'Nombre del producto',
    deskribapena TEXT NULL COMMENT 'Descripción del producto',
    prezioa DECIMAL(8,2) NOT NULL COMMENT 'Precio del producto',
    created_at TIMESTAMP NULL DEFAULT NULL COMMENT 'Fecha de creación',
    updated_at TIMESTAMP NULL DEFAULT NULL COMMENT 'Fecha de última actualización',
    
    INDEX idx_izena (izena),
    INDEX idx_prezioa (prezioa),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Tabla de productos';

-- ============================================
-- 3. INSERTAR DATOS DE EJEMPLO
-- ============================================

INSERT INTO produktuak (izena, deskribapena, prezioa, created_at, updated_at) VALUES
('Laptop Dell XPS 13', 'Ordenador portátil ultraligero con procesador Intel i7 de 11ª generación, 16GB RAM y 512GB SSD. Pantalla táctil 13.4 pulgadas Full HD.', 1299.99, NOW(), NOW()),
('MacBook Pro M2', 'MacBook Pro de 13 pulgadas con chip M2 de Apple, 8GB de memoria unificada y 256GB de almacenamiento SSD. Pantalla Retina.', 1499.00, NOW(), NOW()),
('Teclado mecánico RGB', 'Teclado gaming mecánico con switches Cherry MX Red, retroiluminación RGB personalizable y reposamuñecas magnético.', 89.99, NOW(), NOW()),
('Ratón inalámbrico Logitech', 'Ratón ergonómico con conexión Bluetooth y USB, 6 botones programables, sensor de 4000 DPI.', 29.99, NOW(), NOW()),
('Monitor LG 27 pulgadas', 'Monitor 4K UHD (3840x2160) de 27 pulgadas con tecnología IPS, HDR10, 99% sRGB, tiempo de respuesta 5ms.', 449.00, NOW(), NOW()),
('Auriculares Sony WH-1000XM5', 'Auriculares Bluetooth premium con cancelación de ruido activa, 30 horas de batería, audio de alta resolución.', 379.50, NOW(), NOW()),
('Webcam Logitech C920', 'Cámara web Full HD 1080p a 30fps, enfoque automático, micrófono estéreo integrado. Ideal para videoconferencias.', 79.99, NOW(), NOW()),
('Disco SSD Samsung 1TB', 'Unidad de estado sólido NVMe M.2 de 1TB, velocidad de lectura hasta 7000 MB/s, ideal para gaming y edición.', 129.00, NOW(), NOW()),
('Router WiFi 6 TP-Link', 'Router inalámbrico AX3000 con WiFi 6, velocidades de hasta 3 Gbps, cobertura para casas grandes.', 99.99, NOW(), NOW()),
('Tarjeta gráfica NVIDIA RTX 4060', 'GPU dedicada con 8GB GDDR6, Ray Tracing, DLSS 3.0. Perfecta para gaming en 1440p.', 399.00, NOW(), NOW()),
('Memoria RAM Corsair 32GB', 'Kit de 2x16GB DDR4 3200MHz, latencia CL16, diseño bajo perfil con disipador de calor.', 119.99, NOW(), NOW()),
('Fuente de alimentación Seasonic 750W', 'Fuente modular 80 PLUS Gold, 750W, silenciosa con ventilador de 120mm, protección completa.', 109.50, NOW(), NOW()),
('Micrófono Blue Yeti', 'Micrófono USB profesional con patrón polar configurable, ideal para streaming, podcasting y grabación.', 129.99, NOW(), NOW()),
('Hub USB-C 7 en 1', 'Adaptador multipuerto con HDMI 4K, 3 puertos USB 3.0, lector de tarjetas SD/microSD, puerto Ethernet.', 45.00, NOW(), NOW()),
('Soporte para portátil', 'Soporte ergonómico ajustable en aluminio, compatible con portátiles de 10-17 pulgadas, mejora la postura.', 34.99, NOW(), NOW());

-- ============================================
-- 4. CONSULTAS ÚTILES DE EJEMPLO
-- ============================================

-- Ver todos los productos
SELECT * FROM produktuak;

-- Ver productos ordenados por precio (más caro primero)
SELECT * FROM produktuak ORDER BY prezioa DESC;

-- Ver productos ordenados por fecha de creación (más reciente primero)
SELECT * FROM produktuak ORDER BY created_at DESC;

-- Buscar productos por nombre (ejemplo: que contengan "laptop")
SELECT * FROM produktuak WHERE izena LIKE '%laptop%';

-- Ver productos en un rango de precio (entre 50 y 200 euros)
SELECT * FROM produktuak WHERE prezioa BETWEEN 50 AND 200;

-- Contar total de productos
SELECT COUNT(*) as total_produktuak FROM produktuak;

-- Calcular el precio promedio
SELECT AVG(prezioa) as batez_besteko_prezioa FROM produktuak;

-- Ver el producto más caro
SELECT * FROM produktuak ORDER BY prezioa DESC LIMIT 1;

-- Ver el producto más barato
SELECT * FROM produktuak ORDER BY prezioa ASC LIMIT 1;

-- Ver productos con precio mayor a 100 euros
SELECT * FROM produktuak WHERE prezioa > 100;

-- Ver los 5 productos más caros
SELECT id, izena, prezioa FROM produktuak ORDER BY prezioa DESC LIMIT 5;

-- Ver resumen: cantidad y precio total
SELECT 
    COUNT(*) as kopurua,
    SUM(prezioa) as guztira,
    AVG(prezioa) as batez_bestekoa,
    MIN(prezioa) as merkeenak,
    MAX(prezioa) as garestiena
FROM produktuak;

-- ============================================
-- 5. CONSULTAS DE MANTENIMIENTO
-- ============================================

-- Actualizar el precio de un producto específico
-- UPDATE produktuak SET prezioa = 1399.99 WHERE id = 1;

-- Actualizar la descripción de un producto
-- UPDATE produktuak SET deskribapena = 'Nueva descripción del producto' WHERE id = 1;

-- Eliminar un producto específico
-- DELETE FROM produktuak WHERE id = 1;

-- Vaciar toda la tabla (cuidado!)
-- TRUNCATE TABLE produktuak;

-- Resetear el AUTO_INCREMENT
-- ALTER TABLE produktuak AUTO_INCREMENT = 1;

-- ============================================
-- 6. BÚSQUEDAS AVANZADAS
-- ============================================

-- Buscar productos que contengan palabras clave en nombre o descripción
SELECT * FROM produktuak 
WHERE izena LIKE '%laptop%' 
   OR deskribapena LIKE '%laptop%';

-- Paginación manual (página 1, 10 productos por página)
SELECT * FROM produktuak 
ORDER BY created_at DESC 
LIMIT 10 OFFSET 0;

-- Paginación manual (página 2, 10 productos por página)
SELECT * FROM produktuak 
ORDER BY created_at DESC 
LIMIT 10 OFFSET 10;

-- Productos creados en los últimos 7 días
SELECT * FROM produktuak 
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY);

-- Productos actualizados hoy
SELECT * FROM produktuak 
WHERE DATE(updated_at) = CURDATE();

-- ============================================
-- 7. CONSULTAS PARA ESTADÍSTICAS
-- ============================================

-- Distribución de productos por rango de precios
SELECT 
    CASE 
        WHEN prezioa < 50 THEN 'Merkea (< 50€)'
        WHEN prezioa BETWEEN 50 AND 100 THEN 'Tartekoa (50-100€)'
        WHEN prezioa BETWEEN 100 AND 200 THEN 'Garestia (100-200€)'
        ELSE 'Oso garestia (> 200€)'
    END as prezioa_maila,
    COUNT(*) as kopurua,
    AVG(prezioa) as batez_besteko_prezioa
FROM produktuak 
GROUP BY prezioa_maila 
ORDER BY batez_besteko_prezioa;

-- Productos con descripción vs sin descripción
SELECT 
    CASE 
        WHEN deskribapena IS NULL OR deskribapena = '' THEN 'Sin descripción'
        ELSE 'Con descripción'
    END as deskribapen_egoera,
    COUNT(*) as kopurua
FROM produktuak 
GROUP BY deskribapen_egoera;

-- ============================================
-- 8. VERIFICACIÓN DE INTEGRIDAD
-- ============================================

-- Verificar que no haya productos con precio negativo
SELECT * FROM produktuak WHERE prezioa < 0;

-- Verificar que no haya productos sin nombre
SELECT * FROM produktuak WHERE izena IS NULL OR izena = '';

-- Ver estructura de la tabla
DESCRIBE produktuak;

-- Ver información detallada de la tabla
SHOW CREATE TABLE produktuak;

-- Ver índices de la tabla
SHOW INDEX FROM produktuak;

-- ============================================
-- FIN DEL SCRIPT
-- ============================================
