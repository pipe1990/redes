<?php
    session_start();

   if (!isset($_SESSION['admin'])) {
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
  <title>Editar estado de usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css">
  <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/style_empleado.css">
</head>
<body class="button_container">
  <img src="/ProyectoParkea-Apache/images/parkea.png" class="image-parkea">
  <div>
  <button id="consultar_usuarios_button" class="button1">Consultar Usuarios</button>
  <script>
  document.getElementById("consultar_usuarios_button").addEventListener("click", function() {
    window.location.href = "consultar_usuarios.php";
  });
</script>
  </div>
  <div>
  <button id="consultar_usuarios_button" class="button1"style="border: 2px solid black;" >Editar estado de usuario</button>
  <script>
  document.getElementById("consultar_usuarios_button").addEventListener("click", function() {
    window.location.href = "consultar_usuarios.php";
  });
</script>
  </div>
  <div>
  <button id="consultar_park_button" class="button1" >Consultar parqueaderos</button>
  <script>
  document.getElementById("consultar_park_button").addEventListener("click", function() {
    window.location.href = "admin.php";
  });
</script>
  </div>
  <button id="editar_estado_button" class="button1">Editar Operatividad</button>
  <script>
  document.getElementById("editar_estado_button").addEventListener("click", function() {
    window.location.href = "cambiar_estado.php";
  });
</script>
  <div>
  <style>
  .form {
    position: absolute;
      top: 10vw;
      left: 35vw;
    width: 50vw;
    height: auto;
  } 
</style>
  <body class="form">
    <div class="form">
    <form method="GET" action="">
  <input type="text" name="id" id="usuario-id" placeholder="ID usuario a buscar" required pattern="\d+" title="Ingrese solo números">
    <button type="submit" id="buscar_button">Buscar</button>
    </form>
<?php
include('../models/conexion.php');

if (isset($_GET['id'])) {
  $idUsuario = $_GET['id'];

  $query = "SELECT * FROM usuario WHERE id_usuario = $idUsuario";
  $resultado = mysqli_query($conexion, $query);

  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
  }

  if (mysqli_num_rows($resultado) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Estado</th></tr>";

    while ($row = mysqli_fetch_assoc($resultado)) {
      echo "<tr>";
      echo "<td>" . $row['id_usuario'] . "</td>";
      echo "<td>" . $row['nombre'] . "</td>";
      echo "<td>" . $row['apellido'] . "</td>";
      echo "<td>" . $row['correo'] . "</td>";
      echo "<td>";

      if ($row['estado'] == 1) {
        echo "Activo";
      } elseif ($row['estado'] == 0) {
        echo "Inactivo";
      }

      echo "</td>";
      echo "<td>";
      echo "<form method='POST' action='codigo_estado.php'>";
      echo "<input type='hidden' name='id' value='" . $row['id_usuario'] . "'>";
      echo "<button type='submit' name='cambiar_estado_usuario_button'>Cambiar Estado</button>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No se encontraron resultados.";
  }
} else {
  echo "Ingresa un ID de parqueadero para realizar la búsqueda.";
}
?>
</div>

  <button onclick="window.location.href='/ProyectoParkea-Apache/application/models/cerrar_sesion.php'; " class="button2">Salir</button>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>

