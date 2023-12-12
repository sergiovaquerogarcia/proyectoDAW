<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
   
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }

    if (isset($_REQUEST["ct"])) {
        $codCita = $_REQUEST["ct"];
    }

    if (isset($_REQUEST["p"])) {
        $pagina = $_REQUEST["p"];
    }
    else {
        $pagina = 0;
    }

    if (isset($_REQUEST["fecha"])) {
        $fechaAux = $_REQUEST["fecha"];
    }
    else {
        $pagina = 0;
    }
      
    if(empty($_REQUEST["ct"]) == TRUE && ($tipo == 1 || $tipoUsuario == 1) ) {
       header ("location:/beautyandshop/citas/gestionCitas.php");    
    }
    else if(empty($_REQUEST["ct"]) == TRUE && ($tipo == 2 || $tipoUsuario == 2) ) {
        header ("location:/beautyandshop/citas/gestionCitas.php");    
    }
    else if (empty($_REQUEST["ct"]) == TRUE && ($tipo == 3 || $tipoUsuario == 3) ) {
        header ("location:/beautyandshop/usuario/misCitas.php"); 
    }
    else {
               
        $cnn = conectar_db();
        

        $stmt =$cnn->prepare("SELECT * FROM citas where codCita = :codCita");
        $rows = $stmt->execute(array(":codCita"=>$codCita));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'cita');  
        
        if ($rows == 1) {
            $fila = $stmt->fetch();
            $codUsuario = $fila -> getCodUsuario();
            $fechaCita = $fila -> getFechaCita();
            $horaCita = $fila -> getHoraCita();
            $activo = 0;

            $datosUsuarios = array ();
            $datosUsuarios = llenarArray(1);

            $i=0;
            $enc=0;
            for($i=0;$i<count($datosUsuarios);$i++) {
                if($codUsuario == $datosUsuarios[$i]->getCodUsuario()) {
                    $nombre = $datosUsuarios[$i] -> getNombre();
                    $enc=1;
                }
            }
        }
        else {
            if(($tipo == 1 || $tipoUsuario == 1) ) {
                header ("location:/beautyandshop/citas/gestionCitas.php");    
            }
            else if ($tipo == 2 || $tipoUsuario == 2) {
                header ("location:/beautyandshop/citas/gestionCitas.php");    
            }
            else if ($tipo == 3 || $tipoUsuario == 3)  {
                header ("location:/beautyandshop/usuario/misCitas.php"); 
            }
        }
    }


    if(isset($_REQUEST["eliminar"]) == TRUE) {

        $datosCitas = [];
        $datosCitas = llenarArrayCitasTodas(1);
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("UPDATE citas SET activo= :activo where codCita = :codCita");
        $rows = $stmt->execute(array(":activo"=>$activo, ":codCita"=>$codCita));
        if ($rows == 1) {    
            
            // ENVIAMOS EL EMAIL AL CLIENTE DE QUE SU CITA SE HA ANULADO.
            $datosCita = '<h2>RESUMEN CITA ANULADA</h2><hr><br>';
           
            $i=0;
            $enc=0;
            
            for($i=0;$i<count($datosCitas) && $enc == 0;$i++) {
                $codigo = $datosCitas[$i]->getCodCita();
                if($codCita == $codigo) {
                    $codUsuario = $datosCitas[$i]->getCodUsuario();
                    $fecha = $datosCitas[$i]->getFechaCita();
                    $hora = $datosCitas[$i]->getHoraCita();
                    $importe = $datosCitas[$i]->getTotal();
                    $enc=1;
                }
            }

            $datosUsuarios = [];
            $datosUsuarios = llenarArray(0);
            $i=0;
            $encontrado=0;
            for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
                $cusuAux = $datosUsuarios[$i]-> getCodUsuario();
                if (($cusuAux == $codUsuario)) {
                    $email_to = $datosUsuarios[$i]-> getEmail();
                    $nombre = $datosUsuarios[$i] -> getNombre();
                    $telefono = $datosUsuarios[$i] -> getTelefono();
                    $encontrado = 1;
                }
            }

            /* PREPARAMOS EL RESUMEN DE LA CITA RESERVADA */

            $datosCita = $datosCita . 
            '<html lang="es">
                <head>
                    <title>Borrar Citas. Beauty And Shop</title>
                    <meta charset="utf-8">
                </head>
                <body>
                    <h2> DATOS CLIENTE: </h2><hr>
                    <h5>NOMBRE CLIENTE  : <span> <strong>' . $nombre . '</strong></span></h5>
                    <h5>FECHA SERVICIO  : <span> <strong>' . $fecha . '</strong></span></h5>
                    <h5>HORA SERVICIO   : <span> <strong>' . $hora . '</strong></span></h5>
                    <h5>TELÉFONO CLIENTE: <span> <strong>' . $telefono . '</strong></span></h5>
                    <h5>TOTAL SERVICIO  : <span> <strong>' . number_format(round($importe, 2), 2, ",", ".") . ' €</strong></span></h5>';
           
            //echo $datosCita;
            $datosLinCita = '<h2 class="h3 text-center text-warning">SERVICIOS</h2><hr>';
          
                    $i=0;
                    $total=0;
            
                    $datosLinCitas = [];
                    $datosLinCitas = llenarArrayLinCitas(1);

                    $datosServicios = [];
                    $datosServicios = llenarArrayServicios(1);
            
                    $i=0;
                    $j=0;
                    for($i=0;$i<count($datosLinCitas);$i++) {
                        if ($datosLinCitas[$i] -> getCodCita() == $codCita) {
                            $codServicio = $datosLinCitas[$i] -> getCodServicio();
                            $enc=0;
                            for($j=0;$j<count($datosServicios) && $enc==0;$j++) {
                                if ($datosServicios[$j] -> getCodServicio() == $codServicio) {
                                    $datosLinCita = $datosLinCita. "<p><strong>" . strtoupper($datosServicios[$j] -> getDescripcion()) . "</strong></p>";
                                    $enc=1;
                                }
                            }
                        }
                    }

            //$datosLinCita = $datosLinCita. "</tbody></table></div";
            $datosLinCita = $datosLinCita. "<br><hr><h6 class='h6 text-justify text-info'><strong>Ubicación Centro</strong></h6><hr>
                                            <p class='text-justify'>Beauty And Shop</p>
                                            <p class='text-justify'>C/ Fuerteventura, nº 145</p>
                                            <p class='text-justify'>48001 - Madrid, España</p><br>
                                            <h6 class='h6 text-justify text-info'><strong>Detalles de Contacto del Centro</strong></h6><hr>
                                            <p class='text-justify'>Email: <strong>info@beautyandshop.net</strong></p></p>
                                            <p class='text-justify'>Teléfono: <strong>+34 676 312 36</p></p>
                                            <br><hr><h3 class='h3 text-center text-success'>GRACIAS POR CONFIAR EN BEAUTY AND SHOP</h3><hr><br>";

            // MANDAMOS EL EMAIL CON LOS DATOS DE LA CITA.
            $datosLinCita = $datosLinCita. "</body></html>";
            //echo $datosLinCita;

            /*************************************************************** */

            $email_from = "info@beautyandshop.net";
            $email_subject = "CANCELACION de RESERVA en BEAUTY AND SHOP";
            $email_message = "<h3 sytle='color:red;'>¡Buenas noticias! Tu cita ha sido CANCELADA.</h3><br>" . $datosCita . $datosLinCita;
            $email_message .= "\n\n\n";
            
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
        
            @mail($email_to, $email_subject, $email_message, $headers);

			
            if ($tipo == 1 || $tipoUsuario == 1) {
                if (isset($pagina) && $pagina == 1) {
                    header("location:/beautyandshop/citas/verAgenda.php?fecha=" . $fechaAux . "&nombreusuario= " . $nombre);
                }
                else {
                    header("location:/beautyandshop/citas/gestionCitas.php?nombreusuario= " . $nombre);
                }
            }
            else if ($tipo == 2 || $tipoUsuario == 2) {
                if (isset($pagina) && $pagina == 1) {
                    header("location:/beautyandshop/citas/verAgenda.php?fecha=" . $fechaAux . "&nombreusuario= " . $nombre);
                }
                else {
                    header("location:/beautyandshop/citas/gestionCitas.php?nombreusuario= " . $nombre);
                }  
            }
            else if ($tipo == 3 || $tipoUsuario == 3)  {
                header ("location:/beautyandshop/usuario/miscitas.php?nombreusuario= " . $nombre); 
            }
        }
        else {
            echo "ERROR!!!! No se ha podido eliminar";
        }

    }
