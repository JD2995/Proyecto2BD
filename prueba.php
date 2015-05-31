<!-- <html><head><meta charset="utf-8"> </head>
<body>
//<?php
//	require_once("conexion.php");
//	$conexion = GetMyConnection();
//?>

//<?php
//Ejemplo aprenderaprogramar.com
//function mostrarDatos ($resultados) {
//if ($resultados !=NULL) {
//echo "- Nombre: ".$resultados['nombre']."<br/> ";
//}
//$statement = oci_parse($conexion);
//oci_execute($statement);  
//$tildes = $statement->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
//$result = mysqli_query($link, "SELECT * FROM especie");
//mostrarDatos(mysqli_fetch_array($result));
//mostrarDatos(mysqli_fetch_array($result));
//mysqli_free_result($result);
//mysqli_close($statement);
//} 
//?>
</body></html> -->
<html><head><meta charset="utf-8"> </head>
<body>
<?php
//Ejemplo aprenderaprogramar.com
function mostrarDatos ($resultados) {
if ($resultados !=NULL) {
echo "$resultados";
}
$link = mysqli_connect('localhost', 'root@localhost', 'Na22na10');
mysqli_select_db($link, "progra_2");
$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
$result = mysqli_query($link, "SELECT * FROM orden");
while ($fila = mysqli_fetch_array($result)){
mostrarDatos($fila);
}
mysqli_free_result($result);
mysqli_close($link);
}
?>
</body></html>