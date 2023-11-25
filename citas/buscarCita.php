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

    if (isset($_REQUEST["nombreBuscar"])) {
        $nombreBuscar = strtoupper($_REQUEST["nombreBuscar"]);
    }
?>

<html lang="es">
<head>
    <title>Formulario Búsqueda CITAS. BeautyAndShop</title>
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
    <script src="/beautyandshop/js/botonUp.js"></script>

    <style>
        div.formularioBuscar {
            margin: 0 auto;
        }
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
                <div class="formularioBuscar col-sm-5 text-center">
		            <form class="form-inline my-2 my-lg-0">
      			        <input class="form-control mr-sm-2" type="text" name="nombreBuscar" required value="<?php if(isset($nombreBuscar)) echo $nombreBuscar ?>"><br>
      			        <button class="btn btn-outline-warning my-2 my-sm-0 text-center" type="submit" name="enviar" value="BUSCAR">BUSCAR</button>
                    </form>
	            </div>

                <?php
                    if(isset($_REQUEST["enviar"])) {
                        if (isset ($nombreBuscar)) {
                            $nombreBuscar = strtoupper($_REQUEST["nombreBuscar"]);
                            
                            $datosUsuarios = array ();
                            $datosCitas = array ();
                            
                            $i=0;
                            $j=0;
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT * FROM usuarios WHERE nombre LIKE '%$nombreBuscar%' ORDER BY nombre ASC");
                            $rows = $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, "usuario");
                            
                            $totalRegistros = $stmt->rowCount();
                           
                            if ($totalRegistros == 0 ) {
                            ?>
                            <div class="smsError"><b>ERROR!!! No existen Usuarios con esos criterios de busqueda.</b></div><br><br>
                            <?php
                            }
                            else {
                                //echo "TOTAL REGISTROS: " . $totalRegistros;
                                if ($rows == 1) {
                                    while($fila = $stmt->fetch()) {
                                        $datosUsuarios[$i] = new usuario();
                                        $codUsuario = $fila->getCodUsuario();
                                        $dniAux = $fila->getDni();
                                        $datosUsuarios[$i] -> setDni($fila->getDni());
                                        $datosUsuarios[$i] -> setNombre($fila->getNombre());
                                        $datosUsuarios[$i] -> setCodUsuario($fila->getCodUsuario());
                                        $datosUsuarios[$i] -> setClave($fila->getClave());
                                        $datosUsuarios[$i] -> setTipoUsuario($fila->getTipoUsuario());
                                        $datosUsuarios[$i] -> setDireccion($fila->getDireccion());
                                        $datosUsuarios[$i] -> setCp($fila->getCp());
                                        $datosUsuarios[$i] -> setPoblacion($fila->getPoblacion());
                                        $datosUsuarios[$i] -> setProvincia($fila->getProvincia());
                                        $datosUsuarios[$i] -> setTelefono($fila->getTelefono());
                                        $datosUsuarios[$i] -> setEmail($fila->getEmail());
                                        $datosUsuarios[$i] -> setActivo($fila->getActivo());
                                        //echo "USUARIO: " . $datosUsuarios[$i] -> getNombre();
                                        $i++;
                                    

                                        //AHORA BUSCO LOS DATOS DE LAS CITAS.
                                        $cnn1 = conectar_db();
                                        $stmt1 = $cnn1 -> prepare("SELECT * FROM citas WHERE codUsuario = :codUsuario ORDER BY fechaCita DESC, horaCita ASC");
                                        $stmt1->execute(array(":codUsuario"=>$codUsuario)); 
                                        $stmt1->setFetchMode(PDO::FETCH_CLASS, "cita");

                                    
                                        while($fila1 = $stmt1->fetch()) {
                                            $datosCitas[$j] = new cita();
                                            $datosCitas[$j] -> setCodCita($fila1->getCodCita());
                                            $datosCitas[$j] -> setFechaCita($fila1->getFechaCita());
                                            $datosCitas[$j] -> setHoraCita($fila1->getHoraCita());
                                            $datosCitas[$j] -> setCodUsuario($fila1->getCodUsuario());
                                            $datosCitas[$j] -> setTotal($fila1->getTotal());
                                            //echo "COD CITA: " . $datosCitas[$j] -> getCodCita();
                                            $j++;
                                        }
                                    } 
                                }
                                echo mostrarTodasCitas($datosCitas);
                            }                                  
                        }
                        
                    }
            ?>
            </div>
            <br>
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>
        </div>
    </section>
    <br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>