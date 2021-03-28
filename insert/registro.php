	<?php
	include('../mvc/modelo.php');
	date_default_timezone_set('Mexico/General');
	//datos tabla users
	 $folio=$_POST['email'];
 $username=$_POST['user'];
	 $pass= $_POST['pass'];
	 $email=$_POST['email'];
		$usuario='1';		
	$date = date('Y-m-d H:i:s');
$estatus="1";
//datos tabla datos personal
	 $nombreA= $_POST['nombreA'];
	$apellidoap=$_POST['apellidoap'];
	$apellidoma= $_POST['apellidoma'];	
	$foto='http://siseac.uttlaxcala.edu.mx/profile.png';
	
	
	$Seani = new Seani();	
	 $Seani->Nregistro($username,$pass,$email,$usuario,$date,$estatus,$foto);
	 $idusuario=$Seani->obteneIdusuario($username);
	 	$Seani->FirstDatosPers($nombreA,$apellidoap,$apellidoma,$email,$date,$idusuario,$foto);
		?>