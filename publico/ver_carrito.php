<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">Carrito de compras</h1>
    <div class="mb-3">
    <a href="index.php" class="btn btn-secondary">Volver al catálogo</a>

    <a href="vaciar_carrito.php" class="btn btn-danger">
        Vaciar carrito
    </a>
</div>

    <?php if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) { ?>

        <div class="alert alert-warning">
            El carrito está vacío.
        </div>

    <?php } else { ?>

        <table class="table table-bordered">
            <thead>
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

        <h4>Total: $<?php echo $total; ?></h4>
        <a href="finalizar_compra.php" class="btn btn-primary">
    Finalizar compra
</a>

    <?php } ?>

</div>

</body>
</html>