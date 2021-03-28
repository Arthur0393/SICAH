<?php
session_start();
if (!$_SESSION["account_name"]) {

  //   header('Location: ../index.php');
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

    <script type="text/javascript" src="tableExport/tableExport.js"></script>
    <script type="text/javascript" src="tableExport/jquery.base64.js"></script>
    <script type="text/javascript" src="tableExport/html2canvas.js"></script>
    <script type="text/javascript" src="tableExport/jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="tableExport/jspdf/jspdf.js"></script>
    <script type="text/javascript" src="tableExport/jspdf/libs/base64.js"></script>
    
	</head>        
  <body>        
      <!-- Header -->
      <input type="hidden" id = 'objP' >

      <?php 

        $periodo_actual = '';        
        if(isset($_GET['periodo_actual'])){
          $periodo_actual = $_GET['periodo_actual'];
        }else{
          echo "
          <script>
            var peri = prompt('Escribe el periodo a Consultar');
            window.open('Cargahoraria.php?periodo_actual='+peri,'_self');
          </script>
          ";
        }

       ?>
    <?php include_once('include/header.php'); ?>
      <!-- End Header -->
          
      <!-- left_menu -->

    <div id="left_menu">
      <ul id="main_menu" class="main_menu">
        <!-- <li class="select" ><a href="#"style="color: #292929;" ><b>Dashboard</b></a></li>-->
        <li><a href="index.php" > Dashboard </a></li>
        <li><a href="AdminDocentes.php" > Administrar Docentes </a></li>
        <li class="select" ><a style="color: #292929;" href="Cargahoraria.php" > Concentrado </a></li>
        <li><a href="CarrerasCargaHoraria.php" > Administrar Carga Horaria </a></li>
        <li><a href="CargaPorDocente.php" > Carga Individual </a></li>
      </ul>            
    </div>
               
    <div id="content" >
      <div class="inner">
                                   
        <!-- menu -->
        
        <?php include_once('include/menu.php'); ?>
        <!-- <span><i class="icon-table"></i> Administración Docentes </span>-->
        <!-- Table widget -->
                                 
      </div><!-- End widget-header -->	
                            
      <div class="widget-content">
        <!-- Table UITab -->
        <div id="UITab" style="position:relative;">
          <ul class="tabs" >
            <li><a href="#tab1">General Concentrado</a></li>  
            <li><a href="#tab2">Por Carrera</a></li>  
            <li><a href="#tab3">Docente por Materia</a></li>                                    
          </ul>
                                        
          <div class="tab_container" >
                  
            <div id="tab1" class="tab_content"> 

              <!--<button id="tableExport">PDF</button>-->
              <button id="cuenta">PTC / PA</button>

              <div id="divCuenta" style="display:none">
                <?php 
                  $abreviatu=$Seani->TodaslasCarrerasId();

                  $Seani->TablePTCAdmin($abreviatu, $periodo_actual);

                    /*$sqlx="SELECT carrera from director_carrera order by user_ide;";
                    $resultx=mysql_query($sqlx);
                    $i=0;
                    echo "<table class='table table-bordered table-striped' >";
                    echo "<tr><th>Carrera</th><th>Horas de PTC</th><th>Horas de PA</th><th>Horas de Administrativos</th></tr>";
                    while($filax = mysql_fetch_row($resultx)){ 
                      $Seani->ptcVSpaporCarrera($filax[0],$abreviatu[$i++],$periodo_actual);
                    }
                    echo "</table>";*/

                 ?>
                <!--<hr>
                  <?php //echo $ConsultaHoras = $Seani->ptcVSpa(8); //se agrega parametro ?>
                <hr>-->
              </div>
              <button id="tableExport2">EXCEL</button>
                                                                
              <table id="tableConcen" class="table table-bordered table-striped  data_table3"  >
                <thead>
                  <tr>
                    <th>No.<br/>Empleado</th>
                    <th>Nombre</th>
                    <!--<th>Paterno</th>
                    <th>Materno</th>-->
                    <th>CATEG.</th>
                    <th>PERFIL</th>
                    <th>MATERIAS QUE IMPARTE</th>                                                                                                            
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">FRENTE <br/> A GRUPO</th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">ASESORIA <br/> GRUPOS</th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">ASESORÍA <br/> ESTADIAS</th>                                                               
                    <!--<th style="color: #007E3A; font-weight: bold;font-size : 6pt">ASESORIA <br/> TESIS</th>-->
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">TUTORIA</th>
                    <!--<th style="color: #007E3A; font-weight: bold;font-size : 6pt">CUERPOS <br/>ACADEMICO </th>-->
                    <!--<th style="color: #007E3A; font-weight: bold;font-size : 6pt">REUNION<br/> ACADEMICO</th>-->
                    <!--<th style="color: #007E3A; font-weight: bold;font-size : 6pt">TALLER/LAB.</th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt"><br/> INVESTIG. </th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">ADMON. <br/>(ISO)</th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">CURSOS<br/> ACTUALIZACION </th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">DIFUSION </th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">PROYECTOS</th>-->
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">TOTAL </th>
                    <th style="color: #007E3A; font-weight: bold;font-size : 6pt">OBSERVACIONES</th>
                  </tr>
                </thead>
                <tbody align="center">
                                
                  <?php   
                  echo $DatosPersonaleTabla = $Seani->ObtenerDatosCargahoraria($periodo_actual); //se agregó parametro
                  ?>     
                          
                </tbody>
              </table>
              <input class="btn submit_form" type="submit" value="Guardar Version" />  
            </div><!--tab1-->
                                            
            <div id="tab2" class="tab_content"> 
                                            
              <div class="row-fluid">
                <form id="demovalidation" action='CargahorariaPorCarrera.php' method='post' > 
                       
                  <div class="section">
                    <label>Carreras<small></small></label>
                  <div>
                  <?php
                       $Carreras = $Seani->TodaslasCarreraSelect();
                       //$Seani->SelecionarPeriodo();
                  ?>

                  <div class="section">
                    <label>Periodo<small></small></label>
                  <div>
                  <?php
                       //$Carreras = $Seani->TodaslasCarreraSelect();
                       $Seani->SelecionarPeriodo();
                  ?>
                                               
                  <input class="btn submit_form" type="submit" value="Consultar" />  
                </form>
                    
              </div>  
            </div><!--tab2-->
                          
            <div id="tab3" class="tab_content"> 
                                                                        
              <table class="table table-bordered table-striped  data_table3"  >
                <thead>
                  <tr>
                    <th>No.<br/>Empleado</th>
                    <th>Nombre</th>
                    <th>Paterno</th>
                    <th>Materno</th>
                    <th>Materia</th>
                    <th>Grupo</th>
                    <th>Matutino</th>
                    <th>Carrera</th>
                    <th>Horas</th>
                  </tr>
                </thead>
                <tbody align="center">
                                                    
                  <?php   echo $DocenteporMateria = $Seani->ObtenerDocentePorMateriaI($periodo_actual); //se agrega parametro    ?>     
                              
                </tbody>
              </table>

            </div><!--tab3 </div></div><! End UITab -->
                          
            <div class="clearfix">
                            
            </div>
          </div><!--  end widget-content -->
        </div><!-- widget  span12 clearfix-->
        <div class="row-fluid">
                  		<!-- Table widget -->
        </div><!-- row-fluid -->
        <div class="row-fluid">
          <div id="footer">&copy; Copyright 2014  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span> </div>
                  
        </div> <!--// End inner -->
      </div> <!--// End ID content -->
      <script>

      $(document).ready(function(){


          $('#tableExport').click(function(e){
            e.preventDefault();
            
            $('#tableConcen').tableExport({type:'pdf',escape:'false'});
          });
          $('#tableExport2').click(function(e){
            e.preventDefault();
            
            $('#tableConcen').tableExport({type:'excel',escape:'false'});
          });

          $('#cuenta').click(function(e){
            e.preventDefault();
            
            $('#divCuenta').toggle();
            
          });

          $('.conVal').click(function(){
            var este=$(this).attr('class');
            alert(este);
          });

      });

      </script> 
    </body>
</html>