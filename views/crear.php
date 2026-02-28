<?php
include '../config/conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // --- VALIDACIONES OBLIGATORIAS ---
    // 1. Nombre no vacío. 2. Precio mayor a 0. 3. Stock no negativo.
    if (empty($nombre) || $precio <= 0 || $stock < 0) {
        $mensaje = "⚠️ Error: Verifique que el precio sea mayor a 0 y el stock no sea negativo.";
    } else {
        // Si está bien, guardamos
        try {
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $precio, $stock]);
            // Retornar al index luego de guardar
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $mensaje = "Error al guardar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card shadow" style="max-width: 600px; margin: auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">➕ Registrar Nuevo Producto</h4>
        </div>
        <div class="card-body">
            
            <?php if(!empty($mensaje)): ?>
                <div class="alert alert-danger">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio ($)</label>
                        <input type="number" step="0.01" name="precio" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Inicial</label>
                        <input type="number" name="stock" class="form-control" placeholder="0" required>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">💾 Guardar Producto</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>