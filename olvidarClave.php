<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

               
    if (isset($_REQUEST["enviar"]) == TRUE) {
        $telefono=$_REQUEST["telefono"];
        $email=$_REQUEST["email"];

        $datosUsuarios = [];
        $datosUsuarios = llenarArray(0);
        
        if(isset($_REQUEST["clave"])){
            $enc=0;
            for($i=0;$i<count($datosUsuarios) && $enc == 0;$i++) {
                $emailAux = $datosUsuarios[$i]-> getEmail();
                $telefonoAux = $datosUsuarios[$i]-> getTelefono();
                if (($emailAux == $email)) {
                    if (($telefono == $telefonoAux)) {
                        if ($datosUsuarios[$i]-> getActivo() == 1) {
                            $codUsuario = $datosUsuarios[$i]-> getCodUsuario();
                            $enc = 1;
                        }
                    }
                }
            }
            
            $clave=$_REQUEST["clave"];
            $clave1 = password_hash($clave, PASSWORD_DEFAULT);
            updateClave ($clave1, $codUsuario);
        }
        else {
            $encontrado = 0;
            for($i=0;$i<count($datosUsuarios) && $encontrado == 0;$i++) {
                $emailAux = $datosUsuarios[$i]-> getEmail();
                $telefonoAux = $datosUsuarios[$i]-> getTelefono();

                if (($emailAux == $email)) {
                    if (($telefono == $telefonoAux)) {
                        if ($datosUsuarios[$i]-> getActivo() == 1) {
                            //ECHO "LA CUENTA ESTÁ ACTIVA";
                            $codUsuario = $datosUsuarios[$i]-> getCodUsuario();
                            $encontrado = 1;
                            $error="no";
                        }
                    }
                    else {
                        $error="si";
                    }
                }
                else {
                    $error="si";
                }
            }
        }
    }
?>

<html lang="es">
    <head>
        <title>Restablecer Contraseña. BeautyAndShop</title>
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
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenRecuperarClave jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Restablecer Contraseña</h1>
                <!--<p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>-->
            </div>
    </div>
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <?php 
                if (isset($error) && $error=="si"){
                ?>
                    <div class="smsError"><b>ERROR!!! EMAIL o TELÉFONO Incorrectos.</b></div><br><br>
                <?php 
                }
                ?>
                <h2 class="h3 text-center text-warning">¿Olvidó Su Contraseña?</h2><hr><br>
                <form action="" method="post"> 
                    <div class="form-group">
                        <label for="email" class="col-sm-12 col-form-label text-warning"><h5>EMAIL</h5></label>
                        <div class="col-sm-12">
                            <input class="form-control errorImput" type="email" required maxlength="50" size="50" name="email" value="<?php if(isset($email)) echo $email ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="col-sm-12 col-form-label text-warning"><h5>TELÉFONO</h5></label>
                        <div class="col-sm-12">
                            <input class="form-control errorImput" type="tel" pattern="[0-9]{9}" title="Debes poner 9 Números" maxlength="9" size="9" name="telefono" required value="<?php if(isset($telefono)) echo $telefono ?>">
                        </div>
                    </div>
                    
                    <?php 
                    if (isset($encontrado) && $encontrado == 1){
                    ?>
                        <div class="form-group">
                            <label for="clave" class="col-sm-12 col-form-label text-warning"><h5>NUEVA CONTRASEÑA</h5></label>
                            <div class="col-sm-12">
                                <input class="form-control" type="password" id="clave" name="clave" required>
                            </div>
                        </div>
                    <?php 
                    }
                    ?>
                    <div class="text-center">
                        <button class="btn btn-success text-center botonesCompra1" type="submit" name="enviar" value="Enviar">ENVIAR</button>
                        <a href="/beautyandshop/index.php"><button class="btn btn-danger text-center botonesCompra1" type="button" value="cancelar">CANCELAR</button></a>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div> 
        </div>
    </section><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>