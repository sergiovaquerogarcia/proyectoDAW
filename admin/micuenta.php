<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
    //include ("usuario_class.php");

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"];  
    }

    /*if (isset($_REQUEST["tipoUsuario"])){
        $tipoUsuario = $_REQUEST["tipoUsuario"];
        //echo $dni;
    }*/

    $cnn = conectar_db();
        
    $stmt =$cnn->prepare("SELECT * FROM usuarios WHERE codUsuario = :codUsuario");
    $rows = $stmt->execute(array(":codUsuario"=>$cusu));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

    if ($rows == 1) {
        $fila = $stmt->fetch();
        $nombre = $fila->getNombre();
    }

    
?>
<html lang="es">
    <head>
        <title>Zona Usuario</title>
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
        <link rel="stylesheet" href="/beautyandshop/css/styleMostrarUsuario.css">
        <link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleBotonUp.css">

        <style>
            .tablaDatos{ 
	            margin: 0 auto;
  	            width: 94%; 
  	            border-collapse: collapse; 
            }

            .tablaDatos th { 
  	            background: black; 
  	            color: white; 
  	            font-weight: bold; 
	            width:25%;
                border: 1px solid orange; 
            }

            .tablaDatos td, th { 
                padding: 6px; 
                border: 1px solid orange; 
                text-align: left; 
                font-size: 14px;
            }

            h3 {
                padding-left: 50px;
                color: orange;
            }

            .tablaDatos td {
                font-weight: bold;
            }

            .divTablaDatos {
                margin: 0 auto;
                margin-bottom: 25px;
                margin-left: 45px;
                border: 1px solid orange; 
                width: 25%; 
                display:inline-block;
                text-align: center;
            }

            .divTablaDatos span {
                color: orange;
                font-weight: bold;
            }

            .divTablaDatos:hover {
                background-color: black;
                color: orange;
            }
            .divTablaDatos a {
                text-decoration: none;
            }
            
            @media 
            only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px)  {
            
                .tablaDatos{ 
                    margin: 0 auto;
                    width: 100%; 
                    border-collapse: collapse; 
                }
                /* Force table to not be like tables anymore */
                .tablaDatos table, thead, tbody, th, td, tr { 
                    display: block; 
                    width: 100%; 
                }
            
                .tablaDatos th { 
                    width: 100%;
                }
            
                /*.tablaDatos tr { 
                    border: 1px solid orange; 
                }*/
            
                h3 {
                    padding-left: 20px;
                    color: orange;
                }
                .divTablaDatos {
                    margin: 0 auto;
                    width: 30%; 
                    margin-bottom: 25px;
                }
            }         
        </style>
    </head>
<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    <br />

    <section class="container-fluid">
        <div class="row">
           <div class="col-sm-12 col-md-12 col-lg-2">
           <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <?php
                    //$tipoUsuario = 3;
                    echo mostrarUsuario($cusu, $tipo);
                ?>
                <!--<a href="zonaAdministrador.php?tipoUsuario=1&dni=<?php //echo $dni ?>"><input class="boton1" type="button" value="Volver Zona Administrador."></button></a><br/>-->
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>
            </div> 
        </div>
        
   </section>
   <div class="divider py-1"></div>
   <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
   <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>