<?php
	/*
	Autor: Javier Rivas Lozano
	Fecha: 07/06/15 
	*/
	include ('funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
	<title>Configuración de los datos de la cuenta</title>
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
		
		<?php
			$datosPersona= obtenerPersona(1);
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
		<form role="form" method="post" action="cambiandoContrasena.php">
		<div class="container">
			<h2 style="color:#6E6E6E">Cambiar contraseña</h2>
			<br>
			<!-- Contraseña-->
			<div class="row">
				<div class="col-sm-2">
					<p align="right"><b>Actual contraseña : </b></p>
				</div>
				<div class="col-sm-5">
					<input type="password" class="form-control" id="actual" name="actual">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2">
					<p align="right"><b>Nueva contraseña : </b></p>
				</div>
				<div class="col-sm-5">
					<input type="password" class="form-control" id="nueva" name="nueva">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-5">
					<input id="submit" name="submit" type="submit" value="Cambiar" class="btn btn-primary">
				</div>
			</div>
		</div>
		</form>
	</body>
</html>