<!DOCTYPE html >
<html lang ="es">
<head>
  <meta charset="utf-8" />
    <title>Registro Congreso</title>
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="imagen/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <script src="jquery.min.js"></script>
</head>


<body>

<header>
        <div class="logotlaxcala">
            <img src="imagen/logoestado.png"  alt="Logo" width="157" height="63" />
        </div>
        
        <div class="content-wrapper">
      <p class="site-title">Primer Congreso Internacional Academia Journals de Educación Superior Tecnológica Pública</p>
        </div>
        <div class="logoutt">
            <img src="imagen/logoutt.png" alt="" width="140" height="73" />
        </div>
</header>      
        

  <ul class="nav main">
    <li class="texto-barra-menu">
          
<!--      Bienvenido
-->   </li>
  </ul>
    
    <section id="login" class="crear-cuenta">
    <a href="registro.php"> Registro </a>
  </section>

           
    <div class="box round first">
      <div class="block" align="center">
       
             
            <form action="envio.php" method="post">
                      <p>&nbsp;</p> 
        <h1>Iniciar Sesión</h1>
        <p>&nbsp;</p>   
                
  <table width="342">
    <tr>
      <td width="98">&nbsp;</td>
      <td align="right"><strong>Usuario:</strong></td>
      <td width="183"><input type="text" id="username" name="usuario" value="" placeholder="Nombre Usuario"/></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right"><strong>Contraseña:</strong></td>
      <td><input type="password" id="password" name="password" value="" placeholder="Contraseña"/></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right"><input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" /></td>
      <td>¿Recordar cuenta?</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><button id="iniciar" class="button btn btn-success btn-large">Iniciar Sesión</button></td>
      </tr>
        <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <!--<td align="right"><p><a href="recupera.php">Recuperar Password</a></p></td>-->
      </tr>
    </table>
      </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<!-- /login-extra -->                    
  </div>
</div>  








        <script>

        $(document).ready(function(){
          $('#iniciar').click(function(e){
                e.preventDefault();
                alert("Datos no válidos");
          });
        });

        </script>
</body>
        
        
      <footer>
            <div class="content-wrapper">
                    Universidad Tecnologica de Tlaxcala - &copy; 2014 - Carretera a El Carmen Xalpatlahuaya s/n, Huamantla, Tlaxcala | Tel. 01 800 506 32 94 y 01 247 47 2 53 00- "Ciencia y Técnica para el Desarrollo"
            </div>
      </footer>
        
</html>