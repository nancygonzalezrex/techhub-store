<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../app/modelos/Producto.php";

$mensaje = "";

if ($_POST) {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);

    if (empty($nombre) || empty($descripcion) || empty($precio)) {
        $mensaje = "Todos los campos son obligatorios.";

    } elseif (!is_numeric($precio) || $precio <= 0) {
        $mensaje = "El precio debe ser un número mayor a 0.";

    } else {

        $productoModelo = new Producto();

        if ($productoModelo->crearProducto($nombre, $descripcion, $precio)) {
            header("Location: admin.php");
            exit;

        } else {
            $mensaje = "Error al crear producto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Crear producto</h1>

    <?php if ($mensaje != "") { ?>
        <div class="alert alert-danger"><?php echo $mensaje; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre del producto" required>

        <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción" required></textarea>

        <input type="number" name="precio" class="form-control mb-3" placeholder="Precio" required>

        <button class="btn btn-success">Guardar producto</button>
        <a href="admin.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>