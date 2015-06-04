<?php
	/*
	Autor: Javier Rivas Lozano
	Fecha: 01/06/15 
	*/
	include ('funciones.php');
	$datosPersona= obtenerPersona($_GET['id']);
?>

<!DOCTYPE html>
<html lang="es">
	<title><?php echo $datosPersona[0][0]." ".$datosPersona[0][1]; ?></title>
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
		</style>
	</head>
	<body>
		<script src="funciones.js"></script>
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
		
		<?php
			$fotosPersona= obtenerFotosPersona($_GET['id']);
			$apellidos= array();
			$indice= 0;
			while($indice < count($datosPersona)){
				if(!in_array($datosPersona[$indice][1],$apellidos)){
					array_push($apellidos,$datosPersona[$indice][1]);
				}
				$indice++;
			}
			$apellidos= array();
			$indice= 0;
			while($indice < count($datosPersona)){
				if(!in_array($datosPersona[$indice][1],$apellidos)){
					array_push($apellidos,$datosPersona[$indice][1]);
				}
				$indice++;
			}
			$telefonos= array();
			$indice= 0;
			while($indice < count($datosPersona)){
				if(!in_array($datosPersona[$indice][3],$telefonos)){
					array_push($telefonos,$datosPersona[$indice][3]);
				}
				$indice++;
			}
		?>
		
		<div class= "container">
			<h1 style="color:#6E6E6E">Información personal</h1>
			<br>
			<div class="row">
				<div class="col-sm-4">
					<table>
					<tr>
						<td align="right"><span style='font-weight:bold;'>Nombre:</span></td>
						<td>
						<?php
							echo "&nbsp&nbsp".$datosPersona[0][0];
						?>
						</td>
					</tr>
					<tr></tr>
					<tr>
						<td align="right"><span style='font-weight:bold;'>Apellidos:</span></td>
						<?php
						$indice= 0;
						while($indice < count($apellidos)){
							if($indice == 0){
								echo "<td>&nbsp&nbsp".$apellidos[$indice]."</td></tr>";
							}
							else{
								echo "<tr><td></td>".
								"<td>&nbsp&nbsp".$apellidos[$indice]."</td></tr>";
							}
							$indice++;
						}
						?>
					<tr>
						<td align="right"><span style='font-weight:bold;'>Correo electrónico:</span></td>
						<td><?php echo "&nbsp&nbsp".$datosPersona[0][2];?></td>
					</tr>
					</table>
				</div>
				<div class="col-sm-4">
					<table>
					<tr>
						<td align="right"><span style='font-weight:bold;'>Tipo de usuario:</span></td>
						<td>
						<?php
							echo "&nbsp&nbsp".$_GET['tipo'];
						?>
						</td>
					</tr>
					<tr>
						<td align="right"><span style='font-weight:bold;'>Teléfonos:</span></td>
						<?php
						$indice= 0;
						while($indice < count($telefonos)){
							if($indice == 0){
								echo "<td>&nbsp&nbsp".$telefonos[$indice]."</td></tr>";
							}
							else{
								echo "<tr><td></td>".
								"<td>&nbsp&nbsp".$telefonos[$indice]."</td></tr>";
							}
							$indice++;
						}
						?>
					<tr>
						<td align="right"><span style='font-weight:bold;'>Cantidad de fotos:</span></td>
						<td><?php echo "&nbsp&nbsp".$datosPersona[0][4];?>
					</tr>
					</table>
				</div>
			</div>
		</div>
		
		<br>	
		<hr>
		
		<div class="container">
			<h1 style="color:#6E6E6E">Fotografías subidas</h1>
			<br>
			<?php
				$indice= 0;
				while($indice < count($fotosPersona)){
					if($indice == 0){
						print "<div class=\"row\">";
					}
					//Si llega al final de la fila de thumbnails
					if(is_int($indice/4) && $indice!=0){
						print "</div><div class=\"row\">";
					}
					
						print "<div class=\"col-xs-2 col-md-3\">
							<a href=\"#\" class=\"thumbnail\" title=\"Nombre: ".$fotosPersona[$indice][1]." ".$fotosPersona[$indice][2]."\">
								<img src=\"".$fotosPersona[$indice][0].".php\" onclick=\"abrirModal('".$fotosPersona[$indice][0].".php')\">
							</a>
							</div>";
						$indice++;
					
				}
				print "</div>";
			?>
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
		</div>
	</body>
</html>