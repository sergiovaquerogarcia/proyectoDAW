<?php
    //include_once ($_SERVER['DOCUMENT_ROOT'] . "/tiendaPeluqueria/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION["tipoUsuario"])) {
        $tipo = $_SESSION["tipoUsuario"];    
    }
    if (isset($_REQUEST["tipo"])) {
        $tipo = $_REQUEST["tipo"];
    }
   if (isset($_REQUEST["tipoUsuario"])) {
        $tipo = $_REQUEST["tipoUsuario"];
    }
    else {
        $tipo = 0;
    }
?>

<head>
    <!-- Hoja estilos CSS -->
    <!--<link rel="stylesheet" href="../css/estilos.css">-->
    <link rel="stylesheet" href="/beautyandshop/css/myStiles.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleFooter.css">

</head>


<!--<ul class="acorh">
        <?php
            $categorias = getCategoriasPadre();
            if (empty($categorias)) {
            ?>
                Aún no hay categorías en la base de datos
            <?php
            } 
            else {
                foreach ($categorias as $categoria) {
                    if (isset($tipo) && $tipo == 1 || $tipo == 2 || $tipo == 3) {
            ?>
                        <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $categoria->getCodigo(); ?>" ><?php echo $categoria->getNombre(); ?></a>
            <?php
                    }
                    else {
            ?>
                        <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $categoria->getCodigo(); ?>" ><?php echo $categoria->getNombre(); ?></a>
            <?php
                    }
                $subcategorias = getCategoriasHijas($categoria->getCodigo());
                if (empty($subcategorias)){

                }else{
            ?>
                <ul>
            <?php
                    foreach ($subcategorias as $subcategoria) {
                        if (isset($tipo) && $tipo == 1 || $tipo == 2 || $tipo == 3) {
            ?>    
                            <li><a href="/beautyandshop/shop/categorias.php?tipo=<?php echo $tipo; ?>&codigo=<?php echo $subcategoria->getCodigo(); ?>" ><?php echo $subcategoria->getNombre(); ?></a>
            <?php
                        }
                        else {
            ?>
                            <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $subcategoria->getCodigo(); ?>" ><?php echo $subcategoria->getNombre(); ?></a></li>
            <?php
                        }
            
            
                    }
            ?>
                </ul>
            <?php
                }
            ?>
                
            <?php
                    }
                }
            ?>
            </li> 
        </ul>-->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <ul class="menu">
                    <?php
                    $categorias = getCategoriasPadre();
                    if (empty($categorias)) {
                    ?>
                        <div class="smsError">Aún no hay categorías en la base de datos</div>
                    <?php
                    } 
                    else {
                        foreach ($categorias as $categoria) {
                            if (isset($tipo) && $tipo == 1 || $tipo == 2 || $tipo == 3) {
                            ?>
                                <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $categoria->getCodigo(); ?>" ><?php echo $categoria->getNombre(); ?></a>
                    
                                <?php
                            }
                            else {
                            ?>
                                <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $categoria->getCodigo(); ?>" ><?php echo $categoria->getNombre(); ?></a>
                            <?php
                            }
                            $subcategorias = getCategoriasHijas($categoria->getCodigo());
                            if (empty($subcategorias)){

                            }
                            else {
                                ?>
                                <ul>
                                <?php
                                    foreach ($subcategorias as $subcategoria) {
                                        if (isset($tipo) && $tipo == 1 || $tipo == 2 || $tipo == 3) {
                                        ?>    
                                            <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $subcategoria->getCodigo(); ?>" ><?php echo $subcategoria->getNombre(); ?></a></li>
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <li><a href="/beautyandshop/shop/categorias.php?codigo=<?php echo $subcategoria->getCodigo(); ?>" ><?php echo $subcategoria->getNombre(); ?></a></li>
                                        <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

    