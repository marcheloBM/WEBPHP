<?php

require_once 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar qué botón se presionó
    if (isset($_POST['btnIngresar'])) {

        // Lógica para el botón "Ingresar"
		//echo "Botón Ingresar presionado<br>";

		// Recupera los datos del formulario (ajusta según tus campos)
        $rut = $_POST['txtrut'];
        $pass = $_POST['txtpass'];

		

        // Supongamos que tienes una función en tu clase DB para verificar las credenciales
        $usuario = verificarCredenciales($rut, $pass);



        if ($usuario) {
            //echo "Usuario encontrado correctamente<br>";
            //echo "ID Usuario: " . $usuario['idusuario'] . "<br>";

            // Inicia la sesión si no está iniciada
            session_start();

            // Establecer la hora de inicio de sesión
            if (!isset($_SESSION['start_time'])) {
                $_SESSION['start_time'] = time();
            }

            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['rut'] = $usuario['rut'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];

            if ($usuario['tipousuario'] == "Administrador") {
                //echo "Inicio Session Administrador<br>";
                $_SESSION['tipo'] = "Administrador";
                header("Location: ../HomeAdmin.php");
                // Importante: asegúrate de salir después de una redirección
                exit;
            }

            if ($usuario['tipousuario'] == "Técnico") {
                // Incluir las clases
                include 'Tecnico.php';
                
                // Verificar si el técnico está activo
                $tecnico = listarTecnicoUsuarioIdUsuario($_SESSION['idusuario']);

                if ($tecnico['activo'] == 1) {
                    // El técnico está activo, inicia sesión y redirige
                    $_SESSION['tipo'] = "Técnico";
                    header("Location: ../HomeTecnico.php");
                    exit;
                } else {
                    // El técnico no está activo, muestra un mensaje y redirige a la página de login
                    setcookie("mensaje", "Tu cuenta de técnico está desactivada. Contacta al administrador para más información.", time() + 1, "/");
                    setcookie("tipo", "warning", time() + 1, "/");
                    header("Location: ../login.php");
                    exit;
                }
            }

            if ($usuario['tipousuario'] == "Cliente") {
                //echo "Inicio Session Cliente<br>";
                $_SESSION['tipo'] = "Cliente";
				require_once 'Cliente.php';
				header("Location: ../HomeCliente.php");
				exit;
            }

        } else {
			// En el primer script
            setcookie("mensaje", "Error al iniciar sesión. Verifica tus credenciales.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");

			// Redirige al usuario a la página de login
			header("Location: ../login.php");
			exit();
        }

    

    

    } elseif (isset($_POST['btnRegistrar'])) {

        // Lógica para el botón "Registrar"
        //echo "Botón Registrar presionado<br>";

        // Recupera los datos del formulario (ajusta según tus campos)

        $rut = $_POST['txtrut'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $pass = $_POST['txtpass'];

        // Busca al usuario si esta registrado
        $buscarUsuario = buscarUsuario($rut);

        if ($buscarUsuario){
            //echo "Usuario ya Registrado.<br>";
            // En el primer script
            setcookie("mensaje", "Error al Registrar Usuario. Usuario ya Registado.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");

            // Redirige al usuario a la página de login
            header("Location: ../login.php");
            exit;

        }else{

            // Intenta registrar al usuario

            $registroExitoso = insertarUsuario($rut, $nombre, $apellido, $pass);

            if ($registroExitoso) {

                //echo "Usuario registrado correctamente<br>";
                
                // En el primer script

                setcookie("mensaje", "Usuario Registrado Correctamente.", time() + 1, "/");

                setcookie("tipo", "success", time() + 1, "/");
                
    			// Redirige al usuario a la página de login
    			header("Location: ../RegistroCliente.html?dato=$rut");

    			exit;

            } else {

                //echo "Error al registrar usuario<br>";

                // En el primer script

                setcookie("mensaje", "Error al Registrar Usuario. Verifica tus datos.", time() + 1, "/");

                setcookie("tipo", "danger", time() + 1, "/");

    			// Redirige al usuario a la página de login

    			header("Location: ../RegistroUsuario.html");

    			exit;

            }

        }

        

    

    } elseif (isset($_POST['btnRestablecerPass'])) {

        // Lógica para el botón "Actualizar"

        //echo "Botón Actualizar presionado<br>";

        

        $rut = $_POST['txtrut'];

        $correo = $_POST['txtcorreo'];

        $nuevaContrasena = 'TrackMyPC2024';



        // Buscar usuario y cliente

        $registro = buscarUsuarioCliente($rut, $correo);



        if ($registro) {

            // Registro encontrado

            $idUsuario = $registro['idusuario'];

            // Actualizar la contraseña

            actualizarContraseña($idUsuario, $nuevaContrasena);



            //echo "Contraseña actualizada con éxito.<br>";

            

			// Después de comprobar que hay un error al intentar iniciar sesión

			setcookie("mensaje", "Contraseña actualizada con éxito. Nueva Password: $nuevaContrasena", time() + 1, "/");

            setcookie("tipo", "success", time() + 1, "/");

			// Redirige al usuario a la página de login

			header("Location: ../login.php");

        } else {

            //echo "No se encontraron registros para el Rut y Correo proporcionados.<br>";

            setcookie("mensaje", "No se encontraron registros para el Rut y Correo proporcionados.", time() + 1, "/");

            setcookie("tipo", "danger", time() + 1, "/");

            // Redirige al usuario a la página de login

			header("Location: ../login.php");

        }

        

    } elseif (isset($_POST['btnActualizarCliente'])) {
		// Lógica para el botón "Actualizar"
        //echo "Botón Actualizar presionado<br>";

        $rut = $_POST['txtrut'];
        $pass = $_POST['txtpass'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];

        if (!empty($_POST['txtpass'])) {
            // Ahora puedes hacer lo que necesites con $pass
            //echo "El campo PASS tiene datos<br>";

            $actualizacion = actualizarUsuarioPass($pass, $nombre, $apellido, $rut);
         
            if ($actualizacion) {
				//echo "Error al actualizar usuario<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Usuario. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige al usuario a la página de login
				header("Location: ../Cliente/ClienteUpdate.php");
                exit;
                
            } else {
                //echo "Usuario actualizado correctamente<br>";
				
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Usuario Actualizado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 1, "/");

				// Redirige al usuario a la página de login
				header("Location: ../Cliente/ClienteUpdate.php");
                exit;
            }

        } else {

            // La variable txtpass está vacía
            //echo "El campo PASS está vacío<br>";
			
            $actualizacion = actualizarUsuario($nombre, $apellido, $rut);
			
            if ($actualizacion) {
				//echo "Error al registrar usuario<br>";
                
                // Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Error al Actualizar Usuario. Verifica tus datos.", time() + 1, "/");
				setcookie("tipo", "danger", time() + 1, "/");
				// Redirige al usuario a la página de login
				header("Location: ../Cliente/ClienteUpdate.php");
				exit;
				
            } else {
				//echo "Usuario actualizado correctamente<br>";
				
				// Después de comprobar que hay un error al intentar iniciar sesión
				setcookie("mensaje", "Usuario Actualizado Correctamente.", time() + 1, "/");
				setcookie("tipo", "success", time() + 1, "/");
				// Redirige al usuario a la página de login
				header("Location: ../Cliente/ClienteUpdate.php");
				exit;
            }

        }
        

    } elseif (isset($_POST['btnRegistrarUsuarioTec'])){
        
        // Lógica para el botón "Registrar"
        //echo "Botón Registrar Usuario tecnico presionado<br>";

        // Recupera los datos del formulario (ajusta según tus campos)

        $rut = $_POST['txtrut'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $pass = 'TrackMyPC2024';

        // Busca al usuario si esta registrado
        $buscarUsuario = buscarUsuario($rut);

        if ($buscarUsuario){
            //echo "Usuario ya Registrado.<br>";
            // En el primer script
            setcookie("mensaje", "Error al Registrar Usuario. Usuario ya Registado.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");

            // Redirige al usuario a la página de login
            header("Location: ../Tecnico/AgregarUsuario.php");
            exit;

        }else{

            // Intenta registrar al usuario

            $registroExitoso = insertarUsuario($rut, $nombre, $apellido, $pass);

            if ($registroExitoso) {

                //echo "Usuario registrado correctamente<br>";
                
                session_start();
                $_SESSION['rut_usuario'] = $rut;
                
                // En el primer script
                setcookie("mensaje", "Usuario Registrado Correctamente.", time() + 1, "/");
                setcookie("tipo", "success", time() + 1, "/");
                
    			// Redirige al usuario a la página de login
    			header("Location: ../Tecnico/AgregarCliente.php");

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

        }

    } elseif (isset($_POST['btnActualizarUsuarioTec'])){
        // Lógica para el botón "Actualizar"
        //echo "Botón Actualizar presionado<br>";
        
        $id = $_POST['btnActualizarUsuarioTec'];
        $rut = $_POST['txtrut'];
        //$pass = $_POST['txtpass'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];

        // La variable txtpass está vacía
        //echo "El campo PASS está vacío<br>";
        
        $actualizacion = actualizarUsuario($nombre, $apellido, $rut);
        
        if ($actualizacion) {
            //echo "Error al registrar usuario<br>";
            
            // Después de comprobar que hay un error al intentar iniciar sesión
            setcookie("mensaje", "Error al Actualizar Usuario. Verifica tus datos.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");
            // Redirige al usuario a la página de login
            header("Location: ../Admin/TecnicoUpdate.php?id=$id");
            exit;
        
        } else {
            //echo "Usuario actualizado correctamente<br>";
            
            // Después de comprobar que hay un error al intentar iniciar sesión
            setcookie("mensaje", "Usuario Actualizado Correctamente.", time() + 1, "/");
            setcookie("tipo", "success", time() + 1, "/");
            // Redirige al usuario a la página de login
            header("Location: ../Admin/TecnicoUpdate.php?id=$id");
            exit;
        }

        
    } elseif (isset($_POST['RegistrarUserTecAdmin'])){
        // Lógica para el botón "Registrar"
        //echo "Botón Registrar Usuario tecnico presionado<br>";

        // Recupera los datos del formulario (ajusta según tus campos)
        $rut = $_POST['txtrut'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $pass = 'TrackMyPC2024';

        // Busca al usuario si esta registrado
        $buscarUsuario = buscarUsuario($rut);

        if ($buscarUsuario){
            //echo "Usuario ya Registrado.<br>";
            // En el primer script
            setcookie("mensaje", "Error al Registrar Usuario. Usuario ya Registado.", time() + 1, "/");
            setcookie("tipo", "danger", time() + 1, "/");

            // Redirige al usuario a la página de login
            header("Location: ../Admin/AgregarUsuario.php");
            exit;

        }else{

            // Intenta registrar al usuario
            $registroExitoso = insertarUsuarioTec($rut, $nombre, $apellido, $pass);

            if ($registroExitoso['resultado']) {
                //echo "Usuario registrado correctamente<br>{$registroExitoso['idusuario']}";
                session_start();
                $_SESSION['id_usuario'] = $registroExitoso['idusuario'];
                
                // En el primer script
                setcookie("mensaje", "Usuario Registrado Correctamente.", time() + 1, "/");
                setcookie("tipo", "success", time() + 1, "/");
                
    			// Redirige al usuario a la página de login
    			header("Location: ../Admin/AgregarTecnico.php");
    			exit;

            } else {
                //echo "Error al registrar usuario<br>";
                // En el primer script
                setcookie("mensaje", "Error al Registrar Usuario. Verifica tus datos.", time() + 1, "/");
                setcookie("tipo", "danger", time() + 1, "/");
    			// Redirige al usuario a la página de login
    			header("Location: ../Admin/AgregarUsuario.php");

    			exit;

            }

        }

    }

	

} 

function actualizarUsuarioPass($pass, $nombre, $apellido, $rut){

    $conexionBD = new ConexionBD();

    

    // Hash de la contraseña (asegúrate de implementar buenas prácticas de seguridad aquí)

    $password_hash = sha1($pass);

    

    // Actualizar en la tabla usuario

    $stmt = $conexionBD->conexion->prepare("UPDATE usuario SET pass=?, nombre=?, apellido=? WHERE rut=?");

    $stmt->bind_param("ssss", $password_hash, $nombre, $apellido, $rut);

    $stmt->execute();

    $stmt->close();



    // Cerrar la conexión

    $conexionBD->cerrarConexion();

}

function actualizarUsuario($nombre, $apellido, $rut){

    $conexionBD = new ConexionBD();

    

    // Actualizar en la tabla usuario

    $stmt = $conexionBD->conexion->prepare("UPDATE usuario SET nombre=?, apellido=? WHERE rut=?");

    $stmt->bind_param("sss", $nombre, $apellido, $rut);

    $stmt->execute();

    $stmt->close();



    // Cerrar la conexión

    $conexionBD->cerrarConexion();

}

function buscarUsuario($rut) {

    $conexionBD = new ConexionBD();



    // Buscar en la tabla cliente

    $stmt = $conexionBD->conexion->prepare("SELECT idusuario, rut, pass, nombre, apellido, tipousuario FROM usuario WHERE rut = ?");

    $stmt->bind_param("s", $rut);

    $stmt->execute();

    $result = $stmt->get_result();

    $registro = $result->fetch_assoc();

    $stmt->close();



    // Cerrar la conexión

    $conexionBD->cerrarConexion();



    return $registro;

}

function buscarUsuarioCliente($rut, $correo) {

    $conexionBD = new ConexionBD();



    // Buscar en la tabla cliente

    $stmt = $conexionBD->conexion->prepare("SELECT c.idcliente, c.direccion, c.celular, c.correo, c.usuario_idusuario, u.idusuario, u.rut, u.pass, u.nombre, u.apellido, u.tipousuario

        FROM cliente c

        JOIN usuario u ON c.usuario_idusuario = u.idusuario

        WHERE u.rut = ? AND c.correo = ?");

    $stmt->bind_param("ss", $rut, $correo);

    $stmt->execute();

    $result = $stmt->get_result();

    $registro = $result->fetch_assoc();

    $stmt->close();



    // Cerrar la conexión

    $conexionBD->cerrarConexion();



    return $registro;

}

function actualizarContraseña($idUsuario, $nuevaContrasena) {

    $conexionBD = new ConexionBD();

    

    // Hash de la contraseña (asegúrate de implementar buenas prácticas de seguridad aquí)

    $password_hash = sha1($nuevaContrasena);

    

    // Actualizar en la tabla usuario

    $stmt = $conexionBD->conexion->prepare("UPDATE usuario SET pass = ? WHERE idusuario = ?");

    $stmt->bind_param("si", $password_hash, $idUsuario);

    $stmt->execute();

    $stmt->close();



    // Cerrar la conexión

    $conexionBD->cerrarConexion();

}

function cargarCredenciales($id) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();
	
	// Devuelve el usuario si las credenciales son válidas, de lo contrario, devuelve false
    $stmt = $conexionBD->conexion->prepare("select rut,pass,nombre,apellido,tipousuario from usuario where idusuario = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->store_result();
	
	if ($stmt->num_rows > 0) {
        $stmt->bind_result($rut,  $password, $nombre, $apellido, $tipousuario);
        $stmt->fetch();

        // Cierra la conexión después de usarla
        $conexionBD->cerrarConexion();
		
		return ['rut' => $rut, 'nombre' => $nombre, 'password' => $password, 'apellido' => $apellido, 'tipousuario' => $tipousuario];

    }

    

    // Cierra la conexión después de usarla

    $conexionBD->cerrarConexion();

    

    return false;

}

function verificarCredenciales($rut, $password) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)

    $conexionBD = new ConexionBD();

    

    // Hash de la contraseña (asegúrate de implementar buenas prácticas de seguridad aquí)

    $password_hash = sha1($password);

    

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

    $password_hash = sha1($password);

    

    $stmt = $conexionBD->conexion->prepare("INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES(?,?,?,?,'Cliente')");

    $stmt->bind_param("ssss", $rut, $password_hash, $nombre, $apellido);

    $resultado = $stmt->execute();



    // Cierra la conexión después de usarla

    $stmt->close();

    return $resultado;

}

function insertarUsuarioTec($rut, $nombre, $apellido, $password) {

    // Crear instancia de la clase DB (asegúrate de tenerla previamente)
    $conexionBD = new ConexionBD();

    // Hash de la contraseña (asegúrate de implementar buenas prácticas de seguridad aquí)
    $password_hash = sha1($password);
    
    $stmt = $conexionBD->conexion->prepare("INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario) VALUES (?,?,?,?,'Técnico')");
    $stmt->bind_param("ssss", $rut, $password_hash, $nombre, $apellido);
    $resultado = $stmt->execute();
    // Obtener el ID del presupuesto recién insertado
    $idusuario = $conexionBD->conexion->insert_id;
    // Cierra la conexión después de usarla
    $stmt->close();
    //return $resultado;
    // Devolver tanto el resultado como el ID del equipo
    return array('resultado' => $resultado, 'idusuario' => $idusuario);

}








?>