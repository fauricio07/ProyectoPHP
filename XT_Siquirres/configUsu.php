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
  $clsUsu = new clsUsuarios($_REQUEST);

  //Mientras se encuentre iniciada una sesión
  if($clsUsu->usuarioAnonimo()){
    header('Location: /index.php');
  }

  if (!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contraseña']) && !empty($_POST['descripcion']) && !empty($_POST['fechaCre']) && !empty($_POST['fechaMod']) && !empty($_POST['cedAdmin'])) {


    if(!empty($_FILES['foto']['name'])){

      $nuevaDIR = 'img' . DIRECTORY_SEPARATOR . 'usuarios' . DIRECTORY_SEPARATOR . $_FILES['foto']['name'];
      move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . DIRECTORY_SEPARATOR . $nuevaDIR);
    } else {
      $nuevaDIR = $_POST['urlFoto'];
    }

    if(isset($_POST['cedMod'])){
      $modifico = $clsUsu->modificarUsu($nuevaDIR);
      header('Location: /detallesUsu.php?update=' . $modifico);
    } else {
      $inserto = $clsUsu->insertarUsu($nuevaDIR);
    }    
  }

  if(!empty($_GET['cedula'])) {
    $cuenta = $clsUsu->buscarUsuPorID();
  }

  ?>

</head>

<body>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | CONFIGURAR USUARIO</a>
    </div>
  </nav><hr><br><br>

<?php if(isset($inserto) && $inserto == 1): ?>

    <div class="alert alert-warning" role="alert" style="text-align: center;">
      <h4 class="alert-heading">PERFIL INSERTADO</h4>
      <p>¡Se ha insertado un nuevo perfil con éxito!</p>
      <a href="detallesUsu.php" class="btn btn-success">Ver los Perfiles</a>
    </div>

<?php endif; ?>

<div class="container">
    <form method="POST" enctype="multipart/form-data" action="configUsu.php">

        <div class="row align-items-stretch">

            <div class="col-md-6">

              <div class="container" style="text-align: center;">
                <br><br>
                <?php if(isset($cuenta)): ?>

                <input type="hidden" class="form-control" style="text-align: center;" name="cedMod" value="<?php echo $cuenta->Cedula; ?>" readonly><br>

                <!-- Envía el url guardado en la BD por si el usuario no la actualiza --> 
                <input type="hidden" name="urlFoto" value="<?php echo $cuenta->Foto; ?>">

                <div class="input-group">
                  <div class="custom-file">   
                    <input type="file" class="custom-file-input" name="foto" id="imagen">
                    <label class="custom-file-label" for="imagen">Seleccionar imagen...</label>
                  </div>
                </div>

                <?php else: ?>
   
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Cédula: </span>
                  </div>
                    <input type="text" class="form-control" autocomplete="off" name="cedIns" required>
                </div><br>

                <div class="input-group">
                  <div class="custom-file">   
                    <input type="file" class="custom-file-input" name="foto" id="imagen" required>
                    <label class="custom-file-label" for="imagen">Seleccionar imagen...</label>
                  </div>
                </div>

                <?php endif; ?>
              </div>

                <div class="container" style="text-align: center;">
                  <br><img src="<?php echo isset($cuenta)? $cuenta->Foto : null ; ?>" style="width: 62%;" id="imagenmuestra"> 
                </div>
                
            </div>

            <div class="col-md-5 ml-auto"><br><br><br>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Nombre Completo: </span>
                </div>
                  <input type="text" class="form-control" autocomplete="off" name="nombre" value="<?php echo isset($cuenta)? $cuenta->Nombre_Completo : null ; ?>" required>
              </div>

              <div class="input-group mb-3">      
                <div class="input-group-prepend">
                  <span class="input-group-text">Correo: </span>
                </div>
                  <input type="text" class="form-control" autocomplete="off" name="correo" value="<?php echo isset($cuenta)? $cuenta->Correo : null ; ?>" required>
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">@example.com</span>
                </div>
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Contraseña: </span>
                </div>
                  <input type="text" class="form-control" autocomplete="off" name="contraseña" required>
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Descripción: </span>
                </div>
                  <textarea style="max-height: 200px; height: 200px; min-height: 200px;" class="form-control" autocomplete="off" name="descripcion" required><?php echo isset($cuenta)? $cuenta->Descripcion : null ; ?></textarea>
              </div>
                  
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Fecha Creación: </span>
                </div>
                  <input type="text" class="form-control" autocomplete="off" name="fechaCre" value="<?php echo isset($cuenta)? $cuenta->Fecha_Creacion : date('Y') . '-' . date('m') . '-' . date('d'); ?>" readonly="true">
              </div>
                  
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Última Modificación: </span>
                </div>
                  <input type="text" class="form-control" autocomplete="off" name="fechaMod" value="<?php echo date('Y') . '-' . date('m') . '-' . date('d'); ?>" readonly="true">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Responsable: </span>
                </div>
                  <input type="text" class="form-control" autocomplete="off" name="cedAdmin" value="<?php echo $_SESSION['sesion']->Cedula; ?>" readonly="true">
              </div>

            </div>

          <div class="container" style="text-align: center;"><br><br><br>
            <input class="btn btn-outline-primary btn-lg" type="submit" value="Guardar cambios">
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

  <!-- Script que actualiza la etiqueta img para pre-visualizar la imagen cargada en el <input type="file"/> -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
    function readURL(input) {
      //Si el tag input ha cargado algo y ese algo es una imagen
      if (input.files && input.files[0]) {
        var reader = new FileReader(); //Clase para leer archivos
        reader.onload = function(e) {
          // Asignamos el atributo src al tag de imagen
          $('#imagenmuestra').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    //El listener va asignado al input
    $("#imagen").change(function() {
      readURL(this);
    });
  </script>
</body>

</html>