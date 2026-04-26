<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../app/modelos/Orden.php";

$ordenModelo = new Orden();
$ordenes = $ordenModelo->obtenerHistorial($_SESSION['usuario']['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">Historial de compras</h1>

    <a href="index.php" class="btn btn-secondary mb-3">Volver al catálogo</a>

    <?php if ($ordenes->num_rows == 0) { ?>

        <div class="alert alert-warning">
            No tienes compras registradas.
        </div>

    <?php } else { ?>

        <?php while ($orden = $ordenes->fetch_assoc()) { ?>

            <div class="card mb-3">
                <div class="card-header">
                    Compra #<?php echo $orden['id']; ?> |
                    Fecha: <?php echo $orden['fecha']; ?> |
                    Total: $<?php echo $orden['total']; ?>
                </div>

                <div class="card-body">
                    <h5>Productos:</h5>

                    <ul>
                        <?php
                        $detalles = $ordenModelo->obtenerDetalle($orden['id']);
                        while ($detalle = $detalles->fetch_assoc()) {
                        ?>
                           <li>
                            <strong><?php echo $detalle['nombre_producto']; ?></strong><br>
                            <?php echo $detalle['descripcion']; ?><br>
                            $<?php echo $detalle['precio']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        <?php } ?>

    <?php } ?>

</div>

</body>
</html>