<?php

    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_REQUEST["codigo"])) {
        $codigo = $_REQUEST["codigo"];
    }

    
   /* if(isset($_REQUEST["tipo"])) {
        $tipo=$_REQUEST["tipo"];
    }

    if(isset($_REQUEST["tipoUsuario"])) {
        $tipo=$_REQUEST["tipoUsuario"];
    }

    if(isset($_SESSION["tipoUsuario"])) {
        $tipo=$_SESSION["tipoUsuario"];
        $tipoUsuario=$_SESSION["tipoUsuario"];
    }
    else $tipo = 0;*/

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
   
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }

    if (isset($_SESSION["carrito"])) {
            $ids = implode( ', ', array_keys($_SESSION["carrito"]));
            $sql = "SELECT * FROM productos WHERE codigo IN ($ids);";
    }
?>

<html lang="es">
    <head>
        <title>Cesta Compra. BeautyAndShop</title>
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
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenCarrito jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Ver Carrito</h1>
                <!--<p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>-->
            </div>
    </div>
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <h2 class="h3 text-center text-warning">RESUMEN DE SU CARRITO DE LA COMPRA</h2><hr><br>
                <div class='table-responsive'>
                <table>
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>DESCUENTO</th>
                            <th>CANTIDAD</th>
                            <th>SUBTOTAL</th>
                            <th>BORRAR </th>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION["carrito"]) && count($_SESSION['carrito']) != 0) {

                            $total = 0;
                            $cnn = conectar_db();
                            foreach ($cnn->query($sql, PDO::FETCH_ASSOC) as $producto ) {
                                $unidades = $_SESSION["carrito"][$producto["codigo"]];
                                if ($unidades > 0) {
                                    if ($producto["descuento"] > 0 ) {
                                        //$dto = number_format(round($subtotal, 2), 2, ",", ".");
                                        $dto = round(($producto["precio"] * $producto["descuento"])/100,2);
                                        $pvpConDto = $producto["precio"] - $dto;
                                        $subtotal = $unidades * $pvpConDto;
                                    }
                                    else {
                                        $subtotal = $unidades * $producto["precio"];
                                    }

                                    
                                    $total += $subtotal;
                        ?>
                                    <tr>
                                        <td><a href='/beautyandshop/shop/verProducto.php?codigo=<?php echo $producto['codigo']; ?>'><?php echo $producto["codigo"]; ?></a></td>
                                        <!--<td><?php echo $producto["codigo"]; ?></td>-->
                                        <td><?php echo $producto["nombre"]; ?></td>
                                        <td><?php echo number_format(round($producto["precio"], 2), 2, ",", "."); ?><span class="moneda">€</span></td>
                                        <td><?php echo $producto["descuento"]; ?><span class="moneda">%</span></td>
                                        <!--<td><?php //echo $unidades; ?></td>-->
                                        <td style="width: 20%">
                                            <div class="input-group">
                                            
                                                <span class="input-group-btn">
                                                    <a class="btn btn-danger btn-number" href="/beautyandshop/shop/restar.php?codigo=<?= $producto["codigo"]; ?>">-</a>
                                                    
                                                </span>
                                                <input type="text" id="cantidad" name="cantidad" class="form-control input-number text-center" min="1" max="100" value="<?= $unidades; ?>">
                                                <span class="input-group-btn">
                                                    <a class="btn btn-success btn-number" href="/beautyandshop/shop/sumar.php?codigo=<?= $producto["codigo"]; ?>">+</a>
                                                </span>       
                                
                                            </div>
                               
                                        </td>
                                        <td><?php echo number_format(round($subtotal, 2), 2, ",", "."); ?><span class="moneda">€</span></td>
                                        <td><a href='/beautyandshop/shop/eliminar.php?codigo=<?php echo $producto['codigo']; ?>'><img src='/beautyandshop/img/borrar.jpg' /></a></td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                            else echo "<div class='smsError'> SU CARRITO ESTÁ VACIO.</div>";
                        ?>
                    </tbody>
                </table>
                </div>
                <?php 
                 if (isset($_SESSION["carrito"]) && count($_SESSION['carrito']) != 0) {
                ?>
                    <h2><strong>TOTAL: <?php echo number_format(round($total, 2), 2, ",", ".");?> €</strong></h2>
                <?php
                }
                ?>

                <div class="text-center">
                    <?php
                    if ($tipo == 1) {
                        echo '<a class="btn btn-dark text-center botonesCompra" href="/beautyandshop/shop/shop.php">SEGUIR COMPRANDO</a>';
                    }
                    else if ($tipo == 2) {
                        echo '<a class="btn btn-dark text-center botonesCompra" href="/beautyandshop/shop/shop.php">SEGUIR COMPRANDO</a>';    
                    }
                    else if ($tipo == 3) {
                        echo '<a class="btn btn-dark text-center botonesCompra" href="/beautyandshop/shop/shop.php">SEGUIR COMPRANDO</a>';
                    }
                    else {
                        echo '<a class="btn btn-dark text-center botonesCompra" href="/beautyandshop/shop/shop.php">SEGUIR COMPRANDO</a>';
                    }

                    ?>


                    <!--<a class="btn btn-primary" href="/tiendaPeluqueria/index.php">Seguir comprando</a>-->
                    <?php
                    if (isset($_SESSION["carrito"]) && count($_SESSION['carrito']) != 0) {
                    
                        if (isset($_REQUEST["tipo"])) {
                            if ($tipo == 1) {
                                echo '<a class="btn btn-warning text-center botonesCompra" href="/beautyandshop/shop/realizar-pago.php">FINALIZAR COMPRA</a>';
                            }
                            else if ($tipo == 2) {
                                echo '<a class="btn btn-warning text-center botonesCompra" href="/beautyandshop/shop/realizar-pago.php">FINALIZAR COMPRA</a>';    
                            }
                            else if ($tipo == 3) {
                                echo '<a class="btn btn-warning text-center botonesCompra" href="/beautyandshop/shop/realizar-pago.php">FINALIZAR COMPRA</a>';
                            }
                        }
                        else {
                            echo '<a class="btn btn-warning text-center botonesCompra" href="/beautyandshop/shop/realizar-pago.php">FINALIZAR COMPRA</a>';
                        }
                    
                    }
                    ?>
                </div>
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