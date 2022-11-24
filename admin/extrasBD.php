
<?php 

error_reporting(E_ERROR);

include('../mvc/modelo.php');

        date_default_timezone_set('Mexico/General');  

        $Seani = new Seani();


if($_POST['opcion']==1)
{

	$id_docente=$_POST['iddocente'];
	$id_carrera=$_POST['idcarrera'];
	$id_concepto = $_POST['conceptosCH'];

	$idregresado = $Seani->obtieneIdProyecto($id_carrera,$id_docente,$id_concepto,26);	//se agregó parametro

	echo $idregresado; 

}else if($_POST['opcion']==2){

		$id_docente=$_POST['docente'];
 		$id_concepto = $_POST['conceptosCH'];
 		$id_carrera=$_POST['id_carrera'];
 		$horas_asignadas = $_POST['nhoras'];
  		$descripcion = $_POST['descripcion']; 

 		$estatus=1;
	    $idfic=0;

        $actualizacion = date('Y-m-d H:i:s');

  		$Seani->VerificaCargaIndividual(26,$id_docente,$id_concepto, $id_carrera, $actualizacion, $horas_asignadas, $descripcion); 

} else if ($_POST['opcion']==3){

	$idDesglose = $_POST['idDesglose'];
	$tituloProyecto = $_POST['tituloProyecto'];
	$lineaCuerpo = $_POST['lineaCuerpo'];
	$objetivoGeneral = $_POST['objetivoGeneral'];
	$objetivoEmpresa = $_POST['objetivoEmpresa'];
	$justificacion = $_POST['justificacion'];



	$cacha = $Seani->GuardaFormatoProyecto($idDesglose, $tituloProyecto, $lineaCuerpo, $objetivoGeneral, $objetivoEmpresa, $justificacion);

	echo $cacha;	
} 
else if ($_POST['opcion']==4){

	$iddesglose = $_POST['idDesglose'];

	$cacha = $Seani->VerificaExisteProyecto($iddesglose);

	echo $cacha;

}
else if ($_POST['opcion']==5){
	$id_docente = $_POST['iddocente'];
	$id_carrera = $_POST['idconcepto'];
	$id_concepto = $_POST['idcarrera'];

	$cacha = $Seani->VerificaExisteConcepto($id_docente, $id_carrera, $id_concepto, 26);	//se agregó parámetro

	echo $cacha;
}
 
 ?>