<?php 

	$con = new mysqli("localhost","uttlaxca_siseac","siseac2014","uttlaxca_siseac");

	$cuatrimestre = $_POST['cuatrimestre'];
	$grado = $_POST['grado'];
	$grupo = $_POST['grupo'];
	$turno = $_POST['turno'];
	$carrera = $_POST['carrera'];
	$periodo_escolar = $_POST['periodo'];

	echo $sql = "insert into grupo(cuatrimestre, grado, grupo, turno, carrera, periodo_escolar)
		values('$cuatrimestre', '$grado', '$grupo', '$turno', '$carrera', '$periodo_escolar')";

	$con->query($sql);
 ?>