?>
<html lang="es">
    <head>
        <title>Borrar Citas. Beauty And Shop</title>
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
                <h2 class="h2 text-center text-warning">BORRAR CITA</h2><hr><br>
                <h4 class="h4 text-center text-danger">¿Está seguro que quiere eliminar esta cita?</h4>
                <div class="text-center">
                    <h5 class="h5 text-dark">Nombre Cliente: <span class="h4 text-info"><strong><?php echo $nombre;?></strong></span></h5>
                    <h5 class="h5 text-dark">Código Cita: <span class="h4 text-info"><strong><?php echo $codCita;?></strong></span></h5>
                    <h5 class="h5 text-dark">Fecha Cita: <span class="h4 text-info"><strong><?php echo $fechaCita;?></strong></span></h5>
                    <h5 class="h5 text-dark">Hora Cita: <span class="h4 text-info"><strong><?php echo $horaCita;?> H</strong></span></h5>
                </div><br><br><hr>

                <form method="post" action="">
                    <div class="text-center">
                        <button class="btn btn-success text-center" type="submit" name="eliminar" value="Eliminar">ELIMINAR</button>
                        <?php
                        if ($tipo == 1 || $tipoUsuario == 1 || $tipo == 2 || $tipoUsuario == 2) {
                            if (isset($pagina) && $pagina == 1) {
                                echo '<a href="/beautyandshop/citas/verAgenda.php?fecha=' . $fechaAux . '"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>';
                            }
                            else {
                                echo '<a href="/beautyandshop/citas/gestionCitas.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>';
                            }
                        }
                        else if ($tipo == 3 || $tipoUsuario == 3)  {
                            echo '<a href="/beautyandshop/usuario/miscitas.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>';
                        }
                        ?>
                    </div> 
                </form>
                <br>
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