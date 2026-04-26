<?php
require_once __DIR__ . "/../../configuracion/database.php";

class Orden {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function crearOrden($usuario_id, $carrito) {
        $total = 0;

        foreach ($carrito as $producto) {
            $total += $producto['precio'];
        }

        $sql = "INSERT INTO ordenes (usuario_id, total) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("id", $usuario_id, $total);
        $stmt->execute();

        $orden_id = $this->conn->insert_id;

        foreach ($carrito as $producto) {
            $descripcion = $producto['descripcion'] ?? '';

            $sqlDetalle = "INSERT INTO detalles_orden 
            (orden_id, producto_id, nombre_producto, descripcion, precio)
            VALUES (?, ?, ?, ?, ?)";

            $stmtDetalle = $this->conn->prepare($sqlDetalle);

            $stmtDetalle->bind_param(
                "iissd",
                $orden_id,
                $producto['id'],
                $producto['nombre'],
                $descripcion,
                $producto['precio']
            );

            $stmtDetalle->execute();
        }

        return true;
    }

    public function obtenerHistorial($usuario_id) {
        $sql = "SELECT * FROM ordenes WHERE usuario_id = ? ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function obtenerDetalle($orden_id) {
        $sql = "SELECT * FROM detalles_orden WHERE orden_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orden_id);
        $stmt->execute();

        return $stmt->get_result();
    }
}