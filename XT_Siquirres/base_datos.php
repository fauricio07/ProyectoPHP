<?php

/*
 * Class clsConexion
 */
abstract class clsConexion 
{

    /* @var mysqli */
    protected $baseDatos;

    /* @var vector */
    protected $solicitud;

    /*
     * clsConexion constructor.
     * @param vector $solicitud
     */
    public function __construct($solicitud = []) {
        $this->baseDatos = new mysqli('database', 'lamp', 'lamp', 'lamp');
        $this->solicitud = $solicitud;
        $this->init();
    }

    abstract protected function init(): void;
}

?>
