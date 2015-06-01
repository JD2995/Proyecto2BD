<?php
include("funciones.php");
$target_dir = "Imagenes/";
$target_file = $target_dir . "temporal.". pathinfo($_FILES['fileToUpload']["name"], PATHINFO_EXTENSION);
echo $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Lo sentimos, solamente archivos jpg, png o jpeg";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "El archivo no fue cargado";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		//Obtención del id de la última foto subida
		$conn= $GLOBALS['conn'];
		if (!($resul = $conn->query("SELECT foto_ave_id FROM PROGRA_2.foto_ave ORDER BY foto_ave_id DESC LIMIT 1"))) {
			echo "No cargo";
		}
		else{
			$tupla= $resul->fetch_array(MYSQLI_BOTH);
			$ultimoID= $tupla[0];
			$archivoNombre= "Imagenes/".$ultimoID; 
			guardarImagen($target_file,$ultimoID);
			$stmt = mysqli_prepare($conn, "CALL PROGRA_2.COLOCARFOTO (?, ?)");
			mysqli_stmt_bind_param($stmt, 'si', $archivoNombre, $ultimoID);
			if(mysqli_stmt_execute($stmt)){
				echo "Se realizo con éxito";
			}
			else{
				echo "Error al cargar la imagen";
			}
			
		}
    } else {
        echo "Hubo un error durante la cargar.";
    }
	ob_start();
	$url = 'index.php';
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	header( "Location: $url" );
}
?>