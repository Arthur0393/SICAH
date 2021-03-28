<?php

  session_start();

      if (!$_SESSION["account_name"]) {
      
      //    header('Location: ../index.php');
      
          echo '<script type="text/javascript">';
          echo 'alert("No has iniciado sesión' . $error . '");';
          echo 'window.location.assign("../index.php");';
          echo '</script>';
          
      } else if ($_SESSION["tipo_usuario"] != 2) {
      
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
        <script type="text/javascript" src="components/validationEngine/jquery.validationEngine-es.js"></script>
        <script type="text/javascript" src="components/fullcalendar/fullcalendar.js"></script>
        <script type="text/javascript" src="components/flot/flot.js"></script>
        <script type="text/javascript" src="components/uploadify/uploadify.js"></script>       
        <script type="text/javascript" src="components/Jcrop/jquery.Jcrop.js"></script>
        <script type="text/javascript" src="components/smartWizard/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
        <script type="text/javascript" src="js/zice.custom.js"></script>
  
        <script type"text/javascript" src="scriptextraido.js"></script>

        <style>
          #contenedor{
            width: 700px;
            height: 300px;
            border: 1px solid black;
          }
        </style>

		</head>        

    <body>        

      <!-- Header -->

      <?php include_once('include/header.php'); ?>

      <!-- End Header -->

      <!-- left_menu -->

      <div id="left_menu">

                    <ul id="main_menu" class="main_menu">

