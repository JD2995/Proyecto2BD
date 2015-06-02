<?php 
	include 'funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
	<title>Registro de foto</title>
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

		<!-- Custom styles for this template -->
		<link href="css/mainPage.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
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
		
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<h1 style="color:#6E6E6E">Registra tu foto</h1>
			</div>
		</div>
		
		<?php
			$conn= $GLOBALS['conn'];
			if (!($resul = $conn->query("SELECT Auto_increment FROM information_schema.tables WHERE table_name='foto_ave'"))) {
				echo "No cargo";
			}
			else{
				$tupla= $resul->fetch_array(MYSQLI_BOTH);
				$ultimoID= $tupla[0];
			}
			echo $ultimoID;
		?>
		
		<div class="row">
		<form enctype="multipart/form-data" <?php echo "action=\"cargarImagen.php?id=".$ultimoID."\"";?>  method="post" name="catalogos" onsubmit="return registrarFoto()">
			<div class=col-sm-1></div>
			<div class=col-sm-4>
				
					<div class="form-group">
					  <label for="clase">Seleccione la clase:</label>
					  <select class="form-control" id="clase" onchange="cambioOrden(this.value)">
						<?php
							$arrayClase=obtenerClases();
							$indClase= 0;
							while($indClase < count($arrayClase)){
								print "<option>".$arrayClase[$indClase]."</option>";
								$indClase++;
							}
						?>
					  </select>
					  <br>
					  <label for=orden">Seleccione el orden:</label>
					  <select class="form-control" id="orden" name="orden" onchange="cambioSubOrden(this.value)"> </select>
					  <br>
					  <label for="suborden">Seleccione el suborden:</label>
					  <select class="form-control" id="suborden" name="suborden" onchange="cambioFamilia(this.value)">
					  </select>
					  <br>
					  <label for="sel1">Seleccione la familia:</label>
					  <select class="form-control" id="familia" name="familia" onchange="cambioGenero(this.value)">
					  </select>
					  <br>
					  <label for="sel1">Seleccione el género:</label>
					  <select class="form-control" id="genero" name="genero" onchange="cambioEspecie(this.value)">
					  </select>
					  <br>
					  <label for="sel1">Seleccione la especie:</label>
					  <select class="form-control" id="especie" name="especie"></select>
					  <br>
					</div>
				
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-xs-6 col-md-6">
						<div class="thumbnail">
							<img src="Imagenes/no_imagen.png" name="imagenTemporal" id="imagenTemporal"></img>
						</div>
					</div>
				</div>
					Seleccione una imagen:
					<input type="file" name="fileToUpload" id="fileToUpload" onchange="mostrarPreview(this)">
					<br>
					<div class="checkbox">
					  <label><input type="checkbox" value="favorito" name="favorito">Insertar a mejores fotografías</label>
					</div>
					<br>
					<input type="submit" class="btn btn-default" value="Ingresar fotografía" name="submit">
				
				<br>
			</div>
			</form>
		</div>
	<script>
	//Ejecuta la primera selección de los catálogos
		cambioOrden(document.catalogos.clase.options[0].value);
		
	</script>
	
	</body>
</html>