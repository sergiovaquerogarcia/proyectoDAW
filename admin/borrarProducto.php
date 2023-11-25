<?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/seguridad.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/funciones.php");

    if(isset($_SESSION["cusu"])) {
        $cusu= $_SESSION["cusu"];    
    }
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];  
    }
    if(isset($_SESSION["tipo"])) {
        $tipo = $_SESSION["tipo"]; 
        $tipoUsuario = $_SESSION["tipo"]; 
    }
   
    if(isset($_REQUEST["codigo"])) {
        $codigo = $_REQUEST["codigo"];
    }
      
    if(empty($_REQUEST["codigo"]) == TRUE) {
        header ("location:/beautyandshop/admin/zonaProductos.php");    
    }
    else {
        $cnn = conectar_db();
        
        $stmt =$cnn->prepare("SELECT * FROM productos WHERE codigo = :codigo");
        $rows = $stmt->execute(array(":codigo"=>$codigo));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'producto');  
        
        if ($rows == 1) {
            $fila = $stmt->fetch();
            $nombre = $fila -> getNombre();
            $activo = 0;
        }
        else {
            header ("location:/beautyandshop/admin/zonaProductos.php");      
        }
    }


    if(isset($_REQUEST["eliminar"]) == TRUE) {
        $cnn = conectar_db();
        
       // $stmt =$cnn->prepare("Delete from productos where codigo = :codigo");
        //$rows = $stmt->execute(array(":codigo"=>$_REQUEST["codigo"]));
        $stmt =$cnn->prepare("UPDATE productos SET activo= :activo WHERE codigo= :codigo");
        $rows = $stmt->execute(array(":activo"=>$activo, ":codigo"=>$codigo));
        if ($rows == 1) {       
            if ($tipoUsuario == 1 || $tipo == 1) {
                header ("location:/beautyandshop/admin/zonaProductos.php?nombreproducto= " . $nombre);
            }
            elseif ($tipoUsuario == 2 || $tipo == 2){
                header ("location:/beautyandshop/admin/zonaProductos.php?nombreproducto= " . $nombre); 
            }
        }
        else {
            echo "ERROR!!!! No se ha podido eliminar";
        }
    }
?>

<html lang="es">
    <head>
        <title>Borrar PRODUCTO. Beauty And Shop</title>
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
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8">
                <h2 class="h2 text-center text-warning">BORRAR USUARIO</h2><hr><br>
                <h4 class="h4 text-center text-danger">¿Está seguro de eliminar el siguiente Producto?</h4>
            
                <div class="text-center">
                    <h5 class="h5 text-info">Nombre Producto:</h5> <span><strong><?php echo $nombre;?></strong></span>
                    <h5 class="h5 text-info">Código:</h5> <span><strong><?php echo $codigo;?></strong></span><br>
                </div><br><br><hr>

                <form method="post" action="">
                    <div class="text-center">
                        <button class="btn btn-success text-center" type="submit" name="eliminar" value="Eliminar">ELIMINAR</button>
                        <!--<button class="btn btn-warning text-center" type="reset" class="btn btn-warning text-center">LIMPIAR</button>-->
                        <?php
                        if ($tipoUsuario == 1 || $tipo == 1) {
                        ?> 
                            <a href="/beautyandshop/admin/zonaProductos.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                        <?php
                        }
                        elseif ($tipoUsuario == 2 || $tipo == 2) {
                        ?>
                            <a href="/beautyandshop/admin/zonaProductos.php"><button class="btn btn-danger text-center" type="button" value="cancelar">CANCELAR</button></a>
                        <?php
                        }
                       ?>
                    </div> 
                </form><br>
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