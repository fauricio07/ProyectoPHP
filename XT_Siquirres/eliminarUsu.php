<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Usuarios</title>
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

  /*
   * @var clsUsuarios $clsUsu
   */
  $clsUsu = new clsUsuarios($_POST);

  //Mientras se encuentre iniciada una sesión
  if($clsUsu->usuarioAnonimo()){
    header('Location: /index.php');
  }

  if(!empty($_POST['cedula'])) {
    $cuenta = $clsUsu->buscarUsuPorID();
  } else {
    header('Location: /detallesUsu.php');
  }

  ?>

</head>

<body>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | ELIMINAR USUARIO</a>
    </div>
  </nav><hr><br><br>

<div class="container">
  <form method="POST" action="detallesUsu.php">
      <div class="row align-items-stretch">

        <div class="col-md-6">
          <div class="container" style="text-align: center;"><br><br>   
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Cédula: </span>
              </div>
                <input type="text" class="form-control" style="text-align: center;" name="cedula" value="<?php echo $cuenta->Cedula; ?>" readonly><br>
            </div><br><br>

            <img src="<?php echo $cuenta->Foto;?>" style="width: 62%;" readonly>            
          </div>                
        </div>

        <div class="col-md-5 ml-auto"><br><br><br>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Nombre Completo: </span>
            </div>
              <input type="text" class="form-control" value="<?php echo $cuenta->Nombre_Completo; ?>" readonly>
          </div>

          <div class="input-group mb-3">      
            <div class="input-group-prepend">
              <span class="input-group-text">Correo: </span>
            </div>
              <input type="text" class="form-control" value="<?php echo $cuenta->Correo; ?>" readonly>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Descripción: </span>
            </div>
              <textarea style="max-height: 200px; height: 200px; min-height: 200px;" class="form-control" readonly><?php echo $cuenta->Descripcion; ?></textarea>
          </div>
                  
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Fecha Creación: </span>
            </div>
              <input type="text" class="form-control" value="<?php echo $cuenta->Fecha_Creacion; ?>" readonly>
          </div>
                  
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Última Modificación: </span>
            </div>
              <input type="text" class="form-control" value="<?php $cuenta->Fecha_Modificacion; ?>" readonly>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Responsable: </span>
            </div>
              <input type="text" class="form-control" value="<?php echo $cuenta->Ced_UsuarioCreador; ?>" readonly>
          </div>
        </div>

      <div class="container" style="text-align: center;"><br><br><br>
          <h4 class="h2 mb-3">¿Desea continuar con la eliminación de este perfil?</h4><br>
          <input class="btn btn-outline-danger btn-lg" type="submit" value="CONFIRMAR">
      </div>
    </div>    
  </form>
</div><br><br><br>

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