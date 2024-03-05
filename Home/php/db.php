<?php
class ConexionBD {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $bd = "id20529133_marchelobm";
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->bd);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>