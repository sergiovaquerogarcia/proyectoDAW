<?php 
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

    if(isset($_SESSION["dni"])) {
        $dni=$_SESSION["dni"];
    }
?>
   

<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Envios. BeautyAndShop</title>
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
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenEnvios jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Envíos</h1>
                <!--<p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>-->
            </div>
    </div>

    <section class="container-fluid">
        <div class="row">       
            <?php 
            if (isset($_REQUEST["nombreusuario"]) && (!empty($_REQUEST["nombreusuario"]))){
            ?>
                <div style="text-align:center; color:ffffff; background: blue; "><b>El Usuario <?php echo $_REQUEST["nombreusuario"] ?> se ha borrado correctamente.</b></div><br><br>
            <?php 
            }
            ?>
            <?php 
            if (isset($_REQUEST["claveOk"]) && $_REQUEST["claveOk"]=="si"){
            ?>
                <div style="text-align:center; color:ffffff; background: red; "><b>ATENCIÓN!!! Clave Modificada Correctamente.</b></div><br><br>
            <?php 
            }
            ?>
        
            <div class="col-sm-12 col-md-12 col-lg-10">
                <div class="quienes row g-0 ">
                    <div class="col-md-12">
                        <div class="card-body contenedor">
                            <h2 class="card-title">CONDICIONES DE VENTA</h2>
                            <p class="card-text text-justify">www.beautyandshop.net entrega pedidos en parte del territorio Español: 
                                España península y Baleares, con condiciones diferentes para cada uno de estos territorios. </p>

                                <p class="card-text text-justify">El plazo de servicio es de 4 a 9 días hábiles* a partir del siguiente 
                                día laboral de la fecha en la que se realiza el pedido en beautyandshop.net salvo que se indique otro 
                                plazo en el producto, se encuentre descatalogado o bien el proveedor tenga una rotura de stock y 
                                tenga que confeccionar el artículo en cuyo caso el plazo será entre 10 y 25 días hábiles y se 
                                le informará en cada pedido mediante email. En condiciones especiales (ej: periodo vacacional) 
                                se tendrá en cuenta como plazo de entrega el periodo indicado en los avisos de la página. 
                                Si el producto no aparece marcado como en stock se tomarán como referencia los plazos 
                                anteriormente indicados. </p>

                                <p class="card-text text-justify">Los pedidos serán enviados directamente desde www.beautyandshop.net 
                                o el proveedor a través de sus operados logísticos. </p>

                                <p class="card-text text-justify">Los gastos de envío serán gratuitos para todos los envíos a peninsulares 
                                superiores a 59€, para estos mismos pedidos el coste del envío a Baleares será de 5,90€. Si el pedido 
                                es inferior a 59€ los gastos de envío serán de 4.89€ IVA incluido (Península), para envíos a Baleares 
                                en estos casos los gastos de envío serán de 9,90€ IVA incluido. </p>

                                <p class="card-text text-justify">Los pedidos de los productos en stock se servirán de 4 a 9 días 
                                hábiles o en la fecha indicada por otro producto del mismo pedido, siempre que no se elija la 
                                forma de pago contrareembolso o transferencia y la dirección de envío sea peninsular. </p>

                                <p class="card-text text-justify">En condiciones normales sólo realizamos un envío por pedido. Si se 
                                realizó el pedido de varios productos con varias fechas de disponibilidad la fecha entrega del pedido, 
                                será la máxima fecha de entrega mas larga de los productos incluidos.  </p>

                                <p class="card-text text-justify">En el caso de no haber un responsable para la recepción del paquete 
                                en la dirección indicada de entrega, se dejará un aviso con un número de teléfono al que deberá 
                                llamar para confirmar a qué hora pueden entregarle la mercancía. La agencia de transporte guardará 
                                su paquete en sus almacenes aproximadamente 10/12 días antes de proceder a la devolución a nuestras 
                                instalaciones. En caso de solicitar la cancelación del pedido a través del apartado "Mis Pedidos" 
                                de la cuenta del cliente, se responderá a la solicitud en un máximo de 24h laborables. Una vez 
                                cancelado el pedido el reintegro se realizará en un plazo máximo de 14 días.  </p>

                                <p class="card-text text-justify">NOTA*: En períodos de temporada alta (Rebajas, Black Friday, Navidad, 
                                Reyes, etc), los pedidos pueden sufrir retrasos en las entregas por colapso de las agencias de transporte,
                                disponibilidades de producto, etc. Para solventar este problema, ponemos a su disposición un servicio 
                                de entrega en 48/72h con un coste adicional que podrá variar según la aproximación de la fecha del 
                                pedido a las fechas señaladas anteriormente.  </p>

                            <!--<img src="/beautyandshop/img/jumbotron2.jpg" class="img-fluid rounded-start contenedor" alt="imagen Quienes Somos">-->
                            <img class="img-fluid rounded mx-auto d-block" src="/beautyandshop/img/enviosPie.webp" alt="imagen pagina Envios">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>  
       </div>
    </section>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>   

</html>