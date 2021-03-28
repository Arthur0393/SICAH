<?php
	session_start();
   	
	if (!$_SESSION["account_name"]){
		header('Location: index.php');
	}else if($_SESSION["tipo_usuario"]==1 && $_SESSION["estatus"]==1){
   		// create SESSION  
		header('Location: profesor/profile.php');
  	}else if($_SESSION["tipo_usuario"]==2 && $_SESSION["estatus"]==1){
   		// create SESSION  
		header('Location: directorc/AdminDirectorC.php');
	}else if($_SESSION["tipo_usuario"]==3 && $_SESSION["estatus"]==1){
   		// create SESSION  
		header('Location: admin/index.php');
  	}else if($_SESSION["tipo_usuario"]==4 && $_SESSION["estatus"]==1){
   	// create SESSION  
		header('Location: rector/index.php');
	}else if($_SESSION["estatus"]==2){
  		echo '<script type="text/javascript">';				
		echo 'alert("Error usuario desactivado'.$error.'");';
		echo 'window.location.assign("index.php");';
		echo '</script>';
	}
?>