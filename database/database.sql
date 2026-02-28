-- 1. Script de creación de Base de Datos
CREATE DATABASE IF NOT EXISTS inventario_ste;
USE inventario_ste;

-- 2. Estructura de tabla y Tipos de datos adecuados
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identificador único
    nombre VARCHAR(100) NOT NULL,               -- Texto corto nombres
    descripcion TEXT,                           -- Texto largo detalles
    precio DECIMAL(10, 2) NOT NULL,             -- Decimal para dinero
    stock INT NOT NULL DEFAULT 0,               -- Entero para cantidades
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de registro automática
);

-- 3. (Opcional) Datos de prueba
INSERT INTO productos (nombre, descripcion, precio, stock) VALUES 
('Router Mikrotik hAP ac3', 'Router inalámbrico doble banda con 5 puertos Gigabit', 85.00, 10),
('Switch 8 Puertos', 'Switch de escritorio 10/100/1000 Mbps', 25.00, 20),
('Cable UTP Cat5e', 'Cable de red por metro, color azul', 0.50, 0), -- Stock 0 para probar alerta roja
('Teclado Logitech', 'Teclado inalámbrico compacto', 15.00, 10),
('Impresora Epson L4350', 'Impresora multifuncional de tanque de tinta', 295.75, 25);