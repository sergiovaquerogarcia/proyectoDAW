<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/usuario_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/producto_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/categoria_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/pedido_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/servicio_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/linpedido_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/familia_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/cita_class.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/clases/lincita_class.php");
        
    define("USER_DB", "qaim611");
    define("PASWORD", "Beautyandshop+");

    /************* FUNCIÓN PARA CONECTAR CON LA BASE DE DATOS ***********************/
    function conectar_db() {
        // Create connection
        try {
            $dsn = "mysql:host=lldn637.servidoresdns.net:3306;dbname=qaim611";
            $cnn = new PDO($dsn, USER_DB, PASWORD);
            $cnn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo "ERROR" . $e->getMessage();
        }
        return($cnn);
    }

    /********** FUNCIONES MANTENIMIENTO CITAS **************************/
    function updateCita ($codCita, $datosServicios, $fechaServicio, $horaCita) {

        $todoOk = 1;
        $cnn = conectar_db();
        $stmt =$cnn->prepare("DELETE FROM lincitas WHERE codCita = :codCita");
        if ($stmt->execute(array(":codCita"=>$codCita))) {
            // AHORA VAMOS A GRABAR CADA UNA DE LAS LÍNEAS DEL SERVICIO.
            $numLinea = 1;
            $i=0;
        
            for($i=0;$i<count($datosServicios);$i++) {
                if ($datosServicios[$i] -> getActivo() == 2) {
                    $cnn = conectar_db();
                    $codServicio = $datosServicios[$i] -> getCodServicio();
                    
                    $unidades = 1;
                    $precio = $datosServicios[$i] -> getPrecio();
                    
                    $stmt = $cnn->prepare("insert into lincitas values(:numLinea, :codCita, :codServicio, :unidades, :precio)");
                    $stmt->execute(array(":numLinea"=>$numLinea, ":codCita"=>$codCita, ":codServicio"=>$codServicio, ":unidades"=>$unidades, ":precio"=>$precio));
                    $numLinea = $numLinea + 1;
                }
            }
        }
        else {
            $todoOk = 0;
        }
        
        // AHORA VAMOS A OBTENER EL IMPORTE TOTAL DEL TICKET DE LA CITA.
        $i=0;
        $total=0;
        for($i=0;$i<count($datosServicios);$i++) {
            if ($datosServicios[$i] -> getActivo() == 2) {
                $total = $total + $datosServicios[$i] -> getPrecio();
            }
        }

        //MODIFICAMOS PRIMERO LOS DATOS GENERALES DE LA CITA.

        $cnn = conectar_db();
        $stmt =$cnn->prepare("update citas SET fechaCita= :fechaCita, horaCita= :horaCita, total= :total where codCita= :codCita");
        
        if ($stmt->execute(array(":fechaCita"=>$fechaServicio, ":horaCita"=>$horaCita, ":total"=>$total, ":codCita"=>$codCita))) {
            //echo "CABECERA CITA MODIFICADA CORRECTAMENTE.";
        }
        else {
            $todoOk = 0;    
        }

        if ($todoOk == 1) {
            $datosLinCita = '<h2 class="h3 text-center text-warning">SERVICIOS ELEGIDOS</h2><hr><br>';
            $datosLinCita = $datosLinCita. "
            <div style='margin: 0 auto' class='table-responsive text-center'>
            <table>
                    <thead>
                        <tr>
                            <th>SERVICIO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>SUBTOTAL</th>
                        </tr>
                        </thead>
                    <tbody>
                        <tr>";
                        $i=0;
            $total=0;
            for($i=0;$i<count($datosServicios);$i++) {
                if ($datosServicios[$i] -> getActivo() == 2) {
                    $total = $total + $datosServicios[$i] -> getPrecio();
                }
            }


            $datosLinCita = '<br><h2 class="h3 text-center text-warning">SERVICIOS ELEGIDOS</h2><hr>';
            $datosLinCita = $datosLinCita. "
                <div style='margin: 0 auto' class='table-responsive text-center'>
                <table style='border 1px solid black;'>
                        <thead>
                            <tr>
                                <th>SERVICIO</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>SUBTOTAL</th>
                            </tr>
                            </thead>
                        <tbody>
                            <tr>";
            // AHORA VAMOS A GRABAR CADA UNA DE LAS LÍNEAS DEL SERVICIO.
            $numLinea = 1;
            $i=0;
            $descripcionServicios= "";
            for($i=0;$i<count($datosServicios);$i++) {
                if ($datosServicios[$i] -> getActivo() == 2) {
                    
                    $codServicio = $datosServicios[$i] -> getCodServicio();
                    $descripcionServicios = $descripcionServicios . $datosServicios[$i] -> getDescripcion() . "\n";
                    $datosLinCita = $datosLinCita. "<tr><td>" . $datosServicios[$i] -> getDescripcion() . "</td>";

                    $unidades = 1;
                    $datosLinCita = $datosLinCita. "<td>" . $unidades . "</td>";

                    $precio = $datosServicios[$i] -> getPrecio();
                    $datosLinCita = $datosLinCita. "<td class='text-right'>" . number_format(round($precio, 2), 2, ",", ".") . " € </td>";

                    $datosLinCita = $datosLinCita. "<td class='text-right'><strong>" . number_format(round(($unidades * $precio), 2), 2, ",", ".") . " € </strong></td></td>";

                
                }
            }

            $datosLinCita = $datosLinCita. "</tbody></table>";
            $datosLinCita = $datosLinCita. "<hr><h6 class='h6 text-justify text-info'><strong>Ubicación Centro</strong></h6><hr>
                                            <p class='text-justify'>Beauty And Shop</p>
                                            <p class='text-justify'>C/ Fuerteventura, nº 145</p>
                                            <p class='text-justify'>48001 - Madrid, España</p><br>
                                            <h6 class='h6 text-justify text-info'><strong>Detalles de Contacto del Centro</strong></h6><hr>
                                            <p class='text-justify'>Email: <strong>info@beautyandshop.net</strong></p></p>
                                            <p class='text-justify'>Teléfono: <strong>+34 676 312 36</p></p>
                                            <br><hr><h3 class='h3 text-center text-success'>GRACIAS POR CONFIAR EN BEAUTY AND SHOP</h3><hr><br></div><div class='col-xs-12 col-sm-2 col-md-2'></div></div>";

            // MANDAMOS EL EMAIL CON LOS DATOS DE LA CITA.
            $datosCitas = [];
            $datosCitas = llenarArrayCitasTodas(1);
            $i=0;
            $enc=0;
            for($i=0;$i<count($datosCitas) && $enc == 0;$i++) {
                if($codCita == $datosCitas[$i]->getCodCita()) {
                    $cusu = $datosCitas[$i]->getCodUsuario();
                    $enc=1;
                }
            }

            $datosUsuarios = [];
            $datosUsuarios = llenarArray(0);
            $i=0;
            $encontrado=0;
            for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
                $cusuAux = $datosUsuarios[$i]-> getCodUsuario();
                if (($cusuAux == $cusu)) {
                    $email_to = $datosUsuarios[$i]-> getEmail();
                    $nombre = $datosUsuarios[$i] -> getNombre();
                    $telefono = $datosUsuarios[$i] -> getTelefono();
                    $encontrado = 1;
                }
            }

            /* PREPARAMOS EL RESUMEN DE LA CITA RESERVADA */
            $datosCita = '<div class="container text-center"><div class="row"><div class="col-xs-12 col-sm-2 col-md-2"></div><div class="col-xs-12 col-sm-8 col-md-8"><h2 class="h3 text-center text-warning">RESUMEN DE SU RESERVA</h2><hr><br>';
            $datosCita = $datosCita. "
            <div style='margin: 0 auto;' class='table-responsive text-center'>
            <table style='border 1px solid black;'>
                    <thead>
                        <tr>
                            <th>NOMBRE CLIENTE</th>
                            <th>FECHA CITA</th>
                            <th>HORA CITA</th>
                            <th>TELÉFONO</th>
                            <th>IMPORTE PAGAR</th>
                        </tr>
                        </thead>
                    <tbody>
                        <tr>";
                            $datosCita = $datosCita . '<td>' . $nombre . '</td>';
                            $datosCita = $datosCita . '<td>' . $fechaServicio . '</td>';
                            $datosCita = $datosCita . '<td>' . $horaCita . ' H</td>';
                            $datosCita = $datosCita . '<td>' . $telefono . '</td>';
                            $datosCita = $datosCita . '<td><strong>' . number_format(round($total, 2), 2, ",", ".") . ' €</strong></td>
                        </tr>
                    </tbody>
                </table>';

            /* ENVIAMOS EL EMAIL CON LA CITA MODIFICADA */
            
            $email_from = "info@beautyandshop.net";
            $email_subject = "Resumen Reserva modificada en BEAUTY AND SHOP";
            $email_message = "<h3 sytle='color:red;'>¡Buenas noticias! Tu cita ha sido modificada.</h3><br>" . $datosCita . $datosLinCita;
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

            //MUESTRO UN MENSAJE INFORMANDO QUE LA CITA SE HA REGISTRADO DE FORMA CORRECTA. GRACIAS POR CONFIAR EN NOSOTROS.-->
            //echo "<div class='container smsOk'><b>ATENCIÓN!!! CITA REGISTRADA CORRECTAMENTE.</b><br>GRACIAS POR CONFIAR EN NOSOTROS.</b></div><br>";


        }
        return ($todoOk);
    }

    function addCita ($cusu, $datosServicios, $fechaServicio, $horaCita) {

        // CALCULAMOS EL SIGUIENTE CÓDIGO DE LA CITA.
        $cnn = conectar_db();
        $stmt = $cnn->prepare("SELECT MAX(codCita) AS mayor FROM citas");
        $rows = $stmt->execute();
            
        if($fila = $stmt->fetch()) {
            $codCita = $fila["mayor"];
            $codCita = $codCita + 1;
        }
        else {
            $codCita = 1;
        }
              
        // AHORA VAMOS A OBTENER EL IMPORTE TOTAL DEL TICKET DE LA CITA.
        $i=0;
        $total=0;
        for($i=0;$i<count($datosServicios);$i++) {
            if ($datosServicios[$i] -> getActivo() == 2) {
                $total = $total + $datosServicios[$i] -> getPrecio();
            }
        }


        $datosLinCita = '<br><h2 class="h3 text-center text-warning">SERVICIOS ELEGIDOS</h2><hr>';
        $datosLinCita = $datosLinCita. "
            <div style='margin: 0 auto' class='table-responsive text-center'>
            <table>
                    <thead>
                        <tr>
                            <th>SERVICIO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>SUBTOTAL</th>
                        </tr>
                        </thead>
                    <tbody>
                        <tr>";
        // AHORA VAMOS A GRABAR CADA UNA DE LAS LÍNEAS DEL SERVICIO.
        $numLinea = 1;
        $i=0;
        $descripcionServicios= "";
        for($i=0;$i<count($datosServicios);$i++) {
            if ($datosServicios[$i] -> getActivo() == 2) {
                $cnn1 = conectar_db();
                $codServicio = $datosServicios[$i] -> getCodServicio();
                $descripcionServicios = $descripcionServicios . $datosServicios[$i] -> getDescripcion() . "\n";
                $datosLinCita = $datosLinCita. "<tr><td>" . $datosServicios[$i] -> getDescripcion() . "</td>";

                $unidades = 1;
                $datosLinCita = $datosLinCita. "<td>" . $unidades . "</td>";

                $precio = $datosServicios[$i] -> getPrecio();
                $datosLinCita = $datosLinCita. "<td class='text-right'>" . number_format(round($precio, 2), 2, ",", ".") . " € </td>";

                $datosLinCita = $datosLinCita. "<td class='text-right'><strong>" . number_format(round(($unidades * $precio), 2), 2, ",", ".") . " € </strong></td></td>";

                $stmt = $cnn1->prepare("insert into lincitas values(:numLinea, :codCita, :codServicio, :unidades, :precio)");
                $rows = $stmt->execute(array(":numLinea"=>$numLinea, ":codCita"=>$codCita, ":codServicio"=>$codServicio, ":unidades"=>$unidades, ":precio"=>$precio));
                $numLinea = $numLinea + 1;
            }
        }

        $datosLinCita = $datosLinCita. "</tbody></table>";
        $datosLinCita = $datosLinCita. "<hr><h6 class='h6 text-justify text-info'><strong>Ubicación Centro</strong></h6><hr>
                                        <p class='text-justify'>Beauty And Shop</p>
                                        <p class='text-justify'>C/ Fuerteventura, nº 145</p>
                                        <p class='text-justify'>48001 - Madrid, España</p><br>
                                        <h6 class='h6 text-justify text-info'><strong>Detalles de Contacto del Centro</strong></h6><hr>
                                        <p class='text-justify'>Email: <strong>info@beautyandshop.net</strong></p></p>
                                        <p class='text-justify'>Teléfono: <strong>+34 676 312 36</p></p>
                                        <br><hr><h3 class='h3 text-center text-success'>GRACIAS POR CONFIAR EN NOSOTROS</h3><hr><br></div><div class='col-xs-12 col-sm-2 col-md-2'></div></div>";


       // AHORA VAMOS A GRABAR LA CABECERA DEL SERVICIO.
        $activo = 1;
        $stmt = $cnn->prepare("insert into citas values(:codCita, :codUsuario, :fechaPedido, :horaCita, :total, :activo)");
        $rows = $stmt->execute(array(":codCita"=>$codCita, ":codUsuario"=>$cusu, ":fechaPedido"=>$fechaServicio, ":horaCita"=>$horaCita, ":total"=>$total, ":activo"=>$activo));
        if ($rows == 1) {

            // MANDAMOS EL EMAIL CON LOS DATOS DE LA CITA.
            $datosUsuarios = [];
            $datosUsuarios = llenarArray(0);
            $i=0;
            $encontrado=0;
            for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
                $cusuAux = $datosUsuarios[$i]-> getCodUsuario();
                if (($cusuAux == $cusu)) {
                    $email_to = $datosUsuarios[$i]-> getEmail();
                    $nombre = $datosUsuarios[$i] -> getNombre();
                    $telefono = $datosUsuarios[$i] -> getTelefono();
                    $encontrado = 1;
                }
            }

            /* PREPARAMOS EL RESUMEN DE LA CITA RESERVADA */
            $datosCita = '<div class="container text-center"><div class="row"><div class="col-xs-12 col-sm-2 col-md-2"></div><div class="col-xs-12 col-sm-8 col-md-8"><h2 class="h3 text-center text-warning">RESUMEN DE SU RESERVA</h2><hr><br>';
            $datosCita = $datosCita. "
            <div style='margin: 0 auto;' class='table-responsive text-center'>
            <table>
                    <thead>
                        <tr>
                            <th>NOMBRE CLIENTE</th>
                            <th>FECHA CITA</th>
                            <th>HORA CITA</th>
                            <th>TELÉFONO</th>
                            <th>IMPORTE PAGAR</th>
                        </tr>
                        </thead>
                    <tbody>
                        <tr>";
                            $datosCita = $datosCita . '<td>' . $nombre . '</td>';
                            $datosCita = $datosCita . '<td>' . $fechaServicio . '</td>';
                            $datosCita = $datosCita . '<td>' . $horaCita . ' H</td>';
                            $datosCita = $datosCita . '<td>' . $telefono . '</td>';
                            $datosCita = $datosCita . '<td><strong>' . number_format(round($total, 2), 2, ",", ".") . ' €</strong></td>
                        </tr>
                    </tbody>
                </table>';

            /* ENVIAMOS EL EMAIL CON LA CITA RESERVADA */

           /* $email_from = "info@beautyandshop.net";
            $email_subject = "Resumen de su Reserva en BEAUTY AND SHOP";
            $email_message = "<h3 sytle='color:red;'>¡Buenas noticias! Tu cita está confirmada.</h3><br>" . $datosCita . $datosLinCita;
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
        
            @mail($email_to, $email_subject, $email_message, $headers);*/

			/*$email_from = "info@beautyandshop.net";
            $email_subject = "Tus datos de reserva en BEAUTY AND SHOP";

            $email_message = "Detalles de tu reserva:\n\n";
            $email_message .= "Cita: " . $horaCita . "\n";
            $email_message .= "Reservado para: " . strtoupper($nombre) . "\n";
            $email_message .= "Teléfono: " . $telefono . "\n";
            $email_message .= "Servicios Elegidos:\n\n";
            $email_message .= strtoupper($descripcionServicios) . "\n\n\n";
            $email_message .= "Gracias por confiar en BEAUTY And SHOP.\n\n\n";

			//echo $email_message ;
            //echo $datosCita . $datosLinCita ;
			
            // Creación de las cabeceras del email
            $headers = 'From: '.$email_from."\r\n".
            'Reply-To: '.$email_from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

			@mail($email_to, $email_subject, $email_message, $headers);*/

            //MUESTRO UN MENSAJE INFORMANDO QUE LA CITA SE HA REGISTRADO DE FORMA CORRECTA. GRACIAS POR CONFIAR EN NOSOTROS.-->
            echo "<div class='container smsOk'><b>ATENCIÓN!!! CITA REGISTRADA CORRECTAMENTE.</b><br>GRACIAS POR CONFIAR EN NOSOTROS.</b></div><br>";

            return ($datosCita . $datosLinCita);
        }
    }

    function llenarArrayCitas($ordenar, $fecha) {
        $datosCitas = array ();

        $mysqli = new mysqli('lldn637.servidoresdns.net:3306', 'qaim611', 'Beautyandshop+', 'qaim611');
        
        $i=0;
                
        if ($ordenar == 0) {
            $query = $mysqli->query("SELECT * FROM citas WHERE fechaCita LIKE '%$fecha%' AND activo = 1");
        }
        elseif ($ordenar == 1) {
            $query = $mysqli->query("SELECT * FROM citas WHERE fechaCita LIKE '%$fecha%' AND activo = 1 ORDER BY fechaCita, horaCita ASC");
        }
        elseif ($ordenar == 2) {
            $query = $mysqli->query("SELECT * FROM citas WHERE fechaCita LIKE '%$fecha%' AND activo = 1 ORDER BY fechaCita, horaCita DESC");
        }
        
        $i=0;
        while ($fila = mysqli_fetch_array($query)) {
            $datosCitas[$i] = new cita();
            $datosCitas[$i] -> setCodCita($fila["codCita"]);
            $datosCitas[$i] -> setCodUsuario($fila["codUsuario"]);
            $datosCitas[$i] -> setFechaCita($fila["fechaCita"]);
            $datosCitas[$i] -> setHoraCita($fila["horaCita"]);
            $datosCitas[$i] -> setTotal($fila["total"]);
            $i++;
        }
        return($datosCitas);
    }

    function llenarArrayCitasTodas($ordenar) {
        $datosCitas = array ();

        $mysqli = new mysqli('lldn637.servidoresdns.net:3306', 'qaim611', 'Beautyandshop+', 'qaim611');
        
        $i=0;
                
        if ($ordenar == 0) {
            $query = $mysqli->query("SELECT * FROM citas WHERE activo = 1");
        }
        elseif ($ordenar == 1) {
            $query = $mysqli->query("SELECT * FROM citas WHERE activo = 1 ORDER BY fechaCita, horaCita ASC");
        }
        elseif ($ordenar == 2) {
            $query = $mysqli->query("SELECT * FROM citas WHERE activo = 1 ORDER BY fechaCita DESC, horaCita ASC");
        }
        
        $i=0;
        while ($fila = mysqli_fetch_array($query)) {
            $datosCitas[$i] = new cita();
            $datosCitas[$i] -> setCodCita($fila["codCita"]);
            $datosCitas[$i] -> setCodUsuario($fila["codUsuario"]);
            $datosCitas[$i] -> setFechaCita($fila["fechaCita"]);
            $datosCitas[$i] -> setHoraCita($fila["horaCita"]);
            $datosCitas[$i] -> setTotal($fila["total"]);
            $i++;
        }
        return($datosCitas);
    }

    /************** FUNCIONES MANTENIMIENTO SERVICIOS *******************************/
    function llenarArrayLinCitas($ordenar) {
        $datosLinCitas = array ();

        $cnn = conectar_db();
        $i=0;
        
        if ($ordenar == 0) {
            $stmt = $cnn->prepare("SELECT * FROM lincitas");
        }
        elseif ($ordenar == 1) {
            $stmt = $cnn->prepare("SELECT * FROM lincitas order by codCita, numLinea asc");
        }
        else {
            $stmt = $cnn->prepare("SELECT * FROM Lincitas order by codCita, numLinea desc");
        }
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "lincita");
        $i=0;
        
        while($fila = $stmt->fetch()) {
            $datosLinCitas[$i] = new lincita();
            $datosLinCitas[$i] -> setNumLinea($fila->getNumLinea());
            $datosLinCitas[$i] -> setCodCita($fila->getCodCita());
            $datosLinCitas[$i] -> setCodServicio($fila->getCodServicio());
            $datosLinCitas[$i] -> setUnidades($fila->getUnidades());
            $datosLinCitas[$i] -> setPrecio($fila->getPrecio());
            $i++;
        }
        return($datosLinCitas);
        
    }

    function mostrarTodasCitas($datosCitas) {
        $fechaHoy = date("Y-m-d");
        
        $datosUsuarios = array ();
        $datosUsuarios = llenarArray(1);

        $datosLinCitas = array ();
        $datosLinCitas = llenarArrayLinCitas(1);

        $datosServicios = array ();
        $datosServicios = llenarArrayServicios(1);

        $datosCita = '<br><hr><h3 class="h3 text-center text-warning">LISTADO DE CITAS</h3><hr>';
        /*<hr
        <h3 class="h3 text-center text-warning">CITAS DÍA:</h3>
        <h4 class="h4 text-center text-info">' . $fechaConsulta . '</h4><hr>';*/
        
        $i=0;
        for($i=0;$i<count($datosCitas);$i++) {
             $fechaAux = $datosCitas[$i] -> getFechaCita(); 
            // MONTO LA FECHA EN EL FORMATO EUROPEO
            $array = explode("-", $fechaAux);
            $year = intval($array[0]);
            $mes = intval($array[1]);
            $dia = intval($array[2]);
            if ($dia <= 9) {
                $dia = "0" . $dia;
            }
            $fechaConsulta =  $dia . '/' . $mes . "/" . $year; 
            $datosCita = $datosCita . '
            <div class="table-responsive"> 
                <table>
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>HORA</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>' . $fechaConsulta . '</td>
                        <td>' . $datosCitas[$i]->getHoraCita() . ' H</td>
                    </tr>
                    <thead>
                        <tr>
                            <th>DATOS CLIENTE</th>
                            <th>TELÉFONO</th>
                        </tr>
                    </thead>';
                    
                    // BUSCAMOS LOS DATOS DEL CLIENTE DE LA CITA
                    $codUsuarioBuscar = $datosCitas[$i]->getCodUsuario();
                    $codCitaBuscar = $datosCitas[$i]->getCodCita();
                        
                    $j = 0;
                    $enc = 0;
                    $datosCita = $datosCita . 
                    '<tr>';
                        for ($j=0;count($datosUsuarios) && $enc == 0;$j++) {
                            if ($codUsuarioBuscar == $datosUsuarios[$j]->getCodUsuario()) {
                                $datosCita = $datosCita . '<td class="datosAgenda">' . $datosUsuarios[$j]->getNombre() . '</td>'; 
                                $datosCita = $datosCita . '<td class="datosAgenda">' . $datosUsuarios[$j]->getTelefono() . '</td>';
                                $enc = 1;     
                            }
                        }
                        $datosCita = $datosCita . 
                    '</tr>'; 
                
                    $datosCita = $datosCita . 
                    '<thead>
                    <tr>
                        <th colspan="2">SERVICIOS</th>
                    </tr>
                    </thead>
                    <tr class="text-left">
                        <td colspan="2">';
						    $j=0;
                            for($j=0;$j<count($datosLinCitas);$j++) {
                                if($codCitaBuscar == $datosLinCitas[$j]->getCodCita()) {
                                    $codServicioBuscar = $datosLinCitas[$j]->getCodServicio();

                                    $k=0;
                                    $enc=0;
                                    
                                    for($k=0;$k<count($datosServicios) && $enc == 0;$k++) {
                                        if ($codServicioBuscar == $datosServicios[$k]->getCodServicio()) {
                                            $datosCita = $datosCita . '<span class="datosAgenda">' . $datosServicios[$k]->getDescripcion() . ', 
                                            </span>';
                                            
                                            $enc=1;
                                        }
                                    }
                                }
                            }
                        
                        $datosCita = $datosCita . 
                        '</td>
                    </tr>
                </table>
            </div>
            
            <div style="margin-top:5px;" class="text-center">
                <a target="_blank" href="/beautyandshop/admin/verUsuario.php?cusuv=' . $codUsuarioBuscar .'"><button style="margin-right:4px" class="btn btn-info">VER CLIENTE</button></a>';
				if ($fechaAux >= $fechaHoy) {
                    $datosCita = $datosCita .
                    '<a target="_blank" href="/beautyandshop/citas/editarCita.php?ct=' . $codCitaBuscar .'"><button class="btn btn-success">MODIFICAR CITA</button></a>
                    <a href="/beautyandshop/citas/anularCita.php?ct=' . $codCitaBuscar .'"><button class="btn btn-danger">ANULAR CITA</button></a>';
                }
                $datosCita = $datosCita . '
            </div><hr>';
        }
        return ($datosCita);
    }
    function mostrarTodasMisCitas($datosCitas) {
        $fechaHoy = date("Y-m-d");
        
        $datosUsuarios = array ();
        $datosUsuarios = llenarArray(1);

        $datosLinCitas = array ();
        $datosLinCitas = llenarArrayLinCitas(1);

        $datosServicios = array ();
        $datosServicios = llenarArrayServicios(1);

        $datosCita = '<br><hr><h3 class="h3 text-center text-warning">MIS CITAS</h3><hr>';
        /*<hr
        <h3 class="h3 text-center text-warning">CITAS DÍA:</h3>
        <h4 class="h4 text-center text-info">' . $fechaConsulta . '</h4><hr>';*/
        
        $i=0;
        for($i=0;$i<count($datosCitas);$i++) {
             $fechaAux = $datosCitas[$i] -> getFechaCita(); 
            // MONTO LA FECHA EN EL FORMATO EUROPEO
            $array = explode("-", $fechaAux);
            $year = intval($array[0]);
            $mes = intval($array[1]);
            $dia = intval($array[2]);
            if ($dia <= 9) {
                $dia = "0" . $dia;
            }
            $fechaConsulta =  $dia . '/' . $mes . "/" . $year; 
            $datosCita = $datosCita . '
            <div class="table-responsive"> 
                <table>
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>HORA</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>' . $fechaConsulta . '</td>
                        <td>' . $datosCitas[$i]->getHoraCita() . ' H</td>
                    </tr>';
                    
                    
                    // BUSCAMOS LOS SERVICIOS DE CADA CITA
                   
                    $codCitaBuscar = $datosCitas[$i]->getCodCita();
                    $datosCita = $datosCita . 
                    '<thead>
                    <tr>
                        <th colspan="2">SERVICIOS</th>
                    </tr>
                    </thead>
                    <tr class="text-left">
                        <td colspan="2">';
						    $j=0;
                            for($j=0;$j<count($datosLinCitas);$j++) {
                                if($codCitaBuscar == $datosLinCitas[$j]->getCodCita()) {
                                    $codServicioBuscar = $datosLinCitas[$j]->getCodServicio();

                                    $k=0;
                                    $enc=0;
                                    
                                    for($k=0;$k<count($datosServicios) && $enc == 0;$k++) {
                                        if ($codServicioBuscar == $datosServicios[$k]->getCodServicio()) {
                                            $datosCita = $datosCita . '<span class="datosAgenda">' . $datosServicios[$k]->getDescripcion() . ', 
                                            </span>';
                                            
                                            $enc=1;
                                        }
                                    }
                                }
                            }
                        
                        $datosCita = $datosCita . 
                        '</td>
                    </tr>
                </table>
            </div>
           
            <div style="margin-top:5px;" class="text-center">';
                if ($fechaAux >= $fechaHoy) {
                    $datosCita = $datosCita .
                    '<a target="_blank" href="/beautyandshop/citas/editarCita.php?ct=' . $codCitaBuscar .'"><button class="btn btn-success">MODIFICAR CITA</button></a>
                    <a href="/beautyandshop/citas/anularCita.php?ct=' . $codCitaBuscar .'"><button class="btn btn-danger">ANULAR CITA</button></a>';
                }
                $datosCita = $datosCita . '
            </div><hr>';
        }
        return ($datosCita);
    }


    function mostrarCitas($datosCitas) {
        $fechaHoy = date("Y-m-d");
        $datosUsuarios = array ();
        $datosUsuarios = llenarArray(1);

        $datosLinCitas = array ();
        $datosLinCitas = llenarArrayLinCitas(1);

        $datosServicios = array ();
        $datosServicios = llenarArrayServicios(1);

        $datosCita = '';
        /*<hr
        <h3 class="h3 text-center text-warning">CITAS DÍA:</h3>
        <h4 class="h4 text-center text-info">' . $fechaConsulta . '</h4><hr>';*/
        
                $i=0;
                for($i=0;$i<count($datosCitas);$i++) {
                    $datosCita = $datosCita . '
                    <div class="cita col-12">
							<div class="text-center horas">';
                                $datosCita = $datosCita . '<h3>' . $datosCitas[$i]->getHoraCita() . ' H</h3>
                            </div>';

                        // BUSCAMOS LOS DATOS DEL CLIENTE DE LA CITA
                        $fechaAux = $datosCitas[$i] -> getFechaCita(); 
                        $codUsuarioBuscar = $datosCitas[$i]->getCodUsuario();
                        $codCitaBuscar = $datosCitas[$i]->getCodCita();
                    

                        $j = 0;
                        $enc = 0;
                        $datosCita = $datosCita . 
                        '<div class="text-left">
                            <h4 class="titulosAgenda">CLIENTE</h4>';
                            for ($j=0;count($datosUsuarios) && $enc == 0;$j++) {
                                if ($codUsuarioBuscar == $datosUsuarios[$j]->getCodUsuario()) {
                                    $datosCita = $datosCita . '<p class="datosAgenda">' . $datosUsuarios[$j]->getNombre() . '</p>'; 
                                    //$datosCita = $datosCita . '<p class="datosAgenda">' . $datosUsuarios[$j]->getTelefono() . '</p>
                                    
                                    $enc = 1;     
                                }
                            }
                        $datosCita = $datosCita . 
                        '</div>'; 
                            
                        $datosCita = $datosCita . '
                        <div class="text-left">
							<h4 class="titulosAgenda">SERVICIOS</h4>';
                            $j=0;
                            for($j=0;$j<count($datosLinCitas);$j++) {
                                if($codCitaBuscar == $datosLinCitas[$j]->getCodCita()) {
                                    $codServicioBuscar = $datosLinCitas[$j]->getCodServicio();

                                    $k=0;
                                    $enc=0;
                                        
                                    for($k=0;$k<count($datosServicios) && $enc == 0;$k++) {
                                        if ($codServicioBuscar == $datosServicios[$k]->getCodServicio()) {
                                            $datosCita = $datosCita . '<span class="datosAgenda">' . $datosServicios[$k]->getDescripcion() . ', 
                                            </span>';
                                                
                                            $enc=1;
                                        }
                                    }
                                }
                            }
                        $datosCita = $datosCita . 
                        '</div><br>
                        <div class="text-center">
                            <a target="_blank" href="/beautyandshop/admin/verUsuario.php?cusuv=' . $codUsuarioBuscar . '"><button class="btn btn-info">VER CLIENTE</button></a>';
                            if ($fechaAux >= $fechaHoy) {
                                $datosCita = $datosCita .
                                '<a target="_blank" href="/beautyandshop/citas/editarCita.php?ct=' . $codCitaBuscar .'"><button style="margin-left:5px;"class="btn btn-success">MODIFICAR CITA</button></a>
                                <a href="/beautyandshop/citas/anularCita.php?ct=' . $codCitaBuscar .'"><button class="btn btn-danger">ANULAR CITA</button></a>';
                            }
                        $datosCita = $datosCita . '
                        </div>
                    </div>';
                }
                   
                        
        return ($datosCita);
    }

   /************** FUNCIONES MANTENIMIENTO SERVICIOS *******************************/
    function llenarArrayServicios($ordenar) {
        $datosServicios = array ();

        $cnn = conectar_db();
        $i=0;
        
        if ($ordenar == 0) {
            $stmt = $cnn->prepare("SELECT * FROM servicios");
        }
        elseif ($ordenar == 1) {
            $stmt = $cnn->prepare("SELECT * FROM servicios order by descripcion asc");
        }
        else {
            $stmt = $cnn->prepare("SELECT * FROM servicios order by descripcion desc");
        }
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "servicio");
        $i=0;
        
        while($fila = $stmt->fetch()) {
            $datosServicios[$i] = new servicio();
            $datosServicios[$i] -> setCodServicio($fila->getCodServicio());
            $datosServicios[$i] -> setDescripcion($fila->getDescripcion());
            $datosServicios[$i] -> setPrecio($fila->getPrecio());
            $datosServicios[$i] -> setDescuento($fila->getDescuento());
            $datosServicios[$i] -> setDuracionServicio($fila->getDuracionServicio());
            $datosServicios[$i] -> setCodFamilia($fila->getCodFamilia());
            $datosServicios[$i] -> setActivo($fila->getActivo());
            
            $i++;
        }
        return($datosServicios);
    }

    function mostrarServicios ($datosServicios){
        
        $datosServicio = "<h1>LISTADO SERVICIOS</h1>";
        $datosServicio = $datosServicio . "
        <div class='table-responsive'> <table><thead>
            <tr>
                <th>CÓDIGO</th>
                <th>DESCRIPCIÓN</th>
                <th>PVP</th>
                <th>DTO.</th>
                <th>DURACIÓN</th>
                <th>FAMILIA</th>
                <th>ACTIVO</th>
                <th>EDITAR</th>
                <th>BORRAR</th>";
                

            $datosServicio = $datosServicio . "</tr></thead><tbody>";
            $indice = 0;
            for($i=0;$i<count($datosServicios);$i++) {
                $codigo=$datosServicios[$i]->getCodServicio();
                $datosServicio = $datosServicio . "<tr>";
                $datosServicio = $datosServicio . "<td>{$codigo}</td>"; 
                $datosServicio = $datosServicio . "<td>{$datosServicios[$i]->getDescripcion()}</td>";
                $datosServicio = $datosServicio . "<td>{$datosServicios[$i]->getPrecio()}</td>"; 
                $datosServicio = $datosServicio . "<td>{$datosServicios[$i]->getDescuento()}</td>"; 
                $datosServicio = $datosServicio . "<td>{$datosServicios[$i]->getDuracionServicio()}</td>"; 
                $datosServicio = $datosServicio . "<td>{$datosServicios[$i]->getCodFamilia()}</td>";  
                $datosServicio = $datosServicio . "<td>{$datosServicios[$i]->getActivo()}</td>";
                $datosServicio = $datosServicio . "<td><a href=/beautyandshop/servicios/editarServicio.php?codigo=" . $codigo . "><img src='/beautyandshop/img/modificar.png' width='50px' alt='Editar'></a></td>";
                if ($datosServicios[$i]->getActivo() == 1) {
                    $datosServicio = $datosServicio . "<td><a href=/beautyandshop/servicios/borrarServicio.php?codigo=" . $codigo . "><img src='/beautyandshop/img/borrar.png' width='50px' alt='Borrar'></a></td>";
                }
                $datosServicio = $datosServicio . "</tr>";
                $indice = $indice + 1;
            }
            $datosServicio = $datosServicio . "</tbody></table>
        </div>";
        
        return ($datosServicio);
    }

    function addServicio ($tipo, $descripcion, $precio, $descuento, $duracionServicio, $codFamilia, $activo) {
        
        // CALCULAMOS EL SIGUIENTE CÓDIGO DE LA FAMILIA.

        $codServicio = 0;
         $cnn = conectar_db();
         $stmt = $cnn->prepare("SELECT MAX(codServicio) AS mayor FROM servicios");
         $rows = $stmt->execute();
             
        if($fila = $stmt->fetch()) {
             $codServicio = $fila["mayor"];
             $codServicio = $codServicio + 1;
        }
        else {
            $codServicio = 1;
        }
        
        $stmt = $cnn->prepare("insert into servicios values(:codServicio, :descripcion, :precio, :descuento, :duracionServicio, :codFamilia, :activo)");
        $rows = $stmt->execute(array(":codServicio"=>$codServicio, ":descripcion"=>$descripcion, ":precio"=>$precio, ":descuento"=>$descuento, ":duracionServicio"=>$duracionServicio, ":codFamilia"=>$codFamilia, ":activo"=>$activo));
        if ($rows == 1) {
            echo "¡Registro creado satisfactoriamente";
            header ("location:/beautyandshop/servicios/zonaServicios.php");
        }
        else {
            echo "<div class='smsError'>ERROR!!. NO SE HA PODIDO AÑADIR CORRECTAMENTE EL SERVICIO.</div>";
        }
    }

    function updateServicio ($tipo, $codServicio, $descripcion, $precio, $descuento, $duracionServicio, $codFamilia, $activo) {
        
        $cnn = conectar_db();
        $stmt =$cnn->prepare("update servicios SET descripcion= :descripcion, precio= :precio, descuento= :descuento, duracionServicio= :duracionServicio, codFamilia= :codFamilia, activo= :activo where codServicio= :codServicio");
        
        if ($stmt->execute(array(":descripcion"=>$descripcion, ":precio"=>$precio, ":descuento"=>$descuento, ":duracionServicio"=>$duracionServicio, ":codFamilia"=>$codFamilia, ":activo"=>$activo, ":codServicio"=>$codServicio))) {
            header ("location:/beautyandshop/servicios/zonaServicios.php");
        }
        else {
            echo "<div class='smsError'>ERROR!!. NO SE HA PODIDO MODIFICAR CORRECTAMENTE EL SERVICIO.</div>";
        }

    }

 
    /********** FUNCIONES MANTENIMIENTO FAMILIAS SERVICIOS **************************/
    function addFamilia ($nombreFamilia, $activoFamilia) {
        
        // CALCULAMOS EL SIGUIENTE CÓDIGO DE LA FAMILIA.
         $cnn = conectar_db();
         $stmt = $cnn->prepare("SELECT MAX(codFamilia) AS mayor FROM familias");
         $rows = $stmt->execute();
             
        if($fila = $stmt->fetch()) {
             $codFamilia = $fila["mayor"];
             $codFamilia = $codFamilia + 1;
        }
        else {
            $codFamilia = 1;
        }
        
        $stmt = $cnn->prepare("insert into familias values(:codFamilia, :nombre, :activo)");
        $rows = $stmt->execute(array(":codFamilia"=>$codFamilia, ":nombre"=>$nombreFamilia, ":activo"=>$activoFamilia));
        if ($rows == 1) {
            echo "¡Registro creado satisfactoriamente";
            header ("location:/beautyandshop/familias/zonaFamilias.php");
        }
        else {
            echo "<div class='smsError'>ERROR!!. NO SE HA PODIDO AÑADIR CORRECTAMENTE LA FAMILIA.</div>";
        }
    }

    function updateFamilia ($codFamilia, $nombre, $activo) {
        $cnn = conectar_db();
        $stmt =$cnn->prepare("update familias SET nombre= :nombre, activo= :activo where codFamilia= :codFamilia");
        
        if ($stmt->execute(array(":nombre"=>$nombre, ":activo"=>$activo, ":codFamilia"=>$codFamilia))) {
            header ("location:/beautyandshop/familias/zonaFamilias.php");
        }
        else {
            echo "<div class='smsError'>ERROR!!. NO SE HA PODIDO MODIFICAR CORRECTAMENTE LA FAMILIA.</div>";
        }
    }

    function llenarArrayFamilias($ordenar) {
        $datosFamilias = array ();

        $cnn = conectar_db();
        $i=0;
        
        if ($ordenar == 0) {
            $stmt = $cnn->prepare("SELECT * FROM familias");
        }
        elseif ($ordenar == 1) {
            $stmt = $cnn->prepare("SELECT * FROM familias order by nombre asc");
        }
        elseif ($ordenar == 2) {
            $stmt = $cnn->prepare("SELECT * FROM familias order by nombre desc");
        }
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "familia");
        $i=0;
        
        while($fila = $stmt->fetch()) {
            $datosFamilias[$i] = new familia();
            $datosFamilias[$i] -> setCodigoFamilia($fila->getCodigoFamilia());
            $datosFamilias[$i] -> setNombre($fila->getNombre());
            $datosFamilias[$i] -> setActivo($fila->getActivo());
            $i++;
        }
        return($datosFamilias);
    }

    function mostrarFamilias ($datosFamilias){
        
        $datosFamilia = "<h1>FAMILIAS</h1>";
        $datosFamilia = $datosFamilia . "
        <div class='table-responsive'> <table><thead>
            <tr>
                <th>CÓDIGO</th>
                <th>NOMBRE</th>
                <th>ACTIVA</th>
                <th>EDITAR</th>
                <th>BORRAR</th>";
                

            $datosFamilia = $datosFamilia . "</tr></thead><tbody>";
            $indice = 0;
            for($i=0;$i<count($datosFamilias);$i++) {
                $codigo=$datosFamilias[$i]->getCodigoFamilia();
                $datosFamilia = $datosFamilia . "<tr>";
                $datosFamilia = $datosFamilia . "<td>{$codigo}</td>"; 
                $datosFamilia = $datosFamilia . "<td>{$datosFamilias[$i]->getNombre()}</td>"; 
                $datosFamilia = $datosFamilia . "<td>{$datosFamilias[$i]->getActivo()}</td>";
                $datosFamilia = $datosFamilia . "<td><a href=/beautyandshop/familias/editarFamilia.php?codigo=" . $codigo . "><img src='/beautyandshop/img/modificar.png' width='50px' alt='Editar'></a></td>";
                if ($datosFamilias[$i]->getActivo() == 1) {
                    $datosFamilia = $datosFamilia . "<td><a href=/beautyandshop/familias/borrarFamilia.php?codigo=" . $codigo . "><img src='/beautyandshop/img/borrar.png' width='50px' alt='Borrar'></a></td>";
                }
                $datosFamilia = $datosFamilia . "</tr>";
                $indice = $indice + 1;
            }
            $datosFamilia = $datosFamilia . "</tbody></table>
        </div>";
        
        return ($datosFamilia);
    }

    function getFamilias() {
        $cnn = conectar_db();
        if (!$cnn) {
            var_dump("Error conectando con la base de datos: " . $cnn);
            die();
        }
        
        try {
            $stmt = $cnn->prepare("SELECT * FROM familias WHERE activo=1");
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_CLASS, "familia");
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    /************** FUNCIONES MANTENIMIENTO CATEGORIAS ******************************/
    function getCategoriasPadre(){

        $padre = array();
        $cnn = conectar_db();
        if (!$cnn) {
            var_dump("Error conectando con la base de datos: " . $cnn);
            die();
        }

        try {
            $stmt = $cnn->prepare("SELECT * FROM categorias WHERE codCatPadre = 0 AND activo = 1 ORDER BY nombre");
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'categoria');
            while ($res = $stmt->fetch()) {
                $padre[] = $res;
            }

            return $padre;
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    function getCategoriasHijas($padre){
        $hija = array();

        $cnn = conectar_db();
        if (!$cnn) {
            var_dump("Error conectando con la base de datos: " . $cnn);
            die();
        }

        try {
            $pad = $padre;
            $stmt = $cnn->prepare("SELECT * FROM categorias WHERE codCatPadre = $pad AND activo = 1 ORDER BY nombre");
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'categoria');
            while ($res = $stmt->fetch()) {
                $hija[] = $res;
            }
            if (!isset($hija)){
                return ;
            }else{
                return $hija;
            }

        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }
    function updateCategoria ($tipo, $codigo, $nombre, $activo, $codCatPadre) {
        $cnn = conectar_db();
                       
        $stmt =$cnn->prepare("update categorias SET nombre= :nombre, activo= :activo, codCatPadre= :codCatPadre where codigo= :codigo");
        
        if ($stmt->execute(array(":nombre"=>$nombre, ":activo"=>$activo, ":codCatPadre"=>$codCatPadre, ":codigo"=>$codigo))) {
            if ($tipo == 1) {
                header ("location:/beautyandshop/admin/zonaCategorias.php");
            }
            elseif ($tipo == 2) {
                header ("location:/beautyandshop/admin/zonaCategorias.php");    
            }
        }
        else {
            echo "ERROR!!!! No se ha podido modificar";
        }

    }
    function addCategoria ($tipo, $nombreCategoria, $activoCategoria, $categoriaPadre) {
        
        // CALCULAMOS EL SIGUIENTE CÓDIGO DE CATEGORIA.
         $cnn = conectar_db();
         $stmt = $cnn->prepare("SELECT MAX(codigo) AS mayor FROM categorias");
         $rows = $stmt->execute();
             
        if($fila = $stmt->fetch()) {
             $codigo = $fila["mayor"];
             $codigo = $codigo + 1;
         }
         else {
             $codigo = 1;
         }
        
        /*$datosCategorias = llenarArrayCategorias(0);
        
        $codigo = count($datosCategorias);
        $codigo++;*/

        /*for($i=0;$i<count($datosCategorias) && $encontrado == 0;$i++) {
            $nombreCategoriaAux = $datosCategorias[$i]-> getNombre();
            if($nombreCategoriaAux == $nombreCategoria) {
                $encontrado = 1;
            }
        }

        if ($encontrado == 1) {
            if ($tipo == 1) {
                header ("location:nuevaCategoria.php?tipo=1&errorcategoria=si");

            }
            else if ($tipo == 2) {
                header ("location:zonaTrabajador.php?tipo=2&errorcategoria=si");
            }
            
        }
        else {*/
            $stmt = $cnn->prepare("insert into categorias values(:nombre, :activo, :codCatPadre, :codigo)");
            
            $rows = $stmt->execute(array(":nombre"=>$nombreCategoria, ":activo"=>$activoCategoria, ":codCatPadre"=>$categoriaPadre, ":codigo"=>$codigo));
            
            
            if ($rows == 1) {
                echo "¡Registro creado satisfactoriamente";
                if ($tipo == 1) {
                    header ("location:/beautyandshop/admin/zonaCategorias.php?tipo=1");
                }
                else if ($tipo == 2) {
                    header ("location:/beautyandshop/admin/zonaCategorias.php?tipo=2");    
                }
            }
      //  }
    }

    function getCategorias() {
        $cnn = conectar_db();
        if (!$cnn) {
            var_dump("Error conectando con la base de datos: " . $cnn);
            die();
        }
        
        try {
            $stmt = $cnn->prepare("SELECT * FROM categorias WHERE activo = 1");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, "categoria");
        } 
        catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    function mostrarCategorias($datosCategorias, $tipoUsuario){
        
        $datosCategoria = "<h1>CATEGORIAS</h1>";
        $datosCategoria = $datosCategoria . "
        <div class='table-responsive'> <table><thead>
            <tr>
                <th>CÓDIGO</th>
                <th>NOMBRE</th>
                <th>COD. CATEGORIA PADRE</th>
                <th>ACTIVA</th>";
                if ($tipoUsuario != 3) {
                    $datosCategoria = $datosCategoria . "
                    
                    <th>EDITAR</th>
                    <th>BORRAR</th>";
                }

                $datosCategoria = $datosCategoria . "</tr></thead><tbody>";
            $indice = 0;
            for($i=0;$i<count($datosCategorias);$i++) {
                $codigo=$datosCategorias[$i]->getCodigo();
                $datosCategoria = $datosCategoria . "<tr>";
                $datosCategoria = $datosCategoria . "<td>{$datosCategorias[$i]->getCodigo()}</td>"; 
                $datosCategoria = $datosCategoria . "<td>{$datosCategorias[$i]->getNombre()}</td>"; 
                $datosCategoria = $datosCategoria . "<td>{$datosCategorias[$i]->getCodCatPadre()}</td>"; 
                $datosCategoria = $datosCategoria . "<td>{$datosCategorias[$i]->getActivo()}</td>";
               
                if($tipoUsuario == 1) {
                    $datosCategoria = $datosCategoria . "<td><a href=/beautyandshop/admin/editarCategoria.php?codigo=" . $codigo . "><img src='/beautyandshop/img/modificar.png' width='50px' alt='Editar'></a></td>";
                    $datosCategoria = $datosCategoria . "<td><a href=/beautyandshop/admin/borrarCategoria.php?codigo=" . $codigo . "><img src='/beautyandshop/img/borrar.png' width='50px' alt='Borrar'></a></td>";
                }
                elseif ($tipoUsuario == 2) {
                    $datosCategoria = $datosCategoria . "<td><a href=/beautyandshop/admin/editarCategoria.php?codigo=" . $codigo . "><img src='/beautyandshop/img/modificar.png' width='50px' alt='Editar'></a></td>";
                    $datosCategoria = $datosCategoria . "<td><a href=/beautyandshop/admin/borrarCategoria.php?codigo=" . $codigo . "><img src='/beautyandshop/img/borrar.png' width='50px' alt='Borrar'></a></td>";
                }
                $datosCategoria = $datosCategoria . "</tr>";
                $indice = $indice + 1;
            }
            $datosCategoria = $datosCategoria . "</tbody></table></div>";
        return $datosCategoria;
    }

    function llenarArrayCategorias($ordenar) {
        $datosCategorias = array ();

        $cnn = conectar_db();
        $i=0;
        
        if ($ordenar == 0) {
            $stmt = $cnn->prepare("SELECT * FROM categorias");
        }
        elseif ($ordenar == 1) {
            $stmt = $cnn->prepare("SELECT * FROM categorias order by nombre asc");
        }
        else {
            $stmt = $cnn->prepare("SELECT * FROM categorias order by nombre desc");
        }
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "categoria");
        $i=0;
        
        while($fila = $stmt->fetch()) {
            $datosCategorias[$i] = new categoria();
            //echo $fila->getCodigo();
            $datosCategorias[$i] -> setCodigo($fila->getCodigo());
            $datosCategorias[$i] -> setNombre($fila->getNombre());
            $datosCategorias[$i] -> setActivo($fila->getActivo());
            $datosCategorias[$i] -> setCodCatPadre($fila->getCodCatPadre());
            $i++;
        }
        return($datosCategorias);
        
    }

/************** FUNCIONES MANTENIMIENTO PRODUCTOS ******************************/
    function llenarArrayProductos($ordenar) {
        $datosProductos = array ();
        
        $cnn = conectar_db();
        $i=0;
        
        if ($ordenar == 0) {
            $stmt = $cnn->prepare("SELECT * FROM productos");
        }
        elseif ($ordenar == 1) {
            $stmt = $cnn->prepare("SELECT * FROM productos order by nombre asc");
        }
        else {
            $stmt = $cnn->prepare("SELECT * FROM productos order by nombre desc");
        }
        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "producto");
        $i=0;
        
        while($fila = $stmt->fetch()) {
            $datosProductos[$i] = new producto();
            $datosProductos[$i] -> setCodigo($fila->getCodigo());
            $datosProductos[$i] -> setNombre($fila->getNombre());
            $datosProductos[$i] -> setDescripcion($fila->getDescripcion());
            $datosProductos[$i] -> setCodigoCategoria($fila->getCodigoCategoria());
            $datosProductos[$i] -> setPrecio($fila->getPrecio());
            $datosProductos[$i] -> setDescuento($fila->getDescuento());
            $datosProductos[$i] -> setImagen($fila->getImagen());
            $datosProductos[$i] -> setActivo($fila->getActivo());
            $i++;
        }
        return($datosProductos);
        
    }

    /************** FUNCIONES MANTENIMIENTO USUARIOS ******************************/
    function llenarArray($ordenar) {
        $datosUsuarios = array ();

        $cnn = conectar_db();
        $i=0;
        
        if ($ordenar == 0) {
            $stmt = $cnn->prepare("SELECT * FROM usuarios");

        }
        elseif ($ordenar == 1) {
            $stmt = $cnn->prepare("SELECT * FROM usuarios ORDER BY nombre ASC");
        }
        else {
            $stmt = $cnn->prepare("SELECT * FROM usuarios ORDER BY nombre DESC");

        }

        
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "usuario");
        $i=0;
        
        while($fila = $stmt->fetch()) {
            $datosUsuarios[$i] = new usuario();
            $datosUsuarios[$i] -> setCodUsuario($fila->getcodUsuario());
            $datosUsuarios[$i] -> setDni($fila->getDni());
            $datosUsuarios[$i] -> setNombre($fila->getNombre());
            //$datosUsuarios[$i] -> setApellidos($fila->getApellidos());
            $datosUsuarios[$i] -> setClave($fila->getClave());
            $datosUsuarios[$i] -> setTipoUsuario($fila->getTipoUsuario());
            $datosUsuarios[$i] -> setDireccion($fila->getDireccion());
            $datosUsuarios[$i] -> setCp($fila->getCp());
            $datosUsuarios[$i] -> setPoblacion($fila->getPoblacion());
            $datosUsuarios[$i] -> setProvincia($fila->getProvincia());
            $datosUsuarios[$i] -> setTelefono($fila->getTelefono());
            $datosUsuarios[$i] -> setEmail($fila->getEmail());
            $datosUsuarios[$i] -> setActivo($fila->getActivo());
            $i++;
        }
        return($datosUsuarios);
    }

    function buscarUsuario ($email, $pwd, $datosUsuarios, &$tipoUsuario, &$activo, &$cusu) {
        $encontrado = 0;
        $activo = 2;
        
        //echo "EMAIL: " . $email;
        for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
            $emailAux = $datosUsuarios[$i]-> getEmail();
            $claveAux = $datosUsuarios[$i]-> getClave();
            //echo "EMAIL:" . $emailAux;
            
            //$activo = $datosUsuarios[$i] -> getActivo();
            //echo $claveAux;
            //echo $pwd;
            if (($emailAux == $email)) {
                //if (($claveAux == $pwd)) {
                if (password_verify($pwd, $claveAux)) {
                    $tipoUsuario = $datosUsuarios[$i]-> getTipoUsuario();
                    $email = $datosUsuarios[$i]-> getEmail();
                    $activo = $datosUsuarios[$i] -> getActivo();
                    $cusu = $datosUsuarios[$i] -> getCodUsuario();
                    //if ($activo == 1) {
                    $encontrado = 1;
                    //}
                   /*else {
                        echo "ENTRO AL ELSE DE ACTIVO = 1";
                        header ("location: aside-right.php?erroractivo=si");    
                    }*/
                }
                else {
                    
                        //echo "ENTRO AL ELSE DE CLAVE INCORRECTA";
                    //header ("location: aside-right.php?errorclave=si"); 
                }
            }
            else {
                //echo "ENTRO AL ELSE DE EMAIL DISTINTO";
                //header ("location:aside-right.php?errorsuario=si");
            }
           
        }
        //echo "EL EMAIL QUE DEVUELVO ES:" .  $dni;
        return($encontrado);
    }

    function NifValido ($nif) {
        $cadenaLetra = "TRWAGMYFPDXBNJZSQVHLCKE";
        $correcto = 1;
        if (strlen($nif) != 9) {
            $correcto = 0;
        }
        else {
            for ($i = 0;$i < (strlen($nif)-1) && $correcto == 1; $i++) {
                if (ord($nif[$i]) < 48 || ord($nif[$i]) > 57) {
                    $correcto = 0;
                }
            }
            $ultimaPos = (strlen($nif)-1);
            $mayus = strtoupper($nif[$ultimaPos]);
            if (ord($mayus) < 65 || ord($mayus) > 90) {
                $correcto = 0;
            }

            if ($correcto == 1) {
                $letraString = strtoupper(substr($nif, 8,8));
	            $resto = substr($nif, 0,8)%23;
                if ($cadenaLetra[$resto] != $letraString) {
	                    /*echo "<p class='error'>* Letra del DNI Incorrecta.</b>" . 
		                    " Se ha introducido $letraString".
		                " y la letra correcta es " . $cadenaLetra[$resto] . "</p>";*/
                     $correcto = 0;
                }
            }
	    }
        return ($correcto);
    }

    function validarEmail ($email) {
        $correcto = TRUE;
        // Quitamos los espacios que puedan haber al principio y al final del email
        $email = trim($email);

        // Indica la posición del caracter "@" o FALSE si no está
        $posicion_arroba = strpos($email, "@");

        // Busca la aparición de un punto (.) partir de la arroba
        $posicion_punto = strpos($email, ".", $posicion_arroba); 

        if ($posicion_arroba && $posicion_punto 
            && $email[$posicion_arroba-1] != " " && $email[$posicion_arroba+1] != " "
            && $email[$posicion_punto-1] != " " && $email[$posicion_punto+1] != " ") {
            
            $usuario = substr($email, 0, $posicion_arroba);
            $dominio = substr($email, $posicion_arroba + 1); 
        } 
        else {
           // echo "<p class='error'> *No es una dirección de email válida<br></p>"; 
            $correcto = FALSE;
            if (!$posicion_arroba) {
                $correcto = FALSE;
            }
            if (!$posicion_punto) {
                $correcto = FALSE;
            }
        }
        return ($correcto);
    }

    function addUsuario ($tipo, $cp, $dni, $clave, $email, $nombre, $direccion, $poblacion, $provincia, $telefono, $tipoUsuario, $activo) {
        $cnn = conectar_db();
        
        // CALCULAMOS EL SIGUIENTE CÓDIGO DE USUARIO.
        $cnn = conectar_db();
        $stmt = $cnn->prepare("SELECT MAX(codUsuario) AS mayor FROM usuarios");
        $rows = $stmt->execute();
            
        if($fila = $stmt->fetch()) {
            $cusu = $fila["mayor"];
            $cusu = $cusu + 1;
        }
        else {
            $cusu = 1;
        }
        //echo "SIGUIENTE USUARIO: " . $cusu;
        $stmt = $cnn->prepare("insert into usuarios values(:codUsuario, :dni, :clave, :email, :nombre, :direccion, :cp, :poblacion, :provincia, :telefono, :tipoUsuario, :activo)");
           
        $rows = $stmt->execute(array(":codUsuario"=>$cusu, ":dni"=>$dni, ":clave"=>$clave, ":email"=>$email, ":nombre"=>$nombre, ":direccion"=>$direccion, ":cp"=>$cp, ":poblacion"=>$poblacion, ":provincia"=>$provincia, ":telefono"=>$telefono, ":tipoUsuario"=>$tipoUsuario, ":activo"=>$activo));

        if ($rows == 1) {
            echo "¡Registro creado satisfactoriamente";
            if ($tipo == 1) {
                header ("location:/beautyandshop/admin/zonaUsuarios.php");
            }
            else if ($tipo == 2) {
                header ("location:/beautyandshop/admin/zonaUsuarios.php");  
            }
            else if ($tipo == 3) {
                //echo "ENTRO AL TIPO USUARIO 3";
                session_start();
                $_SESSION["email"]=$email;
                $_SESSION ["cusu"]=$cusu;
                $_SESSION["tipoUsuario"]=$tipoUsuario;
                $_SESSION["tipo"]=$tipoUsuario;
                $_SESSION["clave"]=$clave;
                $_SESSION["autentificado"] = "OK";
                header ("location:/beautyandshop/index.php");    
            }
        }
       
    }

    function mostrarUsuario($cusu, $tipo){
        //echo $tipo;
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("Select * from usuarios where codUsuario = :codUsuario");
        $rows = $stmt->execute(array(":codUsuario"=>$cusu));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

        if ($rows == 1) {
            $datosUsuario = "<h1>DATOS USUARIO</h1>"
            
            
        . " <table class='tablaDatos table-hover'>";
                $indice = 0;
                While($fila = $stmt->fetch())  {

                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>CÓDIGO</th> ";
                        $datosUsuario = $datosUsuario . "<td>$cusu</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>D.N.I.:</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getDni()}</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>EMAIL</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getEmail()}</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>TELÉFONO</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getTelefono()}</td>
                    </tr>
            </table>";
            $datosUsuario = $datosUsuario . "</table>
            <br /><h3> DIRECCIÓN ENVÍO</h3>
            <table class='tablaDatos table-hover'>";    
            $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>NOMBRE Y APELLIDOS</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getNombre()}</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>DIRECCIÓN</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getDireccion()}</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>CÓDIGO POSTAL</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getCp()}</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>POBLACIÓN</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getPoblacion()}</td>
                    </tr>";
                    $datosUsuario = $datosUsuario . "
                    <tr>
                        <th>PROVINCIA</th> ";
                        $datosUsuario = $datosUsuario . "<td>{$fila->getProvincia()}</td>
                    </tr></table><br><br><br>";
                    if ($tipo == 3) {
                        $datosUsuario = $datosUsuario .  "<br>
                        <div class='divTablaDatos'>
                            <button class='mybtn text-center'>
                                <a href='editarUsuario.php?cusu=" . $cusu . "'><img src='/beautyandshop/img/modificar.png' width='50px' alt='Editar'>Editar</a>
                            </button>
                            
                            <button class='mybtn text-center'>
                                <a href='borrarUsuario.php?cusu=" . $cusu . "'><img src='/beautyandshop/img/borrar.png' width='50px' alt='Borrar'>Borrar</a>
                            </button>";
                            
                            $datosUsuario = $datosUsuario . 
                        "</div><hr />";
                    }
                    $indice = $indice + 1;
                }
        }
        else {
            $datosUsuario = "";
        }
    
        return $datosUsuario;
    }

    function updateClave ($clave, $codUsuario) {

        $cnn = conectar_db();
            
        $stmt =$cnn->prepare("update usuarios SET clave= :clave where codUsuario= :codUsuario");
            
        if ($stmt->execute(array(":clave"=>$clave, ":codUsuario"=>$codUsuario))) {
            echo "¡Clave modificada satisfactoriamente";
            header ("location:/beautyandshop/index.php?claveOk=si");
        }
        else {
            echo "ERROR!!!! No se ha podido modificar";
        }
    }

    function updateUsuario ($cusu, $tipo, $cp, $tipoUsuario, $clave, $dni, $nombre, $direccion, $poblacion, $provincia, $telefono, $email, $activo) {
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("update usuarios SET tipoUsuario= :tipoUsuario, cp= :cp, clave= :clave, nombre= :nombre, direccion= :direccion, poblacion= :poblacion, provincia= :provincia, telefono= :telefono, email= :email, activo= :activo, dni= :dni where codUsuario= :codUsuario");
        //$rows = $stmt->execute(array(":rol"=>$rol, ":clave"=>$clave, ":nombre"=>$nombre, ":direccion"=>$direccion, ":localidad"=>$localidad, ":provincia"=>$provincia, ":telefono"=>$telefono, ":email"=>$email, ":dni"=>$dni));

        if ($stmt->execute(array(":tipoUsuario"=>$tipoUsuario, ":cp"=>$cp, ":clave"=>$clave, ":nombre"=>$nombre, ":direccion"=>$direccion, ":poblacion"=>$poblacion, ":provincia"=>$provincia, ":telefono"=>$telefono, ":email"=>$email, ":activo"=>$activo, ":dni"=>$dni, ":codUsuario"=>$cusu))) {
            //echo "entro al if";
            //echo "tipo: " . $tipo;
            if ($tipo == 1) {
                header ("location: /beautyandshop/admin/zonaUsuarios.php");
            }
            else if ($tipo == 2) {
                header ("location: /beautyandshop/admin/zonaUsuarios.php");    
            }
            else if ($tipo == 3) {
                header ("location: /beautyandshop/usuario/micuenta.php");
            }
        }
        else {
            echo "ERROR!!!! No se ha podido modificar";
        }
    }

    function mostrarUsuarios($datosUsuarios, $tipo){
        
        $datosUsuario = "<h1>LISTADO USUARIOS</h1>";
        $datosUsuario = $datosUsuario . "
        
        <div class='table-responsive'>
        <table>
        <thead>
            <tr>
                <th>Nombre</th>";
                if ($tipo == 1) {
                    $datosUsuario = $datosUsuario . "<th>Tipo Usuario</th>";
                }
                $datosUsuario = $datosUsuario . "
                <th>Dirección</th>
                <th>Población</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Activo</th>
                <th>Editar</th>";
                if ($tipo == 1) {
                    $datosUsuario = $datosUsuario . "<th>Borrar</th>";
                }
                $datosUsuario = $datosUsuario . "
                <th>New Cita</th>
            </tr>
            </thead>
    
            <tbody>";
            $indice = 0;

            for($i=0;$i<count($datosUsuarios);$i++) {
                $codUsuario = $datosUsuarios[$i]->getCodUsuario();
                $datosUsuario = $datosUsuario . "<tr>";
                $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getNombre()}</td>"; 
                if ($tipo == 1) {
                    $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getTipoUsuario()}</td>";
                }
                $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getDireccion()}</td>"; 
                $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getPoblacion()}</td>";
                $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getTelefono()}</td>";
                $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getEmail()}</td>";
                $datosUsuario = $datosUsuario . "<td>{$datosUsuarios[$i]->getActivo()}</td>";

                $datosUsuario = $datosUsuario . "<td><a href=/beautyandshop/admin/editarUsuario.php?cusumodificar=" . $codUsuario . "><img src='/beautyandshop/img/modificar.png' /></a></td>";
                if ($tipo == 1) {
                    $datosUsuario = $datosUsuario . "<td><a href=/beautyandshop/admin/borrarUsuario.php?cusudelete=" . $codUsuario . "><img src='/beautyandshop//img/borrar.png' /></a></td>";
                }
                
                if ($datosUsuarios[$i]->getActivo() == 1) {
                    $datosUsuario = $datosUsuario . "<td><a href=/beautyandshop/citas/addCitaUsuario.php?codu=" . $codUsuario . "><img src='/beautyandshop//img/citas.png' /></a></td>";
                }

                $datosUsuario = $datosUsuario . "</tr>";
                $indice = $indice + 1;
            }
            $datosUsuario = $datosUsuario . "</tbody></table></div>";
        return $datosUsuario;
    }

    function mostrarProductos($datosProductos, $tipo){
        
        $datosProducto = "<h1>CATÁLOGO PRODUCTOS</h1>";
        $datosProducto = $datosProducto . "
        <div class='table-responsive'>
        <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Activo</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Imagen</th>";
                if ($tipo != 3) {
                    $datosProducto = $datosProducto . "
                    
                    <th>Editar</th>
                    <th>Borrar</th>";
                }

                $datosProducto = $datosProducto . "</thead></tr><tbody>";
            $indice = 0;
            for($i=0;$i<count($datosProductos);$i++) {
                $codigo=$datosProductos[$i]->getCodigo();
                $datosProducto = $datosProducto . "<tr>";
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getCodigo()}</td>"; 
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getActivo()}</td>";
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getNombre()}</td>"; 
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getDescripcion()}</td>";
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getCodigoCategoria()}</td>"; 
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getPrecio()}</td>";
                $datosProducto = $datosProducto . "<td>{$datosProductos[$i]->getDescuento()}</td>";
                $datosProducto = $datosProducto . "<td><img src='{$datosProductos[$i]->getImagen()}' width='200' height='200'></td>";
                if($tipo == 1) {
                    $datosProducto = $datosProducto . "<td><a href=editarProducto.php?codigo=" . $codigo . "><img src='/beautyandshop/img/modificar.png' /></a></td>";
                    if ($datosProductos[$i]->getActivo() == 1) {
                        $datosProducto = $datosProducto . "<td><a href=borrarProducto.php?codigo=" . $codigo . "><img src='/beautyandshop/img/borrar.png' /></a></td>";
                        
                    }
                }
                elseif ($tipo == 2) {
                    $datosProducto = $datosProducto . "<td><a href=editarProducto.php?codigo=" . $codigo . "><img src='/beautyandshop/img/modificar.png' /></a></td>";
                    if ($datosProductos[$i]->getActivo() == 1) {
                        $datosProducto = $datosProducto . "<td><a href=borrarProducto.php?codigo=" . $codigo . "><img src='/beautyandshop/img/borrar.png' /></a></td>";
                    }
                }
                $datosProducto = $datosProducto . "</tr>";
                $indice = $indice + 1;
            }
            $datosProducto = $datosProducto . "</tbody></table></div>";
        return $datosProducto;
    }

    function addProducto ($tipo, $codigo, $nombre, $descripcion, $categoria, $precio, $descuento, $imagen, $activo) {
        
        $cnn = conectar_db();
        $stmt = $cnn->prepare("insert into productos values(:codigo, :nombre, :descripcion, :imagen, :precio, :descuento, :activo, :codigoCategoria)");
        $rows = $stmt->execute(array(":codigo"=>$codigo, ":nombre"=>$nombre, ":descripcion"=>$descripcion, ":imagen"=>$imagen, ":precio"=>$precio, ":descuento"=>$descuento, ":activo"=>$activo, ":codigoCategoria"=>$categoria));
        if ($rows == 1) {
            echo "¡Producto creado satisfactoriamente";
            if ($tipo == 1) {
                header ("Location:/beautyandshop/admin/zonaProductos.php");
            }
            else if ($tipo == 2) {
                header ("Location:/beautyandshop/admin/zonaProductos.php");    
            }
        }

    }

    function updateProducto ($tipo, $codigo, $nombre, $descripcion, $codigoCategoria, $precio, $descuento, $activo, $imagen) {
        $cnn = conectar_db();
               
        $stmt =$cnn->prepare("update productos SET nombre= :nombre, descripcion= :descripcion, imagen= :imagen, precio= :precio, descuento= :descuento, activo= :activo, codigoCategoria= :codigoCategoria where codigo= :codigo");
       
        if ($stmt->execute(array(":nombre"=>$nombre, ":descripcion"=>$descripcion, ":imagen"=>$imagen, ":precio"=>$precio, ":descuento"=>$descuento, ":activo"=>$activo, ":codigoCategoria"=>$codigoCategoria, ":codigo"=>$codigo))) {
            if ($tipo == 1) {
                header ("location:/beautyandshop/admin/zonaProductos.php?tipo=1");
            }
            elseif ($tipo == 2) {
                header ("location:/beautyandshop/admin/zonaProductos.php?tipo=2");    
            }
            else {
                header ("location:/beautyandshop/admin/zonaProductos.php?tipo=3");
            }
        }
        else {
            echo "ERROR!!!! No se ha podido modificar";
        }

    }

    function mostrarProducto($codigo, $tipo){
        
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("Select * from productos where codigo = :codigo");
        $rows = $stmt->execute(array(":codigo"=>$codigo));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');

        if ($rows == 1) {
            $datosProducto = "<h1>DATOS PRODUCTO</h1>";
            $datosProducto = $datosProducto . "
            <div class='table-responsive'>
            <table>
            <thead>
                <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Imagen</th>";
                if ($tipo != 3) {
                    $datosProducto = $datosProducto . "
                    
                    <th>Editar</th>
                    <th>Borrar</th>";
                }
                $datosProducto = $datosProducto . "</thead></tr><tbody>";
                $indice = 0;
                While($fila = $stmt->fetch())  {

                    $datosProducto = $datosProducto . "<tr>";
                    $datosProducto = $datosProducto . "<td>$codigo</td>"; 
                    $datosProducto = $datosProducto . "<td>{$fila->getNombre()}</td>"; 
                    $datosProducto = $datosProducto . "<td>{$fila->getDescripcion()}</td>";
                    $datosProducto = $datosProducto . "<td>{$fila->getCategoria()}</td>"; 
                    $datosProducto = $datosProducto . "<td>{$fila->getPrecio()}</td>";
                    $datosProducto = $datosProducto . "<td><img src='{$fila->getImagen()}' width='200' height='200'></td>";
                    
                    if ($tipo == 1) {
                        $datosProducto = $datosProducto . "<td><a href=/beautyandshop/admin/editarProducto.php?codigo=" . $codigo . "&tipo=1><img src='img/modificar.png' /></a></td>";
                        $datosProducto = $datosProducto . "<td><a href=/beautyandshop/admin/borrarProducto.php?codigo=" . $codigo . "&tipo=1><img src='img/borrar.png' /></a></td>";

                    }
                    elseif ($tipo == 2) {
                        $datosProducto = $datosProducto . "<td><a href=/beautyandshop/admin/editarProducto.php?codigo=" . $codigo . "&tipo=2><img src='imgs/modificar.png' /></a></td>";
                        $datosProducto = $datosProducto . "<td><a href=/beautyandshop/admin/borrarProducto.php?codigo=" . $codigo . "&tipo=2><img src='imgs/borrar.png' /></a></td>";
                        $datosProducto = $datosProducto . "</tr>";
                    }
                    $indice = $indice + 1;
                }
            $datosProducto = $datosProducto . "</tbody></table></div>";
        }
        else {
            $datosProducto = "";
        }
    
        return $datosProducto;
    }

    function getProducto($codigo)
    {
        $cnn = conectar_db();

        if (!$cnn) {
            var_dump("Error conectando con la base de datos: " . $cnn);
            die();
        }

        try {
            $stmt = $cnn->query("SELECT * FROM productos WHERE codigo = {$codigo}");
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'producto')[0];
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    function sumarUnidad($codProducto) {
        foreach ($_SESSION["carrito"] as $codigo => $unidades) {
            if ($codigo == $codProducto) {
                $unidades = 1 + intval($_SESSION["carrito"][$codigo]);
                
            }
        }
        header("Location: /beautyandshop/shop/carrito.php");
    }
    
    function restarUnidad($codProducto) {
        //echo "ENTRO A LA FUNCIÓN";
        echo $codProducto;
        foreach ($_SESSION["carrito"] as $codigo => $unidades) {
            if ($codigo == $codProducto) {
                $unidades = intval($_SESSION['carrito'][$codigo]) - 1;
    
                if ($unidades == 0) {
                    unset($_SESSION["carrito"][$codigo]);
                }
            }
        }
        //header("Location: /beautyandshop/shop/carrito.php");
    }
   
    
/************** FUNCIONES MANTENIMIENTO PEDIDOS  *********************************/
function llenarArrayPedidos ($ordenar, $cusu, $tipo) {
    $datosPedidos = array ();

    $cnn = conectar_db();
    
    if($tipo == 1 || $tipo == 2) {
        $stmt =$cnn->prepare("SELECT * FROM pedidos ORDER BY fechaPedido DESC");   
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');
    }
    else if ($tipo == 3) {
        if ($ordenar == 0) {
            $stmt =$cnn->prepare("SELECT * FROM pedidos where codUsuario = :codUsuario");
        }
        elseif ($ordenar == 1) {
            $stmt =$cnn->prepare("SELECT * FROM pedidos where codUsuario = :codUsuario ORDER BY fechaPedido ASC");
        }
        else {
            $stmt =$cnn->prepare("SELECT * FROM pedidos where codUsuario = :codUsuario ORDER BY fechaPedido DESC");
        }
        
        $stmt->execute(array(":codUsuario"=>$cusu));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');
    }
       
    $i=0;
    while($fila = $stmt->fetch()) {
        $datosPedidos[$i] = new pedido();
        $datosPedidos[$i] -> setNumPedido($fila->getNumPedido());
        $datosPedidos[$i] -> setFechaPedido($fila->getFechaPedido());
        $datosPedidos[$i] -> setCodUsuario($fila->getCodUsuario());
        $datosPedidos[$i] -> setTotal($fila->getTotal());
        $datosPedidos[$i] -> setEstado($fila->getEstado());
        
        $i++;
    }
    return($datosPedidos);
    
}
function mostrarPedidos($datosPedidos, $tipo){
        
    if ($tipo == 1 || $tipo == 2) {
        $datosPedido = "<h1>LISTADO PEDIDOS</h1>";    
    }
    else if ($tipo == 3) {
        $datosPedido = "<h1>MIS PEDIDOS</h1>";    
    }

    //$datosPedido = "<h1>DATOS PEDIDOS</h1>";
    $datosPedido = $datosPedido . "
    <div class='table-responsive'>
    <table>
    <thead>
        <tr>
            <th>Nº PEDIDO</th>
            <th>FECHA</th>
            <th>CÓDIGO USUARIO</th>
            <th>TOTAL</th>
            <th>ESTADO</th>
            <th>VER PEDIDO</th>
        </tr>
    </thead>
    
    <tbody>";
        
           
            $datosPedido = $datosPedido . "</tr>";
        //$indice = 0;
        for($i=0;$i<count($datosPedidos);$i++) {
            $numPedido=$datosPedidos[$i]->getNumPedido();
            $datosPedido = $datosPedido . "<tr>";
            $datosPedido = $datosPedido . "<td>{$datosPedidos[$i]->getNumPedido()}</td>"; 
            $datosPedido = $datosPedido . "<td>{$datosPedidos[$i]->getFechaPedido()}</td>";
            $datosPedido = $datosPedido . "<td>{$datosPedidos[$i]->getCodUsuario()}</td>";
	    $total = number_format(round($datosPedidos[$i]->getTotal(), 2), 2, ",", "."); 
            //$total = round($datosPedidos[$i]->getTotal(), 2);
            $datosPedido = $datosPedido . "<td>{$total} €</td>";
            $datosPedido = $datosPedido . "<td id='estado'>{$datosPedidos[$i]->getEstado()}</td>";
            
            if($tipo == 1) {
                $datosPedido = $datosPedido . "<td><a href=/beautyandshop/usuario/verPedido.php?numPedido=" . $numPedido . "><img src='/beautyandshop//img/detalles.png' /></a></td>";
                
            }
            else if ($tipo == 2) {
                $datosPedido = $datosPedido . "<td><a href=/beautyandshop/usuario/verPedido.php?numPedido=" . $numPedido . "><img src='/beautyandshop/img/detalles.png' /></a></td>";
            }
            else if ($tipo == 3) {
                $datosPedido = $datosPedido . "<td><a href=/beautyandshop/usuario/verPedido.php?numPedido=" . $numPedido . "><img src='/beautyandshop/img/detalles.png' /></a></td>";
            }
            $datosPedido = $datosPedido . "</tr>";
            //$indice = $indice + 1;
        }
        $datosPedido = $datosPedido . "</tbody></table></div>";
    return $datosPedido;
}       

/*function llenarArrayLinPedidos ($numPedido) {
    $datosLinPedidos = array ();
    
    $cnn = conectar_db();

    $stmt =$cnn->prepare("SELECT * FROM linPedidos WHERE numPedido = :numPedido ORDER BY numLinea ASC");
    
    
    $stmt->execute(array(":numPedido"=>$numPedido));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'linpedido');
       
    $i=0;
    while($fila = $stmt->fetch()) {
        $datosLinPedidos[$i] = new linpedido();
        $datosLinPedidos[$i] -> setNumLinea($fila->getNumLinea());
        $datosLinPedidos[$i] -> setNumPedido($fila->getNumPedido());
        $datosLinPedidos[$i] -> setCodProducto($fila->getCodProducto());
        $datosLinPedidos[$i] -> setUnidades($fila->getUnidades());
        $datosLinPedidos[$i] -> setPrecio($fila->getPrecio());
        
        $i++;
    }
    return($datosLinPedidos);
    
}*/
/*function mostrarLinPedidos($datosLinPedidos, $tipo, $numPedido){
        
    $datosLinPedido = "<h1>LINEAS PEDIDO</h1>";
    $datosLinPedido = $datosLinPedido . "
    <div class='table-responsive'>
    <table>
    <thead>
        <tr>
            <th>Nº LINEA</th>
            <th>Nº PEDIDO</th>
            <th>COD. ARTICULO</th>
            <th>UNIDADES</th>
            <th>PRECIO</th>
            <th>TOTAL</th>

        </tr>
    </thead>
    
    <tbody>";
        
           
        $datosLinPedido = $datosLinPedido . "</tr>";
        $encontrado = 0;
        for($i=0;$i<count($datosLinPedidos) && $encontrado == 0;$i++) {
            $numPedidoAux=$datosLinPedidos[$i]->getNumPedido();

            if ($numPedidoAux == $numPedido) {
                $datosLinPedido = $datosLinPedido . "<tr>";
                $datosLinPedido = $datosLinPedido . "<td>{$datosLinPedidos[$i]->getNumLinea()}</td>"; 
                $datosLinPedido = $datosLinPedido . "<td>{$datosLinPedidos[$i]->getNumPedido()}</td>"; 
                $datosLinPedido = $datosLinPedido . "<td>{$datosLinPedidos[$i]->getCodProducto()}</td>";
                $datosLinPedido = $datosLinPedido . "<td>{$datosLinPedidos[$i]->getUnidades()}</td>"; 
                $datosLinPedido = $datosLinPedido . "<td>{$datosLinPedidos[$i]->getPrecio()}</td>";
                $subTotal = round($datosLinPedidos[$i]->getUnidades() * $datosLinPedidos[$i]->getPrecio(), 2);
                $datosLinPedido = $datosLinPedido . "<td>{$subTotal} €</td>";
            
           
                $datosLinPedido = $datosLinPedido . "</tr>";
                $encontrado = 1;
                //$indice = $indice + 1;
            }
        }
        $datosLinPedido = $datosLinPedido . "</tbody></table></div>";
    return $datosLinPedido;
}     */     

/*function mostrarDetallePedidos ($numPedido, $estado) {
	echo "ENTRO A LA FUNCIÓN";
    // Sacos los Datos del Pedido.
    $cnn = conectar_db();
    $stmt =$cnn->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
    $stmt->execute(array(":numPedido"=>$numPedido));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');
    while($fila = $stmt->fetch()) {
        $codUsuario = $fila->getCodUsuario();
    }
    
     
    // Sacos los Datos del Usuario.
    $cnn = conectar_db();
    $stmt =$cnn->prepare("SELECT * FROM usuarios where codUsuario = :codUsuario");
    $stmt->execute(array(":codUsuario"=>$codUsuario));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

    $detallePedido = "<html lang='es>
                     <head> 
                        <title>Cambio estado pedido de BEAUTY And SHOP</title> 
                        <meta charset='utf-8'>
                    </head> 
                    <body> 
                            <div>Le escribimos desde Beauty And Shop para informarle que el estado de su PEDIDO Nº: <strong style='color:red;'>" . $numPedido . "</strong> 
                    ha cambiado a <strong style='color:red;'>" . strtoupper($estado) . "</strong>.
                    <br><h2>DATOS CLIENTE Y DIRECCIÓN ENVÍO:</h2></div>";

    $detallePedido = $detallePedido . "
    <div class='table-responsive'>
    <table>
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DIRECCIÓN</th>
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
            $detallePedido = $detallePedido . "<td>{$fila->getPoblacion()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$fila->getProvincia()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$fila->getEmail()}</td>"; 
            $email_to = $fila->getEmail();
            $detallePedido = $detallePedido . "<td>{$fila->getTelefono()}</td>"; 
            $detallePedido = $detallePedido . "</tr>";
        }
        $detallePedido = $detallePedido . "</tbody></table></div>";

    // Sacos los Datos del Pedido.
    $cnn1 = conectar_db();
    $stmt1 =$cnn1->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
    $stmt1->execute(array(":numPedido"=>$numPedido));
    $stmt1->setFetchMode(PDO::FETCH_CLASS, 'pedido');

    $detallePedido = $detallePedido . "<h2>DETALLES DEL PEDIDO:</h2>";
    $detallePedido = $detallePedido . "
    <div class='table-responsive'>
    <table>
    <thead>
        <tr>
            <th>FECHA PEDIDO</th>
            <th>Nº PEDIDO</th>
            <th>TOTAL PEDIDO</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    
    <tbody>";
        while($fila1 = $stmt1->fetch()) {
            $detallePedido = $detallePedido . "<tr>";
            $detallePedido = $detallePedido . "<td>{$fila1->getFechaPedido()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$numPedido}</td>"; 
            $total = number_format(round($fila1->getTotal(), 2),2, ",", ".");
            $detallePedido = $detallePedido . "<td>{$total} €</td>"; 
            $detallePedido = $detallePedido . "<td id='estado'>{$fila1->getEstado()}</td>"; 
            $detallePedido = $detallePedido . "</tr>";
        }
    $detallePedido = $detallePedido . "</tbody></table></div>";
    echo $detallePedido;

    // Sacos los Datos de las líneas de pedido

    $cnn2 = conectar_db();
    $stmt2 =$cnn2->prepare("SELECT * FROM linPedidos where numPedido = :numPedido ORDER BY numLinea ASC");
    $stmt2->execute(array(":numPedido"=>$numPedido));
    $stmt2->setFetchMode(PDO::FETCH_CLASS, 'linpedido');
	echo "PASO LA SQL";
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
        while($fila2 = $stmt2->fetch()) {
		echo "ENTRO AL WHILE";
            $detallePedido = $detallePedido . "<tr>";
            $codigo = $fila2->getCodProducto();
            $detallePedido = $detallePedido . "<td>{$codigo}</td>";

            // Saco la DESCRIPCIÓN del PRODUCTO de cada Línea de Pedido.
            $cnn3 = conectar_db();
            $stmt3 =$cnn3->prepare("SELECT * FROM productos where codigo = :codigo");
            $stmt3->execute(array(":codigo"=>$codigo));
            $stmt3->setFetchMode(PDO::FETCH_CLASS, 'producto');
            $filaProducto = $stmt3->fetch();
            $detallePedido = $detallePedido . "<td>{$filaProducto->getNombre()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$filaProducto->getUnidades()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$filaProducto->getPrecio()}</td>"; 
            $total = round($filaProducto->getUnidades()*$filaProducto->getPrecio(),2);
            $detallePedido = $detallePedido . "<td>{$total} €</td>"; 
            $detallePedido = $detallePedido . "</tr>";
        }
        $detallePedido = $detallePedido . "</tbody></table></div></body></html>";
	
	echo $detallePedido;

        //$email_from = "info@beautyandshop.net";
        //$email_subject = "Su pedido ha cambiado de estado";
        
        //$email_message = $detallePedido;

        //echo $email_message;
        //$headers = "MIME-Version: 1.0\r\n"; 
        //$headers .= "Content-type: text/html; charset=utf-8\r\n"; 

        //dirección del remitente 
        //$headers .= "From: Beauty And Shop <info@beautyandshop.net>\r\n"; 

        //dirección de respuesta, si queremos que sea distinta que la del remitente 
        //$headers .= "Reply-To: info@beautyandshop.net\r\n"; 

        //ruta del mensaje desde origen a destino 
        //$headers .= "Return-path: info@beautyandshop.net\r\n"; 

        //direcciones que recibián copia 
        //$headers .= "Cc: info@beautyandshop.net\r\n"; 
	echo "voy a enviar el EMAIL";
        // Envío del email
        //if(@mail($email_to, $email_subject, $email_message, $headers)) {
            //header ("location:/beautyandshop/admin/pedidos.php");
        //}
        


    //return ($detallePedido);
}*/

function mostrarDetallePedidos($numPedido, $estado) {
    $cnn = conectar_db();
    $stmt =$cnn->prepare("SELECT * FROM pedidos where numPedido = :numPedido");
    $stmt->execute(array(":numPedido"=>$numPedido));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'pedido');
    while($fila = $stmt->fetch()) {
        $codUsuario = $fila->getCodUsuario();
        $fechaPedido = $fila->getFechaPedido();
    }
    
     
    // Sacos los Datos del Usuario.
    $cnn = conectar_db();
    $stmt =$cnn->prepare("SELECT * FROM usuarios where codUsuario = :codUsuario");
    $stmt->execute(array(":codUsuario"=>$codUsuario));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

    $detallePedido = "<html lang='es>
                     <head> 
                        <title>Cambio estado pedido de BEAUTY And SHOP</title> 
                        <meta charset='utf-8'>
                    </head> 
                    <body> 
                            <div style='padding:15px;'><h3>Le escribimos desde <strong style='color:red;'>BEAUTY AND SHOP </strong> para informarle que el estado de su PEDIDO Nº: <strong style='color:red;'>" . $numPedido . "</strong> 
                    que nos realizo con fecha <strong style='color:red;'>" . $fechaPedido . " </strong> ha cambiado a <strong style='color:red;'>" . strtoupper($estado) . "</strong>.
                    </h3><br>
                    <h3><strong>Le agradecemos la confianza depositada en nosotros.</strong></h3><br><hr>
                    <strong style='margin:0 auto;color:red;'>BEAUTY AND SHOP</strong><hr></div>
                    </body></html>";

    /*$detallePedido = $detallePedido . "
    <div class='table-responsive'>
    <table>
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DIRECCIÓN</th>
            <th>POBLACIÓN</th>
            <th>PROVINCIA</th>
            <th>EMAIL</th>
            <th>TELÉFONO</th>

        </tr>
    </thead>
    
    <tbody>";*/
        while($fila = $stmt->fetch()) {
            /*$detallePedido = $detallePedido . "<tr>";
            $detallePedido = $detallePedido . "<td>{$fila->getNombre()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$fila->getDireccion()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$fila->getPoblacion()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$fila->getProvincia()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$fila->getEmail()}</td>"; */
            $email_to = $fila->getEmail();
            /*$detallePedido = $detallePedido . "<td>{$fila->getTelefono()}</td>"; 
            $detallePedido = $detallePedido . "</tr>";*/
        }
        /*$detallePedido = $detallePedido . "</tbody></table></div>";*/
        
        // Sacos los Datos de las líneas de pedido

    /*$cnnLinPedidos = conectar_db();
    $stmtLinPedidos = $cnnLinPedidos->prepare("SELECT * FROM linPedidos where numPedido = :numPedido ORDER BY numLinea ASC");
    $stmtLinPedidos->execute(array(":numPedido"=>$numPedido));
    $stmtLinPedidos->setFetchMode(PDO::FETCH_CLASS, 'linpedido');
	echo "PASO LA SQL";
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
        while($filaLinPedidos = $stmtLinPedidos->fetch()) {
		echo "ENTRO AL WHILE";
            $detallePedido = $detallePedido . "<tr>";
            $codigo = $filaLinPedidos->getCodProducto();
            echo "CODIGO:" . $codigo;
            $detallePedido = $detallePedido . "<td>{$codigo}</td>";

            // Saco la DESCRIPCIÓN del PRODUCTO de cada Línea de Pedido.
            $cnnProductos = conectar_db();
            $stmtProductos =$cnnProductos->prepare("SELECT * FROM productos where codigo = :codigo");
            $stmtProductos->execute(array(":codigo"=>$codigo));
            $stmtProductos->setFetchMode(PDO::FETCH_CLASS, 'producto');
            $filaProducto = $stmtProductos->fetch();
            $detallePedido = $detallePedido . "<td>{$filaProducto->getNombre()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$filaLinPedidos->getUnidades()}</td>"; 
            $detallePedido = $detallePedido . "<td>{$filaLinPedidos->getPrecio()}</td>"; 
            $total = round($filaLinPedidos->getUnidades()*$filaLinPedidos->getPrecio(),2);
            $detallePedido = $detallePedido . "<td>{$total} €</td>"; 
            $detallePedido = $detallePedido . "</tr>";
        }
        $detallePedido = $detallePedido . "</tbody></table></div></body></html>";*/







        //$email_from = "info@beautyandshop.net";
        $email_subject = "Su pedido ha cambiado de estado";
        
        $email_message = $detallePedido;

        //echo $email_message;
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
            header ("location:/beautyandshop/admin/pedidos.php");
        }
        
}

function updateEstadoPedidos ($numPedido, $estado) {
    $cnn = conectar_db();
           
    $stmt =$cnn->prepare("update pedidos SET estado= :estado where numPedido= :numPedido");
   
    if ($stmt->execute(array(":estado"=>$estado, ":numPedido"=>$numPedido))) {
        mostrarDetallePedidos($numPedido, $estado);
        //header ("location:/beautyandshop/admin/pedidos.php");
    }
    else {
        echo "ERROR!!!! No se ha podido modificar";
    }

}

?>