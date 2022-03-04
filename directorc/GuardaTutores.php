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
 $grupoTutor = $_POST['grupoTutor'];
  
   // $idusuario=$_POST['id']; 
$fecha = date('Y-m-d H:i:s');

 $idGrupoM = $_POST['idGrupoM'];
 $idDocente = $_POST['idDocente'];
 $idMaterias = $_POST['idMaterias'];
$id_carrera = $_POST['id_carrera'];
$ngrupo = $_POST['ngrupo'];
$horasAseso=$_POST['horas_aseso'];

 $nombre_materia=$_POST['nombre_materia'];
 $horas_por_semana= $_POST['horas_por_semana'];

 $id_periodo=$_POST['periodo'];
  
 
 ////////Inicia Tutor
         if (isset($_POST['tutor']))
{         
   $tutor = $_POST['tutor']; 
   $n        = count($tutor);
   $i        = 0;
//   echo "Tus tutores  selecionada son: rn" .
//      "<ol>";
  while ($i < $n)
   {
   // "<li>{$tutor[$i]}</li> ";
         
//  echo $tutor[$i];
    

//     echo ',';
//   
  
$id_conceptoTutor=6;
$horas_asignadasTutor=3;
$descripcion1t="son asignas como tutor del de Grupo :";
$descripcionTutor= $descripcion1t . $ngrupo[$i]." de la carrera. $id_carrera[$i]";


//$Seani->VerificaDesgloseCarga(3,$tutor[$i],$id_conceptoTutor,$id_carrera[$i],$fecha,$horas_asignadasTutor,$descripcionTutor);
$Seani->VerificaDesgloseCargaTutores($id_periodo,$tutor[$i],$id_conceptoTutor, $id_carrera[$i],$grupoTutor[$i], $fecha, $horas_asignadasTutor,$descripcionTutor, $id_periodo,$horas_asignadasTutor);  
                             
 $Seani->VerificaListaTutores($tutor[$i],$grupoTutor[$i],$fecha,$id_periodo);
      $i++;
   }
  echo "</ol>";
} 
 ////////Fin Tutor

 ////////Inicia Carga Academica

         if (isset($_POST['idMaterias']))
{         
 $idMaterias = $_POST['idMaterias'];
   $m       = count($idDocente);
   $j        = 0;

  while ($j < $m)
   {
      ///Inicia Asesorias
      

//  $idMaterias[$j];
//
//  $idGrupoM[$j];

$id_conceptoMateriaAsesorias=3;
$horas_asignadasAsesorias=$horasAseso[$j];
$descripcion1a="Son asignadas Asesorias de la materia :";
$descripcionAsesorias= $descripcion1a . $nombre_materia[$j]." de la carrera. $id_carrera[$j]";    
    
                           
  /////Inica materias

$descripcion1m="son asignas de la materia de la materia :";
 $descripcionMaterias= $descripcion1m . $nombre_materia[$j] ." de la carrera. $id_carrera[$j]";  
 $id_conceptoMateriaHfg=2;
 $horasemana=$horas_por_semana[$j];
      $materias=$Seani->VerificaDesgloseCargas($id_periodo,$idDocente[$j],$id_conceptoMateriaHfg,$id_carrera[$j],$idMaterias[$j],$idGrupoM[$j],$fecha,$horas_por_semana[$j],$descripcionMaterias); 
        //$asesoria= $Seani->VerificaDesgloseCargas($id_periodo,$idDocente[$j],$id_conceptoMateriaAsesorias,$id_carrera[$j],$idMaterias[$j],$idGrupoM[$j],$fecha,$horas_asignadasAsesorias,$descripcionAsesorias);           
 $Seani-> VerificaMateCarga($idDocente[$j],$idMaterias[$j],$fecha,$id_carrera[$j],$id_periodo,$idGrupoM[$j]); 
 
   /////Fin Materias
 
      $j++;
   }
  
} 

   	echo '<script type="text/javascript">';
    echo 'alert("Carga Academica capturada con exito");';
	echo 'window.location.assign("AdminDirectorC.php");';
    echo '</script>';

   
   
		?>
    
</body>
</html>	




