<?php

    session_start();

    if (!$_SESSION["account_name"]) {
        //header('Location: ../index.php');

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
            <!--<li class="select" ><a href="#"style="color: #292929;" ><b>Dashboard</b></a></li>-->
              <li class="select"  ><a href="index.php" style="color: #292929;"> Dashboard </a></li>
              <li><a href="AdminDocentes.php" > Administrar Docentes </a></li>
              <li><a href="Cargahoraria.php" > Concentrado </a></li>
              <li><a href="CarrerasCargaHoraria.php" > Administrar Carga Horaria </a></li>
              <li><a href="CargaPorDocente.php" > Carga Individual </a></li>
              </ul>
            </div>

            <div id="content" >
              <div class="inner">
                <!-- menu -->
                <?php
                 include_once('include/menu.php'); 
                ?>

                  <div>
                  <h1>Administración de Grupos</h1>
                  <?php 

                    $con = new mysqli("localhost","uttlaxca_siseac","siseac2014","uttlaxca_siseac");

                   ?>
                    Carreras<select name="carrera" id="carrera">

                      <?php 

                        $carR = $con->query("select * from carreras");

                        while($fila = $carR->fetch_assoc()){
                          echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                        }

                       ?>
                      
                    </select>
                    Periodos<select name="peri" id="peri">
                      <?php 

                        $peri = $con->query("select * from periodo_escolar");

                        while ($fila = $peri->fetch_assoc()) {
                          echo "<option value='".$fila['idperiodo_escolar']."'>";
                          echo $fila['periodo']." ".$fila['anual'];
                          echo "</option>";
                        }

                       ?>
                    </select>
                    <button id='buscaG'>Listar Grupos</button>
                    <button id='nuevoGrupo'>Nuevo Grupo</button>
                  </div>
                  <hr>

                  <div id="grupos">
                

                  </div>
                  <hr>
                  <div id="nuevoG">
                    Cuatrimestre
                    <input type="text" id="cuatrimestre"><br>
                    Grado
                    <input type="text" id="grado"><br>
                    Grupo
                    <input type="text" id="grupo"><br>
                    Turno
                    <select name="turno" id="turno">
                      <option value="MATUTINO">MATUTINO</option>
                      <option value="VESPERTINO">VESPERTINO</option>
                    </select><br><br>
                    <button id="guardaG">Guardar</button>
                  </div>

                  <div id="footer">&copy; Copyright 2014  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span> </div>

                </div> <!--// End inner -->
            </div> <!--// End ID content --> 
            <script>
              $(document).ready(function(){
                $('#nuevoG').hide();
                $('#buscaG').click(function(e){
                  e.preventDefault();
                  $('#grupos').load('crudperiodo.php',{
                    carrera: $('#carrera').val(),
                    periodo: $('#peri').val()
                  });
                $('#nuevoG').hide();
                });
                $('#nuevoGrupo').click(function(e){
                  e.preventDefault();
                $('#nuevoG').show();
                });
                $('#guardaG').click(function(e){
                  e.preventDefault();
                  $.post('funciones.php',{
                    cuatrimestre: $('#cuatrimestre').val(),
                    grado: $('#grado').val(),
                    grupo: $('#grupo').val(),
                    turno: $('#turno').val(),
                    carrera: $('#carrera').val(),
                    periodo: $('#peri').val()
                  },function(res){
                    alert(res);
                     $('#grupos').load('crudperiodo.php',{
                    carrera: $('#carrera').val(),
                    periodo: $('#peri').val()
                  });
                  });
                });
              });
            </script>
  </body>
</html>