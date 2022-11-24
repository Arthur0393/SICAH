<!DOCTYPE html>
<html>
<head>
	<title>Cargando...</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<!-- Include the heartcode canvasloader js file -->
	<script src="http://heartcode-canvasloader.googlecode.com/files/heartcode-canvasloader-min-0.9.1.js"></script>
	
	
	<style type="text/css">
		body, html {
			margin:0;
			padding:0;
			overflow:hidden;
			background-color:#ffffff;
		}
		.wrapper {
			position:absolute;
			top:50%;
			left:50%;
		}
	</style>
</head>
<body>
	<!-- Create a div which will be the canvasloader wrapper -->	
	<div id="canvasloader-container" class="wrapper"></div>
		
	<!-- This script creates a new CanvasLoader instance and places it in the wrapper div -->
      
        
	<script type="text/javascript">
		var cl = new CanvasLoader('canvasloader-container');
		cl.setShape('square'); // default is 'oval'
		cl.setDiameter(57); // default is 40
		cl.setDensity(96); // default is 40
		cl.setRange(1); // default is 1.3
		cl.setSpeed(4); // default is 2
		cl.setFPS(29); // default is 24
		cl.show(); // Hidden by default
		
		// This bit is only for positioning - not necessary
		  var loaderObj = document.getElementById("canvasLoader");
  		loaderObj.style.position = "absolute";
  		loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
  		loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
    </script>
    
      <?php
		include('../mvc/modelo.php');
        date_default_timezone_set('Mexico/General');  
    $Seani = new Seani();	
         if (isset($_POST['reslab']))
{
$reslab = $_POST['reslab'];
 $idLab = $_POST['idLaaboratorio'];
$idCarre= $_POST['idCarre'];
$nombrel= $_POST['nombrel'];
   // $idusuario=$_POST['id']; 
$fecha = date('Y-m-d H:i:s');

   $n        = count($reslab);
   $i        = 0;
  //echo "Tus tutores  selecionada son: rn" ;
//      "<ol>";
  while ($i < $n)
   {
    "<li>{$reslab[$i]}</li> ";
         
  
 $id_periodo=26;
$id_concepto=9;
$horas_asignadas=2;



     $descripcion1="son asignas de laboratorio de:";
   $descripcion= $descripcion1 . $nombrel[$i]. " de la carrera ".$idCarre;
     //$Seani->InsDesgloseCarhora(3,$reslab[$i],$id_concepto,$idCarre,$fecha,$horas_asignadas,$descripcion);
 $Seani->VerificaDesgloseCargaLaboratorios(26,$reslab[$i],$id_concepto,$idCarre,$idLab[$i],$fecha,$horas_asignadas,$descripcion);
//   echo 'id laboratorio';
//   echo$idLab[$i];
//   echo '-Docente:';
//   echo $reslab[$i] ;
//      echo ';';
 $Seani->VerificaResLab($reslab[$i],$idLab[$i],$fecha);
      $i++;
   }
  echo "</ol>";
} 
      
   echo '<script type="text/javascript">';
            echo 'alert("Laboratorios Capturados con exito");';
	echo 'window.location.assign("CarrerasCargaHoraria.php");';
            echo '</script>';

   
   
		?>
    
</body>
</html>	




