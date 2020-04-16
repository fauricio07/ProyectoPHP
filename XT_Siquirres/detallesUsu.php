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
  date_default_timezone_set('America/Costa_Rica');

  /*
   * @var clsUsuarios $clsUsu
   */
  $clsUsu = new clsUsuarios();
  $numUsuario = 0;

  //Mientras se encuentre iniciada una sesión
  if($clsUsu->usuarioAnonimo()){
    header('Location: /index.php');
  }
;
  if (isset($_GET['update'])) {
    if ($_GET['update'] == 0 || $_GET['update'] == 1) {
      $msj1 = '¡Se ha actualizado un perfil correctamente!';
    }
  } elseif(isset($_POST['cedula'])){
    if($clsUsu->eliminarUsu($_POST['cedula'])){

      $msj2 = '¡Se ha eliminado un perfil con éxito!';
      if($_POST['cedula'] == $_SESSION['sesion']->Cedula){
        header('Location: /login.php?delete=true');
      }
    }
  }

  ?>

</head>

<body>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | DETALLES DE USUARIOS</a>
    </div>
  </nav><hr><br><br>

<div class="container" style="text-align: center;">
  <h2 class="h2"><strong>USUARIOS REGISTRADOS</strong></h2><br>

<?php if(isset($msj1)): ?>

    <div class="alert alert-warning" role="alert" style="text-align: center;">
      <h4 class="alert-heading">PERFIL ACTUALIZADO</h4>
      <p><?php echo $msj1; ?></p>
    </div>

<?php elseif(isset($msj2)): ?>

    <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">PERFIL ELIMINADO</h4>
      <p><?php echo $msj2; ?></p>
    </div>

<?php endif; ?>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Foto</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha Creación</th>
            <th scope="col">Última modificación</th>
            <th scope="col">Usuario responsable</th>
            <th scope="col" width="205px"><a class="btn btn-success" href="configUsu.php">Nuevo Perfil</a></th>
          </tr>
        </thead>
      <tbody>
          
<?php foreach ($clsUsu->mostrarUsuarios() as $usuario): ?>
  <?php //if($usuario->Cedula != $_SESSION['sesion']->Cedula): ?>
      <form method="POST" action="eliminarUsu.php">
        <tr>
            <th scope="row"><?php echo $numUsuario += 1; ?><input type="hidden" name="cedula" value="<?php echo $usuario->Cedula; ?>"></th>
            <td><?php echo $usuario->Nombre_Completo; ?></td>
            <td><img style="width: 40px; height: 40px;" src="<?php echo $usuario->Foto; ?>"></td>
            <td><?php echo $usuario->Descripcion; ?></td>
            <td><?php echo $usuario->Fecha_Creacion; ?></td>
            <td><?php echo $usuario->Fecha_Modificacion; ?></td>
            <td><?php echo $usuario->Ced_UsuarioCreador; ?></td>
            <td><input class="btn btn-danger" type="submit" value="Eliminar">&nbsp;&nbsp;<a class="btn btn-warning" href="configUsu.php?cedula=<?php echo $usuario->Cedula; ?>">Editar</a></td>
        </tr>
      </form>
  <?php //endif; ?>
<?php endforeach; ?>

      </tbody>
    </table>
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