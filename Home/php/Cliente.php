<?php

require_once 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó
    if (isset($_POST['btnActualizarClien'])) {
		// Lógica para el botón "Actualizar"
        //echo "Botón Actualizar Cliente<br>";
		
		$direccion = $_POST['txtdireccion'];
        $celular = $_POST['txtcelular'];
        $correo = $_POST['txtcorreo'];
		// Inicia la sesión si no está iniciada
		session_start();
		
		$idusuario = $_SESSION['idusuario'];
        $cliente = cargarCliente($idusuario);
        $idcliente = $cliente['idcliente'];
        //print "ID de Usuario: {$cliente['idcliente']} ";
        
		$actualizacion = actualizarCliente($direccion, $celular, $correo, $idcliente);
		
		if ($actualizacion) {
				//echo "Error al Actualizar Cliente<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Cliente. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 2, "/");
				// Redirige página
				header("Location: ../Cliente/ClienteUpdate.php");
				exit;
				
            } else {
				//echo "Cliente actualizado correctamente<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Cliente Actualizado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 2, "/");
				// Redirige página
				header("Location: ../Cliente/ClienteUpdate.php");
				exit;
            }
		
    } elseif (isset($_POST['btnRegistrarClien'])) {
        // Lógica para el botón "Registrar"
        //echo "Botón Registrar presionado<br>";

        // Recupera los datos del formulario (ajusta según tus campos)
        $rut = $_POST['txtrut'];
        $direccion = $_POST['txtdireccion'];
        $celular = $_POST['txtcelular'];
        $correo = $_POST['txtcorreo'];
        
        $registroExitoso = insertarCliente($rut, $direccion, $celular, $correo);

            if ($registroExitoso) {

                //echo "Usuario registrado correctamente<br>";

                // En el primer script

                setcookie("mensaje", "Usuario Registrado Correctamente.", time() + 1, "/");

                setcookie("tipo", "success", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../login.php");

    			exit;

            } else {

                //echo "Error al registrar usuario<br>";

                // En el primer script

                setcookie("mensaje", "Error al Registrar Usuario. Verifica tus datos.", time() + 1, "/");

                setcookie("tipo", "danger", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../login.php");

    			exit;

            }
		
    } elseif (isset($_POST['btnRegistrarClienteTec'])) {
        // Lógica para el botón "Registrar"
        //echo "Botón Registrar Cliente Tecnico presionado<br>";
		
        session_start();
        // Recupera los datos del formulario (ajusta según tus campos)
        $rutusuario = $_SESSION['rut_usuario'];
        $direccion = $_POST['txtdireccion'];
        $celular = $_POST['txtcelular'];
        $correo = $_POST['txtcorreo'];
        
        $registroExitoso = insertarCliente($rutusuario, $direccion, $celular, $correo);

            if ($registroExitoso) {

                //echo "Usuario registrado correctamente<br>";

                // En el primer script

                setcookie("mensaje", "Usuario Registrado Correctamente.", time() + 1, "/");

                setcookie("tipo", "success", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../HomeTecnico.php");

    			exit;

            } else {

                //echo "Error al registrar usuario<br>";

                // En el primer script

                setcookie("mensaje", "Error al Registrar Usuario. Verifica tus datos.", time() + 1, "/");

                setcookie("tipo", "danger", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../Tecnico/AgregarCliente.php");

    			exit;

            }
        
    } elseif (isset($_POST['btn'])) {
		
	} elseif (isset($_POST['btn'])){

        // Lógica para el botón "Buscar"
        echo "Botón Buscar presionado";

    }

	

}

function listarClienteUsuario($idusuario) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT c.idcliente, c.direccion, c.celular, c.correo, u.rut, u.pass, u.nombre, u.apellido, u.tipousuario FROM cliente c JOIN usuario u ON c.usuario_idusuario = u.idusuario WHERE idcliente = ?");
    // Vincular el parámetro
    $stmt->bind_param("i", $idusuario); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $clientes = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idcliente,  $direccion, $celular, $correo, $rut, $pass, $nombre, $apellido, $tipousuario);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $clientes[] = [
            'idcliente' => $idcliente, 
            'direccion' => $direccion, 
            'celular' => $celular, 
            'correo' => $correo, 
            'rut' => $rut, 
            'pass' => $pass, 
            'nombre' => $nombre, 
            'apellido' => $apellido, 
            'tipousuario' => $tipousuario
        ];
    }
    
    // Cerrar la consulta
    $stmt->close();

    return $clientes;
}
function listarClienteAll() {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT u.idusuario, u.rut, u.pass, u.nombre, u.apellido, u.tipousuario, c.idcliente, c.direccion, c.celular, c.correo FROM usuario u JOIN cliente c ON u.idusuario = c.usuario_idusuario");
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $clientes = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result( $idusuario,  $rut, $pass, $nombre, $apellido, $tipousuario, $idcliente,  $direccion, $celular, $correo);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $clientes[] = [
            'idusuario' => $idusuario, 
            'rut' => $rut, 
            'pass' => $pass, 
            'nombre' => $nombre,
            'apellido' => $apellido,
            'tipousuario' => $tipousuario,
            
            'idcliente' => $idcliente, 
            'direccion' => $direccion, 
            'celular' => $celular, 
            'correo' => $correo
        ];

    }
	
	
	// Cerrar la consulta
    $stmt->close();

    return $clientes;
}

