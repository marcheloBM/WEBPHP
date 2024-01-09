<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué botón se presionó
    if (isset($_POST['btnIngresar'])) {
        // Lógica para el botón "Ingresar"
		echo "Botón Ingresar presionado";
    } elseif (isset($_POST['btnRegistrar'])) {
        // Lógica para el botón "Registrar"
        echo "Botón Registrar presionado";        
    } elseif (isset($_POST['btnActualizar'])) {
        // Lógica para el botón "Actualizar"
        echo "Botón Actualizar presionado";
    } elseif (isset($_POST['btnBuscar'])) {
        // Lógica para el botón "Buscar"
        echo "Botón Buscar presionado";
    } elseif (isset($_POST['btnCerrarSesion'])) {
        // Lógica para el botón "Cerrar Sesión"
        echo "Botón Cerrar Sesión presionado";
    }
	
}

function listarEquiposCliente($idCliente) {
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    $sql = "SELECT idequipo, marca, modelo, numserie, estado, presupuesto_idpresupuesto, usuario_idusuario FROM equipo WHERE usuario_idusuario = '$idCliente' ORDER BY idequipo DESC";

    $result = $conexionBD->conexion->prepare($sql);

        $equipos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $equipos[] = $row;
            }
        }

        return $equipos;
    }
?>