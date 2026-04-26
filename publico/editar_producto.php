<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../app/modelos/Producto.php";

$productoModelo = new Producto();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin.php");
    exit;
}

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

        if ($productoModelo->editarProducto($id, $nombre, $descripcion, $precio)) {
            header("Location: admin.php");
            exit;

        } else {
            $mensaje = "Error al editar producto.";
        }
    }
}

$producto = $productoModelo->obtenerProductoPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">Editar producto</h1>

    <?php if ($mensaje != "") { ?>
        <div class="alert alert-danger">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <input 
            type="text"
            name="nombre"
            class="form-control mb-3"
            value="<?php echo $producto['nombre']; ?>"
            required
        >

        <textarea 
            name="descripcion"
            class="form-control mb-3"
            required
        ><?php echo $producto['descripcion']; ?></textarea>

        <input 
            type="number"
            name="precio"
            class="form-control mb-3"
            value="<?php echo $producto['precio']; ?>"
            required
        >

        <button class="btn btn-warning">
            Guardar cambios
        </button>

        <a href="admin.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>