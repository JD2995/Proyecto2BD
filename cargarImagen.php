<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
</head>
</body>
<script>registrarFoto()</script>
<?php
include("funciones.php");
$target_dir = "Imagenes/";
$target_file = $target_dir . "temporal.". pathinfo($_FILES['fileToUpload']["name"], PATHINFO_EXTENSION);
echo $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "El archivo no fue cargado";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		//Obtención del id de la última foto subida
		$ultimoID= $_GET['id'];
			$archivoNombre= "Imagenes/".$ultimoID; 
			guardarImagen($target_file,$ultimoID);
			sleep(3);
			$stmt = mysqli_prepare($conn, "CALL PROGRA_2.COLOCARFOTO (?, ?)");
			mysqli_stmt_bind_param($stmt, 'si', $archivoNombre, $ultimoID);
			if(mysqli_stmt_execute($stmt)){
				echo "Se realizo con éxito";
				echo "<script>alert(\"La foto se agregó con éxito\")</script>";
			}
			else{
				echo "Error al cargar la imagen";
			}
			
    } else {
        echo "Hubo un error durante la cargar.";
    }
	echo "<script>
	window.location = 'index.php';
	</script>";
}
?>
</body>
</html>