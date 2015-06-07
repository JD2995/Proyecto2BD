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
	
	/*Autor: Javier Rivas
	Fecha: 02/06/15
	Descripción: Función que obtiene la lista de ornítologos
	Entrada: Ninguna
	Salida: Array con los ornitólogos obtenidos*/
	function obtenerOrnitologos(){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		if (!($resul = $conn->query("CALL PROGRA_2.GETORNITOLOGOS()"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de ornítologos filtrado por nombre
	Entrada: Ninguna
	Salida: Array con los ornitólogos obtenidos*/
	function obtenerOrnitologosNombre($nombre){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $nombre);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETORNITOLOGOSNOMBRE(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de ornítologos filtrado por apellido
	Entrada: Ninguna
	Salida: Array con los ornitólogos obtenidos*/
	function obtenerOrnitologosApellido($apellido){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $apellido);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETORNITOLOGOSAPELLIDO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de ornítologos filtrado por apellido
	Entrada: Ninguna
	Salida: Array con los ornitólogos obtenidos*/
	function obtenerOrnitologosCorreo($correo){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $correo);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETORNITOLOGOSCORREO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 02/06/15
	Descripción: Función que obtiene la lista de aficionados
	Entrada: Ninguna
	Salida: Array con los aficionados obtenidos*/
	function obtenerAficionados(){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		if (!($resul = $conn->query("CALL PROGRA_2.GETAFICIONADOS()"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de aficionados filtrado por nombre
	Entrada: Ninguna
	Salida: Array con los aficionados obtenidos*/
	function obtenerAficionadosNombre($nombre){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $nombre);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAFICIONADOSNOMBRE(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de aficionados filtrado por apellido
	Entrada: Ninguna
	Salida: Array con los aficionados obtenidos*/
	function obtenerAficionadosApellido($apellido){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $apellido);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAFICIONADOSAPELLIDO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de aficionados filtrado por apellido
	Entrada: Ninguna
	Salida: Array con los aficionados obtenidos*/
	function obtenerAficionadosCorreo($correo){
		$arrayPersonas= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $correo);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAFICIONADOSCORREO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$arrayPersona= array();
				$cantFotos= obtenerCantFotos($tupla[0]);
				//Ingresa dentro de un array los datos de una persona
				array_push($arrayPersona,$tupla[0]);
				array_push($arrayPersona,$tupla[1]);
				array_push($arrayPersona,$tupla[2]);
				array_push($arrayPersona,$tupla[3]);
				array_push($arrayPersona,$cantFotos);
				array_push($arrayPersona,$tupla[4]);
				//Ingresa a la persona en la lista de personas
				array_push($arrayPersonas,$arrayPersona);
			}
			return $arrayPersonas;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves
	Entrada: Ninguna
	Salida: Array con las fotos de las aves*/
	function obtenerAves(){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVES()"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de la foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por orden
	Entrada: Orden a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesOrden($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESORDEN(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por familia
	Entrada: Familia a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesFamilia($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESFAMILIA(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por génerp
	Entrada: Género a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesGenero($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESGENERO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por especie
	Entrada: Especie a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesEspecie($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESESPECIE(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por pico
	Entrada: Pico a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesPico($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESPICO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por cantidad de huevos
	Entrada: Cantidad de huevos a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesHuevos($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESHUEVOS(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por zona de vida
	Entrada: Zona a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesZona($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESZONA(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por Tamaño
	Entrada: Tamaño a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesTamaño($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESTAMAÑO(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene la lista de fotos de aves por persona
	Entrada: Persona a buscar
	Salida: Array con las fotos de las aves filtrada*/
	function obtenerAvesPersona($filtro){
		$arrayFotos= array();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @filtro := ?');
		$stmt->bind_param('s', $filtro);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETAVESPERSONA(@filtro)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$Foto= array();
				//Ingresa dentro de un array los datos de una foto
				array_push($Foto,$tupla[0]);
				array_push($Foto,$tupla[1]);
				array_push($Foto,$tupla[2]);
				array_push($Foto,$tupla[3]);
				array_push($Foto,$tupla[4]);
				//Ingresa a la foto en la lista de fotos
				array_push($arrayFotos,$Foto);
			}
			return $arrayFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 03/06/15
	Descripción: Función que estable la conexión con la BD
	Entrada: Ninguna
	Salida: Ninguna*/
	function establecerConexion(){
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
		$GLOBALS['conn']= $conn;
	}
	
	/*Autor: Javier Rivas
	Fecha: 02/06/15
	Descripción: Función que obtiene cantidad de fotos por persona
	Entrada: ID de persona
	Salida: Cantidad de fotos*/
	function obtenerCantFotos($persona_id){
		establecerConexion();	//Reestablece la conexión
		$conn= $GLOBALS['conn'];
		$cantFotos= 0;
		$stmt = $conn->prepare('SET @id := ?');
		$stmt->bind_param('i', $persona_id);
		$stmt->execute();
		if (!($resul = $conn->query("SELECT PROGRA_2.GETCANTFOTOPERSONA(@id)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$cantFotos= $tupla[0];
			}
			return $cantFotos;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 02/06/15
	Descripción: Función que obtiene los datos de una persona
	Entrada: ID de persona
	Salida: Array con los datos de la persona*/
	function obtenerPersona($persona_id){
		$conn= $GLOBALS['conn'];
		$arrayPersona= array();
		$stmt = $conn->prepare('SET @id := ?');
		$stmt->bind_param('i', $persona_id);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETPERSONA(@id)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$persona= array();
				array_push($persona,$tupla[0]);
				array_push($persona,$tupla[1]);
				array_push($persona,$tupla[2]);
				array_push($persona,$tupla[3]);
				array_push($persona,$tupla[4]);
				array_push($arrayPersona,$persona);
			}
			return $arrayPersona;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 02/06/15
	Descripción: Función que obtiene las fotos de una persona
	Entrada: ID de persona
	Salida: Array con las fotos*/
	function obtenerFotosPersona($persona_id){
		establecerConexion();
		$conn= $GLOBALS['conn'];
		$arrayFoto= array();
		$stmt = $conn->prepare('SET @id := ?');
		$stmt->bind_param('i', $persona_id);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETFOTOSPERSONA(@id)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$foto= array();
				array_push($foto,$tupla[0]);
				array_push($foto,$tupla[1]);
				array_push($foto,$tupla[2]);
				array_push($arrayFoto,$foto);
			}
			return $arrayFoto;
		}
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que obtiene los datos de la ave de la foto
	Entrada: ID de la foto
	Salida: Ninguna*/
	function obtenerInfoAve($foto_id){
		$arrayFoto= array();
		establecerConexion();
		$conn= $GLOBALS['conn'];
		$stmt = $conn->prepare('SET @id := ?');
		$stmt->bind_param('i', $foto_id);
		$stmt->execute();
		if (!($resul = $conn->query("CALL PROGRA_2.GETINFOAVE(@id)"))) {
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			//Mientras haya elementos
			while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
				$foto= array();
				array_push($foto,$tupla[0]);
				array_push($foto,$tupla[1]);
				array_push($foto,$tupla[2]);
				array_push($foto,$tupla[3]);
				array_push($foto,$tupla[4]);
				array_push($foto,$tupla[5]);
				array_push($foto,$tupla[6]);
				array_push($foto,$tupla[7]);
				array_push($foto,$tupla[8]);
				array_push($foto,$tupla[9]);
				array_push($foto,$tupla[10]);
				array_push($foto,$tupla[11]);
				array_push($foto,$tupla[12]);
				array_push($foto,$tupla[13]);
				array_push($arrayFoto,$foto);
			}
			return $arrayFoto;
		}	
	}
	
	function imprimirColumna($nombre,$elemento){
		echo "<tr>".
		"<td align=\"right\"><span style='font-weight:bold;'>".
		$nombre.": </span></td>".
		"<td>".$elemento."</td></tr>";
	}
	
	function imprimirColumnaMultiple($nombre,$arrayElemento,$indiceElemento){
		$arrayEscritos= array();
		if(count($arrayElemento) > 0){
			echo "<tr>".
			"<td align=\"right\"><span style='font-weight:bold;'>".
			$nombre.": </span></td>".
			"<td>".$arrayElemento[0][$indiceElemento]."</td></tr>";
			array_push($arrayEscritos,$arrayElemento[0][$indiceElemento]);
		}
		$indice= 1;
		while($indice < count($arrayElemento)){
			if(!in_array($arrayElemento[$indice][$indiceElemento],$arrayEscritos)){
				echo "<tr>".
				"<td align=\"right\"></td>".
				"<td>".$arrayElemento[$indice][$indiceElemento]."</td></tr>";
				array_push($arrayEscritos,$arrayElemento[0][$indiceElemento]);
			}
			$indice++;
		}	
	}
	
	/*Autor: Javier Rivas
	Fecha: 04/06/15
	Descripción: Función que crea el modal de una foto
	Entrada: ID de la foto, ruta de la imagen
	Salida: Ninguna*/
	function crearModalFoto($foto_id,$imagen){
		$infoAve= obtenerInfoAve($foto_id);
		echo "<div id=\"foto".$foto_id."\" class=\"modal modal-wide fade\">".
		"<div class=\"modal-dialog\">".
		"<div class=\"modal-content\">".
		"<div class=\"modal-header\">".
		"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" arial-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>".
		"<h4 class=\"modal-title\" id=\"myModalLabel\">Información de la fotografía</h4>".
		"</div>".
		"<div class=\"modal-body\">".
		"<div class=\"row\">".
		"<div class=\"col-sm-1\"></div>".
		"<div class=\"col-xs-5 col-md-5\">".
		"<div class=\"thumbnail\">".
		"<img src=\"".$imagen.".php\">".
		"</div>".
		"</div>".
		"</div>".
		"<div class=\"row\">".
		"<div class=\"col-sm-3\">".
		"<table class=\"table\">";
		imprimirColumna("Nombre común",$infoAve[0][0]);
		imprimirColumna("Orden",$infoAve[0][2]);
		imprimirColumna("Especie",$infoAve[0][5]);
		imprimirColumna("Cantidad de Huevos",$infoAve[0][8]);
		imprimirColumnaMultiple("Alimentación",$infoAve,11);
		echo "</table></div>".
		"<div class=\"col-sm-3\">".
		"<table class=\"table\">";
		imprimirColumna("Nombre inglés",$infoAve[0][1]);
		imprimirColumna("Familia",$infoAve[0][3]);
		imprimirColumna("Tipo de pico",$infoAve[0][6]);
		imprimirColumna("Zona de vida",$infoAve[0][9]);
		imprimirColumna("Subido por",$infoAve[0][12]);
		echo "</table></div>".
		"<div class=\"col-sm-3\">".
		"<table class=\"table\">";
		imprimirColumna("Nombre científico",$infoAve[0][4]." ".$infoAve[0][5]);
		imprimirColumna("Género",$infoAve[0][4]);
		imprimirColumnaMultiple("Colores",$infoAve,7);
		imprimirColumna("Tamaño",$infoAve[0][10]);
		imprimirColumna("Subido el",$infoAve[0][13]);
		echo "</table></div></div></div>".
		"<div class=\"modal-footer\">".
		"<button class=\"btn btn-primary\" data-dismiss=\"modal\" onclick=\"abrirModal('".$imagen.".php')\"> Ver imagen</button>".
		"</div></div></div></div>";
	}	
?>