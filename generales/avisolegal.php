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
   
    <title>Aviso Legal. BeautyAndShop</title>
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
    <div class="imagenAvisoLegal jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Aviso Legal</h1>
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
                            <h2 class="card-title">AVISO LEGAL</h2>
                            <p class="card-text text-justify">El presente Aviso Legal regula las condiciones generales de acceso y 
                            utilización del sitio web accesible en la dirección URL https://beautyandshop.net (en adelante, el sitio 
                            web), que Hokuhome, SL pone a disposición de los usuarios de Internet.  </p>

                            <p class="card-text text-justify">La utilización del sitio web implica la aceptación plena y sin reservas 
                            de todas y cada una de las disposiciones incluidas en este Aviso Legal. En consecuencia, el usuario del 
                            sitio web debe leer atentamente el presente Aviso Legal en cada una de las ocasiones en que se proponga 
                            utilizar la web, ya que el texto podría sufrir modificaciones a criterio del titular de la web, o a causa 
                            de un cambio legislativo, jurisprudencial o en la práctica empresarial. </p>

                            <p class="card-text text-justify">1.- TITULARIDAD DEL SITIO WEB.</p>
                            <ul>
                                <li>Nombre del titular: BEAUTY AND SHOP, S.L. C/ Fuerteventura, nº 145, CP 48001 Madrid (Madrid).</li>
                                <li>Domicilio social: C/ Fuerteventura, nº 145.</li>
                                <li>Población: MADRID.</li>
                                <li>Provincia: MADRID.</li>
                                <li>C.P.: 48001.</li>
                                <li>C.I.F.: B12578023.</li>
                                <li>Teléfono de contacto: 676312536.</li>
                                <li>Correo electrónico: info@beautyandshop.net.</li>
                                <li>Datos registrales: Inscrita en el Registro Mercantil de Madrid, Tomo: 2927, Libro: 0, Folio: 127, 
                                    Sección: 8, Hoja: MA80185; cuyo fichero de información de clientes se encuentra inscrito en el Registro 
                                    General de Protección de Datos con el código de inscripción 2130242680. </li>
                            </ul>
                            <p class="card-text text-justify">2.- OBJETO.</br>
                            El sitio web facilita a los usuarios del mismo el acceso a información y servicios prestados por 
                            BEAUTY AND SHOP, S.L. a aquellas personas u organizaciones interesadas en los mismos. </p>

                            <p class="card-text text-justify">3.- ACCESO Y UTILIZACIÓN DE LA WEB.</br>
                            3.1.- Carácter gratuito del acceso y utilización de la web.</br>
                            El acceso a la web tiene carácter gratuito para los usuarios de la misma.</br>
                            3.2.- Registro de usuarios.</br>
                            Con carácter general el acceso y utilización de la web no exige la previa suscripción o registro de los 
                            usuarios de la misma. </p>

                            <p class="card-text text-justify">4.- CONTENIDOS DE LA WEB.</br>
                            El idioma utilizado por el titular en la web será el castellano. BEAUTY AND SHOP, S.L. no se responsabiliza 
                            de la no comprensión o entendimiento del idioma de la web por el usuario, ni de sus consecuencias.
                            Beauty And Shop, S.L. podrá modificar los contenidos sin previo aviso, así como suprimir y cambiar éstos 
                            dentro de la web, como la forma en que se accede a éstos, sin justificación alguna y libremente, no 
                            responsabilizándose de las consecuencias que los mismos puedan ocasionar a los usuarios.</br>

                            Se prohíbe el uso de los contenidos de la web para promocionar, contratar o divulgar publicidad o 
                            información propia o de terceras personas sin la autorización de Beauty And Shop, S.L, ni remitir 
                            publicidad o información valiéndose para ello de los servicios o información que se ponen a disposición 
                            de los usuarios, independientemente de si la utilización es gratuita o no. </br>
                        
                            Los enlaces o hiperenlaces que incorporen terceros en sus páginas web, dirigidos a esta web, serán para la 
                            apertura de la página web completa, no pudiendo manifestar, directa o indirectamente, indicaciones falsas, 
                            inexactas o confusas, ni incurrir en acciones desleales o ilícitas en contra de Beauty And Shop, S.L.</p>

                            <p class="card-text text-justify">5.- LIMITACIÓN DE RESPONSABILIDAD.</br>
                            Tanto el acceso a la web como el uso inconsentido que pueda efectuarse de la información contenida en la misma 
                            es de la exclusiva responsabilidad de quien lo realiza. Beauty And Shop, S.L no responderá de ninguna consecuencia, 
                            daño o perjuicio que pudieran derivarse de dicho acceso o uso. Beauty And Shop, S.L no se hace responsable de 
                            los errores de seguridad, que se puedan producir ni de los daños que puedan causarse al sistema informático del 
                            usuario (hardware y software), o a los ficheros o documentos almacenados en el mismo, como consecuencia de:</p>
                            <ul>
                                <li>la presencia de un virus en el ordenador del usuario que sea utilizado para la conexión a los servicios y 
                                    contenidos de la web,</li>
                                <li>un mal funcionamiento del navegador,</li>
                                <li>y/o del uso de versiones no actualizadas del mismo.</li>
                            </ul>

                            <p class="card-text text-justify">Beauty And Shop, S.L no se hace responsable de la fiabilidad y rapidez de los 
                            hiperenlaces que se incorporen en la web para la apertura de otras. Hokuhome, SL no garantiza la utilidad de estos 
                            enlaces, ni se responsabiliza de los contenidos o servicios a los que pueda acceder el usuario por medio de estos 
                            enlaces, ni del buen funcionamiento de estas webs.</br>

                            Beauty And Shop, S.L no será responsable de los virus o demás programas informáticos que deterioren o puedan 
                            deteriorar los sistemas o equipos informáticos de los usuarios al acceder a su web u otras webs a las que se haya 
                            accedido mediante enlaces de esta web.</p>

                            <p class="card-text text-justify">6.- EMPLEO DE LA TECNOLOGÍA “COOKIE”.</br>
                            La web no emplea cookies ni cualquier otro procedimiento invisible de recogida de información cuando el usuario 
                            navega por ella, respetando en todo momento la confidencialidad e intimidad del mismo.</hr>
                        
                            *SI SE EMPLEAN COOKIES CONSULTAR COMUNICADO SOBRE USO DE COOKIES La web emplea cookies, puede consultar nuestra 
                            Política de Cookies, que respeta en todo momento la confidencialidad e intimidad del mismo.</p>

                            <p class="card-text text-justify">7.- PROPIEDAD INTELECTUAL E INDUSTRIAL.</br>
                            Son propiedad de Beauty And Shop, S.L, todos los derechos de propiedad industrial e intelectual de la web, así 
                            como de los contenidos que alberga. Cualquier uso de la web o sus contenidos deberá tener un carácter 
                            exclusivamente particular. Está reservado exclusivamente a, cualquier otro uso que suponga la copia, 
                            reproducción, distribución, transformación, comunicación pública o cualquier otra acción similar, de todo o parte 
                            de los contenidos de la web, por lo que ningún usuario podrá llevar a cabo estas acciones sin la autorización 
                            previa y por escrito de Beauty And Shop, S.L.</p>

                            <p class="card-text text-justify">8.- POLÍTICA DE PRIVACIDAD Y PROTECCION DE DATOS.</br>
                            Beauty And Shop, S.L. garantiza la protección y confidencialidad de los datos personales, de cualquier tipo que 
                            nos proporcionen nuestras empresas clientes de acuerdo con lo dispuesto en la Ley Orgánica 15/1999, de 13 de 
                            Diciembre de Protección de Datos de Carácter Personal.<br>

                            Todos los datos facilitados por nuestras empresas clientes a Beauty And Shop, S.L o a su personal, serán 
                            incluidos en un fichero automatizado de datos de carácter personal creado y mantenido bajo la responsabilidad de 
                            Beauty And Shop, S.L., imprescindibles para prestar los servicios solicitados por los usuarios.</br>

                            Los datos facilitados serán tratados según el Reglamento de Medidas de Seguridad (Real Decreto 1720/2007 de 21 de 
                            Diciembre), en este sentido Beauty And Shop, S.L. ha adoptado los niveles de protección que legalmente se exigen, 
                            y ha instalado todas las medidas técnicas a su alcance para evitar la perdida, mal uso, alteración, acceso no 
                            autorizado por terceros. No obstante, el usuario debe ser consciente de que las medidas de seguridad en Internet 
                            no son inexpugnables. En caso en que considere oportuno que se cedan sus datos de carácter personal a otras 
                            entidades, el usuario será informado de los datos cedidos, de la finalidad del fichero y del nombre y dirección 
                            del cesionario, para que de su consentimiento inequívoco al respecto.</br>
                            
                            En cumplimiento de lo establecido en la RGPD, el usuario podrá ejercer sus derechos de acceso, rectificación, 
                            cancelación y oposición. Para ello debe de contactar con nosotros en info@beautyandshop.net</p>

                            <p class="card-text text-justify">9.- LEGISLACIÓN APLICABLE Y JURISDICCIÓN COMPETENTE.</br>
                            El presente Aviso Legal se interpretará y regirá de conformidad con la legislación española. Beauty And Shop, S.L 
                            y los usuarios, con renuncia expresa a cualquier otro fuero que pudiera corresponderles, se someten al de los 
                            juzgados y tribunales del domicilio del usuario para cualquier controversia que pudiera derivarse del acceso 
                            o uso de la web. En el caso de que el usuario tenga su domicilio fuera de España, Beauty And Shop, S.L. y el 
                            usuario, se someten, con renuncia expresa a cualquier otro fuero, a los juzgados y tribunales del domicilio 
                            de Beauty And Shop, S.L.</p>

                            <img class="img-fluid rounded mx-auto d-block" src="/beautyandshop/img/avisoLegalPie.jpg" alt="imagen pagina Envios">
                            
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