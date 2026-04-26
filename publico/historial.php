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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras - TechHub Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/techhub_store/publico/css/estilos.css">
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">Historial de compras</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
        <a href="index.php" class="btn btn-secondary">
            Volver al catálogo
        </a>
    </div>

    <?php if ($ordenes->num_rows == 0) { ?>

        <div class="alert alert-warning text-center">
            No tienes compras registradas.
        </div>

    <?php } else { ?>

        <?php while ($orden = $ordenes->fetch_assoc()) { ?>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-dark text-white">
                    <div class="row text-center text-md-start">
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <strong>Compra #<?php echo $orden['id']; ?></strong>
                        </div>

                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            Fecha: <?php echo $orden['fecha']; ?>
                        </div>

                        <div class="col-12 col-md-4">
                            Total: $<?php echo $orden['total']; ?>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="mb-3">Productos:</h5>

                    <ul class="list-group">
                        <?php
                        $detalles = $ordenModelo->obtenerDetalle($orden['id']);

                        while ($detalle = $detalles->fetch_assoc()) {
                        ?>
                            <li class="list-group-item">
                                <strong><?php echo $detalle['nombre_producto']; ?></strong><br>
                                <span class="text-muted">
                                    <?php echo $detalle['descripcion']; ?>
                                </span><br>
                                <strong>$<?php echo $detalle['precio']; ?></strong>
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