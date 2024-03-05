<?php



// Inicia la sesión si no está iniciada

session_start();



// Verifica si el atributo de la sesión es nulo".

include 'verificar_sesion.php';



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

    <title>Home | TrackMyPC - Administrador</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="css\bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="css\nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="css\demo\nifty-demo-icons.min.css" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="plugins\pace\pace.min.css" rel="stylesheet">
    <script src="plugins\pace\pace.min.js"></script>


    <!--Demo [ DEMONSTRATION ]
    <link href="css\demo\nifty-demo.min.css" rel="stylesheet">-->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
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
                    <a href="HomeAdmin.php" class="navbar-brand">
                        <img src="img\logo.png" alt="TrackMyPC Logo" class="brand-icon">
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
						<h3>Bienvenido</h3>
						<p class="text-danger text-3x">Administrador <?php echo "$nombre $apellido";  ?></p>
						<p1>Balance de trabajos de la empresa</p1>
					</div>
				</div>
                                        
                <div class="row">
                    <div class="col-md-6">
					
					            <!-- Pie Chart -->
					            <!---------------------------------->
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Estado de Equipos</h3>
					                </div>
					                <div class="panel-body">
					                    <div id="demo-flot-pie" style="height: 250px"><canvas id="grafico"></canvas></div>
					                </div>
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Estado<br>Equipo</th>
                                                                            <th>Color<br>Cantidad</th>
                                                                            <th>Descripción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php
                                                                        error_reporting(E_ALL);
                                                                        ini_set('display_errors', 1);
                                                                        //print "ID de Usuario: {$_SESSION['idusuario']} ";

                                                                        // Incluir las clases
                                                                        include 'php/Equipo.php';

                                                                        // Crear instancia de la clase ConexionBD
                                                                        $conexionBD = new ConexionBD();

                                                                        // ID del tecnico (puedes obtener esto después de la autenticación del usuario)
                                                                        //$idusuario = $_SESSION['idusuario'];

                                                                        // Obtener la lista de equipos del cliente
                                                                        $equipos = leerPCEstado();

                                                                    ?>
                                                                    
                                                                    <tbody>
                                                                        <?php
                                                                        // Inicializar arrays para valores y etiquetas
                                                                        $valoresE = array();
                                                                        $etiquetasE = array();
                                                                            if (!empty($equipos)) {
                                                                                foreach ($equipos as $equipo) {
                                                                                    $etiquetasE[] = $equipo['tipoEstado'];
                                                                                    $valoresE[] = $equipo['cantidad'];
                                                                                    
                                                                                    echo "<tr>
                                                                                    <td>{$equipo['tipoEstado']}</td>
                                                                                    <td class='text-center'>{$equipo['cantidad']}</td>
                                                                                    <td>";
                                                                                    $estado = $equipo['tipoEstado'];

                                                                                    // Lógica de estado
                                                                                    if ($estado == 'Terminado') {
                                                                                        echo 'El equipo ya esta terminado';

                                                                                    } elseif ($estado == 'En Reparacion') {
                                                                                        echo 'El administrador aprueba el presupuesto';

                                                                                    } elseif ($estado == 'Esperando') {
                                                                                        echo 'El Tecnico crea un presupuesto para su aprobacion';

                                                                                    } elseif ($estado == 'Sin Revision') {
                                                                                        echo 'El Tecnico registra un equipo';
                                                                                    }
                                                                                    echo "</td>
                                                                                    </tr>";
                                                                                }

                                                                            } else {
                                                                                echo "<tr><td colspan='3'>No hay horas para mostrar.</td></tr>";
                                                                            }



                                                                            // Cierra la conexión después de usarla
                                                                            $conexionBD->cerrarConexion();
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
					            </div>
					            <!---------------------------------->
					
					
					        </div>
                                                <div class="col-md-6">
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Estado de Presupuestos</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div id="demo-flot-pie" style="height: 250px"><canvas id="grafico2"></canvas></div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Estado<br>Presupuestos</th>
                                                                            <th>Color<br>Cantidad</th>
                                                                            <th>Descripción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php
                                                                        error_reporting(E_ALL);
                                                                        ini_set('display_errors', 1);
                                                                        //print "ID de Usuario: {$_SESSION['idusuario']} ";

                                                                        // Incluir las clases
                                                                        include 'php/Presupuesto.php';

                                                                        // Crear instancia de la clase ConexionBD
                                                                        $conexionBD = new ConexionBD();

                                                                        // ID del tecnico (puedes obtener esto después de la autenticación del usuario)
                                                                        //$idusuario = $_SESSION['idusuario'];

                                                                        // Obtener la lista de equipos del cliente
                                                                        $presupuestos = leerPresuEstado();

                                                                    ?>
                                                                    <tbody>
                                                                        <?php
                                                                        // Inicializar arrays para valores y etiquetas
                                                                        $valoresP = array();
                                                                        $etiquetasP = array();
                                                                            if (!empty($presupuestos)) {
                                                                                foreach ($presupuestos as $presupuesto) {
                                                                                    $etiquetasP[] = $presupuesto['estado'];
                                                                                    $valoresP[] = $presupuesto['cantidad'];
                                                                                    
                                                                                    echo "<tr>
                                                                                    <td>{$presupuesto['estado']}</td>
                                                                                    <td class='text-center'>{$presupuesto['cantidad']}</td>
                                                                                    <td>";
                                                                                    $estado = $presupuesto['estado'];

                                                                                    // Lógica de estado
                                                                                    if ($estado == 'Pendiente') {
                                                                                        echo 'El Cliente debe aprobar o rechazar el presupuesto';

                                                                                    } elseif ($estado == 'En Proceso') {
                                                                                        echo 'El administrador debe aprobar o rechazar el presupuesto';

                                                                                    } elseif ($estado == 'Rechazado') {
                                                                                        echo 'El presupuesto a sido rechazado';

                                                                                    } elseif ($estado == 'Aprobado') {
                                                                                        echo 'Esta listo para su reparacion';
                                                                                        
                                                                                    } elseif ($estado == 'Terminado') {
                                                                                        echo 'Esta Reparado el equipo';
                                                                                    }
                                                                                    echo "</td>
                                                                                    </tr>";
                                                                                }

                                                                            } else {
                                                                                echo "<tr><td colspan='3'>No hay horas para mostrar.</td></tr>";
                                                                            }



                                                                            // Cierra la conexión después de usarla
                                                                            $conexionBD->cerrarConexion();
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                    <?php
                    
                    ?>
                    <script>
                        // Obtener el elemento canvas donde se renderizará el gráfico
                        var canvas = document.getElementById('grafico').getContext('2d');
                        
                        // Definir los datos del gráfico (valores y etiquetas)
                        //var valores = [1, 2, 3, 4]; // Ejemplo de valores
                        //var etiquetas = ['A', 'B', 'C', 'D'] // Ejemplo de etiquetas
                        
                        // Crear el gráfico circular utilizando Chart.js
                        new Chart(canvas, {
                            type: 'pie',
                            data: {
                                labels: <?php echo json_encode($etiquetasE); ?>,
                                datasets: [{
                                    data: <?php echo json_encode($valoresE); ?>,
                                    backgroundColor: ['gray' ,'red' ,'yellow','green'] // Colores para cada segmento del gráfico
                                }]
                            }
                        });
                      
                      
                     // Obtener el elemento canvas donde se renderizará el gráfico
                      var canvas2 = document.getElementById('grafico2').getContext('2d');

                      // Definir los datos del gráfico (valores y etiquetas)
                      //var valores = [1, 2, 3, 4]; // Ejemplo de valores
                      //var etiquetas = ['A', 'B', 'C', 'D']; // Ejemplo de etiquetas

                      // Crear el gráfico circular utilizando Chart.js
                      new Chart(canvas2, {
                        type: 'pie',
                        data: {
                          labels: <?php echo json_encode($etiquetasP); ?>,
                          datasets: [{
                            data: <?php echo json_encode($valoresP); ?>,
                            backgroundColor: ['green', 'gray','yellow','red','blue'] // Colores para cada segmento del gráfico
                          }]
                        }
                      });
                  </script>
                </div>
                                            
                <!--End page content-->
                <!-- Código PHP para mostrar el mensaje de error -->
                <?php require_once 'php/Notificaciones.php'; ?>
                                                                    
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
                                            <img class="img-circle img-md" src="img\profile-photos\1.png" alt="Profile Picture">
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
                                        <!--<a href="Cliente/ClienteUpdate.jsp" class="list-group-item">
                                            <i class="demo-pli-male icon-lg icon-fw"></i> Ver perfil
                                        </a>
                                        <!--<a href="#" class="list-group-item">
                                            <i class="demo-pli-gear icon-lg icon-fw"></i> Ajustes
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="demo-pli-information icon-lg icon-fw"></i> Ayuda
                                        </a>-->
                                        <a href="php/cerrar_sesion.php" class="list-group-item">
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
						                    <li class="active-link"><a href="HomeAdmin.php">Home</a></li>
                                                                    <li><a href="Admin/MantenedorTec.php">Mantenedor Tecnico</a></li>
                                                                    <li><a href="Admin/MantenedorAgenda.php">Mantenedor Agenda</a></li>
                                                                    <li><a href="Admin/PresupuestosAll.php">All Presupuestos</a></li>
                                                                    <li><a href="Admin/Presupuestos.php">Presupuestos Pendientes</a></li>
                                                                    <li><a href="php/BackBD.php">Crear Backup de la BD</a></li>
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
    <script src="js\jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js\bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="js\nifty.min.js"></script>




    <!--=================================================-->
    
    <!--Demo script [ DEMONSTRATION ]-->
    <script src="js\demo\nifty-demo.min.js"></script>

    
    <!--Flot Chart [ OPTIONAL ]-->
    <script src="plugins\flot-charts\jquery.flot.min.js"></script>
	<script src="plugins\flot-charts\jquery.flot.resize.min.js"></script>
	<script src="plugins\flot-charts\jquery.flot.tooltip.min.js"></script>
    <script src="plugins\flot-charts\jquery.flot.pie.min.js"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="plugins\sparkline\jquery.sparkline.min.js"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="js\demo\dashboard.js"></script>

    <!--Flot Sample [ SAMPLE ]-->
    <script src="js\demo\flot-charts.js"></script>
    
        
</body>
</html>
