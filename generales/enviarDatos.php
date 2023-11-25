<?php

//$enviar = $_REQUEST["enviar"];

if(isset($_REQUEST["enviar"])) {
    // AHORA ENVIAMOS EL EMAIL AL CLIENTE
    $email_from = "info@beautyandshop.net";
    $email_subject = "Contacto desde Formulario de BEAUTY AND SHOP";

    $error1 = 0;
    if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"])) {
        $email_to = trim($_REQUEST["email"]);	
        $error1 = 1;
        //echo "ENTRO AL IF DE EMAIL " . $error1;
    }

    $error2 = 0;
    if (isset($_REQUEST["nombre"]) && !empty($_REQUEST["nombre"])) {
        $nombre = trim($_REQUEST["nombre"]);	
        $error2 = 1;
        //echo "ENTRO AL IF DE NOMBRE " . $error2;
    }

    $error3 = 0;
    if (isset($_REQUEST["telefono"]) && !empty($_REQUEST["telefono"])) {
        $telefono = trim($_REQUEST["telefono"]);	
        $error3 = 1;
        //echo "ENTRO AL IF DE TELEFONO " . $error3;
    }

    $error4 = 0;
    if (isset($_REQUEST["asunto"]) && !empty($_REQUEST["asunto"])) {
        $asunto = trim($_REQUEST["asunto"]);	
        $error4 = 1;
    }

    $error5 = 0;
    if (isset($_REQUEST["mensaje"]) && !empty($_REQUEST["mensaje"])) {
        $mensaje = trim($_REQUEST["mensaje"]);	
        $error5 = 1;
    }

    if ($error1 == 1 && $error2 == 1 && $error3 == 1 && $error4 == 1 && $error5 == 1) {
        //$email_message = "Nombre: " . $nombre . " Teléfono: " . $telefono . " E-mail: " . $email_to . " Asunto: " . $asunto . " Mensaje: " . $mensaje;
        $email_message = ' 
                <html lang="es">
                    <head> 
                        <title>Contacto desde formulario de BEAUTY And SHOP</title> 
                        <meta charset="utf-8">
                    </head> 
                <body> 
                    <h2>Datos de Contacto:</h2> 
                    <span style="margin-left:15px;"><strong>NOMBRE:  </strong></span><span>' . $nombre . '</span><br>
                    <span style="margin-left:15px;"><strong>EMAIL:  </strong></span><span>' . $email_to . '</span><br>
                    <span style="margin-left:15px;"><strong>TELÉFONO:  </strong></span><span>' . $telefono . '</span><br>  
                    <h2>Asunto:</h2>
                    <span>' . $asunto . '</span><br>
                    <h2>Mensaje:</h2>
                    <span>' . $mensaje . '</span><br><br>
                    <p><strong>Gracias por confiar en nosotros</strong>. En breve nos pondremos en contacto con usted.</p> 
                </body> 
                </html>'; 
        //echo $email_message;

        // Creación de las cabeceras del email
        /*$headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $headers .= "Cc: info@beautyandshop.net\r\n";*/

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
            header ("location:/beautyandshop/generales/contacto.php?p=4&envioOk=si");
        }
        else {
            header ("location:/beautyandshop/generales/contacto.php?p=4&envioOk=no");	    
        }
    }   
    else {
        header ("location:/beautyandshop/generales/contacto.php?p=4&envioOk=no");	
    }    
}
?>