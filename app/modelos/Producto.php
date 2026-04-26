<?php
require_once __DIR__ . "/../../configuracion/database.php";

class Producto {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

   public function obtenerProductos() {
    try {
        $sql = "SELECT * FROM productos";
        $resultado = $this->conn->query($sql);

        if (!$resultado) {
            throw new Exception("Error al obtener productos.");
        }

        return $resultado;

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

    public function buscarProductos($texto) {
        $sql = "SELECT * FROM productos 
                WHERE nombre LIKE ? 
                OR descripcion LIKE ?";

        $stmt = $this->conn->prepare($sql);

        $busqueda = "%" . $texto . "%";
        $stmt->bind_param("ss", $busqueda, $busqueda);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function crearProducto($nombre, $descripcion, $precio) {
    try {
        $sql = "INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta para crear producto.");
        }

        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);

        return $stmt->execute();

    } catch (Exception $e) {
        return false;
    }
}

   public function editarProducto($id, $nombre, $descripcion, $precio) {
    try {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta para editar producto.");
        }

        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);

        return $stmt->execute();

    } catch (Exception $e) {
        return false;
    }
}

   public function eliminarProducto($id) {
    try {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta para eliminar producto.");
        }

        $stmt->bind_param("i", $id);

        return $stmt->execute();

    } catch (Exception $e) {
        return false;
    }
}

    public function buscarProductosConFiltro($texto, $filtro) {
    $sql = "SELECT * FROM productos 
            WHERE (nombre LIKE ? OR descripcion LIKE ?)";

    if ($filtro == "menor_20000") {
        $sql .= " AND precio < 20000";
    }

    if ($filtro == "entre_20000_100000") {
        $sql .= " AND precio BETWEEN 20000 AND 100000";
    }

    if ($filtro == "mayor_100000") {
        $sql .= " AND precio > 100000";
    }

    $stmt = $this->conn->prepare($sql);

    $busqueda = "%" . $texto . "%";
    $stmt->bind_param("ss", $busqueda, $busqueda);

    $stmt->execute();

    return $stmt->get_result();
}
}
