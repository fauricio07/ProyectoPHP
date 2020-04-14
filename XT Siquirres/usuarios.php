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
        $this->usuarioAnonimo();
    }

    /*
     * @return bool
     */
    public function iniciarSesion(): bool {
        $contraseña = md5($this->solicitud['contraseña']);
        $consulta = sprintf("SELECT Nombre_Completo FROM Usuarios WHERE Cedula = '%s' AND Contraseña = '%s'", $this->solicitud['cedula'], $contraseña);

        $resultado = $this->baseDatos->query($consulta);
        if(1 == $resultado->num_rows) {
            $cuenta = $resultado->fetch_object();
            $cuenta->Cedula = $this->solicitud['cedula'];
            $_SESSION['sesion'] = $cuenta;

            return TRUE;
        }
        return FALSE;
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
     *
     */
    public function cerrarSesion(): void {
        unset($_SESSION['sesion']);
    }

    /*
     * @return string
     */
    public function verUsuario(): string {
        return $this->cuenta->Nombre_Completo;
    }

}