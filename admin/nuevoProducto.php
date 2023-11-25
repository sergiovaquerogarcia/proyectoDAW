<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    $error = array();

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

    if(isset($_REQUEST["enviar"]) == TRUE) {  
        $codigo = $_REQUEST["codigo"];
        $nombre = $_REQUEST["nombre"];
        $codCategoria = $_REQUEST["codCategoria"];
       
        $descripcion = $_REQUEST["descripcion"];
        $precio = $_REQUEST["precio"];
        if (isset($_REQUEST['descuento'])) {
            $descuento = $_REQUEST["descuento"];
        }
        else {
            $descuento = 0;
        }
        
        $activo = $_REQUEST["activo"];
        $nombre_archivo = $_FILES['imagen']['name'];
        $ruta = "../Images/" . $nombre_archivo;
        $temp = $_FILES['imagen']['tmp_name'];

        /* BUSCO SI YA EXISTE EL CÓDIGO DEL <PRODUCTO>*/
        $cnn = conectar_db();
                
        $datosProductos = [];

        $encontrado = 0;
        $datosProductos = llenarArrayProductos(0);

        for($i=0;$i<count($datosProductos) && $encontrado == 0;$i++) {
            $codigoAux = $datosProductos[$i]-> getCodigo();
            if($codigoAux == $codigo) {
                $encontrado = 1;
            }
        }

        if ($encontrado == 1) {
            $error [3] = "<div class='smsError'><b>ERROR!!! El CÓDIGO de PRODUCTO introducido ya existe.</b></div><br><br>";
            $codigo3 = 3;     
        }
        else {

            $valores = explode(".", $nombre_archivo);
            if ($valores[count($valores)-1] != "jpg" && $valores[count($valores)-1] != "JPG" && $valores[count($valores)-1] != "GIF" && $valores[count($valores)-1] != "gif" && $valores[count($valores)-1] != "PNG" && $valores[count($valores)-1] != "png" && $valores[count($valores)-1] != "jpeg" && $valores[count($valores)-1] != "JPEG") {
                $error [0] = "<div class='smsError'><b>ERROR. *Tipo Imagen Incorrecto. Se admiten: jpg, jpeg, gif o png.</b></div><br><br>";
                $codigo0 = 0;
            }
            else {
                list($ancho, $alto, $tipos, $atributos) = getimagesize($temp);
                if ($tipos != 1 && $tipos != 2 && $tipos != 3 && $tipos != 4) {
            
                    $error [0] = "<div class='smsError'><b>ERROR. *Tipo Imagen Incorrecto. Se admiten: jpg, jpeg, gif o png.</b></div><br><br>";
                    $codigo0 = 0;
                }
                if ($_FILES['imagen']['size'] > 3000000) {
                    $error [1] = "<div class='smsError'><b>ERROR. *Tamaño Imagen Incorrecto. Máximo 300 kb.</b></div><br><br>";
                    $codigo1 = 1;
                }
                if ($ancho > 300 || $alto > 300) {
                    $error [2] = "<div class='smsError'><b>ERROR. *Medidas Imagen Incorrecta. Tamaño Máximo 300x300.</b></div><br><br>";
                    $codigo2 = 2;    
                }
            }

            if (!isset($codigo0) && !isset($codigo1) && !isset($codigo2) && !isset($codigo3)) {

                if (move_uploaded_file($temp,$ruta)) {
                    echo '<p><b>Se ha subido correctamente la imagen.</b></p>';
                    addProducto ($tipo, $codigo, strtoupper($nombre), strtoupper($descripcion), $codCategoria, $precio, $descuento, $ruta, $activo);
                }
                else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }
        }
    }
?>
<html lang="es">
    <head>
        <title>Nuevo Producto. Beauty And Shop</title>
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
                <!-- MOSTRAMOS TODOS LOS MENSAJES DE ERROR -->
                <?php 
                if(isset($error) && isset($codigo3)) {
                    //echo "ENTRO";
                ?>
                <!-- <div style="color:ffffff; background: red; "><b>ERROR!!! El CÓDIGO de PRODUCTO introducido ya existe.</b></div><br><br>-->
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
                <h2 class="h3 text-center text-warning">NUEVO PRODUCTO</h2><hr><br>
                    <form name="nuevoProducto" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="codigo" class="col-sm-12 col-form-label text-warning"><h5>CÓDIGO PRODUCTO</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" type="text" name="codigo" id="codigo" pattern="[0-9]{4}" title="Debe de introducir 4 Números" maxlength="4" required value="<?php if(isset($codigo)) echo $codigo ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" type="text" name="nombre" id="nombre" maxlength="75" required value="<?php if(isset($nombre)) echo $nombre ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="codCategoria" class="col-sm-12 col-form-label text-warning"><h5>CATEGORIA</h5></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="codCategoria" name="codCategoria" required>
                                    <option value="" selected>NINGUNA</option>
                                    <?php
                                    $categorias = getCategorias();
                                    if (!empty($categorias)) {
                                        foreach ($categorias as $categoria) {
                                            if (isset($codCategoria) && $codCategoria != 0 && $categoria->getCodigo() == $codCategoria) {
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

                        <div class="form-group">
                            <label for="descripcion" class="col-sm-12 col-form-label text-warning"><h5>DESCRIPCIÓN</h5></label>
                            <div class="col-sm-12">
                                <textarea id="descripcion" name="descripcion" cols="50" rows="5" maxlength="250" required><?php if(isset($descripcion)) echo $descripcion ?></textarea>
                                <!--<input class="form-control errorImput" type="text" name="descripcion" id="descripcion" maxlength="250" required value="<?php //if(isset($descripcion)) echo $descripcion ?>">-->
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
                            <label for="imagen" class="col-sm-12 col-form-label text-warning"><h5>IMAGEN</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" name="imagen" id="imagen" type="file" required>
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
                                <a href="/beautyandshop/admin/zonaProductos.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                            <?php
                            }
                            elseif ($tipoUsuario == 2 || $tipo == 1) {
                            ?>
                                <a href="/beautyandshop/admin/zonaProductos.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
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
