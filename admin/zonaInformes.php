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
        $tipoUsuario = $_SESSION["tipo"];
        $tipo = $_SESSION["tipo"]; 
    }

    if (isset($_REQUEST["mes"])) {
        $mes = strtoupper($_REQUEST["mes"]);
    }

    
?>

<html lang="es">
    <head>
        <title>Zona USUARIOS. Beauty And Shop</title>
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
                padding-top: 25px;
                /*margin-left: 25px;*/
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
                <br>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/menu-left.php"); ?> 
            </div>      

            <div class="col-sm-12 col-md-12 col-lg-8">
            <?php
                if($tipo == 1 || $tipoUsuario == 1) {
                ?>
                    <br >
                    <div class="text-center menuCategorias">
                        <a href="/beautyandshop/admin/zonaInformes.php?informe=1"><button type="button" class="btn btn-warning text-center">Productos + Vendidos</button></a>
                        <a href="/beautyandshop/admin/zonaInformes.php?informe=2"><button type="button" class="btn btn-warning text-center">Total Ventas por Meses</button></a>
                        <a href="/beautyandshop/admin/zonaInformes.php?informe=4"><button type="button" class="btn btn-warning text-center">Categorias Baja</button></a>
                        <a href="/beautyandshop/admin/zonaInformes.php?informe=5"><button type="button" class="btn btn-warning text-center">Productos Baja</button></a>
                        <a href="/beautyandshop/admin/zonaInformes.php?informe=6"><button type="button" class="btn btn-warning text-center">Usuarios Baja</button></a>
                    </div>

                <?php
                }
                
                ?>

                <div class="formularioBuscar col-sm-8 text-center">
		            <form class="form-inline my-2 my-lg-0" method="post" action="/beautyandshop/admin/zonaInformes.php?informe=3">
      			        <input class="form-control mr-sm-2" type="text" name="mes" required value="<?php if(isset($mes)) echo $mes ?>"><br>
      			        <button class="btn btn-outline-warning my-2 my-sm-0 text-center" type="submit" name="enviar" value="Total Ventas por Mes">TOTAL VENTAS POR MESES</button>
                    </form>
	            </div>
    
                <!--<div class="form">
                    <form method="post" action="/beautyandshop/admin/zonaInformes.php?informe=3">
                        Introduca Mes:
                        <input type="text" name="mes" required value="<?php //if(isset($mes)) echo $mes ?>"><br>
                        <input class="boton1" type="submit" name="enviar" value="Total Ventas por Mes">
                    </form>
                </div>-->

                <?php
                    if (isset($_REQUEST["informe"])) {
                        $informe = $_REQUEST["informe"];
                        if ($informe == 1) {
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT nombre, SUM(unidades) AS total FROM linpedidos 
                            INNER JOIN productos  ON linpedidos.codProducto = productos.codigo 
                            GROUP BY nombre 
                            ORDER BY total DESC");
        
                            /*$stmt = $cnn->query("SELECT codProducto, SUM(unidades) AS total FROM linpedidos 
                                GROUP BY codProducto ORDER BY total DESC");*/
                            $rows = $stmt->execute();
                   
                            echo "<h2>Productos más Vendidos</h2>";
                            echo "<div class='table-responsive'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>NOMBRE</th>";
                            echo "<th>UNIDADES</th>";
                            echo "</tr></thead></tr><tbody>";
                            while($fila = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>{$fila['nombre']}</td>"; 
                                echo "<td>{$fila['total']}</td>"; 
                                echo "</tr>";
                            }
                            echo"</tbody></table></div>";
                        }
                        else if ($informe == 2) {
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT MONTHNAME(fechaPedido) AS Mes, SUM(total) AS Total
                                                    FROM pedidos WHERE YEAR(fechaPedido) = '2023'
                                                    GROUP BY Mes
                                                    ORDER BY Mes ASC");
                            $rows = $stmt->execute();
                   
                            echo "<h2>Listado Importe Ventas por Meses</h2>";
                            echo "<div class='table-responsive'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>MES</th>";
                            echo "<th>IMPORTE</th>";
                            echo "</tr></thead></tr><tbody>";
                            while($fila = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>{$fila['Mes']}</td>"; 
                                echo "<td>{$fila['Total']} €</td>"; 
                                echo "</tr>";
                            }
                            echo"</tbody></table></div>";
                        }
                        else if ($informe == 3) {
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT MONTHNAME(fechaPedido) AS Mes, SUM(total) AS Total
                                                    FROM pedidos WHERE YEAR(fechaPedido) = '2023' AND MONTH(fechaPedido) = $mes
                                                    GROUP BY Mes
                                                    ORDER BY Mes ASC");
                            $rows = $stmt->execute();
                   
                            echo "<h2>Ventas del Mes </h2>" ;
                            echo "<div class='table-responsive'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>MES</th>";
                            echo "<th>IMPORTE</th>";
                            echo "</tr></thead></tr><tbody>";
                            while($fila = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>{$fila['Mes']}</td>"; 
                                echo "<td>{$fila['Total']} €</td>"; 
                                echo "</tr>";
                            }
                            echo"</tbody></table></div>";
                        }
                        else if ($informe == 4) {
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT * FROM categorias WHERE activo = 0 ORDER BY nombre ASC");
                            $rows = $stmt->execute();
                   
                            echo "<h2>Listado Categorias Desactivadas</h2>";
                            echo "<div class='table-responsive'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>CÓDIGO</th>";
                            echo "<th>NOMBRE</th>";
                            echo "<th>CATEGORIA PADRE</th>";
                            echo "<th>ACTIVA</th>";
                            echo "</tr></thead></tr><tbody>";
                            while($fila = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>{$fila['codigo']}</td>"; 
                                echo "<td>{$fila['nombre']} </td>"; 
                                echo "<td>{$fila['codCatPadre']}</td>"; 
                                echo "<td>{$fila['activo']}</td>"; 
                                echo "</tr>";
                            }
                            echo"</tbody></table></div>";
                        }
                        else if ($informe == 5) {
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT * FROM productos WHERE activo = 0 ORDER BY nombre ASC");
                            $rows = $stmt->execute();
                   
                            echo "<h2>Listado Productos Desactivados</h2>";
                            echo "<div class='table-responsive'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>CÓDIGO</th>";
                            echo "<th>NOMBRE</th>";
                            echo "<th>DESCRIPCIÓN</th>";
                            echo "<th>PRECIO</th>";
                            echo "<th>DESCUENTO</th>";
                            echo "<th>CATEGORIA</th>";
                            echo "<th>IMAGEN</th>";
                            echo "<th>ACTIVO</th>";
                            echo "</tr></thead></tr><tbody>";
                            while($fila = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>{$fila['codigo']}</td>"; 
                                echo "<td>{$fila['nombre']} </td>"; 
                                echo "<td>{$fila['descripcion']}</td>"; 
                                echo "<td>{$fila['precio']} €</td>"; 
                                echo "<td>{$fila['descuento']} €</td>";
                                echo "<td>{$fila['codigoCategoria']} </td>";
                                echo "<td><img src='{$fila['imagen']}' width='200' height='200'></td>";
                                echo "<td>{$fila['activo']}</td>"; 
                                echo "</tr>";
                            }
                            echo"</tbody></table></div>";
                        }
                        else if ($informe == 6) {
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT * FROM usuarios WHERE activo = 0 ORDER BY nombre ASC");
                            $rows = $stmt->execute();
                   
                            echo "<h2>Listado Usuarios Desactivados</h2>";
                            echo "<div class='table-responsive'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>DNI</th>";
                            echo "<th>NOMBRE</th>";
                            echo "<th>DIRECCIÓN</th>";
                            echo "<th>POBLACIÓN</th>";
                            echo "<th>PROVINCIA</th>";
                            echo "<th>TELÉFONO</th>";
                            echo "<th>EMAIL</th>";
                            echo "</tr></thead></tr><tbody>";
                            while($fila = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>{$fila['dni']}</td>"; 
                                echo "<td>{$fila['nombre']} </td>"; 
                                echo "<td>{$fila['direccion']}</td>"; 
                                echo "<td>{$fila['poblacion']} €</td>"; 
                                echo "<td>{$fila['provincia']} €</td>";
                                echo "<td>{$fila['telefono']} </td>";
                                echo "<td>{$fila['email']} </td>";
                                
                                echo "</tr>";
                            }
                            echo"</tbody></table></div>";
                        }
                    }

                    if(isset($_REQUEST["enviar"])) {
                        if (isset ($nombreBuscar)) {
                            $nombreBuscar = strtoupper($_REQUEST["nombreBuscar"]);
                            
                            $datosCategorias = array ();
                            $i=0;
                            $cnn = conectar_db();
                            $stmt = $cnn->prepare("SELECT * FROM categorias WHERE nombre LIKE '%$nombreBuscar%'");
                            $rows = $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, "categoria");
                            
                            $totalRegistros = $stmt->rowCount();
                           
                            if ($totalRegistros == 0 ) {
                            ?>
                            <div style="color:ffffff; background: red; "><b>ERROR!!! No existen CATEGORIAS con esos criterios de busqueda.</b></div><br><br>
                            <?php
                            }
                            else {
                                if ($rows == 1) {
                                    while($fila = $stmt->fetch()) {
                                        $datosCategorias[$i] = new categoria();
                                        //echo $fila->getCodigo();
                                        $datosCategorias[$i] -> setCodigo($fila->getCodigo());
                                        $datosCategorias[$i] -> setNombre($fila->getNombre());
                                        $datosCategorias[$i] -> setActivo($fila->getActivo());
                                        $datosCategorias[$i] -> setCodCatPadre($fila->getCodCatPadre());
                                        $i++;
                                    }       
                                    echo mostrarCategorias($datosCategorias, $tipo);
                                }
                            }                                  
                        }
                        
                    }
            ?>
            </div>
            <br><br />
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>  
            </div>
        </div>
    </section><br><br>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>
</body>
</html>