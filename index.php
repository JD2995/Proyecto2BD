<!DOCTYPE html>
<html>
	<title>Consultas</title>
<body>
	<h1>Proyecto 2 Bases de datos</h1>
	<?php
	$servername = "localhost";
	$username = "PROGRA_2";
	$password = "progra_2";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
	include_once("funciones.php");
	//guardarImagen("hola.jpg","prueba");
	
	?>
	<img src="Imagenes/19.php">
	
</html>