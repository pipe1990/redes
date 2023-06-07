<?php
    session_start();

    if (!isset($_SESSION['empleado'])) {
       echo '<script>
        alert("Por Favor inicie sesión.") 
        window.location = "/ProyectoParkea-Apache/index.php";
       </script>';
       session_destroy();
       die();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Empleado</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css">
  <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/style_empleado.css">
</head>
<body class="button_container">
  <img src="/ProyectoParkea-Apache/images/parkea.png" class="image-parkea">
  <div>
  <button id="registrar_usuario_button" class="button1">Registrar nuevo usuario</button>
  <script>
  document.getElementById("registrar_usuario_button").addEventListener("click", function() {
    window.location.href = "register.php";
  });
</script>
  </div>
  <div>
  <button id="consultar_park_button" class="button1" style="border: 2px solid black;">Consultar parqueaderos</button>
  </div>
  <button id="editar_estado_button" class="button1">Editar Operatividad</button>
  <script>
  document.getElementById("editar_estado_button").addEventListener("click", function() {
    window.location.href = "cambiar_estado.php";
  });
</script>
  <div>
    
  </div>
  <button onclick="window.location.href='/ProyectoParkea-Apache/application/models/cerrar_sesion.php'; " class="button2">Salir</button>
  <?php
  include('../models/conexion.php');
  $query = "SELECT * FROM parqueadero";
  $resultado = mysqli_query($conexion, $query);
  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
  }
?>

  <div>
    <table class="table table-striped table_location">
      <thead class="table-header">
      <tr>
          <th class="column_1_size">ID</th>
          <th class="column_2_size">Nombre</th>
          <th class="column_3_size">Tipo</th>
          <th class="column_4_size">Ubicación</th>
          <th class="column_5_size">Horario</th>
          <th class="column_6_size">Tarifa</th>
          <th class="column_7_size">Fidelización</th>
          <th class="column_8_size">Cupos</th>
          <th class="column_9_size">Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
        <td><?php echo $fila['id_parqueadero']; ?></td>
          <td><?php echo $fila['nombre']; ?></td>
          <td><?php echo $fila['tipo']; ?></td>
          <td><?php echo $fila['ubicacion']; ?></td>
          <td><?php echo $fila['horario']; ?></td>
          <td><?php echo $fila['tarifa']; ?></td>
          <td><?php echo $fila['fidelizacion']; ?></td>
          <td><?php echo $fila['cupos']; ?></td>
          <td><?php echo $fila['estado']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
