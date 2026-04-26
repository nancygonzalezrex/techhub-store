<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../app/modelos/Producto.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $productoModelo = new Producto();
    $productoModelo->eliminarProducto($id);
}

header("Location: admin.php");
exit;