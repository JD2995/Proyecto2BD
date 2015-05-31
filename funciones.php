<?php
	/*Autor: Javier Rivas
	Fecha: 27/07/15
	Descripción: Función que convierte la imagen en base64
	Entrada: Dirección de la imagen a guardar
	Salida: String con la imagen en base64*/
	function convertirBase64($filepath){
		$type = pathinfo($filepath, PATHINFO_EXTENSION);
		$data = file_get_contents($filepath);	//Obtiene los datos de la imagen
		$base64 = base64_encode($data);		//Lo codifica en base64
		return $base64;
	}
	/*
	Autor: Javier Rivas
	Fecha: 27/07/15
	Descripción: Función que guarda en la carpeta de imagenes la imagen cargada en formato base64
	Entrada: Dirección de la imagen a guardar
			 Nombre con el que se guarda la imagen
	Salida: Ninguna*/
	function guardarImagen($filepath,$nombre){
		$base64= convertirBase64($filepath);	//Convierte la imagen en base64
		$archivo = fopen("Imagenes/$nombre.php", "w") or die("Unable to open file!");
		$texto = "<?php\n". 
					"header(\"Content-type: image/png\");\n".
					"\$data= \"".$base64."\";\n".
					"echo base64_decode(\$data);\n".
					"?>";
		fwrite($archivo, $texto);
		fclose($archivo);
	}
?>