function insertarCliente($rut, $direccion, $celular, $correo){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    // Consulta SQL para obtener el ID del usuario con el rut proporcionado
    $stmt = $conexionBD->conexion->prepare("SELECT idusuario FROM usuario WHERE rut = ?");
    $stmt->bind_param("s", $rut); 
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Vincula los resultados a variables
        $stmt->bind_result($idUsuario);
        
        // Si se encuentra el usuario, obtén el ID
        $row = $stmt->fetch();

        // Puedes usar $idUsuario en tu inserción de cliente
        //echo "ID del usuario: " . $idUsuario;
        $stmt = $conexionBD->conexion->prepare("INSERT INTO cliente(direccion, celular, correo, usuario_idusuario) VALUES (?,?,?,?)");

        $stmt->bind_param("sssi", $direccion, $celular, $correo, $idUsuario);

        $resultado = $stmt->execute();
        // Cierra la conexión después de usarla

        $stmt->close();

        return $resultado;
    }
    
    // Cierra la conexión después de usarla
    $conexionBD->cerrarConexion();
	
	return false;
}

function hayDatosCliente($idusuario){
	// Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idcliente, direccion, celular, correo, usuario_idusuario FROM cliente WHERE usuario_idusuario = ?");
    $stmt->bind_param("i", $idusuario); 
    $stmt->execute();
    $stmt->store_result();
	// Verificar si se obtuvieron filas
	$hayDatos = ($stmt->num_rows > 0);

	// Cerrar la consulta
	$conexionBD->cerrarConexion();
	
	return $hayDatos;
}

function actualizarCliente($direccion, $celular, $correo, $idcliente){

    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE cliente SET direccion=?, celular=?, correo=? WHERE idcliente=?");
    $stmt->bind_param("sssi", $direccion, $celular, $correo, $idcliente);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();

}

function cargarCliente($idusuario) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idcliente, direccion, celular, correo, usuario_idusuario FROM cliente WHERE usuario_idusuario = ?");
    $stmt->bind_param("i", $idusuario); 
    $stmt->execute();
    $stmt->store_result();
	
	if ($stmt->num_rows > 0) {
        $stmt->bind_result($idcliente,  $direccion, $celular, $correo, $usuario_idusuario);
        $stmt->fetch();

        // Cierra la conexión después de usarla
        $conexionBD->cerrarConexion();
		
		return [
            'idcliente' => $idcliente, 
            'direccion' => $direccion, 
            'celular' => $celular, 
            'correo' => $correo, 
            'usuario_idusuario' => $usuario_idusuario];

    }
	
    // Cierra la conexión después de usarla
    $conexionBD->cerrarConexion();
	
	return false;
}

?>