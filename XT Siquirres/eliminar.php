<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Eliminación Artículo</title>
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
  $clsUsu = new clsUsuarios();

  if($clsUsu->usuarioAnonimo()){
  header('Location: /XT_Siquirres/index.php');  
  }


  $clsArtcls = new clsArticulos($_REQUEST);

  if(!empty($_POST['codigo']) && isset($_POST)) {

  	if($clsArtcls->eliminarArt($_POST['codigo'])){

  	header('Location: /XT_Siquirres/index.php?delete=si');	
  	}
  }

  //Mientras el request no este vacío
  if(!empty($_GET['codigo'])) {

      /*
       * @var clsArticulos $clsArtcls
       */
      $articulo = $clsArtcls->buscarArtPorCod();
  }
  ?>

</head>

<body>


<?php if(isset($articulo)): ?>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | ELIMINAR ARTICULO</a>

      <a class="burger" data-toggle="collapse" data-target="#main-navbar">
        <span></span>
      </a>

    </div>
  </nav>

<form action="eliminar.php" method="POST">
  <main id="main">

    <div class="site-section">

	<div class="container" style="background-color: yellow; color: black; text-align: center;">
        <p class="mb-0"><strong>*** Esta página es solo para personal administrativo, los cambios que aquí se realicen no podrán ser revertidos ***
        </strong></p>
    </div>

      <div class="site-section pb-0">
        <div class="container">
          <div class="row align-items-stretch">
            <div class="col-md-8" data-aos="fade-up">
              <img src="<?php echo$articulo->Foto; ?>" alt="Image" class="img-fluid">
            </div>
            <input type="hidden" name="codigo" value="<?php echo $articulo->Codigo; ?>">
            <div class="col-md-3 ml-auto" data-aos="fade-up" data-aos-delay="100">
              <div class="sticky-content">
                <br><br><h3 class="h3"><?php echo $articulo->Marca; ?></h3>
                <p class="mb-4"><span class="text-muted"><?php echo $articulo->Categoria; ?></span></p>

                <div class="mb-5">
                  <p><strong>Descripción: </strong><?php echo $articulo->Descripcion; ?></p>
                </div>

                <ul class="list-unstyled list-line mb-5">
                  <li><strong>Existencias: </strong><?php echo $articulo->Existencias; ?></li>
                  <li><strong>Precio: </strong>₡<?php echo $articulo->Precio; ?></li>
                  <li><strong>Última modificación: </strong><?php echo $articulo->Fecha_Modificacion; ?></li>
                  <li><strong>Último usuario editor: </strong><?php echo $articulo->Ced_UsuarioModificador; ?></li>
                </ul>

              </div>
            </div>

            <div class="container" style="text-align: center;">
                
                <br><br><br>
                <h4 class="h2 mb-3">¿Desea continuar con la eliminación de este artículo?</h4><br>
           		<input class="btn btn-outline-danger btn-lg" type="submit" value="CONFIRMAR">
              
            </div>

          </div>
        </div>
      </div>

  </main>
</form>

<?php else: ?>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | ERROR AL CARGAR EL CONTENIDO</a>
    </div>
  </nav><br><br>

  <div class="container">
    
    <br><br><br><hr>
    <br>
    <h1 style="color: red; text-align: center;">No se ha logrado establecer el artículo a eliminar, regrese y vuelva a seleccionar el artículo...</h1> 
    <br><br><br><br><br><br>
    <a href="index.php" class="btn-lg btn-block btn btn-outline-secondary">Regresar a Pantalla de Inicio</a>
    <hr><br><br><br>

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
