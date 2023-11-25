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

    if(isset($_SESSION["cusu"])) {
        echo "ENTRO A CUSU";
        $cusu=$_SESSION["cusu"];
    }
?>
   

<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Quienes Somos. BeautyAndShop</title>
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
    <div class="imagenQuienesSomos jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">¿Quienes Somos?</h1>
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
                    <div class="col-md-5 contenedor">
                        <!--<img src="/beautyandshop/img/DSC01537-2.jpg" class="img-fluid rounded-start" alt="imagen Quienes Somos">-->
                        <img class="card-img-top imagen" src="/beautyandshop/img/cuidadoPiel.jpg" alt="imagen Cuidado Piel">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body contenedor">
                            <h2 class="card-title">SOBRE NOSOTROS</h2>
                            <p class="card-text text-center">Un centro de belleza único en Alicante, fruto de la experiencia de un equipo más que 
                                entregado para ofreceros los tratamientos más avanzados en estética y bienestar. </p>
                                <p class="card-text text-center">    BEAUTYANDSHOP es el resultado de una gran dosis de motivación, constancia y trabajo bien hecho: 
                                "Qué mayor motivación que la inquietud por seguir diferenciándose en el sector de la belleza, 
                                por aportar un valor añadido que implique beneficios en el cuidado “inside out” de nuestros clientes, 
                                reflejando nuestra manera de hacer las cosas", nuestras fundadoras.

                                            ¡Estamos deseando poder atenderte! .</p>
                            <!--<img src="/beautyandshop/img/jumbotron2.jpg" class="img-fluid rounded-start contenedor" alt="imagen Quienes Somos">-->
                            <img class="card-img-top imagen" src="/beautyandshop/img/jumbotron2.jpg" alt="imagen Cuidado Piel">
                            
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