<!--                      <li class="select" ><a href="#"style="color: #292929;" ><b>Dashboard</b></a></li>-->

                    <li ><a href="index.php" > Carga Horaria </a></li>
                    <li class="select" ><a style="color: #292929;"  href="CargaPorDocente.php" > Carga Por Docente </a></li>
                    <li ><a href="Cargahoraria.php" > Concentrado </a></li>
                    <li ><a href="AdminDocentesdire.php" > Listado de Docentes </a></li>
                     <!--<li ><a href="CarrerasCargaHoraria.php" > Administrar Carga Horaria </a></li> -->
                    
                    </ul>

      </div>

      <div id="content" >

          <div class="inner">

                   <!-- menu -->

            <?php include_once('include/menu.php'); ?>

            <div class="row-fluid">

            <form id="demovalidation" action='#' method='post'> <!--action='GuardarCargaIndividual.php' method='post' >-->

            <?php

                echo ' <div class="section">';
                echo '<label>Seleciona un Docente<small>Asignar</small></label> ';
                echo ' <div>';

                $Docentes=$Seani->SelecionarTodosDocentes3();

                $tipo=2;

                echo ' </div>';
                echo ' </div>';
            
                echo ' <div class="section">';
                echo ' <label>Elige Concepto<small>Carga Horaria</small></label>';
                echo ' <div>';

                $Docentes=$Seani->SelecionarConceptoCargaHoraria($tipo);

                //$materia=$_GET['materia'];

                echo '</div>';
                echo '</div>';

                $Carreras = $Seani->CarreraPorDirectorSelect($idusuario); 

                //echo" <input type='hidden' value='$materia' name='materia' />";

            ?>

            <div id="sumatoria" class="section">                   
                
                </div>

               <div class="section numeric">

                  <label> Numero <small>Horas Asignar</small></label>   

                  <div> 
                     <input type="text" class="validate[required] small" required="" name="nhoras" id="f_required">
                  </div>

                </div>

                <div class="section" id="descrip">

                    <label> Descripción <small>Introducción, Justificación,	Objetivos, Descripción,	Cronogramas de Actividades, Entregables.</small></label>   

                    <div > 
                      <textarea name="descripcion" id="Textareaelastic"  class="large"  cols="" rows=""></textarea>
                    </div>   
                
                </div>

                <input id="boton" class="btn submit_form" type="submit" value="Guardar Carga Horaria" />  


              <div id="formato" class="section">
                <div class="section">
                  <label>Título del Proyecto</label>
                  <input type="text" id="titulo" required>
                </div>
                <div class="section">
                  <label>Línea de Investigación o Cuerpo Académico</label>
                  <input type="text" id="cuerpoAca" required>
                </div>
                <div class="section">
                  <label>Objetivo General</label>
                  <input type="text" id="objeGral" required>
                </div>
                <div class="section" id="nue">
                  <label id="objEmp">
                    
                  </label>
                  <!--<script>
                  
                    if($('#objEmp').text()=="empresa"){
                      document.write("<input type='text' id='objetEmpresa'>");
                    }else{
                      document.write("<textarea id='objetEmpresa'>");                
                    }

                </script>-->
                <div id='este'></div>
                <script>
                    
                      $('#conceptosCH').blur(function (){
                        if($('#conceptosCH').val()==14){
                          $('#objEmp').text("Objetivos Específicos");
                          $('#este').empty();
                          $('#este').append("<textarea id='objetEmpresa' class='vacio' required>");                          
                        }else{
                          $('#objEmp').text("Empresa");
                          $('#este').empty();
                          $('#este').append("<input type='text' id='objetEmpresa' class='vacio' required>");
                        }
                      });
                   
                    </script>
                </div>
                <div class="section">
                  <label for="">
                  Justificación
                  </label>
                  <input type="text" id="justifi" required>
                </div>
                <div class="section"><button id="botonProy" disabled="" class="btn submit_form">Guardar / Agregar Actividades</button>
                <button id="limpiar" class="btn submit_form">Limpiar</button></div>
                <div class="section2">
                  <div id="contenedor"></div>
                </div>

              </div>

              <input type="text" id="idRegresado">

              </form>


              <div class="clearfix"></div>

            </div><!-- row-fluid -->

            <div class="row-fluid">

                <div id="footer">&copy; Copyright 2014  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span> </div>

            </div> <!--// End inner -->

            </div> <!--// End ID content --> 
            <script>
            
            $(document).ready(function(){

            $('#formato').hide();
            $('#sumatoria').hide();
            $('#contenedor').hide();
            $('#idRegresado').hide();
            $('#botonProy').hide();

            $('#conceptosCH').blur(function (){
              var idconcepto=$('#conceptosCH').val();
              if(idconcepto==4){
                $('#sumatoria').show();
                $('#formato').hide();
                $('#descrip').show();
                $('#boton').show();
              }else if(idconcepto==10 || idconcepto==14){
                $('#sumatoria').hide();
                $('#formato').show();
                $('#descrip').hide();
                //$('#boton').hide();
              }else{
                $('#sumatoria').hide();
                $('#formato').hide();
                $('#descrip').show();
                $('#boton').show();
              }              
            });

            $('#id_carrera').blur(function (e){
              e.preventDefault();
              var idconcepto=$('#conceptosCH').val();
              var idcarrera=$('#id_carrera').val();
              if(idconcepto==4 && idcarrera!=''){
              $('#sumatoria').load('obtieneSuma.php',{
                enviaCarrera:idcarrera
              });
            }

            $.post('extrasBD.php',{
              opcion:5,
              iddocente:$('#docente').val(),
              idconcepto:$('#conceptosCH').val(),
              idcarrera:$('#id_carrera').val()
            },function(vregresado){
              
              if(vregresado!="")
                {
                var Existe=vregresado.split(".%");
                
                $('#f_required').val(Existe[0]);
                $('#Textareaelastic').val(Existe[1]);
                
                }

            });

            $.post('extrasBD.php',{
                opcion: 1,
                idcarrera: $('#id_carrera').val(),
                iddocente: $('#docente').val(),
                conceptosCH: $('#conceptosCH').val()
                },function(vregresado){
                $('#idRegresado').val(vregresado);

                ConsultaProyecto();
                
              });



            });

            $('#boton').click(function(e){
              e.preventDefault(); 

              var valido=0;

              if($('#docente').val().length>=1){
                valido++;
              }
              if($('#conceptosCH').val().length>=1){
                valido++;
              }
              if($('#id_carrera').val().length>=1){
                valido++;
              }
              if($('#f_required').val().length>=1){
                valido++;
              }
            
              if(valido==4){

                alert('Información enviada');

                            guardarProyectos();  

              } else {

                alert("LLena todos los campos");
}
                         });

            $('#limpiar').click(function(e){
              e.preventDefault();
              location.reload();
            });

            $('#botonProy').click(function(e){
              e.preventDefault();

                var valido=0;

                  if($('#titulo').val().length>1){
                    valido++;
                  }
                  if($('#cuerpoAca').val().length>1){
                    valido++;
                  }
                  if($('#objeGral').val().length>1){
                    valido++;
                  }
                  if($('#objetEmpresa').val().length>1){
                    valido++;
                  }
                  if($('#justifi').val().length>1){
                    valido++;
                  }

                  if(valido==5)
                  {
                     guardaComplementoProyecto(); 
                  }else{
                    alert("llena todos los campos");
                  }
            });

          });

          function guardarProyectos(){
          
              $.post('extrasBD.php',{
                opcion: 2,
                docente: $('#docente').val(),
                conceptosCH: $('#conceptosCH').val(),
                id_carrera: $('#id_carrera').val(),
                nhoras: $('#f_required').val(),
                descripcion: $('#Textareaelastic').val()
              },function (){
                
              
                if($('#conceptosCH').val()==14 || $('#conceptosCH').val()==10)
                {
                  $('#boton').hide();
                  $('#botonProy').show();

                }else{
                  location.reload();
                }

              });
              }
          
             function guardaComplementoProyecto(){

           
                $.post('extrasBD.php',{
                  opcion: 3,
                  idDesglose: $('#idRegresado').val(),
                  tituloProyecto: $('#titulo').val(),
                  lineaCuerpo: $('#cuerpoAca').val(),
                  objetivoGeneral: $('#objeGral').val(),
                  objetivoEmpresa: $('#objetEmpresa').val(),
                  justificacion: $('#justifi').val()
                }, function(vregresado){  //el valor regresado debe ser el id en formao proyecto con la consulta de iddesglose
                                          //el jtable se llenará con el que coincida con vregresado
                  $('#contenedor').show();
                 
                  $('#contenedor').load('listaActividades.php',{
                    idActiviProy: vregresado
                  });
                });
              }

              function ConsultaProyecto(){

               $.post('extrasBD.php',{
                  opcion: 4,
                  idDesglose: $('#idRegresado').val()
               }, function(vregresado){

                if(vregresado!="")
                {
                var Existe=vregresado.split(".%");
                
                $('#titulo').val(Existe[0]);
                $('#cuerpoAca').val(Existe[1]);
                $('#objeGral').val(Existe[2]);
                $('#objetEmpresa').val(Existe[3]);
                $('#justifi').val(Existe[4]);
                
                }
               
               });

              }

          </script>

        </body>

        </html>