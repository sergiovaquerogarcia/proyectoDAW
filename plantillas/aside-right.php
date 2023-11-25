<?php
    //include_once ($_SERVER['DOCUMENT_ROOT'] . "/tiendaPeluqueria/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
   
    if (isset($_SESSION["cusu"])) {
        $cusu = $_SESSION["cusu"];
    }

    if (isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"];
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }
    else {
        $tipo = 0;
    }

    /*else {
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
    }*/

    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) != 0) { 
    ?>
        <div class="carrito" role="alert">
            <div><img src="/beautyandshop/img/carrito.png" alt="Imagen Carrito" style="width: 70px; height: 70px;"></div>
            <!--<strong>Tu carrito:</strong><br>-->
            <br>
            <h5><?=count($_SESSION['carrito']);?> producto(s)<br></h5>
            <?php
            
            $totalPedido = 0;
            foreach ($_SESSION["carrito"] as $codigo => $unidades) {
                $producto = getProducto($codigo);
                $unidades = $_SESSION["carrito"][$codigo];
                if ($producto->getDescuento() > 0 ) {
                    $dto = round(($producto->getPrecio() * $producto->getDescuento())/100,2);
                    $pvpConDto = $producto->getPrecio() - $dto;
                    $totalPedido += floatval($pvpConDto * $unidades);
                }
                else {
                    $totalPedido += floatval($producto->getPrecio() * $unidades);
                }
            }
            ?>
            <h5><strong>TOTAL: </strong><?= number_format(round($totalPedido, 2),2, ",", ".") ?>€<br></h5>
            <?php 
                if (isset($_SESSION["tipo"]) || isset($_SESSION["tipoUsuario"])) {
                    if ($tipo == 1) {
                        echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                            echo '<a style="text-decoration:none;" href="/beautyandshop/shop/carrito.php"><button class="btn btn-block btn-outline-info text-center" type="button" value="ver"><i class="fa fa-eye"></i>VER CARRITO</button></a>';
                        echo '</div>';
                    }
                    else if ($tipo == 2) {
                        echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                            echo '<a style="text-decoration:none;" href="/beautyandshop/shop/carrito.php"><button class="btn btn-block btn-outline-info text-center" type="button" value="ver"><i class="fa fa-eye"></i>VER CARRITO</button></a>';
                        echo '</div>';
                       
                    }
                    else if ($tipo == 3) {
                        echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                            echo '<a style="text-decoration:none;" href="/beautyandshop/shop/carrito.php"><button class="btn btn-block btn-outline-info text-center" type="button" value="ver"><i class="fa fa-eye"></i>VER CARRITO</button></a>';
                    echo '</div>';
                    }
                }
                else {
                    echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center">';
                            echo '<a style="text-decoration:none;" href="/beautyandshop/shop/carrito.php"><button class="btn btn-block btn-outline-info text-center" type="button" value="ver"><i class="fa fa-eye"></i>VER CARRITO</button></a>';
                    echo '</div>';
                }
            ?>
        </div>
    <?php 
    } 
    

    
    if (isset($_REQUEST["errorusuario"]) && $_REQUEST["errorusuario"]=="si"){
        echo "<div style='margin-bottom: 15px;' class='smsError'><b>DATOS INCORRECTOS</b></div>";
    }

    if (isset($_REQUEST["erroractivo"]) && $_REQUEST["erroractivo"]=="si"){
        echo "<div style='margin-bottom: 15px;' class='smsError'><b>CUENTA DESACTIVADA</b></div>";
    }

    /*if (isset($_REQUEST["tipo"])){
        $tipoUsuario = $_REQUEST["tipo"];
        //echo $tipoUsuario;
    }
    
    if (isset($_SESSION["cusu"])) {
        $dni= $_SESSION["cusu"];  
    }*/
?>

<head>
    <!-- Hoja estilos CSS -->
    <!--<link rel="stylesheet" href="../css/estilos.css">-->
    <link rel="stylesheet" href="/beautyandshop/css/myStiles.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleFooter.css">
</head>

