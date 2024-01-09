<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué botón se presionó
    if (isset($_POST['btnIngresar'])) {
        // Lógica para el botón "Ingresar"
		//echo "Botón Ingresar presionado";
		
		// Recupera los datos del formulario (ajusta según tus campos)
        $rut = $_POST['txtrut'];
        $pass = $_POST['txtpass'];
		
        // Supongamos que tienes una función en tu clase DB para verificar las credenciales
        $usuario = verificarCredenciales($rut, $pass);

        if ($usuario) {
            //echo "Usuario encontrado correctamente";
            //echo "ID Usuario: " . $usuario['idusuario'] . "<br>";
            // Inicia la sesión si no está iniciada
            session_start();
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['rut'] = $usuario['rut'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];
            if ($usuario['tipousuario'] == "Administrador") {
                //echo "Inicio Session Administrador";
                $_SESSION['tipo'] = "Administrador";
                header("Location: HomeAdmin.php");
                exit; // Importante: asegúrate de salir después de una redirección
            }

            if ($usuario['tipousuario'] == "Técnico") {
                //echo "Inicio Session Técnico";
                $_SESSION['tipo'] = "Técnico";
                header("Location: HomeTecnico.php");
                exit;
            }

            if ($usuario['tipousuario'] == "Cliente") {
                //echo "Inicio Session Cliente";
                $_SESSION['tipo'] = "Cliente";
                header("Location: ../HomeCliente.php");
                exit;
            }
        } else {
			// Iniciar la sesión
			session_start();
			
			// Después de comprobar que hay un error al intentar iniciar sesión
			$_SESSION['mensaje'] = "Error al iniciar sesión. Verifica tus credenciales.";
			$_SESSION['tipo'] = "danger";

			// Redirige al usuario a la página de login
			header("Location: ../login.php");
			exit();
        }
    
    
    } elseif (isset($_POST['btnRegistrar'])) {
        // Lógica para el botón "Registrar"
        echo "Botón Registrar presionado";
        
        // Recupera los datos del formulario (ajusta según tus campos)
        $rut = $_POST['txtrut'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $pass = $_POST['txtpass'];
        
        // Intenta registrar al usuario
        $registroExitoso = insertarUsuario($rut, $nombre, $apellido, $pass);

        if ($registroExitoso) {
            echo "Usuario registrado correctamente";
            // Iniciar la sesión
			session_start();
			
			// Después de comprobar que hay un error al intentar iniciar sesión
			$_SESSION['mensaje'] = "Usuario Registrado Correctamente.";
			$_SESSION['tipo'] = "success";

			// Redirige al usuario a la página de login
			header("Location: ../login.php");
        } else {
            //echo "Error al registrar usuario";
            // Iniciar la sesión
			session_start();
			
			// Después de comprobar que hay un error al intentar iniciar sesión
			$_SESSION['mensaje'] = "Error al Registrar Usuario. Verifica tus datos.";
			$_SESSION['tipo'] = "danger";

			// Redirige al usuario a la página de login
			header("Location: ../login.php");
        }
        
        
    
    } elseif (isset($_POST['btnRestablecerPass'])) {
        // Lógica para el botón "Actualizar"
        echo "Botón Actualizar presionado";
        
        $rut = $_POST['txtrut'];
        $correo = $_POST['txtcorreo'];
        echo "rut: $rut, correo: $correo";
        
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
function verificarCredenciales($rut, $password_hash) {
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    // Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("select idusuario,rut,pass,nombre,apellido,tipousuario from usuario where rut = ? AND pass = ?");
    $stmt->bind_param("ss", $rut, $password_hash); // Asumiendo que la contraseña se almacena de manera segura
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $rut,  $password, $nombre, $apellido, $tipousuario);
        $stmt->fetch();
        
        // Cierra la conexión después de usarla
        $conexionBD->cerrarConexion();
        
        return ['idusuario' => $id, 'rut' => $rut, 'nombre' => $nombre, 'password' => $password, 'apellido' => $apellido, 'tipousuario' => $tipousuario];
    }
    
    // Cierra la conexión después de usarla
    $conexionBD->cerrarConexion();
    
    return false;
}
function insertarUsuario($rut, $nombre, $apellido, $password) {
    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
    
    // Hash de la contraseña (asegúrate de implementar buenas prácticas de seguridad aquí)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $conexionBD->conexion->prepare("INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES(?,?,?,?,'Cliente')");
    $stmt->bind_param("ssss", $rut, $password_hash, $nombre, $apellido);
    $resultado = $stmt->execute();

    // Cierra la conexión después de usarla
    $stmt->close();
    return $resultado;
}




?>