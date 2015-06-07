<?php
	include ('funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
	<title>Búsqueda por Ornitólogo</title>
	<head lang="en">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="js/busqueda.js"></script>

		<!-- Custom styles for this template -->
		<link href="css/mainPage.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
		<style>
		.thumbnail{
			width: 200px;
			height: 150px;
			overflow-x: hidden;
			overflow-y: hidden;
		}
		.thumbnail#t1{
			width: 500px;
			height: 400px;
		}
		.modal.modal-wide .modal-dialog {
		  width: 70%;
		}
		.modal-wide .modal-body {
		  overflow-y: auto;
		}
		</style>
	</head>
	<body>
		
		<nav class="navbar navbar-fixed-top navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <img class = "nav navbar-nav"src = "Imagenes/logo.png" height="42" width="42"/>
				  <a class="navbar-brand" href="index.php">Buscando mi hogar</a>
				  <ul class="nav navbar-nav">
					<li><a href="index.php">Inicio</a></li>
					<li class="active"><a href="index.php">Registra tu foto</a></li>
						<li>
						  <div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle"
									  data-toggle="dropdown" style="margin-top:9px;background:#2E2E2E;color:#F2F2F2;border:none;">
								Consulta <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="#">Fotos de aves</a></li>
								<li><a href="#">Estadisticas</a></li>
							  </ul>
						  </div>	
					  </li>
						<li><a href="#about">Acerca de</a></li>
				  </ul>
				  <form class="navbar-form navbar-right" method="POST" action="salir.php">
					<small class = "btn btn-success">Persona<small>   </small></small>
					<button type="submit" class="btn btn-success">Cerrar Sesion</button>
					<button class = "btn btn-primary"><a href="perfil.php" style = "color:white;float: right;">Mi perfil</a></button>
				  </form>
				</div> <!-- fin div navbar-header --> 
			</div><!-- /.container -->
		</nav><!-- /.navbar -->
		
		<div class="container">
			<div class="row row-offcanvas row-offcanvas-right">
				<div class="form-group">
			  <!--<label for etiqueta ="titulo">Registrate!</label>-->
					<div class="container">
						<div class="page-header">
							<center><h2 style="color:#6E6E6E">Fotografías de Aves</h2></center>
						</div>
					</div>	
		
		<form>
			<div class="form-group">
		<label class="col-lg-2 control-label">Búsqueda por:</label>
		<div class="col-lg-10">
		<select class="form-control" id= "tipos" name = "tipos">
			<option value="Seleccione opcion">Seleccione opci&oacute;n</option>
				<BR>
			<?php
			$array = array("Orden","Familia","Género","Especie","Tipo de pico","Color","Cantidad de huevos","Zona de vida","Tamaño","Persona");
				$res = count($array);
					for($i =0; $i<$res;$i++)
					{
							echo "<option value = ".$array[$i].">";	
							echo "<label>".$array[$i]."</label>";
					}	
			?>
		</select>
		</div>
		</div>
		
		<form class="navbar-form navbar-left" role="search">
		  <div class="form-group">
			  <BR>
			  <BR>
			  <BR>
			<input type="text" class="form-control" id="buscar" name="buscar" placeholder="Palabra clave">
		  </div>
		  <button type="submit" class="btn btn-default">Buscar</button>
		</form>
		</div>
		</div>
		
		<!-- Creación de modal para mostrar foto -->
		<div class="modal fade" id="modalFoto" name="modalFoto" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
				<div class="modal-content">
					<div class="col-sm-8">
						<div class="thumbnail" id="t1">
							<img id="imagen" src="Imagenes/31.php">
						</div>
							
						</div>
					</div>
				</div>
		</div>
		
		<!--Colocación de las imágenes-->
		<div class="container">
			<br>
			<?php
				//Si encontro que se hizo un filtro
				if(isset($_GET['tipos'])){
					//Si la búsque no tiene ningún valor
					if($_GET['buscar'] == ""){
						$fotosAves= obtenerAves();
					}
					else{
						//Obtiene los resultados dependiendo del tipo de búsqueda
						if($_GET['tipos'] == "Orden"){
							$fotosAves= obtenerAvesOrden($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Familia"){
							$fotosAves= obtenerAvesFamilia($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Género"){
							$fotosAves= obtenerAvesGenero($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Especie"){
							$fotosAves= obtenerAvesEspecie($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Tipo"){
							$fotosAves= obtenerAvesPico($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Color"){
							$fotosAves= obtenerAvesColor($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Cantidad"){
							$fotosAves= obtenerAvesHuevos($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Zona"){
							$fotosAves= obtenerAvesZona($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Tamaño"){
							$fotosAves= obtenerAvesTamaño($_GET['buscar']);
						}
						else if($_GET['tipos'] == "Persona"){
							$fotosAves= obtenerAvesPersona($_GET['buscar']);
						}
						//Si no es un tipo de búsqueda valido
						else{
							$fotosAves= obtenerAves();
						}
					}
				}
				else{
					$fotosAves= obtenerAves();
				}
				
				$indice= 0;
				while($indice < count($fotosAves)){
					crearModalFoto($fotosAves[$indice][0],$fotosAves[$indice][1]);
					if($indice == 0){
						print "<div class=\"row\">";
					}
					//Si llega al final de la fila de thumbnails
					if(is_int($indice/4) && $indice!=0){
						print "</div><div class=\"row\">";
					}
					
						print "<div class=\"col-xs-2 col-md-3\">
							<a href=\"#foto".$fotosAves[$indice][0]."\" data-toggle=\"modal\" class=\"thumbnail\" title=\"Nombre: ".$fotosAves[$indice][2]." ".$fotosAves[$indice][3]."&#13;Subido por: ".$fotosAves[$indice][4]."\">
								<img src=\"".$fotosAves[$indice][1].".php\">
							</a>
							</div>";
						$indice++;
					
				}
				print "</div>";
			?>
		</div>
	</body>
</html>