<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras - TechHub Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/techhub_store/publico/css/estilos.css">
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">Carrito de compras</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
        <a href="index.php" class="btn btn-secondary">
            Volver al catálogo
        </a>

        <a href="vaciar_carrito.php" class="btn btn-danger">
            Vaciar carrito
        </a>
    </div>

    <?php if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) { ?>

        <div class="alert alert-warning text-center">
            El carrito está vacío.
        </div>

    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $producto) { 
                        $total += $producto['precio'];
                    ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['descripcion']; ?></td>
                            <td>$<?php echo $producto['precio']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="card p-3 shadow-sm border-0">
            <h4 class="text-center mb-3">
                Total: $<?php echo $total; ?>
            </h4>

            <a href="finalizar_compra.php" class="btn btn-primary w-100">
                Finalizar compra
            </a>
        </div>

    <?php } ?>

</div>

</body>
</html>