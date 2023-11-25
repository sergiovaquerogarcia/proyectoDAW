<?php 
    //include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    /*if (isset($_REQUEST["cusu"])) {
        $codUsuarioCita = $_REQUEST["cusu"]; 
        //echo "CÓDIGO USUARIO QUE PIDE LA CITA: " . $codUsu;
    }*/

    if (isset($_REQUEST["codCita"])) {
        $codCita = $_REQUEST["codCita"];
        //echo "CÓDIGO USUARIO QUE PIDE LA CITA: " . $codUsu;
    }

    if (isset($_SESSION["cusu"])) {
        $cusu = $_REQUEST["cusu"];
        //echo "CÓDIGO USUARIO QUE PIDE LA CITA: " . $codUsu;
    }

    if (isset($_SESSION["tipo"])) {
        $tipo = $_REQUEST["tipo"];
        //echo "CÓDIGO USUARIO QUE PIDE LA CITA: " . $codUsu;
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

    $datosTodasCitas = array ();
    $datosTodasCitas = llenarArrayCitasTodas(1);
    
    $datosUsuarios = array ();
    $datosUsuarios = llenarArray(1);

    /* SACAMOS LOS DATOS DEL USUARIO QUE QUIERE MODIFICAR LA CITA */
    $i=0;
    $enc=0;
    for($i=0;$i<count($datosTodasCitas) && $enc==0;$i++) {
        if($datosTodasCitas[$i] -> getCodCita() == $codCita) {
            $codUsuarioCita = $datosTodasCitas[$i] -> getCodUsuario();
            $enc=1;
        }
    }

    $i=0;
    $enc=0;
    for($i=0;$i<count($datosUsuarios) && $enc==0;$i++) {
        if($datosUsuarios[$i] -> getCodUsuario() == $codUsuarioCita) {
            $nombre = $datosUsuarios[$i] -> getNombre();
        }
    }
    

   /* if (isset($_REQUEST["fecha"])) {
        $fechaCita = $_REQUEST["fecha"];
    }*/

    if(isset($_REQUEST["dia"]) && isset($_REQUEST["mes"]) && isset($_REQUEST["anyo"])) {
        $dia=$_REQUEST["dia"];
        $mes=$_REQUEST["mes"] + 1;
        $anyo=$_REQUEST["anyo"];
        $fechaCita = date("d/m/Y", strtotime($anyo . '/' . $mes . "/" . $dia));
        //$fechaServicio = date("Y-m-d", strtotime($anyo . '-' . $mes . "-" . $dia));
        $fechaServicio = $anyo . '-' . $mes . "-" . $dia;

        //echo "LA FECHA ES: " . $fechaServicio;
    }

    $datosServicios = array ();
    $datosServicios = llenarArrayServicios(1);


    $datosCitas = array ();
    $datosCitas = llenarArrayCitas(1, $fechaServicio);

    $datosLinCitas = array ();
    $datosLinCitas = llenarArrayLinCitas(1);

    $i=0;
    for($i=0;$i<count($datosLinCitas);$i++) {
        if($datosLinCitas[$i] -> getCodCita() == $codCita) {
            $codServicio = $datosLinCitas[$i] -> getCodServicio();
            $j=0;
            $enc=0;
            for($j=0;$j<count($datosServicios);$j++) {
                if($datosServicios[$j] -> getCodServicio() == $codServicio) {
                    $datosServicios[$j] -> setActivo(2);
                    $enc=1;
                }
            }

        }
    }
    $reservaCita = 0; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Editar Servicio. BeautyAndShop</title>
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
    <script src="/beautyandshop/js/botonUp.js"></script>
</head>
<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenCitas jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Editar Cita Online</h1>
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
                $mysqli = new mysqli('lldn637.servidoresdns.net:3306', 'qaim611', 'Beautyandshop+', 'qaim611');
                $datosFamilias = array ();
                $datosFamilias = llenarArrayFamilias(1);

                /* CHECKEO LOS CHECK QUE HAN ACTIVADO PARA MOSTRARLOS CHECKEADOS */
                if (isset($_REQUEST["enviar"])) {
                    $i=0;
                    $cont=0;

                    // PONGO TODOS LOS SERVICIOS DESACTIVADOS.
                    for($i=0;$i<count($datosServicios);$i++) {
                        if($datosServicios[$i] -> getCodServicio()) {
                            $datosServicios[$i] -> setActivo(1);
                        }
                    }

                    for($i=0;$i<count($datosServicios);$i++) {
                        if(isset($_REQUEST[$datosServicios[$i] -> getCodServicio()])) {
                            $datosServicios[$i] -> setActivo(2);
                            $cont++;
                        }
                    }
                    if(isset($_REQUEST["hora"])) {
                        $horaCita = $_REQUEST["hora"];
                    }
                    else {
                        //$horaCita = "0:00";
                    }
                    if ($cont <> 0) {
                        $reservaCita = updateCita ($codCita, $datosServicios, $fechaServicio, $horaCita);
                        $reservaCita = 1;
                    }
                    elseif ($cont == 0) {
                        echo "<div style='color:white;' class='smsError'><b>ATENCIÓN!!! NO HA SELECCIONADO NINGÚN SERVICIO.</b></div><br>";
                    }
                }
                if ($reservaCita == 1) {
                    echo "<hr><div style='color:white;heigt: 40px;' class='smsOk'><b>CITA MODIFICADA CORRECTAMENTE.<br>
                            GRACIAS POR CONFIAR EN NOSOTROS</b></div><br><hr>"; 
                    echo '<div class="text-center">';
                        echo '<a href="javascript:window.close()"><button class="btn btn-danger text-center" type="button" value="cerrar">CERRAR VENTANA</button></a>';
                    echo '</div>';   
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
                            <input type="text" id="hora" name="hora" value="<?php if(isset($horaCita)) echo $horaCita ?>">-->
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
                        /*echo '<div class="text-center">';
                        echo '<h4 class="h4 text-center text-success">GRACIAS POR CONFIAR EN NOSOTROS.</h2><hr><br>';
                        echo '</div>';*/
                        if ($cont == 0) {
                            ?>
                            <div class="text-center">
                                <button class="btn btn-success text-center" type="submit" name="enviar" value="Coger Cita">MODIFICAR CITA</button>
                            </div>
                        <?php
                        }
                        ?> 
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