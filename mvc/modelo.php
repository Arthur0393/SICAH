<?php

//include('../Conectar.php');
require '../Conectar.php';
//$db = Db::getInstance();
//$db = new Db();
//$con = $db->getConexion();

//printf("Suceess... %s\n", $con->host_info);

class Seani {

	public $con;

public function __construct(){
	$db = new Db();
	$this->con = $db->getConexion();
}

function Nregistro($username, $password, $email, $tipo_usuario, $fecha_hora_alta, $estatus, $foto){
    $result = $this->con->query("INSERT INTO 01_user (username,password,email,tipo_usuario,fecha_hora_alta,estatus,foto) 
            VALUES ('$username','$password','$email','$tipo_usuario','$fecha_hora_alta','$estatus','$foto')");

    if (!$result) {
		//$error = 'Invalid query: ' . ->error;
		//if (errno() == 32) {
		if($result->errno == 32)	{
            $error = "El correo electronico ingresado ya esta registrado en nuestra base de datos.";
        } else {
			$error = $result->error;
		}

		// cosas
		echo $error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
		echo 'window.location.assign("../index.php");';
		echo '</script>';
		echo '<meta http-equiv="refresh" content="0, url=../index.php">';
		die('Invalid query: ' . $result->error);
	} else {
		echo '<script type="text/javascript">';
		echo 'alert("Su Registro ha sido Correcto");';
		echo 'window.location.assign("../index.php");';
		echo '</script>';
		echo '<meta http-equiv="refresh" content="0, url=../index.php">';
    }
    return;
}

function FirstDatosPers($nombre, $ap_paterno, $ap_materno, $email, $ultima_actualizacion, $userId, $foto){
    $result = $this->con->query("INSERT INTO prf_datopersonales(nombre, ap_paterno, ap_materno, email, ultima_actualizacion, prf_tipo, user_id, foto) VALUES ('$nombre','$ap_paterno','$ap_materno','$email','$ultima_actualizacion','1','$userId','$foto')");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
		echo 'window.location.assign("../index.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
	} else {
		echo '<script type="text/javascript">';
		echo 'alert("Gracias por registrarte");';
		echo 'window.location.assign("../index.php");';
		echo '</script>';
	}
    return;
}
	
			//***************Revisar este.......
	
function InsertarCargaHoraria($nombre, $ap_paterno, $ap_materno, $email, $ultima_actualizacion, $userId, $foto){

    $result = $this->con->query("INSERT INTO prf_datopersonales (nombre, ap_paterno, ap_materno, email, ultima_actualizacion, prf_tipo, user_id, foto) VALUES ('$nombre','$ap_paterno','$ap_materno','$email','$ultima_actualizacion','1','$userId','$foto')");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
			//echo 'window.location.assign("../index.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		echo '<script type="text/javascript">';
		echo 'alert("Gracias por registrarte");';
		// echo 'window.location.assign("../index.php");';
		echo '</script>';
    }
    return;
}           
		//***************Revisar este
	
			/////////////// Inicio Guardar Tutor //////////////////////
		 
function VerificaListaTutores($idDocente,$idGrupo,$actualizacion,$idperiodo) {
	$sql = "SELECT * FROM tutores_grupo WHERE tutores_grupo.id_grupo='$idGrupo' and id_periodo='$idperiodo';";
	$result = $this->con->query($sql);
	$res = $result->num_rows;

	if ($res > 0) {
		//echo "Actualizar status";
		$ActualizarTutores = $this->UpdateTutor($idDocente,$idGrupo,$actualizacion,$idperiodo);
    } else {
        $inserTutores = $this->InsertarTutores($idDocente,$idGrupo,$actualizacion,$idperiodo);
		//echo "no";
    }
} 
	
function InsertarTutores($idDocente,$idGrupo,$actualizacion,$idperiodo) {
	$result = $this->con->query("INSERT INTO tutores_grupo (id_docente, id_grupo,actualizacion,id_periodo) VALUES ('$idDocente','$idGrupo','$actualizacion','$idperiodo');");
    if (!$result) {
        $error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
		//echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//  echo '<script type="text/javascript">';
		//  echo 'alert("Tutores Guardado Con exito");';
		////echo 'window.location.assign("AdminDirectorC.php");';
		//  echo '</script>';
    }
    return;
}
	
function UpdateTutor($idDocente,$idGrupo,$actualizacion,$idperiodo) {
	$result = $this->con->query("UPDATE tutores_grupo SET id_docente='$idDocente' WHERE id_grupo='$idGrupo' and id_periodo='$idperiodo';");

    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//   echo '<script type="text/javascript">';
		//   echo 'alert("Actualizacion correcta");';
		//   echo 'window.location.assign("AdminDirectorC.php");';
		//   echo '</script>';
    }
    return;
}
	
function SelecionarDocentesCargadoTutores($idgrupo,$idperiodo) {
	$idgrupo;
	$sql = "SELECT prf_datopersonales.id, nombre,ap_paterno,ap_materno FROM tutores_grupo,prf_datopersonales WHERE prf_datopersonales.id=tutores_grupo.id_docente and  tutores_grupo.id_grupo='$idgrupo' and tutores_grupo.id_periodo='$idperiodo';";
	$result = $this->con->query($sql);
	$i = 0;
        
	while ($fila = $result->fetch_row()) {
                
        echo "<option value='"; 
        echo $id[$i] = $fila[0]; 
        echo "'style='color: #007E3A;'> ";
        echo $Nombre[$i] = $fila[1];
        echo " "; 
		echo $ApellidoPaterno[$i] = $fila[2];
        echo " "; 
        echo $Nombre[$i] = $fila[3];
        echo "</option> ";                     
        //  echo" </tr>     ";
        $i++;
    }
}
    
function SelecionarPeriodo() {
	$idgrupo;
    $sql = "SELECT * FROM periodo_escolar;";
    $result = $this->con->query($sql);
    $i = 0;
        

    	echo "<select name='id_periodoS' id='id_pesiodoS' data-placeholder='Selecciona un Periodo...'  chzn-select' tabindex='2'>";
		echo "<option value=''></option>";
        
        while ($fila = $result->fetch_row()) {
            //$id_carrera[$i] = $fila['0'];
        	echo "<option value='"; 
			echo $fila[0];
			echo "'>";
            echo $fila[1]." ".$fila[2];  
            echo "</option> "; 
            $i++;
        }
		echo "</select>";  
		echo '</div>';
         
    /*while ($fila = $result->fetch_row()) {
        echo "<tr class='odd gradeX'>";
        echo "	<td>";   
		echo $id[$i] = $fila[0];       
		echo "	</td>";
        echo "	<input type='hidden' value='$id[$i]' name='idPeriodo' />  ";
        echo "	<td>";   
		echo $Nombre[$i] = $fila[1];       
		echo "	</td>";
        echo "	<td>";  
		echo $anual[$i] = $fila[2];      
		echo "	</td>";
        echo "	<td>";   
		echo $cicloEscolar[$i] = $fila[3];      
		echo "	</td>";
        echo $estatus[$i] = $fila[4]; 
        echo "<td>";
				 
		if ($estatus[$i] == 1) { 
            echo "style='background-color: #DEDDD8;'";
        } else if ($estatus[$i] == 2) {
			echo "style='   background-color: #5DAC3D;'";
		} else if ($estatus[$i] == 3) {
			echo "style='   background-color: #FCFCFC;'";
        } else if ($estatus[$i] == 4) {
			echo "style='  background-color: #F49C05;'";
        }
        echo "style='background-color: #b0c4de;' >";  
		echo $estatus[$i] = $fila[4]; 
		echo "<select name='estatus' chzn-select tabindex='2' >";
		echo "<option value='";           
		echo  $estatus[$i];         
		echo "'>";
		if ($estatus[$i] == 1) {
			echo "Anteriores ";
        } else if ($estatus[$i] == 2) {
			echo "Activos ";
        } else if ($estatus[$i] == 3) {
			echo "Posteriores ";
        } else if ($estatus[$i] == 4) {
			echo "Consulta ";
        }
        echo "</option>"; 
        echo "<option value='1'> Anteriores</option>";                          
        echo "<option value='2'> Activos</option>";   
        echo "<option value='3'> Posteriores</option>";   
        echo "<option value='4'> Consulta</option>";   
        echo "</td>";
		echo "</tr>";
		$i++;
    }*/
}
	
function UpdaAdminPeriodoEscolar($idPeriodoEscolar,$actualizacion,$estatus) {
	$result = $this->con->query("UPDATE periodo_escolar SET  estatus='$estatus', actualizacion='$actualizacion'WHERE idperiodo_escolar='$idPeriodoEscolar';");
	if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
	} else {
		// echo '<script type="text/javascript">';
		// echo 'alert("Actualizacion correcta Materias");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		// echo '</script>';
    }
	return;
}
    
function SelecionarTodosDocentes($idGrupo,$idperiodo) {
	$sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno, prf_datopersonales.ap_materno FROM prf_datopersonales where prf_tipo <=3 order by prf_datopersonales.ap_paterno asc ;";
	$result = $this->con->query($sql);
	$i = 0;
	
	echo "<select name='tutor[]' data-placeholder='Selecciona un docente...'  chzn-select' tabindex='2' >";
	$nombreDocente=$this->SelecionarDocentesCargadoTutores($idGrupo,$idperiodo);  
    //  echo"  <option value='4'></option> ";    
    while ($fila = $result->fetch_row()) {
        echo"  <option value='"; 
        echo $id[$i] = $fila[0];
        echo"'> ";
        echo $Nombre[$i] = $fila[1];
        echo" "; 
        echo $ApellidoPaterno[$i] = $fila[2];
        echo" "; 
        echo $Nombre[$i] = $fila[3];
        echo   "</option> "; 
		// echo" </tr>     ";
        $i++;
    }
    echo "</select>";
}
    
function SelecionarTodosDocentes3() {
	$sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno, prf_datopersonales.ap_materno FROM prf_datopersonales where prf_tipo <=3 order by prf_datopersonales.ap_paterno asc ;";
	$result = $this->con->query($sql);
	$i = 0;
	echo "<select id='docente' name='docente' data-placeholder='Selecciona un docente...' class='validate[required] chzn-select' tabindex='2' >";
					
	//////////////////////echo"  <select   name='docente' data-placeholder='Selecciona un docente...' ///////   class='validate[required] chzn-select' tabindex='2' >";
					
	echo "<option value=''></option>";  
	//  $nombreDocente=$this->SelecionarDocentesCargadoTutores($idGrupo);  
	//  echo "<option value='4'></option>";
    while ($fila = $result->fetch_row()) {
        echo "<option value='"; 
        echo $id[$i] = $fila[0];
        echo "'>";
        echo $Nombre[$i] = $fila[1];
        echo " "; 
        echo $ApellidoPaterno[$i] = $fila[2];
        echo " "; 
        echo $Nombre[$i] = $fila[3];
        echo "</option>";
        // echo" </tr>";
        $i++;
    }
    echo "</select>";
}
    
function SelecionarTodosDocentes2() {
	$sql = "SELECT prf_datopersonales.user_id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno, prf_datopersonales.ap_materno FROM prf_datopersonales where prf_tipo <=3 order by prf_datopersonales.ap_paterno asc ;";
	$result = $this->con->query($sql);
	$i = 0;
	echo "<select name='docente' data-placeholder='Selecciona un docente...'  chzn-select' tabindex='2' >";
	echo "<option value=''></option>";
	//  $nombreDocente=$this->SelecionarDocentesCargadoTutores($idGrupo);  
	//  echo"  <option value='4'></option> ";    
    while ($fila = $result->fetch_row()) {
		echo "<option value='";
		echo $id[$i] = $fila[0];
        echo "'>";
        echo $Nombre[$i] = $fila[1];
        echo " ";
		echo $ApellidoPaterno[$i] = $fila[2];
        echo " ";
		echo $Nombre[$i] = $fila[3];
		echo "</option>";
		//  echo "</tr>";
        $i++;
    }
	echo "</select>";
}
	
function SelecionarConceptoCargaHoraria($tipo) {
	$sql = "SELECT idconceptos_carga_horaria,nombre FROM conceptos_carga_horaria where tipo ='$tipo' and idconceptos_carga_horaria != 11 ;";
	$result = $this->con->query($sql);
	$i = 0;
	echo "<select  id='conceptosCH' name='conceptosCH' data-placeholder='Selecciona un docente...'  chzn-select' tabindex='2'>";
	echo "<option value=''></option> ";
      
	while ($fila = $result->fetch_row()) {
		echo "<option value='"; 
    	echo $id[$i] = $fila[0];
		echo "'>";
     	echo $Nombre[$i] = $fila[1];
     	echo "</option>";
		//  echo" </tr>     ";
        $i++;
    }
	echo "</select>";
}
			/////////////// Fin Guardar Tutor //////////////////////
	
			///Desglose Carga horaria
    
function VerificaDesgloseCargaTutores ($id_periodo,$id_docente, $id_concepto, $id_carrera,$grupot, $actualizacion, $horas_asignadas,$descripcion) {
	$sql = "SELECT * FROM desglose_carga_horaria where grupo='$grupot'and id_concepto=6 and id_periodo='$id_periodo' ORDER BY actualizacion LIMIT 1;";
	$result = $this->con->query($sql);
	$res = $result->num_rows;

    if ($res > 0) {
		//echo "Actualizar desglose";
		$ActualizarTutores = $this->UpdaDesgloseCargaTutores($id_docente,$actualizacion,$grupot,$id_periodo);
    } else {
		//echo "Insertar desglose Horaria";
		$inserTutores = $this->InsDesgloseCarhoraTutores($id_periodo, $id_docente, $id_concepto, $id_carrera,$grupot, $actualizacion, $horas_asignadas,$descripcion);
		//echo "no";
    }
} 
     
function UpdaDesgloseCargaTutores($idDocente,$actualizacion,$idgrupo, $id_periodo) {
	$result = $this->con->query("UPDATE desglose_carga_horaria SET  id_docente='$idDocente', actualizacion='$actualizacion'WHERE grupo='$idgrupo' and id_periodo='$id_periodo';");
	if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//  echo '<script type="text/javascript">';
		//  echo 'alert("Actualizacion correcta Materias");';
		//	echo 'window.location.assign("AdminDirectorC.php");';
		//  echo '</script>';
    } 
	return;
}
    
function VerificaDesgloseCargas ($id_periodo, $id_docente, $id_concepto, $id_carrera,$materiaDc,$grupoDc, $actualizacion, $horas_asignadas,$descripcion) {
	$sql = "SELECT * FROM desglose_carga_horaria where grupo='$grupoDc' and materia='$materiaDc' and id_concepto='$id_concepto' and id_periodo='$id_periodo';";
	$result = $this->con->query($sql);
	$res = $result->num_rows;

	if ($res > 0) {
		//echo "Actualizar desglose";
		$ActualizarTutores = $this->UpdaDesgloseCarga($id_docente,$actualizacion,$grupoDc,$materiaDc,$id_periodo,$id_concepto,$horas_asignadas);
	} else {
		//echo "Insertar desglose Horaria";
		$inserCarga = $this->InsDesgloseCarga($id_periodo, $id_docente,$id_concepto, $id_carrera,$grupoDc,$materiaDc, $actualizacion, $horas_asignadas,$descripcion);
		//echo "no";
    }
}

