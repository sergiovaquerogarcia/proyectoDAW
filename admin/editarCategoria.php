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
        
        $stmt =$cnn->prepare("SELECT * from categorias WHERE codigo = :codigo");
        $rows = $stmt->execute(array(":codigo"=>$codigo));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'categoria');

        if ($rows == 1) {
            $fila = $stmt->fetch();
            $nombreCategoria = $fila->getNombre();
            $activoCategoria = $fila->getActivo();
            $categoriaPadre = $fila->getCodCatPadre();
        } 
    }
    else {
        header ("location:/beautyandshop/admin/zonaCategorias.php");    
    }

    if(isset($_REQUEST["enviar"]) == TRUE) {
        $activoCategoria = $_REQUEST["activoCategoria"];
        $categoriaPadre = $_REQUEST["categoriaPadre"]; 
        //$nombreCategoria = strtoupper($_REQUEST["nombreCategoria"]);

        /*if (empty($_REQUEST["nombreCategoria"]) == TRUE) {
            $error [0]= "<p class='error'>ERROR. *El NOMBRE no puede estar en blanco.</p>";
            $codigo0 = 0;
        }
        else {
            $datosCategorias = [];

            $encontrado = 0;
            $datosCategorias = llenarArrayCategorias(0);
                        
            for($i=0;$i<count($datosCategorias) && $encontrado == 0;$i++) {
                $nombreCategoriaAux = $datosCategorias[$i]-> getNombre();
                if($nombreCategoriaAux == $nombreCategoria) {
                    $encontrado = 1;
                    $error [0]= "<p class='error'>ERROR. *La Categoria ya Existe.</p>";
                    $codigo0 = 0;
                }
            }
        }*/

        if ($activoCategoria != 0 && $activoCategoria != 1) {
            $error [1]= "<p class='error'>ERROR. *Valores Posibles -> 1. Activa / 0. Inactiva.</p>";
            $codigo1 = 1;
        }

        if (!isset($codigo0) && !isset($codigo1)) {
            updateCategoria ($tipo, $codigo, strtoupper($nombreCategoria), $activoCategoria, $categoriaPadre);
        }
    }
?>
<html lang="es">
    <head>
        <title>Editar Categoria. Beauty And Shop</title>
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
            <h2 class="h3 text-center text-warning">EDITAR CATEGORIA</h2><hr><br>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="nombreCategoria" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE CATEGORIA</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" maxlength="50" size="50" name="nombreCategoria" disabled value="<?php if(isset($nombreCategoria)) echo $nombreCategoria ?>" <?php if(isset($codigo0) && $codigo0 == 0){ echo "autofocus"; } ?>>
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
                            <select class="form-control" id="activa" name="activoCategoria" required>
                                <?php
                                if (isset($activoCategoria) && ($activoCategoria == 1)) {
                                ?>
                                    <option value=1 selected>Activada</option>
                                <?php
                                }
                                else {
                                ?>
                                    <option value=1>Activada</option>
                                <?php    
                                }
                                if (isset($activoCategoria) && ($activoCategoria == 0)) {
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
                    <!--<label>Activa (0. No Activa / 1. Activa): </label><input type="number" min="0" max="1" size="15" name="activoCategoria" required value="<?php //if(isset($activoCategoria)) echo $activoCategoria ?>"><br>-->
                    <?php
                    if(isset($error) && isset($codigo1)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo1]; ?></p>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="categoriaPadre" class="col-sm-12 col-form-label text-warning"><h5>SUBCATEGORIA DE</h5></label>
                        <div class="col-sm-12">
                            <select class="form-control" id="categoriaPadre" name="categoriaPadre">
                                <option value="0" selected>NINGUNA</option>
                                <?php
                                $categorias = getCategoriasPadre();
                                if (!empty($categorias)) {
                                    foreach ($categorias as $categoria) {
                                        if (isset($categoriaPadre) && $categoriaPadre != 0 && $categoria->getCodigo() == $categoriaPadre) {
                                        ?>
                                            <option value ="<? echo $categoria->getCodigo();?>" selected><?= $categoria->getNombre() ?></option>
                                        <?php
                                        }
                                        else {
                                       ?>
                                            <option value ="<? echo $categoria->getCodigo();?>"><?= $categoria->getNombre() ?></option>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success text-center" type="submit" name="enviar" value="Enviar">ENVIAR</button>
                        <!--<button class="btn btn-warning text-center" type="reset" class="btn btn-warning text-center">LIMPIAR</button>-->
                        <?php
                        if ($tipoUsuario == 1 || $tipo == 1) {
                        ?> 
                            <a href="/beautyandshop/admin/zonaCategorias.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                        <?php
                        }
                        elseif ($tipoUsuario == 2 || $tipo == 2) {
                        ?>
                            <a href="/beautyandshop/admin/zonaCategorias.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
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