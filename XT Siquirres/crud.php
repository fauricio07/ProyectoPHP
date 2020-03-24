<?php

/*
Creación de la clase artículos para el mantenimiento de la tabla Artículos de la base de datos Extreme Tech Siquirres.
*/

class articulos {


	function insertarArt($descripcion, $marca, $precio, $categoria, $existencias, $foto, $descuento, $fechaMod, $cedUsuarioMod) : bool
	{

	include("conexion.php");
	$conexion = conectar();
	$consulta = "INSERT INTO Articulos (Descripcion, Marca, Precio, Categoria, Existencias, Foto, Descuento, Fecha_Modificacion, Ced_UsuarioModificador) VALUES('$descripcion, $marca, $precio, $categoria, $existencias, $foto, $descuento, $fechaMod, $cedUsuarioMod')";
	$resultado = $conexion->query($consulta);

	return ($consulta->connect_errno) ? false : true;
	}


	function modificarArt($codigo, $descripcion, $marca, $precio, $categoria, $existencias, $foto, $descuento, $fechaMod, $cedUsuarioMod) : bool
	{

	include("conexion.php");
	$conexion = conectar();
	$consulta = "UPDATE Articulos SET Descripcion = $descripcion, Marca = $marca, Precio = $precio, Categoria = $categoria, Existencias = $existencias, Foto = $foto, Descuento = $descuento, Fecha_Modificacion = $fechaMod, Ced_UsuarioModificador = $cedUsuarioMod WHERE Codigo = $codigo";
	$resultado = $conexion->query($consulta);

	return ($consulta->connect_errno) ? false : true;
	}


	function eliminarArt($codigo) : bool
	{

	include("conexion.php");
	$conexion = conectar();
	$consulta = "DELETE FROM Articulos WHERE Codigo = $codigo";
	$resultado = $conexion->query($consulta);

	return ($consulta->connect_errno) ? false : true;
	}
}

/* --Function de prueba--

	function prueba()
	{

	include("conexion.php");
	$conexion = conectar();
	$sql = "SELECT Codigo, Marca, Precio FROM Articulos";
	$result = $conexion->query($sql);

	var_dump($result->num_rows);
		while($row = $result->fetch_assoc()){

			echo '********** ' . $row['Codigo'] . ' ' . $row['Marca'] . ' ' . $row['Precio'] . PHP_EOL;
		}
	} 
*/


/*
Creación de la clase usuarios para el mantenimiento de la tabla Usuarios de la base de datos Extreme Tech Siquirres.
*/

class usuarios {

	/* @array que será cargado con los valores del metodo POST enviados desde el login */
	protected $credenciales;

	/* @bool que valida si el metodo POST me está extrayendo las credenciales vacías */
	protected $validacion;

	public $nombre, $ced;
	public $found = false;

	public function cargarDatos($post) {
		$this->credenciales = $post;
	}

	public function validar(): array {

		$datos = [
			empty($this->credenciales['cedula']),
			empty($this->credenciales['contraseña']),
		];

		$this->validacion = empty(array_filter($datos));
		return $datos;
	}

	public function esValido(){
		return $this->validacion;
	}

	public function validarUsu() : bool {

		$id = $this->credenciales['cedula'];
		$pass = $this->credenciales['contraseña'];

		include 'conexion.php';
		$conexion = conectar();

		$consulta = "SELECT Nombre_Completo, Cedula, Contraseña FROM Usuarios";
		$resultado = $conexion->query($consulta);

		while($fila = $resultado->fetch_assoc()){

			if($id == $fila['Cedula'] && $pass == $fila['Contraseña']) {

				session_start();
				$_SESSION['nombre'] = $fila['Nombre_Completo'];
				$_SESSION['ced'] = $fila['Cedula'];

				//$nombre = $fila['Nombre_Completo'];
				//$ced =  $fila['Cedula'];
				$found = true;
			}
		}

	return $found;
	}

	/* 
	Aquí inician las funciones de mantenimiento 
	*/
	public function insertarUsu($cedula, $nombre, $foto, $correo, $contraseña, $descripcion, $fechaCrea, $fechaMod, $cedUsuarioCrea) : bool
	{

	include("conexion.php");
	$conexion = conectar();
	$consulta = "INSERT INTO Usuarios (Cedula, Nombre_Completo, Foto, Correo, Contraseña, Descripcion, Fecha_Creacion, Fecha_Modificacion, Ced_UsuarioCreador) VALUES('$cedula, $nombre, $foto, $correo, $contraseña, $descripcion, $fechaCrea, $fechaMod, $cedUsuarioCrea')";
	$resultado = $conexion->query($consulta);

	return ($consulta->connect_errno) ? false : true;
	}


	public function modificarUsu($cedula, $nombre, $foto, $correo, $contraseña, $descripcion, $fechaCrea, $fechaMod, $cedUsuarioCrea) : bool
	{

	include("conexion.php");
	$conexion = conectar();
	$consulta = "UPDATE Usuarios SET Nombre_Completo = $nombre, Foto = $foto, Correo = $correo, Contraseña = $contraseña, Descripcion = $descripcion, Fecha_Creacion = $fechaCrea, Fecha_Modificacion = $fechaMod, Ced_UsuarioCreador = $cedUsuarioCrea WHERE Cedula = $cedula";
	$resultado = $conexion->query($consulta);

	return ($consulta->connect_errno) ? false : true;
	}


	public function eliminarUsu($cedula) : bool
	{

	include("conexion.php");
	$conexion = conectar();
	$consulta = "DELETE FROM Usuarios WHERE Cedula = $cedula";
	$resultado = $conexion->query($consulta);

	return ($consulta->connect_errno) ? false : true;
	}	
	/* 
	Aquí finalizan las funciones de mantenimiento 
	*/
}
