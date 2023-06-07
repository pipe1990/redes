<?php
include('../models/conexion.php');

$query = "SELECT nombre FROM parqueadero";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$parqueaderos = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $nombreParqueadero = $fila['nombre'];
    $nombreParqueadero = utf8_encode($nombreParqueadero); // Opcional: Codificar a UTF-8 si es necesario
    $nombreParqueadero = urlencode($nombreParqueadero); // Codificar caracteres especiales
    $parqueaderos[] = $nombreParqueadero;
}

mysqli_free_result($resultado);

echo json_encode($parqueaderos);

?>


