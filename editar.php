<?php
include 'conexion.php';

// 1. Obtener el ID y los datos actuales del producto
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_OBJ);

// Si no existe producto, volver al inicio
if (!$producto) {
    header('Location: index.php');
    exit;
}

$mensaje = "";

// 2. Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // VALIDACIONES
    if (empty($nombre) || $precio <= 0 || $stock < 0) {
        $mensaje = "⚠️ Error: Verifique que el precio sea mayor a 0 y el stock no sea negativo.";
    } else {
        try {
            $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $precio, $stock, $id]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $mensaje = "Error al actualizar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card shadow" style="max-width: 600px; margin: auto;">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">✏️ Editar Producto: <?= $producto->nombre ?></h4>
        </div>
        <div class="card-body">
            
            <?php if(!empty($mensaje)): ?>
                <div class="alert alert-danger"><?= $mensaje ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= $producto->nombre ?>" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio ($)</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="<?= $producto->precio ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="<?= $producto->stock ?>" required>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning">🔄 Actualizar Producto</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>