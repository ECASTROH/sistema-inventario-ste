<?php
include 'conexion.php';

// Verificamos si nos enviaron el ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Preparamos eliminación segura
    try {
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        
        // Retornamos al index
        header('Location: index.php');
    } catch (PDOException $e) {
        die("Error al eliminar: " . $e->getMessage());
    }
} else {
    // Si intentan entrar sin ID, retorna al inicio
    header('Location: index.php');
}
?>