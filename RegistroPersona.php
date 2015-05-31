<!--Este documento es una plantilla general que puede ser usada en las demás paginas necesarias en el sitio web
lo unico que hay que hacer es agregarle el contenido al cuerpo de la pagina segun las funcionalidades que tenga esta-->
<?php
?>
<!DOCTYPE html>
 	<html>
 		
	  		<head lang="en">
			    <meta charset="utf-8">
			    <title>Registro de personas</title>
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
			    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
			    <meta name="description" content="">
			    <meta name="author" content="">
			    <link rel="icon" href="../../favicon.ico">

			    <!-- Bootstrap core CSS -->
			    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
			    <!-- Custom styles for this template -->
			    <link href="css/mainPage.css" rel="stylesheet">
			    
	  		</head>
	  		<body>     
	  			<div class="container">
					<form class="form-horizontal" role="form" action="enviarPersona.php" method="POST" style="background:#E6E6E6;">
						<div class="form-group">
							<div class="page-header">
						       <center><h2>Registrate!</h2></center>
						    </div>
						</div>

						<div class="form-group">
							<label for="nombre" class="col-lg-2 control-label">Nombre:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control input-sm" name="nombre" required placeholder="Nombre">
							</div>
						</div>  

						<div class="form-group">
							<label for="apellido" class="col-lg-2 control-label">Apellido:</label>
							<div class="col-sm-10">
								<input type="text" name="apellido" required placeholder="Apellido">
							</div>
						</div> 

						<div class="form-group">
							<label for="username" class="col-lg-2 control-label">Nombre de usuario:</label>
							<div class="col-sm-10">
								<input type="text" name="username" required placeholder="Nombre de usuario">
							</div>
						</div> 

						<div class="form-group">
							<label for="contrasena" class="col-lg-2 control-label">Contraseña:</label>
							<div class="col-sm-10">
								<input type="text" name="contrasena" required placeholder="Contraseña">
							</div>
						</div> 
						<div class="form-group">
							 <label for="telefono" class="col-lg-2 control-label">Teléfono:</label>
							 <div class="col-sm-10">
							 	<input type="tel" id = "telefono" name = "telefono" placeholder = "teléfono"/>		
							 	<button class="btn btn default" onclick="agregarTelefono();"><span class = "glyphicon glyphicon-plus" aria-hidden="true"></span>   Agregar</button>	
							 </div>
							 <div class="col-lg-6 control-label">
							 	<select id="listaTelefonos" name = "listaTelefonos" multiple>
								</select>	
							 </div>
						</div>
						<div class="form-group">
							 <label for="correo" class="col-lg-2 control-label">Correo:</label>
							 <div class="col-sm-10">
							 	<input type="email" id = "correo" name = "correo" placeholder = "correo"/>		
							 	<button class="btn btn default" onclick="agregarCorreo();"><span class = "glyphicon glyphicon-plus" aria-hidden="true"></span>   Agregar</button>	
							 </div>
							 <div class="col-lg-6 control-label">
							 	<select id="listaCorreos" name = "listaCorreos" multiple>
								</select>	
							 </div>
						</div>
						<div class="form-group">
							<label for="tipoUsuario" class="col-lg-2 control-label">Seleccione el tipo de usuario que desea ser:</label>
							<div class="col-sm-10">
								<select name="tipo">
							        <option value="1">Ornitólogo</option>
							        <option value="0">Otro</option>
							    </select>
							</div>
						</div> 
						<div class="form-group">
							<label class="col-lg-2 control-label"></label>
							<div class="col-sm-10">
						    	<input type="submit" value="Registrarse" class = "btn btn-primary" name="submit">
							</div>																									<!-- para que pueda ser procesada y enviada a la base de datos-->				
						</div>
					</form> 	
			</div>			
			<script type="text/javascript">
			function agregarTelefono(){
				var valor = document.getElementById("telefono").value;
				if(valor !="" || valor != ''){
					var nuevaOpcion = document.createElement("option");
					nuevaOpcion.text = valor;
					nuevaOpcion.value = telefono;
					var lista = document.getElementById("listaTelefonos");
					lista.add(nuevaOpcion,lista.length); 	
					document.getElementById("telefono").value = "";
				}
			}

			function agregarCorreo(){
				var valor = document.getElementById("correo").value;
				if(valor != "" || valor != ''){
					var nuevaOpcion = document.createElement("option");
					nuevaOpcion.text = valor;
					nuevaOpcion.value = correo;
					var lista = document.getElementById("listaCorreos");
					lista.add(nuevaOpcion,lista.length); 	
					document.getElementById("correo").value = "";
				}
			}
			</script>
			<!-- Los scripts de javascript se ponen al fondo para que la pagina cargue mas rapido-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		  </body>
		</html>
