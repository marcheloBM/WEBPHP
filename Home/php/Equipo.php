<?php

require_once 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó

    if (isset($_POST['btnAgregarEquipo'])) {

        // Lógica para el botón "Ingresar"
		//echo "Botón Ingresar presionado<br>";
        
        $marca = $_POST['txtmarca'];
        $modelo = $_POST['txtmodelo'];
        $numSerie = $_POST['txtnumSerie'];
        $estado = 'Sin Revision';
        $cliente = $_POST['opcClie'];
        
        //echo "$marca<br>$modelo<br>$numSerie<br>$cliente<br>";
        
        $registroExitoso = insertarEquipo($marca, $modelo, $numSerie, $estado, $cliente);

            if ($registroExitoso['resultado']) {

                //echo "Usuario registrado correctamente<br>";
                
                // El equipo se insertó correctamente
                $idequipo = $registroExitoso['idequipo'];
                
                session_start();
                $_SESSION['id_equipo'] = $idequipo;
                
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

    			header("Location: ../Tecnico/AgregarEquipo.php");

    			exit;

            }

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
function leerPCEstado(){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT estado as tipoEstado, COUNT(*) AS cantidad FROM equipo GROUP BY estado");
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $equipos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($tipoEstado, $cantidad);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $equipos[] = [
            'tipoEstado' => $tipoEstado,
            'cantidad' => $cantidad
        ];

    }

    // Cerrar la consulta
    $stmt->close();

    return $equipos;
}

function listarEquiposAll(){
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("select e.idequipo as idequipo, e.marca as marca, e.modelo as modelo, e.numserie as numserie, e.estado as estado, e.presupuesto_idpresupuesto as idPresupuesto, u.idusuario as idusuario, u.nombre as nombre, u.apellido as apellido from equipo e join usuario u on e.usuario_idusuario = u.idusuario ORDER BY idequipo DESC");
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $equipos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idequipo, $marca, $modelo, $numserie, $estado, $presupuesto_idpresupuesto, $idusuario, $nombre, $apellido);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $equipos[] = [
            'idequipo' => $idequipo,
            'marca' => $marca,
            'modelo' => $modelo,
            'numserie' => $numserie,
            'estado' => $estado,
            'presupuesto_idpresupuesto' => $presupuesto_idpresupuesto,
            'idusuario' => $idusuario,
            'nombre' => $nombre,
            'apellido' => $apellido
        ];

    }
    
    // Imprimir los datos del array para depuración
    //echo "<pre>";
    //var_dump($equipos);
    //echo "</pre>";

    // Cerrar la consulta
    $stmt->close();

    return $equipos;
}

function actualizarEquipoPresupuesto($presupuesto_idpresupuesto, $idequipo) {
    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE equipo SET presupuesto_idpresupuesto = ? WHERE idequipo = ?");
    $stmt->bind_param("ii", $presupuesto_idpresupuesto, $idequipo);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();
}

function insertarEquipo($marca, $modelo, $numSerie, $estado, $cliente) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)

    $conexionBD = new ConexionBD();
    
    $stmt = $conexionBD->conexion->prepare("INSERT INTO equipo(marca, modelo, numserie, estado, usuario_idusuario) VALUES (?,?,?,?,?)");

    $stmt->bind_param("ssssi", $marca, $modelo, $numSerie, $estado, $cliente);

    $resultado = $stmt->execute();

    // Obtener el ID del equipo recién insertado
    $idequipo = $conexionBD->conexion->insert_id;
    
    // Cierra la conexión después de usarla
    $stmt->close();

    //return $resultado;
    // Devolver tanto el resultado como el ID del equipo
    return array('resultado' => $resultado, 'idequipo' => $idequipo);
}

function actualizarEstado($idpresupuesto,$estado){
    $conexionBD = new ConexionBD();
	
    // Actualizar en la tabla usuario
    $stmt = $conexionBD->conexion->prepare("UPDATE equipo SET estado=? WHERE presupuesto_idpresupuesto= ?");
    $stmt->bind_param("ss", $estado, $idpresupuesto);
    $stmt->execute();
    $stmt->close();
	
	// Cerrar la conexión
    $conexionBD->cerrarConexion();
}

function listarEquiposCliente($idCliente) {
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("SELECT idequipo, marca, modelo, numserie, estado, presupuesto_idpresupuesto, usuario_idusuario FROM equipo WHERE usuario_idusuario = ? ORDER BY idequipo DESC");
    // Vincular el parámetro
    $stmt->bind_param("i", $idCliente); 
    // Ejecutar la consulta
    $stmt->execute();
    // Inicializa un array vacío
    $equipos = array();
    // Obtener el resultado
    $stmt->store_result();
    // Vincular las columnas a variables (esto es necesario para usar fetch_assoc)
    $stmt->bind_result($idequipo, $marca, $modelo, $numserie, $estado, $presupuesto_idpresupuesto, $usuario_idusuario);
    // Obtener los resultados
    while ($stmt->fetch()) {
        $equipos[] = [
            'idequipo' => $idequipo,
            'marca' => $marca,
            'modelo' => $modelo,
            'numserie' => $numserie,
            'estado' => $estado,
            'presupuesto_idpresupuesto' => $presupuesto_idpresupuesto,
            'usuario_idusuario' => $usuario_idusuario
        ];

    }
    
    // Imprimir los datos del array para depuración
    //echo "<pre>";
    //var_dump($equipos);
    //echo "</pre>";

    // Cerrar la consulta
    $stmt->close();

    return $equipos;

}



?>