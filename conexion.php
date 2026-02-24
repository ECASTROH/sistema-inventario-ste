<?php
$host = 'localhost';
$dbname = 'inventario_ste'; // El nombre coincide con el archivo sql
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa"; // desconecta solo para pruebas
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>