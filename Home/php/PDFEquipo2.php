<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>Reporte | Presupuestos-Repuesto</title>
        
        <style>
    /* Estilo básico para la tabla */
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    /* Estilo de las celdas de encabezado */
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        font-size: 12px; /* Ajusta el tamaño de la fuente según tus preferencias */
    }

    /* Estilo de las celdas de encabezado */
    th {
        background-color: #f2f2f2;
    }

    /* Resaltar filas al pasar el ratón sobre ellas */
    tr:hover {
        background-color: #f5f5f5;
    }
</style>
        
    </head>
    <body>
        
       <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//print "ID de Usuario: {$_SESSION['idusuario']} ";

// Incluir las clases
include 'Presupuesto.php';
include 'Repuesto.php';

// Crear instancia de la clase ConexionBD
$conexionBD = new ConexionBD();

// Obtener la lista de equipos del cliente
$presupuestos = leerPreAll2();
?>
<div class="panel">
<div class="panel-body">
    <h1>Reporte de Presupuestos</h1>
<table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="8">
					            <thead>
					                <tr>
					                    <th>ID</th>
					                    <th>Tipo<br>de Reparacion</th>
					                    <th>Fecha<br>Ingreso</th>
					                    <th>Fecha<br>Termino</th>
                                        <th>Estado</th>
					                    <th>Descripcion</th>
                                        <th>Valor</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
					                </tr>
					            </thead>
					            
					            <tbody>
                                    <?php
                                            if (!empty($presupuestos)) {
                                                foreach ($presupuestos as $presupuesto) {
                                                    echo "<tr>
                                                    <td>{$presupuesto['idpresupuesto']}</td>
                                                    <td>{$presupuesto['tiporeparacion']}</td>
                                                    <td>{$presupuesto['fechaingreso']}</td>
                                                    <td>{$presupuesto['fechatermino']}</td>
                                                    <td>";
                                                    $estado = $presupuesto['estado'];

                                                    // Lógica de estado
													if ($estado == 'Pendiente') {
														echo '<div class="label label-table label-danger">' . $estado . '</div>';
														
													} elseif ($estado == 'En Proceso') {
                                                        echo '<div class="label label-table label-warning">' . $estado . '</div>';

                                                    } elseif ($estado == 'Rechazado') {
                                                        echo '<div class="label label-table label-danger">' . $estado . '</div>';

                                                    } elseif ($estado == 'Aprobado') {
                                                        echo '<div class="label label-table label-dark">' . $estado . '</div>';
                                                    }
                                                    echo "</td>
                                                    <td>{$presupuesto['descripcion']}</td>
                                                    <td>{$presupuesto['valor']}</td>";
                                                    
                                                    $idrepuesto = $presupuesto['repuesto_idrepuesto'];
                                                    $repuestos = listarRepuesto($idrepuesto);
                                                    
                                                    if (!empty($repuestos)) {
                                                        foreach ($repuestos as $repuesto) {
                                                            echo " <td>{$repuesto['idrepuesto']}</td>";
                                                            echo " <td>{$repuesto['nombre']}</td>";
                                                            echo " <td>{$repuesto['descripcion']}</td>";
                                                            echo " <td>{$repuesto['precio']}</td>";
                                                        }
                                                    }else{
                                                        echo '<td  colspan="4"> No Requiere</td>';
                                                    }
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='10'>No hay presupuesto para mostrar.</td></tr>";
                                            }

                                            // Cierra la conexión después de usarla
                                            $conexionBD->cerrarConexion();
                                        ?>					               
					            </tbody>
					            <tfoot>
					                <tr>
					                    <td colspan="11">
					                        <div class="text-right">
					                            <ul class="pagination"></ul>
					                        </div>
					                    </td>
					                </tr>
					            </tfoot>
					        </table> 
    </div>
    </div>
    </body>
</html>
<?php
$html=ob_get_clean();
//echo $html;

require_once '../app/dompdf/autoload.inc.php';
//require_once '../app/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

//$options = $dompdf->getOptions();
//$options->set(array('isRemoteEnabled' => true));
//$dompdf->setOptions($options);

//$dompdf->load_html($html);
$dompdf->loadHtml($html);

//carta
//$dompdf->setPaper('letter');
//papel A4 Horisontal
$dompdf->setPaper('A4','landscape');

$dompdf->render();
//Para Abrir el archivo si le colocarmos true para descargarlo 
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>
