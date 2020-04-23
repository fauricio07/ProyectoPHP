<?php

/*
 * Class clsUsuarios
 */
class clsUsuarios extends clsConexion
{

    protected function init(): void{}
    
    /* @var  */
    protected $cuenta;

    /* @array */
    public $validaciones = [];

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

        if($this->validarDatos()){

            $contraseña = md5($this->solicitud['contraseña']);
            $consulta = 'INSERT INTO Usuarios (Cedula, Nombre_Completo, Foto, Correo, Contraseña, Descripcion, Fecha_Creacion, Fecha_Modificacion, Ced_UsuarioCreador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stament = $this->baseDatos->prepare($consulta);
            $stament->bind_param('isssssssi', $this->solicitud['cedIns'], $this->solicitud['nombre'], $url, $this->solicitud['correo'], $contraseña, $this->solicitud['descripcion'], $this->solicitud['fechaCre'], $this->solicitud['fechaMod'], $this->solicitud['cedAdmin']);

            $stament->execute();
            $stament->close();
            
            return 1;
        } else {

            return 0;
        }
    }

    /*
     * @param string $url
     * @return bool|int
     */
    public function modificarUsu($url) {

        if($this->validarDatos()) {

        $contraseña = md5($this->solicitud['contraseña']);
        $consulta = "UPDATE Usuarios SET Nombre_Completo = '{$this->solicitud['nombre']}', Foto = '{$url}', Correo = '{$this->solicitud['correo']}', Contraseña = '{$contraseña}', Descripcion = '{$this->solicitud['descripcion']}', Fecha_Creacion = '{$this->solicitud['fechaCre']}', Fecha_Modificacion = '{$this->solicitud['fechaMod']}', Ced_UsuarioCreador = '{$this->solicitud['cedAdmin']}' WHERE Cedula = {$this->solicitud['cedMod']}";
          $this->baseDatos->query($consulta);

          //$this->baseDatos->affected_rows
          return 1;
        }
        return 'False';
    }

    /*
     * @param string $cedula
     * @return bool
     */
    public function eliminarUsu($cedula): bool {
        return $this->baseDatos->query("DELETE FROM Usuarios WHERE Cedula = {$cedula}");
    }

    /*    
     * @return bool
     */
    public function validarDatos(): bool {

        $this->validaciones = $this->solicitud;
        $esValido = True;

        if(isset($this->solicitud['cedIns'])) {

            if(empty($this->solicitud['cedIns']) || !is_numeric((int) $this->solicitud['cedIns']) || strlen($this->solicitud['cedIns']) != 9 || preg_match('/[\s\t]+/' , $this->solicitud['cedIns']) != 0){

                $esValido = False;
                $this->validaciones['cedIns'] = $esValido;
            }
        }
        if(empty($this->solicitud['nombre'])) {

                $esValido = False;
                $this->validaciones['nombre'] = $esValido;
        }
        if(empty($this->solicitud['correo']) || !filter_var($this->solicitud['correo'], FILTER_VALIDATE_EMAIL) || preg_match('/[\s\t]+/' , $this->solicitud['correo']) != 0) {
                
                $esValido = False;
                $this->validaciones['correo'] = $esValido;
        }
        if(empty($this->solicitud['contraseña']) || preg_match('/\s/' , $this->solicitud['contraseña']) != 0) {

                $esValido = False;
                $this->validaciones['contraseña'] = $esValido;
        }
        if(empty(trim($this->solicitud['descripcion']))) {

                $esValido = False;           
                $this->validaciones['descripcion'] = $esValido; 
        }

        return $esValido;
    }

}