function UpdaDesgloseCarga($idDocente,$actualizacion,$grupo,$materia,$periodo,$concepto,$horas_asignadas) {
	$result = $this->con->query("UPDATE desglose_carga_horaria SET  id_docente='$idDocente', actualizacion='$actualizacion', horas_asignadas = '$horas_asignadas' WHERE grupo='$grupo' and materia='$materia' and id_periodo='$periodo'  and id_concepto='$concepto';");
	if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamenteeeeeeeeeee' . $error . '");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//  echo '<script type="text/javascript">';
		//  echo 'alert("Actualizacion correcta Materias");';
		//  echo 'window.location.assign("AdminDirectorC.php");';
		//  echo '</script>';
    }
    return;
}
	
function VerificaDesgloseCargaLaboratorios ($id_periodo,$id_docente, $id_concepto, $id_carrera,$laboratoriot, $actualizacion, $horas_asignadas,$descripcion) {
	$sql = "SELECT * FROM desglose_carga_horaria where laboratorio='$laboratoriot' and id_periodo='$id_periodo';";
	$result = $this->con->query($sql);
	$res = $result->num_rows;

	if ($res > 0) {
		echo "Actualizar desglose";
		$ActualizarTutores = $this->UpdaDesgloseCargaLaboratorios($id_docente,$actualizacion,$laboratoriot,$id_periodo);
    } else {
		echo "Insertar desglose Horaria";
		$inserTutores = $this->InsDesgloseCarhoraLaboratorio($id_periodo, $id_docente, $id_concepto, $id_carrera,$laboratoriot, $actualizacion, $horas_asignadas,$descripcion);
		//echo "no";
    }
}

function UpdaDesgloseCargaLaboratorios($idDocente,$actualizacion,$idlaboratorio,$id_periodo) {
	$result = $this->con->query("UPDATE desglose_carga_horaria SET  id_docente='$idDocente', actualizacion='$actualizacion' WHERE laboratorio='$idlaboratorio' and id_periodo='$id_periodo';");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//      echo '<script type="text/javascript">';
		//      echo 'alert("Actualizacion correcta Materias");';
		//  	echo 'window.location.assign("AdminDirectorC.php");';
		//      echo '</script>';
    }
    return;
}
 
function InsDesgloseCarhoraLaboratorio($id_periodo, $id_docente, $id_concepto, $id_carrera,$idlaboratoriot, $actualizacion, $horas_asignadas,$descripcion) {
	$result = $this->con->query("INSERT INTO desglose_carga_horaria (id_periodo, id_docente, id_concepto, id_carrera,laboratorio, actualizacion, horas_asignadas,descripcion) VALUES ('$id_periodo', '$id_docente', '$id_concepto', '$id_carrera','$idlaboratoriot', '$actualizacion', '$horas_asignadas','$descripcion');");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
		//echo 'window.location.assign("../AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//  echo '<script type="text/javascript">';
		//  echo 'alert("Gracias por registrarte");';
		//  echo 'window.location.assign("../AdminDirectorC.php");';
		//  echo '</script>';
    }
    return;
}
        
function InsDesgloseCarhoraTutores($id_periodo, $id_docente, $id_concepto, $id_carrera,$grupot, $actualizacion, $horas_asignadas,$descripcion) {
	$result = $this->con->query("INSERT INTO desglose_carga_horaria (id_periodo, id_docente, id_concepto, id_carrera,grupo, actualizacion, horas_asignadas,descripcion) VALUES ('$id_periodo', '$id_docente', '$id_concepto', '$id_carrera','$grupot', '$actualizacion', '$horas_asignadas','$descripcion');");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
		//echo 'window.location.assign("../AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//            echo '<script type="text/javascript">';
		//            echo 'alert("Gracias por registrarte");';
		//            echo 'window.location.assign("../AdminDirectorC.php");';
		//            echo '</script>';
    }
    return;
}
	 
function InsDesgloseCarga($id_periodo, $id_docente, $id_concepto, $id_carrera,$grupot,$materiat, $actualizacion, $horas_asignadas,$descripcion) {
	$result = $this->con->query("INSERT INTO desglose_carga_horaria (id_periodo, id_docente, id_concepto, id_carrera, grupo, materia, actualizacion, horas_asignadas,descripcion) VALUES ('$id_periodo', '$id_docente', '$id_concepto', '$id_carrera','$grupot','$materiat', '$actualizacion', '$horas_asignadas','$descripcion');");

    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error 33 en la captura de tu registro intenta nuevamente' . $error . '");';
		//echo 'window.location.assign("../AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//            echo '<script type="text/javascript">';
		//            echo 'alert("Gracias por registrarte");';
		//        	    echo 'window.location.assign("../AdminDirectorC.php");';
		//            echo '</script>';
    }
    return;
}

function VerificaCargaIndividual ($id_periodo, $id_docente,$id_concepto,$id_carrera,$actualizacion,$horas_asignadas,$descripcion) {
	$sql = "SELECT * FROM desglose_carga_horaria,conceptos_carga_horaria 
		WHERE desglose_carga_horaria.id_concepto=conceptos_carga_horaria.idconceptos_carga_horaria 
		AND conceptos_carga_horaria.tipo=2 and conceptos_carga_horaria.idconceptos_carga_horaria='$id_concepto'and desglose_carga_horaria.id_docente='$id_docente' and id_periodo='$id_periodo' and desglose_carga_horaria.id_carrera='$id_carrera';";
	$result = $this->con->query($sql);
	$res = $result->num_rows;

    if ($res > 0) {
		//echo "Actualizar CargaIndividual";
		$ActualizarTutores = $this->UpdaCargaIndividual($id_docente,$horas_asignadas,$descripcion,$actualizacion,$id_concepto,$id_periodo,$id_carrera);
    } else {
		//echo "Insertar desglose Horaria";
		$inserTutores = $this->InsDesgloseCargaIndividual($id_periodo, $id_docente,$id_concepto,$id_carrera,$actualizacion,$horas_asignadas,$descripcion);
		//echo "no";
    }
}
		 
function UpdaCargaIndividual($idDocente,$horasAsignadas,$descripcion,$actualizacion,$idConcepto,$id_periodo,$idCarrera) {
	$result = $this->con->query("UPDATE desglose_carga_horaria SET  id_docente='$idDocente', horas_asignadas='$horasAsignadas',descripcion='$descripcion',actualizacion='$actualizacion' WHERE id_docente='$idDocente' and id_concepto='$idConcepto' and id_periodo='$id_periodo' and id_carrera='$idCarrera';");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
		// echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//          echo '<script type="text/javascript">';
		//          echo 'alert("Actualizacion correcta Materias");';
		//   		echo 'window.location.assign("AdminDirectorC.php");';
		//          echo '</script>';
    }
    return;
}

function InsDesgloseCargaIndividual($id_periodo, $id_docente,$id_concepto,$id_carrera,$actualizacion,$horas_asignadas,$descripcion) {
	$result = $this->con->query("INSERT INTO desglose_carga_horaria (id_periodo, id_docente, id_concepto, id_carrera, actualizacion, horas_asignadas,descripcion) VALUES ('$id_periodo', '$id_docente', '$id_concepto', '$id_carrera','$actualizacion', '$horas_asignadas','$descripcion');");
	if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error 7777en la captura de tu registro intenta nuevamente' . $error . '");';
		//echo 'window.location.assign("../AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//   echo '<script type="text/javascript">';
		//   echo 'alert("Concepto Agregados con exito");';
		//   echo 'window.location.assign("GuardarCargaIndividual.php");';
		//   echo '</script>';
    }
    return;
}
	 
function MateriasPorDoceCH($id_docente, $id_periodo) {
	$sql = "SELECT plan_estudios.nombre_materia, grupo.grado,grupo.grupo,grupo.turno, carreras.abreviatura, plan_estudios.horas_por_semana 
		FROM materias_carga_horaria,plan_estudios,grupo,carreras 
		WHERE id_docente='$id_docente' 	AND materias_carga_horaria.id_materia=plan_estudios.id AND grupo.idGrupo=materias_carga_horaria.id_grupo 
		AND  materias_carga_horaria.id_carrera=carreras.id and id_periodo='$id_periodo';";
	$result = $this->con->query($sql);
	$i = 0;
	echo "<h3>MATERIAS QUE IMPARTE</h3>";
	echo "<table class='table table-bordered table-striped  data_table3' >
			<thead>
                <tr>
                    <th>Nombre de Materia</th>
                    <th>Grado y Grupo</th>
                    <th>Turno</th>
                    <th>Carrera</th> 
                    <th>Horas Asignadas</th>
                </tr>
            </thead>
            <tbody align='center'>";
        		while ($fila = $result->fetch_row()) {
					echo "<tr class='odd gradeX'>";
					echo "<td><b>";
					echo $NombreMateria[$i] = $fila[0];
					echo "</td><td></b>Grupo: ";
					echo $Grado[$i] = $fila[1];
					echo "°";
					echo $Grupo[$i] = $fila[2];
					echo "</td><td>";
					echo $turno[$i] = $fila[3];
					echo "</td><td> ";
			        echo $carrera[$i] = $fila[4];
					echo "</td><td>";
                    echo $carrera[$i] = $fila[5];
					echo "</td>";
            	$i++;
        		}
		echo "</tbody>
          </table>";
  
}
       
function MatePorDoceCHCarera($id_docente,$id_carrera,$id_periodo) {
	$sql = "SELECT plan_estudios.nombre_materia, grupo.grado,grupo.grupo,grupo.turno, carreras.abreviatura, plan_estudios.horas_por_semana 
		FROM materias_carga_horaria,plan_estudios,grupo,carreras 
		WHERE id_docente='$id_docente' and materias_carga_horaria.id_materia=plan_estudios.id 
		AND grupo.idGrupo=materias_carga_horaria.id_grupo  AND  materias_carga_horaria.id_carrera=carreras.id 
		AND  materias_carga_horaria.id_carrera='$id_carrera' and id_periodo='$id_periodo';";
	$result = $this->con->query($sql);
	$i = 0;
	echo '<h3>MATERIAS QUE IMPARTE</h3>';
	echo "<table class='table table-bordered table-striped  data_table3' >
        	<thead>
                <tr>
                    <th>Nombre de Materia</th>
                    <th>Grado y Grupo</th>
                    <th>Turno</th>
                    <th>Carrera</th> 
                    <th>Horas Asignadas</th>
                </tr>
            </thead>
            <tbody align='center'>";
			while ($fila = $result->fetch_row()) {
						echo"<tr class='odd gradeX'>";
						echo" <td><b>";
						echo $NombreMateria[$i] = $fila[0];
						echo"</td> <td>  </b>Grupo: ";
						echo $Grado[$i] = $fila[1];
						echo"°";
						echo $Grupo[$i] = $fila[2];
						echo" </td> <td>";
						echo $turno[$i] = $fila[3];
						echo" </td> <td> ";
			            echo $carrera[$i] = $fila[4];
						echo"</td><td>";
						echo $carrera[$i] = $fila[5];
						echo"</td>";
            $i++;
        }
	echo "  </tbody>
         </table>";
  
}
    
function SumarMateriasCH($id_docente,$id_periodo) {
	$sql = "select  sum(horas_por_semana) from materias_carga_horaria,plan_estudios where  id_materia=plan_estudios.id  and id_docente='$id_docente' and id_periodo='$id_periodo';";
	$result = $this->con->query($sql);
	$i = 0;

	while ($fila = $result->fetch_row()) {
		//  echo" <td>";
		$NombreMateria[$i] = $fila[0];
		//  echo"</td> ";
        return $NombreMateria[$i];
        $i++;
    }
}
		 
function SumarMateriasCHPorCarrere($id_docente,$carrera,$id_periodo) {
	$sql = "select  sum(horas_por_semana) from materias_carga_horaria,plan_estudios where  id_materia=plan_estudios.id and id_docente='$id_docente' and id_carrera='$carrera' and id_periodo='$id_periodo';";
	$result = $this->con->query($sql);
	$i = 0;

    while ($fila = $result->fetch_row()) {     
		//  echo "<td>";
		$NombreMateria[$i] = $fila[0];      
		//  echo "</td> ";
       	return $NombreMateria[$i];
  		$i++;         
    }      
}
      
				/////////////// Fin Cargar Horaria //////////////////////
    			
				/////////////// Inicia Guardar Laboratorios //////////////////////
    
function Labarotorios($idCarrera) {
	$sql = "SELECT nombre, edificio,horas_laboratorio,Idlaboratorios 
		FROM laboratorios 
		WHERE id_carrera='$idCarrera';";
	$result = $this->con->query($sql);
	$i = 0;
  		//$variable = $result->fetch_row();
		//echo $variable[3]; // 42
	echo "<form id='validation_demo' action='GuardaLab.php' method='post'>";
	echo "<table class='table table-bordered table-striped  data_table3'>
            <thead>
    	        <tr>
        		    <th>Nombre</th>
            		<th>Edificio</th>
            		<th>Horas</th>
            		<th>Encargado</th> 
            	</tr>
            </thead>
            <tbody align='center'>";
	while ($fila = $result->fetch_row()) {
			echo "<tr class='odd gradeX'>";
			echo "<td>";
			echo $Nombre[$i] = $fila[0];
			echo "</td>";
			echo "<td>";
			echo $Edificio[$i] = $fila[1];
			echo "</td>";
			echo "<td>";
			echo $Edificio[$i] = $fila[2];
			echo "</td>";
			echo "<td>";
						
            //Select todos los docentes
			
			$idLab[$i] = $fila[3];
			$docentes=$this->SelecionarTodosDocentesLab($idLab[$i]);
       
			echo "<input type='hidden' value='$idLab[$i]' name='idLaaboratorio[]' />";
			echo "<input type='hidden' value='$Nombre[$i]' name='nombrel[]' />";
			echo "</td>";
			echo " ";
            $i++;
    }
	echo " ";
}
    
function SelecionarTodosDocentesLab($idLab) {
	$sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno, prf_datopersonales.ap_materno 
		FROM prf_datopersonales 
		WHERE prf_tipo <=3 order by prf_datopersonales.ap_paterno asc ;";
	$result = $this->con->query($sql);
	$i = 0;
	echo"  <select   name='reslab[]' data-placeholder='Selecciona al Responsable...' class='chzn-select' tabindex='2' >";
    $nombreDocente=$this->SelecionarDocentesResLab($idLab);  
    while ($fila = $result->fetch_row()) {
    	echo "<option value=''></option> "; 
		echo "<option value='"; 
		echo $id[$i] = $fila[0];
		echo "'>";
		echo $Nombre[$i] = $fila[1];
		echo " "; 
		echo $ApellidoPaterno[$i] = $fila[2];
		echo " "; 
		echo $Nombre[$i] = $fila[3];
        echo "</option>";
		//  echo" </tr>     ";
        $i++;
    }
	echo "</select>";  
}
    
