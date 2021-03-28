<?php
session_start();
if (!$_SESSION["account_name"]) {

//    header('Location: ../index.php');
        echo '<script type="text/javascript">';
    echo 'alert("No has iniciado sesión' . $error . '");';
    echo 'window.location.assign("../index.php");';
    echo '</script>';
    
} else if ($_SESSION["tipo_usuario"] != 3) {
    // create SESSION  
    echo '<script type="text/javascript">';
    echo 'alert("No tiene permiso acceder a esta zona' . $error . '");';
    echo 'window.location.assign("../index.php");';
    echo '</script>';
} else if ($_SESSION["estatus"] == 2) {
    echo '<script type="text/javascript">';
    echo 'alert("No tiene permiso acceder a esta zona' . $error . '");';
    echo 'window.location.assign("../index.php");';
    echo '</script>';
}
ini_set('session.bug_compat_42',"0");
ini_set('session.bug_compat_warn',"0");

?>
<!DOCTYPE html>
<html lang="es">
  <head>
        <meta charset="utf-8">
        <title>SISEAC.-Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Link shortcut icon-->
        <link rel="shortcut icon" type="image/ico" href="images/favicon.ico"/> 

        <!-- CSS Stylesheet-->
        <link type="text/css" rel="stylesheet" href="components/bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="components/bootstrap/bootstrap-responsive.css" />
        <link type="text/css" rel="stylesheet" href="css/zice.style.css"/>

		
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="components/flot/excanvas.min.js"></script><![endif]-->  
		
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="components/ui/jquery.ui.min.js"></script> 
		<script type="text/javascript" src="components/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="components/ui/timepicker.js"></script>
        <script type="text/javascript" src="components/colorpicker/js/colorpicker.js"></script>
        <script type="text/javascript" src="components/form/form.js"></script>
        <script type="text/javascript" src="components/elfinder/js/elfinder.full.js"></script>
        <script type="text/javascript" src="components/datatables/dataTables.min.js"></script>
        <script type="text/javascript" src="components/fancybox/jquery.fancybox.js"></script>
        <script type="text/javascript" src="components/jscrollpane/jscrollpane.min.js"></script>
        <script type="text/javascript" src="components/editor/jquery.cleditor.js"></script>
        <script type="text/javascript" src="components/chosen/chosen.js"></script>
        <script type="text/javascript" src="components/validationEngine/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="components/validationEngine/jquery.validationEngine-en.js"></script>
        <script type="text/javascript" src="components/fullcalendar/fullcalendar.js"></script>
        <script type="text/javascript" src="components/flot/flot.js"></script>
        <script type="text/javascript" src="components/uploadify/uploadify.js"></script>       
		<script type="text/javascript" src="components/Jcrop/jquery.Jcrop.js"></script>
		<script type="text/javascript" src="components/smartWizard/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
        <script type="text/javascript" src="js/zice.custom.js"></script>
        
		</head>        
        <body>        
        
            <!-- Header -->
            <?php include_once('include/header.php'); ?>
           <!-- End Header -->
            
              <!-- left_menu -->
           
              
              
               <div id="left_menu">
                    <ul id="main_menu" class="main_menu">
<!--                      <li class="select" ><a href="#"style="color: #292929;" ><b>Dashboard</b></a></li>-->
                    <li  ><a href="index.php" > Dashboard </a></li>
                       <li   ><a href="AdminDocentes.php" > Administrar Docentes </a></li>
                        <li   ><a href="Cargahoraria.php" > Concentrado </a></li>
                        <li class="select"    ><a style="color: #292929;" href="CarrerasCargaHoraria.php" > Administrar Carga Horaria </a></li>
                        <li   ><a href="CargaPorDocente.php" > Carga Individual </a></li>
    
                     
                    </ul>
               </div>
               
              <div id="content" >
                <div class="inner">
                                    
                   <!-- menu -->
               <?php include_once('include/menu.php'); ?>
                    
                    <div class="row-fluid">
                    
                    
                        
                                                             <?php echo   $Carreras = $Seani->AdminCargaH();     ?>     
                                                     
                
                                                   
                                                       
                                                        
                                           
                                      <div class="clearfix"></div>
                  
                           
                           
                         

                            
                    </div><!-- row-fluid -->
                    <div class="row-fluid">
                    <div id="footer">&copy; Copyright 2014  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span> </div>
                    
                </div> <!--// End inner -->
              </div> <!--// End ID content --> 

        
        </body>
        </html>