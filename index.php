<?php
  session_start();

  if(isset($_SESSION['account_name']) && $_SESSION["tipo_usuario"]==2){
    header('Location: directorc/AdminDirectorC.php');
  }else if(isset($_SESSION['account_name']) && $_SESSION["tipo_usuario"]==1){
    header('Location: profesor/profile.php'); 
  }else if(isset($_SESSION['account_name']) && $_SESSION["tipo_usuario"]==3){
    header('Location: admin/index.php'); 
  }else if(isset($_SESSION['account_name']) && $_SESSION["tipo_usuario"]==4){
    header('Location: rector/index.php'); 
  }

?>

<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>SISEAC V.0.1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link type="text/css" rel="stylesheet" href="components/bootstrap/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="css/zice.style.css"/>
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

    <style type="text/css">
      html {
        background-image: none;
      }
		  body{
			  background-position:0 0;
			}
      label.iPhoneCheckLabelOn span {
        padding-left:0px
      }
      #versionBar {
        background-color:#168011;
        position:fixed;
        width:100%;
        height:35px;
        bottom:0;
        left:0;
        text-align:center;
        line-height:35px;
        z-index:11;
        -webkit-box-shadow: black 0px 10px 10px -10px inset;
        -moz-box-shadow: black 0px 10px 10px -10px inset;
        box-shadow: black 0px 10px 10px -10px inset;
      }
      .copyright{
        text-align:center; font-size:10px; color:#CCC;
      }
      .copyright a{
        color:#CCC; text-decoration:none
      }    
    </style>

  </head>
  <body>
         
    <div id="successLogin"></div>
    <div class="text_success"><img src="images/loadder/loader_green.gif"  alt="ziceAdmin" /><span>Cargando...</span></div>
        
    <div id="login" >
      <div class="ribbon"></div>
      <div class="inner clearfix">
      <div class="logo" ><img src="images/logo/logo_login.png" alt="ziceAdmin" /></div>
      <div class="formLogin">

      <form name="formLogin"  id="formLogin" method="post">
        <div class="tip">
          <input name="username" type="text"  id="username_id"  title="Usuario"   />
        </div>
        <div class="tip">
          <input name="password" type="password" id="password"   title="Contrase&ntilde;a"  />
        </div>
        <div class="loginButton">
          <div class=" pull-right" style="margin-right:-8px;">
            <div class="btn-group">
              <button type="button" class="btn" id="but_login">Iniciar</button>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        
      </form>

      </div>
    </div>
    <div class="shadow"></div>
  </div>
    <!--Login div-->
  <div class="clear"></div>
  <div id="versionBar" >
    <div class="copyright" >  &copy; Copyright 2021  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span>
    </div>
    <!-- // copyright-->
  </div>
    
  <!-- Link JScript-->
  <script type="text/javascript" src="js/login_php.js"></script>
  </body>
</html>