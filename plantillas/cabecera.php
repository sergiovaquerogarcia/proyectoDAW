
<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_REQUEST["p"])) {
        $pagina = $_REQUEST["p"];
    }
    else {
        $pagina = 0;
    }

    if(isset($_SESSION["cusu"])) {
        $cusu=$_SESSION["cusu"];
    }

    if(isset($_SESSION["tipo"])) {
        $tipo=$_SESSION["tipo"];
        $tipoUsuario = $_SESSION["tipo"];
    }

    if(isset($_REQUEST["tipo"])) {
      $tipo=$_REQUEST["tipo"];
      $tipoUsuario = $_REQUEST["tipo"];
    }
  

    
    
?>

<!--Main Navigation-->

<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
    <div class="container-fluid">
      
      <?php
        if (isset($tipo)) {
          if ($tipo == 1) {
            echo "<a class='navbar-brand' href='/beautyandshop/index.php'><img class='d-block w-100' src='/beautyandshop/img/logoSmall.png' alt='Logo Beauty And Shop'></a>";
          }
          else if ($tipo == 2) {
            echo "<a class='navbar-brand' href='/beautyandshop/index.php'><img class='d-block w-100' src='/beautyandshop/img/logoSmall.png' alt='Logo Beauty And Shop'></a>";
          }
          else if ($tipo == 3) {
            echo "<a class='navbar-brand' href='/beautyandshop/index.php'><img class='d-block w-100' src='/beautyandshop/img/logoSmall.png' alt='Logo Beauty And Shop'></a>";
          }
          else if ($tipo == 4) {
            echo "<a class='navbar-brand' href='/beautyandshop/index.php'><img class='d-block w-100' src='/beautyandshop/img/logoSmall.png' alt='Logo Beauty And Shop'></a>";
          }
        }
        else {
          echo "<a class='navbar-brand' href='/beautyandshop/index.php'><img class='d-block w-100' src='/beautyandshop/img/logoSmall.png' alt='Logo Beauty And Shop'></a>";
        }
      ?>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
            <span class="navbar-toggler-icon"></span>
        </button>
       
        <div class="collapse navbar-collapse" id="navbar1">
          <ul class="navbar-nav mr-auto">
          <?php
              if ($pagina == 1) {
                  echo "<li class='nav-item active'>";
              }
              else {
                echo "<li class='nav-item'>";
              }
              if (isset($tipo)) {
                if ($tipo == 1) {
                  echo "<a class='nav-link' href='/beautyandshop/index.php?p=1'>Home</a>";
                }
                else if ($tipo == 2) {
                  echo "<a class='nav-link' href='/beautyandshop/index.php?p=1'>Home</a>";
                }
                else if ($tipo == 3) {
                  echo "<a class='nav-link' href='/beautyandshop/index.php?p=1'>Home</a>";
                }
                else if ($tipo == 4) {
                  echo "<li class='nav-item active'>";
                  echo "<a class='nav-link' href='/beautyandshop/index.php?p=1'>Home</a>";
                }
              }
              else {
                
                echo "<a class='nav-link' href='/beautyandshop/index.php?p=1'>Home <span class='sr-only'>(current)</span></a>";
              }
            ?>
	          </li>
            <?php
              if ($pagina == 2) {
              
              echo "<li class='nav-item active'>";
              }
              else {
                echo "<li class='nav-item'>";
              }
              if (isset($tipo)) {
                if ($tipo == 1) {
                  echo "<a class='nav-link' href='/beautyandshop/generales/quienesomos.php?p=2'>Quienes Somos</a>";
                }
                else if ($tipo == 2) {
                  echo "<a class='nav-link' href='/beautyandshop/generales/quienesomos.php?p=2'>Quienes Somos</a>";
                }
                else if ($tipo == 3) {
                  echo "<a class='nav-link' href='/beautyandshop/generales/quienesomos.php?p=2'>Quienes Somos</a>";
                }
                else if ($tipo == 4) {
                  echo "<a class='nav-link' href='/beautyandshop/generales/quienesomos.php?p=2'>Quienes Somos</a>";
                }
              }
              else {
                echo "<a class='nav-link' href='/beautyandshop/generales/quienesomos.php?p=2'>Quienes Somos <span class='sr-only'>(current)</span></a>";
              }
            ?>
              
            </li>
	          <?php
              if ($pagina == 5) {
              
              echo "<li class='nav-item active'>";
              }
              else {
                echo "<li class='nav-item'>";
              }
              if (isset($tipo)) {
                if ($tipo == 1) {
                  echo "<a class='nav-link' href='/beautyandshop/shop/shop.php?p=5'>Shop</a>";
                }
                else if ($tipo == 2) {
                  echo "<a class='nav-link' href='/beautyandshop/shop/shop.php?p=5'>Shop</a>";
                }
                else if ($tipo == 3) {
                  echo "<a class='nav-link' href='/beautyandshop/shop/shop.php?p=5'>Shop</a>";
                }
                else if ($tipo == 4) {
                  echo "<a class='nav-link' href='/beautyandshop/shop/shop.php?p=5'>Shop</a>";
                }
              }
              else {
                echo "<a class='nav-link' href='/beautyandshop/shop/shop.php?p=5'>Shop <span class='sr-only'>(current)</span></a>";
              }
            ?>
              
            </li>
	          <?php
              if ($pagina == 3) {
              
              echo "<li class='nav-item active'>";
              }
              else {
                echo "<li class='nav-item'>";
              }
            ?>
              <a class="nav-link" href="/beautyandshop/citas/cogerCita.php?p=3">Cita Online</a>
            </li>
            <?php
              if ($pagina == 4) {
              
              echo "<li class='nav-item active'>";
              }
              else {
                echo "<li class='nav-item'>";
              }
            ?>
              <a class="nav-link" href="/beautyandshop/generales/contacto.php?p=4">Contacto</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>-->
          </ul>
          <form class="form-inline my-2 my-lg-0" method="post" action="/beautyandshop/buscarProducto.php">
            <input class="form-control mr-sm-2" type="search" name="textoBuscar" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">BUSCAR PRODUCTOS</button>
          </form>
        </div>
    </div>
  </nav>
  
<!--Main Navigation-->