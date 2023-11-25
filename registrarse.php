<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
        
    $error = array();
    
    
   /* if (isset($_REQUEST["tipo"])) {
        $tipo = $_REQUEST["tipo"];
        $tipoUsuario = $_REQUEST["tipo"];
    }*/

    /*if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }*/

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
   
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }

    if(isset($_REQUEST["tipo"])) {
        $tipo = $_REQUEST["tipo"]; 
        $tipoUsuario = $_REQUEST["tipo"]; 
    }



    if(isset($_REQUEST["enviar"]) == TRUE) {
        $email = $_REQUEST["email"];
        $clave = $_REQUEST["clave"];
        $nombre = $_REQUEST["nombre"];
        $telefono = $_REQUEST["telefono"];
        $direccion = $_REQUEST["direccion"];
        $poblacion = $_REQUEST["poblacion"];
        $provincia = $_REQUEST["provincia"];
        $cp = $_REQUEST["cp"];
        $dni = strtoupper($_REQUEST["dni"]);
        
        // Siempre que se dá de alta un Usuario se crea con el Rol = 3 (Usuario). Si lo crea el Administrador
        // también se crea con el Rol = 3 (Usuario). Luego desde Editar Usuario, le puede cambiar el Rol-
        $tipoUsuario = 3;
        $activo = 1;

        if (empty($_REQUEST["email"]) == TRUE) {
            $error [3]= "<p class='error'>ERROR. *EMAIL Incorrecto.</p>";
            $codigo4 = 4;
        }
        else {
            // Compruebo si el EMAIL ya existe.
            $cnn = conectar_db();
        
            $datosUsuarios = [];

            $encontrado = 0;
            $datosUsuarios = llenarArray(0);

            for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
                $emailAux = $datosUsuarios[$i]-> getEmail();
                if($emailAux == $email) {
                    $encontrado = 1;
                }
            }

            if ($encontrado == 1) {
                $error [3] = "<p class='error'>ERROR. *El EMAIL ya existe.</p>";
                $codigo4 = 4;
            }
            else {
                $correcto = 1;
                $correcto =validarEmail($email);
                //echo $correcto;
                if ($correcto == 0) {
                    $error [3]= "<p class='error'>ERROR. *EMAIL Incorrecto.</p>";
                    $codigo4 = 4;
                 }
            }
        }

        if (empty($_REQUEST["clave"]) == TRUE) {
            $error [4]= "<p class='error'>ERROR. *La CLAVE no puede estar en blanco.</p>";
            $codigo5 = 5;
        }

        if (empty($_REQUEST["nombre"]) == TRUE) {
            $error [1]= "<p class='error'>ERROR. *El NOMBRE no puede estar en blanco.</p>";
            $codigo2 = 2;
        }

        if(empty($_REQUEST["telefono"]) == TRUE) {
            $error [2] = "<p class='error'>*El TELÉFONO no puede estar en blanco.</p>";
            $codigo3 = 3;
        }
        else if((empty($_REQUEST["telefono"]) == FALSE) && (strlen($_REQUEST["telefono"]) < 9) || (strlen($_REQUEST["telefono"]) > 9)) {
            $error [2]= "<p class='error'>ERROR. **El TELÉFONO sólo admite 9 digitos.</p>";
            $codigo3 = 3;
        }

        
        if(empty($_REQUEST["dni"]) == TRUE) {
            //$error [0] = "<p class='error'>*DNI Incorrecto.</p>";
            //$codigo1 = 1;
        }   
        else {
            $correcto = 1;
            $correcto =NifValido($dni);
            if ($correcto == 0) {
                $error [0] = "<p class='error'>*DNI Incorrecto.</p>";
                $codigo1 = 1;
            }
        }

        /*if (empty($_REQUEST["direccion"]) == TRUE) {
            $error [5]= "<p class='error'>ERROR. *La DIRECCIÓN no puede estar en blanco.</p>";
            $codigo6 = 6;
        }

        if (empty($_REQUEST["poblacion"]) == TRUE) {
            $error [6]= "<p class='error'>ERROR. *La POBLACIÓN no puede estar en blanco.</p>";
            $codigo7 = 7;
        }

        if (empty($_REQUEST["provincia"]) == TRUE) {
            $error [7]= "<p class='error'>ERROR. *La PROVINCIA no puede estar en blanco.</p>";
            $codigo8 = 8;
        }*/
      
        if(empty($_REQUEST["cp"]) == TRUE) {
            //$error [8] = "<p class='error'>*El CÓDIGO POSTAL no puede estar en blanco.</p>";
            //$codigo9 = 9;
        }
        else if((empty($_REQUEST["cp"]) == FALSE) && (strlen($_REQUEST["cp"]) < 5) || (strlen($_REQUEST["cp"]) > 5)) {
            $error [8]= "<p class='error'>ERROR. **El CÓDIGO POSTAL sólo admite 5 digitos.</p>";
            $codigo9 = 9;
        }
        
        if (!isset($codigo1) && !isset($codigo2) && !isset($codigo3) && !isset($codigo4) && !isset($codigo5) && !isset($codigo6) && !isset($codigo7) && !isset($codigo8) && !isset($codigo9)) {
           
            $clave1 = password_hash($clave, PASSWORD_DEFAULT);

            if ($tipo == 4) {
                $tipoUsuario = 3;
                $tipo = 3;
                $activo = 1;
            }
            else if ($tipo == 1){
                $tipoUsuario = 3;
            }
            else if ($tipo == 2){
                $tipoUsuario = 3;
                $activo = 1;
            }
            addUsuario ($tipo, $cp, strtoupper($dni), $clave1, $email, strtoupper($nombre), strtoupper($direccion), strtoupper($poblacion), strtoupper($provincia), $telefono, $tipoUsuario, $activo);
            enviarEmailBienvenida(strtoupper($nombre), $email);
        }
    }
