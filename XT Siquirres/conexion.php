<?php


function conectar() {

	$host = "database";
	$username = "lamp";
	$password = "lamp";
	$dbname = "ExtremeTech_Siquirres";

	$conexion = new mysqli($host, $username, $password, $dbname);

	return $conexion;
}

?>