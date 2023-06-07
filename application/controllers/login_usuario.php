<?php

    session_start();

    include '../models/conexion.php';

    $correo = $_POST['email'];
    $pass = $_POST['password'];
    $pass = hash('sha1', $pass);
    define("CLAVE_SECRETA", "6LfXqlMmAAAAAASF8UrlfoMlAlOGV5VWrCxdyzRN");

    if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
        echo '<script> alert("Realice el captcha.");
                window.location = "/ProyectoParkea-Apache/index.php";
                </script>';
                exit();
    }

    $token = $_POST["g-recaptcha-response"];
    $verificado = verificarToken($token, CLAVE_SECRETA);

    $query = "SELECT * FROM usuario where correo = '$correo' and contraseña = '$pass' ";
    $validar_login = mysqli_query($conexion,$query);
    
  if(mysqli_num_rows($validar_login) > 0 ) {
        $query2 = "SELECT rol FROM usuario where correo = '$correo' and contraseña = '$pass' ";
        $validar_rol = mysqli_query($conexion, $query2);
        $fila = mysqli_fetch_assoc($validar_rol);
       
        if($fila['rol'] == "admin"){
            if($verificado){
                $_SESSION['admin'] = $correo;
                header("location:/ProyectoParkea-Apache/application/views/admin.php");
                exit();
            }
             
        }else if($fila['rol'] == "usuario"){
            if($verificado){
                $_SESSION['usuario'] = $correo;
                header("location:/ProyectoParkea-Apache/application/views/usuario.php");
                exit();
            }
            
        }else if($fila['rol'] == "empleado"){
            if($verificado){
                $_SESSION['empleado'] = $correo;
                header("location:/ProyectoParkea-Apache/application/views/empleado.php");
                exit();
            }
        
        }else if($fila['rol'] == "cambio_pass"){
            if($verificado){
                $_SESSION['pass'] = $correo;
                header("location:/ProyectoParkea-Apache/application/views/cambiar_pass.php");
                exit();
            }
        }

    }else{
       echo '<script> alert("El Usuario no existe, por favor verifique los datos.");
            window.location = "/ProyectoParkea-Apache/index.php";
            </script>';
        exit();
    }

    function verificarToken($token, $claveSecreta){
   
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), 
        ),
    );

    $contexto = stream_context_create($opciones);
    $resultado = file_get_contents($url, false, $contexto);
    
    if ($resultado === false) {
        return false;
    }

    echo $resultado;
    $resultado = json_decode($resultado);
    $pruebaPasada = $resultado->success;
    return $pruebaPasada;
}

?>
