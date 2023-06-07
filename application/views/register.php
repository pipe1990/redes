
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <title>Registrarse</title>
  <div>
    <img src="/ProyectoParkea-Apache/images\parkea.png">
  </div>
  <img src="/ProyectoParkea-Apache/images\user.png" class="image-user">
  <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/style.css">
</head>
<img src="/ProyectoParkea-Apache/images\logo.png" class="image-logo">

<body class="register-title ">
    <div class="register-all">
            <h1 class="title">Registrarse</h1>
            <form  action="/ProyectoParkea-Apache/application/controllers/register_bd.php" method="POST">
              <div> 
                <input type="text" name="name" required placeholder="Nombre">
                <input type="text" name="apellido" required placeholder="Apellido">
              </div>
              <div>
                <label for=""><br></label>
                </div>
              <div>
              <input type="textEmail" name="email" required placeholder="E-Mail">
              </div>
              </div>
              <div>
                <label for=""><br></label>
              </div>
              <div>
              Fecha nacimiento: <input type="date" name="cumpleanios" step="1" min="1980-01-01" max="2023-12-31" value="2000-01-01">
              </div>
              <div>
                <label for=""><br></label>
              </div>
              <h1 class="title">Tarjeta de crédito</h1>
              <img src="/ProyectoParkea-Apache/images\cards.png" class="image-cards">
              <div>
              
              </div>
              <input type="text" id="nombre_titular" placeholder="Nombre del Titular" name="nombre_titular" required>
              <br><br>
              <input type="text" id="numero_tarjeta" placeholder="Número de Tarjeta" name="numero_tarjeta" required pattern="\d{13,16}" title="Ingrese un número de tarjeta válido de 13 a 16 dígitos">
              <br><br>
              <input type="text" id="fecha_vencimiento" placeholder="Fecha de Vencimiento" name="fecha_vencimiento" required placeholder="MM/YY o MMYY">
              <br><br>
              <input type="text" id="cvv" placeholder="CVV" name="cvv" required pattern="\d{3}" title="Ingrese un CVV válido de 3 dígitos">
              <br><br>
              <input type="submit"  value="Registrarse">
            </form>
            <span class="text-footer">¿Ya te has registrado?
                <a href="/ProyectoParkea-Apache/index.php">Iniciar Sesión</a>
            </span>
    </div>
</body>
</html>

