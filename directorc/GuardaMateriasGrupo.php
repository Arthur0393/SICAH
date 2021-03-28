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

        if (isset($_POST['tutor'])){

            echo $tutor = $_POST['tutor'];
			echo $idDocente = $_POST['idDocente'];
			echo $idMaterias = $_POST['idMaterias'];
			echo $id_carrera = $_POST['$id_carrera'];
			echo "-------------------------";
			echo $idGrupo = $_POST['$idGrupo'];
			echo "-------------------------";
			
			$id_periodo=21;
   			// $idusuario=$_POST['id']; 
			echo $fecha = date('Y-m-d H:i:s');
		   $n = count($tutor);
		   $i = 0;
			
			//   echo "Tus tutores  selecionada son: rn" .
			//      "<ol>";

			while ($i < $n){
			    // "<li>{$tutor[$i]}</li> ";
				//  echo $tutor[$i];
				//    echo '-';
				//    echo $idGrupo[$i];
				//     echo ',';
				//     
			    // $Seani-> VerificaMateCarga($idDocente,$idMaterias[$i],$fecha,$id_carrera,$id_periodo,$idGrupo[$i]);
			    $i++;
			}

	 		echo "</ol>";
		} 

		//	echo '<script type="text/javascript">';
		//	echo 'alert("Matriz capturada con exito");';
		//	echo 'window.location.assign("AdminDirectorC.php");';
		//  echo '</script>';
	?>

</body>
</html>	
