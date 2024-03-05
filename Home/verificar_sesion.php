<?php

//session_start();
require_once 'php/db.php';
require_once 'php/Usuario.php';


// Verificar si el usuario está autenticado

if (!isset($_SESSION['idusuario'])) {

    header("Location: login.php");

    exit();

}else{
	// ID del cliente (puedes obtener esto después de la autenticación del usuario)
	$idCliente = $_SESSION['idusuario'];
	$usuario = cargarCredenciales($idCliente);
	
	$_SESSION['rut'] = $usuario['rut'];
	$_SESSION['nombre'] = $usuario['nombre'];
	$_SESSION['apellido'] = $usuario['apellido'];
}

// Verificar el tiempo transcurrido desde el inicio de sesión

$elapsed_time = time() - $_SESSION['start_time'];

//$max_session_time = 3 * 60; // 0 minutos en segundos
// Establecer el tiempo máximo de sesión según el tipo de usuario
if ($_SESSION['tipo'] === "Administrador") {
    $max_session_time = 15 * 60; // 15 minutos para administradores
} elseif ($_SESSION['tipo'] === "Técnico") {
    $max_session_time = 10 * 60; // 10 minutos para técnicos
} else {
    $max_session_time = 5 * 60; // 5 minutos para otros tipos de usuarios (clientes, etc.)
}


if ($elapsed_time > $max_session_time) {
    // Obtén los datos de la sesión que deseas conservar
    $rut = $_SESSION['rut'];
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $tipousuario = $_SESSION['tipo'];
    // La sesión ha expirado, redirigir a la página de inicio de sesión
    session_destroy();
    
    // En el primer script
    setcookie("mensaje", "Session a expirado nueva iniciar sesion de nuevo.", time() + 1, "/");
    setcookie("tipo", "danger", time() + 1, "/");
    
    // Guarda el datos de la session en una cookie (puedes cambiar el tiempo de expiración según tus necesidades)
    setcookie("rut", $rut, time() + 3600, "/");
    setcookie("nombre", $nombre, time() + 3600, "/");
    setcookie("apellido", $apellido, time() + 3600, "/");
    setcookie("tipousuario", $tipousuario, time() + 3600, "/");
    
    
    header("Location: bloquear-pantalla.php");

    exit();

} else {

    // Actualizar la hora de inicio de sesión en cada solicitud para extender el tiempo de sesión

    $_SESSION['start_time'] = time();

}


// Resto del código de la página protegida...

?>