function SelecionarDocentesResLab($id_laboratorios) {
	$sql = "SELECT prf_datopersonales.id, nombre,ap_paterno,ap_materno 
		FROM  resp_laboratorios,prf_datopersonales
		WHERE prf_datopersonales.id=resp_laboratorios.id_docente 
		AND  resp_laboratorios.id_laboratorios='$id_laboratorios'; ";

    $result = $this->con->query($sql);
    $i = 0;
    while ($fila = $result->fetch_row()) {

        echo "<option value='"; 
        echo $id[$i] = $fila[0]; 
        echo "'style='color: #007E3A;'   > ";
        echo $Nombre[$i] = $fila[1];
        echo " "; 
        echo $ApellidoPaterno[$i] = $fila[2];
        echo " "; 
        echo $Nombre[$i] = $fila[3];
        echo "</option>";
        //  echo" </tr>     ";
        $i++;
    }
}
    
function VerificaResLab($idDocente,$id_laboratorios,$actualizacion) {
	$sql = "SELECT * FROM resp_laboratorios  WHERE id_laboratorios='$id_laboratorios';";
	$result = $this->con->query($sql);
	$res = $result->num_rows;

    if ($res > 0) {
		//echo "Actualizar status";
		$ActualizarResLab = $this->UpdateLab($idDocente,$id_laboratorios,$actualizacion);
    } else {
		$InsertarResLab = $this->InsertarResLab($idDocente,$id_laboratorios,$actualizacion);
		//echo "inserta";
    }
}   
    
function InsertarResLab($idDocente,$id_laboratorios,$actualizacion) {
	$result = $this->con->query("INSERT INTO resp_laboratorios "."(id_docente,id_laboratorios,actualizacion) VALUES ('$idDocente','$id_laboratorios','$actualizacion');");
			
	if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Error en la capturazzzz de tu registro intenta nuevamente' . $error . '");';
		echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//          echo '<script type="text/javascript">';
		//          echo 'alert(" Responsable de Laboratorio Guardado Con exito");';
		//			echo 'window.location.assign("AdminDirectorC.php");';
		//            echo '</script>';
    }
	return;
}   
	
function UpdateLab($idDocente,$id_laboratorios,$actualizacion) {
	$result = $this->con->query("UPDATE resp_laboratorios SET id_docente='$idDocente' , actualizacion='$actualizacion' WHERE id_laboratorios='$id_laboratorios';");
    if (!$result) {
		$error = 'Invalid query: ' . $result->error;
		echo '<script type="text/javascript">';
		echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
		echo 'window.location.assign("AdminDirectorC.php");';
		echo '</script>';
		die('Invalid query: ' . $result->error);
    } else {
		//            echo '<script type="text/javascript">';
		//            echo 'alert("Actualizacion correcta");';
		//			  echo 'window.location.assign("AdminDirectorC.php");';
		//            echo '</script>';
    }
    return;
}
       
        /////////////// Fin Guardar Laboratorios//////////////////////
								
		///inicia Carga materias
function GruposPorCarrer($idCarrera,$periodo) {
	$sql = "SELECT cuatrimestre,grupo, carrera,idGrupo,turno FROM grupo where carrera='$idCarrera' and periodo_escolar='$periodo';";
	$result = $this->con->query($sql);
	$i = 0;
	echo "<form id='demovalidation' action='GuardaTutores.php' method='post'>";  
	echo "<table class='table table-bordered table-striped  data_table3' >
			<thead>
				<tr>
					<th>Grupo y Tutor</th>
					<th>Carga Academica</th>
				</tr>
			</thead>
            <tbody align='center'>";                               
    while ($fila = $result->fetch_row()) {
		echo "  <tr class='odd gradeX'>";
		echo "     <td style='color: #007E3A; font-weight: bold;font-size : 13pt'>";
		$turno[$i] = $fila[4];     
		echo $cuatrimestre[$i] = $fila[0]; 
		echo "°" ;
		echo $grupo[$i] = $fila[1];
		echo  " ".$turno[$i];
		$idGrupo[$i] = $fila[3];
		$ngrupo=$cuatrimestre[$i] ."°".$grupo[$i];
		echo "<input type='hidden' value='$idGrupo[$i]' name='grupoTutor[]' />";
		echo "<input type='hidden' value='$ngrupo' name='ngrupo[]' />";
		echo "<input type='hidden' value='$periodo' name='periodo' />";
		$docentes=$this->SelecionarTodosDocentes($idGrupo[$i],$periodo);
		//$docentes=$this-> SelecionarDocentesCargadoTutores($idGrupo[$i]);    
		echo "</td>";
		// $idGrupo[$i] = $fila[3];
       	echo " <td >"; 
		//    echo   $idGrupo[$i];
		//   echo $cuatrimestre[$i];
		echo $materis=$this->MateriasDocenteGrupo($idCarrera,$cuatrimestre[$i],$idGrupo[$i],$idmateria[$i] );  
		echo" </td>";
          
        $i++;
    }   
	echo "   </tbody>
         </table>";
}
	 
function MateriasDocenteGrupo($id,$semestre,$idGrupo,$idmateria) {
		$sql = "SELECT nombre_materia,id,horas_por_semana,h_asesorias,carrera_fk FROM plan_estudios where carrera_fk='$id' and semestre='$semestre';";
		$result = $this->con->query($sql);
		$i = 0;
		echo "<table class='table table-bordered table-striped'>
				<thead>
				   <tr>
				      <th>Nombre</th>
				      <th>Horas Por Semana</th>
				      <th>Docente</th>
				   </tr>
				</thead>
				<tbody align='center'>";
        	while ($fila = $result->fetch_row()) {
				echo "<tr class='odd gradeX'>";
				echo "<td>";
				echo $nombre[$i] = $fila[0];
				echo "</td>";
				echo "<td>";
				echo $hporSemana[$i] = $fila[2]; 
				$idmateria= $fila[1];
					//$haseMaterias[$i]=$fila[3];

					/*$sql2="SELECT horas_asignadas FROM desglose_carga_horaria WHERE id_periodo='9'
						AND materia=$idmateria AND grupo=$idGrupo
						AND id_concepto=3;";

						$resConcep=$this->con->query($sql2);
						$fila24=mysql_num_rows($resConcep);
						$extraeVal=$resConcep->fetch_row();

						if($fila24>0){
							$haseMaterias[$i]=$extraeVal[0];
						}else
						{
							$haseMaterias[$i]=$fila[3];
						}*/

				echo "</td>";
					//echo "<td>";
					//echo '<input type="text" value="'.$haseMaterias[$i].'" name = "horas_aseso[]" style="width:20px" />';
					//echo "</td>";
                echo "<td>";
				$id_carrera[$i] = $fila[4]; 
				$idMaterias[$i] = $fila[1]; 
				$nombre_materia= $fila[0];
				$horas_por_semana= $fila[2];
				echo "<input type='hidden' value='$nombre[$i]' name='nombre_materia[]' />";    
				echo "<input type='hidden' value='$hporSemana[$i]' name='horas_por_semana[]' />";  
				echo '<p><a href="javascript: void(0)" onclick="window.open( ';
				echo "'agregardocente.php?materia=$idMaterias[$i]', 'windowname1', 'width=350, height=350');";
				echo ' return false;"><img src="images/plusmas.png" alt="agregar">Agregar Docente</a></p>';
                    //  echo'</a> ';
				echo "<select data-placeholder='Selecciona un docente...' name='idDocente[]'  chzn-select' >";
				echo " GRUPO-";
                echo $idGrupo;
                echo " MATERIA-";
                echo $idmateria;
				$DocentesCargadosMaterias=$this->SelecionarDocentesCargadoMaterias($idGrupo,$idmateria); 
				$des=$this->MateriasImpartidasDocentesCargarHoraria($idGrupo,$idmateria);
				echo "RRR";  
				echo "</select>";  
				echo "<input type='hidden' value='$id_carrera[$i]' name='id_carrera[]' />";
				echo "<input type='hidden' value='$idMaterias[$i]' name='idMaterias[]' />";
				echo "<input type='hidden' value='$idGrupo' name='idGrupoM[]' />";    
				echo "</td>";
				echo "</tr>";
            $i++;
   			}
		echo "</tbody>
              </table>";              
} 
 
function MateriasImpartidasDocentesCargarHoraria($idgrupo,$idmateria) {
	$sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno,plan_estudios.nombre_materia,matriz_docente.id_materias 
		FROM matriz_docente, plan_estudios,prf_datopersonales
		WHERE plan_estudios.id= matriz_docente.id_materias AND matriz_docente.id_materias='$idmateria' AND prf_datopersonales.user_id= matriz_docente.id_docentes order by ap_paterno ;";
	$result = $this->con->query($sql);
	$i = 0;
	echo "<option value=''></option>"; 
	echo "** "; 
	echo $idgrupo;
	echo "// "; 
	echo $idmaterias;
    while ($fila = $result->fetch_row()) {
		echo"  <option value='"; 
		echo $idp[$i] = $fila[0];
        echo" '>";
		echo $Nombre[$i] = $fila[1];
        echo" "; 
		echo $ApellidoPaterno[$i] = $fila[2];
		echo" "; 
		echo $ApellidoMaterno[$i] = $fila[3];
        echo   "</option> "; 
		//  echo" </tr>     ";
        $i++;
    }     
}
    
function SelecionarDocentesCargadoMaterias($idgrupo,$idmaterias) {
	$sql = "SELECT prf_datopersonales.id, nombre,ap_paterno,ap_materno 
		FROM materias_carga_horaria,prf_datopersonales
		WHERE prf_datopersonales.id=materias_carga_horaria.id_docente 
		AND  materias_carga_horaria.id_grupo='$idgrupo' AND  materias_carga_horaria.id_materia='$idmaterias';";
	$result = $this->con->query($sql);
	$i = 0;
    while ($fila = $result->fetch_row()) {           
		//  echo"  <option  value=''>Elige un Docente..</option>";
        echo "  <option value='"; 
        echo $id[$i] = $fila[0]; 
        echo " ' style='color: #007E3A;'   > ";
        echo $Nombre[$i] = $fila[1];
        echo " "; 
		echo $ApellidoPaterno[$i] = $fila[2];
		echo " "; 
		echo $Nombre[$i] = $fila[3];
        echo "</option> ";                     
		//  echo" </tr>     ";
        $i++;
    }
}
    
	///Fin Carga materias

function obteneIdusuario($username) {
    $sql = "SELECT id FROM 01_user where username='$username';";
    $result = $this->con->query($sql);
    $userId = $result->fetch_row();
    return $userId[0];
}

function obteneFotousuario($id) {
    $sql = "SELECT foto FROM prf_datopersonales where user_id='$id';";
    $result = $this->con->query($sql);
    $userId = $result->fetch_row();
    return $userId[0];
}
	
function obtenerDatosPersonales($id) {
    $resul = $this->con->query("SELECT id,ultima_actualizacion,nombre,ap_paterno,ap_materno,email,genero FROM prf_datopersonales where user_id='$id';");
    //$resul = mysql_fetch_array($resul);
    $resul = $resul->fetch_array(MYSQLI_ASSOC);
    return $resul;
}

