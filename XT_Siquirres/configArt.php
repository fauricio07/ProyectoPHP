<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Artículo</title>
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
  date_default_timezone_set('America/Costa_Rica');
  $clsUsu = new clsUsuarios();

  //Mientras se encuentre iniciada una sesión
  if($clsUsu->usuarioAnonimo()){
    header('Location: /index.php');
  }
      /*
       * @var clsArticulos $clsArtcls
       */
      $clsArtcls = new clsArticulos($_REQUEST);
      $nuevaDIR = null;

      if(isset($_FILES['foto'])){

        if(!empty($_FILES['foto']['name'])){

        $nuevaDIR = 'img' . DIRECTORY_SEPARATOR . 'articulos' . DIRECTORY_SEPARATOR . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . DIRECTORY_SEPARATOR . $nuevaDIR);
        } else {
        $nuevaDIR = $_POST['urlFoto'];
        }
      }

    //Mientras se hayan enviado datos por el metodo POST y no exista codigo
    if(!isset($_POST['codigo']) && !empty($_FILES['foto']['name']) && !empty($_POST['marca']) && !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['existencias']) && !empty($_POST['fechaMod']) && !empty($_POST['cedAdmin'])){
      
      $codigoArt = $clsArtcls->insertarArt($nuevaDIR);
    } elseif(!empty($_REQUEST['codigo'])) {

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $modificado = $clsArtcls->modificarArt($nuevaDIR);
        header('Location: /detallesArt.php?update=' . $modificado . '&codigo=' . $_POST['codigo']);
      } else {
        $articulo = $clsArtcls->buscarArtPorCod();
      }
    }

?>

</head>

<body>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | CONFIGURAR ARTICULO</a>      
        <div class="row text-md-right">

          <a class="btn btn-outline-light" href="/index.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Inicio.png"><br>INICIO
          </a>&nbsp;&nbsp;|&nbsp;&nbsp;

          <a class="btn btn-outline-light" href="detallesUsu.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Config.png"><br>MATENIMIENTO DE<br>USUARIOS
          </a>&nbsp;&nbsp;|&nbsp;&nbsp;
          
          <a class="btn btn-outline-light" href="login.php" style="text-decoration: none; text-align: center; font-size: smaller;">
            <img src="img/Iconos/Logout.png"><br>CERRAR SESION
          </a>

      </div>
    </div>
  </nav><hr><br>

  <div class="container" style="background-color: yellow; color: black; text-align: center;">
    <p class="mb-0"><strong>*** Esta página es solo para personal administrativo, los cambios que aquí se realicen no podrán ser revertidos ***</strong></p>
    <p class="mb-0"><strong>*** Su identificación será guardada en un historial de modificaciones realizadas por concepto de delegación de responsabilidades ***</strong></p>
  </div><br><br>

<!-- Mensaje informativo -->
<?php if(isset($codigoArt)): ?>

  <div class="alert alert-success" role="alert" style="text-align: center;">
    <h4 class="alert-heading">ARTICULO CREADO</h4>
    <p>¡se ha creado un nuevo artículo con éxito!</p>
    <a href="detallesArt.php?codigo=<?php echo $codigoArt; ?>" class="btn btn-success">Ver artículo</a>
  </div>

<?php endif; ?>

<div class="container">
  <form method="POST" enctype="multipart/form-data" action="configArt.php">
    <div class="row align-items-stretch">
      <div class="col-md-7" data-aos="fade-up" style="text-align: center;"><br><br>
        <div class="input-group">
          <div class="custom-file">

<?php if(isset($articulo)): ?>

            <!-- Envía el url guardado en la BD por si el usuario no la actualiza -->
            <input type="hidden" name="urlFoto" value="<?php echo $articulo->Foto; ?>">
            <!-- Envía el codigo del artículo que está siendo modificado -->
            <input type="hidden" class="form-control" name="codigo" value="<?php echo $articulo->Codigo; ?>">
            <input type="file" class="custom-file-input" name="foto" id="imagen"><br>                    

<?php else: ?>

            <input type="file" class="custom-file-input" name="foto" id="imagen" required>

<?php endif; ?>

            <label class="custom-file-label" style="text-align: left;" for="imagen">Seleccionar imagen...</label>

          </div>
        </div><br>

        <img src="<?php echo isset($articulo)? $articulo->Foto : null ; ?>" id="imagenmuestra">
      </div>

<div class="col-md-4 ml-auto" data-aos="fade-up" data-aos-delay="100"><br><br><br>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Marca:</span>
    </div>
    <input type="text" class="form-control" autocomplete="off" name="marca" value="<?php echo isset($articulo)? $articulo->Marca : null; ?>" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Categoría:</span>
    </div>
    <input type="text" class="form-control" autocomplete="off" name="categoria" value="<?php echo isset($articulo)? $articulo->Categoria : null; ?>" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Descripción: </span>
    </div>
    <textarea style="max-height: 200px; height: 200px; min-height: 200px;" class="form-control" autocomplete="off" name="descripcion" required><?php echo isset($articulo)? $articulo->Descripcion : null; ?></textarea>
  </div>
        
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Precio: </span>
      <span class="input-group-text">₡</span>
    </div>
    <input type="text" class="form-control" autocomplete="off" name="precio" value="<?php echo isset($articulo)? $articulo->Precio : null; ?>" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Existencias:</span>
    </div>
    <input type="text" class="form-control" autocomplete="off" name="existencias" value="<?php echo isset($articulo)? $articulo->Existencias : null; ?>" required>
  </div>
        
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Fecha Modificación:</span>
    </div>
    <input type="text" class="form-control" name="fechaMod" value="<?php echo date('Y') . '-' . date('m') . '-' . date('d'); ?>" readonly>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">ID Administrador:</span>
    </div>
    <input type="text" class="form-control" name="cedAdmin" value="<?php echo $_SESSION['sesion']->Cedula; ?>" readonly>
  </div>
</div>
    
    </div><br><br>

    <div class="container" style="text-align: center;">
      <input class="btn btn-outline-primary btn-lg" type="submit" value="Guardar cambios">
    </div>

  </form>
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