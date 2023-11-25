<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
       

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"]; 
        $codUsuario = $cusu;   
    }
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }
    if(isset($_SESSION["tipo"])) {
        $tipoUsuario = $_SESSION["tipo"];
        $tipo = $_SESSION["tipo"]; 
    }

    if (isset($_REQUEST["numPedido"])) {
        $numPedido = $_REQUEST["numPedido"];
    }

    if (isset($_REQUEST["cambiarEstado"])) {
        $estadoAux = $_REQUEST["estado"];
        updateEstadoPedidos ($numPedido, $estadoAux);
    }
?>

<html lang="es">
    <head>
        <title>Detalle PEDIDOS. Beauty And Shop</title>
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
    <br />

    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <?php
                   if ($tipo == 1 || $tipo == 2 || $tipoUsuario == 2 || $tipoUsuario == 1) {
                        // Sacos los Datos del Pedido.
                       $cnn = conectar_db();
                       $stmt =$cnn->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
                       $stmt->execute(array(":numPedido"=>$numPedido));
                       $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');
                       while($fila = $stmt->fetch()) {
                           $codUsuario = $fila->getCodUsuario();
                           //$dni = $dniUsuario;
                       }
                    }
                    
                    
                    // Sacos los Datos del Usuario.
                    $cnn = conectar_db();
                    $stmt =$cnn->prepare("SELECT * FROM usuarios where codUsuario = :codUsuario");
                    $stmt->execute(array(":codUsuario"=>$codUsuario));
                    $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

                    $detallePedido = "<h2>DATOS CLIENTE Y DIRECCIÓN ENVÍO:</h2>";
                    $detallePedido = $detallePedido . "
                    <div class='table-responsive'>
                    <table>
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>DNI</th>
                            <th>NOMBRE</th>
                            <th>DIRECCIÓN</th>
                            <th>C. POSTAL</th>
                            <th>POBLACIÓN</th>
                            <th>PROVINCIA</th>
                            <th>EMAIL</th>
                            <th>TELÉFONO</th>

                        </tr>
                    </thead>
                    <tbody>";
                    while($fila = $stmt->fetch()) {
                        $detallePedido = $detallePedido . "<tr>";
                        $detallePedido = $detallePedido . "<td>{$codUsuario}</td>";
                        $detallePedido = $detallePedido . "<td>{$fila->getDni()}</td>"; 
                        $detallePedido = $detallePedido . "<td>{$fila->getNombre()}</td>"; 
                        $detallePedido = $detallePedido . "<td>{$fila->getDireccion()}</td>";
                        $detallePedido = $detallePedido . "<td>{$fila->getCp()}</td>";  
                        $detallePedido = $detallePedido . "<td>{$fila->getPoblacion()}</td>"; 
                        $detallePedido = $detallePedido . "<td>{$fila->getProvincia()}</td>"; 
                        $detallePedido = $detallePedido . "<td>{$fila->getEmail()}</td>"; 
                        $detallePedido = $detallePedido . "<td>{$fila->getTelefono()}</td>"; 
                        $detallePedido = $detallePedido . "</tr>";
                    }
                    $detallePedido = $detallePedido . "</tbody></table></div>";

                     // Sacos los Datos del Pedido.
                    $cnn = conectar_db();
                    $stmt =$cnn->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
                    $stmt->execute(array(":numPedido"=>$numPedido));
                    $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');

                    $detallePedido = $detallePedido . "<h2>DETALLES DEL PEDIDO:</h2>";
                    $detallePedido = $detallePedido . "<div class='table-responsive'>";

                    if ($tipo == 1 || $tipo == 2 || $tipoUsuario == 1 || $tipoUsuario == 2) {
                        $detallePedido = $detallePedido . "<form method='post' action=''>";
                    }
                    $detallePedido = $detallePedido . "<table>
                    <thead>  
                        <tr>
                            <th>FECHA PEDIDO</th>
                            <th>Nº PEDIDO</th>
                            <th>TOTAL PEDIDO</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while($fila = $stmt->fetch()) {
                        $detallePedido = $detallePedido . "<tr>";
                        $detallePedido = $detallePedido . "<td>{$fila->getFechaPedido()}</td>"; 
                        $detallePedido = $detallePedido . "<td>{$numPedido}</td>"; 
                        $total = number_format(round($fila->getTotal(), 2), 2, ",", "."); 
                        //$total = round($fila->getTotal(),2);
                        $detallePedido = $detallePedido . "<td>{$total} €</td>"; 
            
                        if ($tipo == 1 || $tipo == 2 || $tipoUsuario == 1 || $tipoUsuario == 2) {
                            $detallePedido = $detallePedido . '<td><select class="estadoPedidos" name="estado">
                            <option value="RECIBIDO">RECIBIDO</option>
                            <option value="PREPARACION">PREPARACIÓN</option>
                            <option value="ENVIADO">ENVIADO</option>
                            <option value="ENTREGADO">ENTREGADO</option>
                            <option value="ANULADO">ANULADO</option>
                            <option value="RECHAZADO">RECHAZADO</option>';
                            
                            $detallePedido = $detallePedido . '<option value="' . $fila->getEstado() .'" selected>' . $fila->getEstado() .' </option>';
                            $detallePedido = $detallePedido . '</select></td>';
                        }
                        else if ($tipo == 3 || $tipoUsuario == 3) {                                 
                            $detallePedido = $detallePedido . "<td id='estado'>{$fila->getEstado()}</td>"; 
                        }
                        $detallePedido = $detallePedido . "</tr>";
                    }
                    $detallePedido = $detallePedido . "</tbody></table></div>";

                    // Sacos los Datos de las líneas de pedido

                    $cnn = conectar_db();
                    $stmt =$cnn->prepare("SELECT * FROM linpedidos where numPedido = :numPedido ORDER BY numLinea ASC");
                    $stmt->execute(array(":numPedido"=>$numPedido));
                    $stmt->setFetchMode(PDO::FETCH_CLASS, 'linpedido');

                    $detallePedido = $detallePedido . "
                    <div class='table-responsive'>
                    <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Unidades</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>";
                while($fila = $stmt->fetch()) {
                    $detallePedido = $detallePedido . "<tr>";
                    $codigo = $fila->getCodProducto();
                    $detallePedido = $detallePedido . "<td>{$codigo}</td>";

                    // Saco la DESCRIPCIÓN del PRODUCTO de cada Línea de Pedido.
                    $cnn1 = conectar_db();
                    $stmt1 =$cnn1->prepare("SELECT * FROM productos where codigo = :codigo");
                    $stmt1->execute(array(":codigo"=>$codigo));
                    $stmt1->setFetchMode(PDO::FETCH_CLASS, 'producto');
                    $filaProducto = $stmt1->fetch();
                    $detallePedido = $detallePedido . "<td>{$filaProducto->getNombre()}</td>"; 
                    $detallePedido = $detallePedido . "<td>{$fila->getUnidades()}</td>"; 
                    
                    $detallePedido = $detallePedido . "<td style='text-align: right;'>" . number_format(round($fila->getPrecio()/$fila->getUnidades(), 2), 2, ",", ".") . " €</td>";
                    //$total = number_format(round(($fila->getUnidades()*$fila->getPrecio()), 2), 2, ",", "."); 
                    $total = number_format(round(($fila->getPrecio()), 2), 2, ",", "."); 
                    //$total = round($fila->getUnidades()*$fila->getPrecio(),2);
                    $detallePedido = $detallePedido . "<td style='text-align: right;'>{$total} €</td>"; 
                    $detallePedido = $detallePedido . "</tr>";
                }
                $detallePedido = $detallePedido . "</tbody></table></div>";

                echo $detallePedido;

                if( $tipo == 1 || $tipo == 2 || $tipoUsuario == 1 || $tipoUsuario == 2) {
                    echo '<br />
                    <div class="text-center">';
                    //echo '<form method="post">';
                    //echo '<input class="boton" type="submit" name="cambiarEstado" value="Cambiar Estado">';
                    echo '<button class="btn btn-success text-center" type="submit" name="cambiarEstado" value="Cambiar Estado">CAMBIAR ESTADO</button>';
                   
                    echo '</div></form>';
                }
                ?>
            </div>
            <br><br>
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