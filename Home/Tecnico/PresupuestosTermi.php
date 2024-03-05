﻿<?php



// Inicia la sesión si no está iniciada

session_start();



// Verifica si el atributo de la sesión es nulo".

include '../verificar_sesion.php';



// Accede a los datos almacenados en la sesión

$idusuario = $_SESSION['idusuario'];

$rut = $_SESSION['rut'];

$nombre = $_SESSION['nombre'];

$apellido = $_SESSION['apellido'];

    ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Home | TrackMyPC - Cliente</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="..\css\bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="..\css\nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="..\css\demo\nifty-demo-icons.min.css" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="..\plugins\pace\pace.min.css" rel="stylesheet">
    <script src="..\plugins\pace\pace.min.js"></script>


    <!--Demo [ DEMONSTRATION ]
    <link href="css\demo\nifty-demo.min.css" rel="stylesheet">-->


            
    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->
    
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                <div class="navbar-header">
                    <a href="..\HomeTecnico.php" class="navbar-brand">
                        <img src="..\img\logo.png" alt="TrackMyPC Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">TrackMyPC</span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->


                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content">
                    <ul class="nav navbar-top-links">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-list-view"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->


                    </ul>
                    <ul class="nav navbar-top-links">
                        
                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">
					<div class="pad-all text-center">
						<h3>Bienvenido El Trabajo de Hoy.</h3>
						<p class="text-warning text-3x">Tecnico <?php echo "$nombre $apellido";  ?></p>
						<p1>El Trabajo de Hoy.</p1>
					</div>
				</div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    				
					<div class="row">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Presupuesto</h3>
					            </div>
                                                    
					            <!-- Foo Table - Filtering -->
					    <!--===================================================-->
					    <div class="panel-body">
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
                                        <th>Accion</th>
					                </tr>
					            </thead>
					            
					            <tbody>
                                    <?php
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);
                                    
                                    // Iniciar la sesión
                                    //print "ID de Usuario: {$_SESSION['idusuario']} ";
                                    include '../php/Presupuesto.php';
                                    include '../php/Repuesto.php';
                                    
                                    // Crear instancia de la clase ConexionBD
                                    $conexionBD = new ConexionBD();
                                    
                                    // ID del presupuesto
                                    //$idPresupuesto = $_GET['id'];
                                    //print "ID de Presupuesto: {$id} "; 
                                    
                                    // Obtener la lista de equipos del cliente
                                    $presupuestos = listarPresupuestoAllTec();
                                    ?>
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
                                                    <td>{$presupuesto['valor']}</td>
                                                    <td>{$presupuesto['repuesto_idrepuesto']}</td>";
                                                    
                                                    $idrepuesto = $presupuesto['repuesto_idrepuesto'];
                                                    //Logica de Repuesto
                                                    if($idrepuesto==0){
                                                        echo "<td colspan='3'>No Requiere</td>";
                                                    }else{
                                                        $repuestos = listarRepuesto($idrepuesto);
                                                        
                                                         if (!empty($repuestos)) {
                                                            foreach ($repuestos as $repuesto) {
                                                                echo "
                                                                <td>{$repuesto['nombre']}</td>
                                                                <td>{$repuesto['descripcion']}</td>
                                                                <td>{$repuesto['precio']}</td>";
                                                            }
                                                         }
                                                    }
                                                    
                                                    echo "</td>
                                                    <td>";
                                                    
                                                    // Lógica de estado
													if ($estado == 'Aprobado') {
														echo '<form action="../php/Presupuesto.php" method="post">
                                                                           <div class="btn-group btn-group-xs">
                                                                               <input type="hidden" name="id" value="'.$presupuesto['idpresupuesto'].'">
                                                                                <button class="btn btn-success" name="btnTerminadoPre" value="AprobarPresupuesto" type="submit">Terminado</button>
                                                                            </div>
                                                                       </form>';
														
													} else {
                                                        echo 'No Requiere';

                                                    }
                                                    
                                                    echo "</td>
													</tr>";

                                                }

                                            } else {
                                                echo "<tr><td colspan='7'>No hay presupuesto para mostrar.</td></tr>";
                                            }



                                            // Cierra la conexión después de usarla
                                            $conexionBD->cerrarConexion();
                                            ?>					               
					            </tbody>
					            <tfoot>
					                <tr>
					                    <td colspan="5">
					                        <div class="text-right">
					                            <ul class="pagination"></ul>
					                        </div>
					                    </td>
					                </tr>
					            </tfoot>
					        </table>
					    </div>
					    <!--===================================================-->
					    <!-- End Foo Table - Filtering -->
					
					    </div>
					</div>
					    
                </div>
                <!--===================================================-->
                <!--End page content-->
                <!-- Código PHP para mostrar el mensaje de error -->
                <?php require_once '../php/Notificaciones.php'; ?>

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
            
            <!--ASIDE-->
            <!--===================================================-->
            
            <!--===================================================-->
            <!--END ASIDE-->

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">


                    <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
                    <!--It will only appear on small screen devices.-->
                    <!--================================
                    <div class="mainnav-brand">
                        <a href="index.html" class="brand">
                            <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                            <span class="brand-text">Nifty</span>
                        </a>
                        <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
                    </div>
                    -->



                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
                                            <img class="img-circle img-md" src="..\img\profile-photos\1.png" alt="Profile Picture">
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                            <p class="mnp-name"><?php echo "$nombre $apellido";  ?></p>
                                            <span class="mnp-desc">Rut <?php print "$rut";  ?></span>
                                        </a>
                                    </div>
                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                        <!--<a href="ClienteUpdate.html" class="list-group-item">
                                            <i class="demo-pli-male icon-lg icon-fw"></i> Ver perfil
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="demo-pli-gear icon-lg icon-fw"></i> Ajustes
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="demo-pli-information icon-lg icon-fw"></i> Ayuda
                                        </a>-->
                                        <a href="../php/cerrar_sesion.php" class="list-group-item">
                                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Cerrar sesión
                                        </a>
                                    </div>
                                </div>


                                <!--Shortcut buttons-->
                                <!--================================-->
                                <div id="mainnav-shortcut" class="hidden">
                                    <ul class="list-unstyled shortcut-wrap">
                                        <li class="col-xs-3" data-content="My Profile">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                                <i class="demo-pli-male"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Messages">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                                <i class="demo-pli-speech-bubble-3"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Activity">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                                <i class="demo-pli-thunder"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Lock Screen">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                                <i class="demo-pli-lock-2"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--================================-->
                                <!--End shortcut buttons-->


                                <ul id="mainnav-menu" class="list-group">
						
						            <!--Category name-->
						            <li class="list-header">Navegación</li>
						
						            <!--Menu list item-->
						            <li class="active-sub">
						                <a href="#">
						                    <i class="demo-pli-home"></i>
						                    <span class="menu-title">Home</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse in">
						                    <li><a href="..\HomeTecnico.php">Home</a></li>
                                            <li><a href="AgregarEquipo.php">Agregar Equipo</a></li>
											<li><a href="AgregarUsuario.php">Agregar Usuario</a></li>
                                            <li><a href="ListarEquipos.php">Listar Equipos</a></li>
                                            <li class="active-link"><a href="PresupuestosTermi.php">Presupuestos Terminados</a></li>
											
						                </ul>
						            </li>
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						
						            <!--Category name-->
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						
						            <!--Category name-->
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            


                                    <!--Menu list item-->
                                    

						
						
						            <!--Category name-->
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						            
						
						            <!--Menu list item-->
						                                       
								</ul>


                                <!--Widget-->
                                <!--================================-->
                                <div class="mainnav-widget">

                                    <!-- Show the button on collapsed navigation -->
                                    

                                    <!-- Hide the content on collapsed navigation -->
                                    
                                </div>
                                <!--================================-->
                                <!--End widget-->

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->
            
        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">

            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            



            <!-- Visible when footer positions are static -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            



            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Remove the class "show-fixed" and "hide-fixed" to make the content always appears. -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <p class="pad-lft">&#0169; 2023 TrackMyPC</p>



        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        
        <!--===================================================-->
        
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


    
    
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="..\js\jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="..\js\bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="..\js\nifty.min.js"></script>




    <!--=================================================-->
    
    <!--Demo script [ DEMONSTRATION ]-->
    <script src="..\js\demo\nifty-demo.min.js"></script>

    
    <!--Flot Chart [ OPTIONAL ]-->
    <script src="..\plugins\flot-charts\jquery.flot.min.js"></script>
	<script src="..\plugins\flot-charts\jquery.flot.resize.min.js"></script>
	<script src="..\plugins\flot-charts\jquery.flot.tooltip.min.js"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="..\plugins\sparkline\jquery.sparkline.min.js"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="..\js\demo\dashboard.js"></script>


    

</body>
</html>
