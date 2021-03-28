<?php

$variable = $_GET['idDinamico'];//$_GET['otra'];

try
{
	//Open database connection
	$con = mysql_connect("localhost","uttlaxca_siseac","siseac2014");
	mysql_select_db("uttlaxca_siseac", $con);

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$result = mysql_query("SELECT * FROM actividades_proyectos WHERE idformato_proyectos = '".$variable."';");
		
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
		$result = mysql_query("INSERT INTO actividades_proyectos(actividad, fecha_inicio, fecha_fin, entregable, idformato_proyectos) 
			VALUES('" . $_POST["actividad"] . "', '" . $_POST["fecha_inicio"] . "', '". $_POST["fecha_fin"]."', '".$_POST["entregable"]."', '".$variable."' );");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM actividades_proyectos WHERE idactividades_proyectos = LAST_INSERT_ID();");
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
		$result = mysql_query("UPDATE actividades_proyectos SET actividad = '" . $_POST["actividad"] . "', fecha_inicio = '" . $_POST["fecha_inicio"] . "', fecha_fin = '".$_POST["fecha_fin"]."', entregable = '".$_POST["entregable"]."', idformato_proyectos = '".$variable."' WHERE idactividades_proyectos = " . $_POST["idactividades_proyectos"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}	
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM actividades_proyectos WHERE idactividades_proyectos = " . $_POST["idactividades_proyectos"] . ";");

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