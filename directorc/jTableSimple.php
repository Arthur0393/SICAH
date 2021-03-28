<html>
  <head>

    <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="Scripts/jtable/themes/lightcolor/gray/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
	<div id="CarreraAcademica4" style="width: 800px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#CarreraAcademica5').jtable({
				title: 'Premios y/o distinciones (Premios Nacionales, Estatales, SNI y Otros)',
				actions: {
					listAction: 'CarreraAcademica4.php?action=list',
					createAction: 'CarreraAcademica4.php?action=create',
					updateAction: 'CarreraAcademica4.php?action=update',
					deleteAction: 'CarreraAcademica4.php?action=delete'
                                        
                                   
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					premios: {
						title: 'Premios y/o distinciones ',
						width: '100%'
					}
				}
			});

			//Load person list from server
			$('#CarreraAcademica5').jtable('load');

		});

	</script>
  </body>
</html>
