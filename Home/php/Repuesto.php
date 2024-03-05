<?php

require_once 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó
    if (isset($_POST['btnAgregarRepu'])) {
        // Lógica para el botón "Aceptar"
        //echo "Botón Aceptar Repuesto<br>";
        
        $nombre = $_POST['txtnombre'];
        $descripcion = $_POST['txtdescripcion'];
        $precio = $_POST['txtprecio'];
        
        //echo "$nombre<br>$descripcion<br>$precio<br>$idequipo<br>";
        $registroExitoso = insertarRepuesto($nombre, $descripcion, $precio);
        
        if ($registroExitoso['resultado']) {
            //echo "Usuario registrado correctamente<br>";
            
            // El equipo se insertó correctamente
            $idrepuesto = $registroExitoso['idrepuesto'];
            
            session_start();
            // Tu lógica para definir y almacenar el dato en la sesión
            $_SESSION['id_repuesto'] = $idrepuesto;
            
            // En el primer script
            setcookie("mensaje", "Equipo Registrado Correctamente.", time() + 1, "/");
            setcookie("tipo", "success", time() + 1, "/");
            
            // Redirige al usuario a la página de login
            header("Location: ../Tecnico/AgregarPresupuestos.php");
            
            exit;

            } else {
            //echo "Error al registrar usuario<br>";
            
            // En el primer script
            setcookie("mensaje", "Error al Registrar Equipo. Verifica tus datos.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");
            
            // Redirige al usuario a la página de login
            header("Location: ../Tecnico/AgregarPresupuestos.php");
            
            exit;

            }        
        
    } elseif (isset($_POST['btn'])) {
		
    } elseif (isset($_POST['btn'])) {
		
    } elseif (isset($_POST['btn'])) {
		
	} elseif (isset($_POST['btn'])){

        // Lógica para el botón "Buscar"
        echo "Botón Buscar presionado";

    }

	

}

function insertarRepuesto($nombre, $descripcion, $precio) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)

    $conexionBD = new ConexionBD();
    
    $stmt = $conexionBD->conexion->prepare("INSERT INTO repuesto(nombre, descripcion, precio) VALUES (?,?,?)");

    $stmt->bind_param("sss", $nombre, $descripcion, $precio);

    $resultado = $stmt->execute();

    // Obtener el ID del equipo recién insertado
    $idrepuesto = $conexionBD->conexion->insert_id;
    
    // Cierra la conexión después de usarla
    $stmt->close();

    //return $resultado;
    // Devolver tanto el resultado como el ID del repuesto
    return array('resultado' => $resultado, 'idrepuesto' => $idrepuesto);
}

function listarRepuesto($idrepuesto){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idrepuesto, nombre, descripcion, precio FROM repuesto WHERE idrepuesto = ?");
    // Vincular el parámetro
    $stmt->bind_param("i", $idrepuesto);
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $repuestos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idrepuesto,  $nombre, $descripcion, $precio);

    // Obtener los resultados
    while ($stmt->fetch()) {
        $repuestos[] = [
            'idrepuesto' => $idrepuesto, 
            'nombre' => $nombre, 
            'descripcion' => $descripcion, 
            'precio' => $precio
        ];
	}
	
    // Cerrar la consulta
    $stmt->close();

    return $repuestos;
}

?>