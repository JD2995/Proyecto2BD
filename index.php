<!DOCTYPE html>
<html>
	<title>Consultas</title>
<body>
	<h1>Proyecto 2 Bases de datos</h1>
	<?php
	$servername = "localhost";
	$username = "Betty";
	$password = "Na22na10";
	$dbname  = "progra_2";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password,$dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	else{
		echo "Connected successfully";
		include_once("funciones.php");
		//guardarImagen("hola.jpg","prueba");	
	}
	
	?>
	<!--<img src="Imagenes/prueba.php">-->
	
</html>