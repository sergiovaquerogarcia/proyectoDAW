<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
      
if (isset($_REQUEST["codigo"])) {
        $codigo = $_REQUEST["codigo"];
        $codigoCategoria = $_REQUEST["codigo"];
    }

    if (isset($tipo)) {
        $tipo = $_REQUEST["tipo"];
    }
    else if (isset($tipoUsuario)) {
        $tipo = $_REQUEST["tipoUsuario"];
    }
        
    if (isset($_SESSION["cusu"])) {
        $cusu = $_SESSION["cusu"];
    }

    if (isset($_SESSION["tipoUsuario"])) {
        $tipo = $_SESSION["tipoUsuario"];
    }

    $cnn = conectar_db();
    $stmt =$cnn->prepare("SELECT * FROM categorias WHERE activo = 1 AND codigo = :codigo");
    $rows = $stmt->execute(array(":codigo"=>$codigo));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'categoria');

    if ($rows == 1) {
        While($fila = $stmt->fetch())  {
            $nombreCategoria = $fila->getNombre();
            $codCatPadre = $fila->getCodCatPadre();
        }
    }
?>
   

<html lang="es">
    <head>
        <title>Categorias. Beauty And Shop</title>
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
                <?php if (isset($_REQUEST["nombreusuario"]) && (!empty($_REQUEST["nombreusuario"]))){
                ?>
                    <div class="smsOk"><b>El Usuario <?php echo $_REQUEST["nombreusuario"] ?> se ha borrado correctamente.</b></div><br><br>
                <?php 
                }
                ?>
                <h2 class="h3 text-center text-warning">CATEGORIA: <?php echo $nombreCategoria ?></h2><hr><br>
                
                <?php
                //Limito la búsqueda de cada página
                $PAGS = 6;
                //inicializamos la pagina y el inicio para el límite de SQL
                $pagina = 1;
                $inicio = 0;
                //examino la página a mostrar y la muestro si existe
                if(isset($_GET["pagina"])){
                   $pagina = $_GET["pagina"];
                   $inicio = ($pagina - 1) * $PAGS;
                }
                ?>
                    <?php
                    echo '<ul class="row itemsTienda">';
                        $cnn = conectar_db();

                        if ($codCatPadre == 0) {
                            $stmt = $cnn->query("SELECT p.* FROM productos p
                                    INNER JOIN categorias c ON p.codigoCategoria = c.codigo
                                    WHERE p.activo = 1 AND c.activo = 1 AND (c.codigo = {$codigo} OR p.codigoCategoria IN (
                                    SELECT codigo FROM categorias WHERE codCatPadre = {$codigo} AND activo = 1))");
                                    $rows = $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');
                                    $num_total_registros = $stmt->rowCount();
                                    $total_paginas = ceil($num_total_registros / $PAGS);

                                    //LIMIT tiene dos argumentos, el primero es el registro por el que empezar los resultados y el segundo el número de resultados a recoger
                                    //$stmt = $cnn->prepare("SELECT * FROM productos LIMIT ".$inicio."," .$PAGS);
                                    $stmt = $cnn->query("SELECT p.* FROM productos p
                                        INNER JOIN categorias c ON p.codigoCategoria = c.codigo
                                        WHERE p.activo = 1 AND c.activo = 1 AND (c.codigo = {$codigo} OR p.codigoCategoria IN (
                                        SELECT codigo FROM categorias WHERE codCatPadre = {$codigo} AND activo = 1)) LIMIT " .$inicio .",".$PAGS);
                                    $rows = $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');
                        }
                        else {
                            
                            $stmt = $cnn->prepare("SELECT * FROM productos WHERE activo = 1 AND codigoCategoria = :codigoCategoria");
                            $stmt->execute(array(":codigoCategoria"=>$codigoCategoria));
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');
                        
                            //contar los registros y las páginas con la división entera
                            $num_total_registros = $stmt->rowCount();
                            //echo "Nº TOTAL REGISTROS" . $num_total_registros;
                            $total_paginas = ceil($num_total_registros / $PAGS);
                            //echo "Nº TOTAL PÁGINAS" . $total_paginas;
   
                            //LIMIT tiene dos argumentos, el primero es el registro por el que empezar los resultados y el segundo el número de resultados a recoger
                            $stmt = $cnn->prepare("SELECT * FROM productos WHERE activo = 1 AND codigoCategoria = :codigoCategoria LIMIT ".$inicio."," .$PAGS);
                            $rows = $stmt->execute(array(":codigoCategoria"=>$codigoCategoria));
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');
                        }

                        if ($rows == 1) {
                            while($fila = $stmt->fetch()) {
                                echo '<li class="col-lg-6">';
                                echo '<div class="itemTienda">';
                                    echo '<div style="border: 1px solid orangered;height:100%;padding:10px;"><img class="img-fluid rounded mx-auto d-block" src="/beautyandshop/Images/' .$fila->getImagen() . '"/>';
                                    echo "<h3>{$fila->getNombre()}</h3>";
                                    if ($fila->getDescuento() > 0 ) {
                                        $dto = round(($fila->getPrecio() * $fila->getDescuento())/100,2);
                                        $pvpConDto = $fila->getPrecio() - $dto;
                                        echo '<p class="neons3"> Ahora Dto: ' . $fila->getDescuento(). '%</p>';
                                        echo '<p class="descuento"> ' . number_format(round($pvpConDto, 2),2, ",", ".") .' €</p>';
                                    }
                                    else {
                                        echo '<p class="neons2">¡NUEVO PRODUCTO!</p>';
                                        echo '<p class="precio1">'. number_format(round($fila->getPrecio(), 2), 2, ",", ".") .' €</p>';
                                    }
                                    echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                                        echo '<a style="text-decoration:none;" href="/beautyandshop/shop/verProducto.php?codigo=' . $fila->getCodigo() . '"><button class="btn btn-dark text-center botonesCompra" type="button" value="ver"><i class="fa fa-eye"></i>VER</button></a>';
                                        echo '<a style="text-decoration:none;" href="/beautyandshop/shop/compra.php?codigo=' . $fila->getCodigo() . '"><button class="btn btn-warning text-center botonesCompra" type="button" value="add"><i class="fas fa-shopping-cart"></i></i>AÑADIR CESTA</button></a>';
                                    echo '</div></div>';
                                echo '</div>';
                            echo '</li>';   
                        }
                        echo '</ul>';
                        }
                        else {
                            echo "<div class='smsError'>No existen productos en esta Categoria.</div>";
                        }

                        echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                            if ($total_paginas > 1){
                                for ($i=1;$i<=$total_paginas;$i++){
                                    if ($pagina == $i) {
                                        //si muestro el índice de la página actual, no coloco enlace
                                        echo $pagina . " ";
                                    }
                                    else {
                                        //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
                                        echo "<a href='/beautyandshop/shop/categorias.php?tipo=" . $tipo . "&codigo=" . $codigo . "&pagina=". $i ."'>" . $i . "</a> ";
                                    }
                                }
                            }
                            //número de registros total, el tamaño de página y la página que se muestra
                        
                            echo "<br> Número de registros encontrados: " . $num_total_registros . "<br>";
                            echo "Se muestran páginas de " . $PAGS . " registros cada una<br>";
                            echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";
                        echo '</div>';
                    ?>
        
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>
        </div>   
    </section><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>

</html>