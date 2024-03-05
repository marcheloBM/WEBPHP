<?php

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['btnAccion']) && $_GET['btnAccion'] === 'Eliminar') {
    if (isset($_GET['idag'])) {
        $idAgendaEliminar = $_GET['idag'];

        // Coloca un mensaje de prueba
        //echo "Eliminando técnico con ID $idTecnicoAEliminar";
        
        $actualizacion = eliminarAgenda($idAgendaEliminar);
         
            if ($actualizacion) {
				//echo "Error al actualizar usuario<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Eliminar Agenda. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige al usuario a la página de login
				header("Location: ../Admin/MantenedorAgenda.php");
                exit;
                
            } else {
                //echo "Usuario actualizado correctamente<br>";
				
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Agenda Eliminado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 1, "/");

				// Redirige al usuario a la página de login
				header("Location: ../Admin/MantenedorAgenda.php");
                exit;
            }
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó
    if (isset($_POST['btnRegistrarAgenda'])) {
        // Lógica para el botón "Ingresar"
        //echo "Botón Registrar Agenda presionado<br>";
        
        // Recupera los datos del formulario (ajusta según tus campos)
        $fechaHora = $_POST['fechaHora'];
        $descripcion = $_POST['txtdescripcion'];
        $tecnico  = $_POST['opcTec'];
        // Inicia la sesión si no está iniciada
		session_start();
        $idusuario = $_SESSION['idusuario'];
        
        $registroExitoso = registrarAgenda($fechaHora, $descripcion, $tecnico, $idusuario);

            if ($registroExitoso) {

                //echo "Usuario registrado correctamente<br>";

                // En el primer script

                setcookie("mensaje", "Hora Agendada Registrada Correctamente.", time() + 1, "/");

                setcookie("tipo", "success", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../Cliente/HorasAgenda.php");

    			exit;

            } else {

                //echo "Error al registrar usuario<br>";

                // En el primer script

                setcookie("mensaje", "Error al Registrar Hora Agendada. Verifica tus datos.", time() + 1, "/");

                setcookie("tipo", "danger", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../Cliente/AgregarAgenda.php");

    			exit;

            }
        
				
    } elseif (isset($_POST['btnActualizarAgenda'])) {
        // Lógica para el botón "Actualizar"
        //echo "Botón Actualizar Agenda presionado<br>";
		
        // Recupera los datos del formulario (ajusta según tus campos)
        $fechaHora = $_POST['fechaHora'];
        $descripcion = $_POST['txtdescripcion'];
        $tecnico  = $_POST['opcTec'];
        $cliente = $_POST['opcCli'];
        $idagenda = $_POST['idage'];
        //print " {$fechaHora}<br>{$descripcion}<br>{$tecnico}<br>{$cliente}<br>";
        
        $actualizacion = actualizarAgenda($fechaHora, $descripcion, $tecnico, $cliente, $idagenda);
		
		if ($actualizacion) {
				//echo "Error al Actualizar Cliente<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Agenda. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 2, "/");
				// Redirige página
				header("Location: ../Admin/AgendaUpdate.php");
				exit;
				
            } else {
				//echo "Cliente actualizado correctamente<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Agenda Actualizado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 2, "/");
				// Redirige página
				header("Location: ../Admin/MantenedorAgenda.php");
				exit;
            }
        
    } elseif (isset($_POST['btnAgendarHoraAdmin'])) {
		// Lógica para el botón "Agregar"
        //echo "Botón Agregar Ageda Admin presionado";
        
        // Recupera los datos del formulario (ajusta según tus campos)
        $fechaHora = $_POST['fechaHora'];
        $descripcion = $_POST['txtdescripcion'];
        $tecnico  = $_POST['opcTec'];
        $cliente  = $_POST['opcClie'];
        
        $registroExitoso = registrarAgendaAdmin($fechaHora, $descripcion, $tecnico, $cliente);

            if ($registroExitoso) {

                //echo "Usuario registrado correctamente<br>";

                // En el primer script

                setcookie("mensaje", "Hora Agendada Registrada Correctamente.", time() + 1, "/");

                setcookie("tipo", "success", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../Admin/MantenedorAgenda.php");

    			exit;

            } else {

                //echo "Error al registrar usuario<br>";

                // En el primer script

                setcookie("mensaje", "Error al Registrar Hora Agendada. Verifica tus datos.", time() + 1, "/");

                setcookie("tipo", "danger", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../Admin/AgregarAgenda.php");

    			exit;

            }
        
    } elseif (isset($_POST['btnActualizarCliente'])) {
		
	} elseif (isset($_POST['btnBuscar'])){

        // Lógica para el botón "Buscar"
        echo "Botón Buscar presionado";

    }

	

}
function registrarAgendaAdmin($fechahora, $descripcion, $tecnico_idtecnico, $idcliente){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    // Consulta SQL para obtener el ID del usuario con el rut proporcionado
    $stmt = $conexionBD->conexion->prepare("INSERT INTO agenda(fechahora, descripcion, tecnico_idtecnico, cliente_idcliente) VALUES (?,?,?,?)");
    $stmt->bind_param("ssii", $fechahora, $descripcion, $tecnico_idtecnico, $idcliente);
    $resultado = $stmt->execute();

    // Cierra la conexión después de usarla
    $stmt->close();

    return $resultado;
}
function eliminarAgenda($idAgenda) {

    $conexionBD = new ConexionBD();
    

    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("DELETE FROM agenda WHERE idagenda=?");
    $stmt->bind_param("i",$idAgenda);
    $stmt->execute();
    $stmt->close();

    // Cerrar la conexión
    $conexionBD->cerrarConexion();

}
function actualizarAgenda($fechaHora, $descripcion, $tecnico, $cliente, $idagenda){

    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE agenda SET fechahora=?,descripcion=?,tecnico_idtecnico=?,cliente_idcliente=? WHERE idagenda=?");
    $stmt->bind_param("ssiii", $fechaHora, $descripcion, $tecnico, $cliente, $idagenda);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();

}
function listarAgendaID($idagenda) {
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();        
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idagenda, fechahora, descripcion, tecnico_idtecnico, cliente_idcliente FROM agenda WHERE idagenda = ?");
    // Vincular el parámetro
    $stmt->bind_param("i", $idagenda); 
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener el resultado
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idagenda,  $fechahora, $descripcion, $tecnico_idtecnico, $cliente_idcliente);
        $stmt->fetch();

        // Cierra la conexión después de usarla
        $conexionBD->cerrarConexion();
		
		return [
            'idagenda' => $idagenda, 
            'fechahora' => $fechahora, 
            'descripcion' => $descripcion, 
            'tecnico_idtecnico' => $tecnico_idtecnico,
            'cliente_idcliente' => $cliente_idcliente
        ];

    }
	
    // Cierra la conexión después de usarla
    $conexionBD->cerrarConexion();
	
	return false;
    
}
function leerAllAgen() {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("select a.idagenda as idAgenda,a.fechahora as fecha,a.descripcion as descripcion,a.cliente_idcliente as idCliente,a.tecnico_idtecnico as idTecnico,u1.nombre as nombreCli,u1.apellido as apellidoCli,u2.nombre as nombreTec,u2.apellido as apellidoTec from agenda a join cliente c on a.cliente_idcliente = c.idcliente join usuario u1 on u1.idusuario = c.usuario_idusuario join tecnico t on t.idtecnico = a.tecnico_idtecnico join usuario u2 on u2.idusuario = t.usuario_idusuario");
    // Vincular el parámetro
    //$stmt->bind_param("i", $idtecnico); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $agendas = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idAgenda,  $fecha, $descripcion, $idCliente, $idTecnico, $nombreCli, $apellidoCli, $nombreTec, $apellidoTec);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $agendas[] = [
            'idAgenda' => $idAgenda, 
            'fecha' => $fecha, 
            'descripcion' => $descripcion,
            'idCliente' => $idCliente,
            'idTecnico' => $idTecnico,
            'nombreCli' => $nombreCli,
            'apellidoCli' => $apellidoCli,
            'nombreTec' => $nombreTec,
            'apellidoTec' => $apellidoTec            
        ];
    }
    
    // Cerrar la consulta
    $stmt->close();

    return $agendas;
}
function listarAgendaTec($idtecnico) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idagenda, fechahora, descripcion, tecnico_idtecnico, cliente_idcliente FROM agenda WHERE tecnico_idtecnico = ?");
    // Vincular el parámetro
    $stmt->bind_param("i", $idtecnico); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $agendas = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idagenda,  $fechahora, $descripcion, $tecnico_idtecnico, $cliente_idcliente);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $agendas[] = [
            'idagenda' => $idagenda, 
            'fechahora' => $fechahora, 
            'descripcion' => $descripcion, 
            'tecnico_idtecnico' => $tecnico_idtecnico,
            'cliente_idcliente' => $cliente_idcliente
        ];
    }
    
    // Cerrar la consulta
    $stmt->close();

    return $agendas;
}
function registrarAgenda($fechahora, $descripcion, $tecnico_idtecnico, $idusuario){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    // Consulta SQL para obtener el ID del usuario con el rut proporcionado
    $stmt = $conexionBD->conexion->prepare("SELECT idcliente FROM cliente WHERE usuario_idusuario = ?");
    $stmt->bind_param("s", $idusuario); 
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Vincula los resultados a variables
        $stmt->bind_result($idcliente);
        
        // Si se encuentra el usuario, obtén el ID
        $row = $stmt->fetch();

        // Puedes usar $idUsuario en tu inserción de cliente
        //echo "ID del usuario: " . $idUsuario;
        $stmt = $conexionBD->conexion->prepare("INSERT INTO agenda(fechahora, descripcion, tecnico_idtecnico, cliente_idcliente) VALUES (?,?,?,?)");

        $stmt->bind_param("ssii", $fechahora, $descripcion, $tecnico_idtecnico, $idcliente);

        $resultado = $stmt->execute();
        // Cierra la conexión después de usarla

        $stmt->close();

        return $resultado;
    }
    
    // Cierra la conexión después de usarla
    $conexionBD->cerrarConexion();
	
	return false;
}
function listarAgenda($idcliente) {
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();        
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idagenda, fechahora, descripcion, tecnico_idtecnico, cliente_idcliente FROM agenda WHERE cliente_idcliente = ?");
    // Vincular el parámetro
    $stmt->bind_param("i", $idcliente); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $agendas = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idagenda,  $fechahora, $descripcion, $tecnico_idtecnico, $cliente_idcliente);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $agendas[] = [
            'idagenda' => $idagenda, 
            'fechahora' => $fechahora, 
            'descripcion' => $descripcion, 
            'tecnico_idtecnico' => $tecnico_idtecnico,
            'cliente_idcliente' => $cliente_idcliente
        ];

    }
	
	
	// Cerrar la consulta
    $stmt->close();

    return $agendas;
}

?>