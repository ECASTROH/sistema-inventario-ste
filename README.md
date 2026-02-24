# Sistema de Inventario y Ventas - STE Network Solutions

## Descripción del Sistema
Sistema web CRUD desarrollado en PHP y MySQL para la gestión de productos tecnológicos. 
El proyecto cumple con los requisitos de validación de negocio (stock no negativo) y arquitectura MVC básica.

## Requisitos del Entorno
* **XAMPP:** Versión 8.0 o superior (con Apache y MySQL iniciados).
* **Navegador Web:** Chrome, Edge o Firefox.

## Instrucciones de Instalación en XAMPP
1. **Despliegue de Archivos:**
   - Asegúrese de que la carpeta del proyecto esté ubicada en:
     `C:\xampp\htdocs\inventario_stenetworksolutions`

2. **Base de Datos:**
   - Abra **phpMyAdmin** (`http://localhost/phpmyadmin`).
   - Cree una nueva base de datos llamada: `inventario_ste`.
   - Importe el script SQL ubicado en la carpeta del proyecto: `sql/database.sql`.

3. **Configuración:**
   - Verifique que el archivo `conexion.php` tenga las credenciales por defecto de XAMPP:
     - Usuario: `root`
     - Contraseña: `(vacío)`

4. **Ejecución:**
   - Abra su navegador e ingrese a:
     `http://localhost/inventario_stenetworksolutions`

## Autor
**Eduardo Castro** - Ingeniería en Sistemas Inteligentes - Programación de Sistemas Web