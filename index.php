<?php 
             
        if(isset($_SESSION["tipo"])) {
            $tipo=$_SESSION["tipo"];
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

        if(isset($_SESSION["cusu"])) {
            $cusu=$_SESSION["cusu"];
        }
               
              
        
    ?>
   

<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>BeautyAndShop</title>
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
    <link rel="stylesheet" href="css/myStiles.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleBotonUp.css">
</head>

<body>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/carrusel.php"); ?>

    <section class="container-fluid">
        <div class="row">       
            <div class="borrar col-sm-12 col-md-12 col-lg-10">
                <?php 
                if (isset($_REQUEST["nombreusuario"]) && (!empty($_REQUEST["nombreusuario"]))){
                ?>
                    <div class="smsOk"><b>El Usuario <?php echo $_REQUEST["nombreusuario"] ?> se ha borrado correctamente.</b></div><br><br>
                <?php 
                }
                ?>
                <?php 
                if (isset($_REQUEST["claveOk"]) && $_REQUEST["claveOk"]=="si"){
                ?>
                    <div class="smsOk"><b>ATENCIÓN!!! SU CONTRASEÑA SE HA CAMBIADO CORRECTAMENTE. YA PUEDE ACCEDER A SU CUENTA.</b></div><br>
                <?php 
                }
                ?>
                <?php 
                if (isset($_REQUEST["ctaOff"]) && $_REQUEST["ctaOff"]=="off"){
                ?>
                    <div class="smsError"><b>Esta CUENTA está DESACTIVADA. Pongase en contracto con el ADMINISTRADOR de la página.</b></div><br>
                <?php 
                }
                ?>

                <?php
                if (isset($_REQUEST["errcita"]) && $_REQUEST["errcita"]=="si"){
                ?>
                    <div class='smsError'><b>ATENCIÓN!!! Para poder COGER CITA debe ACCEDER AL SISTEMA o REGISTRARSE.</b></div>
                <?php 
                }
                ?>
                           
                <div class="portada1 jumbotron jumbotron-fluid bg-dark">
                    <div class="container-fluid">
                        <h1 class="display-4">Nuevo Centro de Belleza</h1>
                        <p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>
                    </div>
                </div>

                <div class="card-group container-fluid">
                    <div class="card contenedor">
                        <img class="card-img-top imagen" src="img/depilacion.jpg" alt="imagen Depilaciones">
                        <div class="card-body">
                            <h5 class="card-title">DEPILACIONES</h5>
                            <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                        </div>
                    </div>
                    <div class="card contenedor">
                        <img class="card-img-top imagen" src="img/manicuras.jpg" alt="imagen Manicuras">
                        <div class="card-body">
                            <h5 class="card-title">MANOS Y PIES</h5>
                            <!--<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>-->
                        </div>
                    </div>
                    <div class="card contenedor">
                        <img class="card-img-top imagen" src="img/cuidadoPiel.jpg" alt="imagen Cuidado Piel">
                        <div class="card-body">
                            <h5 class="card-title">CUIDADO DE LA PIEL</h5>
                            <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>-->
                        </div>
                    </div>
                </div>

                <div class="portada2 jumbotron jumbotron-fluid bg">
                    <div class="container-fluid">
                        <h1 class="display-4">Pide Cita Online</h1>
                        <a href="/beautyandshop/citas/cogerCita.php" class="btn btn-primary">PEDIR CITA</a>
                    </div>
                </div>

                <div class="portada3 jumbotron jumbotron-fluid text-white">
                    <div class="container-fluid">
                        <h1 class="display-4">La belleza comienza ...</h1>
                        <p class="lead">a partir del momento en el que decides ser tú misma.</p>
                        <!--<a href="#" class="btn btn-primary">PEDIR CITA</a>-->
                    </div>
                </div>
            </div>

            <br>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>  
       </div>
       
    </section>
    
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>

</body>
</html>