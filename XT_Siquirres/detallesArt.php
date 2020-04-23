<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Detalles</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/Iconos/XT Siquirres.png" rel="icon">

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
  $clsUsu = new clsUsuarios();

  //Mientras el request no este vacío
  if(!empty($_GET['codigo'])) {

      /*
       * @var clsArticulos $clsArtcls
       */
      $clsArtcls = new clsArticulos($_GET);
      $articulo = $clsArtcls->buscarArtPorCod();
  } else {
    header('Location: /index.php');
  }

  if(isset($_GET['update'])){

    if($_GET['update'] == 0 || $_GET['update'] == 1){
      $msj = '¡se ha modificado un artículo con éxito!';
    }
  }

?>

</head>

<body>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | DETALLES</a>
        <div class="row text-md-right">

          <a class="btn btn-outline-light" href="/index.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Inicio.png"><br>INICIO
          </a>&nbsp;&nbsp;|&nbsp;&nbsp;

<?php if(!$clsUsu->usuarioAnonimo()): ?>

          <a class="btn btn-outline-light" href="detallesUsu.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Config.png"><br>MATENIMIENTO DE<br>USUARIOS
          </a>&nbsp;&nbsp;|&nbsp;&nbsp;

          <a class="btn btn-outline-light" href="login.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Logout.png"><br>CERRAR SESION
          </a>

<?php else: ?>

          <a class="btn btn-outline-light" href="login.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Login.png"><br>INICIAR SESION
          </a>

<?php endif; ?>

      </div>
    </div>
  </nav><hr>

  
<?php if(isset($msj)): ?>

  <div class="alert alert-success" role="alert" style="text-align: center;">
    <h4 class="alert-heading">ARTICULO MODIFICADO</h4>
    <p><?php echo $msj; ?></p>
  </div>

<?php else: ?>
  <br><br><br><br>
<?php endif; ?>

      <div class="container"><br>
        <h2>Información a detalle del artículo</h2>
        <p class="mb-0">Visite nuestra tienda oficial ubicada en Siquirres, Limón, Costa Rica.</p><br>
      </div>

      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-md-6" data-aos="fade-up">
            <img src="<?php echo$articulo->Foto; ?>" alt="Image" class="img-fluid">
          </div>
        <div class="col-md-5 ml-auto" data-aos="fade-up" data-aos-delay="100"><br><br><br><br>
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

<?php if(!$clsUsu->usuarioAnonimo()): ?>

        <div class="container" style="text-align: center;"><br><br>
          <h4 class="h2 mb-3">Mantenimiento de artículos</h4><br>
          <p>
            <a href="/eliminarArt.php?codigo=<?php echo $articulo->Codigo; ?>" class="btn btn-outline-danger btn-lg">Eliminar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/configArt.php?codigo=<?php echo $articulo->Codigo; ?>" class="btn btn-outline-warning btn-lg">Modificar</a>
          </p>
        </div>

<?php endif; ?>

        </div>
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