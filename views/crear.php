<?php
include '../config/conexion.php';

$error = null;

// Lógica de procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Validaciones de Negocio
    if (empty($nombre) || empty($precio)) {
        $error = "⚠️ El nombre y el precio son obligatorios.";
    } elseif ($stock < 0) {
        $error = "⚠️ El stock no puede ser negativo.";
    } elseif ($precio <= 0) {
        $error = "⚠️ El precio debe ser mayor a 0.";
    } else {
        // Inserción Segura (Prepared Statement)
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $stock]);
        
        // Redirigir al index después de guardar
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto | STE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    
    <div class="container mt-5" style="max-width: 700px;">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Registrar Nuevo Producto</h4>
            </div>
            <div class="card-body">
                
                <?php if($error): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div><?= $error ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control" required placeholder="Ej: Router Mikrotik hAP ac3">
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción Técnica</label>
                        <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalles del equipo..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label fw-bold">Precio ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="precio" class="form-control" required placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label fw-bold">Stock Inicial</label>
                            <input type="number" name="stock" class="form-control" required placeholder="0">
                            <div class="form-text">No se permiten números negativos.</div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>