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
ini_set('session.bug_compat_42', "0");
ini_set('session.bug_compat_warn', "0");
?>

<style>
    /*
     * Copyright (c) 2013 Thibaut Courouble
     * http://www.cssflow.com
     *
     * Licensed under the MIT License:
     * http://www.opensource.org/licenses/mit-license.php
     *
     * View the Sass/SCSS source at:
     * http://www.cssflow.com/snippets/task-list/demo/scss
     *
     * Original PSD by Wassim Bourguiba: http://goo.gl/OUpkfy
     */

    @import url(http://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css);

    body {
        font: 8px/20px 'Lucida Grande', Verdana, sans-serif;
        color: #404040;
        background: #f2f8fc;
    }
    .a{
        font-size: 7px;
    }

    .tasks {
        margin: 40px auto;
        width: 130px;
        height: 1080px;
        background: white;
        border: 1px solid #cdd3d7;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .tasks-header {
        position: relative;
        line-height: 24px;
        padding: 7px 15px;
        color: #5d6b6c;
        text-shadow: 0 1px rgba(255, 255, 255, 0.7);
        background: #f0f1f2;
        border-bottom: 1px solid #d1d1d1;
        border-radius: 3px 3px 0 0;
        background-image: -webkit-linear-gradient(top, #f5f7fd, #e6eaec);
        background-image: -moz-linear-gradient(top, #f5f7fd, #e6eaec);
        background-image: -o-linear-gradient(top, #f5f7fd, #e6eaec);
        background-image: linear-gradient(to bottom, #f5f7fd, #e6eaec);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 1px rgba(0, 0, 0, 0.03);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 1px rgba(0, 0, 0, 0.03);
    }

    .tasks-title {
        line-height: inherit;
        font-size: 14px;
        font-weight: bold;
        color: inherit;
    }

    .tasks-lists {
        position: absolute;
        top: 50%;
        right: 10px;
        margin-top: -11px;
        padding: 10px 4px;
        width: 19px;
        height: 3px;
        font: 0/0 serif;
        text-shadow: none;
        color: transparent;
        font-size: 10px;
    }

    .tasks-lists:before {
        content: '';
        display: block;
        height: 3px;
        background: #8c959d;
        border-radius: 1px;
        -webkit-box-shadow: 0 6px #8c959d, 0 -6px #8c959d;
        box-shadow: 0 6px #8c959d, 0 -6px #8c959d;
    }

    .tasks-list-item {
        display: block;
        line-height: 24px;
        padding: 12px 15px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .tasks-list-item + .tasks-list-item {
        border-top: 1px solid #f0f2f3;
    }

    .tasks-list-cb {
        display: none;
    }

    .tasks-list-mark {
        position: relative;
        display: inline-block;
        vertical-align: top;
        margin-right: 12px;
        width: 15px;
        height: 15px;
        border: 2px solid #c4cbd2;
        border-radius: 12px;
    }

    .tasks-list-mark:before {
        content: '';
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -5px 0 0 -6px;
        height: 4px;
        width: 8px;
        border: solid #39ca74;
        border-width: 0 0 4px 4px;
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .tasks-list-cb:checked ~ .tasks-list-mark {
        border-color: #39ca74;
    }

    .tasks-list-cb:checked ~ .tasks-list-mark:before {
        display: block;
    }

    .tasks-list-desc {
        font-weight: bold;
        color: #8a9a9b;
        font-size:10px;
    }

    .tasks-list-cb:checked ~ .tasks-list-desc {
        color: #FF6900;
        text-decoration: underline;

    }


</style>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Siseac&trade; Perfil Profesor</title>
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

        <!--        tabla de grado academicos-->
        <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link href="scripts/jtable/themes/lightcolor/orange/jtable.css" rel="stylesheet" type="text/css" />

<!--	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>-->
        <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>


    </head>        
    <body>        

        <!-- Header -->
        <?php include_once('include/header.php'); ?><!-- End Header -->

        <!-- left_menu -->
       <div id="left_menu">
                    <ul id="main_menu" class="main_menu">
<!--                      <li class="select" ><a href="#"style="color: #292929;" ><b>Dashboard</b></a></li>-->
                    <li  ><a href="index.php" > Dashboard </a></li>
                       <li class="select"   ><a href="AdminDocentes.php" style="color: #292929;"> Administrar Docentes </a></li>
    
                     
                    </ul>
               </div>

        <div id="content" >
            <div class="inner">

                <!-- menu -->
                <?php include_once('include/menu.php'); ?>

                <?php
                //$idusuario = $Seani->obteneIdusuario($username);
               
        $idTabUser= $_GET['idTabUser'];

  $idprf = $_GET['idPrf'];

               //$idusuario = $idprf;
                $DatosP = $Seani->obtenerDatosPersonales($idTabUser);
                ?>
                <div class="row-fluid">

                    <!-- Widget -->


                </div><!-- row-fluid -->
                <!-- tabss -->
                <div class="row-fluid">

                    
                    
                    <!-- Widget -->
                    <?php


?>
                    
                    <div class="widget  span12 clearfix">
                        <div class="widget-header">
                            <span><i class="icon-bookmark"></i> Información</span>
                        </div><!-- End widget-header -->	
                        <div class="widget-content">

                            <div id="UITab" class="clearfix" style="position:relative;">
                                <ul class="tabs">
                                    <li><a href="#tab1"> Datos Personales </a></li>  
                                    <li><a href="#tab2"> Perfil Academico </a></li>    
                                    <li><a href="#tab3"> Matriz de Competencia </a></li>  
                                    <li><a href="#tab4"> Datos cuenta</a></li>  
                                 
                                </ul>

                                <div class="tab_container" >
                                    <!--tab1-->
                                    <div id="tab1" class="tab_content"> 
                                        <div class="load_page">
                                            <div class="widget-content">    


                                                <div class="boxtitle"><i class="icon-hdd"></i> Fecha última actualización:   <span class="netip"><a href="#" class="red" title=""> <?php echo $DatosP["ultima_actualizacion"]; ?>   </a></span>
                                                </div>

                                                <form id="validation_demo" action="InsertdatosPersonales.php" method="post" enctype="multipart/form-data"> 

                                                    <div class="row-fluid">
                                                        <div class="span4">
                                                            <div class="profileSetting" >

                                                                <div class="avartar"><img src=<?php
                                                                    echo"'";
                                                                    echo $foto;
                                                                    echo"'";
                                                                    ?> width="180" height="180" alt="avatar" /></div>
                                                                <div class="avartar">
                                                                    <input type="file" name="archivo" id="archivo" class="fileupload" />
             <!--                                                       <input type="file" name="archivo" id="archivo" class="fileupload"/>-->
             <!--                                                   <p align="center"><span> O </span>Tomo foto con <a class="takeWebcam">Webcam</a></p>-->


                                                                </div>
                                                                <p align="center" style="color:#FF6900; font-size:14px; "> Tu foto se guardará al enviar el formulario</p>
                                                            </div>
                                                            <hr/>
                                                        </div>

                                                        <div class="span8">
                                                            <!--                                            <div class="section webcam">
                                                                                                                <label> Toma foto<small>con  webcam</small></label>   
                                                                                                                <div> 
                                                                                                                              <div id="screen"></div>
                                                                                                                              <div class="buttonPane">
                                                                                                                                  <a id="takeButton" class="uibutton">Toma</a> <a id="closeButton" class="uibutton special">Cerrar</a>
                                                                                                                              </div>
                                                                                                                              <div class="buttonPane hideme">
                                                                                                                                  <a id="uploadAvatar" class="uibutton confirm">Subir Foto</a> <a id="retakeButton" class="uibutton special">volve a tomar</a> 
                                                                                                                            </div>
                                                                                                                </div>
                                                                                                        </div>-->
                                                            
                                                                  <div class="section">
                                                                <label> Nombre Completo <small></small></label>
                                                                <div>
                                                                    <input type="email"  value="<?php echo $DatosP["nombre"];  echo " "; echo $DatosP["ap_paterno"]; echo " "; echo $DatosP["ap_materno"];?>" name="email" id="username"  class="validate[required,custom[email]]  large" disabled  />

                                                                </div>

                                                            </div>
                                                            

                                                            <div class="section ">
                                                                <label>Máximo grado de estudio <small></small></label>   
                                                                <div>
                                                                    <select class="small" name="titulo">
                                                                        <option value="0"  ></option>
                                                                        <?php
                                                                        $GradoTitulo = $Seani->obteneLicenciautura($idTabUser);
                                                                        echo "<option  selected='selected'   value='" . $GradoTitulo["id"] . "'>- " . $GradoTitulo["grado"] . " </option>";

                                                                        include("../Conecta2.php");

                                                                        $conn = new Conexion();
                                                                        $conn->conectarBD();

                                                                        $sql = "SELECT * FROM prf_titulo";
                                                                        $estado = $conn->consultar($sql);

                                                                        while ($registro = mysql_fetch_array($estado)) {
//                                                                       
                                                                            echo "<option value='" . $registro["id"] . "'>" . $registro["nombre"] . " </option>";
                                                                        }
                                                                        ?>



                                                                        <!--                                                   <option value="1"  >Lic.</option>
                                                                                                                           <option value="2"  >Ing.</option>
                                                                                                                           <option value="3"  >M. en C.</option>
                                                                                                                           <option value="4"  >C.P.</option>
                                                                                                                           <option value="5"  >Dr.</option>-->
                                                                    </select>  
                                                                </div>

                                                                <input type="hidden"  value="<?php echo $idusuario ?>" name="id" id="id"  class="validate[required,minSize[3],maxSize[50],] medium"  />


                                                         


                                                            </div>
                                                            <div class="section">
                                                                <label>Fecha de Incorporación <small> a la UTT</small></label>   
                                                                <div><input type="text"   placeholder="aaaa-mm-dd" id="birthday1" class=" birthday  medium " name="fIncorporacion" size="15"

                                                                            <?php
                                                                            $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                            $estado2 = $conn->consultar($sql2);
                                                                            while ($registro2 = mysql_fetch_array($estado2)) {
                                                                                echo "value='" . $registro2["fecha_incorporacion"] . "'";
                                                                            }
                                                                            ?>         



                                                                            /></div>
                                                            </div> 
                                                            <div class="section ">
                                                                <label>Puesto <small></small></label>   
                                                                <div>
                                                                    <select class="small" name="puesto">

                                                                        <?php
                                                                        $PuestoA = $Seani->obtenerPuesto($idTabUser);
                                                                        echo "<option  selected='selected'   value='" . $PuestoA["id"] . "'>- " . $PuestoA["tipo"] . " </option>";

                                                                        $sql2 = "SELECT * FROM prf_tipo;";
                                                                        $estado2 = $conn->consultar($sql2);
                                                                        while ($registro2 = mysql_fetch_array($estado2)) {

                                                                            echo "<option value='" . $registro2["id"] . "'>" . $registro2["nombre"] . " </option>";
                                                                        }
                                                                        ?>                                                   

                                                                        <!--                                                   <option value="1"  >Profesor Asignatura</option>
                                                                                                                           <option value="2"  >Profesor Tiempo Completo </option>-->
                                                                    </select>  
                                                                </div>

                                                            </div>
                                                            <div class="section">
                                                                <label> E-MAIL <small></small></label>
                                                                <div>
                                                                    <input type="email"  value="<?php echo $DatosP["email"]; ?>" name="email" id="username"  class="validate[required,custom[email]]  large" disabled  />

                                                                </div>

                                                            </div>

                                                            <div class="section">
                                                                <label> TELÉFONO <small></small></label>
                                                                <div>
                                                                    <input type="text"      <?php
                                                                    $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                    $estado2 = $conn->consultar($sql2);
                                                                    while ($registro2 = mysql_fetch_array($estado2)) {
                                                                        echo "value='" . $registro2["tel_personal"] . "'";
                                                                    }
                                                                    ?> name="telefono" id="telefono"  class="validate[required,minSize[3],maxSize[20],] medium"                                                               	   
                                                                           <?php
                                                                           $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idprf';";
                                                                           $estado2 = $conn->consultar($sql2);
                                                                           while ($registro2 = mysql_fetch_array($estado2)) {
                                                                               echo "value='" . $registro2["fecha_incorporacion"] . "'";
                                                                           }
                                                                           ?>  />

                                                                </div>

                                                            </div>

                                                            <div class="section">
                                                                <label>Fecha de nacimiento <small></small></label>   
                                                                <div><input type="text" placeholder="aaaa-mm-dd" id="birthday" class=" birthday medium " name="birthday"                                                                     
                                                                    <?php
                                                                    $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idprf';";
                                                                    $estado2 = $conn->consultar($sql2);
                                                                    while ($registro2 = mysql_fetch_array($estado2)) {
                                                                        echo "value='" . $registro2["fecha_nacimiento"] . "'";
                                                                    }
                                                                    ?>         
                                                                            /></div>
                                                            </div> 

                                                            <div class="section ">
                                                                <label>Sexo<small></small></label>   
                                                                <div> 
                                                                    <!--                                                                    <div>   <?php
                                                                    // echo $DatosP["nombre"];
                                                                    ?>  
                                                                                                                                            <input type="radio" name="genero" id="radio-1" value="Hombre"  class="ck"   <?php ?> checked="checked"/>
                                                                                                                                            <label for="radio-1">Hombre</label>
                                                                                                                                        </div>
                                                                                                                                        <div>
                                                                                                                                            <input type="radio" name="genero" id="radio-2" value="Mujer"  class="ck"  />
                                                                                                                                            <label for="radio-2" >Mujer</label>
                                                                                                                                        </div>-->

                                                                    <select class="small" name="genero">

                                                                        <?php
                                                                        $Genero = $Seani->obtenerGeneroEstado($idTabUser);
                                                                        echo "<option  selected='selected'   value='" . $Genero["genero"] . "'>- " . $Genero["genero"] . " </option>";
                                                                        ?>                                                   
                                                                        <option value="Mujer"  >Mujer </option>
                                                                        <option value="Hombre"  >Hombre</option>
                                                                     
                                                                    </select> 


                                                                </div>
                                                            </div>


                                                            <div class="section alluppercase last">
                                                                <label> CURP <small>18 DÍGITOS</small></label>   
                                                                <div> 
                                                                    <input name="curp" type="text"  class=" validate[required,minSize[10],maxSize[18],] large"                 <?php
                                                                    $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                    $estado2 = $conn->consultar($sql2);
                                                                    while ($registro2 = mysql_fetch_array($estado2)) {
                                                                        echo "value='" . $registro2["curp"] . "'";
                                                                    }
                                                                    ?> >
                                                                </div>
                                                            </div>





                                                         


                                                            <div class="section alluppercase last">
                                                                <label> RFC <small>13 DÍGITOS</small></label>   
                                                                <div> 
                                                                    <input name="rfc" type="text"  class=" validate[required,minSize[10],maxSize[13],] large"                 <?php
                                                                    $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                    $estado2 = $conn->consultar($sql2);
                                                                    while ($registro2 = mysql_fetch_array($estado2)) {
                                                                        echo "value='" . $registro2["rfc"] . "'";
                                                                    }
                                                                    ?> >
                                                                </div>
                                                            </div>

                                                            <div class="section ">
                                                                <label> No. de Empleado <small></small></label>   
                                                                <div> 
                                                                    <input type="text" class="validate[required,custom[onlyNumberSp]] small" name="noempleado" id="3_required" <?php
                                                                    $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                    $estado2 = $conn->consultar($sql2);
                                                                    while ($registro2 = mysql_fetch_array($estado2)) {
                                                                        echo "value='" . $registro2["n_empleado"] . "'";
                                                                    }
                                                                    ?>>
                                                                </div>
                                                            </div>


                                                            <div class="section ">
                                                                <label> Dirección<small></small></label>   
                                                                <div> 
                                                                    <input type="text" class="validate[required,minSize[5],maxSize[58],] large" name="calleyNumero" id="4_required"  placeholder="Calle y Numero" <?php
                                                                    $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                    $estado2 = $conn->consultar($sql2);
                                                                    while ($registro2 = mysql_fetch_array($estado2)) {
                                                                        echo "value='" . $registro2["direcion"] . "'";
                                                                    }
                                                                    ?> >
                                                                </div>

                                                                <label> Localidad<small></small></label>    
                                                                <div> 
                                                                    <input type="text"  class="validate[required,minSize[3],maxSize[58],] large" name="localidad" id="5_required" 

                                                                           <?php
                                                                           $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                           $estado2 = $conn->consultar($sql2);
                                                                           while ($registro2 = mysql_fetch_array($estado2)) {
                                                                               echo "value='" . $registro2["localidad"] . "'";
                                                                           }
                                                                           ?> >             




                                                                </div>
                                                                <label> Municipio<small></small></label>    
                                                                <div> 
                                                                    <input type="text"  class="validate[required,minSize[3],maxSize[58],] large" name="municipio" id="6_required" 

                                                                           <?php
                                                                           $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                           $estado2 = $conn->consultar($sql2);
                                                                           while ($registro2 = mysql_fetch_array($estado2)) {
                                                                               echo "value='" . $registro2["municipio"] . "'";
                                                                           }
                                                                           ?> >                        






                                                                </div>
                                                                <label>Entidad Federativa:<small></small></label>   
                                                                <div> 



                                                                    <select name="estado">




                                                                        <?php
                                                                        $entidasFeder = $Seani->obtenerGeneroEstado($idTabUser);
                                                                        echo "<option  selected='selected'   value='" . $entidasFeder["estado"] . "'>- " . $entidasFeder["estado"] . " </option>";
                                                                        ?>                                                   

                                                                        <option value="Aguascalientes">Aguascalientes</option>
                                                                        <option value="Baja California">Baja California</option>
                                                                        <option value="Baja California Sur">Baja California Sur</option>
                                                                        <option value="Campeche">Campeche</option>
                                                                        <option value="Chiapas">Chiapas</option>
                                                                        <option value="Chihuahua">Chihuahua</option>
                                                                        <option value="Coahuila">Coahuila</option>
                                                                        <option value="Colima">Colima</option>
                                                                        <option value="Distrito Federal">Distrito Federal</option>
                                                                        <option value="Durango">Durango</option>
                                                                        <option value="Estado de México">Estado de México</option>
                                                                        <option value="Guanajuato">Guanajuato</option>
                                                                        <option value="Guerrero">Guerrero</option>
                                                                        <option value="Hidalgo">Hidalgo</option>
                                                                        <option value="Jalisco">Jalisco</option>
                                                                        <option value="Michoacán">Michoacán</option>
                                                                        <option value="Morelos">Morelos</option>
                                                                        <option value="Nayarit">Nayarit</option>
                                                                        <option value="Nuevo León">Nuevo León</option>
                                                                        <option value="Oaxaca">Oaxaca</option>
                                                                        <option value="Puebla">Puebla</option>
                                                                        <option value="Querétaro">Querétaro</option>
                                                                        <option value="Quintana Roo">Quintana Roo</option>
                                                                        <option value="San Luis Potosí">San Luis Potosí</option>
                                                                        <option value="Sinaloa">Sinaloa</option>
                                                                        <option value="Sonora">Sonora</option>
                                                                        <option value="Tabasco">Tabasco</option>
                                                                        <option value="Tamaulipas">Tamaulipas</option>
                                                                        <option value="Tlaxcala">Tlaxcala</option>
                                                                        <option value="Veracruz">Veracruz</option>
                                                                        <option value="Yucatán">Yucatán</option>
                                                                        <option value="Zacatecas">Zacatecas</option>
                                                                    </select>








                                                                </div>
                                                                <label>CÓDIGO Postal<small></small></label>   
                                                                <div> 
                                                                    <input type="text"  class="validate[required,,minSize[5],maxSize[6],custom[onlyNumberSp]] small" name="codigoPostal" id="8_required" 


                                                                           <?php
                                                                           $sql2 = "SELECT * FROM prf_datopersonales where user_id='$idTabUser';";
                                                                           $estado2 = $conn->consultar($sql2);
                                                                           while ($registro2 = mysql_fetch_array($estado2)) {
                                                                               echo "value='" . $registro2["cp"] . "'";
                                                                           }
                                                                           ?>          


                                                                           >
                                                                </div>



                                                            </div>




                                                            <div class="section last">
                                                                <div>
                                                                    <!--                                                      <a class="btn submit_form" >Guardar</a>-->
                                                                    <input class="btn submit_form" type="submit" value="Enviar" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div><!-- row-fluid -->
                                                </form>







                                            </div><!--  end widget-content -->

                                        </div>	
                                    </div><!--/tab1-->

                                    <!--tab2-->
                                    <div id="tab2" class="tab_content"> 
                                        <div class="load_page">

                                          <h1> Perfil Academico </h1>


                                        </div>	


                                    </div><!--/tab2-->


                                    <!--tab3-->
                                    <div id="tab3" class="tab_content"> 
                                        <div class="load_page">
   <table class="table table-bordered table-striped  data_table3" >
                                                      <thead>
                                                          <tr>
                                                              <th>Nombre Materia</th>
                                                              <th>Semestre</th>
                                                              <th>Carrera</th>
                                                                                                                     </tr>
                                                      </thead>
                                                      <tbody align="center">
                                                    
                                                             <?php   echo   $DatosPersonaleMatrizCompetencia = $Seani->ObtenerMatrizPorDocente($idprf);     ?>     
                                                     
                                                         
                                                       
                                                        
                                                     
                                                      </tbody>
                                                  </table>


   </div>	


                                    </div><!--/tab3-->


           <!--tab4-->
                                    <div id="tab4" class="tab_content"> 
                                        <div class="load_page">
 <h1>Datos Cuenta </h1>


   </div>	


                                    </div><!--/tab3-->


                                                                



                                                            

                                        </div>	


                                    </div>

                                </div>
                            </div><!-- end uitab-->

                        </div>
                    </div><!-- end uitab-->

                </div><!--  end widget-content -->
            </div><!-- widget  span12 clearfix-->
            <div id="footer"> &copy; Copyright 2014  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a></span> </div>

        </div><!-- row-fluid -->

        <!-- /tabss -->







    </div> <!--// End inner -->
</div> <!--// End content --> 

</body>
</html>