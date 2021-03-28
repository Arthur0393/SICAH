<?php

//include('../Conectar.php');
require '../Conectar.php';
$bd = Db::getInstance();

class Seani {

    function Nregistro($username, $password, $email, $tipo_usuario, $fecha_hora_alta, $estatus, $foto) {
        $result = mysql_query("INSERT INTO 01_user (username,password,email,tipo_usuario,fecha_hora_alta,estatus,foto) 
  VALUES ('$username','$password','$email','$tipo_usuario','$fecha_hora_alta','$estatus','$foto')");

        if (!$result) {
//            $error = 'Invalid query: ' . mysql_error();
            if (mysql_errno() == 32) {
                $error = "El correo electronico ingresado ya esta registrado en nuestra base de datos.";
            } else {
                $error = mysql_error();
            }

// cosas
            echo $error;

            echo '<script type="text/javascript">';
            echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
            echo 'window.location.assign("../index.php");';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0, url=../index.php">';
            die('Invalid query: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Su Registro ha sido Correcto");';
            echo 'window.location.assign("../index.php");';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0, url=../index.php">';
        }
        return;
    }

    function FirstDatosPers($nombre, $ap_paterno, $ap_materno, $email, $ultima_actualizacion, $userId, $foto) {

        $result = mysql_query("INSERT INTO prf_datopersonales (nombre,ap_paterno,ap_materno,email,ultima_actualizacion,prf_tipo,user_id,foto) 
  VALUES ('$nombre','$ap_paterno','$ap_materno','$email','$ultima_actualizacion','1','$userId','$foto')");



        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
            echo 'window.location.assign("../index.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Gracias por registrarte");';
            echo 'window.location.assign("../index.php");';
            echo '</script>';
        }
        return;
    }

     function InsertarCargaHoraria($nombre, $ap_paterno, $ap_materno, $email, $ultima_actualizacion, $userId, $foto) {

        $result = mysql_query("INSERT INTO prf_datopersonales (nombre,ap_paterno,ap_materno,email,ultima_actualizacion,prf_tipo,user_id,foto) 
  VALUES ('$nombre','$ap_paterno','$ap_materno','$email','$ultima_actualizacion','1','$userId','$foto')");



        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
          //  echo 'window.location.assign("../index.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Gracias por registrarte");';
           // echo 'window.location.assign("../index.php");';
            echo '</script>';
        }
        return;
    }
    
         /////////////// Inicio Guardar Tutor //////////////////////
      function VerificaListaTutores($idDocente,$idGrupo,$actualizacion) {
        $sql = "SELECT * FROM tutores_grupo where tutores_grupo.id_grupo='$idGrupo';";
        $result = mysql_query($sql);
        $res = mysql_num_rows($result);

        if ($res > 0) {
//echo "Actualizar status";
  $ActualizarTutores = $this->UpdateTutor($idDocente,$idGrupo,$actualizacion);

        } else {

            $inserTutores = $this->InsertarTutores($idDocente,$idGrupo,$actualizacion);
//echo "no";
        }
    } 
    
    
    
    
    
      function InsertarTutores($idDocente,$idGrupo,$actualizacion) {

        $result = mysql_query("INSERT INTO tutores_grupo (id_docente, id_grupo,actualizacion) VALUES ('$idDocente','$idGrupo','$actualizacion');");
        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
 //echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
//            echo '<script type="text/javascript">';
//            echo 'alert("Tutores Guardado Con exito");';
////echo 'window.location.assign("AdminDirectorC.php");';
//            echo '</script>';
        }
        return;
    }
    
    
    function UpdateTutor($idDocente,$idGrupo) {
        $result = mysql_query("UPDATE tutores_grupo SET id_docente='$idDocente' WHERE id_grupo='$idGrupo';");

        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
    // echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
//            echo '<script type="text/javascript">';
//            echo 'alert("Actualizacion correcta");';
//  // echo 'window.location.assign("AdminDirectorC.php");';
//            echo '</script>';
        }
        return;
    }
    
