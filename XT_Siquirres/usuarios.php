<?php

/*
 * Class clsUsuarios
 */
class clsUsuarios extends clsConexion
{

    protected function init(): void{}
    
    /* @var  */
    protected $cuenta;

    /*
     * constructor clsUsuarios.
     * @param arreglo $solicitud
     */
    public function __construct($solicitud = []) {
        parent::__construct($solicitud);
    }

    /*
     * @return bool
     */
    public function iniciarSesion(): bool {
        $contraseña = md5($this->solicitud['contraseña']);
        $consulta = sprintf("SELECT Nombre_Completo, Foto FROM Usuarios WHERE Cedula = '%s' AND Contraseña = '%s'", $this->solicitud['cedula'], $contraseña);

        $resultado = $this->baseDatos->query($consulta);
        if(1 == $resultado->num_rows) {
            $cuenta = $resultado->fetch_object();
            $cuenta->Cedula = $this->solicitud['cedula'];
            $_SESSION['sesion'] = $cuenta;

            return True;
        }
        return False;
    }

    /*
     * @return bool
     */
    public function usuarioAnonimo(): bool {

        if(empty($_SESSION['sesion'])) {
            return True;
        }
        return False;
    }

    /*
     *@return bool
     */
    public function cerrarSesion() {
        unset($_SESSION['sesion']);
        return True;
    }

    /*
     * @return array
     */
    public function mostrarUsuarios(): array {
    	$consulta = "SELECT Cedula, Nombre_Completo, Foto, Correo, Contraseña, Descripcion, Fecha_Creacion, Fecha_Modificacion, Ced_UsuarioCreador FROM Usuarios";
        $resultado = $this->baseDatos->query($consulta);

        $registros = [];
        while ($fila = $resultado->fetch_object()) {
            $registros[] = $fila;
        }

        return $registros;
    }

    /*
     * @return object|bool
     */
    public function buscarUsuPorID() {

        $consulta = "SELECT Cedula, Nombre_Completo, Foto, Correo, Contraseña, Descripcion, Fecha_Creacion, Fecha_Modificacion, Ced_UsuarioCreador FROM Usuarios WHERE Cedula = " . $this->solicitud['cedula'];
        $resultado = $this->baseDatos->query($consulta);

        if(!$this->baseDatos->query($consulta)) {
            return False;
        }

        return $resultado->fetch_object();
    }

    /*
     * @param string $url
     * @return string
     */
    public function insertarUsu($url): string {

        $contraseña = md5($this->solicitud['contraseña']);
        $consulta = 'INSERT INTO Usuarios (Cedula, Nombre_Completo, Foto, Correo, Contraseña, Descripcion, Fecha_Creacion, Fecha_Modificacion, Ced_UsuarioCreador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stament = $this->baseDatos->prepare($consulta);
        $stament->bind_param('isssssssi', $this->solicitud['cedIns'], $this->solicitud['nombre'], $url, $this->solicitud['correo'], $contraseña, $this->solicitud['descripcion'], $this->solicitud['fechaCre'], $this->solicitud['fechaMod'], $this->solicitud['cedAdmin']);

        $stament->execute();
        $stament->close();

        return $this->baseDatos->affected_rows;
    }

    /*
     * @param string $url
     * @return bool|int
     */
    public function modificarUsu($url) {

        if(!empty($this->solicitud['cedMod']) && !empty($this->solicitud['nombre']) && !empty($this->solicitud['correo']) && !empty($this->solicitud['contraseña']) && !empty($this->solicitud['descripcion']) && !empty($this->solicitud['fechaCre']) && !empty($url) && !empty($this->solicitud['fechaMod']) && !empty($this->solicitud['cedAdmin'])) {

        $contraseña = md5($this->solicitud['contraseña']);
        $consulta = "UPDATE Usuarios SET Nombre_Completo = '{$this->solicitud['nombre']}', Foto = '{$url}', Correo = '{$this->solicitud['correo']}', Contraseña = '{$contraseña}', Descripcion = '{$this->solicitud['descripcion']}', Fecha_Creacion = '{$this->solicitud['fechaCre']}', Fecha_Modificacion = '{$this->solicitud['fechaMod']}', Ced_UsuarioCreador = '{$this->solicitud['cedAdmin']}' WHERE Cedula = {$this->solicitud['cedMod']}";
          $this->baseDatos->query($consulta);

          return $this->baseDatos->affected_rows;
        }
        return False;
    }

    /*
     * @param string $cedula
     * @return bool
     */
    public function eliminarUsu($cedula): bool {
        return $this->baseDatos->query("DELETE FROM Usuarios WHERE Cedula = {$cedula}");
    }


}