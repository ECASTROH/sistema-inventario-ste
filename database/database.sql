CREATE DATABASE inventario_ste;
USE inventario_ste;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL CHECK (stock >= 0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO productos (nombre, precio, stock) VALUES 
('Router Mikrotik', 85.00, 10),
('Switch 8 Puertos', 25.00, 20),
('Cable UTP Cat5e', 0.50, 100);