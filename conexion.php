<?php
     include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
   
    $encontrado = 0;
    $activo = 2;
    
    //echo "ENTRO A CONEXIÓN";
    if (isset($_REQUEST["email"])) {
        $email=$_REQUEST["email"];
    }
   
    if (isset($_REQUEST["clave"])) {
        $pwd=$_REQUEST["clave"];
    }

    $datosUsuarios = [];

    $datosUsuarios = llenarArray(0);
    $encontrado = buscarUsuario($email, $pwd, $datosUsuarios, $tipoUsuario, $activo, $cusu);
        
    if ($encontrado == 1 && $activo == 0) {
        header ("location:/beautyandshop/index.php?erroractivo=si");
    }
    else if ($encontrado == 1) {
            //Metemos al usuario en la sesión.
            session_start();
            $_SESSION["email"]=$email;
            //$_SESSION ["dni"]=$dni;
            $_SESSION ["cusu"]=$cusu;
            //echo "CUSU EN CONEXIÓN: " . $cusu;
            //echo "DNI: " . $dni;
            $_SESSION["tipoUsuario"]=$tipoUsuario;
            $_SESSION["tipo"]=$tipoUsuario;
            $_SESSION["clave"]=$pwd;
            $_SESSION["autentificado"] = "OK";

           
            //Comprobamos el tipo de Usuario que se ha logueado: Usuario, Administrador, Editor
            if ($tipoUsuario == 1) {
                //header ("Location: admin/zonaAdministrador.php?tipoUsuario=1&dni=" . $dni);
                header ("Location:/beautyandshop/index.php");
            }
            else if ($tipoUsuario == 3) {
                //header ("Location: usuario/zonaUsuario.php?tipoUsuario=3&dni=" . $dni);
                header ("Location:/beautyandshop/index.php");
            }
            else if ($tipoUsuario == 2) {
                header ("Location:/beautyandshop/index.php?");
            }
    
    }
    else {
        //echo "ENTRO AL ELSE";
        header ("location:/beautyandshop/index.php?errorusuario=si");
       /* echo "<html>";
        echo "<head>";
        echo "<title>Error de Autentificación</title>";
        echo "<link rel='stylesheet' href='css/estilos.css'>";
        echo "</head>";
        echo "<body>";
        echo "<h1 align='center'>RED SOCIAL TEAMS</h1>";
        echo "<h2 align='center'>Error de Autentificacion.</h2>";
        echo "<h4 align='center'>El Usuario " . $email . " no está registrado en el sistema.</h4><br>";
        echo "<p align='center'>¿Quieres pertenecer a nuestra Red Social? <a href='.php?tipo=3'>Registrarse</a></p>";
        echo "</body>";
        echo "</html>";*/
    }
?>
    
    

