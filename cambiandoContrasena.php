<!DOCTYPE html>
<html lang="es">
	<title>Configuración de los datos de la cuenta</title>
	<head lang="es">
		<meta charset="utf-8">
	</head>
	<body>
<?php
	include ('funciones.php');
	if(obtenerContrasena(1) == $_POST['actual']){
		if(!(empty($_POST['nueva']))){
			if(actualizarContrasena($_POST['nueva'],1) == 0){
				echo "<script>alert('El cambió de contraseña se realizo con éxito');".
				"window.location = 'index.php';</script>";
			}
			else{
				echo "<script>alert('Sucedió un error durante el cambió de contraseña');".
	"window.location = 'ConfigurarUsuario.php';</script>";
			}
		}
		else{
			echo "<script>alert('Error, ingrese una contraseña a cambiar');".
			"window.location = 'ConfigurarUsuario.php';</script>";
		}
	}
	else{
		echo "<script>alert('La contraseña ingresada no concuerda con su contraseña actual');".
		"window.location = 'ConfigurarUsuario.php';</script>";
	}
?>

</body>
</html>