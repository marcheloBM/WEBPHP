<?php

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['btnAccion']) && $_GET['btnAccion'] === 'Eliminar') {
    if (isset($_GET['idte'])) {
        $idTecnicoAEliminar = $_GET['idte'];

        // Coloca un mensaje de prueba
        //echo "Eliminando técnico con ID $idTecnicoAEliminar";
        
        $actualizacion = eliminarTecnico($idTecnicoAEliminar);
         
            if ($actualizacion) {
				//echo "Error al actualizar usuario<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Eliminar Tecnico. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige al usuario a la página de login
				header("Location: ../Admin/MantenedorTec.php");
                exit;
                
            } else {
                //echo "Usuario actualizado correctamente<br>";
				
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Tecnico Eliminado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 1, "/");

				// Redirige al usuario a la página de login
				header("Location: ../Admin/MantenedorTec.php");
                exit;
            }
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó
    if (isset($_POST['btnActualizarTecnico'])) {
        // Lógica para el botón "Actualizar"
        //echo "Botón Actualizar presionado<br>";
        
        // Recupera los datos del formulario (ajusta según tus campos)
        $idtecn = $_POST['idtecn'];
        $especi = $_POST['txtespeci'];
        $celular = $_POST['txtcelular'];
        $correo = $_POST['txtcorreo'];
        $experiencia = $_POST['txtexperiencia'];
        $estado = $_POST['opcEstado'];
        $id = $_POST['idUsuario'];
        
        //echo "idtecnico:$idtecn<br> especialidad:$especi<br> celular:$celular<br> correo:$correo<br> experiencia:$experiencia<br> estado:$estado<br> idusuario:$id<br>";
        $actualizacion = actualizarTecnico($idtecn, $especi, $celular, $correo, $experiencia, $estado);
         
            if ($actualizacion) {
				//echo "Error al actualizar usuario<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Tecnico. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige al usuario a la página de login
				header("Location: ../Admin/TecnicoUpdate.php?id=$id");
                exit;
                
            } else {
                //echo "Usuario actualizado correctamente<br>";
				
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Tecnico Actualizado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 1, "/");

				// Redirige al usuario a la página de login
				header("Location: ../Admin/TecnicoUpdate.php?id=$id");
                exit;
            }
        
        
    } elseif (isset($_POST['RegistrarTec'])) {
        // Lógica para el botón "Actualizar"
        //echo "Botón Registrar Tecnico presionado<br>";
        
        // Recupera los datos del formulario (ajusta según tus campos)
        $correo = $_POST['txtcorreo'];
        $celular = $_POST['txtcelular'];
        $especialidad = $_POST['txtespecialidad'];
        $experiencia = $_POST['txtexperiencia'];
        $activa = '1';
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
		
        // Intenta registrar al usuario
            $registroExitoso = insertarTec($correo, $celular, $especialidad, $experiencia, $activa, $id_usuario);

            if ($registroExitoso) {
                //echo "Usuario registrado correctamente<br>";
                // Eliminar el valor asociado a $_SESSION['datos']
                unset($_SESSION['id_usuario']);
                
                // En el primer script
                setcookie("mensaje", "Tecnico Registrado Correctamente.", time() + 1, "/");
                setcookie("tipo", "success", time() + 1, "/");
                
    			// Redirige al usuario a la página de login
    			header("Location: ../Admin/MantenedorTec.php");
    			exit;

            } else {
                //echo "Error al registrar usuario<br>";
                // En el primer script
                setcookie("mensaje", "Error al Registrar Tecnico. Verifica tus datos.", time() + 1, "/");
                setcookie("tipo", "danger", time() + 1, "/");
    			// Redirige al usuario a la página de login
    			header("Location: ../Admin/AgregarUsuario.php");

    			exit;

            }
        
    } elseif (isset($_POST['btn'])) {
		
    } elseif (isset($_POST['btn'])) {
		
	} elseif (isset($_POST['btn'])){

        // Lógica para el botón "Buscar"
        echo "Botón Buscar presionado";

    }

}
function insertarTec($correo, $celular, $especialidad, $experiencia, $activa, $id) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    $stmt = $conexionBD->conexion->prepare("INSERT INTO tecnico(correo, celular, especialidad, experiencia, activo, usuario_idusuario) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssii", $correo, $celular, $especialidad, $experiencia, $activa,  $id);
    $resultado = $stmt->execute();



    // Cierra la conexión después de usarla

    $stmt->close();

    return $resultado;

}

