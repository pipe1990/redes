<?php
    session_start();

    if (!isset($_SESSION['pass'])) {
       echo '<script>
        alert("Por Favor inicie sesión.") 
        window.location = "/ProyectoParkea-Apache/index.php";
       </script>';
       session_destroy();
       die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <title>Cambio de contraseña</title>
  <div>
    <img src="/ProyectoParkea-Apache/images\parkea.png">
  </div>
  <img src="/ProyectoParkea-Apache/images\user.png" class="image-user">
  <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/style.css">
</head>
<img src="/ProyectoParkea-Apache/images\logo.png" class="image-logo">

<body class="register-title ">
    <div class="register-all">
            <h1 class="title">Cambia tu contraseña!</h1>

            <form  action="/ProyectoParkea-Apache/application/controllers/cambiar_pass_bd.php" method="POST">
        
              <a>Recuerda que la contraseña deberá tener máximo ocho <br></a>
              <a>(8) caracteres de longitud y mínimo cinco (5).<br></a>
              <a>La contraseña deberá contener mínimo un número, una<br></a>
              <a>letra mayúscula y una letra minúscula.</a>
            <div>
              <label for=""><br></label>
            </div>
            <div>
              <input type="text" name="email" required placeholder="Correo">
            </div>
            <div>
                <label for=""><br></label>
            </div>
            <div>
              <input type="password" name="pass" required placeholder="Constraseña nueva">
            </div>
            <div>
                <label for=""><br></label>
            </div>
            <div>
              <input type="password" name="pass2" required placeholder="Constraseña nueva">
            </div>
            <div>
                <label for=""><br></label>
            </div>
            <input type="submit" value="Listo">

            </form>
      </div>

</body>

</html>