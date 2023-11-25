<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }
    if(isset($_SESSION["tipo"])) {
        $tipoUsuario = $_SESSION["tipo"];
        $tipo = $_SESSION["tipo"]; 
    }

    if (isset($_REQUEST["textoBuscar"])) {
        $textoBuscar = $_REQUEST["textoBuscar"];
       
        $textoBuscar = strtoupper($_REQUEST["textoBuscar"]);
        //echo $textoBuscar;
    }
?>

<html lang="es">
    <head>
        <title>Resultados Búsqueda. Beauty And Shop</title>
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
                <h3 class="h3 text-center text-warning">Resultado de la Búsqueda:<span class="text-dark"><?php echo $textoBuscar ?></span></h3><hr><br>
                <?php
                //Limito la búsqueda de cada página
                $PAGS = 6;
                //inicializamos la pagina y el inicio para el límite de SQL
                $pagina = 1;
                $inicio = 0;
                //examino la página a mostrar y la muestro si existe
                
                if(isset($_REQUEST["pagina"])){
                    $pagina = $_REQUEST["pagina"];
                    
                    $inicio = ($pagina - 1) * $PAGS;
                    
                }
       

    //if(isset($_REQUEST["enviar"])) {
    if (isset($_REQUEST["textoBuscar"])) {
        echo '<ul class="row itemsTienda">';
                $cnn = conectar_db();
                $stmt = $cnn->prepare("SELECT * FROM productos WHERE nombre LIKE '%$textoBuscar%' OR descripcion LIKE '%$textoBuscar%'");
                $stmt->execute();

                //contar los registros y las páginas con la división entera
                $num_total_registros = $stmt->rowCount();
                $total_paginas = ceil($num_total_registros / $PAGS);
                           
                //LIMIT tiene dos argumentos, el primero es el registro por el que empezar los resultados y el segundo el número de resultados a recoger
                $stmt = $cnn->prepare("SELECT * FROM productos  WHERE nombre LIKE '%$textoBuscar%' OR descripcion LIKE '%$textoBuscar%' LIMIT ".$inicio."," .$PAGS);
                $stmt->execute();
                while($fila = $stmt->fetch()) {
                    echo '<li class="col-lg-6">';
                        echo '<div class="itemTienda">';
                            echo '<img class="rounded mx-auto d-block" src="/beautyandshop/Images/' .$fila['imagen'] . '" width="300" height="300" />';
                            echo "<h3>{$fila['nombre']}</h3>";
                            if ($fila["descuento"] > 0 ) {
                                $dto = round(($fila["precio"] * $fila["descuento"])/100,2);
                                $pvpConDto = $fila["precio"] - $dto;
                                echo '<p class="neons3"> Ahora Dto: ' . $fila["descuento"]. '%</p>';
                                echo '<p class="descuento"> ' . number_format(round($pvpConDto, 2),2, ",", ".") .' €</p>';
                            }
                            else {
                                echo '<p class="neons2">¡NUEVO PRODUCTO!</p>';
                                echo '<p class="precio1">'. number_format(round($fila['precio'], 2), 2, ",", ".") .' €</p>';
                            }
                            
                            echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                                echo '<a href="/beautyandshop/shop/verProducto.php?codigo=' . $fila['codigo'] . '"><button class="btn btn-dark text-center botonesCompra" type="button" value="ver"><i class="fa fa-eye"></i>VER</button></a>';
                                echo '<a href="/beautyandshop/shop/compra.php?codigo=' . $fila['codigo'] . '"><button class="btn btn-warning text-center botonesCompra" type="button" value="add"><i class="fas fa-shopping-cart"></i></i>AÑADIR CESTA</button></a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</li>';  
                }
                    echo '</ul>';
                    
                //muestro los distintos índices de las páginas, si es que hay varias páginas
                echo '<div class="col-sm-12 col-md-12 col-lg-12 text-center">';
                    if ($total_paginas > 1){
                        for ($i=1;$i<=$total_paginas;$i++){
                            if ($pagina == $i) {
                                //si muestro el índice de la página actual, no coloco enlace
                                echo $pagina . " ";
                            }
                            else {
                                //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
                                //echo "<a href='buscarProducto.php?pagina=". $i ."'>" . $i . "</a> ";
                                echo "<a href='/beautyandshop/buscarProducto.php?textoBuscar=" . $textoBuscar . "&pagina=". $i ."'>" . $i . "</a> ";
                            }
                        }
                    }
                    //número de registros total, el tamaño de página y la página que se muestra
                    echo "<br> Número de registros encontrados: " . $num_total_registros . "<br>";
                    echo "Se muestran páginas de " . $PAGS . " registros cada una<br>";
                    echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";
                echo '</div>';
        
    }
    else if ($pagina >= 1 &&  isset($_REQUEST["textoBuscar"]))  {
        echo '<ul class="row items">';
                $cnn = conectar_db();
                $stmt = $cnn->prepare("SELECT * FROM productos WHERE nombre LIKE '%$textoBuscar%' OR descripcion LIKE '%$textoBuscar%'");
                $stmt->execute();

                //contar los registros y las páginas con la división entera
                $num_total_registros = $stmt->rowCount();
                $total_paginas = ceil($num_total_registros / $PAGS);
                           
                //LIMIT tiene dos argumentos, el primero es el registro por el que empezar los resultados y el segundo el número de resultados a recoger
                $stmt = $cnn->prepare("SELECT * FROM productos  WHERE nombre LIKE '%$textoBuscar%' OR descripcion LIKE '%$textoBuscar%' LIMIT ".$inicio."," .$PAGS);
                $stmt->execute();
                while($fila = $stmt->fetch()) {
                    echo '<li class="col-lg-6">';
                        echo '<div class="item">';
                            //echo '<img class="img-fluid mx-auto d-block" src="Images/1111.jpg" width="200" height="200" />';
                                echo '<img class="img-fluid mx-auto d-block" src="/beautyandshop/Images/' .$fila['imagen'] . '" width="200" height="200" />';
                                echo "<h3>{$fila['nombre']}</h3>";
                                echo '<p class="description_short">'.$fila['descripcion'].'</p>';
                                    
                                if ($fila["descuento"] > 0 ) {
                                    $dto = round(($fila["precio"] * $fila["descuento"])/100,2);
                                    $pvpConDto = $fila["precio"] - $dto;
                                    echo '<p class="precio"> Antes: '.round($fila['precio'], 2).' €</p>';
                                    echo '<p class="descuento"> Ahora Dto: ' . $fila["descuento"]. '%</p>';
                                    echo '<p class="descuento"> ' . round($pvpConDto, 2).' €</p>';
                                }
                                else {
                                    echo '<p class="descuento2">¡NUEVO PRODUCTO!</p>';
                                    echo '<p class="descuento1">sin descuento</p>';
                                    echo '<p class="precio1">'.round($fila['precio'], 2).' €</p>';
                                }
                                echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                                        echo '<a href="/beautyandshop/shop/verProducto.php?codigo=' . $fila['codigo'] . '"><button class="btn btn-dark text-center botonesCompra" type="button" value="ver"><i class="fa fa-eye"></i>VER</button></a>';
                                        echo '<a href="/beautyandshop/shop/compra.php?codigo=' . $fila['codigo'] . '"><button class="btn btn-warning text-center botonesCompra" type="button" value="add"><i class="fas fa-shopping-cart"></i></i>AÑADIR CESTA</button></a>';
                                    echo '</div>';
                            echo '</div>';
                        echo '</li>';  
                }
                    echo '</ul>';
                    
                echo '<div class="col-sm-12 col-md-12 col-lg-12 text-center">';
                    //muestro los distintos índices de las páginas, si es que hay varias páginas
                    if ($total_paginas > 1){
                        for ($i=1;$i<=$total_paginas;$i++){
                            if ($pagina == $i) {
                                //si muestro el índice de la página actual, no coloco enlace
                                echo $pagina . " ";
                            }
                            else {
                                //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
                                //echo "<a href='buscarProducto.php?pagina=". $i ."'>" . $i . "</a> ";
                                echo "<a href='/beautyandshop/buscarProducto.php?textoBuscar=" . $textoBuscar . "&pagina=". $i ."'>" . $i . "</a> ";
                            }
                        }
                    }
                    //número de registros total, el tamaño de página y la página que se muestra
                    echo "<br> Número de registros encontrados: " . $num_total_registros . "<br>";
                    echo "Se muestran páginas de " . $PAGS . " registros cada una<br>";
                    echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";
                echo '</div>';
        //}
    }
?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>    
            </div>  
        </div>
    </section><br><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>