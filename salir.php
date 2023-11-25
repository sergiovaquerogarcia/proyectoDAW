<?php
    session_start();
    $_SESSION = array(); 
    session_destroy();
    header("location:/beautyandshop/index.php");
?>

<!--<html lang="es">
    <head>
        <title>SALIR del SISTEMA</title>
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/styleFooter.css">
    </head>
<body>
    <p align="center">Gracias por su visita</p> <br><br>
    <p align="center"><a href="index.php"> Entrar de nuevo en la zona privada</a></p>
</body>
</html>-->
