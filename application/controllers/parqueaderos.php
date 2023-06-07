<?php
include('../models/conexion.php');

$query = "SELECT nombre, tipo, ubicacion, horario, tarifa FROM parqueadero";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Crear un array para almacenar los datos de los parqueaderos
$parqueaderos = [];

// Recorrer cada fila de resultados
while ($fila = mysqli_fetch_assoc($resultado)) {
    // Obtener los valores de cada columna
    $nombre = $fila['nombre'];
    $tipo = $fila['tipo'];
    $ubicacion = $fila['ubicacion'];
    $horario = $fila['horario'];
    $tarifa = $fila['tarifa'];

    // Agregar los datos del parqueadero al array
    $parqueadero = [
        'nombre' => $nombre,
        'tipo' => $tipo,
        'ubicacion' => $ubicacion,
        'horario' => $horario,
        'tarifa' => $tarifa
    ];

    $parqueaderos[] = $parqueadero;
}

// Liberar la memoria del resultado
mysqli_free_result($resultado);

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($parqueaderos);
?>



