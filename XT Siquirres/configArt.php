<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ExtremeTech Siquirres | Configuración Artículo</title>
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

//Mientras se encuentre iniciada una sesión
if(isset($_SESSION['sesion']) && $_SESSION['sesion'] == true){

      /*
       * @var clsArticulos $clsArtcls
       */
      $clsArtcls = new clsArticulos($_REQUEST);
      $nuevaDIR = null;

      if(isset($_FILES['foto'])){

        if(!empty($_FILES['foto']['name'])){

        $nuevaDIR = 'img' . DIRECTORY_SEPARATOR . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . DIRECTORY_SEPARATOR . $nuevaDIR);
        } else {

        $nuevaDIR = $_REQUEST['urlFoto'];
        }
      }

    //Mientras se hayan enviado datos por el metodo POST y no exita codigo
    if(!empty($_FILES['foto']['name']) && !empty($_POST['marca']) && !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['existencias']) && !empty($_POST['fechaMod']) && !empty($_POST['cedAdmin']) && !isset($_POST['codigo'])){
      
      $codigoArt = $clsArtcls->insertarArt($nuevaDIR);
    }elseif (!empty($_REQUEST['codigo'])) {
        
      $modificado = $clsArtcls->modificarArt($nuevaDIR);
      $articulo = $clsArtcls->buscarArtPorCod();
    }
  }
  ?>

</head>

<body>


<!-- Mientras se encuentre iniciada una sesión -->
<?php if(isset($_SESSION['sesion']) && $_SESSION['sesion'] == true): ?>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | CONFIGURAR ARTICULO</a>
    </div>
  </nav><br>

<!-- Mensajes informativos -->
  <?php if(isset($codigoArt)): ?>
    
    <div class="alert alert-success" role="alert" style="text-align: center;">
      <h4 class="alert-heading">¡¡¡ARTICULO CREADO!!!</h4>
      <p>se ha creado un nuevo artículo con éxito</p>
      <a href="detalles.php?codigo=<?php echo $codigoArt; ?>" class="btn btn-success">Ver artículo</a>
    </div>
  <?php elseif(isset($modificado) && $modificado != 0): ?>

    <div class="alert alert-success" role="alert" style="text-align: center;">
      <h4 class="alert-heading">¡¡¡ARTICULO MODIFICADO!!!</h4>
      <p>se ha modificado un artículo con éxito</p>
    </div>
  <?php endif; ?><br>

<div class="container" style="background-color: yellow; color: black; text-align: center;">
        <p class="mb-0"><strong>*** Esta página es solo para personal administrativo, los cambios que aquí se realicen no podrán ser revertidos ***
        </strong></p>

        <p class="mb-0"><strong>*** Su identificación será guardada en un historial de modificaciones realizadas por concepto de delegación de responsabilidades ***</strong></p>
    </div><br>

  <main id="main">

    <form method="post" enctype="multipart/form-data" action="configArt.php">

        <div class="container">
          <div class="row align-items-stretch">
            <div class="col-md-8" data-aos="fade-up"><br><br><br>

               <div class="input-group">
                  <div class="custom-file">

                    <?php if(isset($articulo)): ?>

              <!-- Envía el url guardado en la BD por si el usuario no la actualiza -->
                    <input type="hidden" name="urlFoto" value="<?php echo $articulo->Foto; ?>">

              <!-- Envía el codigo del artículo que está siendo modificado -->
                    <input type="hidden" class="form-control" aria-describedby="basic-addon1" name="codigo" id="codigo" value="<?php echo $articulo->Codigo; ?>">
                    <input type="file" class="custom-file-input" name="foto" id="imagen"><br>                    
                    <?php else: ?>

                    <input type="file" class="custom-file-input" name="foto" id="imagen" required>
                    <?php endif; ?>

                    <label class="custom-file-label" for="imagen">Seleccionar imagen...</label>

                  </div>
                </div>
                  <img src="<?php echo isset($articulo)? $articulo->Foto : null ; ?>" id="imagenmuestra"> 

            </div>

            <div class="col-md-3 ml-auto" data-aos="fade-up" data-aos-delay="100">
              <div class="sticky-content">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Marca:</span>
          </div>
          <input type="text" class="form-control" autocomplete="off" aria-describedby="basic-addon1" name="marca" id="marca" value="<?php echo isset($articulo)? $articulo->Marca : null; ?>">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Categoría:</span>
          </div>
          <input type="text" class="form-control" autocomplete="off" aria-describedby="basic-addon1" name="categoria" id="categoria" value="<?php echo isset($articulo)? $articulo->Categoria : null; ?>">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Descripción: </span>
          </div>
          <textarea style="height: 326px;" class="form-control" autocomplete="off" name="descripcion" id="descripcion"><?php echo isset($articulo)? $articulo->Descripcion : null; ?></textarea>
        </div>
        
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Precio: </span>
            <span class="input-group-text">₡</span>
          </div>
          <input type="text" class="form-control" autocomplete="off" name="precio" id="precio" value="<?php echo isset($articulo)? $articulo->Precio : null; ?>">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Existencias:</span>
          </div>
          <input type="text" class="form-control" autocomplete="off" aria-describedby="basic-addon1" name="existencias" id="existencias" value="<?php echo isset($articulo)? $articulo->Existencias : null; ?>">
        </div>
        
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Fecha Modificación:</span>
          </div>
          <input type="text" class="form-control" autocomplete="off" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly="true" name="fechaMod" id="fechaMod" value="<?php echo isset($articulo)? $articulo->Fecha_Modificacion : date('Y') . '-' . date('m') . '-' . date('d'); ?>">
        </div>

        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">ID administrador:</span>
          </div>
          <input type="text" class="form-control" autocomplete="off" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly="true" name="cedAdmin" id="cedAdmin" value="702490253">
          <?php //echo isset($articulo)? $articulo->Ced_UsuarioModificador : null; ?>
        </div>

              </div>
            </div>
          </div>
        </div><br>
          
          <div class="container" style="text-align: center;">
           <input class="btn btn-outline-primary btn-lg" type="submit" value="Guardar cambios">
          </div>

    </form>

  </main>

<?php else: ?>

  <nav class="navbar navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand">EXTREME-TECH SIQUIRRES | ERROR AL CARGAR EL CONTENIDO</a>
    </div>
  </nav><br><br>

  <div class="container">
    
    <br><br><br><hr>
    <br>
    <h1 style="color: red; text-align: center;">Actualmente no cuentas con los credenciales para modificar articulos, inicia sesión primero...</h1>
    <br><br><br><br><br><br>
    <a href="index.php" class="btn-lg btn-block btn btn-outline-secondary">Regresar a Pantalla de Inicio</a>
    <hr>

  </div>
  
<?php endif; ?>

  <br><br><br>
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