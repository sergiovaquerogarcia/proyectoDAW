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
$_SESSION["carrito"][$codigo] = array_key_exists($codigo, $_SESSION["carrito"]) ? $_SESSION["carrito"][$codigo] + 1 : 1;
//header("Location: " . $_SERVER['HTTP_REFERER']);

if (isset($tipo)) {
    if ($tipo == 1) {
        header("Location:/beautyandshop/shop/shop.php?p=5");
    }
    else if ($tipo == 2) {
        header("Location:/beautyandshop/shop/shop.php?p=5");
    }
    else if ($tipo == 3) {
        header("Location:/beautyandshop/shop/shop.php?p=5");
    }
    
}
else {
    header("Location:/beautyandshop/shop/shop.php?p=5");
}
//header("Location:index.php?tipo=" . $tipo);

?>