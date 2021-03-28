<html>
  <head>

    <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="Scripts/jtable/themes/lightcolor/green/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
	<div id="PeopleTableContainer" style="width: 700px;"></div>

	<input type="text" id='idformato' value=<?php echo $_POST['idActiviProy']; ?>>
	
	<script type="text/javascript">

		$(document).ready(function () {

			
			var idmandado = $('#idformato').val(); 

			//alert(idmandado);

			$('#idformato').hide();
			//Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Table of people',
				actions: {
					listAction: 'PersonActions.php?action=list&idDinamico='+idmandado,
					createAction: 'PersonActions.php?action=create&idDinamico='+idmandado,
					updateAction: 'PersonActions.php?action=update&idDinamico='+idmandado,
					deleteAction: 'PersonActions.php?action=delete&idDinamico='+idmandado
				},
				fields: {
					idactividades_proyectos: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					actividad: {
						title: 'Actividad',
						width: '30%'
					},
					fecha_inicio: {
						title: 'Inicio',
						width: '20%',
						type: 'date'
					},
					fecha_fin: {
						title: 'Fin',
						width: '20%',
						type: 'date'
					},
					entregable: {
						title: 'Entregable',
						width: '20%'
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
 
  </body>
</html>
