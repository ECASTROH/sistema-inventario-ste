<?php
// Configuración robusta de base de datos
$host = 'localhost';
$db   = 'inventario_ste';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza errores reales
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,        // Trae datos como objetos (más limpio)
    PDO::ATTR_EMULATE_PREPARES   => false,                 // Seguridad real en consultas preparadas
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Si falla, muestra un mensaje profesional, no el error crudo
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// --- FUNCIÓN DE SEGURIDAD (EL ESCUDO PRO) ---
// Evita ataques XSS (Cross-Site Scripting) limpiando el HTML
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>