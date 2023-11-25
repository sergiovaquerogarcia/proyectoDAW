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
        
        $stmt =$cnn->prepare("SELECT * FROM servicios WHERE codServicio = :codServicio");
        $rows = $stmt->execute(array(":codServicio"=>$codigo));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'servicio');

        if ($rows == 1) {
            $fila = $stmt->fetch();
            $descripcion = $fila->getDescripcion();
            $precio = $fila->getPrecio();
            $descuento = $fila->getDescuento();
            $duracionServicio = $fila->getDuracionServicio();
            $codFamilia = $fila->getCodFamilia();
            $activo = $fila -> getActivo();
        } 
    }

    if(isset($_REQUEST["enviar"]) == TRUE) {  
        //$descripcion = strtoupper($_REQUEST["descripcion"]);
        $precio = $_REQUEST["precio"];
        if (isset($_REQUEST["descuento"])) {
            $descuento = $_REQUEST["descuento"];    
        }
        else {
            $descuento = 0;
        }
        $duracionServicio = $_REQUEST["duracionServicio"];
        $codFamilia = $_REQUEST["codFamilia"];
        $activo = $_REQUEST["activo"];
        updateServicio ($tipo, $codigo, $descripcion, $precio, $descuento, $duracionServicio, $codFamilia, $activo);
    }
?>
<html lang="es">
    <head>
        <title>Editar SERVICIO. Beauty And Shop</title>
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
<body >
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
                if(isset($error) && isset($codigo3)) {
                ?>
                    <p class="error"><?php echo $error[$codigo3]; ?></p>
                <?php 
                }
                ?>
                <?php
                if(isset($error) && isset($codigo0))
                {
                ?>
                    <p class="error"><?php echo $error[$codigo0]; ?></p>
                <?php
                }
                ?>
                <?php
                if(isset($error) && isset($codigo1))
                {
                ?>
                    <p class="error"><?php echo $error[$codigo1]; ?></p>
                <?php
                }
                ?>

                <?php
                if(isset($error) && isset($codigo2))
                {
                ?>
                    <p class="error"><?php echo $error[$codigo2]; ?></p>
                <?php
                }
                ?>

                <h2 class="h3 text-center text-warning">EDITAR SERVICIO</h2><hr><br>
                    <form name="nuevoProducto" method="post" action="">
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-12 col-form-label text-warning"><h5>DESCRIPCIÓN</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" type="text" name="descripcion" id="descripcion" maxlength="90" disabled value="<?php if(isset($descripcion)) echo $descripcion ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="precio" class="col-sm-12 col-form-label text-warning"><h5>PRECIO</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" name="precio" id="precio" type="number" step="0.01" min="1" max="9999" size="50" required value="<?php if(isset($precio)) echo $precio ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descuento" class="col-sm-12 col-form-label text-warning"><h5>DESCUENTO</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" name="descuento" id="descuento" type="number" step="0.01" min="0" max="9999" size="50" required value="<?php if(isset($descuento)) echo $descuento ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duracionServicio" class="col-sm-12 col-form-label text-warning"><h5>DURACIÓN SERVICIO</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" name="duracionServicio" id="duracionServicio" type="number" step="5" min="0" max="9999" size="50" value="<?php if(isset($duracionServicio)) echo $duracionServicio ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="codFamilia" class="col-sm-12 col-form-label text-warning"><h5>FAMILIA</h5></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="codFamilia" name="codFamilia" required>
                                    <option value="0" selected>NINGUNA</option>
                                    <?php
                                    
                                    $familias = getFamilias();
                                    
                                    if (!empty($familias)) {
                                        
                                        foreach ($familias as $familia) {
                                            if (isset($codFamilia) && $codFamilia != 0 && $familia->getCodigoFamilia() == $codFamilia) {
                                            ?>
                                                <option value ="<? echo $familia->getCodigoFamilia();?>" selected><?= $familia->getNombre() ?></option>
                                            <?php
                                            }
                                            else {
                                           ?>
                                                <option value ="<? echo $familia->getCodigoFamilia();?>"><?= $familia->getNombre() ?></option>
                                            <?php
                                            }
                                        }
                                    }
                                    else {
                                        echo "ERROR";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="activo" class="col-sm-12 col-form-label text-warning"><h5>ACTIVO</h5></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="activo" name="activo" required>
                                    <?php
                                    if (isset($activo) && ($activo == 1)) {
                                    ?>
                                        <option value=1 selected>ACTIVADO</option>
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <option value=1>ACTIVADO</option>
                                    <?php    
                                    }
                                    if (isset($activo) && ($activo == 0)) {
                                    ?>
                                        <option value=0 selected>DESACTIVADO</option>
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <option value=0>DESACTIVADO</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                       
                        <div class="text-center">
                            <button class="btn btn-success text-center" type="submit" name="enviar" value="Enviar">ENVIAR</button>
                            <button class="btn btn-warning text-center" type="reset" name="limpiar" value="Limpiar">LIMPIAR</button>
                            <?php
                            if ($tipoUsuario == 1 || $tipo == 1) {
                            ?> 
                                <a href="/beautyandshop/servicios/zonaServicios.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                            <?php
                            }
                            elseif ($tipoUsuario == 2 || $tipo == 1) {
                            ?>
                                <a href="/beautyandshop/servicios/zonaServicios.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                            <?php
                            }
                            ?>
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
