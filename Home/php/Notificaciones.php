<?php
// Verificar si hay un mensaje en la sesión
if (isset($_COOKIE['mensaje'])) {
	$mensaje = $_COOKIE['mensaje'];
	$tipo = $_COOKIE['tipo'];
	echo "<div class='panel-body alert alert-$tipo' id='demo-noty-onshown'>
	<button class='close' data-dismiss='alert'>
	<i class='pci-cross pci-circle'></i>
	</button><strong>$tipo!</strong>'$mensaje'</div>";
	}

?>