<?php 
require_once 'inclusiones.php';
$clsUsu = new clsUsuarios();

$clsUsu->cerrarSesion();
header('Location: /XT_Siquirres/login.php?out=si');
?>