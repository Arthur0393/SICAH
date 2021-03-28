	
<div id="header">
    <?php
     $username=$_SESSION["account_name"]; 
        include('../mvc/modelo.php');
        $Seani = new Seani();	
         $idusuario=$Seani->obteneIdusuario($username);
         $foto=$Seani->obteneFotousuario( $idusuario);
              ?>
                <ul id="account_info" class="pull-right"> 
                    <li><img src=<?php echo"'"; echo $foto;echo"'"; ?> alt="Online" width='45' height='45' /></li>
                    <li class="setting">
                        Bienvenido(a), <b><?php echo $_SESSION["account_name"] ?></b>
                        <ul class="subnav">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#" alt="Proximamente">Perfil</a></li>
                            <li><a href="#">Configuraciones</a></li>
                            <li><a href="#">Reset password</a></li>
                            <br class="clearfix"/>
                        </ul>
                    </li>
                    <li  title="Disconnect"><a href="../salir.php">Salir</a></li> 
                </ul>
            </div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48987076-1', 'uttlaxcala.edu.mx');
  ga('send', 'pageview');

</script>