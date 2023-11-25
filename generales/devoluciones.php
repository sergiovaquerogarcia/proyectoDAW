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
   
    <title>Devoluciones. BeautyAndShop</title>
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
    <script src="/beautyandshop/js/botonUp.js"></script>
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenDevoluciones jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Devoluciones</h1>
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
                            <h2 class="card-title">DEVOLUCIONES</h2>
                            <p class="card-text text-justify">Para realizar cambios dispones de 30 días naturales,  
                                llevando o enviando el paquete a través de tus propios medios (corriendo el cliente con los gastos) 
                                a la dirección BEAUTY AND SHOP, S.L., C/ Fuerteventura, nº 145, CP 48001 Madrid (Madrid), 
                                sin ninguna demora indebida y, en cualquier caso, a más tardar en el plazo de 14 días naturales 
                                a partir de la fecha en que nos comuniques la decisión de cambios de los productos. También tienes la 
                                opción de enviar el paquete llevándolo a una oficina de MRW con un coste de 5,90€ sobre el reintegro 
                                a realizar o cupón a enviar, o bien puedes solicitar una recogida en tu domicilio o el punto de 
                                entrega que elijas con un coste de 9,90€ sobre el reintegro a realizar o cupón a enviar. </p>

                            <p class="card-text text-justify">No se atenderán devoluciones de productos usados o manipulados. 
                                En ningún caso se atenderán devoluciones de artículos lavados. </p>

                            <p class="card-text text-justify">Recuerde que debe empaquetar el pedido con todos los elementos 
                                originales del artículo a devolver y este no debe haber sido utilizado ni manipulado. Deberá 
                                incluir cualquier elemento promocional (en caso de existir) que hubiera acompañado al pedido. 
                                Si no se cumple alguno de estos requisitos se desestimará la devolución, debiendo el cliente 
                                hacerse cargo de los portes de retorno del artículo. Tenga en cuenta que trabajamos con artículos 
                                de uso personal, por lo que debemos ser extremadamente escrupulosos con productos que han podido 
                                ser usados. </p>

                            <p class="card-text text-justify">Para devoluciones desde Islas Baleares sólo será válida la entrega 
                                del paquete en oficina de correos con un coste de 5,90€ sobre el reintegro a realizar o cupón a 
                                enviar, o el envío a través de medios propios (corriendo el cliente con los gastos). </p>

                            <p class="card-text text-justify">NOTA: Si eliges cambiar los productos de tu pedido, en primer lugar 
                                tendrás que enviarnos la mercancía y, una vez la hayamos recibido y revisado (en un plazo máximo de 
                                14 días naturales), te enviaremos un cupón por el importe de los productos que deseas cambiar 
                                (siempre que supere los 59€) para que realices un nuevo pedido y puedes efectuar el cambio de 
                                productos (si este importe no supera los 59€ se efectuará el reintegro).. </p>

                            <p class="card-text text-justify">En condiciones normales sólo realizamos un envío por pedido. Si se 
                                realizó el pedido de varios productos con varias fechas de disponibilidad la fecha entrega del pedido, 
                                será la máxima fecha de entrega mas larga de los productos incluidos.  </p>

                            <img class="img-fluid rounded mx-auto d-block" src="/beautyandshop/img/devolucionesPie.webp" alt="imagen pagina Envios">
                            
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