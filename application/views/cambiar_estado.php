<?php
    session_start();

    if (!isset($_SESSION['empleado']) && !isset($_SESSION['admin'])) {
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
  <title>Cambiar estado</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css">
  <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/style_empleado.css">
</head>
<body class="button_container">
  <img src="/ProyectoParkea-Apache/images/parkea.png" class="image-parkea">
  <?php
if (isset($_SESSION['admin'])) {
    echo '<div>
              <button id="consultar_usuarios_button" class="button1">Consultar Usuarios</button>
              <script>
                  document.getElementById("consultar_usuarios_button").addEventListener("click", function() {
                      window.location.href = "consultar_usuarios.php";
                  });
              </script>
          </div>';
}
?>
  <div>
    <button id="registrar_usuario_button" class="button1">
        <?php
        if (isset($_SESSION['admin'])) {
            echo 'Editar estado de usuario';
        } elseif (isset($_SESSION['empleado'])) {
            echo 'Registrar nuevo usuario';
        }
        ?>
    </button>
    <script>
        document.getElementById("registrar_usuario_button").addEventListener("click", function() {
            <?php
            if (isset($_SESSION['admin'])) {
                echo 'window.location.href = "estado_usuario.php";';
            } elseif (isset($_SESSION['empleado'])) {
                echo 'window.location.href = "register.php";';
            }
            ?>
        });
    </script>
</div>
  <div>
    <button id="consultar_park_button" class="button1">Consultar parqueaderos</button>
    <script>
        document.getElementById("consultar_park_button").addEventListener("click", function() {
            <?php
            if (isset($_SESSION['empleado'])) {
                echo 'window.location.href = "empleado.php";';
            } elseif (isset($_SESSION['admin'])) {
                echo 'window.location.href = "admin.php";';
            }
            ?>
        });
    </script>
</div>
  <button id="editar_estado_button" class="button1" style="border: 2px solid black;">Editar Operatividad</button>
  <div>
    
  </div>
  <button onclick="window.location.href='/ProyectoParkea-Apache/application/models/cerrar_sesion.php'; " class="button2">Salir</button>
  <style>
  .form {
    position: absolute;
      top: 10vw;
      left: 35vw;
    width: 50vw;
    height: auto;
  } 
</style>
  <body>
    <div class="form">
    <form method="GET" action="">
  <input type="text" name="id" id="parqueadero-id" placeholder="ID parqueadero a buscar" required pattern="\d+" title="Ingrese solo números">
    <button type="submit" id="buscar_button">Buscar</button>
  </form>

  <?php
  include('../models/conexion.php');

  if (isset($_GET['id'])) {
    $idParqueadero = $_GET['id'];

    $query = "SELECT * FROM parqueadero WHERE id_parqueadero = $idParqueadero";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
      die("Error en la consulta: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado) > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Nombre</th><th>Ubicación</th><th>Estado</th><th>Acciones</th></tr>";

      while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $row['id_parqueadero'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['ubicacion'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>";
        echo "<form method='POST' action='codigo_estado.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id_parqueadero'] . "'>";
        echo "<button type='submit' name='cambiar_estado_button'>Cambiar Estado</button>";
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
</body>
</html>