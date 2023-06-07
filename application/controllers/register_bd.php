<?php

    include  '../models/conexion.php';

    $nombre = $_POST['name'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['email'];
    $fecha_nacimiento = $_POST['cumpleanios'];
    $nombre_tarjeta = $_POST['nombre_titular'];
    $numero_tarjeta = $_POST['numero_tarjeta'];
    $fecha_tarjeta = $_POST['fecha_vencimiento'];
    $cvv = $_POST['cvv'];

    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 

    $pass = generateRandomString();
    $pass2 = hash('sha1', $pass);

    function validarTarjeta($numero_tarjeta, $fecha_tarjeta, $cvv, $nombre_tarjeta) {
        $numeroTarjeta = $numero_tarjeta;
        $fechaVencimiento = $fecha_tarjeta;
        $cvv =  $cvv;
        $nombreTitular = $nombre_tarjeta;
      
        // Validar número de tarjeta (se debe implementar el algoritmo de Luhn)
        $numeroTarjetaValido = validarNumeroTarjeta($numeroTarjeta);
      
        // Validar fecha de vencimiento
        $fechaValida = false;
      
        $formatoValido = "/^(0[1-9]|1[0-2])([\/\s-]?)\d{2}$|^(0[1-9]|1[0-2])\d{2}$|^([1-9]|0[1-9]|1[0-2])(\s+)\d{2}$/"; // Expresión regular para validar los formatos mmyy, mm/yy, mm-yy, mm yy y mmyy
      
        if (preg_match($formatoValido, $fechaVencimiento)) {
          $separador = substr($fechaVencimiento, 2, 1); // Obtener el separador utilizado (puede ser /, espacio o -)
      
          $partes = explode($separador, $fechaVencimiento); // Dividir la fecha en mes y año
      
          $mes = intval($partes[0]);
          $anio = intval($partes[1]);
      
          $fechaActual = new DateTime();
          $mesActual = intval($fechaActual->format('m'));
          $anioActual = intval($fechaActual->format('y'));
      
          if ($anio >= $anioActual && $anio <= $anioActual + 10) {
            if ($anio === $anioActual) {
              $fechaValida = $mes >= $mesActual; // El mes debe ser mayor o igual al mes actual
            } else {
              $fechaValida = true; // La fecha es válida si el año es mayor o igual al actual
            }
          }
        }
      
        // Validar CVV (código de seguridad)
        $cvvValido = preg_match("/^\d{3}$/", $cvv); // Se permite un CVV de 3 dígitos
      
        // Validar nombre del titular
        $nombreValido = trim($nombreTitular) !== "";
      
        // Mostrar mensajes de validación
        if (!$numeroTarjetaValido) {
          echo '<script> alert("Número de tarjeta inválido. Ingrese solo el número, sin espacios ni guiones.");
          window.location = "/ProyectoParkea-Apache/application/views/register.php";
          </script>';
          exit(); 

        } else if (!$fechaValida) {
          echo '<script> alert("Fecha de vencimiento inválida. Verifica la fecha ingresada.");
          window.location = "/ProyectoParkea-Apache/application/views/register.php";
          </script>';
          exit(); 
          
        } else if (!$cvvValido) {
          echo '<script> alert("CVV inválido. Verifica el código de seguridad ingresado.");
          window.location = "/ProyectoParkea-Apache/application/views/register.php";
          </script>';
          exit(); 

        } else if (!$nombreValido) {
            echo '<script> alert("Por favor, ingrese el nombre del titular.");
            window.location = "/ProyectoParkea-Apache/application/views/register.php";
            </script>';
            exit(); 

        } 
      }
      
      function validarNumeroTarjeta($numero) {
        // Eliminar todos los espacios en blanco y guiones del número de tarjeta
        $numeroSinEspacios = str_replace(" ", "", $numero);
        $numeroSinGuiones = str_replace("-", "", $numeroSinEspacios);
      
        // Verificar que todos los caracteres sean dígitos
        if (!ctype_digit($numeroSinGuiones)) {
          return false;
        }
      
        $suma = 0;
        $doble = false;
      
        // Recorrer el número de tarjeta de derecha a izquierda
        for ($i = strlen($numeroSinGuiones) - 1; $i >= 0; $i--) {
          $digito = intval($numeroSinGuiones[$i]);
      
          if ($doble) {
            // Si el dígito está en una posición par, se duplica
            $digito *= 2;
      
            // Si el resultado de la duplicación es mayor o igual a 10, se suman los dígitos individuales
            if ($digito >= 10) {
              $digito = strval($digito);
              $digito = intval($digito[0]) + intval($digito[1]);
            }
          }
      
          $suma += $digito;
          $doble = !$doble;
        }
      
        // El número de tarjeta es válido si la suma total es divisible por 10
        return $suma % 10 === 0;
    }
      

    $query = "INSERT INTO usuario
    (nombre, apellido, fecha_nacimiento, rol, correo, contraseña, puntos, estado)
    VALUES('$nombre', '$apellido', '$fecha_nacimiento', 'cambio_pass', '$correo', '$pass2', 0, 1)";

    $query2 = "SELECT id_usuario from usuario where correo = '$correo' ";

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$correo' ");

    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
        echo '<script> alert("Ingrese un formato de correo valido.");
        window.location = "/ProyectoParkea-Apache/application/views/register.php";
        </script>';
        exit(); 
    }

    if(isset($conexion)){
        validarTarjeta($numero_tarjeta, $fecha_tarjeta, $cvv, $nombre_tarjeta);
    }

    if(mysqli_num_rows($verificar_correo) > 0 ){
        echo '<script> alert("Este correo ya se encuentra registrado, intenta con otro diferente.");
        window.location = "/ProyectoParkea-Apache/application/views/register.php";
         </script>';
         exit(); 
    }

    $ejecutar = mysqli_query($conexion, $query);
    $ejecutar2 = mysqli_query($conexion, $query2);
   
    $fila = mysqli_fetch_assoc($ejecutar2);
    $fila1  = $fila['id_usuario'];

    $query3 = "INSERT INTO tarjeta_credito
    ( id_usuario, num_tarjeta, csv, fecha_exp)
    VALUES( '$fila1', '$numero_tarjeta', '$cvv', '$fecha_tarjeta')";

    $ejecutar3 = mysqli_query($conexion, $query3);
    
    if($ejecutar){ 
        echo '<script> alert("Usuario almacenado exitosamente, su password es' . $pass . '");
        window.location = "/ProyectoParkea-Apache/index.php";
        </script>';
    }else{
        echo '<script> alert("Intente de nuevo, ocurrió un error.");
        window.location = "/ProyectoParkea-Apache/index.php";
        </script>';
    }
    mysqli_close($conexion); 
?>

