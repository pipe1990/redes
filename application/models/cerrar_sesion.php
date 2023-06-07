<?php
    session_start();
    session_destroy();
    header("location: /ProyectoParkea-Apache/index.php");
?>