function MateriasPorDoceCH($id_docente) {
				$sql = "SELECT plan_estudios.nombre_materia, grupo.grado,grupo.grupo,grupo.turno, carreras.abreviatura, plan_estudios.horas_por_semana 
				FROM materias_carga_horaria,plan_estudios,grupo,carreras 
				WHERE id_docente='$id_docente' 	AND materias_carga_horaria.id_materia=plan_estudios.id AND grupo.idGrupo=materias_carga_horaria.id_grupo 
				AND  materias_carga_horaria.id_carrera=carreras.id and id_periodo='5';";
				$result = mysql_query($sql);
				$i = 0;
						echo ' <h3>MATERIAS QUE IMPARTE</h3>';
						echo"  <table class='table table-bordered table-striped  data_table3' >
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
        while ($fila = mysql_fetch_row($result)) {
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
						echo"   </tbody>
                                </table>";
  
    }
