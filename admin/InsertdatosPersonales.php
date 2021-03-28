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
        
  
if( !isset($_FILES['archivo']) ){
  echo 'Ha habido un error, tienes que elegir un archivo<br/>';
  echo '<a href="profile.php">Subir archivo</a>';
}else{

  $nombre = $_FILES['archivo']['name'];
  $nombre_tmp = $_FILES['archivo']['tmp_name'];
  $tipo = $_FILES['archivo']['type'];
  $tamano = $_FILES['archivo']['size'];

  $ext_permitidas = array('jpg','jpeg','gif','png');
  $partes_nombre = explode('.', $nombre);
  $extension = end( $partes_nombre );
  $ext_correcta = in_array($extension, $ext_permitidas);

  $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);

  $limite = 500 * 1024;

  if( $ext_correcta && $tipo_correcto && $tamano <= $limite ){
    if( $_FILES['archivo']['error'] > 0 ){
      echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
    }else{
      echo 'Nombre: ' . $nombre . '<br/>';
      echo 'Tipo: ' . $tipo . '<br/>';
      echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
      echo 'Guardado en: ' . $nombre_tmp;

      if( file_exists( 'subidas/'.$nombre) ){
        echo '<br/>El archivo ya existe: ' . $nombre;
      }else{
        move_uploaded_file($nombre_tmp,
          "subidas/" . $nombre);

        echo "<br/>Guardado en: " . "subidas/" . $nombre;
      }
    }
  }else{
//    echo 'Archivo inválido';
  }
}
      
        echo $nombre;
  
if (!empty($nombre)) { 
//    echo ' siiii subio foto ';
          $foto= "subidas/" . $nombre;  
} else {
         $foto= "http://siseac.uttlaxcala.edu.mx/profile.png";  
}
  
   
   
        
   $id=$_POST['id'];

 $fecha_incorporacion=$_POST['fIncorporacion'];

 $tel_personal=$_POST['telefono'];
  
 $fecha_nacimiento=$_POST['birthday'];

   $genero=$_POST['genero'];

   $curp=$_POST['curp'];

 $rfc=$_POST['rfc'];  

     $n_empleado=$_POST['noempleado'];

  $direcion=$_POST['calleyNumero'];

      $localidad=$_POST['localidad'];
 
$municipio=$_POST['municipio'];
   
    $estado=$_POST['estado'];

  $cp=$_POST['codigoPostal'];
          
	 $prf_titulo=$_POST['titulo'];
        
         $prf_tipo=$_POST['puesto'];
         
              $date = date('Y-m-d H:i:s');
    
 // echo $nombre=$_POST['nombre'];
// echo $email=$_POST['email'];
   $Seani = new Seani();	
	$Seani->SecondDatosPersonales($id,$fecha_incorporacion,$tel_personal,$fecha_nacimiento,$genero,$curp,$rfc,$n_empleado,$direcion,$localidad,$municipio,$estado,$cp,$foto,$date,$prf_titulo,$prf_tipo);
  
        
        
        

   
   
		?>
    
</body>
</html>	




