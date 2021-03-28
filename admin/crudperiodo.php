<?php 

$con = new mysqli("localhost","uttlaxca_siseac","siseac2014","uttlaxca_siseac");

$carrera = $_POST['carrera'];
$periodo = $_POST['periodo'];

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		table, tr, td, th{
			border: 1px solid grey;
			border-collapse: collapse;
			padding:3px;
		}
	</style>
</head>
<body>
	<div id="crudP">
		<table>
			<tr>
				<th>Cuatrimestre</th>
				<th>Grado</th>
				<th>Grupo</th>
				<th>Turno</th>
			</tr>
			<?php 

				$sql="select * from grupo where carrera='$carrera' and periodo_escolar='$periodo'";

				$res = $con->query($sql);

				while($fila = $res->fetch_assoc()){
					echo "<tr>";
					echo "<td>".$fila['cuatrimestre']."</td>";
					echo "<td>".$fila['grado']."</td>";
					echo "<td>".$fila['grupo']."</td>";
					echo "<td>".$fila['turno']."</td>";
					echo "</tr>";
				}

			 ?>
		</table>
	</div>
</body>
</html>