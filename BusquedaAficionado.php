<?php
	include ('funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
	<title>Búsqueda por Aficionado</title>
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
		
		<div class="container">
			<div class="row row-offcanvas row-offcanvas-right">
				<div class="form-group">
			  <!--<label for etiqueta ="titulo">Registrate!</label>-->
					<div class="container">
						<div class="page-header">
							<center><h2>Consultas de Aficionados</h2></center>
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
			$array = array("Nombre", "Apellido", "Correo");
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

		<!-- Creación de la tablas con la lista de ornitólogos-->
		<table class="table">
		<thead>
		  <tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Correo</th>
			<th>Cantidad de fotos</th>
			<th>Fecha de ingreso</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		//Si encontro que se hizo un filtro
		if(isset($_GET['tipos'])){
			//Si la búsque no tiene ningún valor
			if($_GET['buscar'] == ""){
				$arrayPersonas= obtenerAficionados();
			}
			else{
				//Obtiene los resultados dependiendo del tipo de búsqueda
				if($_GET['tipos'] == "Nombre"){
					$arrayPersonas= obtenerAficionadosNombre($_GET['buscar']);
				}
				else if($_GET['tipos'] == "Apellido"){
					$arrayPersonas= obtenerAficionadosApellido($_GET['buscar']);
				}
				else if($_GET['tipos'] == "Correo"){
					$arrayPersonas= obtenerAficionadosCorreo($_GET['buscar']);
				}
				//Si no es un tipo de búsqueda valido
				else{
					$arrayPersonas= obtenerAficionados();
				}
			}
		}
		else{
			$arrayPersonas= obtenerAficionados();
		}
		$arrayID= array();
		$indPersona= 0;
		while($indPersona < count($arrayPersonas)){
			//Si ya la persona esta ingresada en la tablas
			if(!in_array($arrayPersonas[$indPersona][0],$arrayID)){
				print "<tr>".
				"<td>".$arrayPersonas[$indPersona][1]."</td>".
				"<td>".$arrayPersonas[$indPersona][2]."</td>".
				"<td>".$arrayPersonas[$indPersona][3]."</td>".
				"<td>".$arrayPersonas[$indPersona][4]."</td>".
				"<td>".$arrayPersonas[$indPersona][5]."</td>".
				"<td><button class=\"btn btn-default\" onclick=\"verPerfil(".$arrayPersonas[$indPersona][0].",2)\">Ver perfil</button></td></tr>";
				array_push($arrayID,$arrayPersonas[$indPersona][0]);	//Ingresa el id en la lista
			}			
			$indPersona++;
		}
		?>
		
		</tbody>
		</table>
		  
		</div>
	</body>
</html>