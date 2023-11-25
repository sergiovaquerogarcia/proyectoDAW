<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $error = array();

    if (isset($_REQUEST["tipo"])) {
        $tipo = $_REQUEST["tipo"]; 
    }

    if (isset($_SESSION["tipoUsuario"])) {
        $tipo = $_SESSION["tipoUsuario"];
    }

    if (isset($_SESSION["cusu"])) {
        $cusu = $_SESSION["cusu"];
    }
    else {
        $cusu = 0;
    }

    if (isset($_REQUEST["irpago"])) {
        $irpago = $_REQUEST["irpago"];
        
    }
    else {
        $irpago = 1;
    }

     
    
if (isset($_SESSION["carrito"]) && count($_SESSION['carrito']) != 0) {
    
    if (isset($_REQUEST['modificar'])) {
        $nombre = strtoupper($_REQUEST['nombre']);
        $direccion = strtoupper($_REQUEST['direccion']);
        $cp = strtoupper($_REQUEST['cp']);
        $poblacion = strtoupper($_REQUEST['poblacion']);
        $provincia = strtoupper($_REQUEST['provincia']);
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("update usuarios SET nombre= :nombre, direccion= :direccion, cp= :cp, poblacion= :poblacion, provincia= :provincia where codUsuario= :codUsuario");
        $stmt->execute(array(":nombre"=>$nombre, ":direccion"=>$direccion, ":cp"=>$cp, ":poblacion"=>$poblacion, ":provincia"=>$provincia, ":codUsuario"=>$cusu));

    }
   
    if (isset($_REQUEST['pagar'])) {
        //$irpago = 1;
        
	
        if (isset($_SESSION["carrito"]) && count($_SESSION['carrito']) != 0) {
            if(isset($_REQUEST["fpago"])) {
                
                
                $fpago = $_REQUEST["fpago"];
            
                $cnn = conectar_db();
                $stmt = $cnn->prepare("SELECT MAX(numPedido) AS mayor FROM pedidos");
                $rows = $stmt->execute();
            
                if($fila = $stmt->fetch()) {
		
                    $numPedido = $fila["mayor"];
                    $numPedido = $numPedido + 1;
			
                }
                else {
                    $numPedido = 1;
                }
        
                $fechaPedido = date('y-m-d');  
                $codUsuario = $cusu;
                $estado = "RECIBIDO";
		

                $numLinea = 1;
                $ids = implode( ', ', array_keys($_SESSION["carrito"]));
                $sql = "SELECT * FROM productos WHERE codigo IN ($ids);";
                $total = 0;

                $cnn = conectar_db();
                foreach ($cnn->query($sql, PDO::FETCH_ASSOC) as $producto ) {
            		
                    $unidades = $_SESSION["carrito"][$producto["codigo"]];
                    if ($unidades > 0) {
			
                        if ($producto["descuento"] > 0 ) {
                            $dto = round(($producto["precio"] * $producto["descuento"])/100,2);
                            $pvpConDto = $producto["precio"] - $dto;
                            $subtotal = $unidades * $pvpConDto;
                        }
                        else {
                            //$pvpConDto = $producto["precio"];
                            $subtotal = $unidades * $producto["precio"];
                        }
                	
                        $cnn1 = conectar_db();
			
                        $codProducto = $producto["codigo"];
			
                        $stmt1 = $cnn1->prepare("insert into linpedidos values (:numLinea, :numPedido, :codProducto, :unidades, :precio)");
			
                        $rows1 = $stmt1->execute(array(":numLinea"=>$numLinea, ":numPedido"=>$numPedido, ":codProducto"=>$codProducto, ":unidades"=>$unidades, ":precio"=>$subtotal));
			
			
                        $numLinea = $numLinea + 1;
                                        
                        $total = $total + $subtotal;
			
                    }
                }
               
                $stmt = $cnn->prepare("insert into pedidos values(:numPedido, :fechaPedido, :codUsuario, :estado, :total)");
                $rows = $stmt->execute(array(":numPedido"=>$numPedido, ":fechaPedido"=>$fechaPedido, ":codUsuario"=>$codUsuario, ":estado"=>$estado, ":total"=>$total));
                if ($rows == 1) {
                    unset($_SESSION["carrito"]);
                    /*if ($tipo == 1) {
                        header ("location:/beautyandshop/usuario/zonaUsuario.php?numPedido=" . $numPedido);
                    }
                    else if ($tipo == 2) {
                        header ("location:/beautyandshop/usuario/zonaUsuario.php?numPedido=" . $numPedido);    
                    }
                    else if ($tipo == 3) {
                        header ("location:/beautyandshop/usuario/zonaUsuario.php?numPedido=" . $numPedido);    
                    }*/
                    header ("location:/beautyandshop/usuario/resumenPedido.php?numPedido=" . $numPedido);
                }
                //echo "PEDIDO REALIZADO CORRECTAMENTE";
            }
            else {
                $irpago = 0;
                $error [0]= 'ERROR. *Debe de elegir un Método de Pago.';
                $codigo0 = 0;
                //echo "ENTRO AL ELSE";
            }
        }       
    }
}
else {
    header ("location:/beautyandshop/index.php");
    
   /* if ($tipo == 1) {
        header ("location:/beautyandshop/index.php");
    }
    else if ($tipo == 2) {
        header ("location:index.php?tipo=2");    
    }
    else if ($tipo == 3) {
        header ("location:index.php?tipo=3");    
    }*/
}
?>
<html lang="es">
    <head>
        <title>Realizar Pago. Beauty And Shop</title>
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
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <?php
                if(isset($error) && isset($codigo0)) {
                ?>
                    <div class="smsError"><b><?php echo $error[$codigo0]; ?></b></div><br><br>
                <?php
                }
                ?>
                <?php
                if ($cusu == 0) {
                    echo '<div class="text-center">';
                        echo '<h2> Gracias por confiar en <br><b>BEAUTY AND SHOP</b></h2><hr>';
                        echo '<h4> <br>Estimado USUARIO para continuar con el proceso de compra debe <a href="/beautyandshop/registrarse.php?tipo=4">REGISTRARSE</a> o
                                si ya es usuario de Beauty And Shop, acceda con su usuario y su contraseña.  
                            <br>Puede hacerlo, usando el enlace o accediendo desde el formulario que encontrará en la barra lateral derecha.</h4>';
                        echo '<img class="img-fluid" style="margin: 0 auto; width: 300px; height:200px;" src="/beautyandshop/img/logo.png">';
                    echo '</div>';
                }
                else {
                    $cnn = conectar_db();
                    $datosUsuarios = [];
                    $encontrado = 0;
                    $datosUsuarios = llenarArray(0);

                    for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
                        $cusuAux = $datosUsuarios[$i]->getCodUsuario();
                        if($cusuAux == $cusu) {
                            $encontrado = 1;
                            $nombre = $datosUsuarios[$i]->getNombre();
                            $direccion = $datosUsuarios[$i]->getDireccion();
                            $cp = $datosUsuarios[$i]->getCp();
                            $poblacion = $datosUsuarios[$i]->getPoblacion();
                            $provincia = $datosUsuarios[$i]->getProvincia();
                            $telefono = $datosUsuarios[$i]->getTelefono();
                            $email = $datosUsuarios[$i]->getEmail();
                        }
                    }
                    
                    if ($encontrado == 1) {
                        
                        $errorDireccion = 0;
                        $errorCp = 0;
                        $errorPoblacion = 0;
                        $errorProvincia = 0;
                        if (empty($direccion)) $errorDireccion = 1;
                        if (empty($cp)) $errorCp = 1;
                        if (empty($poblacion)) $errorPoblacion = 1;
                        if (empty($provincia)) $errorProvincia = 1;

                        if (empty ($direccion) || empty ($poblacion) || empty ($provincia) || empty ($cp)) {
                            echo '<div class="text-center">';
                                echo '<h2 align="center">DATOS DE ENVÍO.</h2><hr><br>';
                                echo '<h4> Nos faltan los siguientes datos:</h4>';
                                if ($errorDireccion == 1) {
                                    echo '<h6> Dirección. </h6>';
                                }
                                if ($errorCp == 1) {
                                    echo '<h6> Código Postal. </h6>';
                                }
                                if ($errorPoblacion == 1) {
                                    echo '<h6> Población. </h6>';
                                }
                                if ($errorProvincia == 1) {
                                    echo '<h6> Provincia. </h6>';
                                }
                            

                                 echo '<br><h4>Por favor, rellene los datos que le indicamos para poder realizar el envío y pulse el botón Añadir
                                    dirección. Muchas Gracias!!!!!</h4><br><hr><br>';  
                            echo '</div>'; 
                        ?>        
                            <form method="post" action="">
                                <!--<h5 style="color: orange;" class="h5 text-center text-warning">DIRECCIÓN ENTREGA</h5><br> -->
                                <div class="form-group">
                                    <label for="nombre" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE Y APELLIDOS</h5></label>
                                    <div class="col-sm-12">
                                        <input class="form-control errorImput" type="text" required maxlength="80" size="80" name="nombre" value="<?php if(isset($nombre)) echo $nombre ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="direccion" class="col-sm-12 col-form-label text-warning"><h5>DIRECCIÓN</h5></label>
                                    <div class="col-sm-12">
                                        <input class="form-control errorImput" type="text" maxlength="60" size="60" name="direccion" value="<?php if(isset($direccion)) echo $direccion ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cp" class="col-sm-12 col-form-label text-warning"><h5>CÓDIGO POSTAL</h5></label>
                                    <div class="col-sm-12">
                                        <input class="form-control errorImput" type="text" pattern="[0-9]{5}" title="Debes poner 5 Números" maxlength="5" size="5" name="cp" value="<?php if(isset($cp)) echo $cp ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="poblacion" class="col-sm-12 col-form-label text-warning"><h5>POBLACIÓN</h5></label>
                                    <div class="col-sm-12">
                                        <input class="form-control errorImput" type="text" maxlength="40" size="30" name="poblacion" value="<?php if(isset($poblacion)) echo $poblacion ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="provincia" class="col-sm-12 col-form-label text-warning"><h5>PROVINCIA</h5></label>
                                    <div class="col-sm-12">
                                        <input class="form-control errorImput" type="text" maxlength="40" size="30" name="provincia" value="<?php if(isset($provincia)) echo $provincia ?>">
                                    </div>
                                </div>

                                <br>
                                <div class="text-center">
                                    <button class="btn btn-outline-success text-center" type="submit" name="modificar" value="Añadir dirección">AÑADIR DIRECCIÓN</button>
                                    <!--<button class="btn btn-outline-warning text-center" type="reset" name="borrar" value="Limpiar">LIMPIAR</button>-->
                                </div>
                            </form>
                        <?php
                        }
                        else {
                            //echo "IR AL PAGO: " . $irpago; 
                            
                            if ($irpago != 0) {
                        ?>   
                                <h5 style="color: orange;" class="h5 text-center text-warning">DIRECCIÓN ENTREGA</h5><br>
                                <h4> Le mostramos los datos de envío. Por favor, si no son correctos modifíquelos y pulse el 
                                    botón de <b>Modificar dirección</b>.<br><hr><br></h4>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE Y APELLIDOS</h5></label>
                                        <div class="col-sm-12">
                                            <input class="form-control errorImput" type="text" required maxlength="80" size="80" name="nombre" value="<?php if(isset($nombre)) echo $nombre ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-sm-12 col-form-label text-warning"><h5>DIRECCIÓN</h5></label>
                                        <div class="col-sm-12">
                                            <input class="form-control errorImput" type="text" maxlength="60" size="60" name="direccion" value="<?php if(isset($direccion)) echo $direccion ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cp" class="col-sm-12 col-form-label text-warning"><h5>CÓDIGO POSTAL</h5></label>
                                        <div class="col-sm-12">
                                            <input class="form-control errorImput" type="text" pattern="[0-9]{5}" title="Debes poner 5 Números" maxlength="5" size="5" name="cp" value="<?php if(isset($cp)) echo $cp ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="poblacion" class="col-sm-12 col-form-label text-warning"><h5>POBLACIÓN</h5></label>
                                        <div class="col-sm-12">
                                            <input class="form-control errorImput" type="text" maxlength="40" size="30" name="poblacion" value="<?php if(isset($poblacion)) echo $poblacion ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="provincia" class="col-sm-12 col-form-label text-warning"><h5>PROVINCIA</h5></label>
                                        <div class="col-sm-12">
                                            <input class="form-control errorImput" type="text" maxlength="40" size="30" name="provincia" value="<?php if(isset($provincia)) echo $provincia ?>">
                                        </div>
                                    </div>

                                    <br>
                                    <div class="text-center">
                                        <button class="btn btn-info text-center" type="submit" name="modificar" value="Modificar dirección">MODIFICAR DIRECCIÓN</button>
                                        <button class="btn btn-success text-center" type="submit" name="irpago" value="0">ELEGIR MÉTODO DE PAGO</button>
                                        <!--<button class="btn btn-outline-warning text-center" type="reset" name="borrar" value="Limpiar">LIMPIAR</button>-->
                                    </div>
                                    <br><br>
                            </form>
                                <?php
                            }
                        }
                        //echo "IR AL PAGO abajo: " . $irpago; 
                                if (isset($irpago) &&  $irpago == 0) {
                                ?>
                                    <h5 style="color: orange;" class="h5 text-center text-warning">ELIJA EL MÉTODO DE PAGO</h5><br>
                                    <div class="text-center">
                                        <img class="img-thumbnail" style="margin: 0 auto;" src="/beautyandshop/img/fpago.jpg">
                                        <br><br>
                                        <form method="post" action="">
                                        <div class="pago">
                                            Tarjeta Crédito / Débito<input type="radio" name="fpago" id="visa" value="tarjeta" <?php if(isset($fpago) && $fpago == "tarjeta") echo "checked" ?>>
                                            Paypal<input type="radio" name="fpago" id="paypal" value ="paypal" <?php if(isset($fpago) && $fpago == "paypal") echo "checked" ?> >
                                            Contrareembolso<input type="radio" name="fpago" id="contrareembolso" value ="contrareembolso" <?php if(isset($fpago) && $fpago == "contrareembolso") echo "checked" ?> >
                                            <br>
                                        </div>
                                    </div>

                                    
                                    <div class="text-center">
                                        <br><br>
                                        <button class="btn btn-success text-center" type="submit" name="pagar" value="Realizar Pedido">REALIZAR PEDIDO</button>
                                    </div>
                                <?php
                                }
                                ?>
                            </form>
                            
                        <?php
                        }
                    }    
                //}    
                ?>
            </div>  
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?> 
            </div>  
        </div>
   </section><br><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>