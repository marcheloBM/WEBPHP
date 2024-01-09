<?php
// Verifica si hay una sesión activa
if (session_status() == PHP_SESSION_ACTIVE) {
    //echo "Hay una sesión activa.";
} else {
    //echo "No hay sesión activa.";
	header("Location: login.php");
}
?>