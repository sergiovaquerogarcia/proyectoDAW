<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");
    //include ("usuario_class.php");

    if(isset($_SESSION["cusu"])) {
        
        $cusu= $_SESSION["cusu"]; 
        //ECHO "CUSU:" . $cusu;   
    }
    /*if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }*/
    if(isset($_SESSION["tipo"])) {
        
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
        //ECHO "TIPO:" . $tipo;
    }
    



    $error = array();

    if (isset($_REQUEST["cusu"])) {
        //$cusu = $_REQUEST["cusu"];
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("SELECT * FROM usuarios WHERE codUsuario = :codUsuario");
        $rows = $stmt->execute(array(":codUsuario"=>$cusu));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'usuario');

        if ($rows == 1) {
            $fila = $stmt->fetch();
            $tipoUsuario = $fila->getTipoUsuario();
            $tipoUsuario1 = $tipoUsuario;
            $dni = $fila->getDni();
            $clave = $fila->getClave();
            $nombre = $fila->getNombre();
            $direccion = $fila->getDireccion();
            $cp = $fila->getCp();
            $poblacion = $fila->getPoblacion();
            $provincia = $fila->getProvincia();
            $email = $fila->getEmail();
            $telefono = $fila->getTelefono();
            $activo = $fila->getActivo();
            $activo1 = $activo;
            //echo "ACTIVO:" . $activo;
        } 
    }

    if (isset($_REQUEST["enviar"]) == TRUE) {

        //$cusu = $_REQUEST["cusu1"];

        //echo "ENTRO A ENVIAR";
        

        if(isset($tipoUsuario) == FALSE) {
            $clave = $_REQUEST["clave"];
        }
       
        if(empty($_REQUEST["tipoUsuario"])==FALSE) {
            $tipoUsuario = $_REQUEST["tipoUsuario"];
        }
        else {
            $tipoUsuario = $tipoUsuario1;
        }

        if(empty($_REQUEST["activo"])==FALSE) {
            $activo = $_REQUEST["activo"];
        }
        else {
            $activo = $activo1;
        }

        //echo "ACTIVO en ENVIAR:" . $activo;
                
        $nombre = $_REQUEST["nombre"];
        //echo "NOMBRE: " . $nombre;
        $dni = $_REQUEST["dni"];
        $direccion = $_REQUEST["direccion"];
        $cp = $_REQUEST["cp"];
        $poblacion = $_REQUEST["poblacion"];
        $provincia = $_REQUEST["provincia"];
        $telefono = $_REQUEST["telefono"];
        //$email = $_REQUEST["email"];
        //$activo = $_REQUEST["activo"];

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

        /*if(isset($tipo) == FALSE) {
            if (empty($_REQUEST["clave"]) == TRUE) {
                $error [4]= "<p class='error'>ERROR. *La CLAVE no puede estar en blanco.</p>";
                $codigo5 = 5;
            }
        }*/
        
        if (empty($_REQUEST["nombre"]) == TRUE) {
            $error [1]= "<p class='error'>ERROR. *El NOMBRE no puede estar en blanco..</p>";
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

        /*if (empty($_REQUEST["direccion"]) == TRUE) {
            $error [5]= "<p class='error'>ERROR. *La DIRECCIÓN no puede estar en blanco.</p>";
            $codigo6 = 6;
        }

        if (empty($_REQUEST["localidad"]) == TRUE) {
            $error [6]= "<p class='error'>ERROR. *La LOCALIDAD no puede estar en blanco.</p>";
            $codigo7 = 7;
        }

        if (empty($_REQUEST["provincia"]) == TRUE) {
            $error [7]= "<p class='error'>ERROR. *La PROVINCIA no puede estar en blanco.</p>";
            $codigo8 = 8;
        }*/

        /*if ($tipoUsuario != 1 && $tipoUsuario != 2 && $tipoUsuario != 3) {
            $error [8]= "<p class='error'>ERROR. *Tipo Usuario Incorrecto. Elija: 1 (usuario), 2 (Trabajador) o 3 (administrador).</p>";
            $codigo9 = 9;
        }
      
        
     
        if (empty($_REQUEST["email"]) == TRUE) {
            $error [3]= "<p class='error'>ERROR. *EMAIL Incorrecto.</p>";
            $codigo4 = 4;
        }
        else {
            $correcto = 1;
            $correcto =validarEmail($email);
            echo $correcto;
            if ($correcto == 0) {
                $error [3]= "<p class='error'>ERROR. *EMAIL Incorrecto.</p>";
                $codigo4 = 4;
            }
        }*/
       
        if (!isset($codigo1) && !isset($codigo2) && !isset($codigo3) && !isset($codigo4)  && !isset($codigo5)  && !isset($codigo6)  && !isset($codigo7)  && !isset($codigo8) && !isset($codigo9)) {
            //$tipo = 3;
            //$tipoUsuario = 3;
            updateUsuario ($cusu, $tipo, $cp, $tipoUsuario, $clave, strtoupper($dni), strtoupper($nombre), strtoupper($direccion), strtoupper($poblacion), strtoupper($provincia), $telefono, strtolower($email), $activo);
        }
    }
?>
<html lang="es">
    <head>
        <title>Editar USUARIO. Beauty And Shop</title>
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
    <br>

    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br />
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <h2 class="h3 text-center text-warning">EDITAR USUARIO</h2><hr><br>
                    <form method="post" action="">
                        <input type="hidden" name="cusu1" value="<?php echo $cusu?>">
                        
                        <div class="form-group">
                            <label for="email" class="col-sm-12 col-form-label text-warning"><h5>EMAIL *</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control errorImput" type="email" disabled maxlength="50" size="50" name="email" value="<?php if(isset($email)) echo $email ?>" <?php if(isset($codigo4) && $codigo4 == 4){ echo "autofocus"; } ?>>
                            </div>
                        </div>
                        <!-- COMPROBAMOS QUE EL EMAIL TIENE UN FORMATO CORRECTO. -->
                        <?php
                        if(isset($error) && isset($codigo4))
                        {
                        ?>
                            <p class="error"><?php echo $error[$codigo4-1]; ?></p>
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
                            <a href="/beautyandshop/usuario/micuenta.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                        </div>
                    </form>   
                </div>

                <div class="col-sm-12 col-md-12 col-lg-2">
                    <br />
                    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
                </div>  
        </div>
    </section><br /><br />
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>