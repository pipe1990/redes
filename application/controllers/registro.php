<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //id_usuario
  $id = $_POST['id_usuario'];
  
  //Placas 
  $valor1 = $_POST['letra1'];
  $valor2 = $_POST['letra2'];
  $valor3 = $_POST['letra3'];
  $valor4 = $_POST['numero1'];
  $valor5 = $_POST['numero2'];
  $valor6 = $_POST['numero3'];

  $resultadoPlaca = $valor1 . $valor2. $valor3. $valor4. $valor5. $valor6;

  // Hora
  $horaEntrada = $_POST['hh'];
  $minutosEntrada = $_POST['mm1'];
  $horaSalida = $_POST['mm1S'];
  $minutosSalida = $_POST['ll1'];

  $aux1 = intval($horaSalida) - intval($horaEntrada)
  $aux2 = intval($minutosSalida) - intval($minutosEntrada)

  $resultadoTiempo = $aux1 . " horas  " . $aux2 . " minutos" ; 

  $fechaHora = date('Y-m-d H:i:s');

  //Ubicacion 
  
  $nomPar = $_POST['parSelec'];

  //id_parqueadero 

  include('../models/conexion.php');

   $query = "SELECT id FROM parqueadero";
   $resultado = mysqli_query($conexion, $query);
   $fila = mysqli_fetch_assoc($resultado);
   $id = $fila['id_usuario'];

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
mysqli_free_result($resultado);

$query = "INSERT id FROM parqueadero";


  
  // Obtiene los valores de los otros cuatro select y asígnalos a variables adicionales

  
  // Combina los valores en una variable según tus necesidades

  echo "El resultado es: " . $resultadoPlaca;

}


?>