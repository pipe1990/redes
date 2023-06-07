<?php

  session_start();
  if (isset($_SESSION['usuario'])) {
    header("location: /ProyectoParkea-Apache/application/views/usuario.php");

  }else if(isset($_SESSION['admin'])){
    header("location: /ProyectoParkea-Apache/application/views/admin.php");

  }else if(isset($_SESSION['empleado'])){
    header("location: /ProyectoParkea-Apache/application/views/empleado.php");
    
  }else if(isset($_SESSION['pass'])){
    header("location: /ProyectoParkea-Apache/application/views/cambiar_pass.php");
    
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inicio de sesión</title>
  <div>
    <img src="images\parkea.png">
  </div>
  <img src="images\user.png" class="image-user">
  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<style>
    .bienvenido {
    position: absolute;
      top: 0%;
      left: 3.5%;
    width: 15vw;
    height: auto;
  }
</style>
<img src="images\bienvenido.png" class="bienvenido">
<img src="images\logo.png" class="image-logo">

<body class="login-title">
            <h1 class="title">Iniciar Sesión</h1>

            <form action="/ProyectoParkea-Apache/application/controllers/login_usuario.php" method="POST">
                <div>
                <input type="text" name="email" required placeholder="Correo">
                </div>
                <div>
                <label for=""><br></label>
                </div>
                <div>
                <input type="password" name="password" required placeholder="Contraseña">
                </div>
                <div>
                <label for=""><br></label>
                </div>   
                <style>
                    .text-xs-center {
                        text-align: center;
                    }

                    .g-recaptcha {
                        display: inline-block;
                    }
                </style>
                <div class="text-xs-center">
                <div class="g-recaptcha" required data-sitekey="6LfXqlMmAAAAAPwxl0ybw4QYiop7V9Z26VmLmbsZ"></div>
                </div>
                <input type="submit" value="Iniciar">
                
            </form>

            <span class="text-footer">¿Aún no te has regsitrado?
                <a href="./application/views/register.php">Registrate</a>
            </span>

</body>
</html>

