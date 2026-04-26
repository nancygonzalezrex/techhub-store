<?php

class Carrito {

    public function __construct() {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function agregarProducto($id, $nombre, $descripcion, $precio) {
        $_SESSION['carrito'][] = [
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio
        ];
    }

    public function obtenerProductos() {
        return $_SESSION['carrito'];
    }

    public function contarProductos() {
        return count($_SESSION['carrito']);
    }

    public function calcularTotal() {
        $total = 0;

        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'];
        }

        return $total;
    }

    public function vaciarCarrito() {
        unset($_SESSION['carrito']);
    }
}