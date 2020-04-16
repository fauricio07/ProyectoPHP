
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Página de Inicio</title>
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

  <!-- Se instancia la clase articulos -->
<?php
  require_once 'inclusiones.php';
  $clsArt = new clsArticulos($_POST);
  $clsUsu = new clsUsuarios();

  if(!empty($_GET['delete']) && $_GET['delete'] == 'true') {
    $msj = 'se ha eliminado un artículo con éxito';
  }
?>
  
</head>


<body>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | PÁGINA DE INICIO</a>
    </div>
  </nav><hr>

<?php if(isset($msj)): ?><br>

  <div class="alert alert-danger" role="alert" style="text-align: center;">
    <h4 class="alert-heading">ARTICULO ELIMINADO</h4>
    <p><?php echo $msj; ?></p>
  </div>

<?php else: ?>
  <br><br><br><br>
<?php endif; ?><br>

    <div class="container">
      <div class="row mb-5 align-items-center">
        <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
          <h2>Bienvenidos</h2>
          <p class="mb-0">La mayor distribuidora en equipo gaming de Costa Rica |</p>
          <p>La mejor technología al mejor precio |</p>
        </div>
      </div>

      <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">     
  
<?php foreach($clsArt->mostrarArtcls() as $articulo): ?>

        <div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">        
          <a href="/detallesArt.php?codigo=<?php echo $articulo->Codigo; ?>" class="item-wrap fancybox">
          <div class="work-info">
            <h3><h3><?php echo $articulo->Marca; ?></h3></h3>
            <span><h3><?php echo $articulo->Categoria; ?></h3></span>
          </div>
          <img class="img-fluid" src="<?php echo $articulo->Foto; ?>"> 
          </a>
        </div>

<?php endforeach; ?>

      </div>

<?php if(!$clsUsu->usuarioAnonimo()): ?>

      <div class="container" style="text-align: center;"><br><br><br><br>
        <h4 class="h2 mb-3">Mantenimiento de artículos</h4><br>
        <p><a href="/configArt.php" class="btn btn-outline-success btn-lg">Nuevo Artículo</a></p>              
      </div>

<?php endif; ?>

    </div><br><br>

  <footer class="footer" role="contentinfo"><hr>
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
