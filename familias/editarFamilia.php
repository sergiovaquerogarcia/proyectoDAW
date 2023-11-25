<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }

    $error = array();


    if (isset($_REQUEST["codigo"])) {
        $codigo = $_REQUEST["codigo"];
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("SELECT * from familias WHERE codFamilia = :codFamilia");
        $rows = $stmt->execute(array(":codFamilia"=>$codigo));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'familia');

        if ($rows == 1) {
            $fila = $stmt->fetch();
            $nombreFamilia = $fila->getNombre();
            $activoFamilia = $fila->getActivo();
            //$categoriaPadre = $fila->getCodCatPadre();
        } 
    }
    else {
        header ("location:/beautyandshop/familias/zonaFamilias.php");    
    }

    if(isset($_REQUEST["enviar"]) == TRUE) {
        $activoFamilia = $_REQUEST["activoFamilia"];
        if ($activoFamilia != 0 && $activoFamilia != 1) {
            $error [1]= "<p class='error'>ERROR. *Valores Posibles -> 1. Activa / 0. Inactiva.</p>";
            $codigo1 = 1;
        }

        if (!isset($codigo0) && !isset($codigo1)) {
            updateFamilia ($codigo, strtoupper($nombreFamilia), $activoFamilia);
        }
    }
?>
<html lang="es">
    <head>
        <title>Editar FAMILIA. Beauty And Shop</title>
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

        <style type="text/css">
            <?php
            if(isset($error)) {
            ?>
               input:focus {
                    border: solid red 1px;
                    background-color: lightblue;
                }
            <?php
            }
            ?>
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
            <h2 class="h3 text-center text-warning">EDITAR FAMILIA</h2><hr><br>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="nombreFamilia" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE FAMILIA</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" maxlength="80" size="80" name="nombreFamilia" disabled value="<?php if(isset($nombreFamilia)) echo $nombreFamilia ?>" <?php if(isset($codigo0) && $codigo0 == 0){ echo "autofocus"; } ?>>
                        </div>
                    </div>
                    <?php
                    if(isset($error) && isset($codigo0)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo0]; ?></p>
                    <?php
                    }
                    ?>
                    
                    <div class="form-group">
                        <label for="activa" class="col-sm-12 col-form-label text-warning"><h5>ACTIVA</h5></label>
                        <div class="col-sm-12">
                            <select class="form-control" id="activa" name="activoFamilia" required>
                                <?php
                                if (isset($activoFamilia) && ($activoFamilia == 1)) {
                                ?>
                                    <option value=1 selected>Activada</option>
                                <?php
                                }
                                else {
                                ?>
                                    <option value=1>Activada</option>
                                <?php    
                                }
                                if (isset($activoFamilia) && ($activoFamilia == 0)) {
                                ?>
                                    <option value=0 selected>Desactivada</option>
                                <?php
                                }
                                else {
                                ?>
                                    <option value=0>Desactivada</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <?php
                    if(isset($error) && isset($codigo1)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo1]; ?></p>
                    <?php
                    }
                    ?>

                    <div class="text-center">
                        <button class="btn btn-success text-center" type="submit" name="enviar" value="Enviar">ENVIAR</button>
                        <button class="btn btn-warning text-center" type="reset" class="btn btn-warning text-center">LIMPIAR</button>
                        <a href="/beautyandshop/familias/zonaFamilias.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                    </div> 
                </form>
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