<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
   
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }

    if (isset($_REQUEST["codigo"])) {
        $codigo = $_REQUEST["codigo"];
        $codigoCategoria = $_REQUEST["codigo"];
    }

?>
   

<html lang="es">
    <head>
        <title>Detalle Producto. BeautyAndShop</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/beautyandshop/img/logo.ico">

    <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    
        <!-- Fontawesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">

        <!-- Hojas de ESTILOS personalizadas-->
        <link rel="stylesheet" href="/beautyandshop/css/myStiles.css">
        <link rel="stylesheet" href="/beautyandshop/css/styleFooter.css">
        <link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleBotonUp.css">
    
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    <br>
    
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <?php
                $cnn = conectar_db();
                $stmt =$cnn->prepare("SELECT * FROM productos WHERE activo = 1 AND codigo = :codigo");
                $rows = $stmt->execute(array(":codigo"=>$codigo));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');
                while($fila = $stmt->fetch()) {
                    echo '<div class="container">';
                       echo '<div class="row">';
                            echo '<div class="col-sm-12 col-md-12 col-lg-6 text-center">';
                                echo '<img class="img-fluid rounded mx-auto d-block" src="/beautyandshop/Images/' .$fila->getImagen() . '" width="100%" height="120%" />';
                            echo '</div>';
                            echo '<div class="col-sm-12 col-md-12 col-lg-6 text-center">';
                                echo "<h3 class='verProductoTitulo'>{$fila->getNombre()}</h3>";
                                echo '<p class="verProductoDescripcion">'.$fila->getDescripcion().'</p>';
                    
                                if ($fila->getDescuento() > 0 ) {
                                    $dto = round(($fila->getPrecio() * $fila->getDescuento())/100,2);
                                    $pvpConDto = $fila->getPrecio() - $dto;
                                    echo '<p class="verProductoTituloPvp">ANTES</p>';
                                    echo '<h3 class="VerProductoPrecio">' .round($fila->getPrecio(), 2).' EUR</h3>';
                                    echo '<h4 class="neons">DESCUENTO </h4>';
                                    echo '<p class="verProductoDescuento1">' . $fila->getDescuento(). '%</p>';
                                    echo '<p class="verProductoTituloPvp">AHORA</p>';
                                    echo '<p class="verProductoDescuento2"> ' . round($pvpConDto, 2).' EUR</p>';
                                }
                                else {
                                    echo '<h4 class="neons1">¡NUEVO PRODUCTO!</h4>';
                                    echo '<p class="verProductoTituloPvp">AHORA</p>';
                                    echo '<p class="verProductoDescuento2"">'.round($fila->getPrecio(), 2).' EUR</p>';
                                }
                            echo '</div>';
                            echo '<div class="col-12">';
                                echo '<a style="text-decoration: none;" href="/beautyandshop/shop/compra.php?codigo=' . $fila->getCodigo() . '"><button class="btn btn-block btn-warning text-center botonesCompra" type="button" value="add"><i class="fas fa-shopping-cart"></i></i>AÑADIR CESTA</button></a>';
                                //echo '<a href="/beautyandshop/shop/compra.php?codigo=' . $fila->getCodigo() . '"><button class="btn btn-block btn-warning text-center botonesCompra" type="button" value="add"><i class="fas fa-shopping-cart"></i></i>AÑADIR CESTA</button></a>';
                            echo '</div>';   
                        echo '</div>';
                    echo '</div>';
                }
            ?> 
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>  
        </div>
    </section><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>