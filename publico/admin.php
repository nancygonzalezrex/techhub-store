<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../app/modelos/Producto.php";

$productoModelo = new Producto();
$productos = $productoModelo->obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Panel de Administración</h1>

    <a href="index.php" class="btn btn-secondary mb-3">Volver al catálogo</a>
    <a href="crear_producto.php" class="btn btn-success mb-3">Crear producto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = $productos->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td>$<?php echo $row['precio']; ?></td>
                    <td>
                        <a href="editar_producto.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>