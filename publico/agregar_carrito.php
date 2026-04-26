<?php
session_start();

require_once __DIR__ . "/../app/modelos/Carrito.php";

$id = $_GET['id'] ?? null;
$nombre = $_GET['nombre'] ?? '';
$descripcion = $_GET['descripcion'] ?? '';
$precio = $_GET['precio'] ?? 0;

if ($id != null) {
    $carrito = new Carrito();
    $carrito->agregarProducto($id, $nombre, $descripcion, $precio);
}

header("Location: index.php");
exit;