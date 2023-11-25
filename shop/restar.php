<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_REQUEST["codigo"])) {
    $codigo = $_REQUEST["codigo"];
}

if(isset($_REQUEST["tipo"])) {
    $tipo=$_REQUEST["tipo"];
}


if(isset($_REQUEST["tipoUsuario"])) {
    $tipo=$_REQUEST["tipoUsuario"];
}

if(isset($_SESSION["tipoUsuario"])) {
    $tipo=$_SESSION["tipoUsuario"];
}

    
if (!array_key_exists("carrito", $_SESSION)) {
     $_SESSION["carrito"] = [];
}


if (array_key_exists($codigo, $_SESSION["carrito"])) {
    $_SESSION["carrito"][$codigo] = $_SESSION["carrito"][$codigo] - 1;
}

if (($_SESSION["carrito"][$codigo]) == 0) {
    unset($_SESSION["carrito"][$codigo]);
}

if (isset($tipo)) {
    if ($tipo == 1) {
        header("Location:/beautyandshop/shop/carrito.php");
    }
    else if ($tipo == 2) {
        header("Location:/beautyandshop/shop/carrito.php");
    }
    else if ($tipo == 3) {
        header("Location:/beautyandshop/shop/carrito.php");
    }
    else if ($tipo == 3) {
        header("Location:/beautyandshop/shop/carrito.php");
    }
}
else {
    header("Location:/beautyandshop/shop/carrito.php");
}

?>
?>