function SecondDatosPersonales($id, $fecha_incorporacion, $tel_personal, $fecha_nacimiento, $genero, $curp, $rfc, $n_empleado, $direcion, $localidad, $municipio, $estado, $cp, $foto, $ultima_actualizacion, $prf_titulo, $prf_tipo) {
        $result = $this->con->query("UPDATE prf_datopersonales SET  fecha_incorporacion='$fecha_incorporacion', tel_personal='$tel_personal', fecha_nacimiento='$fecha_nacimiento', genero='$genero', curp='$curp', rfc='$rfc', n_empleado='$n_empleado', 
							   direcion='$direcion', localidad='$localidad', municipio='$municipio', estado='$estado', cp='$cp', foto='$foto' , ultima_actualizacion='$ultima_actualizacion', prf_titulo='$prf_titulo',prf_tipo='$prf_tipo' where user_id='$id'");

        if (!$result) {
				$error = 'Invalid query: ' . $result->error;
						echo '<script type="text/javascript">';
						echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
						echo 'window.location.assign("../profesor/profile.php");';
						echo '</script>';
							die('Invalid query: ' . $result->error);
        } 
		else {
						echo '<script type="text/javascript">';
						echo 'alert("Actualizacion correcta");';
						echo 'window.location.assign("../profesor/profile.php");';
						echo '</script>';
        }
        return;
    }

    
	
	
	
	
function obteneEstatusMateria($idDocente, $id_materia, $semestre) {
			$sql = "SELECT estatus FROM matriz_docente,plan_estudios 
					WHERE  plan_estudios.id=id_materias AND matriz_docente.id_docentes='$idDocente' AND matriz_docente.id_materias='$id_materia'
					AND plan_estudios.semestre='$semestre' group by plan_estudios.id";
			$result = $this->con->query($sql);
					// $userId=$result->fetch_row();
					//return $userId[0];
			$i = 0;

        while ($fila = $result->fetch_row()) {
				$estatus[$i] = $fila[0];
            if ($estatus[$i] == 1) {
					echo "checked ";
            } 
			else {
					echo " ";
            }

            $i++;
        }
    }

    
	
	
	
function obteneLicenciautura($id) {
			//           $sql = "SELECT nombre as grado FROM siseac.prf_titulo;";
				$resul = $this->con->query("SELECT prf_titulo.id as id,prf_titulo.nombre as grado 
									  FROM prf_datopersonales, prf_titulo 
									  WHERE prf_datopersonales.prf_titulo=prf_titulo.id 
									  AND prf_datopersonales.user_id='$id';");
			//$resul = mysql_fetch_array($resul);
			$resul = $resul->fetch_array(MYSQLI_ASSOC);
        return $resul;
    }

    
	
	
	
function obtenerPuesto($id) {
			//           $sql = "SELECT nombre as grado FROM siseac.prf_titulo;";
				$resul = $this->con->query("SELECT prf_tipo.id as id,prf_tipo.abreviatura as tipo FROM prf_datopersonales, prf_tipo 
									  WHERE prf_datopersonales.prf_tipo=prf_tipo.id 
									  AND prf_datopersonales.user_id='$id';");
				//$resul = mysql_fetch_array($resul);
				$resul = $resul->fetch_array(MYSQLI_ASSOC);
        return $resul;
    }

   


function obtenerGeneroEstado($id) {
			//           $sql = "SELECT nombre as grado FROM siseac.prf_titulo;";
				$resul = $this->con->query("SELECT genero, estado 
									  FROM prf_datopersonales 
									  WHERE user_id='$id';");
				//$resul = mysql_fetch_array($resul);
				$resul = $resul->fetch_array(MYSQLI_ASSOC);
        return $resul;
    }

	
    
function InsertMatrizCompetencias($id, $estatus, $idusuario, $idmateria, $fecha) {
					$result = $this->con->query("INSERT INTO matriz_docente(id ,estatus, id_docentes, id_materias, fecha_actualizacion) VALUES ('$id','$estatus','$idusuario','$idmateria','$fecha');");

        if (!$result) {
					$error = 'Invalid query: ' . $result->error;
							echo '<script type="text/javascript">';
							echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
							//            echo 'window.location.assign("../index.php");';
							echo '</script>';
									die('Invalid query: ' . $result->error);
        } 
	    else {
							//            echo '<script type="text/javascript">';
							//            echo 'alert("Gracias por registrarte");';
							////            echo 'window.location.assign("../index.php");';
							//            echo '</script>';
        }
        return;
    }
     
	 
	 

function InsertMatrizCompetencias2($estatus, $idusuario, $idmateria, $fecha) {
					$result = $this->con->query("INSERT INTO matriz_docente(estatus, id_docentes, id_materias, fecha_actualizacion) VALUES ('$estatus','$idusuario','$idmateria','$fecha');");
        if (!$result) {
					$error = 'Invalid query: ' . $result->error;
							echo '<script type="text/javascript">';
							echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
							//            echo 'window.location.assign("../index.php");';
							echo '</script>';
									die('Invalid query: ' . $result->error);
        } 
		else {
							//            echo '<script type="text/javascript">';
							//            echo 'alert("Gracias por registrarte");';
							////            echo 'window.location.assign("../index.php");';
							//            echo '</script>';
        }
        return;
    }
    
    
	

function obteneMatrizCompetenciaActual($id, $estatus, $idusuario, $idmateria, $fecha) {
			$sql = "SELECT * FROM matriz_docente
					WHERE   matriz_docente.id_docentes='$idusuario' 
					AND matriz_docente.id_materias='$idmateria'";
			$result = $this->con->query($sql);
			$res = $result->num_rows;

        if ($res > 0) {
				//echo "Actualizar status";
        } 
		else {
            $inserMTC = $this->InsertMatrizCompetencias($id, $estatus, $idusuario, $idmateria, $fecha);
				//echo "no";
        }
    }
    
	
	
	
function obteneMatrizCompetenciaActual2($estatus, $idusuario, $idmateria, $fecha) {
			$sql = "SELECT  * FROM matriz_docente
					WHERE   matriz_docente.id_docentes='$idusuario' 
					AND matriz_docente.id_materias='$idmateria'";
			$result = $this->con->query($sql);
			$res = $result->num_rows;

        if ($res > 0) {
					echo "Actualizar status";
        } 
		else {
			$inserMTC = $this->InsertMatrizCompetencias2($estatus, $idusuario, $idmateria, $fecha);
					echo "no";
        }
    }

    
	
	
	
function ObtenerDatosDocentes() {
			$sql = "SELECT n_empleado,prf_titulo,nombre,ap_paterno,ap_materno,genero,email,prf_tipo,estado,municipio,fecha_incorporacion,ultima_actualizacion,id,user_id 
					FROM prf_datopersonales order by user_id asc;";
			$result = $this->con->query($sql);
			$i = 0;
        while ($fila = $result->fetch_row()) {
					echo"<tr class='odd gradeX'>";
					echo" <td>";
					echo"<a href='profileAdmin.php?idPrf=";
					echo $idPrf[$i] = $fila[12];
					echo"&idTabUser=";
					echo $idTabUser[$i] = $fila[13];
					echo "'>";
					echo $NumeroEmpleado[$i] = $fila[0];
					echo"</a>";
					echo" </td>";
					echo" <td>";
							$grado[$i] = $fila[1];
        if ($grado[$i] == 1) {
					echo "Licenciado";
            } 
			else if ($grado[$i] == 2) {
					echo "Ingeniero ";
            } 
			else if ($grado[$i] == 3) {
					echo "Especialidad ";
            } 
			else if ($grado[$i] == 4) {
					echo "Especialida Medica ";
            } 
			else if ($grado[$i] == 6) {
					echo "Maestria ";
            }
			else if ($grado[$i] == 8) {
                    echo "Doctorado ";
            }
            
            
				echo" </td>";
				echo"<td> ";
				echo $Nombre[$i] = $fila[2];
				echo" </td>";
				echo" <td>";
				echo $ApellidoPaterno[$i] = $fila[3];
				echo" </td>";
				echo" <td>";
				echo $ApellidoMaterno[$i] = $fila[4];
				echo" </td>";
				echo" <td>";
				echo $ApellidoMaterno[$i] = $fila[5];
				echo" </td>";
				echo" <td>";
				echo $email[$i] = $fila[6];
				echo" </td>";
				echo" <td>";
					$Puesto[$i] = $fila[7];
		if ($Puesto[$i] == 1) {
                echo "Administrativo ";
            } 
			else if ($Puesto[$i] == 2) {
                echo "Profesor Tiempo Completo ";
            } 
			else if ($Puesto[$i] == 3) {
                echo "Profesor por Asignatura ";
            } 
			else if ($Puesto[$i] == 4) {
                echo "Director de Área ";
            } 
			else if ($Puesto[$i] == 5) {
                echo "Director de Carrera ";
            }
				echo" </td>";
				echo" <td>";
     			echo $Puesto[$i] = $fila[8];
                echo" </td>";
				echo" <td>";
				echo $ApellidoMaterno[$i] = $fila[9];
				echo" </td>";
				echo" <td>";
				echo $ApellidoMaterno[$i] = $fila[10];
				echo" </td>";
                echo" <td>";
				echo $ApellidoMaterno[$i] = $fila[11];
				echo" </td>";
				echo" </tr>     ";
            $i++;
        }
    }

function ObtenerDatosCargahoraria($id_periodo) {
	$sql = "SELECT id_docente, prf_datopersonales.n_empleado , prf_datopersonales.nombre, prf_datopersonales.ap_paterno, prf_datopersonales.ap_materno ,
		SUM(CASE WHEN id_concepto = 1 THEN horas_asignadas ELSE 0 END) hsemagrupo,
		SUM(CASE WHEN id_concepto = 2 THEN horas_asignadas ELSE 0 END) frentegrupo,
		SUM(CASE WHEN id_concepto = 3 THEN horas_asignadas ELSE 0 END) asesorias,
		SUM(CASE WHEN id_concepto = 4 THEN horas_asignadas ELSE 0 END) estadias,
		SUM(CASE WHEN id_concepto = 5 THEN horas_asignadas ELSE 0 END) tesis,
		SUM(CASE WHEN id_concepto = 6 THEN horas_asignadas ELSE 0 END) tutorias,
		SUM(CASE WHEN id_concepto = 7 THEN horas_asignadas ELSE 0 END) cuerpoacademico,
		SUM(CASE WHEN id_concepto = 8 THEN horas_asignadas ELSE 0 END) reunionacademica,
		SUM(CASE WHEN id_concepto = 9 THEN horas_asignadas ELSE 0 END) laboratorios,
		SUM(CASE WHEN id_concepto = 10 THEN horas_asignadas ELSE 0 END) finvestigacion,
		SUM(CASE WHEN id_concepto = 11 THEN horas_asignadas ELSE 0 END) admon,
		SUM(CASE WHEN id_concepto = 12 THEN horas_asignadas ELSE 0 END) cursoa,
		SUM(CASE WHEN id_concepto = 13 THEN horas_asignadas ELSE 0 END) difusion,
		SUM(CASE WHEN id_concepto = 32 THEN horas_asignadas ELSE 0 END) proyectos,
		SUM(CASE WHEN id_concepto = 15 THEN horas_asignadas ELSE 0 END) cTutor,
		SUM(CASE WHEN id_concepto = 16 THEN horas_asignadas ELSE 0 END) ptc,
		SUM(CASE WHEN id_concepto = 17 THEN horas_asignadas ELSE 0 END) pa,
		SUM(CASE WHEN id_concepto = 18 THEN horas_asignadas ELSE 0 END) inves,
		SUM(CASE WHEN id_concepto = 19 THEN horas_asignadas ELSE 0 END) didacticos,
		SUM(CASE WHEN id_concepto = 20 THEN horas_asignadas ELSE 0 END) adminPtc,
		SUM(CASE WHEN id_concepto = 21 THEN horas_asignadas ELSE 0 END) admoni,
		SUM(CASE WHEN id_concepto = 22 THEN horas_asignadas ELSE 0 END) cEstadias,
		SUM(CASE WHEN id_concepto = 23 THEN horas_asignadas ELSE 0 END) conocer,
		SUM(CASE WHEN id_concepto = 24 THEN horas_asignadas ELSE 0 END) mesaT,
		SUM(CASE WHEN id_concepto = 25 THEN horas_asignadas ELSE 0 END) cAcademia,
		SUM(CASE WHEN id_concepto = 26 THEN horas_asignadas ELSE 0 END) acreditacion,
		SUM(CASE WHEN id_concepto = 27 THEN horas_asignadas ELSE 0 END) ceincuba,
		SUM(CASE WHEN id_concepto = 28 THEN horas_asignadas ELSE 0 END) evaut,
		SUM(CASE WHEN id_concepto = 30 THEN horas_asignadas ELSE 0 END) investigacion,
		SUM(CASE WHEN id_concepto = 31 THEN horas_asignadas ELSE 0 END) administrativa,
			user_id, prf_tipo, prf_titulo
		FROM desglose_carga_horaria, prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
			AND desglose_carga_horaria.id_periodo='$id_periodo'
		GROUP BY id_docente ;";
			$result = $this->con->query($sql);
			$i = 0;
          while ($fila = $result->fetch_row()) {
			echo "<tr class='odd gradeX'>";
			echo "  <td>";
			echo "    <a href='profileAdmin.php?idPrf=";
			echo $idPrf[$i] = $fila[0];
			echo "    &idTabUser=";
			echo $idTabUser[$i] = $fila[35];
			echo "    '>";
			echo $NumeroEmpleado[$i] = $fila[1];
			echo "     </a>";
			echo "  </td>";
			echo "  <td> ";
			echo $Nombre[$i] = $fila[2]." ".$fila[3]." ".$fila[4];
			echo "  </td>";
			echo "  <td>";
			$Puesto[$i] = $fila[36];
			if ($Puesto[$i] == 1) {
				echo "Administrativo ";
			} 
			else if ($Puesto[$i] == 2) {
				echo "Profesor Tiempo Completo ";
			} 
			else if ($Puesto[$i] == 3) {
				echo "Profesor por Asignatura ";
			} 
			else if ($Puesto[$i] == 4) {
				echo "Director de Área ";
			} 
			else if ($Puesto[$i] == 5) {
				echo "Director de Carrera ";
			}
			echo "  </td>";
			echo "  <td>";
			$grado[$i] = $fila[37];
			if ($grado[$i] == 1) {
				echo "Licenciado";
			} 
			else if ($grado[$i] == 2) {
				echo "Ingeniero ";
			} 
			else if ($grado[$i] == 3) {
				echo "Especialidad ";
			} 
			else if ($grado[$i] == 4) {
				echo "Especialida Medica ";
			} 
			else if ($grado[$i] == 6) {
				echo "Maestria ";
			}
			else if ($grado[$i] == 8) {
				echo "Doctorado ";
			}
			echo "  </td>";
			echo "  <td>";
			$MateriasqImparte=$this->MateriasParaAgregar($idPrf[$i], $id_periodo);
			echo "  </td>";
			$SumaMaterias = $this->SumarMateriasCH($idPrf[$i], $id_periodo);
			echo "  <td>";
			echo $SumaMaterias;
			echo "  </td>";
			echo "  <td>";
			echo $asesorias[$i] = $fila[7];
			echo "  </td>";
			echo "  <td>";
			echo $estadias[$i] = $fila[8];
			echo "  </td>";
			echo "  <td>";
			$tutorias[$i] = $fila[10];
			if($tutorias[$i]>0)
			{
				echo '<p><a href="javascript: void(0)" onclick="window.open( ';
				echo "'TutoriaPorDocenete.php?docente=$idPrf[$i]', 'windowname1', 'width=600, height=600');";
				echo ' return false;">';
				echo $tutorias[$i];
				echo '</a></p>';	
			}else{
				echo $tutorias[$i];
			}
			echo "  </td>";
			$observaciones[$i]="";
			if($fila[11]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[11]." horas de Cuerpo Academico</br>";
			}
			if($fila[12]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[12]." horas de Reunion Academica</br>";
			}
			if($fila[13]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[13]." horas de Laboratorios</br>";
			}
			if($fila[14]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[14]." horas de Investigación</br>";
			}
			if($fila[15]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[15]." horas de Admon ISO</br>";
			}
			if($fila[16]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[16]." horas de Curso Actualizacion</br>";
			}
			if($fila[17]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[17]." horas de Difusion</br>";
			}
			if($fila[18]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[18]." horas de Proyecto</br>";
			}
			if($fila[19]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[19]." Coordinacion de Tutores</br>";
			}
			if($fila[20]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[20]." proyectos PTC</br>";
			}
			if($fila[21]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[21]." proyectos PA</br>";
			}
			if($fila[22]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[22]." Investigación y Desarrollo</br>";
			}
			if($fila[23]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[23]." Elaboración de Material Didactico</br>";
			}
			if($fila[24]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[24]." Horas Administrativas PTC</br>";
			}
			if($fila[26]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[26]." Coordinación de Estadías</br>";
			}
			if($fila[27]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[27]." CONOCER</br>";
			}
			if($fila[28]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[28]." Mesa Técnica</br>";
			}
			if($fila[29]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[29]." Acreditación</br>";
			}
			if($fila[30]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[30]." CEINCUBA</br>";
			}
			if($fila[31]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[31]." EVAUT</br>";
			}
			if($fila[32]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[32]." Investigación</br>";
			}
			if($fila[33]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[33]." Administrativas</br>";
			}
			/*if($fila[18]>0){
				$stringProy='<p><a href="javascript: void(0)" onclick="window.open( ';
				$stringProy=$stringProy."'DescripcioDeProyectos.php?docente=$idPrf[$i]', 'windowname1', 'width=600, height=600');";
				$stringProy=$stringProy.' return false;">';
				$stringProy=$stringProy.$fila[18]." horas de Proyectos";
				$stringProy=$stringProy.'</a></p>';
				$observaciones[$i]=$observaciones[$i].$stringProy;
			}*/
			/*$cacademicos[$i] = $fila[11];
			$racademicos[$i] = $fila[12];
			$tlab[$i] = $fila[13];
			$investigacion[$i] = $fila[14];
			$isos[$i] = $fila[15];
			$actualizacion[$i] = $fila[16];
			$difusion[$i] = $fila[17];
			$Proyectos[$i] = $fila[18];*/
                       
               $sumaTotal = $this->TotalInstitucional($fila[0],$id_periodo);
                       
			if($sumaTotal<=40){
				echo" <td style='color: #007E3A; font-weight: bold;font-size : 12pt' >";	
			}
			else {
				echo" <td style='color:#FF0000; font-weight: bold;font-size : 12pt;'>";
				echo "<span class='conVal' >";
               }
                         
			echo  $sumaTotal;
			echo " </span> </td>";
			///////////observaciones
			echo "  <td>";
			echo $observaciones[$i];
			echo "  </td>";
			echo "</tr>";
            $i++;
         }
}  

	
function TutoPorGrupo($id_docente,$idperiodo) {
				$sql = "SELECT grupo.grado,grupo.grupo, carreras.abreviatura 
						FROM tutores_grupo,grupo,carreras
						WHERE id_docente='$id_docente' 
						AND tutores_grupo.id_grupo=grupo.idGrupo AND grupo.carrera=carreras.id and id_periodo='$idperiodo';";
				$result = $this->con->query($sql);
				$i = 0;
							echo ' <h3>Tutoria Por Grupo</h3>';
							echo"  <table class='table table-bordered table-striped  data_table3' >
                                   <thead>
                                   <tr>
                                   <th>Grupo</th>  
								   <th>Carrera</th>  
								   </tr>
                                   </thead>
                                   <tbody align='center'>";
        while ($fila = $result->fetch_row()) {
							echo"<tr class='odd gradeX'>";
							echo" <td><b>";
							echo $Grupo[$i] = $fila[0];
							echo" ";
							echo $Grado[$i] = $fila[1];
							echo"</td> ";
							echo" <td><b>";
							echo $Carrera[$i] = $fila[2];
							echo"</td> ";
			   
            $i++;
        }
							echo"   </tbody>
                                    </table>";
  
    }
    
    
	
	
function DescripcionPorProyecto($id_docente) {
					$sql = "SELECT carreras.abreviatura,descripcion FROM desglose_carga_horaria,carreras
							WHERE id_concepto=14 
							AND id_docente='$id_docente' AND desglose_carga_horaria.id_carrera=carreras.id;";
					$result = $this->con->query($sql);
					$i = 0;
							echo ' <h3>Descripcion del Proyecto</h3>';
							echo"  <table class='table table-bordered table-striped  data_table3' >
                                   <thead>
                                   <tr>
                                   <th>Carreras</th>   
                                   <th>Descripcion</th>                                                                                                                                                                                     </tr>
								   </thead>
                                   <tbody align='center'>";
        while ($fila = $result->fetch_row()) {
							echo"<tr class='odd gradeX'>";
							echo" <td><b>";
							echo $Carrera[$i] = $fila[0];
							echo"</td> ";
							echo" <td><b>";
							echo $Descripcion[$i] = $fila[1];
							echo"</td> ";
            $i++;
        }
							echo"   </tbody>
                                    </table>";
  
    }
    
    
	
	
	
    
function ObtenerDocentePorMateriaI($id_periodo) {
		$sql = "SELECT prf_datopersonales.id,prf_datopersonales.user_id,prf_datopersonales.n_empleado, prf_datopersonales.nombre, prf_datopersonales.ap_paterno ,prf_datopersonales.ap_materno,plan_estudios.nombre_materia, grupo.grado,grupo.grupo,  grupo.turno,carreras.abreviatura, plan_estudios.horas_por_semana
			FROM materias_carga_horaria,plan_estudios,grupo,carreras,prf_datopersonales
			WHERE materias_carga_horaria.id_materia=plan_estudios.id 
				AND grupo.idGrupo=materias_carga_horaria.id_grupo 
				AND materias_carga_horaria.id_carrera=carreras.id 
				AND prf_datopersonales.id= materias_carga_horaria.id_docente
				AND id_periodo='$id_periodo';";
			$result = $this->con->query($sql);
			$i = 0;
        	while ($fila = $result->fetch_row()) {
				echo "<tr class='odd gradeX'>";
				echo "<td>";
				echo "<a href='profileAdmin.php?idPrf=";
				echo $idPrf[$i] = $fila[0];
				echo "&idTabUser=";
				echo $idTabUser[$i] = $fila[1];
				echo "'>";
				echo $NumeroEmpleado[$i] = $fila[2];
				echo "</a></td>";				
				echo "<td>";
				echo $Nombre[$i] = $fila[3];
				echo "</td>";
				echo "<td >";
				echo $ApellidoPaterno[$i] = $fila[4];
				echo "</td >";
				echo "<td>";
				echo $ApellidoMaterno[$i] = $fila[5];
				echo "</td>";
				echo "<td>";
				echo $ApellidoMaterno[$i] = $fila[6];
				echo "</td>";
				echo "<td>";
				$grado[$i] = $fila[7];
				$grupo[$i] = $fila[8];
				echo $grado[$i].'°'.$grupo[$i];
				echo "</td>";
				echo "<td>";
				echo $turno[$i] = $fila[9];
				echo "</td>";
				echo "<td>";
				echo $carrera[$i] = $fila[10];
				echo "</td>";
				echo "<td>";
				echo $horas[$i] = $fila[11];
				echo "</td>";
				echo "</tr>";
            $i++;
        }
    }  
        
function SelecNombCarrera($idCarrera) {
					$sql = "SELECT abreviatura FROM carreras WHERE id='$idCarrera';";
					$result = $this->con->query($sql);
					$i = 0; 
        while ($fila = $result->fetch_row()) {
								echo   $id_carrera[$i] = $fila['0'];    
            $i++;
        }
              
    }
    
    
	
	
    
function ObtenerDatosCargahorariaPorCarrera($carrera, $id_periodo) {
	$sql = "SELECT id_docente, prf_datopersonales.n_empleado, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno,
		SUM(CASE WHEN id_concepto = 1 THEN horas_asignadas ELSE 0 END) hsemagrupo,
		SUM(CASE WHEN id_concepto = 2 THEN horas_asignadas ELSE 0 END) frentegrupo,
		SUM(CASE WHEN id_concepto = 3 THEN horas_asignadas ELSE 0 END) asesorias,
		SUM(CASE WHEN id_concepto = 4 THEN horas_asignadas ELSE 0 END) estadias,
		SUM(CASE WHEN id_concepto = 5 THEN horas_asignadas ELSE 0 END) tesis,
		SUM(CASE WHEN id_concepto = 6 THEN horas_asignadas ELSE 0 END) tutorias,
		SUM(CASE WHEN id_concepto = 7 THEN horas_asignadas ELSE 0 END) cuerpoacademico,
		SUM(CASE WHEN id_concepto = 8 THEN horas_asignadas ELSE 0 END) reunionacademica,
		SUM(CASE WHEN id_concepto = 9 THEN horas_asignadas ELSE 0 END) laboratorios,
		SUM(CASE WHEN id_concepto = 10 THEN horas_asignadas ELSE 0 END) finvestigacion,
		SUM(CASE WHEN id_concepto = 11 THEN horas_asignadas ELSE 0 END) admon,
		SUM(CASE WHEN id_concepto = 12 THEN horas_asignadas ELSE 0 END) cursoa,
		SUM(CASE WHEN id_concepto = 13 THEN horas_asignadas ELSE 0 END) difusion,
		SUM(CASE WHEN id_concepto = 32 THEN horas_asignadas ELSE 0 END) proyectos,
		SUM(CASE WHEN id_concepto = 15 THEN horas_asignadas ELSE 0 END) cTutor,
		SUM(CASE WHEN id_concepto = 16 THEN horas_asignadas ELSE 0 END) ptc,
		SUM(CASE WHEN id_concepto = 17 THEN horas_asignadas ELSE 0 END) pa,
		SUM(CASE WHEN id_concepto = 18 THEN horas_asignadas ELSE 0 END) inves,
		SUM(CASE WHEN id_concepto = 19 THEN horas_asignadas ELSE 0 END) didacticos,
		SUM(CASE WHEN id_concepto = 20 THEN horas_asignadas ELSE 0 END) adminPtc,
		SUM(CASE WHEN id_concepto = 21 THEN horas_asignadas ELSE 0 END) admoni,
		SUM(CASE WHEN id_concepto = 22 THEN horas_asignadas ELSE 0 END) cEstadias,
		SUM(CASE WHEN id_concepto = 23 THEN horas_asignadas ELSE 0 END) conocer,
		SUM(CASE WHEN id_concepto = 24 THEN horas_asignadas ELSE 0 END) mesaT,
		SUM(CASE WHEN id_concepto = 25 THEN horas_asignadas ELSE 0 END) cAcademia,
		SUM(CASE WHEN id_concepto = 26 THEN horas_asignadas ELSE 0 END) acreditacion,
		SUM(CASE WHEN id_concepto = 27 THEN horas_asignadas ELSE 0 END) ceincuba,
		SUM(CASE WHEN id_concepto = 28 THEN horas_asignadas ELSE 0 END) evaut,
		SUM(CASE WHEN id_concepto = 30 THEN horas_asignadas ELSE 0 END) investigacion,
		SUM(CASE WHEN id_concepto = 31 THEN horas_asignadas ELSE 0 END) administrativa,
		user_id, prf_tipo, prf_titulo
		FROM desglose_carga_horaria, prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
          	AND id_carrera= '$carrera'
			AND id_periodo= '$id_periodo'
		GROUP BY id_docente ;";
			$result = $this->con->query($sql);
			$i = 0;
        	while ($fila = $result->fetch_row()) {
			echo "<tr class='odd gradeX'>";
			echo "  <td>";
			echo "    <a href='profileAdmin.php?idPrf=";
			echo $idPrf[$i] = $fila[0];
			echo "&idTabUser=";
			echo $idTabUser[$i] = $fila[35];
			echo "'>";
			echo $NumeroEmpleado[$i] = $fila[1];
			echo "    </a></td>";				
			echo "  <td>";
			echo $Nombre[$i] = $fila[2];
			echo " ";
			echo $ApellidoPaterno[$i] = $fila[3];
			echo " ";
			echo $ApellidoMaterno[$i] = $fila[4];
			echo "  </td>";
			echo "  <td>";
			$Puesto[$i] = $fila[36];
			if ($Puesto[$i] == 1) {
				echo "Administrativo ";
			}else if ($Puesto[$i] == 2) {
				echo "Profesor Tiempo Completo ";
			}else if ($Puesto[$i] == 3) {
				echo "Profesor por Asignatura ";
			}else if ($Puesto[$i] == 4) {
				echo "Director de Área ";
			}else if ($Puesto[$i] == 5) {
				echo "Director de Carrera ";
			}
			echo "  </td>";
			echo "  <td>";
			$grado[$i] = $fila[37];		
        		if ($grado[$i] == 1) {
				echo "Licenciado";
            	}else if ($grado[$i] == 2) {
				echo "Ingeniero ";
            	}else if ($grado[$i] == 3) {
				echo "Especialidad ";
            	}else if ($grado[$i] == 4) {
				echo "Especialida Medica ";
            	}else if ($grado[$i] == 6) {
				echo "Maestria ";
            	}else if ($grado[$i] == 8) {
				echo "Doctorado ";
            	}
			echo "  </td>";
			echo "  <td>";
			$materiasaca=$this->MateriasProfeCarrera($idPrf[$i], $carrera, $id_periodo);
			echo "  <td>";
			$frentegrupo[$i] = $fila[6];
			$SumaMaterias = $this->SumarMateriasCHPorCarrere($idPrf[$i], $carrera, $id_periodo);
			echo $SumaMaterias;
			echo "  </td>";
			echo "  <td>";
			echo $asesorias[$i] = $fila[7]; 
			echo "  </td>";
			echo "  <td>";
			echo $estadias[$i] = $fila[8];
			echo "  </td>";
			echo "  <td>";
               echo '<p><a href="javascript: void(0)" onclick="window.open( ';
			echo "'../admin/TutoriaPorDocenete.php?docente=$idPrf[$i]', 'windowname1', 'width=600, height=600');";
			echo ' return false;">';
			echo $tutorias[$i] = $fila[10];
			echo '    </a></p>';
			echo "  </td>";
			$observaciones[$i]="";
			if($fila[11]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[11]." horas de Cuerpo Academico</br>";
			}
			if($fila[12]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[12]." horas de Reunion Academica</br>";
			}
			if($fila[13]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[13]." horas de Laboratorios</br>";
			}
			if($fila[14]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[14]." horas de Investigación</br>";
			}
			if($fila[15]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[15]." horas de Admon ISO</br>";
			}
			if($fila[16]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[16]." horas de Curso Actualizacion</br>";
			}
			if($fila[17]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[17]." horas de Difusion</br>";
			}
			if($fila[18]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[18]." horas de Proyecto</br>";
			}
			if($fila[19]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[19]." Coordinacion de Tutores</br>";
			}
			if($fila[20]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[20]." proyectos PTC</br>";
			}
			if($fila[21]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[21]." proyectos PA</br>";
			}
			if($fila[22]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[22]." Investigación y Desarrollo</br>";
			}
			if($fila[23]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[23]." Elaboración de Material Didactico</br>";
			}
			if($fila[24]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[24]." Horas Administrativas PTC</br>";
			}
			if($fila[26]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[26]." Coordinación de Estadías</br>";
			}
			if($fila[27]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[27]." CONOCER</br>";
			}
			if($fila[28]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[28]." Mesa Técnica</br>";
			}
			if($fila[29]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[29]." Coordinación de Academia</br>";
			}
			if($fila[30]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[30]." Acreditación</br>";
			}
			if($fila[31]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[31]." CEINCUBA</br>";
			}
			if($fila[32]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[32]." EVAUT</br>";
			}
			if($fila[33]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[33]." Investigación</br>";
			}
			if($fila[34]>0){
				$observaciones[$i]=$observaciones[$i]." ".$fila[34]." Administrativas</br>";
			}
			/*$otras_cosas="";
			$cacademicos[$i] = $fila[11];
			if($fila[11]>0)
				$otras_cosas = $otras_cosas.$cacademicos[$i]." horas de Cuerpos Academicos</br>";
			$racademicos[$i] = $fila[12];
			if($fila[12]>0)
				$otras_cosas=$otras_cosas.$racademicos[$i]." horas de Reuniones Academicas</br>";
			$tlab[$i] = $fila[13];
			if($fila[13]>0)
				$otras_cosas=$otras_cosas.$tlab[$i]." horas de Taller laboratorio</br>";
			$investigacion[$i] = $fila[14];
			if($fila[14]>0)
				$otras_cosas=$otras_cosas.$investigacion[$i]." horas de Investigación</br>";
			$actualizacion[$i] = $fila[16];
			if($fila[16]>0)
				$otras_cosas=$otras_cosas.$actualizacion[$i]." horas de Actualización</br>";
			$difusion[$i] = $fila[17];
			if($fila[17]>0)
				$otras_cosas=$otras_cosas.$difusion[$i]." horas de Difusión</br>";
			$Proyectos[$i] = $fila[18];
			if($fila[18]>0)
				$otras_cosas=$otras_cosas.$Proyectos[$i]." horas de Proyectos";
			if($fila[19]>0){
				$otras_cosas=$otras_cosas." ".$fila[19]." coordinacion de tutores</br>";
			}
			if($fila[20]>0){
				$otras_cosas=$otras_cosas." ".$fila[20]." proyectos PTC</br>";
			}
			if($fila[21]>0){
				$otras_cosas=$otras_cosas." ".$fila[21]." proyectos PA</br>";
			}
			if($fila[22]>0){
				$otras_cosas=$otras_cosas." ".$fila[22]." Investigación y Desarrollo</br>";
			}
			if($fila[23]>0){
				$otras_cosas=$otras_cosas." ".$fila[23]." Elaboración de Material Didactico</br>";
			}
			if($fila[24]>0){
				$otras_cosas=$otras_cosas." ".$fila[24]." Horas Administrativas PTC</br>";
			}*/
			echo "  <td>";
			echo $observaciones[$i];
			echo "  </td>";
			echo "  <td>";
			$carrera;
			$NombreCarrera = $this->SelecNombCarrera($carrera);
			echo "  </td>";  
			$sumaPorCarrera = 0;
			for($j = 7; $j <= 34; $j++){
				if($fila[$j] > 0)
					$sumaPorCarrera += $fila[$j];
			}            
			//$sumaTotal= $SumaMaterias+$asesorias[$i]+$estadias[$i]+$tesis[$i]+$tutorias[$i]+ $cacademicos[$i]+$racademicos[$i]+$tlab[$i]+$investigacion[$i]+$isos[$i]+$actualizacion[$i]+ $difusion[$i]+$Proyectos[$i];
			$sumaTotal = $SumaMaterias + $sumaPorCarrera;
			if($sumaTotal<=40)
				echo "<td style='color: #007E3A; font-weight: bold;font-size : 12pt' >";
			else{
				echo "<td style='color:#FF0000; font-weight: bold;font-size : 12pt;'>";
        		}             
			echo $sumaTotal;
			echo "</td>";
        		$TotalInstitucional = $this->TotalInstitucional($fila[0],$id_periodo);
        		if($TotalInstitucional<=40)
				echo" <td style='color: #007E3A; font-weight: bold;font-size : 12pt' >";
      	  	else {
				echo"<td style='background-image:url";
				echo '("images/bg_notification.png"); ';
				echo "color:#FFFFFF; font-weight: bold;font-size : 12pt; background-repeat: no-repeat;'>";
			}
			echo '<a href="javascript: void(0)" onclick="window.open( ';
			echo "'materiasImpartidas.php?docente=$idPrf[$i]&periodo=$id_periodo', 'windowname1', 'width=600, height=600');";
			echo ' return false;">';
    		     echo $TotalInstitucional;
        		echo '</a>';
			echo "</td>";
			echo "</tr>";
			$i++;
    		}
 }
    
 function TotalInstitucional($idDocente, $id_periodo) {
 	//$id_periodo=9;
					/*$sql = "SELECT id_docente,prf_datopersonales.n_empleado , prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno ,
									SUM(CASE WHEN id_concepto = 1 THEN horas_asignadas ELSE 0 END) hsemagrupo,
									SUM(CASE WHEN id_concepto = 2 THEN horas_asignadas ELSE 0 END)  frentegrupo,
									SUM(CASE WHEN id_concepto = 3 THEN horas_asignadas ELSE 0 END) asesorias,
									SUM(CASE WHEN id_concepto = 4 THEN horas_asignadas ELSE 0 END) estadias,
									SUM(CASE WHEN id_concepto = 5 THEN horas_asignadas ELSE 0 END)  tesis,
									SUM(CASE WHEN id_concepto = 6 THEN horas_asignadas ELSE 0 END)  tutorias,
									SUM(CASE WHEN id_concepto = 7 THEN horas_asignadas ELSE 0 END) cuerpoacademico,
									SUM(CASE WHEN id_concepto = 8 THEN horas_asignadas ELSE 0 END) reunionacademica,
									SUM(CASE WHEN id_concepto = 9 THEN horas_asignadas ELSE 0 END) laboratorios,
									SUM(CASE WHEN id_concepto = 10 THEN horas_asignadas ELSE 0 END)  finvestigacion,
									SUM(CASE WHEN id_concepto = 11 THEN horas_asignadas ELSE 0 END) admon,
									SUM(CASE WHEN id_concepto = 12 THEN horas_asignadas ELSE 0 END) cursoa,
									SUM(CASE WHEN id_concepto = 13 THEN horas_asignadas ELSE 0 END) difusion,
									SUM(CASE WHEN id_concepto =14 THEN horas_asignadas ELSE 0 END) proyectos,
													user_id,prf_tipo,prf_titulo
							FROM desglose_carga_horaria,prf_datopersonales 
							WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
							AND id_periodo='$id_periodo'
							AND id_docente='$idDocente';";*/
							$sql = "SELECT sum(horas_asignadas) FROM `desglose_carga_horaria` where id_docente='$idDocente' and id_periodo='$id_periodo'";
					$result = $this->con->query($sql);
					//$fila = mysql_fetch_array($result);
					$fila = $result->fetch_array(MYSQLI_NUM);
					return $fila[0];
		/*			$i = 0;
        while ($fila = $result->fetch_row()) {
					$idPrf[$i] = $fila[0];
					$idTabUser[$i] = $fila[19];
					$NumeroEmpleado[$i] = $fila[1];
					$Puesto[$i] = $fila[20];
					$grado[$i] = $fila[21];     
					$frentegrupo[$i] = $fila[6];
					$SumaMaterias = $this->SumarMateriasCH($idPrf[$i],$id_periodo);
					$asesorias[$i] = $fila[7];                        
                    $estadias[$i] = $fila[8];                   
					$tesis[$i] = $fila[9];                     
					$tutorias[$i] = $fila[10];       
					$cacademicos[$i] = $fila[11];                
					$racademicos[$i] = $fila[12];
					$tlab[$i] = $fila[13];
                    $investigacion[$i] = $fila[14];
					$isos[$i] = $fila[15];                
					$actualizacion[$i] = $fila[16];
                    $difusion[$i] = $fila[17];
					$Proyectos[$i] = $fila[18];
                    $sumaTotal= $SumaMaterias+$asesorias[$i]+$estadias[$i]+$tesis[$i]+$tutorias[$i]+ $cacademicos[$i]+$racademicos[$i]+$tlab[$i]+$investigacion[$i]+$isos[$i]+$actualizacion[$i]+ $difusion[$i]+$Proyectos[$i];  
                  return        $sumaTotal;
                
            $i++;
        }*/
    }  
    
function ObtenerDatosCargahoraria2($id_periodo) {
					$sql = "SELECT id_docente,prf_datopersonales.n_empleado , prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno ,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TICMCE,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TTUT,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DNAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DTUT,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PIAA,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PTUT,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAMTUT,
 
									SUM(CASE WHEN id_concepto = 2 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAMTUT,
												user_id,prf_tipo,prf_titulo
							FROM desglose_carga_horaria,prf_datopersonales 
							WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
							AND id_periodo='$id_periodo'
							GROUP BY id_docente ;";
					$result = $this->con->query($sql);
					$i = 0;
        while ($fila = $result->fetch_row()) {
								echo"<tr class='odd gradeX'>";
								echo" <td>";
								echo"<a href='profileAdmin.php?idPrf=";
								echo $idPrf[$i] = $fila[0];
								echo"&idTabUser=";
								echo $idTabUser[$i] = $fila[19];
								echo "'>";
								echo $NumeroEmpleado[$i] = $fila[1];
								echo"</a>";
								
								echo" </td>";
								echo"<td> "; 	echo $Nombre[$i] = $fila[2];				echo" </td>";
								echo" <td >"; 	echo $ApellidoPaterno[$i] = $fila[3]; 		echo" </td >";
								echo" <td>"; 	echo $ApellidoMaterno[$i] = $fila[4];		echo" </td>";
								
								echo" <td>";    echo $frentegrupo[$i] = $fila[5];   		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[6];  			echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[7]; 			echo" </td>";
								echo" <td>";	echo $frentegrupo[$i] = $fila[8];      		echo" </td>";
								
								echo" <td>";    echo $frentegrupo[$i] = $fila[9];  			echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[10];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[11]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[12];    		echo" </td>";
                      			
								echo" <td>";    echo $frentegrupo[$i] = $fila[13];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[14];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[15]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[16];      	echo" </td>";         
                                
								echo" <td>";    echo $frentegrupo[$i] = $fila[17];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[18];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[19]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[20];      	echo" </td>";   
								
								echo" <td>";    echo $frentegrupo[$i] = $fila[21];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[22];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[23]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[24];      	echo" </td>";  
                   				
								echo" <td>";    echo $frentegrupo[$i] = $fila[25];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[26]; 			echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[27]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[28];      	echo" </td>";  
                   				
								echo" <td>";    echo $frentegrupo[$i] = $fila[29];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[30];  		echo" </td>";
								echo" <td>";	echo $frentegrupo[$i] = $fila[31]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[32];      	echo" </td>";  
                   				
								echo" <td>";    echo $frentegrupo[$i] = $fila[33];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[34];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[35]; 			echo" </td>";
								echo" <td>";   	echo $frentegrupo[$i] = $fila[36];      	echo" </td>";  
                                
								echo" <td>";    echo $frentegrupo[$i] = $fila[37];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[38];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[39]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[40];     		echo" </td>";  
								
								echo" <td>";    echo $frentegrupo[$i] = $fila[41];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[42];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[43]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[44];      	echo" </td>";  
                   
								echo" <td>";    echo $frentegrupo[$i] = $fila[45];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[46];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[47]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[48];   		echo" </td>";  
                   
								echo" <td>";    echo $frentegrupo[$i] = $fila[49];  		echo" </td>";
								echo" <td>";	echo $frentegrupo[$i] = $fila[50];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[51]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[52];     		echo" </td>";  
                   
								echo" <td>";    echo $frentegrupo[$i] = $fila[53];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[54];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[55]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[56];      	echo" </td>";  
                   
								echo" <td>";    echo $frentegrupo[$i] = $fila[57];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[58];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[59]; 			echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[60];      	echo" </td>";  
                 

								echo" </tr>     ";
            $i++;
        }
    }  

function ObtenerDatosCargahoraria3($id_periodo) {
					$sql = "SELECT id_docente,prf_datopersonales.n_empleado , prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno ,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=9 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=10 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=11 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=12 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=13 THEN horas_asignadas ELSE 0 END) PIAMTUT,
									 
									SUM(CASE WHEN id_concepto = 2 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=14 THEN horas_asignadas ELSE 0 END) PIAMTUT,
													user_id,prf_tipo,prf_titulo
							FROM desglose_carga_horaria,prf_datopersonales 
							WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
							AND id_periodo='$id_periodo'
							GROUP BY id_docente ;";
					$result = $this->con->query($sql);
					$i = 0;
        while ($fila = $result->fetch_row()) {
								echo"<tr class='odd gradeX'>";
								echo" <td>";
								echo"<a href='profileAdmin.php?idPrf=";
								echo $idPrf[$i] = $fila[0];
								echo"&idTabUser=";
								echo $idTabUser[$i] = $fila[19];
								echo "'>";
								echo $NumeroEmpleado[$i] = $fila[1];
								echo"</a>";
								echo" </td>";
								
								echo" <td>"; 	echo $Nombre[$i] = $fila[2]; 			echo" </td>";
								echo" <td>"; 	echo $ApellidoPaterno[$i] = $fila[3];  	echo" </td>";
								echo" <td>"; 	echo $ApellidoMaterno[$i] = $fila[4]; 	echo" </td>";
								
								echo" <td>";    echo $frentegrupo[$i] = $fila[5];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[6]; 		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[7]; 		echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[8];  	    echo" </td>";
                                echo" <td>";    echo $frentegrupo[$i] = $fila[9];  		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[10];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[11]; 		echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[12];      echo" </td>";
                      
								echo" <td>";    echo $frentegrupo[$i] = $fila[13];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[14];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[15]; 		echo" </td>";
								echo" <td>";   	echo $frentegrupo[$i] = $fila[16];      echo" </td>";         
          
								echo" <td>";    echo $frentegrupo[$i] = $fila[17];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[18]; 		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[19]; 		echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[20];    	echo" </td>";   
                   
								echo" <td>";    echo $frentegrupo[$i] = $fila[21];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[22];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[23]; 		echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[24];    	echo" </td>";  
                   
								echo" <td>";    echo $frentegrupo[$i] = $fila[25];  	echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[26]; 		echo" </td>";
								echo" <td>"; 	echo $frentegrupo[$i] = $fila[27]; 		echo" </td>";
								echo" <td>";    echo $frentegrupo[$i] = $fila[28];   	echo" </td>";  
								echo" </tr>";
            $i++;
        }
    }  

function ObtenerDatosCargahoraria4($id_periodo) {
					$sql = "SELECT id_docente,prf_datopersonales.n_empleado , prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno ,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TICMCE,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=1 THEN horas_asignadas ELSE 0 END) TTUT,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DNAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=2 THEN horas_asignadas ELSE 0 END) DTUT,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PIAA,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=3 THEN horas_asignadas ELSE 0 END) PTUT,
									SUM(CASE WHEN id_concepto = 2 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=4 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=5 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=6 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=7 THEN horas_asignadas ELSE 0 END) PIAMTUT,

									SUM(CASE WHEN id_concepto = 2 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAM,
									SUM(CASE WHEN id_concepto = 3 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAMASE,
									SUM(CASE WHEN id_concepto = 4 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAMEST,
									SUM(CASE WHEN id_concepto = 6 and id_carrera=8 THEN horas_asignadas ELSE 0 END) PIAMTUT


							FROM desglose_carga_horaria,prf_datopersonales 
							WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
							AND id_periodo='$id_periodo'
							GROUP BY id_docente ;";
					$result = $this->con->query($sql);
					$i = 0;
        while ($fila = $result->fetch_row()) {
									echo"<tr class='odd gradeX'>";
									echo" <td>";
									echo"<a href='profileAdmin.php?idPrf=";
									echo $idPrf[$i] = $fila[0];
									echo"&idTabUser=";
									echo $idTabUser[$i] = $fila[19];
									echo "'>";
									echo $NumeroEmpleado[$i] = $fila[1];
									echo"</a>";
									echo" </td>";


									echo"<td> ";  	echo $Nombre[$i] = $fila[2]; 			echo" </td>";
									echo" <td >";   echo $ApellidoPaterno[$i] = $fila[3];   echo" </td >";
									echo" <td>";    echo $ApellidoMaterno[$i] = $fila[4];   echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[5];  		echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[6];  		echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[7]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[8];      	echo" </td>";
                     
									echo" <td>";    echo $frentegrupo[$i] = $fila[9];  		echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[10];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[11]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[12];      echo" </td>";
                      
									echo" <td>";    echo $frentegrupo[$i] = $fila[13];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[14];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[15]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[16];      echo" </td>";         
          
									echo" <td>";    echo $frentegrupo[$i] = $fila[17];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[18]; 		echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[19]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[20];      echo" </td>";   
                   
									echo" <td>";    echo $frentegrupo[$i] = $fila[21];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[22];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[23]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[24];      echo" </td>";  
                   
									echo" <td>";    echo $frentegrupo[$i] = $fila[25];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[26];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[27]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[28];      echo" </td>";  
                   
									echo" <td>";    echo $frentegrupo[$i] = $fila[29]; 		echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[30];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[31]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[32];      echo" </td>";  
                   
									echo" <td>";    echo $frentegrupo[$i] = $fila[33];  	echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[34]; 		echo" </td>";
									echo" <td>"; 	echo $frentegrupo[$i] = $fila[35]; 		echo" </td>";
									echo" <td>";    echo $frentegrupo[$i] = $fila[36];      echo" </td>";  
									echo" </tr>     ";
            $i++;
        }
    }  

function ObtenerPlandeEstudio() {
					$sql = "SELECT id, nombre_materia,documento_url, semestre, carrera, h_frente_grupo,h_asesorias,nivel  from plan_estudios ORDER BY carrera asc;";
					$result = $this->con->query($sql);
					$i = 0;
        while ($fila = $result->fetch_row()) {
								echo"<tr class='odd gradeX'>";
							echo" <td>";
								echo"<a href='MateriasPorDocentes.php?idMaterias=";
								echo $id[$i] = $fila[0];
								echo "'>";
								echo $id[$i] = $fila[0];
								echo"</a>";
							echo" </td>";
							echo" <td>";
								echo"<a href='"; 	echo $url[$i] = $fila[2];    echo "'>";    echo $nombreMateria[$i] = $fila[1]; 
								echo"</a>"; 
							echo" </td>";
								echo" <td>"; 	echo $ApellidoMaterno[$i] = $fila[3];  	echo" </td>";
								echo" <td>";    echo $ApellidoMaterno[$i] = $fila[4];   echo" </td>";
								echo" <td>";    echo $ApellidoMaterno[$i] = $fila[5];   echo" </td>";
								echo" <td>";	echo $ApellidoMaterno[$i] = $fila[6];   echo" </td>";
								echo" <td>"; 	echo $ApellidoMaterno[$i] = $fila[7]; 	echo" </td>";
								echo" </tr>";
            $i++;
        }
    }
    
    
	
	
	
	
	
function MateriasImpartidasDocentes($id) {
					$sql = "SELECT prf_datopersonales.n_empleado, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno,plan_estudios.nombre_materia
							FROM matriz_docente, plan_estudios,prf_datopersonales
							WHERE plan_estudios.id= matriz_docente.id_materias and matriz_docente.id_materias='$id' and prf_datopersonales.user_id= matriz_docente.id_docentes;";
					$result = $this->con->query($sql);
					$i = 0;
       
        while ($fila = $result->fetch_row()) {
							echo"<tr class='odd gradeX'>";
           
								echo" <td>";     echo $ApellidoMaterno[$i] = $fila[0];    echo" </td>";
								echo" <td>";     echo $ApellidoMaterno[$i] = $fila[1];    echo" </td>";
								echo" <td>";     echo $ApellidoMaterno[$i] = $fila[2];    echo" </td>";
								echo" <td>";     echo $ApellidoMaterno[$i] = $fila[3];    echo" </td>";
							echo" </tr>     ";
            $i++;
        }
    }
    
    
    
    
    
       
     

	 
function CarreraPorDirectorSelect($idDirector) {
					$sql = "SELECT carreras.id, carreras.nombre, carreras.nivel,carreras.abreviatura  
							FROM director_carrera, 01_user,carreras
							WHERE  01_user.id=director_carrera.user_ide and 01_user.id='$idDirector' and carreras.id=director_carrera.carrera;";
					$result = $this->con->query($sql);
					$i = 0;
  								echo '  <div class="section">';
								echo '  <label>Carrera<small> a la que se asignara</small></label> ';
								echo '  <div>';
								echo"   <select   name='id_carrera' id='id_carrera' data-placeholder='Selecciona una carrera...'  chzn-select' tabindex='2' >";
								echo"   <option value=''></option> ";
        while ($fila = $result->fetch_row()) {
            		$id_carrera[$i] = $fila['0'];                
								echo"  <option value='"; 
								echo $id_carrera[$i];
                                echo"'> ";
              
								echo $Nombre[$i] = $fila[1];
								echo   "</option> "; 
                       
            $i++;
        }
								echo "</select>";  
								echo '</div>';
								echo '</div>';
           
    }
    
	
function TodaslasCarreraSelect() {
	$sql = "SELECT carreras.id, carreras.nombre, carreras.nivel,carreras.abreviatura  FROM carreras;";
	$result = $this->con->query($sql);
	$i = 0;        
		//echo '<div class="section">';
		//echo '<label>Carreras<small></small></label>';
		//echo '<div>';
		echo "<select   name='id_carrera' id='id_carrera' data-placeholder='Selecciona una Carrera...'  chzn-select' tabindex='2' >";
		echo "<option value=''></option>";
        
        while ($fila = $result->fetch_row()) {
            $id_carrera[$i] = $fila['0'];
        	echo "<option value='"; 
			echo $id_carrera[$i];
			echo "'>";
            echo $Nombre[$i] = $fila[3];  
            echo "</option> "; 
            $i++;
        }
		echo "</select>";  
		echo '</div>';
		echo '</div>';
}
    
function TodaslasCarrerasId(){
//$sql = "SELECT carreras.id, carreras.nombre, carreras.nivel, carreras.abreviatura FROM carreras;";
	$sql = "SELECT carrera from director_carrera order by user_ide;";
	$result = $this->con->query($sql);
	//$ides = array();
	$abrevias = array();

	while($fila = $result->fetch_row()){
	//	$ides[] = $fila[0];
		$sql2 = "SELECT carreras.abreviatura from carreras where carreras.id=".$fila[0].";";
		$result2 = $this->con->query($sql2);
		$fila2 = $result2->fetch_row();
		$abrevias[] = $fila2[0];
	}

	return $abrevias;
}

function TablePTCAdmin($abreviatu, $periodo_actual){
	$sqlx="SELECT carrera from director_carrera order by user_ide;";
	$resultx=$this->con->query($sqlx);
	$i=0;
	echo "<table class='table table-bordered table-striped' >";
	echo "<tr><th>Carrera</th><th>Horas de PTC</th><th>Horas de PA</th><th>Horas de Administrativos</th></tr>";
	while($filax = $resultx->fetch_row()){ 
		# code...
		$this->ptcVSpaporCarrera($filax[0],$abreviatu[$i++],$periodo_actual);  //se agreega parametro
		//echo '<hr>';
	}
	echo "</table>";
}
	
function TablePTCAdminPorCarrera($carrera, $periodo){
	$sql = "SELECT abreviatura from carreras where id=$carrera";
	$result = $this->con->query($sql);
	$fila = $result->fetch_row();
	echo "<table class='table table-bordered table-striped' >";
	echo "<tr><th>Carrera</th><th>Horas de PTC</th><th>Horas de PA</th><th>Horas de Administrativos</th></tr>";
	$this->ptcVSpaPorCarrera($carrera,$fila[0],$periodo); //se agrega parametro
	echo "</table>";
}

function TablePTCAdminPorDirector($idusuario, $periodo){
	$sqlx = "SELECT carrera from director_carrera where user_ide=$idusuario;";
	$resultx = $this->con->query($sqlx);
	//$i=0;
	echo "<table class='table table-bordered table-striped'>";
	echo "<tr><th>Carrera</th><th>Horas de PTC</th><th>Horas de PA</th><th>Horas de Administrativos</th></tr>";
	while($filax = $resultx->fetch_row()){ 
	# code...                        
		$sql = "SELECT abreviatura from carreras where id=".$filax[0].";";
		$result = $this->con->query($sql);
		$abrevia = $result->fetch_row();
		$this->ptcVSpaporCarrera($filax[0],$abrevia[0],$periodo);     //se agrega parametro
	//echo '<hr>';
	}
	echo "</table>";
}
    
function CarreraPorDirector($idDirector) {
					$sql = "SELECT carreras.id, carreras.nombre, carreras.nivel,carreras.abreviatura  
							FROM director_carrera, 01_user,carreras
							WHERE  01_user.id=director_carrera.user_ide and 01_user.id='$idDirector'  and  carreras.id=director_carrera.carrera;";
					$result = $this->con->query($sql);
					$i = 0;
								echo"  <table class='table table-bordered table-striped  data_table3' >             
										<thead>
											<tr>
											<th>Nombre</th>
											<th>Nivel</th>
											<th>Abreviaturas</th> 
											<!--<th> Asignación  Resp. Labs.</th>-->
											<th> Carga Academica</th>
											<!--<th> Carga Estadias</th>-->
											</tr>
											</thead>
											<tbody align='left'>";
													  
        while ($fila = $result->fetch_row()) {
								echo"<tr class='odd gradeX'>";
								//       echo" <td>";
								// 		 echo $id[$i] = $fila[0];
								//       echo" </td>";
								echo" <td style='color: #007E3A; font-weight: bold;font-size : 10pt'> ";
                                echo $nombre[$i] = $fila[1];
								echo" </td>";
								echo" <td>";
								echo $Nivel[$i] = $fila[2];
								echo" </td>";
								echo" <td>";
								echo $abreviatura[$i] = $fila[3];
								echo" </td>";
								//echo" <td>";
                    $idCarrer[$i] = $fila[0];
                    $abreviatura[$i] = $fila[3];
								//echo" <a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
								//echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
                                               
											   //falta un if que verifique el estatus*******
											   
								//echo" </td>";
                                echo" <td>";
                    $idCarrer[$i] = $fila[0];
                    $abreviatura[$i] = $fila[3];
								echo"<a href='GruposCargaHoraria.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
								echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
								
								//echo" <td>";
                    $idCarrer[$i] = $fila[0];
                    $abreviatura[$i] = $fila[3];
								//echo" <a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
								//echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
                                              
											  //falta un if que verifique el estatus*******
											  
								//echo" </td>";
										// echo" <td>";
										//  $idCarrer[$i] = $fila[0];
										//    $abreviatura[$i] = $fila[3];
										//echo"<a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
										//  echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
										
                                               //falta un if que verifique el estatus*******
											   
										//  echo" </td>";
                       
								echo" </tr>     ";
            $i++;
        }
        
								echo"   </tbody>
                                                  </table>";
    }
    
     
function AdminCargaH() {
					$sql = "SELECT carreras.id, carreras.nombre, carreras.nivel,carreras.abreviatura  FROM carreras;";
					$result = $this->con->query($sql);
					$i = 0;
								echo"  <table class='table table-bordered table-striped  data_table3' >
             
												<thead>
												<tr>
                                                <th>Nombre</th>
                                                <th>Nivel</th>
                                                <th>Abreviaturas</th> 
                                                <th> Asignación  Resp. Labs.</th>
                                                <th> Carga Academica</th>
                                                <!--<th>Carga Estadias</th>-->
                                                </tr>
                                                </thead>
                                                <tbody align='left'>";
        while ($fila = $result->fetch_row()) {
								echo"<tr class='odd gradeX'>";
											//       echo" <td>";
											//       echo $id[$i] = $fila[0];
											//       echo" </td>";
								echo" <td style='color: #007E3A; font-weight: bold;font-size : 10pt'> ";
                                echo $nombre[$i] = $fila[1]; 	echo" </td>";
								echo" <td>";  	echo $Nivel[$i] = $fila[2];      	echo" </td>";
								echo" <td>"; 	echo $abreviatura[$i] = $fila[3]; 	echo" </td>";
								echo" <td>"; 
					$idCarrer[$i] = $fila[0];
                    $abreviatura[$i] = $fila[3];
								echo"<a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
								echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
                                            
											//falta un if que verifique el estatus*******
											
								echo" </td>";
                       			echo" <td>";
					$idCarrer[$i] = $fila[0];
                    $abreviatura[$i] = $fila[3];
								echo"<a href='GruposCargaHoraria.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
								echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
                                              
											  //falta un if que verifique el estatus*******
											  
								echo" </td>";
								/*echo" <td>";
                    $idCarrer[$i] = $fila[0];
                    $abreviatura[$i] = $fila[3];
								echo"<a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
								echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
                                               //falta un if que verifique el estatus*******
								echo" </td>";*/
                       
								echo" </tr>     ";
            $i++;
        }
        
								echo"   </tbody>
                                                  </table>";
    }
	 
function ReporteporDirector($idDirector, $id_periodo) {
					$sql = "SELECT carreras.id, carreras.nombre, carreras.nivel,carreras.abreviatura  
							FROM director_carrera, 01_user,carreras
							WHERE  01_user.id=director_carrera.user_ide and 01_user.id='$idDirector' and carreras.id=director_carrera.carrera;";
					$result = $this->con->query($sql);
					$i = 0;
        
        while ($fila = $result->fetch_row()) {
            
				$idCarrer[$i] = $fila[0];
				$Cargahoraria=$this->ObtenerDatosCargahorariaPorCarrera($idCarrer[$i],$id_periodo);
				//           echo" <td>";
				//           $idCarrer[$i] = $fila[0];
				//           $abreviatura[$i] = $fila[3];
				//           echo"<a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
				//           echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
				//  Falta un if que verifique el estatus*******
				//           echo" </td>";
                      
				echo" </tr>     ";
            $i++;
        }
        echo "</tbody>
              </table>";
    }
    
    	
function MateriasporGrupo($abreviatura,$semestre) {
					$sql = "SELECT nombre_materia,semestre,carrera,h_frente_grupo,h_asesorias FROM plan_estudios where Carrera='$abreviatura' and semestre=$semestre;";
					$result = $this->con->query($sql);
					$i = 0;
									//         echo"  <table class='table table-bordered table-striped  data_table3' >
									//             
									//                                                      <thead>
									//                                                          <tr>
									//                                                              <th>Cuatrimestre</th>
									//                                                              <th>Grupo</th>
									//                                                    
									//                                                               
									//                                                          </tr>
									//                                                      </thead>
									//                                                      <tbody align='center'>";
        while ($fila = $result->fetch_row()) {
									//            echo"<tr class='odd gradeX'>";
								echo" <td>";
								echo $ApellidoMaterno[$i] = $fila[0];
								echo" </td>";
								echo" <td>";
								echo"<a href='GruposCargaHoraria.php?idCarre=";
								echo $id[$i] = $fila[0];
								echo "'>";
								echo $id[$i] = $fila[1];
								echo"</a>";
								echo" </td>";
        
									//             echo" </tr>     ";
            $i++;
        }
        
									//              echo"   </tbody>
									//                                                  </table>";
    } 
    
    
							///////Inicia Metodos Materia----------------
 
       
    
								////////////Inicia Alta materias Carga
    

	
function VerificaMateCarga($idDocente,$id_materia,$actualizacion,$id_carrera,$id_periodo,$id_grupo) {
					$sql = "SELECT * FROM materias_carga_horaria where id_grupo='$id_grupo' and id_materia='$id_materia';";
					$result = $this->con->query($sql);
					$res = $result->num_rows;

        if ($res > 0) {
								//  echo "Actualiza";
					$ActualizarCargaHoraria= $this->UpdaMateriasCargaHoraria($idDocente,$id_materia,$actualizacion,$id_grupo);

        } else {
								// echo "Inserta";
					$InsertarMateriasCargaHoraria = $this->InsertarMateriasCargaHoraria($id_carrera,$id_periodo,$id_materia,$idDocente,$id_grupo,$actualizacion);

        }
    } 
    
  

function UpdaMateriasCargaHoraria($idDocente,$idmaterias,$actualizacion,$idgrupo) {
					$result = $this->con->query("UPDATE materias_carga_horaria SET  id_docente='$idDocente', actualizacion='$actualizacion' WHERE id_materia='$idmaterias'and id_grupo='$idgrupo';");
        if (!$result) {
					$error = 'Invalid query: ' . $result->error;
								echo '<script type="text/javascript">';
								echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
										// echo 'window.location.assign("AdminDirectorC.php");';
								echo '</script>';
										die('Invalid query: ' . $result->error);
        } 		
		else {
										//            echo '<script type="text/javascript">';
										//            echo 'alert("Actualizacion correcta Materias");';
										//   //echo 'window.location.assign("AdminDirectorC.php");';
										//            echo '</script>';
        }
        return;
    }
 
    
function InsertarMateriasCargaHoraria($id_carrera,$id_periodo,$id_materia,$id_docente, $id_grupo,$actualizacion) {
					$result = $this->con->query("INSERT INTO  materias_carga_horaria (id_carrera, id_periodo, id_materia, id_docente, id_grupo,actualizacion) VALUES ('$id_carrera','$id_periodo','$id_materia','$id_docente', '$id_grupo','$actualizacion');");
        if (!$result) {
					$error = 'Invalid query: ' . $result->error;
								echo '<script type="text/javascript">';
										//echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
								echo 'window.location.assign("AdminDirectorC.php");';
								echo '</script>';
										die('Invalid query: ' . $result->error);
        } 
		else {
										//            echo '<script type="text/javascript">';
										//            echo 'alert("Materias Guardado Con exito");';
										//// echo 'window.location.assign("AdminDirectorC.php");';
										//            echo '</script>';
        }
        return;
    }
    
    
    
									///Fin Altas Materias Carga
    
    

function ObtenerMatrizPorDocente($id) {
					$sql = "SELECT plan_estudios.nombre_materia,semestre,Carrera 
							FROM prf_datopersonales, matriz_docente,plan_estudios
							WHERE id_docentes=prf_datopersonales.user_id 
							AND plan_estudios.id=matriz_docente.id_materias 
							AND prf_datopersonales.id='$id';";
					$result = $this->con->query($sql);
					$i = 0;
        while ($fila = $result->fetch_row()) {
								echo"<tr class='odd gradeX'>";

								echo" <td > ";     				echo $nombreMateria[$i] = $fila[0];      echo" </td>";
								echo" <td class='center'> ";    echo $semestre[$i] = $fila[1];           echo" </td>";

								echo" <td class='center'> "; 	echo $semestre[$i] = $fila[2];    	     echo" </td>";
								echo" </tr>     ";
            $i++;
        }
    }
    
    
function ObtenerGradorAcademico($id) {
				$sql = "SELECT  gradoA,escuela,cedula,periodo 
						FROM  grado_academico  
						WHERE user_ide='$id';";
					$result = $this->con->query($sql);
					$i = 0;
        while ($fila = $result->fetch_row()) {
            
			
								echo"<tr class='odd gradeX'>";

								echo" <td > "; 					 echo $nombreMateria[$i] = $fila[0];		echo" </td>";
								echo" <td class='center'> ";     echo $semestre[$i] = $fila[1]; 	        echo" </td>";

								echo" <td class='center'> ";     echo $semestre[$i] = $fila[2];             echo" </td>";

								echo" </tr>     ";
            $i++;
        }
    }
    
    
	 
function ObtenerCarrerraAcademica($id) {
				$sql = "SELECT actividad,institucion,periodo 
						FROM carrera_academica 
						WHERE user_id_ca='$id';";
				$result = $this->con->query($sql);
				$i = 0;
        while ($fila = $result->fetch_row()) {
							echo"<tr class='odd gradeX'>";

							echo" <td > "; 					echo $nombreMateria[$i] = $fila[0]; 	echo" </td>";
							echo" <td class='center'> ";  	echo $semestre[$i] = $fila[1]; 			echo" </td>";

							echo" <td class='center'> ";  	echo $semestre[$i] = $fila[2];          echo" </td>";

							echo" </tr>     ";
            $i++;
        }
    }
    
    
		
function ObtenerMateriasImpartidas($id) {
				$sql = "SELECT nombre, semestre_equivalente,no_veces,periodo 
						FROM materias_imp 
						WHERE user_id_mi='$id';";
				$result = $this->con->query($sql);
				$i = 0;
        while ($fila = $result->fetch_row()) {
							echo"<tr class='odd gradeX'>";

							echo" <td > "; 					echo $nombreMateria[$i] = $fila[0]; 	echo" </td>";
							echo" <td class='center'> ";    echo $semestre[$i] = $fila[1]; 			echo" </td>";
 
							echo" <td class='center'> ";    echo $semestre[$i] = $fila[2];          echo" </td>";
							echo" <td class='center'> ";    echo $periodo[$i] = $fila[3];           echo" </td>";

							echo" </tr>     ";
            $i++;
        }
    }


function ObtenerSumatoria($id_carrera,$id_periodo){

		//$id_periodo = 9;
		$id_concepto = 4; 	//concepto 4 son horas de estadía

		$sql = "SELECT sum(horas_asignadas)
				FROM desglose_carga_horaria 
				WHERE id_carrera=$id_carrera and id_periodo = $id_periodo and id_concepto = $id_concepto";
	$result = $this->con->query($sql);

	$fila=$result->fetch_row();

	return $fila[0];

}

function obtieneIdProyecto($id_carrera,$id_docente,$id_concepto,$id_periodo){

	//$id_periodo=9;

	$sql = "SELECT iddesglose_carga_horaria
				FROM desglose_carga_horaria 
				WHERE id_carrera=$id_carrera and id_periodo = $id_periodo and id_concepto = $id_concepto and id_docente = $id_docente";
	$result = $this->con->query($sql);

	$fila=$result->fetch_row();

	return $fila[0];	

}

function VerificaExisteProyecto($iddesglose){

				$sql = "SELECT * FROM formato_proyectos 
						WHERE  iddesglose_carga_horaria = $iddesglose ;";
				$result = $this->con->query($sql);
				$res = $result->num_rows;
				$idRegresado = $result->fetch_row();

				if($res > 0){
					return $idRegresado[2].".%".$idRegresado[3].".%".$idRegresado[4].".%".$idRegresado[5].".%".$idRegresado[6];
				}else{
					return "";
				}


}

function VerificaExisteConcepto($id_docente, $id_concepto, $id_carrera,$id_periodo){

				//$id_periodo=9;

	$sql = "SELECT iddesglose_carga_horaria, horas_asignadas, descripcion
				FROM desglose_carga_horaria 
				WHERE id_carrera=$id_carrera and id_periodo = $id_periodo and id_concepto = $id_concepto and id_docente = $id_docente";
	$result = $this->con->query($sql);

				$res = $result->num_rows;
				
				$Regresado = $result->fetch_row();

				if($res > 0){
					return $Regresado[1].".%".$Regresado[2].".%";
				}else{
					return "";
				}
}

function GuardaFormatoProyecto ($iddesglose, $titulo, $lineaCuerpo, $objetivo_general, $objetivosEmpresa, $justificacion) {
				$sql = "SELECT idformato_proyectos FROM formato_proyectos 
						WHERE  iddesglose_carga_horaria = '$iddesglose' ;";
				$result = $this->con->query($sql);
				$res = $result->num_rows;
				$idRegresado = $result->fetch_row();

        if ($res > 0) {			

				//$ActualizarTutores = $this->UpdaCargaIndividual($id_docente,$horas_asignadas,$descripcion,$actualizacion,$id_concepto,$id_periodo);

				$result2 = $this->con->query("UPDATE formato_proyectos SET  iddesglose_carga_horaria = '$iddesglose', titulo_proyecto = '$titulo', linea_cuerpo_academico = '$lineaCuerpo', objetivo_general = '$objetivo_general', objetivos_empresa = '$objetivosEmpresa', justificacion = '$justificacion'  WHERE idformato_proyectos ='$idRegresado[0]' ;");
        
        if (!$result2) {
					$error = 'Invalid query: ' . $result2->error;
							echo '<script type="text/javascript">';
							echo 'alert("Ocurrio un error intenta nuevamente")';// . $error . '");';
							// echo 'window.location.assign("AdminDirectorC.php");';
							echo '</script>';
							die('Invalid query: ' . $result2->error);
        }

        } 
		else {
				//echo "Insertar desglose Horaria";
				//$inserTutores = $this->InsDesgloseCargaIndividual($id_periodo, $id_docente,$id_concepto,$id_carrera,$actualizacion,$horas_asignadas,$descripcion);
			$result2 = $this->con->query("INSERT INTO formato_proyectos (iddesglose_carga_horaria, titulo_proyecto, linea_cuerpo_academico, objetivo_general, objetivos_empresa, justificacion) 
				VALUES ('$iddesglose','$titulo','$lineaCuerpo','$objetivo_general','$objetivosEmpresa', '$justificacion');");

    if (!$result2) {
            $error = 'Invalid query: ' . $result2->error;
				echo '<script type="text/javascript">';
				echo 'alert("Error en la captura de tu registro intenta nuevamente")';// . $error . '");';
			  //echo 'window.location.assign("AdminDirectorC.php");';
				echo '</script>';
					 die('Invalid query: ' . $result2->error);
        } 
			//echo "no";
        }

        $result = $this->con->query($sql);
				//$res = num_rows($result);
				$idRegresado = $result->fetch_row();

        return $idRegresado[0];
    } 

    function MateriasParaAgregar($id_docente,$id_periodo)
    {
    	$sql = "SELECT plan_estudios.nombre_materia, grupo.grado,grupo.grupo,grupo.turno, carreras.abreviatura, plan_estudios.horas_por_semana 
		FROM materias_carga_horaria,plan_estudios,grupo,carreras 
		WHERE id_docente='$id_docente' 	AND materias_carga_horaria.id_materia=plan_estudios.id AND grupo.idGrupo=materias_carga_horaria.id_grupo 
		AND  materias_carga_horaria.id_carrera=carreras.id and id_periodo='$id_periodo';";
		$result = $this->con->query($sql);
		$i = 0;
		
        $regresarConsul="";
        while ($fila = $result->fetch_row()) {
			
			$NombreMateria[$i] = $fila[0];
			$regresarConsul=$regresarConsul.$NombreMateria[$i]." - ";
			$Grado[$i] = $fila[1];
			$regresarConsul=$regresarConsul.$Grado[$i]."°";
			$Grupo[$i] = $fila[2];
			$regresarConsul=$regresarConsul.$Grupo[$i]." ";
			$turno[$i] = $fila[3];
			$regresarConsul=$regresarConsul.$turno[$i]." - ";
			$carrera[$i] = $fila[4];
			$regresarConsul=$regresarConsul.$carrera[$i].". - (";
            $horas[$i] = $fila[5];
			$regresarConsul=$regresarConsul.$horas[$i]." horas)</br>";
            $i++;
        }
        echo $regresarConsul;
    }

function MateriasProfeCarrera($id_docente,$id_carrera, $id_periodo) {
				$sql = "SELECT plan_estudios.nombre_materia, grupo.grado,grupo.grupo,grupo.turno, carreras.abreviatura, plan_estudios.horas_por_semana 
						FROM materias_carga_horaria,plan_estudios,grupo,carreras 
						WHERE id_docente='$id_docente' and materias_carga_horaria.id_materia=plan_estudios.id 
						AND grupo.idGrupo=materias_carga_horaria.id_grupo  AND  materias_carga_horaria.id_carrera=carreras.id 
						AND  materias_carga_horaria.id_carrera='$id_carrera' and id_periodo='$id_periodo';";
				$result = $this->con->query($sql);
				$i = 0;
					
					$filaMateria="";

			while ($fila = $result->fetch_row()) {
						//echo"<tr class='odd gradeX'>";
						//echo" <td><b>";
						$NombreMateria[$i] = $fila[0];
						//echo"</td> <td>  </b>Grupo: ";
						$Grado[$i] = $fila[1]."°";
						//echo"°";
						$Grupo[$i] = $fila[2];
						//echo" </td> <td>";
						$turno[$i] = $fila[3];
						//echo" </td> <td> ";
			            $carrera[$i] = $fila[4];
						//echo"</td><td>";
						$horasAsig[$i] = $fila[5]." horas</br>";
						//echo"</td>";

						$filaMateria = $filaMateria.$NombreMateria[$i]." - ".$Grado[$i].$Grupo[$i]." ".$turno[$i]." - ".$horasAsig[$i];
            $i++;
        }
						echo $filaMateria;
  
    }

function ptcVSpa($id_periodo){
	$sql="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
	        and prf_datopersonales.prf_tipo = '2'
			AND id_periodo='$id_periodo';";

		$result = $this->con->query($sql);
		$fila = $result->fetch_row();

		$sql2="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
	        and prf_datopersonales.prf_tipo = '3'
			AND id_periodo='$id_periodo';";

		$result2 = $this->con->query($sql2);
		$fila2 = $result2->fetch_row();


		$sql3="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
		and prf_datopersonales.prf_tipo = '1'
			AND id_periodo='$id_periodo';";

		$result3 = $this->con->query($sql3);
		$fila3 = $result3->fetch_row();

		$sql4="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
		and prf_datopersonales.prf_tipo = '4'
			AND id_periodo='$id_periodo';";

		$result4 = $this->con->query($sql4);
		$fila4 = $result4->fetch_row();

		$sql5="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
		and prf_datopersonales.prf_tipo = '5'
			AND id_periodo='$id_periodo';";
		$result5 = $this->con->query($sql5);		
		$fila5 = $result5->fetch_row();


		echo "<table class='table table-bordered table-striped' >";
		echo "<tr><th>Horas de PTC</th><th>Horas de PA</th><th>Horas de Administrativos</th>";
		echo "<td>Directores Carrera</td><td>Jefes de Área</td></tr>";
		echo "<tr><td>".$fila[0]."</td><td>".$fila2[0]."</td><td>".$fila3[0]."</td>";
		echo "<td>".$fila4[0]."</td><td>".$fila5[0]."</td></tr>";
		echo "</table>";
}

function ptcVSpaporCarrera($carr,$abrevia, $id_periodo){
	$sql="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
		and id_carrera='$carr'
	        and prf_datopersonales.prf_tipo = '2'
			AND id_periodo='$id_periodo';";

		$result = $this->con->query($sql);
		$fila = $result->fetch_row();

		$sql2="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
		and id_carrera='$carr'
	        and prf_datopersonales.prf_tipo = '3'
			AND id_periodo='$id_periodo';";

		$result2 = $this->con->query($sql2);
		$fila2 = $result2->fetch_row();

		$sql3="SELECT SUM(horas_asignadas) horas
		FROM desglose_carga_horaria,prf_datopersonales 
		WHERE desglose_carga_horaria.id_docente=prf_datopersonales.id 
		and id_carrera='$carr'
	        and prf_datopersonales.prf_tipo = '1'
			AND id_periodo='$id_periodo';";

		$result3 = $this->con->query($sql3);
		$fila3 = $result3->fetch_row();
		
		echo "<tr><td>".$abrevia."</td><td>".$fila[0]."</td><td>".$fila2[0]."</td><td>".$fila3[0]."</td></tr>";
		
}


}	//fin de la clase Seani
?>
