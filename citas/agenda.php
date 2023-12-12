<?php 
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if(isset($_SESSION["tipo"])) {
        $tipo=$_SESSION["tipo"];
    }
    else {
        header ("Location:/beautyandshop/index.php?errcita=si");
    }
        
    if(isset($_SESSION["cusu"])) {
        $cusu=$_SESSION["cusu"];
    }
    else {
        //$cusu = 1;
    }    
?>
   

<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Agenda. BeautyAndShop</title>
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

    <!-- Necesario para las puntas de flecha que cambian de mes -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Hojas de ESTILOS personalizadas-->
    <link rel="stylesheet" href="/beautyandshop/css/myStiles.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleCitas.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleFooter.css">
    <link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleAgenda.css">
	<link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleBotonUp.css">
   
    
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenAgenda jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Agenda</h1>
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
        
            <div class="col-sm-12 col-md-9 col-lg-10">
                <div class="envoltorio"> <!-- envoltorio para el calendario -->
                    <div class="text-center" style="padding-top: 15px;padding-bottom: 25px;">
                        <h2 class="h2 neons1">A G E N D A</h2><hr><br>
                    </div>
                    <!--<div><img style="padding-top:30px;" class="img-fluid rounded mx-auto d-block" src="/beautyandshop/img\logoCitas.png"></div>-->
                    <header>
                        <p class="fecha-actual"></p> <!-- mostramos el mes y el año actual -->
                            <div class="iconos">
                                <span id="prev" class="material-symbols-rounded" title="Atrás">chevron_left</span>
                                <span id="next" class="material-symbols-rounded" title="Adelante">chevron_right</span>
                            </div>
                    </header>
                    <hr/>
                    <div class="calendario">
                        <ul class="semana"> <!-- cabecera de la semana -->
                            <li>LU</li>
                            <li>MA</li>
                            <li>MI</li>
                            <li>JU</li>
                            <li>VI</li>
                            <li>SA</li>
                            <li class="domingo">DO</li>
                        </ul>
                        <ul class="dias"></ul><!-- contenedor para mostrar los días -->
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>  
       </div>
    </section>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>

    
    <!-- cargamos el script para crear el calendario -->
    <?php
        //$dni = "33490565n";
    ?>
    <script>
        var cusu = '<?php echo $cusu;?>';
    </script>
    <script src="/beautyandshop/js/scriptAgenda.js" defer></script>
    <script src="/beautyandshop/js/botonUp.js"></script>
        
</body>
</html>