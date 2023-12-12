<?php 
    //include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if (isset($_REQUEST["codu"])) {
        $cusu = $_REQUEST["codu"];
        
        
    } 
    else if (isset($_REQUEST["cusu"])) {
        $cusu = $_REQUEST["cusu"];
         
       
    }
    
    if(isset($_REQUEST["tipo"])) {
        $tipo=$_REQUEST["tipo"];
    }
        
    if(isset($_REQUEST["tipoUsuario"])) {
        $tipo=$_REQUEST["tipoUsuario"];
    }

    if(isset($_SESSION["tipo"])) {
        $tipo=$_SESSION["tipo"];
    }
        
    if(isset($_SESSION["tipoUsuario"])) {
        $tipo=$_SESSION["tipoUsuario"];
    }

    $datosUsuarios = array ();
    $datosUsuarios = llenarArray(1);

    /* SACAMOS LOS DATOS DEL USUARIO QUE PIDE LA CITA */
   $i=0;
    for($i=0;$i<count($datosUsuarios);$i++) {
        if($datosUsuarios[$i] -> getCodUsuario() == $cusu) {
            $nombre = $datosUsuarios[$i] -> getNombre();
            $email_to = $datosUsuarios[$i]->getEmail();
        }
    }
        
    if (isset($_REQUEST["fecha"])) {
        $fechaCita = $_REQUEST["fecha"];
    }

    if(isset($_REQUEST["dia"]) && isset($_REQUEST["mes"]) && isset($_REQUEST["anyo"])) {
        $dia=$_REQUEST["dia"];
        $mes=$_REQUEST["mes"] + 1;
        $anyo=$_REQUEST["anyo"];
        $fechaCita = date("d/m/Y", strtotime($anyo . '/' . $mes . "/" . $dia));
        //$fechaServicio = date("Y-m-d", strtotime($anyo . '-' . $mes . "-" . $dia));
        if ($dia <= 9) {
            $dia = "0" . $dia;
        }
        $fechaServicio = $anyo . '-' . $mes . "-" . $dia;
    }

    $datosServicios = array ();
    $datosServicios = llenarArrayServicios(1);

    $datosCitas = array ();
    $datosCitas = llenarArrayCitas(1, $fechaServicio);
    $reservaCita = 0; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Cita Online. BeautyAndShop</title>
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

    <!-- Necesario para las puntas de flecha que cambian de mes -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Hojas de ESTILOS personalizadas-->
    <link rel="stylesheet" href="/beautyandshop/css/myStiles.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleCitas.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleFooter.css">
    <link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleBotonUp.css">
