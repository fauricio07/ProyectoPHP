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
        $this->isAnonymous();
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
            $_SESSION['cuenta'] = $cuenta;

            return TRUE;
        }
        return FALSE;
    }

    /*
     * @return bool
     */
    public function sesionInciada(): bool {
        
        if(!is_null($this->cuenta)) {
            return FALSE;
        }

        if(!empty($_SESSION['cuenta'])) {
            $this->cuenta = $_SESSION['cuenta'];
            return FALSE;
        }
        return TRUE;
    }

    /*
     *
     */
    public function cerrarSesion(): void {
        unset($_SESSION['cuenta']);
    }

    /*
     * @return string
     */
    public function verCredenciales(): string {
        return $this->cuenta->Nombre_Completo;
    }

}