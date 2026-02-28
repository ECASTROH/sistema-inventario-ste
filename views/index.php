<?php
include '../config/conexion.php'; // Conexión y herramientas de seguridad

// Consulta optimizada
$query = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
$productos = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario PRO | STE Network Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-box-seam"></i> STE Network Solutions
            </a>
            <span class="navbar-text text-white">Sistema de Gestión v1.0</span>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary"><i class="bi bi-list-check"></i> Listado de Productos</h2>
            <a href="crear.php" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-lg"></i> Nuevo Producto
            </a>
        </div>

        <div class="card shadow border-0">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($productos) > 0): ?>
                            <?php foreach($productos as $p): ?>
                            <tr>
                                <td>#<?= h($p->id) ?></td>
                                <td class="fw-bold"><?= h($p->nombre) ?></td>
                                <td class="text-muted small"><?= h($p->descripcion) ?></td>
                                <td class="text-success fw-bold">$<?= number_format($p->precio, 2) ?></td>
                                <td>
                                    <?php if($p->stock == 0): ?>
                                        <span class="badge bg-danger">Agotado</span>
                                    <?php elseif($p->stock < 10): ?>
                                        <span class="badge bg-warning text-dark">Bajo Stock (<?= h($p->stock) ?>)</span>
                                    <?php else: ?>
                                        <span class="badge bg-success"><?= h($p->stock) ?> un.</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="editar.php?id=<?= $p->id ?>" class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../actions/eliminar.php?id=<?= $p->id ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('¿⚠️ ESTÁS SEGURO?\n\nEsta acción eliminará el producto permanentemente.')" 
                                           title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    No hay productos registrados aún.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <footer class="mt-5 text-center text-muted small">
            &copy; 2026 STE Network Solutions - Desarrollado por Eduardo Castro
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>