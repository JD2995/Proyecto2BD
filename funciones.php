<?php
	//Conexión con mysql
	$servername = "localhost";
	$username = "PROGRA_2";
	$password = "progra_2";
	// Create conexión
	$conn = new mysqli($servername, $username, $password);
	// Chequear conexión
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$GLOBALS['conn']=$conn;
?>
	
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
	/*
	Autor: Javier Rivas
	Fecha: 27/07/15
	Descripción: Función  que registra foto en la Base de datos
	Entrada: Estado de la foto
			 Especie de la foto
			 Persona que subió la foto
	Salida: Ninguna*/
	function registrarFoto($estado,$especie,$persona){
		echo"Entre";
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @estado := ?');
		$stmt->bind_param('i', $estado);
		$stmt->execute();
		$stmt = $conn->prepare('SET @especie := ?');
		$stmt->bind_param('i', $especie);
		$stmt->execute();
		$stmt = $conn->prepare('SET @persona := ?');
		$stmt->bind_param('i', $persona);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.INSERTARFOTO(@estado,@persona,@especie)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
			return false;
		}
		else{
			echo "Éxito";
			return true;
		}
		
	}
	/*Autor: Javier Rivas
	Fecha: 31/07/15
	Descripción: Función que obtiene las clases de la BD
	Entrada: Ninguna
	Salida: Array con las clases obtenidas*/
	function obtenerClases(){
		$arrayClase= array();
		$conn= $GLOBALS['conn'];
		if (!($resul = $conn->query("CALL PROGRA_2.GETCLASES()"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				array_push($arrayClase,$tupla["NOMBRE"]);
			}
			return $arrayClase;
		}
	}
	/*Autor: Javier Rivas
	Fecha: 28/07/15
	Descripción: Función que obtiene las ordenes de la BD dependiendo de la clase
	Entrada: Ninguna
	Salida: Array con los ordenes obtenidos*/
	function obtenerOrdenes($clase){
		$arrayOrden= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @clase := ?');
		$stmt->bind_param('s', $clase);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETORDENES(@clase)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				array_push($arrayOrden,$tupla["NOMBRE"]);
			}
			return $arrayOrden;
		}
	}
	/*Autor: Javier Rivas
	Fecha: 30/07/15
	Descripción: Función que obtiene las subordenes de la BD dependiendo del orden
	Entrada: Ninguna
	Salida: Array con los subordenes obtenidos*/
	function obtenerSubOrdenes($orden){
		$arraySubOrden= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @orden := ?');
		$stmt->bind_param('s', $orden);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETSUBORDENES(@orden)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				array_push($arraySubOrden,$tupla["NOMBRE"]);
			}
			return $arraySubOrden;
		}
	}
	/*Autor: Javier Rivas
	Fecha: 30/07/15
	Descripción: Función que obtiene las familias de la BD dependiendo del suborden
	Entrada: Ninguna
	Salida: Array con las familias obtenidos*/
	function obtenerFamilias($suborden){
		$arrayFamilia= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @suborden := ?');
		$stmt->bind_param('s', $suborden);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETFAMILIAS(@suborden)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				array_push($arrayFamilia,$tupla["NOMBRE"]);
			}
			return $arrayFamilia;
		}
	}
	/*Autor: Javier Rivas
	Fecha: 30/07/15
	Descripción: Función que obtiene las géneros de la BD dependiendo de la familia
	Entrada: Ninguna
	Salida: Array con los géneros obtenidos*/
	function obtenerGeneros($familia){
		$arrayGenero= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @familia := ?');
		$stmt->bind_param('s', $familia);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETGENEROS(@familia)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				array_push($arrayGenero,$tupla["NOMBRE"]);
			}
			return $arrayGenero;
		}
	}
	/*Autor: Javier Rivas
	Fecha: 30/07/15
	Descripción: Función que obtiene las especies de la BD dependiendo del género
	Entrada: Ninguna
	Salida: Array con las especies obtenidos*/
	function obtenerEspecies($genero){
		$arrayEspecie= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @genero := ?');
		$stmt->bind_param('s', $genero);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETESPECIES(@genero)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				array_push($arrayEspecie,$tupla["NOMBRE"]);
			}
			return $arrayEspecie;
		}
	}
	
	function setGlobal($nombre,$variable){
		$GLOBALS[$nombre]=$variable;
	}
?>