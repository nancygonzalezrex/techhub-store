<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/techhub_store/publico/css/estilos.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/techhub_store/publico/index.php">
            TechHub Store
        </a>

        <div class="d-flex gap-2">
            <a href="/techhub_store/publico/ver_carrito.php" class="btn btn-outline-light btn-sm">
                Carrito
                <span class="badge bg-primary">
                    <?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>
                </span>
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <section class="hero">
        <h1>Catálogo de Productos Tecnológicos</h1>
        <p>Encuentra computadores, accesorios y dispositivos para tu día a día.</p>
    </section>

    <div class="acciones-superiores">
        <?php if (isset($_SESSION['usuario'])) { ?>

            <span class="btn btn-light disabled">
                Bienvenido/a, <strong><?php echo $_SESSION['usuario']['nombre']; ?></strong>
            </span>

            <a href="/techhub_store/publico/historial.php" class="btn btn-info">
                Historial
            </a>

            <?php if ($_SESSION['usuario']['rol'] == 'admin') { ?>
                <a href="/techhub_store/publico/admin.php" class="btn btn-warning">
                    Panel Admin
                </a>
            <?php } ?>

            <a href="/techhub_store/publico/logout.php" class="btn btn-danger">
                Cerrar sesión
            </a>

        <?php } else { ?>

            <a href="/techhub_store/publico/login.php" class="btn btn-primary">
                Iniciar sesión
            </a>

            <a href="/techhub_store/publico/registro.php" class="btn btn-secondary">
                Registrarse
            </a>

        <?php } ?>
    </div>

   <div class="busqueda">
    <input 
        type="text"
        id="buscar"
        class="form-control form-control-lg mb-3"
        placeholder="Buscar producto..."
        onkeyup="buscarProducto()"
    >
</div>

    <div class="row g-4" id="resultados">

        <?php while($row = $datos->fetch_assoc()) { ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card card-producto p-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $row['nombre']; ?>
                        </h5>

                        <p class="card-text text-muted">
                            <?php echo $row['descripcion']; ?>
                        </p>

                        <p class="precio">
                            <strong>$<?php echo $row['precio']; ?></strong>
                        </p>

                        <a 
                            href="/techhub_store/publico/agregar_carrito.php?id=<?php echo $row['id']; ?>&nombre=<?php echo urlencode($row['nombre']); ?>&descripcion=<?php echo urlencode($row['descripcion']); ?>&precio=<?php echo $row['precio']; ?>"
                            class="btn btn-primary w-100"
                        >
                            Agregar al carrito
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

</div>

<footer>
    <p>TechHub Store - Proyecto Taller de Aplicaciones para Internet</p>
</footer>

<script src="/techhub_store/publico/js/buscador.js"></script>

</body>
</html>