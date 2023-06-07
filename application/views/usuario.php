<?php
    session_start();
    
    if (!isset($_SESSION['usuario'])) {
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
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Registro de Automóviles</title>
    <script src="/ProyectoParkea-Apache/assets/js/mapdata.js"></script>
    <script src="/ProyectoParkea-Apache/assets/js/countrymap.js"></script>


  

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    
    <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/stylePop.css">
    <link rel="stylesheet" href="/ProyectoParkea-Apache/assets/css/styleUsuario.css">

  </head>
  <body >
    <div>
        <div>
              <img src="/ProyectoParkea-Apache/images/parkea.png" class="image-parkea">
              <button id = "miCuenta" class="button1">Mi cuenta</button>
          </div>
          <div>
              <button id = "misPuntos" class="button1">Mis puntos parkea</button>
          </div>
          <div>
              <button id = "misReservas"class="button1">Mis reservas</button>
          </div>
          <button onclick="window.location.href='/ProyectoParkea-Apache/application/models/cerrar_sesion.php'; " class="button2">Salir</button> 
        </div>
    </div>

    <?php
    include('../models/conexion.php');
    $nombre = $_SESSION['usuario'];
    $query = "SELECT nombre FROM usuario where correo = '$nombre' "  ;
    $resultado = mysqli_query($conexion, $query);
    if (!$resultado) {
      die("Error en la consulta: " . mysqli_error($conexion));
    }
    $fila = mysqli_fetch_assoc($resultado)
    
      ?>
  
      <div class = "bienvenido">
        <h1>Bienvenido: <?php echo $fila['nombre']; ?> </h1> 
      </div>
    

    <div class= "formulario">
        <form action="/ProyectoParkea-Apache/application/controllers/login_usuario.php" method="POST" id="form_pe" name="formRegistro">

        <div class = "tiempo">
        <label for="horaIngreso">Digite hora de ingreso al parqueadero:</label> <br>
          <select id="hh">
            </select>
            :
            <select id="mm1">
            </select>

        </div>
        
        <div class = "tiempoSalida">
        <label for="horaSalida">Digite hora de salida:</label> <br>
          <select id="mm1S">
            </select>
            :
            <select id="ll1">
            </select>
          
        </div>
        <br>
        <div class ="parqueaderosDisp" >
          <label for="NombreL">Ubicacion:</label>
          
          <select id="parSelec">
            <option value="slec">Seleccione un parqueadero</option>
            <?php
              include('../models/conexion.php');
              $query = "SELECT nombre, estado FROM parqueadero";
              $resultado = mysqli_query($conexion, $query);
              if (!$resultado) {
                  die("Error en la consulta: " . mysqli_error($conexion));
              }

              // Recorrer cada fila de resultados
              while ($fila = mysqli_fetch_assoc($resultado)) {
                  // Obtener el valor del campo "nombre"
                  $nombre = $fila['nombre'];
                  $estado = $fila['estado'];

                  // Generar una opción para cada nombre si el estado es "disponible"
                  if ($estado == "Disponible") {
                      echo "<option value=\"$nombre\">$nombre</option>";
                  }
              }

              // Liberar la memoria del resultado
              mysqli_free_result($resultado);
            ?>
            </select>
        </div>

        <br>

        <div class= "placas">
        <label for="placa">Ingrese placa del vehículo</label>
        <div class="contenedor">
          <select id="letra1">
          </select>
          
          <select id="letra2">
          </select>
          
          <select id="letra3">
          </select>
          
          <select id="numero1">
          </select>
          
          <select id="numero2">
          </select>
          
          <select id="numero3">
          </select>
        </div>

        </div>
        <br>
         <div id = "infoPar"class = "parInfo" style="display: none;" >
            <label for="nom">Nombre parqueadero:</label>
            <textarea id = "nombre" readonly></textarea>
            <br>

            <label for="tpo">Tipo:</label>
            <textarea id = "tipo" readonly></textarea>
            <br>

            <label for="ub">Ubicación:</label>
            <textarea id = "ubicacion" readonly></textarea>
            <br>

            <label for="hor">Horario:</label>
            <textarea id = "horario" readonly></textarea>
            <br>
            
            <label for="tar">Tarifa:</label>
            <textarea id = "tarifa" readonly></textarea>
            COP por minuto
            <br>

            <label for="fi">Fidelización:</label>
            <textarea id = "fidelizacion" readonly></textarea>
            <br>

            <label for="fi">Cupos:</label>
            <textarea id = "cupos" readonly></textarea>
            <br>

            <label for="cu">Estado:</label>
            <textarea id = "estado" readonly></textarea>
         </div>
         <div>
        
         </div>
          <input id = "registro"style="display: none;" type="submit" value="Registrar">
         </form>
    </div>

    <button style="display: none;" id="btn-abrir-popup" class="btn-abrir-popup" onclick="calcularConfirmacion() " >Reservar</button>
    
    
    <?php
    include('../models/conexion.php');
    $datosReserva =  $_SESSION['usuario'];
    $query2 = "SELECT id_usuario, nombre, apellido, puntos FROM usuario where correo = '$datosReserva' "  ;
    $resultado2 = mysqli_query($conexion, $query2);
    if (!$resultado2) {
      die("Error en la consulta: " . mysqli_error($conexion));
    }
    $fila2 = mysqli_fetch_assoc($resultado2)
    
      ?>
      <div hidden>
      <textarea id = "id_usuario" readonly><?php $fila2['puntos'];?></textarea>
      </div>
   
        <div class="overlay" id="overlay">
          <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3>Datos de la reserva</h3>
            <h4>Informacion de su reserva</h4>
            <h4 id = "infoRes">
            Reserva a nombre de:
            <?php echo $fila2['nombre']." ".$fila2['id_usuario'];?>
            <div>
                <label for=""><br></label>
            </div> 
            Correo:
            <?php echo $datosReserva;?>
            <div>
                <label for=""><br></label>
            </div> 
            La reserva sumó:
            <h4 id = "puntos"> </h4>
            <div>
                <label for=""><br></label>
                </div> 
            Puntos:
            <?php $fila2['puntos'];?>
            <div>
                <label for=""><br></label>
                </div> 

            Tiempo reservado:
            <h4 id = "tiempoTotal"> </h4>
            <div>
                <label for=""><br></label>
                </div> 

            Total a pagar:
            <h4 id = "totalPago"> </h4>
            <div>
                <label for=""><br></label>
                </div> 
            </h4>
          </div>
        </div>
    
      <div id = "mapa" s >
          <div id="map"></div>
      </div>           
        

    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="/ProyectoParkea-Apache/assets/js/combo.js"></script>
<script src="/ProyectoParkea-Apache/assets/js/mostrar_datosP.js"></script>
<script src="/ProyectoParkea-Apache/assets/js/mapdata.js"></script>
<script src="/ProyectoParkea-Apache/assets/js/countrymap.js"></script>
<script src="/ProyectoParkea-Apache/assets/js/pop.js"></script>    
  
  </body>
</html>
