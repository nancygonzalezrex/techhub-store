<?php
require_once __DIR__ . "/../modelos/Producto.php";

class ProductoControlador {

    public function listar() {
        $producto = new Producto();
        $datos = $producto->obtenerProductos();

       include __DIR__ . "/../vistas/productos.php";
    }
}