      function SelecionarDocentesCargadoTutores($idgrupo) {
 $idgrupo;
        $sql = "SELECT prf_datopersonales.id, nombre,ap_paterno,ap_materno 
FROM tutores_grupo,prf_datopersonales
where prf_datopersonales.id=tutores_grupo.id_docente and  tutores_grupo.id_grupo='$idgrupo';";


        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
                
                             echo"  <option value='"; 
                                 echo $id[$i] = $fila[0]; 
                                   echo" ' style='color: #007E3A;'   > ";
                                                 echo $Nombre[$i] = $fila[1];
                             echo" "; 
                        echo $ApellidoPaterno[$i] = $fila[2];
                                  echo" "; 
                           echo $Nombre[$i] = $fila[3];
                             echo   "</option> ";                     
                   
          //  echo" </tr>     ";
            $i++;
        }

    }
    
    
    
    
    
    
      function SelecionarTodosDocentes($idGrupo) {

        $sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,
prf_datopersonales.ap_materno FROM prf_datopersonales where prf_tipo <=3 order by prf_datopersonales.ap_paterno asc ;";
        $result = mysql_query($sql);
        $i = 0;
          echo"  <select   name='tutor[]' data-placeholder='Selecciona un docente...' class='chzn-select' tabindex='2' >";
                     
       $nombreDocente=$this->SelecionarDocentesCargadoTutores($idGrupo);  
            
        while ($fila = mysql_fetch_row($result)) {
       
        
//                  echo"  <option value=''></option> "; 
              
                         echo"  <option value='"; 
                       
                          echo $id[$i] = $fila[0];
                                echo" '> ";
              
                     echo $Nombre[$i] = $fila[1];
                             echo" "; 
                        echo $ApellidoPaterno[$i] = $fila[2];
                                  echo" "; 
                           echo $Nombre[$i] = $fila[3];
                                                
                                          echo   "</option> "; 
                      
              
            
   
      
        
          //  echo" </tr>     ";
            $i++;
        }
             echo   "</select>   ";  
    }
    
    
   
    
    
    
    
     /////////////// Fin Guardar Tutor //////////////////////
    
    /////////////// Inicia Guardar Laboratorios//////////////////////
    
    
      function Labarotorios($idCarrera) {

        $sql = "SELECT nombre, edificio,horas_laboratorio,Idlaboratorios FROM laboratorios where id_carrera='$idCarrera';";
        $result = mysql_query($sql);
        $i = 0;
       
//        $variable = mysql_fetch_row($result);
//
//echo $variable[3]; // 42

           echo"     <form id='validation_demo' action='GuardaLab.php' method='post' > ";  
         echo"  <table class='table table-bordered table-striped  data_table3' >
             
                                                      <thead>
                                                          <tr>
                                                              <th>Nombre</th>
                                                              <th>Edificio</th>
                                                                       <th>Horas</th>
                                                                  <th>Encargado</th> 
                                                                                                                              </tr>
                                                      </thead>
                                                      <tbody align='center'>";
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";
       echo" <td>";
            echo $Nombre[$i] = $fila[0];
            echo" </td>";
               echo" <td>";
            echo $Edificio[$i] = $fila[1];
            echo" </td>";
                   echo" <td>";
            echo $Edificio[$i] = $fila[2];
            echo" </td>";
        
             echo" <td>";
             ///Select todos los docentes
                   $idLab[$i] = $fila[3];
              $docentes=$this->SelecionarTodosDocentesLab($idLab[$i]);
       
           echo" <input type='hidden' value='$idLab[$i]' name='idLaaboratorio[]' />";
               echo" <input type='hidden' value='$Nombre[$i]' name='nombrel[]' />";
                 echo" </td>";
             
              
        
             echo"    ";
            $i++;
        }
        
               echo"   ";
    }
    
    
    
       function SelecionarTodosDocentesLab($idLab) {

        $sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,
prf_datopersonales.ap_materno FROM prf_datopersonales where prf_tipo <=3 order by prf_datopersonales.ap_paterno asc ;";
        $result = mysql_query($sql);
        $i = 0;
          echo"  <select   name='reslab[]' data-placeholder='Selecciona al Responsable...' class='chzn-select' tabindex='2' >";
                     

              $nombreDocente=$this->SelecionarDocentesResLab($idLab);  
        while ($fila = mysql_fetch_row($result)) {
       
             
                  echo"  <option value=''></option> "; 
              
                         echo"  <option value='"; 
                       
                          echo $id[$i] = $fila[0];
                                echo" '> ";
              
                     echo $Nombre[$i] = $fila[1];
                             echo" "; 
                        echo $ApellidoPaterno[$i] = $fila[2];
                                  echo" "; 
                           echo $Nombre[$i] = $fila[3];
                                                
                                          echo   "</option> "; 
                      
              
            
   
      
        
          //  echo" </tr>     ";
            $i++;
        }
             echo   "</select>   ";  
    }
    
    
    function SelecionarDocentesResLab($id_laboratorios) {

        $sql = "SELECT prf_datopersonales.id, nombre,ap_paterno,ap_materno 
FROM  resp_laboratorios,prf_datopersonales
where prf_datopersonales.id=resp_laboratorios.id_docente and  resp_laboratorios.id_laboratorios='$id_laboratorios'; ";


        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
                      
                             echo"  <option value='"; 
                                 echo $id[$i] = $fila[0]; 
                                   echo" ' style='color: #007E3A;'   > ";
                                                 echo $Nombre[$i] = $fila[1];
                             echo" "; 
                        echo $ApellidoPaterno[$i] = $fila[2];
                                  echo" "; 
                           echo $Nombre[$i] = $fila[3];
                             echo   "</option> ";                     
                   
          //  echo" </tr>     ";
            $i++;
        }

    }
    
  function InsDesgloseCarhora($id_periodo, $id_docente, $id_concepto, $id_carrera, $actualizacion, $horas_asignadas,$descripcion) {
   $result = mysql_query("INSERT INTO desglose_carga_horaria (id_periodo, id_docente, id_concepto, id_carrera, actualizacion, horas_asignadas,descripcion) VALUES ('$id_periodo', '$id_docente', '$id_concepto', '$id_carrera', '$actualizacion', '$horas_asignadas','$descripcion');");



        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
            //echo 'window.location.assign("../AdminDirectorC.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
//            echo '<script type="text/javascript">';
//            echo 'alert("Gracias por registrarte");';
//          //  echo 'window.location.assign("../AdminDirectorC.php");';
//            echo '</script>';
        }
        return;
    }
    
    
    
    
    
    
       function VerificaResLab($idDocente,$id_laboratorios,$actualizacion) {
        $sql = "SELECT * FROM resp_laboratorios  WHERE id_laboratorios='$id_laboratorios';";
        $result = mysql_query($sql);
        $res = mysql_num_rows($result);

        if ($res > 0) {
//echo "Actualizar status";
  $ActualizarResLab = $this->UpdateLab($idDocente,$id_laboratorios,$actualizacion);

        } else {

            $InsertarResLab = $this->InsertarResLab($idDocente,$id_laboratorios,$actualizacion);
//echo "no";
        }
    } 
    
    
    
    
    
      function InsertarResLab($idDocente,$id_laboratorios,$actualizacion) {




        $result = mysql_query("INSERT INTO resp_laboratorios "
                . "(id_docente,id_laboratorios,actualizacion) VALUES ('$idDocente','$id_laboratorios','$actualizacion');");
        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Error en la capturazzzz de tu registro intenta nuevamente' . $error . '");';
  echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">';
            echo 'alert(" Responsable de Laboratorio Guardado Con exito");';
echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
        }
        return;
    }
    
    
    function UpdateLab($idDocente,$id_laboratorios,$actualizacion) {



        $result = mysql_query("UPDATE resp_laboratorios SET id_docente='$idDocente' , actualizacion='$actualizacion' WHERE idresp_laboratorios='$id_laboratorios';");

        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
     echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Actualizacion correcta");';
  echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
        }
        return;
    }
       
        /////////////// Fin Guardar Laboratorios//////////////////////
		
		
		
		///inicia Carga materias
      function GruposPorCarrer($idCarrera) {

        $sql = "SELECT cuatrimestre,grupo, carrera,idGrupo FROM grupo where carrera='$idCarrera' and periodo_escolar=3;";
        $result = mysql_query($sql);
        $i = 0;
           echo"     <form id='validation_demo' action='GuardaTutores.php' method='post' > ";  
         echo"  <table class='table table-bordered table-striped  data_table3' >        <thead>       <tr> <th>Grupo y Tutor</th>   <th>Carga Academica</th>    </tr>     </thead>
                                                      <tbody align='center'>";                               
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";
       echo" <td style='color: #007E3A; font-weight: bold;font-size : 13pt'>";
            echo $cuatrimestre[$i] = $fila[0]; 
            echo "°";
        echo $grupo[$i] = $fila[1];
         $idGrupo[$i] = $fila[3];
          $ngrupo=$cuatrimestre[$i] ."°".$grupo[$i] ;
          echo" <input type='hidden' value='$idGrupo[$i]' name='grupoTutor[]' />";
                 echo" <input type='hidden' value='$ngrupo' name='ngrupo[]' />";
          
        $docentes=$this->SelecionarTodosDocentes($idGrupo[$i]);
         //$docentes=$this-> SelecionarDocentesCargadoTutores($idGrupo[$i]);
            
      
            echo" </td>";
                       // $idGrupo[$i] = $fila[3];
       
              echo" <td >"; 
                             //    echo   $idGrupo[$i];
                echo $materis=$this->MateriasDocenteGrupo($idCarrera,$cuatrimestre[$i],$idGrupo[$i],$idmateria[$i] );  
                     echo" </td>";
  
           
            $i++;
        }
        
                       echo"   </tbody>
                                                </table>";
    }
    
 
     function MateriasDocenteGrupo($id,$semestre,$idGrupo,$idmateria) {

        $sql = "SELECT nombre_materia,id,horas_por_semana,h_asesorias,carrera_fk FROM plan_estudios where carrera_fk='$id' and semestre='$semestre';";
        $result = mysql_query($sql);
        $i = 0;

    echo"  <table class='table table-bordered table-striped' > <thead>   <tr>   <th>Nombre</th>    <th>Horas Por Semana</th>           <th>Docente</th>       </tr>  </thead>         <tbody align='center'>";
        while ($fila = mysql_fetch_row($result)) {
          echo"<tr class='odd gradeX'>";
       echo" <td>";
            echo $nombre[$i] = $fila[0];
                          
            echo" </td>";
              echo" <td>";
             echo $hporSemana[$i] = $fila[2]; 
            $idmateria= $fila[1];
             
                     echo" </td>";
                             echo" <td>";
                                $id_carrera[$i] = $fila[4]; 
                                 $idMaterias[$i] = $fila[1]; 
                                 $nombre_materia= $fila[0];
                                $horas_por_semana= $fila[2];
            echo" <input type='hidden' value='$nombre[$i]' name='nombre_materia[]' />";    
                echo" <input type='hidden' value='$hporSemana[$i]' name='horas_por_semana[]' />";                       
                                
echo"  <select data-placeholder='Selecciona un docente...' class='chzn-select' tabindex='2' name='idDocente[]' >";
                   echo" GRUPO-";
                                    ECHO $idGrupo;
                                     echo" MATERIA-";
                                          ECHO     $idmateria;
$DocentesCargadosMaterias=$this->SelecionarDocentesCargadoMaterias($idGrupo,$idmateria); 
 $des=$this->MateriasImpartidasDocentesCargarHoraria($idGrupo,$idmateria);
     echo"RRR";
        
    echo   "</select>   ";  
     echo" <input type='hidden' value='$id_carrera[$i]' name='id_carrera[]' />";
       echo" <input type='hidden' value='$idMaterias[$i]' name='idMaterias[]' />";
         echo" <input type='hidden' value='$idGrupo' name='idGrupoM[]' />";    
               
              echo" </td>";
                          
  
        echo" </tr>     ";
            $i++;
        }
        
              echo"   </tbody>
                                                </table>";
              
                
    } 


 function MateriasImpartidasDocentesCargarHoraria($idgrupo,$idmateria) {

        $sql = "SELECT prf_datopersonales.id, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno,plan_estudios.nombre_materia,matriz_docente.id_materias 
FROM matriz_docente, plan_estudios,prf_datopersonales
where plan_estudios.id= matriz_docente.id_materias and matriz_docente.id_materias='$idmateria' and prf_datopersonales.user_id= matriz_docente.id_docentes order by ap_paterno ;";
        $result = mysql_query($sql);
        $i = 0;
       
                    
      echo"<option value=''></option>"; 
              echo"** "; 
      ECHO $idgrupo;
             echo"// "; 
         ECHO    $idmaterias;
 
                   

        while ($fila = mysql_fetch_row($result)) {
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
where prf_datopersonales.id=materias_carga_horaria.id_docente 
and  materias_carga_horaria.id_grupo='$idgrupo' and  materias_carga_horaria.id_materia='$idmaterias';";


        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
                
                             echo"  <option value='"; 
                                 echo $id[$i] = $fila[0]; 
                                   echo" ' style='color: #007E3A;'   > ";
                                                 echo $Nombre[$i] = $fila[1];
                             echo" "; 
                        echo $ApellidoPaterno[$i] = $fila[2];
                                  echo" "; 
                           echo $Nombre[$i] = $fila[3];
                             echo   "</option> ";                     
                   
          //  echo" </tr>     ";
            $i++;
        }

    }
    
	///Fin Carga materias














		
    
    function obteneIdusuario($username) {
        $sql = "SELECT id FROM 01_user where username='$username';";
        $result = mysql_query($sql);
        $userId = mysql_fetch_row($result);
        return $userId[0];
    }

    function obteneFotousuario($id) {
        $sql = "SELECT foto FROM prf_datopersonales where user_id='$id';";
        $result = mysql_query($sql);
        $userId = mysql_fetch_row($result);
        return $userId[0];
    }

    function obtenerDatosPersonales($id) {

        $resul = mysql_query("SELECT id,ultima_actualizacion,nombre,ap_paterno,ap_materno,email,genero FROM prf_datopersonales where user_id='$id';");
        $resul = mysql_fetch_array($resul);
        return $resul;
    }

    function SecondDatosPersonales($id, $fecha_incorporacion, $tel_personal, $fecha_nacimiento, $genero, $curp, $rfc, $n_empleado, $direcion, $localidad, $municipio, $estado, $cp, $foto, $ultima_actualizacion, $prf_titulo, $prf_tipo) {
        $result = mysql_query("UPDATE prf_datopersonales SET  fecha_incorporacion='$fecha_incorporacion', tel_personal='$tel_personal', fecha_nacimiento='$fecha_nacimiento', genero='$genero', curp='$curp', rfc='$rfc', n_empleado='$n_empleado', direcion='$direcion', localidad='$localidad', municipio='$municipio', estado='$estado', cp='$cp', foto='$foto' , ultima_actualizacion='$ultima_actualizacion', prf_titulo='$prf_titulo',prf_tipo='$prf_tipo' where user_id='$id'");




        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
            echo 'window.location.assign("../profesor/profile.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Actualizacion correcta");';
            echo 'window.location.assign("../profesor/profile.php");';
            echo '</script>';
        }
        return;
    }

    function obteneEstatusMateria($idDocente, $id_materia, $semestre) {
        $sql = "SELECT estatus FROM matriz_docente,plan_estudios 
where  plan_estudios.id=id_materias and matriz_docente.id_docentes='$idDocente' and matriz_docente.id_materias='$id_materia'and plan_estudios.semestre='$semestre' group by plan_estudios.id";
        $result = mysql_query($sql);
// $userId=mysql_fetch_row($result);
// return $userId[0];
        $i = 0;

        while ($fila = mysql_fetch_row($result)) {
            $estatus[$i] = $fila[0];
            if ($estatus[$i] == 1) {
                echo "checked ";
            } else {
                echo " ";
            }

            $i++;
        }
    }

    function obteneLicenciautura($id) {

//           $sql = "SELECT nombre as grado FROM siseac.prf_titulo;";
        $resul = mysql_query("select prf_titulo.id as id,prf_titulo.nombre as grado from prf_datopersonales, prf_titulo 
where prf_datopersonales.prf_titulo=prf_titulo.id and prf_datopersonales.user_id='$id';");
        $resul = mysql_fetch_array($resul);
        return $resul;
    }

    function obtenerPuesto($id) {

//           $sql = "SELECT nombre as grado FROM siseac.prf_titulo;";
        $resul = mysql_query("select prf_tipo.id as id,prf_tipo.abreviatura as tipo from prf_datopersonales, prf_tipo 
where prf_datopersonales.prf_tipo=prf_tipo.id and prf_datopersonales.user_id='$id';");
        $resul = mysql_fetch_array($resul);
        return $resul;
    }

    function obtenerGeneroEstado($id) {

//           $sql = "SELECT nombre as grado FROM siseac.prf_titulo;";
        $resul = mysql_query("SELECT genero, estado FROM prf_datopersonales where user_id='$id';");
        $resul = mysql_fetch_array($resul);
        return $resul;
    }

    function InsertMatrizCompetencias($id, $estatus, $idusuario, $idmateria, $fecha) {

        $result = mysql_query("INSERT INTO matriz_docente(id ,estatus, id_docentes, id_materias, fecha_actualizacion) VALUES ('$id','$estatus','$idusuario','$idmateria','$fecha');");

        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
//            echo 'window.location.assign("../index.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
//            echo '<script type="text/javascript">';
//            echo 'alert("Gracias por registrarte");';
////            echo 'window.location.assign("../index.php");';
//            echo '</script>';
        }
        return;
    }

    function obteneMatrizCompetenciaActual($id, $estatus, $idusuario, $idmateria, $fecha) {
        $sql = "SELECT  * FROM matriz_docente
where   matriz_docente.id_docentes='$idusuario' and matriz_docente.id_materias='$idmateria'";
        $result = mysql_query($sql);
        $res = mysql_num_rows($result);

        if ($res > 0) {
//echo "Actualizar status";
        } else {

            $inserMTC = $this->InsertMatrizCompetencias($id, $estatus, $idusuario, $idmateria, $fecha);
//echo "no";
        }
    }

    function ObtenerDatosDocentes() {

        $sql = "SELECT n_empleado,prf_titulo,nombre,ap_paterno,ap_materno,genero,email,prf_tipo,estado,municipio,fecha_incorporacion,ultima_actualizacion,id,user_id FROM prf_datopersonales order by user_id asc;";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
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
            } else if ($grado[$i] == 2) {
                echo "Ingeniero ";
            } else if ($grado[$i] == 3) {
                echo "Especialidad ";
            } else if ($grado[$i] == 4) {
                echo "Especialida Medica ";
            } else if ($grado[$i] == 6) {
                echo "Maestria ";
            }else if ($grado[$i] == 8) {
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
            } else if ($Puesto[$i] == 2) {
                echo "Profesor Tiempo Completo ";
            } else if ($Puesto[$i] == 3) {
                echo "Profesor por Asignatura ";
            } else if ($Puesto[$i] == 4) {
                echo "Director de Área ";
            } else if ($Puesto[$i] == 5) {
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

    
     function ObtenerDatosCargahoraria() {

        $sql = "SELECT id_docente,prf_datopersonales.n_empleado , prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno ,
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
 SUM(CASE WHEN id_concepto >=0 THEN horas_asignadas ELSE 0 END) difusion,
user_id,prf_tipo,prf_titulo
FROM desglose_carga_horaria,prf_datopersonales 
where desglose_carga_horaria.id_docente=prf_datopersonales.id
group by id_docente ;";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
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


            echo"<td> ";
            echo $Nombre[$i] = $fila[2];
            echo" </td>";
            echo" <td >";
            echo $ApellidoPaterno[$i] = $fila[3];
            echo" </td >";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[4];
            echo" </td>";
              echo" <td>";
            $Puesto[$i] = $fila[20];
                         if ($Puesto[$i] == 1) {
                echo "Administrativo ";
            } else if ($Puesto[$i] == 2) {
                echo "Profesor Tiempo Completo ";
            } else if ($Puesto[$i] == 3) {
                echo "Profesor por Asignatura ";
            } else if ($Puesto[$i] == 4) {
                echo "Director de Área ";
            } else if ($Puesto[$i] == 5) {
                echo "Director de Carrera ";
            }
            echo" </td>";
                 echo" <td>";
         $grado[$i] = $fila[21];
              if ($grado[$i] == 1) {
                echo "Licenciado";
            } else if ($grado[$i] == 2) {
                echo "Ingeniero ";
            } else if ($grado[$i] == 3) {
                echo "Especialidad ";
            } else if ($grado[$i] == 4) {
                echo "Especialida Medica ";
            } else if ($grado[$i] == 6) {
                echo "Maestria ";
            }else if ($grado[$i] == 8) {
                           echo "Doctorado ";
            }

            echo" </td>";

//            echo" <td>";
//            echo $hsemagrupo[$i] = $fila[5];
//            echo" </td>";
            echo" <td>";
            echo $frentegrupo[$i] = $fila[6];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[7];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[8];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[9];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[10];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[11];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[12];
                       echo" </td>"; 
                       echo" <td>";
            echo $frentegrupo[$i] = $fila[13];
                       echo" </td>"; 
                       echo" <td>";
            echo $frentegrupo[$i] = $fila[14];
                       echo" </td>";

      echo" <td>";
            echo $frentegrupo[$i] = $fila[15];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[16];
                       echo" </td>";
                        echo" <td>";
            echo $frentegrupo[$i] = $fila[17];
                       echo" </td>";
                         echo" <td style='color: #007E3A; font-weight: bold;font-size : 12pt'>";
            echo $frentegrupo[$i] = $fila[18];
                       echo" </td>";
                 

                    echo" </tr>     ";
            $i++;
        }
    }  

    
    
    
     function ObtenerDatosCargahoraria2() {

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
where desglose_carga_horaria.id_docente=prf_datopersonales.id
group by id_docente ;";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
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


            echo"<td> ";
            echo $Nombre[$i] = $fila[2];
            echo" </td>";
            echo" <td >";
            echo $ApellidoPaterno[$i] = $fila[3];
            echo" </td >";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[4];
            echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[5];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[6];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[7]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[8];      echo" </td>";
                     
                echo" <td>";     echo $frentegrupo[$i] = $fila[9];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[10];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[11]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[12];      echo" </td>";
                      
                echo" <td>";     echo $frentegrupo[$i] = $fila[13];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[14];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[15]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[16];      echo" </td>";         
          
                        echo" <td>";     echo $frentegrupo[$i] = $fila[17];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[18];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[19]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[20];      echo" </td>";   
                   
                  echo" <td>";     echo $frentegrupo[$i] = $fila[21];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[22];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[23]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[24];      echo" </td>";  
                   
                       echo" <td>";     echo $frentegrupo[$i] = $fila[25];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[26];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[27]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[28];      echo" </td>";  
                   
                         echo" <td>";     echo $frentegrupo[$i] = $fila[29];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[30];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[31]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[32];      echo" </td>";  
                   
                    echo" <td>";     echo $frentegrupo[$i] = $fila[33];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[34];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[35]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[36];      echo" </td>";  
                   
                         echo" <td>";     echo $frentegrupo[$i] = $fila[37];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[38];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[39]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[40];      echo" </td>";  
                       
                      echo" <td>";     echo $frentegrupo[$i] = $fila[41];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[42];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[43]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[44];      echo" </td>";  
                   
                       echo" <td>";     echo $frentegrupo[$i] = $fila[45];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[46];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[47]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[48];      echo" </td>";  
                   
                           echo" <td>";     echo $frentegrupo[$i] = $fila[49];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[50];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[51]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[52];      echo" </td>";  
                   
                           echo" <td>";     echo $frentegrupo[$i] = $fila[53];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[54];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[55]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[56];      echo" </td>";  
                   
                           echo" <td>";     echo $frentegrupo[$i] = $fila[57];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[58];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[59]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[60];      echo" </td>";  
                 

                    echo" </tr>     ";
            $i++;
        }
    }  

     function ObtenerDatosCargahoraria3() {

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
where desglose_carga_horaria.id_docente=prf_datopersonales.id
group by id_docente ;";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
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


            echo"<td> ";
            echo $Nombre[$i] = $fila[2];
            echo" </td>";
            echo" <td >";
            echo $ApellidoPaterno[$i] = $fila[3];
            echo" </td >";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[4];
            echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[5];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[6];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[7]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[8];      echo" </td>";
                     
                echo" <td>";     echo $frentegrupo[$i] = $fila[9];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[10];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[11]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[12];      echo" </td>";
                      
                echo" <td>";     echo $frentegrupo[$i] = $fila[13];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[14];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[15]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[16];      echo" </td>";         
          
                        echo" <td>";     echo $frentegrupo[$i] = $fila[17];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[18];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[19]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[20];      echo" </td>";   
                   
                  echo" <td>";     echo $frentegrupo[$i] = $fila[21];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[22];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[23]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[24];      echo" </td>";  
                   
                       echo" <td>";     echo $frentegrupo[$i] = $fila[25];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[26];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[27]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[28];      echo" </td>";  
                   
                        
                 

                    echo" </tr>     ";
            $i++;
        }
    }  

     function ObtenerDatosCargahoraria4() {

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
where desglose_carga_horaria.id_docente=prf_datopersonales.id
group by id_docente ;";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
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


            echo"<td> ";
            echo $Nombre[$i] = $fila[2];
            echo" </td>";
            echo" <td >";
            echo $ApellidoPaterno[$i] = $fila[3];
            echo" </td >";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[4];
            echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[5];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[6];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[7]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[8];      echo" </td>";
                     
                echo" <td>";     echo $frentegrupo[$i] = $fila[9];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[10];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[11]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[12];      echo" </td>";
                      
                echo" <td>";     echo $frentegrupo[$i] = $fila[13];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[14];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[15]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[16];      echo" </td>";         
          
                        echo" <td>";     echo $frentegrupo[$i] = $fila[17];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[18];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[19]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[20];      echo" </td>";   
                   
                  echo" <td>";     echo $frentegrupo[$i] = $fila[21];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[22];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[23]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[24];      echo" </td>";  
                   
                       echo" <td>";     echo $frentegrupo[$i] = $fila[25];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[26];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[27]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[28];      echo" </td>";  
                   
                         echo" <td>";     echo $frentegrupo[$i] = $fila[29];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[30];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[31]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[32];      echo" </td>";  
                   
                    echo" <td>";     echo $frentegrupo[$i] = $fila[33];  echo" </td>";
                               echo" <td>"; echo $frentegrupo[$i] = $fila[34];  echo" </td>";
              echo" <td>"; echo $frentegrupo[$i] = $fila[35]; echo" </td>";
                   echo" <td>";     echo $frentegrupo[$i] = $fila[36];      echo" </td>";  
                   
                        

                    echo" </tr>     ";
            $i++;
        }
    }  

     
    
    
    function ObtenerPlandeEstudio() {

        $sql = "SELECT id, nombre_materia,documento_url, semestre, carrera, h_frente_grupo,h_asesorias,nivel  from plan_estudios ORDER BY carrera asc;";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";

            echo" <td>";
                      echo"<a href='MateriasPorDocentes.php?idMaterias=";
                        echo $id[$i] = $fila[0];
            echo "'>";
                     echo $id[$i] = $fila[0];
                 echo"</a>";
            echo" </td>";
            echo" <td>";
            echo"<a href='";    echo $url[$i] = $fila[2];    echo "'>";    echo $nombreMateria[$i] = $fila[1];       echo"</a>";
        
        
        
     



            echo" </td>";
       echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[3];
            echo" </td>";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[4];
            echo" </td>";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[5];
            echo" </td>";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[6];
            echo" </td>";
             echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[7];
            echo" </td>";
            echo" </tr>     ";
            $i++;
        }
    }
    
    
     function MateriasImpartidasDocentes($id) {

        $sql = "SELECT prf_datopersonales.n_empleado, prf_datopersonales.nombre, prf_datopersonales.ap_paterno,prf_datopersonales.ap_materno,plan_estudios.nombre_materia
FROM matriz_docente, plan_estudios,prf_datopersonales
where plan_estudios.id= matriz_docente.id_materias and matriz_docente.id_materias='$id' and prf_datopersonales.user_id= matriz_docente.id_docentes ;";
        $result = mysql_query($sql);
        $i = 0;
       
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";

         
            
            
            
            
       echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[0];
            echo" </td>";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[1];
            echo" </td>";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[2];
            echo" </td>";
            echo" <td>";
            echo $ApellidoMaterno[$i] = $fila[3];
            echo" </td>";
        
            echo" </tr>     ";
            $i++;
        }
    }
    
    
    
    
    
       
     
 
    
    
    
    
    
    
      function CarreraPorDirector($idDirector) {

        $sql = "SELECT carreras.id, carreras.nombre, carreras.nivel,carreras.abreviatura  FROM director_carrera, 01_user,carreras
 where  01_user.id=director_carrera.user_ide and 01_user.id='$idDirector' and carreras.id=director_carrera.carrera;";
        $result = mysql_query($sql);
        $i = 0;
         echo"  <table class='table table-bordered table-striped  data_table3' >
             
                                                      <thead>
                                                          <tr>
                                                                                                                         <th>Nombre</th>
                                                            <th>Nivel</th>
                                                              <th>Abreviaturas</th> 
                                                              <th> Asignación  Resp. Labs.</th>
                                                                 <th> Carga Academica</th>
                                                                      <th>Carga Estadias</th>
                                                               
                                                          </tr>
                                                      </thead>
                                                      <tbody align='left'>";
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";
//       echo" <td>";
//            echo $id[$i] = $fila[0];
//            echo" </td>";
            echo" <td style='color: #007E3A; font-weight: bold;font-size : 10pt'> ";
                                      echo $nombre[$i] = $fila[1];
            echo" </td>";
            echo" <td>";
            echo $Nivel[$i] = $fila[2];
            echo" </td>";
               echo" <td>";
            echo $abreviatura[$i] = $fila[3];
            echo" </td>";
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
                            echo" <td>";
                         $idCarrer[$i] = $fila[0];
                             $abreviatura[$i] = $fila[3];
                    echo"<a href='CargarLaboratorios.php?idCarre=$idCarrer[$i]&abrevi=$abreviatura[$i]'>";
                     echo" <img src='images/icon/color_18/spreadsheet.png' border='0' alt='OK'></a> ";
                                               //falta un if que verifique el estatus*******
                       echo" </td>";
                       
             echo" </tr>     ";
            $i++;
        }
        
               echo"   </tbody>
                                                  </table>";
    }
    
    
    
        function MateriasporGrupo($abreviatura,$semestre) {

        $sql = "SELECT nombre_materia,semestre,carrera,h_frente_grupo,h_asesorias FROM plan_estudios where Carrera='$abreviatura' and semestre=$semestre;";
        $result = mysql_query($sql);
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
        while ($fila = mysql_fetch_row($result)) {
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
        
//               echo"   </tbody>
//                                                  </table>";
    } 
    
    
    ///////Inicia Metodos Materia----------------
 
       
    
    ////////////Inicia Alta materias Carga
    
      function VerificaMateCarga($idDocente,$id_materia,$actualizacion,$id_carrera,$id_periodo,$id_grupo) {
        $sql = "SELECT * FROM materias_carga_horaria where id_grupo='$id_grupo' and id_materia='$id_materia';";
        $result = mysql_query($sql);
  $res = mysql_num_rows($result);

        if ($res > 0) {
//echo "Actualizar status";
  $ActualizarCargaHoraria= $this->UpdaMateriasCargaHoraria($idDocente,$idmaterias,$actualizacion);

        } else {

            $InsertarMateriasCargaHoraria = $this->InsertarMateriasCargaHoraria($id_carrera,$id_periodo,$id_materia,$idDocente,$id_grupo,$actualizacion);
//echo "no";
        }
    } 
    
    
    
    
    
      function InsertarMateriasCargaHoraria($id_carrera,$id_periodo,$id_materia,$id_docente, $id_grupo,$actualizacion) {



 $result = mysql_query("INSERT INTO  materias_carga_horaria (id_carrera, id_periodo, id_materia, id_docente, id_grupo,actualizacion) VALUES ('$id_carrera','$id_periodo','$id_materia','$id_docente', '$id_grupo','$actualizacion');");
        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            //echo 'alert("Error en la captura de tu registro intenta nuevamente' . $error . '");';
 echo 'window.location.assign("AdminDirectorC.php");';
           echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
//            echo '<script type="text/javascript">';
//            echo 'alert("Materias Guardado Con exito");';
//// echo 'window.location.assign("AdminDirectorC.php");';
//            echo '</script>';
        }
        return;
    }
    
    
    function UpdaMateriasCargaHoraria($idDocente,$idmaterias,$actualizacion) {




        $result = mysql_query("UPDATE materias_carga_horaria SET  id_docente='$idDocente', actualizacion='$actualizacion' WHERE idmaterias_carga_horaria='$idmaterias';");

        if (!$result) {
            $error = 'Invalid query: ' . mysql_error();
            echo '<script type="text/javascript">';
            echo 'alert("Ocurrio un error intenta nuevamente' . $error . '");';
     // echo 'window.location.assign("AdminDirectorC.php");';
            echo '</script>';
            die('Invalid query: ' . mysql_error());
        } else {
//            echo '<script type="text/javascript">';
//            echo 'alert("Actualizacion correcta Materias");';
//   //echo 'window.location.assign("AdminDirectorC.php");';
//            echo '</script>';
        }
        return;
    }
    

    
    
    ///Fin Altas Materias Carga
    
    
    
    
    
   
    
    
    

    function ObtenerMatrizPorDocente($id) {

        $sql = "select plan_estudios.nombre_materia,semestre,Carrera from prf_datopersonales, matriz_docente,plan_estudios
Where id_docentes=prf_datopersonales.user_id and plan_estudios.id=matriz_docente.id_materias 
and prf_datopersonales.id='$id';";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";

            echo" <td > ";
            echo $nombreMateria[$i] = $fila[0];
            echo" </td>";
            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[1];
            echo" </td>";

            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[2];
            echo" </td>";

            echo" </tr>     ";
            $i++;
        }
    }
    
    
    
    
       function ObtenerGradorAcademico($id) {

        $sql = "SELECT  gradoA,escuela,cedula,periodo 
FROM  grado_academico  where user_ide='$id';";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";

            echo" <td > ";
            echo $nombreMateria[$i] = $fila[0];
            echo" </td>";
            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[1];
            echo" </td>";

            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[2];
            echo" </td>";

            echo" </tr>     ";
            $i++;
        }
    }
    
    
     function ObtenerCarrerraAcademica($id) {

        $sql = "SELECT actividad,institucion,periodo 
FROM carrera_academica where user_id_ca='$id';";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";

            echo" <td > ";
            echo $nombreMateria[$i] = $fila[0];
            echo" </td>";
            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[1];
            echo" </td>";

            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[2];
            echo" </td>";

            echo" </tr>     ";
            $i++;
        }
    }
    
    
        function ObtenerMateriasImpartidas($id) {

        $sql = "SELECT nombre, semestre_equivalente,no_veces,periodo 
FROM materias_imp where user_id_mi='$id';";
        $result = mysql_query($sql);
        $i = 0;
        while ($fila = mysql_fetch_row($result)) {
            echo"<tr class='odd gradeX'>";

            echo" <td > ";
            echo $nombreMateria[$i] = $fila[0];
            echo" </td>";
            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[1];
            echo" </td>";

            echo" <td class='center'> ";
            echo $semestre[$i] = $fila[2];
            echo" </td>";
                 echo" <td class='center'> ";
            echo $periodo[$i] = $fila[3];
            echo" </td>";

            echo" </tr>     ";
            $i++;
        }
    }

}

?>
