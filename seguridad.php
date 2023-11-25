<?php
    //Inicio la sesión 
    session_start();

    //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
    if ($_SESSION['autentificado'] != "OK") {
        //si no existe, envío a la página de autentificación 
        header("Location:/beautyandshop/index.php");
        //ademas salgo de este script
        exit();
    }
?>
