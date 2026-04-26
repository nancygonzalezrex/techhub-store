<?php
class Database {
    private $host = "localhost";
    private $db = "techhub";
    private $user = "root";
    private $pass = "";

    public function conectar() {
        try {
            $conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);

            if ($conexion->connect_error) {
                throw new Exception("Error de conexión: " . $conexion->connect_error);
            }

            $conexion->set_charset("utf8");

            return $conexion;

        } catch (Exception $e) {
            die("Ocurrió un problema al conectar con la base de datos: " . $e->getMessage());
        }
    }
}