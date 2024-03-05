<?php

require_once 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó
    if (isset($_POST['btnAceptarPre'])) {
        // Lógica para el botón "Aceptar"
        //echo "Botón Aceptar Presupuesto<br>";
		
		$id = $_POST['id'];	
        
        $actualizacion = registarPresupuestoApro($id);
        
        if ($actualizacion) {
				//echo "Error al Aprobar el presupuesto<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Presupuesto.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige página
				header("Location: ../Cliente/Presupuestos.php?id=$id");
				exit;
				
            } else {
				//echo "Presupuesto actualizado correctamente<br>";
                
                include '../php/Equipo.php';
                
                $id = $_POST['id'];	
                $estado ='Esperando';
                
                $estadoEquipo = actualizarEstado($id,$estado);
            
                if ($actualizacion) {
                    //echo "Error al Actualizar Estado Equipo<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Error al Actualizar Estado Equipo.", time() + 1, "/");
                    setcookie("tipo", "danger", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Cliente/Presupuestos.php?id=$id");
                    exit;

                } else {
                    //echo "Estado Equipo actualizado correctamente<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Presupuesto Actualizado Correctamente.<br> Estado Equipo Actualizado Correctamente.", time() + 1, "/");
                    setcookie("tipo", "success", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Cliente/Presupuestos.php?id=$id");
                    exit;
                }
            }
        
        
        
        
    } elseif (isset($_POST['btnRechazarPre'])) {
        // Lógica para el botón "Rechazar"
        //echo "Botón Rechazar Presupuesto<br>";
		
		$id = $_POST['id'];
        //echo "Rechazar Presupuesto:$id<br>";
        
        $actualizacion = registarPresupuestoRech($id);
        
        if ($actualizacion) {
				//echo "Error al Aprobar el presupuesto<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Presupuesto.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige página
				header("Location: ../Cliente/Presupuestos.php?id=$id");
				exit;
				
            } else {
				//echo "Presupuesto actualizado correctamente<br>";
                
                include '../php/Equipo.php';
                
                $id = $_POST['id'];	
                $estado ='Terminado';
                
                $estadoEquipo = actualizarEstado($id,$estado);
            
                if ($actualizacion) {
                    //echo "Error al Actualizar Estado Equipo<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Error al Actualizar Estado Equipo.", time() + 1, "/");
                    setcookie("tipo", "danger", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Cliente/Presupuestos.php?id=$id");
                    exit;

                } else {
                    //echo "Estado Equipo actualizado correctamente<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Presupuesto Actualizado Correctamente.<br> Estado Equipo Actualizado Correctamente.", time() + 1, "/");
                    setcookie("tipo", "success", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Cliente/Presupuestos.php?id=$id");
                    exit;
                }
            }
        
    } elseif (isset($_POST['btnRegistrarPre'])) {
        // Lógica para el botón "Registrar"
        //echo "Botón Registrar Presupuesto<br>";
        
        session_start();
        // Tu lógica para definir y almacenar el dato en la sesión
        $idrepuesto = $_SESSION['id_repuesto'] ?? null;
        $fechaHoraIng = date("Y-m-d H:i:s");
        $fechaHoraTer = $_POST['fechaHoraTer'];
        $opcTipo = $_POST['opcTipo'];
        $opcEsta = $_POST['opcEsta'];
        $valor = $_POST['txtValor'];
        $descripcion = $_POST['txtdescripcion'];
        
        $registroExitoso = insertarPresupuesto($opcTipo, $fechaHoraIng, $fechaHoraTer, $opcEsta, $descripcion, $valor, $idrepuesto);
        
        if ($registroExitoso['resultado']) {
            //echo "Usuario registrado correctamente<br>";
            
            //Agregar el Modificar equipo
            // El equipo se insertó correctamente
            $idpresupuesto = $registroExitoso['idpresupuesto'];
            $idequipo = $_SESSION['id_equipo'];
            
            // Incluir las clases
            include 'Equipo.php';
            
            $Equipo = actualizarEquipoPresupuesto($idpresupuesto, $idequipo);
            
                if ($Equipo) {
                    //echo "Error al registrar usuario<br>";
            
                    // En el primer script
                    setcookie("mensaje", "Error al Registrar Presupuesto y Equipo. Verifica tus datos.", time() + 1, "/");
                    setcookie("tipo", "danger", time() + 1, "/");

                    // Redirige al usuario a la página de login
                    header("Location: ../Tecnico/AgregarPresupuestos.php");

                    exit;
                }else{
                    // Eliminar el valor asociado a $_SESSION['datos']
                    unset($_SESSION['id_equipo']);
                    unset($_SESSION['id_repuesto']);

                    // En el primer script
                    setcookie("mensaje", "Presupuesto y Equipo Registrado Correctamente.", time() + 1, "/");
                    setcookie("tipo", "success", time() + 1, "/");

                    // Redirige al usuario a la página de login
                    header("Location: ../HomeTecnico.php");

                    exit;
                }
            

            } else {
            //echo "Error al registrar usuario<br>";
            
            // En el primer script
            setcookie("mensaje", "Error al Registrar Presupuesto. Verifica tus datos.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");
            
            // Redirige al usuario a la página de login
            header("Location: ../Tecnico/AgregarPresupuestos.php");
            
            exit;

            }
        
    } elseif (isset($_POST['btnTerminadoPre'])) {
        // Lógica para el botón "Terminar Presupuesto"
        //echo "Presupuesto Terminado correctamente<br>";
		
        $id = $_POST['id'];	
        
        $actualizacion = registarPresupuestoTerminado($id);
        
        if ($actualizacion) {
				//echo "Error al Aprobar el presupuesto<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Presupuesto.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige página
				header("Location: ../Tecnico/PresupuestosTermi.php");
				exit;
				
            } else {
				//echo "Presupuesto actualizado correctamente<br>";
                
                include '../php/Equipo.php';
                
                $id = $_POST['id'];	
                $estado ='Terminado';
                
                $estadoEquipo = actualizarEstado($id,$estado);
            
                if ($actualizacion) {
                    //echo "Error al Actualizar Estado Equipo<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Error al Actualizar Estado Presupuesto.", time() + 1, "/");
                    setcookie("tipo", "danger", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Tecnico/PresupuestosTermi.php");
                    exit;

                } else {
                    //echo "Estado Equipo actualizado correctamente<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Presupuesto Actualizado Correctamente.<br> Estado Equipo Actualizado Correctamente.", time() + 1, "/");
                    setcookie("tipo", "success", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Tecnico/PresupuestosTermi.php");
                    exit;
                }
            }
	} elseif (isset($_POST['AprobarPresupuestoAdmin'])){
        // Lógica para el botón "Aprobar Presupuesto Admin"
        //echo "Botón Aprobar Presupuesto Admin presionado<br>";
        
        $id = $_POST['id'];
        $estado ='Aprobado';
        //echo "ID:$id<br>";
        $actualizacion = estadoPresupuesto($id,$estado);
        
        if ($actualizacion) {
				//echo "Error al Aprobar el presupuesto<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Presupuesto.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige página
				header("Location: ../Admin/Presupuestos.php");
				exit;
				
            } else {
				//echo "Presupuesto actualizado correctamente<br>";
                
                include '../php/Equipo.php';
                
                $id = $_POST['id'];	
                $estado ='En Reparacion';
                
                $estadoEquipo = actualizarEstado($id,$estado);
            
                if ($actualizacion) {
                    //echo "Error al Actualizar Estado Equipo<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Error al Actualizar Estado Presupuesto.", time() + 1, "/");
                    setcookie("tipo", "danger", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Admin/Presupuestos.php");
                    exit;

                } else {
                    //echo "Estado Equipo actualizado correctamente<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Presupuesto Actualizado Correctamente.<br> Estado Equipo Actualizado Correctamente.", time() + 1, "/");
                    setcookie("tipo", "success", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Admin/Presupuestos.php");
                    exit;
                }
            }

    }elseif (isset($_POST['RechazarPresupuestoAdmin'])){
        // Lógica para el botón "Rechazar Presupuesto Admin"
        echo "Botón Rechazar Presupuesto Admin presionado<br>";
        
        $id = $_POST['id'];
        //echo "ID:$id<br>";
        $estado ='Rechazado';
        //echo "ID:$id<br>";
        $actualizacion = estadoPresupuesto($id,$estado);
        
        if ($actualizacion) {
				//echo "Error al Aprobar el presupuesto<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Presupuesto.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige página
				header("Location: ../Admin/Presupuestos.php");
				exit;
				
            } else {
				//echo "Presupuesto actualizado correctamente<br>";
                
                include '../php/Equipo.php';
                
                $id = $_POST['id'];	
                $estado ='Terminado';
                
                $estadoEquipo = actualizarEstado($id,$estado);
            
                if ($actualizacion) {
                    //echo "Error al Actualizar Estado Equipo<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Error al Actualizar Estado Presupuesto.", time() + 1, "/");
                    setcookie("tipo", "danger", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Admin/Presupuestos.php");
                    exit;

                } else {
                    //echo "Estado Equipo actualizado correctamente<br>";

                    // Después de comprobar que hay un error al intentar iniciar sesión
                    setcookie("mensaje", "Presupuesto Actualizado Correctamente.<br> Estado Equipo Actualizado Correctamente.", time() + 1, "/");
                    setcookie("tipo", "success", time() + 1, "/");
                    // Redirige página
                    header("Location: ../Admin/Presupuestos.php");
                    exit;
                }
            }
    }    

	

}
function estadoPresupuesto($id,$estado){
    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE presupuesto SET estado=? WHERE idpresupuesto = ?");
    $stmt->bind_param("si",$estado,$id);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();
}
function leerPreRepAll() {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT p.idpresupuesto, p.tiporeparacion, p.fechaingreso, p.fechatermino, p.estado, p.descripcion, p.valor, r.idrepuesto, r.nombre, r.descripcion as repuesto_descripcion, r.precio
        FROM presupuesto p
        LEFT JOIN repuesto r ON p.repuesto_idrepuesto = r.idrepuesto
        ORDER BY p.idpresupuesto DESC");
    // Vincular el parámetro
    //$stmt->bind_param("i", $idpresupuesto);
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $presupuestos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idpresupuesto,  $tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $idrepuesto, $nombre, $repuesto_descripcion, $precio);

    // Obtener los resultados
    while ($stmt->fetch()) {
        $presupuestos[] = [
            'idpresupuesto' => $idpresupuesto,
            'tiporeparacion' => $tiporeparacion,
            'fechaingreso' => $fechaingreso,
            'fechatermino' => $fechatermino,
            'estado' => $estado,
            'descripcion' => $descripcion,
            'valor' => $valor,
            'idrepuesto' => $idrepuesto,
            'nombre' => $nombre,
            'repuesto_descripcion' => $repuesto_descripcion
        ];
	}
	
    // Cerrar la consulta
    $stmt->close();

    return $presupuestos;
}
function leerPreAll() {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idpresupuesto,tiporeparacion,fechaingreso,fechatermino,estado,descripcion,valor,repuesto_idrepuesto FROM presupuesto where estado='En Proceso' ORDER BY idpresupuesto DESC");
    // Vincular el parámetro
    //$stmt->bind_param("i", $idpresupuesto);
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $presupuestos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idpresupuesto,  $tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $repuesto_idrepuesto);

    // Obtener los resultados
    while ($stmt->fetch()) {
        $presupuestos[] = [
            'idpresupuesto' => $idpresupuesto,
            'tiporeparacion' => $tiporeparacion,
            'fechaingreso' => $fechaingreso,
            'fechatermino' => $fechatermino,
            'estado' => $estado,
            'descripcion' => $descripcion,
            'valor' => $valor,
            'repuesto_idrepuesto' => $repuesto_idrepuesto
        ];
	}
	
    // Cerrar la consulta
    $stmt->close();

    return $presupuestos;
}
function leerPreAll2() {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idpresupuesto,tiporeparacion,fechaingreso,fechatermino,estado,descripcion,valor,repuesto_idrepuesto FROM presupuesto ORDER BY idpresupuesto DESC");
    // Vincular el parámetro
    //$stmt->bind_param("i", $idpresupuesto);
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $presupuestos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idpresupuesto,  $tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $repuesto_idrepuesto);

    // Obtener los resultados
    while ($stmt->fetch()) {
        $presupuestos[] = [
            'idpresupuesto' => $idpresupuesto,
            'tiporeparacion' => $tiporeparacion,
            'fechaingreso' => $fechaingreso,
            'fechatermino' => $fechatermino,
            'estado' => $estado,
            'descripcion' => $descripcion,
            'valor' => $valor,
            'repuesto_idrepuesto' => $repuesto_idrepuesto
        ];
	}
	
    // Cerrar la consulta
    $stmt->close();

    return $presupuestos;
}
function leerPresuEstado(){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT estado, COUNT(*) AS cantidad FROM presupuesto GROUP BY estado");
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $presupuestos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($estado, $cantidad);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $presupuestos[] = [
            'estado' => $estado,
            'cantidad' => $cantidad
        ];

    }

    // Cerrar la consulta
    $stmt->close();

    return $presupuestos;
}
function registarPresupuestoTerminado($id){
    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE presupuesto SET estado='Terminado' WHERE idpresupuesto = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();
}
function listarPresupuestoAllTec(){

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idpresupuesto,tiporeparacion,fechaingreso,fechatermino,estado,descripcion,valor,repuesto_idrepuesto FROM presupuesto where estado='Aprobado' ORDER BY idpresupuesto DESC");
    // Vincular el parámetro
    //$stmt->bind_param("i", $idpresupuesto);
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $presupuestos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idpresupuesto,  $tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $repuesto_idrepuesto);

    // Obtener los resultados
    while ($stmt->fetch()) {
        $presupuestos[] = [
            'idpresupuesto' => $idpresupuesto,
            'tiporeparacion' => $tiporeparacion,
            'fechaingreso' => $fechaingreso,
            'fechatermino' => $fechatermino,
            'estado' => $estado,
            'descripcion' => $descripcion,
            'valor' => $valor,
            'repuesto_idrepuesto' => $repuesto_idrepuesto
        ];
	}
	
    // Cerrar la consulta
    $stmt->close();

    return $presupuestos;
}
function insertarPresupuesto($tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $repuesto_idrepuesto) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)

    $conexionBD = new ConexionBD();
    
    $stmt = $conexionBD->conexion->prepare("INSERT INTO presupuesto(tiporeparacion, fechaingreso, fechatermino, estado, descripcion, valor, repuesto_idrepuesto) VALUES (?,?,?,?,?,?,?)");

    $stmt->bind_param("ssssssi", $tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $repuesto_idrepuesto);

    $resultado = $stmt->execute();
    
    // Obtener el ID del presupuesto recién insertado
    $idpresupuesto = $conexionBD->conexion->insert_id;
    
    // Cierra la conexión después de usarla
    $stmt->close();

    //return $resultado;
    // Devolver tanto el resultado como el ID del equipo
    return array('resultado' => $resultado, 'idpresupuesto' => $idpresupuesto);
}
function registarPresupuestoRech($id){
    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE presupuesto SET estado='Rechazado' WHERE idpresupuesto = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();
}
function registarPresupuestoApro($id){
    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE presupuesto SET estado='En Proceso' WHERE idpresupuesto = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();
}
function listarPresupuesto($idpresupuesto) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idpresupuesto, tiporeparacion, fechaingreso, fechatermino, estado, descripcion, valor, repuesto_idrepuesto FROM presupuesto WHERE idpresupuesto = ?");
    
    // Vincular el parámetro
    $stmt->bind_param("i", $idpresupuesto);

     $stmt->execute();
    // Inicializa un array vacío
    $tecnicos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idpresupuesto,  $tiporeparacion, $fechaingreso, $fechatermino, $estado, $descripcion, $valor, $repuesto_idrepuesto);

    // Obtener los resultados
    while ($stmt->fetch()) {
        $presupuestos[] = [
            'idpresupuesto' => $idpresupuesto,
            'tiporeparacion' => $tiporeparacion,
            'fechaingreso' => $fechaingreso,
            'fechatermino' => $fechatermino,
            'estado' => $estado,
            'descripcion' => $descripcion,
            'valor' => $valor,
            'repuesto_idrepuesto' => $repuesto_idrepuesto
        ];
	}
	
    // Cerrar la consulta
    $stmt->close();

    return $presupuestos;
}

?>