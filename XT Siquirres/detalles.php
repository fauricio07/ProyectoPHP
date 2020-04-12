<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Detalles</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/XT Siquirres_opt.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700|Raleway:400,700&display=swap"
    rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
  <link href="vendor/aos/aos.css" rel="stylesheet">
  <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">

  <?php    
  require_once 'inclusiones.php';

  $_SESSION['sesion'] = true;
  //unset($_SESSION['sesion']);

  //Mientras el request no este vacío
  if(!empty($_GET['codigo'])) {

      /*
       * @var clsArticulos $clsArtcls
       */
      $clsArtcls = new clsArticulos($_REQUEST);
      $articulo = $clsArtcls->buscarArtPorCod();
  }
  ?>

</head>

<body>


  <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
    <div class="container py-2 py-md-5">
      <div class="row align-items-start">
        <div class="col-md-2">
          <ul class="custom-menu">
            <li><a href="index.php">Página de Inicio</a></li>
            <br>
            <li><a href="login.php">Iniciar Sesión</a></li>
          </ul>
  </div>
    <div class="col-md-6 d-none d-md-block  mr-auto">
      <div>
        <p><em>"El diseño es el alma de todo lo creado por el hombre"</em><br><a>Steve Jobs</a></p>
      </div>
    </div>
  <div class="col-md-4 d-none d-md-block">
      <p><em>"Tus clientes más insatisfechos son tu mayor fuente de aprendizaje"</em><br><a>Bill Gates</a></p>
  </div>
      </div>

    </div>
  </div>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | DETALLES</a>

      <a class="burger" data-toggle="collapse" data-target="#main-navbar">
        <span></span>
      </a>

    </div>
  </nav>

<?php if(isset($articulo)): ?>

  <main id="main">

    <div class="site-section">
      <div class="container">
        <div class="row mb-4 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2>Información a detalle del artículo</h2>
            <p class="mb-0">Visite nuestra tienda oficial ubicada en Siquirres, Limón, Costa Rica.</p>
          </div>


        </div>
      </div>

      <div class="site-section pb-0">
        <div class="container">
          <div class="row align-items-stretch">
            <div class="col-md-8" data-aos="fade-up">
              <img src="<?php echo$articulo->Foto; ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-3 ml-auto" data-aos="fade-up" data-aos-delay="100">
              <div class="sticky-content"><br><br><br>
                <h3 class="h3"><?php echo $articulo->Marca; ?></h3>
                <p class="mb-4"><span class="text-muted"><?php echo $articulo->Categoria; ?></span></p>

                <div class="mb-5">
                  <p><?php echo $articulo->Descripcion; ?></p>
                </div>

                <ul class="list-unstyled list-line mb-5">
                  <li><strong>Existencias: </strong><?php echo $articulo->Existencias; ?></li>
                  <li><strong>Precio: </strong>₡<?php echo $articulo->Precio; ?></li>
                </ul>

              </div>
            </div>

  <?php if(isset($_SESSION['sesion']) && $_SESSION['sesion'] == true): ?>

            <div class="container" style="text-align: center;">

                <h4 class="h2 mb-3">Mantenimiento de artículos</h4><br>
                <p>
                  <a href="configArt.php" class="btn btn-outline-success btn-lg">Agregar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="configArt.php?codigo=<?php echo $articulo->Codigo; ?>" class="btn btn-outline-warning btn-lg">Modificar</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="configArt.php?codigo=<?php echo $articulo->Codigo; ?>" class="btn btn-outline-danger btn-lg">Eliminar</a>
                </p>
              
            </div>

  <?php endif; ?>

          </div>
        </div>
      </div>

  </main>



<?php else: ?>

  <div class="container">
    
    <br><br><br><br><br><hr>
    <br>
    <h1 style="color: red; text-align: center;">No se ha logrado establecer el artículo a buscar, regrese y vuelva a seleccionar el artículo...</h1>
    <br>
    <a href="index.php" class="btn-lg btn-block btn btn-outline-secondary">Regresar a Pantalla de Inicio</a>
    <hr><br><br><br><br><br>

  </div>
  
<?php endif; ?>

  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <p class="mb-1">&copy; Copyright ExtremeTech Siquirres. All Rights Reserved</p>
          <div class="credits">

            Designed by <a>Alonso Calderón Q.</a>
          </div>
        </div>
        <div class="col-sm-6 social text-md-right">
          <a><span class="icofont-twitter"></span></a>
          <a><span class="icofont-facebook"></span></a>
          <a><span class="icofont-dribbble"></span></a>
          <a><span class="icofont-behance"></span></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery/jquery-migrate.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/easing/easing.min.js"></script>
  <script src="vendor/php-email-form/validate.js"></script>
  <script src="vendor/isotope/isotope.pkgd.min.js"></script>
  <script src="vendor/aos/aos.js"></script>
  <script src="vendor/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>

</body>

</html>