<aside class="aside row">
    <?php
    if ((isset($tipoUsuario) && $tipoUsuario == 1 || isset($tipo) && $tipo == 1 )) {
        
        $cnn = conectar_db();
        $stmt =$cnn->prepare("SELECT * FROM usuarios WHERE codUsuario = :codUsuario");
        $rows = $stmt->execute(array(":codUsuario"=>$cusu));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');
    
        if ($rows == 1) {
            $fila = $stmt->fetch();
            $nombre = $fila->getNombre();
        }
                
    ?>
        <div class="menuIzquierda">
            <h5>BIENVENID@</h5> <br/>
            <h6><?php echo $nombre ?></h6>
            <br/> 
            <!--<a class="ov-btn-grow-box" href="/beautyandshop/admin/micuenta.php?tipoUsuario=1&dni=<?php //echo $dni ?>">MI CUENTA</a>-->
            <a class="ov-btn-grow-box" href="/beautyandshop/admin/micuenta.php">MI CUENTA</a>
            <a class="ov-btn-grow-box"class="ov-btn-grow-box" href="/beautyandshop/admin/zonaCategorias.php">CATEGORIAS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/admin/zonaProductos.php">PRODUCTOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/admin/pedidos.php">PEDIDOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/admin/zonaUsuarios.php">USUARIOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/citas/agenda.php">AGENDA</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/familias/zonaFamilias.php">FAMILIAS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/servicios/zonaServicios.php">SERVICIOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/citas/gestionCitas.php">CITAS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/admin/zonaInformes.php">INFORMES</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/salir.php">CERRAR SESIÓN</a>
        </div>
    <?php
    ?>
    <?php
    }
    else if (isset($tipoUsuario) && $tipoUsuario == 2 || isset($tipo) && $tipo == 2 ) {
        $cnn = conectar_db();
        $stmt =$cnn->prepare("SELECT * FROM usuarios WHERE codUsuario = :codUsuario");
        $rows = $stmt->execute(array(":codUsuario"=>$cusu));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');
    
        if ($rows == 1) {
            $fila = $stmt->fetch();
            $nombre = $fila->getNombre();
        }
                
    ?>
        <div class="menuizquierda">
            <h5>BIENVENID@</h5> <br/>
            <h6><?php echo $nombre ?></h6>
            <br/> 
            <a class="ov-btn-grow-box" href="/beautyandshop/admin/zonaCategorias.php">CATEGORIAS</a>
            <a class="ov-btn-grow-box" href="/beautyandshop/admin/zonaProductos.php">PRODUCTOS</a>
            <a class="ov-btn-grow-box" href="/beautyandshop/admin/pedidos.php">PEDIDOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/admin/zonaUsuarios.php">USUARIOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/citas/agenda.php">AGENDA</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/familias/zonaFamilias.php">FAMILIAS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/servicios/zonaServicios.php">SERVICIOS</a>
            <a class="ov-btn-grow-box"href="/beautyandshop/citas/gestionCitas.php">CITAS</a>
            <a class="ov-btn-grow-box" href="/beautyandshop/salir.php">CERRAR SESIÓN</a>
        </div>
    
    <?php    
    }
    else if (isset($tipoUsuario) && $tipoUsuario == 3 || isset($tipo) && $tipo == 3) {
        //echo '<a href="buscarProducto.php?tipo=1"><input class="boton1" type="button" value="Buscar Producto"></button></a>';
        $cnn = conectar_db();
        $stmt =$cnn->prepare("SELECT * FROM usuarios WHERE codUsuario = :codUsuario");
        $rows = $stmt->execute(array(":codUsuario"=>$cusu));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');
    
        if ($rows == 1) {
            $fila = $stmt->fetch();
            $nombre = $fila->getNombre();
        }
    ?>
        <div class="menuIzquierda">
            <h5>BIENVENID@</h5> <br/>
            <h6><?php echo $nombre ?></h6>
            <br/>   
            <a class="ov-btn-grow-box" href="/beautyandshop/usuario/micuenta.php">MI CUENTA</a>
            <a class="ov-btn-grow-box" href="/beautyandshop/usuario/mispedidos.php">MIS PEDIDOS</a>
            <a class="ov-btn-grow-box" href="/beautyandshop/usuario/miscitas.php">MIS CITAS</a>
            <a class="ov-btn-grow-box" href="/beautyandshop/salir.php">CERRAR SESIÓN</a><br/>
        </div>
    <?php
    }
    else {
    ?>
        <br><br><br><br>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form name="formLogin" action="/beautyandshop/conexion.php" method="post">
                <h5 style="color: orange;" class="h5 text-center text-warning">ACCESO AL SISTEMA</h5><br> 
                <div class="form-group">
                    <label style="color: white;" for="email" class="col-sm-12 col-form-label"><h5 style="color: white;">Email</h5></label>
                    <div class="col-sm-12">
                        <input class="form-control" type="email" id="email" name="email" maxlength="50" size="50" required value="<?php if(isset($email)) echo $email ?>">
                    </div>
                </div>   
                <div class="form-group">
                    <label style="color: white;" for="clave" class="col-sm-12 col-form-label"><h5 style="color: white;">Contraseña</h5></label>
                    <div class="col-sm-12">
                        <input class="form-control" type="password" id="clave" name="clave" required>
                    </div>
                </div> 
                <br>
                <div class="text-center">
                    <button class="btn btn-outline-success text-center" type="submit" name="Enviar" value="Enviar">ENVIAR</button>
                    <button class="btn btn-outline-warning text-center" type="reset" name="borrar" value="Limpiar">LIMPIAR</button>
                </div>
                <div class="text-center">
                    <br>
                    <a class="enlaces" href="/beautyandshop/registrarse.php?tipo=4">Registrarse</a><br/>
                    <a class="enlaces" href="/beautyandshop/olvidarClave.php">Olvidó su Contraseña?</a>
                </div>
            </form> 
        </div>   
        <br/>
    <?php    
    }
    
    ?>       

</aside>
<br/>