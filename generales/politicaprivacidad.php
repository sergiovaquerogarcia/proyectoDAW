<?php 
    if (isset($_REQUEST["codigo"])) {
        $codigo = $_REQUEST["codigo"];
    }
        
    if(isset($_REQUEST["tipo"])) {
        $tipo=$_REQUEST["tipo"];
    }
        
    if(isset($_REQUEST["tipoUsuario"])) {
        $tipo=$_REQUEST["tipoUsuario"];
    }
        
    if(isset($_SESSION["tipoUsuario"])) {
        $tipo=$_SESSION["tipoUsuario"];
    }

    if(isset($_SESSION["dni"])) {
        $dni=$_SESSION["dni"];
    }
?>
   

<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Politica de Privacidad. BeautyAndShop</title>
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
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenPoliticaPrivacidad jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Política de Privacidad</h1>
                <!--<p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>-->
            </div>
    </div>

    <section class="container-fluid">
        <div class="row">       
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
        
            <div class="col-sm-12 col-md-12 col-lg-10">
                <div class="quienes row g-0 ">
                    <div class="col-md-12">
                        <div class="card-body contenedor">
                            <h2 class="card-title">POLÍTICA DE PRIVACIDAD</h2>
                            <p class="card-text text-justify">En cumplimiento de lo establecido en la RGPD, le informamos que sus datos serán 
                            tratados en nuestros ficheros, con la finalidad del mantenimiento y cumplimiento de la relación con nuestra entidad,
                            incluyendo el envío de comunicaciones en el marco de la citada relación.</br>

                            Así mismo, sus datos serán cedidos en todos aquellos casos en que sea necesario para el desarrollo, cumplimiento y 
                            control de la relación con nuestra entidad o en los supuestos en que lo autorice una norma con rango de ley. 
                            En cumplimiento de la RGPD puede ejercitar sus derechos ARCO ante BEAUTY AND SHOP, S.L., C/ Fuerteventura, nº 145, 
                            CP 48001 Madrid (Madrid), adjuntando fotocopia de su DNI.</br>

                            El contenido de esta comunicación, así como el de toda la documentación anexa, está sujeta al deber de secreto y va 
                            dirigida únicamente a su destinatario. En el supuesto de que usted no fuera el destinatario, le solicitamos que nos 
                            lo indique y no comunique su contenido a terceros, procediendo a su destrucción.</br>

                            El prestador de servicios de la sociedad de la información deberá tener en cuenta que, además de la información que 
                            facilite a los destinatarios del servicio a través de su “Política de Privacidad”, deberá disponer de textos 
                            legales adicionales relativos a otras normativas de obligado cumplimiento, tales como, sin carácter limitativo o 
                            excluyente, condiciones generales de la contratación, propiedad intelectual e industrial, condiciones de 
                            utilización de la página web y responsabilidades al respecto, o lo que la propia Ley 34/2002, de 11 de julio, 
                            de Servicios de la Sociedad de la Información y de Comercio Electrónico pueda establecer en cualesquiera otros 
                            preceptos al margen de su artículo 10 o incluso completar la información que, en relación a éste, fuese necesaria. 
                            </p>

                            <img class="img-fluid rounded mx-auto d-block" src="/beautyandshop/img/politicaPrivacidadPie.png" alt="imagen pagina Envios">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-12 col-lg-2">
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/aside-right.php"); ?>   
            </div>  
       </div>
    </section>
    <div class="divider py-1"></div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/footer.php"); ?>
    <script src="/beautyandshop/js/botonUp.js"></script>

</html>