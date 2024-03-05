<?php



// Inicia la sesión si no está iniciada

session_start();



// Si hay una cookie con el Rut, pídelo y vuelve a solicitar la contraseña
$rut = isset($_COOKIE['rut']) ? $_COOKIE['rut'] : null;
$nombre = isset($_COOKIE['nombre']) ? $_COOKIE['nombre'] : null;
$apellido = isset($_COOKIE['apellido']) ? $_COOKIE['apellido'] : null;
$tipousuario = isset($_COOKIE['tipousuario']) ? $_COOKIE['tipousuario'] : null;

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Lock Screen | Nifty - Admin Template</title>


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


        
    <!--Demo [ DEMONSTRATION ]-->
    <link href="css\demo\nifty-demo.min.css" rel="stylesheet">

    
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
    <div id="container" class="cls-container">
        
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		<!-- LOCK SCREEN -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3"><?php echo "$nombre $apellido";  ?></h1>
		                <span><?php echo "$tipousuario";  ?></span>
		            </div>
		            <div class="pad-btm mar-btm">
		                <img alt="Profile Picture" class="img-lg img-circle img-border-light" src="img\profile-photos\1.png">
		            </div>
		            <p>¡Ingrese su contraseña para desbloquear la pantalla!</p>
		            <form action="php\Usuario.php" method="POST">
		                <div class="form-group">
                            
		                    <input type="password" class="form-control" name="txtpass" placeholder="Contraseña" required>
		                </div>
		                <div class="form-group text-right">
                            <input type="hidden" name="txtrut" value="<?php print "$rut";  ?>">
		                    <button class="btn btn-primary btn-lg btn-block"  value="Ingresar" type="submit" name="btnIngresar" >Iniciar sesión </button>
		                </div>
		            </form>
		            <div class="pad-ver">
		                <a href="login.php" class="btn-link mar-rgt text-bold">Iniciar sesión con una cuenta diferente</a>
		            </div>
		        </div>
		    </div>
		</div>
		<!--===================================================-->
		
		
		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		
		<!--===================================================-->
		
		<!-- Código PHP para mostrar el mensaje de error -->
	    <?php require_once 'php/Notificaciones.php'; ?>
		
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
    
    <!--Background Image [ DEMONSTRATION ]-->
    <script src="js\demo\bg-images.js"></script>

</body>
</html>
