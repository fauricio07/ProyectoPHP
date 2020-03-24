<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Administración</title>
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

</head>

<body>

<?php

include "crud.php";
$clsUsuarios = new usuarios();

session_start();

if(isset($_SESSION['nombre'])):
?>

  <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
    <div class="container py-2 py-md-5">
      <div class="row align-items-start">
        <div class="col-md-2">
          <ul class="custom-menu">
            <li><a href="index.php">Página de Inicio</a></li>
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
      <a class="navbar-brand">XTREMETECH SIQUIRRES | SESIÓN INICIADA</a>

      <a href="#" class="burger" data-toggle="collapse" data-target="#main-navbar">
        <span></span>
      </a>

    </div>
  </nav>



  <main id="main">

    <div class="site-section pb-0 site-portfolio">
      <div class="container">
        <div class="row mb-5 align-items-end">
          <div class="col-md-6" data-aos="fade-up">

            <h2 style="text-align: center;"><?php echo strtoupper($_SESSION['nombre']); ?></h2>
          </div>

        </div>

        <div class="row">
          <form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">

           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Cerrar Sesión">

          </form>

          <?php unset($_SESSION['nombre']); unset($_SESSION['ced']); ?>
        </div>

      </div>
    </div>

  </main>
  <footer class="footer mt-5 pt-5" role="contentinfo">
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

<?php else: ?>
  <?php header("Location: /XT_Siquirres/login.php") ?>
<?php endif; ?>

</body>

</html>
