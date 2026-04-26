<?php
session_start();

require_once __DIR__ . "/../app/modelos/Carrito.php";

$carrito = new Carrito();
$carrito->vaciarCarrito();

header("Location: ver_carrito.php");
exit;