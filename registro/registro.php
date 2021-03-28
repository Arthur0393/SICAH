
<!DOCTYPE html >
<html lang ="es">
<head>
	<meta charset="utf-8" />
    <title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="imagen/favicon.ico" rel="shortcut icon" type="image/x-icon" />  
</head>


<body>

	<header>
      <div class="logotlaxcala">
                    <img src="imagen/logoestado.png"  alt="Logo" width="157" height="63" />
      </div>
		<div class="content-wrapper">
                    <p class="site-title"> Primer Congreso Internacional Academia Journals de Educación Superior Tecnológica Pública</p>
		</div>
             <!--       
		<div class="logoutt">
          			<img src="imagen/logoutt.png" alt="" width="140" height="73" />
		</div>
        -->
	</header>      
        
        <div id='cssmenu'>
            <ul>
                <li><a href="index.php"><span>Inicio</span></a> </li>
                
               
          </ul>
</div>




        <div>
            <div class="box round first">
                <h3 align="left"> Los campos marcados con * son opcionales</h3>
                <div class="block">
                    	
	<div align="center" >





















	<form name="registro" action="guardaregistro.php" method="post">


	<TABLE width="711" > 
	    <TR> 
	        <TD> </TD> 
	        <TD> <p>Nombre:
  <input type="text" name="Nombre" placeholder="Nombre(s)" required>
	          </p>
	          <p>Apellido 
	          :
  <input type="text" name="Paterno" placeholder="Apellido Paterno" required>
	            </p> 
			</TD> 
			<TD>  </TD> 
			<TD> <p>Apellido Materno:
  <input type="text" name="Materno" placeholder="Apellido Materno"required>
			  </p>
			  <p>Edad:
			    <input type="number" name="edad" placeholder="edad" min="18" max="85" required>
			    </p> 
			</TD>
		</TR> 
		<TR>
	        <TD> </TD> 
	        <TD>Correo: <input type="email" name="correo" size=40 maxlength=40 placeholder="ejemplo@dominio.com" required>
				*Celular: 
				  <input type="text" name="Celular" placeholder=" Ej. 247-112-2034">
			</TD>  
			<TD>  </TD> 
			<TD> 	<p>Fecha participación:
			    <select name="participacion" size="1">
			    <option value="16" selected>16/03/2016</option>
			    <option value="17">17/03/2016</option>
			    <option value="18">18/03/2016</option>
			    </select>
			  </p>
			  <p>Perfil deseable PRODEP: 
			    <select name="prodep" size="1">
			      <option value="1" selected>Si</option>
			      <option value="0">No</option>
			      </select>
			  </p></TD>
		</TR> 
		<TR>
			<TD> </TD> 
			<TD> <p>Institución:
			  <select name="Institucion" size="1">
			    <option value="ITA" selected>ITA</option>
			    <option value="ITAT">ITAT</option>
			    <option value="ITST">ITST</option>
			    <option value="UPT">UPT</option>
			    <option value="UPTREP">UPTREP</option>
			    <option value="UTT">UTT</option>
			    <option value="OTRA">OTRA</option>
			    </select>
			  </p>
			  <p>Grado:
  <select name="Grado" size="1">
    <option value="Licenciatura" selected>Licenciatura</option>
    <option value="Maestria">Maestría</option>
    <option value="Doctorado">Doctorado</option>
  </select>
			    </p>
			</TD> 
			<TD> </TD> 
			<TD> Línea de Investigación: <input type="text" name="Investigacion" placeholder="Linea de investigación" required>
				Cuerpo Académico: <input type="text" name="CuerpoAcademico" placeholder="Nombre del cuerpo Academico" required>
			</TD> 
		</TR> 
		<TR>
			<TD> </TD> 
			<TD> 	<p>Nivel CONACYT:
			  <select name="conacyt" size="1">
			    <option value="Nivel I" selected>Nivel I</option>
			    <option value="Nivel II">Nivel II</option>
			    <option value="Nivel III">Nivel III</option>
			    <option value="Nivel Emérito">Nivel Emérito</option>
			    <option value="NA">No aplica</option>
			    </select>
			  </p>
			  <p>Ponencia:
  <input type="text" name="Ponencia" placeholder="Nombre de la Ponencia" required>
			    </p>
 			</TD> 
 			<TD> </TD> <TD><p>Eje temático :
 			  <select name="eje" size="1">
 			    <option value="Gestión y Administración de Negocios" selected>Gestión y Administración de Negocios</option>
 			    <option value="Tecnologías de la Información y Comunicación">Tecnologías de la Información y Comunicación</option>
 			    <option value="Desarrollo Regional">Desarrollo Regional</option>
 			    <option value="Ingeniería Industrial">Ingeniería Industrial</option>
 			    <option value="Agroindustrial">Agroindustrial</option>
 			    <option value="Ciencias de la Tierra">Ciencias de la Tierra</option>
 			    <option value="Mecatrónica">Mecatrónica</option>
 			    <option value="Ingeniería Automotriz">Ingeniería Automotriz</option>
 			    </select>
 			  </p>
 			  <p>Actividad :
  <select name="actividad" size="1">
    <option value="Ponencia" selected>Ponencia</option>
    <option value="Taller">Taller</option>
    <option value="Cartel">Cartel</option>
  </select>
 			    </p>    
                          </TD>

		</TR> 
	</TABLE>

	
	
	
	

	<input type="submit" value="Guardar">
		
	</form>



	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
    </div> 
<!-- /login-extra -->   




                 
                    
              </div>
            </div>
            

        </div>  
        
</body>

        
        
			<footer>
            <div class="content-wrapper">
                    Universidad Tecnológica de Tlaxcala - &copy; 2014 - Carretera a El Carmen Xalpatlahuaya s/n, Huamantla, Tlaxcala | Tel. 01 800 506 32 94 y 01 247 47 2 53 00- "Ciencia y Técnica para el Desarrollo"
            </div>
			</footer>
        
</html>