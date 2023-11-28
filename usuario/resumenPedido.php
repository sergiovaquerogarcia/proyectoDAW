<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
    //include ("usuario_class.php");

    
    if(isset($_REQUEST["tipo"])) {
        $tipo=$_REQUEST["tipo"];
    }

    if(isset($_SESSION["tipo"])) {
        $tipo=$_SESSION["tipo"];
    }

    if(isset($_REQUEST["numPedido"])) {
        $numPedido = $_REQUEST["numPedido"];
    }
    else {
        header("location:/beautyandshop/index.php");
                 
    }
?>
<html lang="es">
    <head>
        <title>Resumen Pedido. Beauty And Shop</title>
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
                <br />
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="text-center">
                    <h2>¡ PEDIDO RECIBIDO CORRECTAMENTE !</h2>
                    <h3><strong>Gracias por confiar en nosotros.</strong></h3><hr><br>
                    <img class="rounded img-thumbnailstyle" style="margin: 0 auto; width: 200px; height:200px;" src="/beautyandshop/img/logo.png">';
                    <h4 class="h4 text-center text-warning">RESUMEN DEL PEDIDO</h4><br><hr><br>
                    <?php 
                    if (isset($_REQUEST["numPedido"])) {
                        // Obtengo el CÓDIGO DEL USUARIO.
                       $cnn = conectar_db();
                       $stmt =$cnn->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
                       $stmt->execute(array(":numPedido"=>$numPedido));
                       $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');
                       while($fila = $stmt->fetch()) {
                           $codUsuario = $fila->getCodUsuario();
                           //$dni = $dniUsuario;
                       }
                    
                        // OBTENEMOS LOS DATOS EL USUARIO.
                        $cnn = conectar_db();
                        $stmt =$cnn->prepare("SELECT * FROM usuarios where codUsuario = :codUsuario");
                        $stmt->execute(array(":codUsuario"=>$codUsuario));
                        $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

                        $detallePedido = "<h2>DATOS CLIENTE Y DIRECCIÓN ENVÍO:</h2>";
                        $detallePedido = $detallePedido . "
                        <div class='table-responsive'>
                        <table>
                        <thead style: 'background-color:black;color:white;'>
                            <tr>
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
                            $detallePedido = $detallePedido . "<td>{$fila->getNombre()}</td>"; 
                            $detallePedido = $detallePedido . "<td>{$fila->getDireccion()}</td>";
                            $detallePedido = $detallePedido . "<td>{$fila->getCp()}</td>";  
                            $detallePedido = $detallePedido . "<td>{$fila->getPoblacion()}</td>"; 
                            $detallePedido = $detallePedido . "<td>{$fila->getProvincia()}</td>"; 
                            $detallePedido = $detallePedido . "<td>{$fila->getEmail()}</td>"; 
                            $email_to = $fila->getEmail();
                            $detallePedido = $detallePedido . "<td>{$fila->getTelefono()}</td>"; 
                            $detallePedido = $detallePedido . "</tr>";
                        }
                        $detallePedido = $detallePedido . "</tbody></table></div>";

                        // OBTENEMOS LOS DATOS DEL PEDIDO.
                        $cnn = conectar_db();
                        $stmt =$cnn->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
                        $stmt->execute(array(":numPedido"=>$numPedido));
                        $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');

                        $detallePedido = $detallePedido . "<h2>DETALLES DEL PEDIDO:</h2>";
                        $detallePedido = $detallePedido . "<div class='table-responsive'>";

                        $detallePedido = $detallePedido . "<table style:'border:1px solid black;'>
                        <thead style: 'background-color:black;color:white;'>  
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
                            $total = round($fila->getTotal(),2);
                            $total = number_format(round($total, 2),2, ",", ".");
                            $detallePedido = $detallePedido . "<td>{$total} €</td>"; 
                            $detallePedido = $detallePedido . "<td id='estado'>{$fila->getEstado()}</td>";
                           
                            $detallePedido = $detallePedido . "</tr>";
                        }
                        $detallePedido = $detallePedido . "</tbody></table></div>";

                        // OBTENGO LOS DATOS DE LAS LÍNEAS QUE COMPONEN EL PEDIDO.
                        $cnn = conectar_db();
                        $stmt =$cnn->prepare("SELECT * FROM linpedidos where numPedido = :numPedido ORDER BY numLinea ASC");
                        $stmt->execute(array(":numPedido"=>$numPedido));
                        $stmt->setFetchMode(PDO::FETCH_CLASS, 'linpedido');

                        $detallePedido = $detallePedido . "
                        <div class='table-responsive'>
                        <table style:'border:1px solid black;'>
                        <thead style: 'background-color:black;color:white;'>
                            <tr>
                                <th>CÓDIGO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>UNDS</th>
                                <th>PVP</th>
                                <th>TOTAL</th>
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
                            $precio = number_format(round($fila->getPrecio()/$fila->getUnidades(), 2),2, ",", ".");
                            $detallePedido = $detallePedido . "<td style='text-align: right;'>{$precio} €</td>"; 
                            //$total = round($fila->getUnidades()*$fila->getPrecio(),2);
                            $total = round($fila->getPrecio(),2);
                            $total = number_format(round($total, 2),2, ",", ".");
                            $detallePedido = $detallePedido . "<td style='text-align: right;'>{$total} €</td>"; 
                            $detallePedido = $detallePedido . "</tr>";
                        }
                        $detallePedido = $detallePedido . "</tbody></table></div>";
			
			            echo $detallePedido;


                        // AHORA ENVIAMOS EL EMAIL AL CLIENTE
                        $email_from = "info@beautyandshop.net";
                        $email_subject = "Pedido de BEAUTY AND SHOP";

                        $email_message = '<div>
                            <h5> Le agradecemos la confianza que has depositado en nosotros. A continuación, le indicamos
                                el detalle de su compra:
                            </h5> 
                        </div>' . $detallePedido .'<br><hr><strong>GRACIAS por confiar en BEAUTY And SHOP.</strong><hr>';

                        $headers = "MIME-Version: 1.0\r\n"; 
                        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 

                        //dirección del remitente 
                        $headers .= "From: Beauty And Shop <info@beautyandshop.net>\r\n"; 

                        //dirección de respuesta, si queremos que sea distinta que la del remitente 
                        $headers .= "Reply-To: info@beautyandshop.net\r\n"; 

                        //ruta del mensaje desde origen a destino 
                        $headers .= "Return-path: info@beautyandshop.net\r\n"; 

                        //direcciones que recibián copia 
                        $headers .= "Cc: info@beautyandshop.net\r\n"; 


                        // Envío del email
                        if(@mail($email_to, $email_subject, $email_message, $headers)) {
                            echo "<div style='margin-top:15px;background-color:green;font-weight:bold;padding:8px;color:white;' class='text-center'>Se ha enviado a su email <strong>" . 					$email_to . " </strong> un resumen de su compra.<br>
                                    Recibirá un email en cuanto su pedido salga de nuestras instalaciones.<br>";    
                            echo "</div>";
                        }
                        else {
                            echo "<div class='smsError'>¡NO se ha podido enviar correctamente su pedido. Ha ocurrido un error!</div>";
                        }
                    }
                    ?>
                    
                    <h5 class="h5 text-center text-warning">Puede consultar el estado de su pedido en su sección de <b>«MIS PEDIDOS»</b></h5><br><hr><br>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>  
        </div>
   </section><br /><br />
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>
