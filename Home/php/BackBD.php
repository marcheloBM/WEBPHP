<?php
// Requiere la definición de la clase ConexionBD
require_once 'db.php';

// Crear instancia de la clase DB (asegúrate de tenerla previamente)
$conexionBD = new ConexionBD();

// Nombre del archivo de respaldo
$backupFile = 'respaldo_' . date('Y-m-d_H-i-s') . '.sql';

// Abrir archivo de respaldo para escritura
$fileHandler = fopen($backupFile, 'w');

if (!$fileHandler) {
    die("Error al abrir el archivo de respaldo.");
}

// Orden específico de las tablas
$orderOfTables = [
    'usuario',
    'administrador',
    'tecnico',
    'cliente',
    'agenda',
    'repuesto',
    'presupuesto',
    'equipo',
];

// Recorrer las tablas y generar el SQL de respaldo en el orden deseado
foreach ($orderOfTables as $table) {
    $result = $conexionBD->conexion->query("SELECT * FROM $table");
    
    // Escribir la estructura de la tabla en el archivo
    $createTableSQL = "SHOW CREATE TABLE $table";
    $createTableResult = $conexionBD->conexion->query($createTableSQL);
    $createTableRow = $createTableResult->fetch_assoc();
    fwrite($fileHandler, $createTableRow["Create Table"] . ";\n");

    // Escribir los datos de la tabla en el archivo
    while ($row = $result->fetch_assoc()) {
        $insertSQL = "INSERT INTO $table VALUES ('" . implode("', '", $row) . "');";
        fwrite($fileHandler, $insertSQL . "\n");
    }
}

// Cerrar el archivo de respaldo
fclose($fileHandler);

// Descargar el archivo de respaldo
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $backupFile . '"');
readfile($backupFile);

// Eliminar el archivo de respaldo después de la descarga
unlink($backupFile);

// Cerrar la conexión a la base de datos
$conexionBD->cerrarConexion();
?>