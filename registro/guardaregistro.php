<!DOCTYPE html >
<html lang ="es">
<head>
	<meta charset="utf-8" />
    <title>Plataforma Digital UTT</title>
    <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=index.php"> 

    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="imagen/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>


<body>

	<header>
      <div class="logotlaxcala">
                    <img src="imagen/logoestado.png"  alt="Logo" width="157" height="63" />
      </div>
		<div class="content-wrapper">
                    <p class="site-title">Plataforma Digital y de Servicios UTT</p>
		</div>
                    
		<div class="logoutt">
          			<img src="imagen/logoutt.png" alt="" width="140" height="73" />
		</div>
        
	</header>      
        
        <div >
            <ul class="nav main">
            
                <li><a href="index.php"><span class="site-title"> </span></a>           </ul>
</div>







<?php
$id=0;
$Nombre=$_POST['Nombre'];
$Paterno=$_POST['Paterno'];
$Materno=$_POST['Materno'];
$edad=$_POST['edad'];
$correo=$_POST['correo'];
$Celular=$_POST['Celular'];
$participacion=$_POST['participacion'];
$prodep=$_POST['prodep'];
$Institucion=$_POST['Institucion'];
$Grado=$_POST['Grado'];
$Investigacion=$_POST['Investigacion'];
$CuerpoAcademico=$_POST['CuerpoAcademico'];
$conacyt=$_POST['conacyt'];
$Ponencia=$_POST['Ponencia'];
$eje=$_POST['eje'];
$actividad=$_POST['actividad'];

$conexion=mysql_connect("localhost","uttlaxca_siseac","siseac2014");
mysql_select_db("uttlaxca_siseac");
$consulta="insert into registro(nombre,aPaterno,aMaterno,edad,correo,celular,participacion, prodep, institucion, grado, lineaInvestigacion, cuerpoAcademico, canacyt, nPonencia,eje,actividad) values('$Nombre','$Paterno','$Materno','$edad','$correo','$Celular','$participacion','$prodep','$Institucion','$Grado','$Investigacion','$CuerpoAcademico','$conacyt','$Ponencia','$eje','$actividad')";

$r=mysql_query($consulta);
if ($r){
 echo("Gracias por registrarte");
 echo(" <a href=\"index.html\">");
}
else{
  echo("Hubo un error al guardar");
}

mysql_close();
?>


           
            <div align="center" class="box round first">
            


						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
		<h1>Te has registrado con éxito!!! </h1>

						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
                        
            </div>
            

        </div>  
        
</body>

        
        
			<footer>
            <div class="content-wrapper">
                    Universidad Tecnologica de Tlaxcala - &copy; 2014 - Carretera a El Carmen Xalpatlahuaya s/n, Huamantla, Tlaxcala | Tel. 01 800 506 32 94 y 01 247 47 2 53 00- "Ciencia y Técnica para el Desarrollo"
            </div>
			</footer>
        
</html>