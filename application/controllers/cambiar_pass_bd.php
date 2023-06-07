<?php
    include  '../models/conexion.php';
    
    $correo = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $pass_enc = hash('sha1', $pass);

    $query = "UPDATE usuario
    SET  rol='usuario', contraseña='$pass_enc'
    WHERE correo = '$correo' ";

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$correo' ");

    if(mysqli_num_rows($verificar_correo) == 0 ){
        echo '<script> alert("Este correo no se encuentra.");
        window.location = "/ProyectoParkea-Apache/application/views/cambiar_pass.php";
         </script>';
         exit(); 
    }       

    if($pass != $pass2){
        echo '<script> alert("Las contraseñas no coinciden.");
        window.location = "/ProyectoParkea-Apache/application/views/cambiar_pass.php";
        </script>';
        exit(); 
    }

    if(strlen($pass) > 8 && strlen($pass) < 5 ){
        echo '<script> alert("Ingrese una contraseña de máximo 8 caracteres y mínimo 5.");
        window.location = "/ProyectoParkea-Apache/application/views/cambiar_pass.php";
        </script>';
        exit(); 
    }

    if(!preg_match('`[a-z]`',$pass)){
        echo '<script> alert("La contraseña debe tener al menos una letra minúscula.");
        window.location = "/ProyectoParkea-Apache/application/views/cambiar_pass.php";
        </script>';
        exit();
    }

    if(!preg_match('`[A-Z]`',$pass)){
        echo '<script> alert("La contraseña debe tener al menos una letra mayúscula.");
        window.location = "/ProyectoParkea-Apache/application/views/cambiar_pass.php";
        </script>';
        exit();
    }

    if (!preg_match('`[0-9]`',$pass)){
        echo '<script> alert("La contraseña debe tener al menos un número.");
        window.location = "/ProyectoParkea-Apache/application/views/cambiar_pass.php";
        </script>';
        exit();
    }

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '<script> alert("Contraseña cambiada exitosamente.");
        window.location = "/ProyectoParkea-Apache/application/models/cerrar_sesion.php";
         </script>';
    }else{
        echo '<script> alert("Intente de nuevo, ocurrió un error.");
        window.location = "/ProyectoParkea-Apache/application/models/cerrar_sesion.php";
         </script>';
    }
    mysqli_close($conexion);



?>