<?php
include '../config/conexion.php'; // Agrega ../ para salir de la carpeta views
// Consulta segura que permitira traer los productos
$query = $pdo->query("SELECT * FROM productos");
$productos = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario STE Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📦 Inventario STE Network Solutions</h1>
        <a href="crear.php" class="btn btn-primary">➕ Nuevo Producto</a>
    </div>
    
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($productos) > 0): ?>
                        <?php foreach($productos as $p): ?>
                        <tr>
                            <td><?= $p->id ?></td>
                            <td><?= $p->nombre ?></td>
                            <td>$<?= number_format($p->precio, 2) ?></td>
                            <td>
                                <span class="badge bg-<?= $p->stock < 5 ? 'danger' : 'success' ?>">
                                    <?= $p->stock ?> un.
                                </span>
                            </td>
                            <td>
                                <a href="editar.php?id=<?= $p->id ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <a href="../actions/eliminar.php?id=<?= $p->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">🗑️ Eliminar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>