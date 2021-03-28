<?php
    session_start();
if (!$_SESSION["account_name"]){

   header('Location: index.php');
 
  }else if($_SESSION["tipo_usuario"]!=1 ){
    // create SESSION  
         echo '<script type="text/javascript">';       
  echo 'alert("No tiene permiso acceder a esta zona'.$error.'");';
  echo 'window.location.assign("../index.php");';
  echo '</script>';
  }else if($_SESSION["estatus"]==2){
      echo '<script type="text/javascript">';       
  echo 'alert("No tiene permiso acceder a esta zona'.$error.'");';
  echo 'window.location.assign("../index.php");';
  echo '</script>';

 
  }


?>
<?php
//include('../Conectar.php');
try
{
	//Open database connection
	
//$con=conectarBD();

//  	require '../Conectar.php';
//$con=Db::getInstance();}
  include('../mvc/modelo.php');
  $Seani = new Seani();
$idusuario=$Seani->obteneIdusuario($_SESSION["account_name"]);
	$con = mysql_connect("localhost","root","*123");
	mysql_select_db("siseac", $con);


	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$result = mysql_query("SELECT * FROM carrera_academica  where user_id_ca='$idusuario';");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		
			$result = mysql_query("INSERT INTO carrera_academica(actividad, institucion, periodo,user_id_ca) VALUES('" . $_POST["actividad"] . "', '" . $_POST["institucion"] . "', '" . $_POST["periodo"] . "','$idusuario' );");
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM carrera_academica WHERE id = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE carrera_academica SET actividad = '" . $_POST["actividad"] . "', institucion = " . $_POST["institucion"] . " WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM carrera_academica WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>