<?php 
session_start();
if (!$_SESSION["account_name"]){
   header('Location: ../index.php');
  }
  
  if (!isset($_SESSION["cuenta_paginas"])){ 
   	$_SESSION["cuenta_paginas"] = 1; 
}else{ 
   	$_SESSION["cuenta_paginas"]++; 
} 
setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time()+86400); 

/*$valorpagina=1;
echo $intento;
if($_SESSION["cuenta_paginas"] > $valorpagina ){
	echo '<script type="text/javascript">';
	echo 'alert("¡Accion No Permitida! al tercer intento se anulara tu examen");';
	echo '</script>';
	echo '<meta http-equiv="refresh" content="0, url=serie1ejemplo.php">';
} 
*/
  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
        <meta charset="utf-8">
         <title>SISEAC.-Matriz de competencia</title>
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
        <script>
		$(document).ready(function() {
			// Form Cloning 
			var sheepItForm = $('#cloneForm').sheepIt({
				separator: '',
				allowRemoveLast: true,
				allowRemoveCurrent: true,
				allowRemoveAll: true,
				allowAdd: true,
				maxFormsCount: 10,
				minFormsCount: 0,
				iniFormsCount: 2
			});
		});
		</script>
        
		</head>        
        <body>        
        
            <!-- Header -->
            <?php include_once('include/header.php'); ?><!-- End Header -->

              <!-- left_menu -->
              <div id="left_menu">
                    <ul id="main_menu" class="main_menu">
                      <li  ><a href="index.php" ><b>Dashboard</b></a></li>
                    <li ><a href="profile.php"> Perfil </a></li>
                      <li class="select"><a  style="color: #292929;" href="#" > Matriz de Competencias T.S.U. </a>
 
        <ul>
                         <li><a href="matrizcompetencia.php">MAI</a></li>
                          <li><a href="#">PIAA</a></li>
                          <li><a href="#">  MAAU </a></li>
                          <li><a href="#">  DNAM</a></li>
                          <li><a href="#">  DMIAP</a></li>
                          <li><a href="#"> TICMCE</a></li> 
                           <li><a href="#">  PIAM </a></li>
                        </ul>
    
    </li>
    <li  ><a href="matrizcompetenciaIng.php" > Matriz de Competencias Ingeniería</a>
    
        <ul>
                          <li><a href="#"> IPOI</a></li>
                          <li><a href="#"> IMI</a></li>
                          <li><a href="#"> ITEC</a></li>
                          <li><a href="#"> INGEM </a></li>
                          <li><a href="#"> IDTM </a></li>
                          <li><a href="#"> ITI </a></li>
                        </ul>
    
    
    
    </li>
                      <li><a href="#"><span class="ico gray shadow calendar"></span><b>Calendario </b></a></li>
                       <li><a href="#"> Encuestas</a></li>
                    </ul>
               </div>

            
               <div id="content" >
                <div class="inner">
                                    
                   <!-- menu -->
               <?php include_once('include/menu.php'); ?>
                    
                
                    <div class="row-fluid">
                    
                    		<!-- Widget -->
                            <div class="widget  span12 clearfix">
                            
                                <div class="widget-header">
                                    <span><i class="icon-list"></i> TSU en Mantenimiento Área Industrial</span>
                                </div><!-- End widget-header -->	
                                
                                <div class="widget-content">
                                <div class="boxtitle"><i class="icon-hdd"></i> MAPA CURRICULAR:   <span class="netip"><a href="#" class="red" title=""> 2009  </a></span>
                                      </div>
                                <div class="row-fluid">
                                	<div class="span5">
                                    <div class="clearfix">
                                    <input type="text" id="box1Filter"placeholder="Filtro" /><br />
                                    <select id="box1View" multiple="multiple" style="height:300px;width:100%;">
                                        <option value="Álgebra">1.    Álgebra 1º</option>
                                        <option value="Estática y dinámica" selected="selected">2.    Estática y dinámica   1º</option>
                                        <option value="Informática">3.    Informática 1º</option>
                                        <option value="Introducción al mantenimiento">4.    Introducción al mantenimiento   1º</option>
                                        <option value="Calidad en el mantenimiento">5.    Calidad en el mantenimiento 1º</option>
                                        <option value="Inglés I" selected="selected">6.    Inglés I  1º</option>
                                        <option value="Expresión oral y escrita I" selected="selected">7.    Expresión oral y escrita I  1º</option>
                                        <option value="Formación sociocultural I" selected="selected">8.    Formación sociocultural I 1º</option>
                                        <option value="Cálculo">9.    Cálculo   2º </option>
                                        <option value="501075">10.   Administración del personal   2º </option>
                                        <option value="501493" selected="selected">11.   Dibujo industrial   2º </option>
                                        <option value="501562">12.   Sistemas eléctricos   2º </option>
                                        <option value="500676">13.   Métodos y sistemas  de trabajo  2º </option>
                                        <option value="501460">14.   Costos y presupuestos 2º </option>
                                        <option value="500004">15.   Inglés II 2º </option>
                                        <option value="500336">16.   Formación sociocultural II  2º </option>
                                        <option value="501649">17.   Seguridad y medio ambiente  3º </option>
                                        <option value="501497" selected="selected">2.    Estática y dinámica   1º</option>
                                        <option value="501649">18.   Máquinas y mecanismos 3º </option>
                                          <option value="501649">19.   Electrónica analógica 3º  </option>
                                            <option value="501649">20.   Sistemas neumáticos 3º  </option>
                                              <option value="501649">21.   Gestión del mantenimiento 3º  </option>
                                                <option value="501649">22.   Integradora I 3º </option>
                                                  <option value="501649">23.   Inglés III  3º  </option>  
                                                  <option value="501649">24.   Formación sociocultural III 3º </option>
                                                    <option value="501649">25.   Ingeniería de materiales  4º </option>
                                                      <option value="501649">26.   Máquinas eléctricas 4º  </option>
                                                        <option value="501649">27.   Electrónica digital 4º  </option>
                                                          <option value="501649">28.   Principios de programación  4º  </option>
                                                            <option value="501649">29.   Sistemas hidráulicos  4º  </option>
                                                              <option value="501649">30.   Redes de servicios industriales 4º  </option>
                                                                  <option value="501649">31.   Inglés IV 4º  </option>
                                                                      <option value="501649">32.   Formación sociocultural  IV 4º   </option>
                                                                          <option value="501649">33.   Mantenimiento a procesos de manufactura 5º  </option>
                                                                              <option value="501649">34.   Instalaciones eléctricas  5º </option>
                                                                                  <option value="501649">36.   Máquinas térmicas 5º</option>
                                                                                      <option value="501649">37.   Integradora II  5º </option>
                                                                                          <option value="501649">38.   Inglés V  5º </option>
                                                                                              <option value="501649">39.   Expresión oral y escrita II 5º  </option>
                                                                                              

                                     
                                    </select>
                                    </div>
            
            
                                   <span id="box1Counter" class="countLabel"></span>
                                   <select id="box1Storage"></select>
            
                                    </div>
                                	<div class="span2" align="center">
                                        <div class="boxMove">
                                            <p>
                                            <a class="btn btn-large" id="to2"><i class="icon-step-forward"></i></a>
                                            <a class="btn btn-large" id="allTo2"><i class="icon-fast-forward"></i></a>
                                            </p>
                                            <p>
                                            <a class="btn btn-large" id="to1"><i class="icon-step-backward"></i></a>
                                            <a class="btn btn-large" id="allTo1"><i class="icon-fast-backward"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                	<div class="span5">
                                    <input type="text" id="box2Filter" placeholder="Filtro" /><br />
                                    <form id="demoform" action="insert/matrizaMAI.php" method="post">
                                    <select id="box2View" name="matrizC[]" multiple="multiple" style="height:300px;width:100%;"></select>
              
                            <button type="submit" class="btn btn-default btn-block">Guardar Matriz</button>
                        </form>
                                    <!-- clear fix -->
                                    <div class="clear"></div>
        
                                    <span id="box2Counter" class="countLabel"></span>
                                    <select id="box2Storage"></select>
                                    </div>
                                </div>

                                
                                </div><!--  end widget-content -->
                            </div><!-- widget  span12 clearfix-->

                    </div><!-- row-fluid -->
                    
        
                 <div id="footer"> &copy; Copyright 2013  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a></span> </div>
      
                </div> <!--// End inner -->
              </div> <!--// End ID content --> 

        </body>
        </html>