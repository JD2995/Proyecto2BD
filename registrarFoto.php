<?php
	include 'funciones.php';
	$estado= $_GET['estado'];
	$especie= $_GET['especie'];
	$persona= $_GET['persona'];
	$conn= $GLOBALS['conn'];
	$stmt = $conn->prepare('SET @especie := ?');
	$stmt->bind_param('s', $especie);
	$stmt->execute();
	if (!($resul = $conn->query("SELECT PROGRA_2.GETESPECIE_X_NOMBRE(@especie)"))) {
		echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
	}
	else{
		$especie_id;
		while($tupla= $resul->fetch_array(MYSQLI_BOTH)){
			$especie_id=$tupla[0];
		}
		registrarFoto($estado,$especie_id,$persona);
	}
?>