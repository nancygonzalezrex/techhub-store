<?php
require_once __DIR__ . "/../app/modelos/Producto.php";

$texto = $_GET['texto'] ?? '';
$filtro = $_GET['filtro'] ?? 'todos';

$producto = new Producto();
$datos = $producto->buscarProductosConFiltro($texto, $filtro);

while ($row = $datos->fetch_assoc()) {
    echo '
    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card card-producto p-3">
            <div class="card-body">
                <h5 class="card-title">' . $row['nombre'] . '</h5>
                <p class="card-text text-muted">' . $row['descripcion'] . '</p>
                <p class="precio"><strong>$' . $row['precio'] . '</strong></p>

                <a 
                    href="/techhub_store/publico/agregar_carrito.php?id=' . $row['id'] . '&nombre=' . urlencode($row['nombre']) . '&descripcion=' . urlencode($row['descripcion']) . '&precio=' . $row['precio'] . '" 
                    class="btn btn-primary w-100"
                >
                    Agregar al carrito
                </a>
            </div>
        </div>
    </div>
    ';
}