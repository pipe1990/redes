<?php
include('../models/conexion.php');

if (isset($_POST['cambiar_estado_button'])) {
  $idParqueadero = $_POST['id'];

  // Obtener el estado actual del parqueadero
  $query = "SELECT estado FROM parqueadero WHERE id_parqueadero = $idParqueadero";
  $resultado = mysqli_query($conexion, $query);

  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
  }

  $row = mysqli_fetch_assoc($resultado);
  $estadoActual = $row['estado'];

  // Cambiar el estado del parqueadero
  if ($estadoActual == "Activo") {
    $nuevoEstado = "Inactivo";
  } else {
    $nuevoEstado = "Activo";
  }

  $query = "UPDATE parqueadero SET estado = '$nuevoEstado' WHERE id_parqueadero = $idParqueadero";
  $resultado = mysqli_query($conexion, $query);

  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
  }

  // Redireccionar a la página anterior
  header("Location: cambiar_estado.php");
  exit();
}
?>

<?php
include('../models/conexion.php');

if (isset($_POST['cambiar_estado_usuario_button'])) {
  $idUsuario = $_POST['id'];

  // Obtener el estado actual del parqueadero
  $query = "SELECT estado FROM usuario WHERE id_usuario = $idUsuario";
  $resultado = mysqli_query($conexion, $query);

  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
  }

  $row = mysqli_fetch_assoc($resultado);
  $estadoActual = $row['estado'];

  // Cambiar el estado del parqueadero
  if ($estadoActual == "1") {
    $nuevoEstado = "0";
  } else {
    $nuevoEstado = "1";
  }

  $query = "UPDATE usuario SET estado = '$nuevoEstado' WHERE id_usuario = $idUsuario";
  $resultado = mysqli_query($conexion, $query);

  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
  }

  // Redireccionar a la página anterior
  header("Location: estado_usuario.php");
  exit();
}
?>

