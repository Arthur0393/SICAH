<?php

  header('Location: AdminDirectorC.php');

  session_start();
  if (!$_SESSION["account_name"])
  {   
    //    header('Location: ../index.php');
    echo '<script type="text/javascript">';
    echo 'alert("No has iniciado sesión' . $error . '");';
    echo 'window.location.assign("../index.php");';
    echo '</script>';

  } else if ($_SESSION["tipo_usuario"] !=2) {

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
        <li ><a href="AdminDocentes.php" > Administrar Docentes </a></li>
      </ul>
    </div>

    <div id="content" >
      <div class="inner">
        <!-- menu -->
        <?php include_once('include/menu.php'); ?>

        <div class="row-fluid">

       		<!-- Dashboard  widget -->
          <div class="widget  span12 clearfix">

            <div class="span6">

              <div class="widget  clearfix">

                <div class="widget-header">
                  <span><i class="icon-user"></i> Ultimos mensajes</span>
                </div><!-- End widget-header -->	

                <div class="widget-content" style="padding-top:0px;padding-bottom:0px">
                    <table  class="table  table-striped">
                      <thead>
                        <tr align="left">
                          <th>Tema</th>
                          <th>Tiempo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon new"></div>
                              <div class="msg_topic"><strong>Director</strong> <span>Reunion</span></div>
                            </div>
                          </td>
                          <td >a few seconds ago</td>
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon new"></div>
                              <div class="msg_topic"><strong>Recursos Humanos</strong> <span>Firma de recibos</span></div>
                            </div>
                          </td>
                          <td >55 seconds ago</td>
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon new"></div>
                              <div class="msg_topic"><strong>Secretaria Academica</strong> <span>Curso</span></div>
                            </div>
                          </td>
                          <td >45 minute ago</td>
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon open"></div>
                              <div class="msg_topic">Director <span>Curso Java</span></div>
                            </div>
                          </td>
                          <td >10 day ago</td>
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon open"></div>
                              <div class="msg_topic">SAIIUt<span>Apertura sistema</span></div>
                            </div>
                          </td>
                          <td >10 day ago</td>  
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon ans"></div>
                              <div class="msg_topic">Secretaria Carrera <span>RE: Firma de Oficio</span></div>
                            </div>
                          </td>
                         <td >19 day ago</td>
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon new"></div>
                              <div class="msg_topic"><strong>Recurso Materiales</strong> <span>Inventario</span></div>
                            </div>
                          </td>
                          <td >25 day ago</td>
                        </tr>
                        <tr>
                          <td >
                            <div class="msg">
                              <div class="msg_icon open"></div>
                              <div class="msg_topic">Rectoria <span>Mensaje</span></div>
                            </div>
                          </td>
                          <td > 2 Months.</td>
                        </tr>
                      </tbody>
                    </table>
                  
                  </div><!--  end widget-content -->
                </div><!-- widget  clearfix-->
              </div><!-- span6 -->

              <div class="span6">
                <div class="widget  clearfix">
                  <div class="widget-header">
                    <span><i class="icon-rss"></i> Ultimas noticias</span>
                  </div><!-- End widget-header -->	
                  <div class="widget-content">
                    <div id="news_update" style="position: relative;" >
                      <ul style="position: absolute; margin: 0pt; padding: 0pt; top: 0px; width: 100%;">
                        <li>
                          <div class="temp_news"><img src="exampic/5.jpg" alt="emptyimg" /></div>
                          <div class="detail_news">
                            <div class="boxtitle min" > New update, topic 1</div>
                            <p>Lorem ipsum dolor sit amet, consectetur
                              adipiscing elit. Quisque non leo
                              convallis nibh tristique commodo. 
                            </p>
                            <span class="datepost">02/25/2012</span><span class="morelink"><a href="#" class="red">more</a></span> 
                          </div>
                          <br class="clear"/>
                        </li>
                        <li>
                          <div class="temp_news"><img src="exampic/2.jpg" alt="emptyimg" /></div>
                          <div class="detail_news">
                          <div class="boxtitle min" > New update , topic 2</div>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non leo onvallis nibh tristique commodo. 
                          </p>
                          <span class="datepost">02/25/2012</span><span class="morelink"><a href="#" class="red">more</a></span> </div>
                          <br class="clear"/>
                        </li>
                        <li>
                          <div class="temp_news"><img src="exampic/7.jpg" alt="emptyimg"/></div>
                          <div class="detail_news">
                            <div class="boxtitle min" > New update , topic 3</div>
                            <p>Lorem ipsum dolor sit amet, consectetur
                              adipiscing elit. Quisque non leo
                              convallis nibh tristique commodo. 
                            </p>
                            <span class="datepost">02/25/2012</span><span class="morelink"><a href="#" class="red">more</a></span> </div>
                            <br class="clear"/>
                          </li>
                        </ul>
                      </div>

                    </div><!--  end widget-content -->
                  </div><!-- widget  clearfix -->
                </div><!-- span4 -->
            </div><!-- row-fluid -->

                    

                     <div class="widget-header">

                                    <span><i class="icon-home"></i> Dashboard Manager</span>

                                </div><!-- End widget-header -->  

                                <div class="widget-content"><br />

                                    <div class="row-fluid">

                                          <div class="span4">

                                                <div class="shoutcutBox"> <span class="ico color chat-exclamation"></span> <strong>8.5</strong> <em>7A tics</em> </div>

                                                <div class="breaks"><span></span></div>

                                                <div class="shoutcutBox" > <span class="ico color item"></span> <strong>9.3</strong> <em> 7b tics</em> </div>

                                                <div class="shoutcutBox"> <span class="ico color group"></span> <strong>7.3</strong> <em>4b tics</em> </div>

                                                <div class="shoutcutBox"> <span class="ico color emoticon_grin"></span> <strong>8.1</strong> <em>4a tics </em> </div>

                                                <div class="breaks"><span></span></div>

                                                <div class="shoutcutBox"> <span class="ico color emoticon_in_love"></span> <strong>7.6</strong> <em>4c tics</em> </div>

                                                <div class="shoutcutBox last"> <span class="ico color connect"></span> <strong>9.8</strong> <em>4atica </em> </div><br><br>

                                          </div><!-- span4 column-->

                                          

                                          <div class="span8">

                                                <div  class="Onechart">

                                                <table class="chart" style="width : 100%;">

                                                    <thead>

                                                        <tr>

                                                            <th width="10%"></th>

                                                            <th width="25%" style="color : #bedd17;">Promedio Calificaciones</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <tr>

                                                            <th>1</th>

                                                            <td>700</td>

                                                        </tr>

                                                        <tr>

                                                            <th>2</th>

                                                            <td>500</td>

                                                        </tr>

                                                        <tr>

                                                            <th>3</th>

                                                            <td>650</td>

                                                        </tr>

                                                        <tr>

                                                            <th>4</th>

                                                            <td>400</td>

                                                        </tr>

                                                        <tr>

                                                            <th>5</th>

                                                            <td>650</td>

                                                        </tr>

                                                        <tr>

                                                            <th>6</th>

                                                            <td>750</td>

                                                        </tr>

                                                        <tr>

                                                            <th>7</th>

                                                            <td>550</td>

                                                        </tr>

                                                    </tbody>

                                                </table>

                                                </div>

                                          </div><!-- span8 column-->

                            

                                    </div><!-- row-fluid column-->

                                </div><!--  end widget-content -->

                            </div><!-- widget  span12 clearfix-->

                    </div><!-- row-fluid -->

                    <div class="row-fluid">

                    <div id="footer">&copy; Copyright 2014  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span> </div>

                </div> <!--// End inner -->

              </div> <!--// End ID content --> 

        </body>

        </html>