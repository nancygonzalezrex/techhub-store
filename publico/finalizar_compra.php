<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
    header("Location: ver_carrito.php");
    exit;
}

require_once __DIR__ . "/../app/modelos/Orden.php";

$ordenModelo = new Orden();

$ordenModelo->crearOrden(
    $_SESSION['usuario']['id'],
    $_SESSION['carrito']
);

unset($_SESSION['carrito']);

header("Location: historial.php");
exit;