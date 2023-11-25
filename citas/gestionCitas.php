<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    // Variable de declaración en segundos
    $ActualizarDespuesDe = 5;
 
    // Envíe un encabezado Refresh al navegador preferido.
    header('Refresh: '.$ActualizarDespuesDe);
    
    if (isset($_REQUEST["codCita"])) {
        $codCita = $_REQUEST["codCita"];
    }
    
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

    if (isset($_REQUEST["ordenar"])) {
        $ordenar = $_REQUEST["ordenar"];
    }
    else {
        $ordenar = 0;
    }
    
?>
<html lang="es">
    <head>
        <title>Gestión CITAS. Beauty And Shop</title>
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
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php");?>
            </div>      

            <div class="col-sm-12 col-md-12 col-lg-8">

                <!-- MOSTRAMOS EL NOMBRE DEL USUARIO ELIMINADO.-->
                <?php 
                if (isset($_REQUEST["nombreusuario"]) && (!empty($_REQUEST["nombreusuario"]))){
                ?>
                    <div class="smsOk"><b>La CITA del usuario  <?php echo $_REQUEST["nombreusuario"] ?> se ha borrado correctamente.</b></div><br><br>
                <?php 
                }
                ?>

                <?php
                if($tipo == 1 || $tipoUsuario == 1) {
                ?>
                    <br >
                    <div class="text-center menuCategorias">
                        <a href="/beautyandshop/citas/buscarCita.php"><button type="button" class="btn btn-warning text-center">BUSCAR</button></a>
                        <!--<a href="/beautyandshop/citas/gestionCitas.php?ordenar=1"><button type="button" class="btn btn-warning text-center">ORDENAR ASC</button></a>
                        <a href="/beautyandshop/citas/gestionCitas.php?ordenar=2"><button type="button" class="btn btn-warning text-center">ORDENAR DESC</button></a>-->
                    </div>
                <?php
                }
                
                $datosCitas = [];
                $datosCitas = llenarArrayCitasTodas(2);
                echo mostrarTodasCitas($datosCitas);
                ?>
                <br>
            </div>
            
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
