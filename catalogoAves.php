<?php
	include 'funciones.php';
	if(isset($_GET['clase'])){
		$arrayClase= obtenerOrdenes($_GET['clase']);
        echo implode(",",$arrayClase);
    }
	else if(isset($_GET['orden'])){
		$arrayOrden= obtenerSubOrdenes($_GET['orden']);
        echo implode(",",$arrayOrden);
    }
	else if(isset($_GET['suborden'])){
		$arraySubOrden= obtenerFamilias($_GET['suborden']);
        echo implode(",",$arraySubOrden);
    }
	else if(isset($_GET['familia'])){
		$arrayFamilia= obtenerGeneros($_GET['familia']);
        echo implode(",",$arrayFamilia);
    }
	else if(isset($_GET['genero'])){
		$arrayGenero= obtenerEspecies($_GET['genero']);
        echo implode(",",$arrayGenero);
    }
?>