</head>
<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenCitas jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Cita Online</h1>
                <!--<p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>-->
            </div>
    </div>

    <section class="container-fluid">
        <div class="row">       
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?php 
                if (isset($_REQUEST["nombreusuario"]) && (!empty($_REQUEST["nombreusuario"]))){
                ?>
                    <div style="text-align:center; color:ffffff; background: blue; "><b>El Usuario <?php echo $_REQUEST["nombreusuario"] ?> se ha borrado correctamente.</b></div><br><br>
                <?php 
                }
                ?>
                <?php 
                if (isset($_REQUEST["claveOk"]) && $_REQUEST["claveOk"]=="si"){
                ?>
                    <div style="text-align:center; color:ffffff; background: red; "><b>ATENCIÓN!!! Clave Modificada Correctamente.</b></div><br><br>
                <?php 
                }
                ?>
                <?php
                $mysqli = new mysqli('lldn637.servidoresdns.net:3306', 'qaim611', 'Beautyandshop+', 'qaim611');
                $datosFamilias = array ();
                $datosFamilias = llenarArrayFamilias(1);

                /* CHECKEO LOS CHECK QUE HAN ACTIVADO PARA MOSTRARLOS CHECKEADOS */
                if (isset($_REQUEST["enviar"])) {
                    if (isset($_REQUEST["codu"])) {
                        $cusu = $_REQUEST["codu"];
                    }
                    $i=0;
                    $cont=0;
                    for($i=0;$i<count($datosServicios);$i++) {
                        if(isset($_REQUEST[$datosServicios[$i] -> getCodServicio()])) {
                            $datosServicios[$i] -> setActivo(2);
                            $cont++;
                        }
                    }

                    
                        if(isset($_REQUEST["hora"])) {
                            $horaCita = $_REQUEST["hora"];
                            //echo "EXISTE HORA CITA: " . $horaCita;
                        }
                        else {
                            //$horaCita = "0:00";
                        }
                    if ($cont <> 0) {
                        //echo "LA FECHA DEL SERVICIO ES:" . $fechaServicio;
                        $resumenCita = addCita ($cusu, $datosServicios, $fechaServicio, $horaCita);
                        $reservaCita = 1;
                        
                    }
                    elseif ($cont == 0) {
                        echo "<div style='color:white;' class='smsError'><b>ATENCIÓN!!! NO HA SELECCIONADO NINGÚN SERVICIO.</b></div><br>";
                    }
                }
                if ($reservaCita == 1) {
                    //MOSTRAMOS POR PANTALLA EL RESUMEN DE LA CITA.
                    echo $resumenCita;

                    //ENVIAMOS EL EMAIL AL CLIENTE CON EL RESUMEN DE LA CITA.
                    $email_from = "info@beautyandshop.net";
                    $email_subject = "Tus Datos de Reserva en BEAUTY AND SHOP";
                    $email_message = "<html><head><meta charset='utf-8'></head><body><h3 sytle='color:red;'>¡Buenas noticias! Tu cita está confirmada.</h3>" 
                                    . $resumenCita . "</body></html>";
                    
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

                    if(@mail($email_to, $email_subject, $email_message, $headers)) {
                        echo "<div style='color:white;' class='smsOk'><b>Sus DATOS de RESERVA se han enviado correctamente.</b></div><br>";
                    }
                    else {
                        echo "<div style='color:white;' class='smsError'><b>NO se han podido enviar sus DATOS de RESERVA correctamente.</b></div><br>";	    
                    }
                }
                else {
                ?>

                <!--<h3>Cita Online</h3>-->
                <form class="formCitas" name="formularioServicios" method="post" action="">

                    <h2 class="h3 text-center text-warning">DATOS CITA</h2><hr><br>
                    <label for="nombre"><h5 class="h5 text-left text-warning">NOMBRE CLIENTE:</h5></label>

                    <input class="nombreCita" type="text" id="nombre" name="nombre" value="<?php if(isset($nombre)) echo $nombre ?>" disabled>
                    <label for="fecha"><h5 class="h5 text-left text-warning">FECHA CITA:</h5></label>
                    <input type="text" id="fecha" name="fecha" size="10" maxlength="10" value="<?php if(isset($fechaCita)) echo $fechaCita ?>" disabled>
                    <?php
                    if (isset($_REQUEST["hora"]) && $cont <>0) {
                        $horaCita = $_REQUEST["hora"];
                    ?>
                        <label for="hora"><h5 class="h5 text-left text-warning">HORA CITA:</h5></label>
                        <input type="text" id="hora" name="hora" value="<?php if(isset($horaCita)) echo $horaCita ?>" disabled>-->
                    <?php
                    }
                    else {
                        $cont=0;
                    ?> 
                        <label for="hora"><br><h5 class="h5 text-left text-warning">HORAS DISPONIBLES:</h5></label>
                    <?php  
                    }

                    if ($cont == 0) {
                    ?>    
                        <select name="hora" id="hora">
                            <?php
                            $i = 0;
                            $j = 0;
                            $cont = 0;
                            $horaInicio = "10:00";
                            $horaFin = "19:30"; 
                            
                            if (!empty($datosCitas)) {
                                while (strcmp($horaInicio, $horaFin) <> 0) {
                                    $cont = 0;
                                    for($i=0;$i<count($datosCitas);$i++) {
                                        if(strcmp($datosCitas[$i] -> getHoraCita (), $horaInicio) == 0) {
                                            $cont++;
                                        }
                                    }

                                    if ($cont == 0) {
                                        if (isset($_REQUEST["hora"]) && $horaInicio == $_REQUEST["hora"]) {
                                    ?>  
                                            <option value="<?php echo $horaInicio;?>" selected><?php echo $horaInicio;?></option>
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <option value="<?php echo $horaInicio;?>"><?php echo $horaInicio;?></option>
                                        <?php
                                        }
                                    }
                                    $array = explode(":", $horaInicio);
                                    $hora = intval($array[0]);
                                    $minutos = intval($array[1]);
                                    if ($minutos == 0) {
                                        $minutos = 30;
                                    }
                                    elseif ($minutos == 30) {
                                        $minutos = 0;
                                        $hora = $hora + 1;
                                    }
                                        
                                    if ($minutos == 0) {
                                        $horaInicio = strval($hora) . ":0" . strval($minutos);
                                    }
                                    else {
                                        $horaInicio = strval($hora) . ":" . strval($minutos);
                                    }
                                }
                            }
                            else if ($cont == 0) {
                                $i = 0;
                                $j = 0;
                                $horaInicio = "10:00";
                                $horaFin = "19:30";
                                while ($horaInicio <> $horaFin) {
                                    ?>
                                    <option value="<?php echo $horaInicio;?>"><?php echo $horaInicio;?></option>
                                    <?php
                                    $array = explode(":", $horaInicio);
                                    $hora = intval($array[0]);
                                    $minutos = intval($array[1]);
                                    if ($minutos == 0) {
                                        $minutos = 30;
                                    }
                                    elseif ($minutos == 30) {
                                        $minutos = 0;
                                        $hora = $hora + 1;
                                    }
                                        
                                    if ($minutos == 0) {
                                        $horaInicio = strval($hora) . ":0" . strval($minutos);
                                    }
                                    else {
                                        $horaInicio = strval($hora) . ":" . strval($minutos);
                                    }
                                }
                            }
                            ?>
                        </select>
                    <?php
                    }
                    ?>
                    <br />
                    
                    <?php
                    if ($cont <> 0) {
                        /*echo '<h4 class="h4 text-center text-warning">SERVICIOS ELEGIDOS:</h2><hr>';
                        echo '<div style="padding:35px;" class="text-justify">';
                            echo '<ul>';
                            $i=0;
                            for($i=0;$i<count($datosServicios);$i++) {
                                if ($datosServicios[$i] -> getActivo() == 2) {
                                    echo '<li>' . $datosServicios[$i] -> getDescripcion() . '</li>';
                                }
                            }
                            echo '</ul>';
                        echo '</div>';*/
                    }
                    else {
                    ?>
                        <h2 class="h3 text-center text-warning">ELIJA LOS SERVICIOS</h2><hr><br>
                        <div align="left" style="padding-left:15px;">
                            <div class="form-group mx-sm-3 mb-2">
                                <?php
                                $i=0;
                                for($i=0;$i<count($datosFamilias);$i++) {
                                    if ($datosFamilias[$i]-> getActivo() == 1) {
                                        echo "<h3 class='familias'>" . strtoupper($datosFamilias[$i]-> getNombre()) . "</h3>";
                                        $query = $mysqli -> query ("SELECT * FROM servicios WHERE activo=1 ORDER BY descripcion ASC");
                                         while ($valores = mysqli_fetch_array($query)) {
                                            if ($datosFamilias[$i]-> getCodigoFamilia() == $valores["codFamilia"]) {
                                                $j=0;
                                                for($j=0;$j<count($datosServicios);$j++) {
                                                    if($datosServicios[$j] -> getCodServicio() == $valores["codServicio"]) {
                                                        if ($datosServicios[$j] -> getActivo() == 2) {
                                                        ?>
                                                            <input class="servicios" name="<?php echo $valores['codServicio']?>" type='checkbox' checked/><?php echo $valores['descripcion']?><span>&emsp;<strong><?php echo $valores['precio']?>€</strong></span><br />           
                                                        <?php
                                                        }
                                                        else {
                                                        ?>           
                                                            <input class="servicios" name="<?php echo $valores['codServicio']?>" type='checkbox'/><?php echo $valores['descripcion']?><span>&emsp;<strong><?php echo $valores['precio']?>€</strong></span><br />                
                                                            
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                                    
                            </div>
                        </div>
                    <?php
                    }
                    echo '<hr><hr><div class="text-center">';
                        echo '<h4 class="h4 text-center text-success">GRACIAS POR CONFIAR EN NOSOTROS.</h2><hr><br>';
                    echo '</div>';
                    if ($cont == 0) {
                        ?>
                        <!--<input type="submit" name="enviar" value="Coger Cita" />-->
                    <div class="text-center">
                        <button class="btn btn-success text-center" type="submit" name="enviar" value="Coger Cita">COGER CITA</button>
                        <button class="btn btn-warning text-center" type="reset" name="borrar" value="Limpiar">BORRAR DATOS</button>
                        <?php
                            if ($tipoUsuario == 1 || $tipo == 1) {
                            ?> 
                                <a href="/beautyandshop/index.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                            <?php
                            }
                            elseif ($tipoUsuario == 2 || $tipo == 2) {
                            ?>
                                <a href="/beautyandshop/index.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                            <?php
                            }
                            else if ($tipoUsuario == 3 || $tipo == 3) {
                            ?>
                                <a href="/beautyandshop/index.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                            <?php
                            
                            }
                            ?>
                    <?php
                    }
                    ?> 
                    </div>
                </form>
                <?php
                }
                ?>
                
            </div>
        </div>
    </section><br><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>