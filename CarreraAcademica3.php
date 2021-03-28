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
	$con2 = mysql_connect("localhost","root","*123");
	mysql_select_db("siseac", $con2);


	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$result = mysql_query("SELECT * FROM activida_prf_no_docente where user_ide='$idusuario';");
		
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
		
			$result = mysql_query("INSERT INTO activida_prf_no_docente(puesto, empresa, periodo,user_ide) VALUES('" . $_POST["puesto"] . "', '" . $_POST["empresa"] . "',  '" . $_POST["periodo"] . "','$idusuario' );");
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM activida_prf_no_docente WHERE id = LAST_INSERT_ID();");
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
		$result = mysql_query("UPDATE activida_prf_no_docente SET puesto = '" . $_POST["puesto"] . "', empresa = " . $_POST["empresa"] . ",periodo = '" . $_POST["periodo"] . "' WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM activida_prf_no_docente WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con2);

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