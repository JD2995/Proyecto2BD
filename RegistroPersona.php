<!-- <?php
	/*
	Autor: Erin Siezar García
	Fecha: 07/06/15 
	*/
?> -->
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
				<nav class="navbar navbar-fixed-top navbar-inverse">
			      <div class="container">
			        <div class="navbar-header">
			          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			          </button>
			          <ul class="nav navbar-nav">
			            <li><img src = "Imagenes/logo.png" style="width: 50px; height: 50px;" /></li>
			            <li><p class = "nav navbar-nav"> "   "</p></li>
			          </ul>
			          <a class="navbar-brand" href="#">Asociaci&oacute;n de Ornitolog&iacute;a</a>
			          <ul class="nav navbar-nav">
			            <li class="active"><a href="Inicio.php">Inicio</a></li> <!-- Este link lo manda a la pagina de inicio, o sea, aqui mismo-->
			            <li><a href="RegistroPersona.php">Registrarse</a></li>            <!-- Este link lo manda a la pagina de registro de usuario-->
			          </ul>
			          <form class="navbar-form navbar-right" method="POST" action="login.php">
			            <div class="form-group">
			              <input type="text" placeholder="Usuario" class="form-control" name = "usuario" required autofocus> 
			            </div>
			            <div class="form-group">
			              <input type="password" placeholder="Contraseña" class="form-control" name = "contrasena" required>
			            </div>
			            <button type="submit" class="btn btn-success">Ingresar</button> <!-- Este boton ingresa los datos, en donde seran validados en el archivo login.php-->
			          </form>
			        </div> <!-- fin div navbar-header --> 
			      </div><!-- /.container -->
			    </nav><!-- /.navbar -->   

	  			<div class="container">
					<form class="form-signin" role="form" action="enviarPersona.php" method="POST" style="background:#E6E6E6;" name = "registroPersona">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td>
										<div class="form-group">
											<div class="page-header">
										       <div class="center-block">
										       		<h2>Registrate!</h2>
										       </div>
										    </div>
										</div>				
									</td>
								</tr>	
								<tr>
									<td>
										<div class="form-group">
											<label for="nombre" class="sr-only">Nombre:</label>
											<div class="col-sm-10">
												<input type="text" name="nombre" class="form-control" required autofocus placeholder="Nombre">
											</div>
										</div> 	
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="primer_apellido" class="sr-only">Primer Apellido:</label>
											<div class="col-sm-10">
												<input type="text" name="primer_apellido" class="form-control" required autofocus placeholder="Primer apellido">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="segundo_apellido" class="sr-only">Segundo Apellido:</label>
											<div class="col-sm-10">
												<input type="text" name="segundo_apellido" class="form-control" required autofocus placeholder="Segundo apellido">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="cedula" class="sr-only">Cédula:</label>
											<div class="col-sm-10">
												<input type="text" name="cedula" class="form-control" required autofocus placeholder="Cédula">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="telefono_1" class="sr-only">Teléfono 1:</label>
											<div class="col-sm-10">
												<input type="text" name="telefono_1" class="form-control" required autofocus placeholder="Teléfono 1">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="telefono_2" class="sr-only">Teléfono 2:</label>
											<div class="col-sm-10">
												<input type="text" name="telefono_2" class="form-control"  autofocus placeholder="telefono_2">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="correo_1" class="sr-only">Correo 1:</label>
											<div class="col-sm-10">
												<input type="text" name="correo_1" class="form-control" required autofocus placeholder="Correo 1">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="correo_2" class="sr-only">Correo 2:</label>
											<div class="col-sm-10">
												<input type="text" name="correo_2" class="form-control"  autofocus placeholder="Correo_2">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="username" class="sr-only">Nombre de usuario:</label>
											<div class="col-sm-10">
												<input type="text" name="username" class="form-control" required autofocus placeholder="Nombre de usuario">
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label for="contrasena" class="sr-only">Contraseña:</label>
											<div class="col-sm-10">
												<input type="password" name="contrasena" class="form-control" required autofocus placeholder="Contraseña">
											</div>
										</div>	
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<div class="col-sm-10">
												<select name="tipo">
													<option value="-1">Seleccione un tipo de usuario </option>
													<option value="1"> Ornitólogo </option>
													<option value="0"> Otro </option>
												</select>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<div class="col-lg-10 control-label">
										    	<input type="submit" value="Registrarse" class = "btn btn-primary" name="submit">
											</div>																									<!-- para que pueda ser procesada y enviada a la base de datos-->				
										</div>
									</td>
								</tr>
							</table>	
						</div>
					</form> 	
			</div>			
			
			<!-- Los scripts de javascript se ponen al fondo para que la pagina cargue mas rapido-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		  </body>
		</html>