function eliminarTecnico($idtecn) {

    $conexionBD = new ConexionBD();
    

    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE tecnico SET activo=0 WHERE idtecnico=?");
    $stmt->bind_param("i",$idtecn);
    $stmt->execute();
    $stmt->close();

    // Cerrar la conexión
    $conexionBD->cerrarConexion();

}
function actualizarTecnico($idtecn, $especi, $celular, $correo, $experiencia, $estado) {

    $conexionBD = new ConexionBD();
    

    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE tecnico SET correo=?, celular=?, especialidad=?, experiencia=?, activo=? WHERE idtecnico=?");
    $stmt->bind_param("sssiii", $correo, $celular, $especi, $experiencia, $estado, $idtecn);
    $stmt->execute();
    $stmt->close();

    // Cerrar la conexión
    $conexionBD->cerrarConexion();

}
function leerTecAll(){

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT u.idusuario as idu,u.rut as rut,u.nombre as nombre,u.apellido as apellido ,
    t.idtecnico as idt,t.correo as correo,t.celular as celular,t.especialidad as especialidad,t.experiencia as experiencia,t.activo as activo from usuario u join tecnico t on u.idusuario = t.usuario_idusuario");
    // Vincular el parámetro
    //$stmt->bind_param("i", $idtecnico); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $tecnicos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idu,  $rut, $nombre, $apellido, 
                           $idt,  $correo, $celular, $especialidad, $experiencia, $activo);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $tecnicos[] = [
            'idu' => $idu, 
            'rut' => $rut, 
            'nombre' => $nombre, 
            'apellido' => $apellido,
            
            'idt' => $idt, 
            'correo' => $correo, 
            'celular' => $celular, 
            'especialidad' => $especialidad,
            'experiencia' => $experiencia,
            'activo' => $activo
        ];
    }
    
    // Cerrar la consulta
    $stmt->close();

    return $tecnicos;
}

function listarTecnicoUsuario($idtecnico){

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT tecnico.idtecnico, tecnico.correo, tecnico.celular, tecnico.especialidad, tecnico.experiencia, tecnico.activo, usuario.idusuario, usuario.rut, usuario.pass, usuario.nombre, usuario.apellido, usuario.tipousuario FROM tecnico JOIN usuario ON tecnico.usuario_idusuario = usuario.idusuario WHERE tecnico.idtecnico = ?");
    // Vincular el parámetro
    $stmt->bind_param("i", $idtecnico); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $tecnicos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idtecnico,  $correo, $celular, $especialidad, $experiencia, $activo, 
                           $idusuario,  $rut, $pass, $nombre, $apellido, $tipousuario);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $tecnicos[] = [
            'idtecnico' => $idtecnico, 
            'correo' => $correo, 
            'celular' => $celular, 
            'especialidad' => $especialidad,
            'experiencia' => $experiencia,
            'activo' => $activo,
            
            'idusuario' => $idusuario, 
            'rut' => $rut, 
            'pass' => $pass, 
            'nombre' => $nombre,
            'apellido' => $apellido,
            'tipousuario' => $tipousuario
        ];
    }
    
    // Cerrar la consulta
    $stmt->close();

    return $tecnicos;
}

function listarTecnicoUsuarioIdUsuario($idusuario) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT tecnico.idtecnico, tecnico.correo, tecnico.celular, tecnico.especialidad, tecnico.experiencia, tecnico.activo, usuario.idusuario, usuario.rut, usuario.pass, usuario.nombre, usuario.apellido, usuario.tipousuario 
    FROM tecnico JOIN usuario ON tecnico.usuario_idusuario = usuario.idusuario 
    WHERE usuario.idusuario= ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idtecnico,  $correo, $celular, $especialidad, $experiencia, $activo, 
                           $idusuario,  $rut, $pass, $nombre, $apellido, $tipousuario);
        $stmt->fetch();

        // Cierra la conexión después de usarla
        $conexionBD->cerrarConexion();
		
		return [
            'idtecnico' => $idtecnico, 
            'correo' => $correo, 
            'celular' => $celular, 
            'especialidad' => $especialidad,
            'experiencia' => $experiencia,
            'activo' => $activo,
            
            'idusuario' => $idusuario, 
            'rut' => $rut, 
            'pass' => $pass, 
            'nombre' => $nombre,
            'apellido' => $apellido,
            'tipousuario' => $tipousuario];

    }
	
    // Cierra la conexión después de usarla
    $conexionBD->cerrarConexion();
	
	return false;
}
function listarTecnicoUsuarioAll() {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT tecnico.idtecnico, tecnico.correo, tecnico.celular, tecnico.especialidad, tecnico.experiencia, tecnico.activo,
       usuario.idusuario, usuario.rut, usuario.pass, usuario.nombre, usuario.apellido, usuario.tipousuario
	   FROM tecnico
	   JOIN usuario ON tecnico.usuario_idusuario = usuario.idusuario WHERE tecnico.activo=1");
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $tecnicos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idtecnico,  $correo, $celular, $especialidad, $experiencia, $activo, 
                           $idusuario,  $rut, $pass, $nombre, $apellido, $tipousuario);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $tecnicos[] = [
            'idtecnico' => $idtecnico, 
            'correo' => $correo, 
            'celular' => $celular, 
            'especialidad' => $especialidad,
            'experiencia' => $experiencia,
            'activo' => $activo,
            
            'idusuario' => $idusuario, 
            'rut' => $rut, 
            'pass' => $pass, 
            'nombre' => $nombre,
            'apellido' => $apellido,
            'tipousuario' => $tipousuario
        ];

    }
	
	
	// Cerrar la consulta
    $stmt->close();

    return $tecnicos;
}






?>