?>
<html lang="es">
    <head>
        <title>Registro de Usuario. Beauty And Shop</title>
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

        <style type="text/css">
        <?php
            if(isset($error)) {
        ?>
               input:focus {
                    border: solid red 1px;
                    background-color: lightblue;
                }
        <?php
            }
        ?>
        </style>
    </head>
<body>
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
                <h2 class="h3 text-center text-warning">FORMULARIO DE REGISTRO</h2><hr><br>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="email" class="col-sm-12 col-form-label text-warning"><h5>EMAIL *</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="email" required maxlength="50" size="50" name="email" value="<?php if(isset($email)) echo $email ?>" <?php if(isset($codigo4) && $codigo4 == 4){ echo "autofocus"; } ?>>
                        </div>
                    </div>

                    <!-- COMPROBAMOS QUE EL EMAIL TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo4)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo4-1]; ?></p>
                    <?php
                    }
                    ?>
                    
                    <div class="form-group">
                        <label for="clave" class="col-sm-12 col-form-label text-warning"><h5>CONTRASEÑA *</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" required maxlength="40" size="40" name="clave" value="<?php if(isset($clave)) echo $clave ?>">
                        </div>
                    </div>

                    <!-- COMPROBAMOS QUE LA CONTRASEÑA NO ESTÁ EN BLANCO. -->
                    <?php
                    if(isset($error) && isset($codigo5)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo5-1]; ?></p>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="nombre" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE Y APELLIDOS *</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" required maxlength="80" size="80" name="nombre" value="<?php if(isset($nombre)) echo $nombre ?>" <?php if(isset($codigo2) && $codigo2 == 2){ echo "autofocus"; } ?>>
                        </div>
                    </div>
                   
                    <!-- COMPROBAMOS QUE EL NOMBRE NO ESTÁ EN BLANCO. --> 
                    <?php
                    if(isset($error) && isset($codigo2)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo2-1]; ?></p>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="telefono" class="col-sm-12 col-form-label text-warning"><h5>TELÉFONO *</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="tel" pattern="[0-9]{9}" title="Debes poner 9 Números" maxlength="9" size="9" name="telefono" required value="<?php if(isset($telefono)) echo $telefono ?>" <?php if(isset($codigo3) && $codigo3 == 3){ echo "autofocus"; } ?>>
                        </div>
                    </div>

                    <!-- COMPROBAMOS QUE EL TELÉFONO TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo3)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo3-1]; ?></p>
                    <?php
                    }
                    ?>
                    <hr>
                    <h6 class="h6 text-left text-info">* Campos Obligatorios </h6><hr><br>

                    <h4 class="h4 text-center text-warning">DIRECCIÓN DE ENTREGA</h4><hr><br>

                    <div class="form-group">
                        <label for="direccion" class="col-sm-12 col-form-label text-warning"><h5>DIRECCIÓN</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" maxlength="60" size="60" name="direccion" value="<?php if(isset($direccion)) echo $direccion ?>">
                        </div>
                    </div>

                    <!-- COMPROBAMOS QUE LA DIRECCIÓN TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo6)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo6-1]; ?></p>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="cp" class="col-sm-12 col-form-label text-warning"><h5>CÓDIGO POSTAL</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" pattern="[0-9]{5}" title="Debes poner 5 Números" maxlength="5" size="5" name="cp" value="<?php if(isset($cp)) echo $cp ?>">
                        </div>
                    </div>
                        
                    <!-- COMPROBAMOS QUE EL CÓDIGO POSTAL TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo9)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo9-1]; ?></p>
                    <?php
                    }
                    ?>  

                    <div class="form-group">
                        <label for="poblacion" class="col-sm-12 col-form-label text-warning"><h5>POBLACIÓN</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" maxlength="40" size="30" name="poblacion" value="<?php if(isset($poblacion)) echo $poblacion ?>">
                        </div>
                    </div>
                        
                    <!-- COMPROBAMOS QUE LA POBLACIÓN TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo7)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo7-1]; ?></p>
                    <?php
                    }
                    ?>    

                    <div class="form-group">
                        <label for="provincia" class="col-sm-12 col-form-label text-warning"><h5>PROVINCIA</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" maxlength="40" size="30" name="provincia" value="<?php if(isset($provincia)) echo $provincia ?>">
                        </div>
                    </div>
                        
                    <!-- COMPROBAMOS QUE LA PROVINCIA TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo8)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo8-1]; ?></p>
                    <?php
                    }
                    ?>  
                     
                    <div class="form-group">
                        <label for="dni" class="col-sm-12 col-form-label text-warning"><h5>D.N.I.</h5></label>
                        <div class="col-sm-12">
                           <input class="form-control errorImput" type="text" pattern="[0-9]{8}[a-zA-z]{1}" title="Debes poner 8 Números + 1 Letra" maxlength="9" size="9" name="dni" value="<?php if(isset($dni)) echo $dni ?>" <?php if(isset($codigo1) && $codigo1 == 1){ echo "autofocus"; }  ?>>
                        </div>
                    </div>
                    
                    <!-- COMPROBAMOS QUE EL DNI TIENE UN FORMATO CORRECTO. -->
                    <?php
                    if(isset($error) && isset($codigo1)) {
                    ?>
                        <p class="error"><?php echo $error[$codigo1-1]; ?></p>
                    <?php
                    }
                    ?>    
                    <div class="text-center">
                        <button class="btn btn-success text-center" type="submit" name="enviar" value="Enviar">ENVIAR</button>
                        <button class="btn btn-warning text-center" type="reset" name="borrar" value="Limpiar">LIMPIAR</button>
                        <?php
                        if ($tipoUsuario == 1 || $tipo == 1) {
                        ?> 
                            <a href="/beautyandshop/admin/zonaUsuarios.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                        <?php
                        }
                        elseif ($tipoUsuario == 2 || $tipo == 2) {
                        ?>
                            <a href="/beautyandshop/admin/zonaUsuarios.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                        <?php
                        }
                        elseif ($tipoUsuario == 3 || $tipo == 3 || $tipoUsuario == 4 || $tipo == 4) {
                        ?>
                            <a href="/beautyandshop/index.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
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
