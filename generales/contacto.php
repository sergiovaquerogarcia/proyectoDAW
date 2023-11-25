<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Contacto. BeautyAndShop</title>
    <link rel="icon" href="/beautyandshop/img/logo.ico">

	<!-- Funciones JavaScript-->
	<script src="/beautyandshop/js/funcionesContacto.js"></script>

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
	<link rel="stylesheet" href="/beautyandshop/css/styleFormularioContacto.css">
    <link rel="stylesheet" href="/beautyandshop/css/myStiles.css">
    <link rel="stylesheet" href="/beautyandshop/css/styleFooter.css">
    <link rel="stylesheet" type="text/css" href="/beautyandshop/css/styleBotonUp.css">
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up fa-6" aria-hidden="true"></i></button>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/beautyandshop/plantillas/cabecera.php"); ?>
    <div class="divider py-1"></div>
    
    <!-- IMAGEN DE LA CABECERA DE LA PÁGINA-->
    <div class="imagenContacto jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-4 text-dark">Contacto</h1>
                <!--<p class="lead">Descubre nuestro nuevo centro de Elche. Ven a visitarnos. No te arrepentirás.</p>-->
            </div>
    </div>

	<section class="container-fluid">
        <div class="row"> 
			<div class="col-sm-12 col-md-12 col-lg-5">
            <?php 
                if (isset($_REQUEST["envioOk"]) && $_REQUEST["envioOk"]=="si"){
                ?>
                    <div style='background-color:green;font-weight:bold;padding:8px;color:white;' class='text-center'><strong>Su CONSULTA ha sido enviada correctamente. 
                        Nos pondremos en contacto con usted a la mayor brevedad posible. 
                        Gracias!!</strong>
                    </div> 
                <?php 
                }
                ?>
				<h4 class="h4 text-center text-warning">Escríbenos y en breve nos pondremos en contacto contigo</h4><hr><br>
				<form name="fvalida" method="post" action="/beautyandshop/generales/enviarDatos.php" onsubmit="return validarform(this);">
  					<div class="form-group">
                        <label for="nombre" class="col-sm-12 col-form-label text-warning"><h5>NOMBRE: *</h5></label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text"  id="nombre" name="nombre" size="50" maxlength="100">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="email" class="col-sm-12 col-form-label text-warning"><h5>EMAIL: *</h5></label>
                        <div class="col-sm-12">
                            <input class="form-control errorImput" type="email" id="email" name="email" size="50" maxlength="100">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="telefono" class="col-sm-12 col-form-label text-warning"><h5>TELÉFONO: *</h5></label>
                        <div class="col-sm-12">
                            <input class="form-control errorImput" type="text" id="telefono" name="telefono" size="9" maxlength="9">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="asunto" class="col-sm-12 col-form-label text-warning"><h5>ASUNTO: *</h5></label>
                        <div class="col-sm-12">
                            <input class="form-control errorImput" type="text" id="asunto" name="asunto" size="50" maxlength="40">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="mensaje" class="col-sm-12 col-form-label text-warning"><h5>MENSAJE: *</h5></label>
                        <div class="col-sm-12">
						<textarea id="mensaje" name="mensaje" cols="50" rows="5" placeholder="Deja aquí tu comentario..."></textarea>
                        </div>
                    </div>
					<div class="text-center">
                        <!--<input type="submit" name="enviar" value="ENVIAR CONSULTA">-->
						<button class="btn btn-success text-center" type="submit" name="enviar">ENVIAR CONSULTA</button>
                        <button class="btn btn-warning text-center" type="reset" name="borrar">LIMPIAR DATOS</button>
                    </div>
                </form>

                

					<!--<label for="nombre">Nombre: *</label>
					<input type="text" id="nombre" name="nombre" size="50" maxlength="100">
					<label for="email">E-mail: * </label>
					<input type="email" id="email" name="email" size="50" maxlength="100">
					<label for="telefono">Teléfono: * </label>
					<input type="text" id="telefono" name="telefono" size="9" maxlength="9">
					<label for="asunto">Asunto: * </label>
					<input type="text" id="asunto" name="asunto" size="50" maxlength="40">
					<label for="mensaje">Mensaje: * </label>
					<textarea id="mensaje" name="mensaje" cols="50" rows="5" placeholder="Deja aquí tu comentario..."></textarea>-->
					<!--<input type="submit" name="Enviar" value="Enviar" onclick="validarform()">-->
					<!--<input type="submit" name="Enviar" value="Enviar">-->
					
			</div>
			
			<div class="datosContacto col-sm-12 col-md-12 col-lg-5">
				<h4 class="text-uppercase fw-bold">Contacto</h4>
            	<hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 150px; background-color: orangered; height: 2px"/>
            	<p><i class="fas fa-home mr-3"></i> C/ Fuerteventura, nº 145, CP 48001 Madrid (Madrid)</p>
            	<p><i class="fas fa-envelope mr-3"></i> info@beautyandshop.net</p>
            	<p><i class="fas fa-phone mr-3"></i> + 34 676 312 36</p>
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