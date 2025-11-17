-- ============================================
-- SQL PARA CREAR LA BASE DE DATOS Y LA TABLA
-- ============================================

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS produktuak 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE produktuak;

-- Crear la tabla produktuak
CREATE TABLE IF NOT EXISTS produktuak (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    izena VARCHAR(255) NOT NULL,
    deskribapena TEXT NULL,
    prezioa DECIMAL(8,2) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar algunos datos de ejemplo (opcional)
INSERT INTO produktuak (izena, deskribapena, prezioa, created_at, updated_at) VALUES
('Laptop Dell XPS 13', 'Ordenador portátil ultraligero con procesador Intel i7', 1299.99, NOW(), NOW()),
('Teclado mecánico RGB', 'Teclado gaming con retroiluminación RGB personalizable', 89.99, NOW(), NOW()),
('Ratón inalámbrico', 'Ratón ergonómico con conexión Bluetooth', 29.99, NOW(), NOW()),
('Monitor 27 pulgadas', 'Monitor 4K UHD con tecnología IPS', 449.00, NOW(), NOW()),
('Auriculares Bluetooth', 'Auriculares con cancelación de ruido activa', 179.50, NOW(), NOW());

-- Mostrar los datos insertados
SELECT * FROM produktuak;
