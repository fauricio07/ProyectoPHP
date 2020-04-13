<?php

/*
 * Class clsArticulos
 */
class clsArticulos extends clsConexion
{
 

    protected function init(): void{}

    /*
     * @return string
     */
    public function insertarArt($url): string {
        $consulta = 'INSERT INTO Articulos (Descripcion, Marca, Precio, Categoria, Existencias, Foto, Fecha_Modificacion, Ced_UsuarioModificador) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $stament = $this->baseDatos->prepare($consulta);
        $stament->bind_param('ssisissi', $this->solicitud['descripcion'], $this->solicitud['marca'], $this->solicitud['precio'], $this->solicitud['categoria'], $this->solicitud['existencias'], $url, $this->solicitud['fechaMod'], $this->solicitud['cedAdmin']);

        $stament->execute();
        $stament->close();

        return $this->baseDatos->insert_id;
    }

    /*
     * @return bool|int
     */
    public function modificarArt($url) {
        
        if(!empty($this->solicitud['descripcion']) && !empty($this->solicitud['marca']) && !empty($this->solicitud['precio']) && !empty($this->solicitud['categoria']) && !empty($this->solicitud['existencias']) && !empty($url) && !empty($this->solicitud['fechaMod']) && !empty($this->solicitud['cedAdmin'])) {
          $consulta = "UPDATE Articulos SET Descripcion = '{$this->solicitud['descripcion']}', Marca = '{$this->solicitud['marca']}', Precio = '{$this->solicitud['precio']}', Categoria = '{$this->solicitud['categoria']}', Existencias = '{$this->solicitud['existencias']}', Foto = '{$url}', Fecha_Modificacion = '{$this->solicitud['fechaMod']}', Ced_UsuarioModificador = '{$this->solicitud['cedAdmin']}' WHERE Codigo = {$this->solicitud['codigo']}";
          $this->baseDatos->query($consulta);

          return $this->baseDatos->affected_rows;
        }
        return FALSE;
    }

    /*
     * @param string $codigo
     * @return bool
     */
    public function eliminarArt($codigo): bool {
        return $this->baseDatos->query("DELETE FROM Articulos WHERE Codigo={$codigo}");
    }

    /*
     * @return array
     */
    public function mostrarArtcls(): array {
        $consulta = "SELECT Codigo, Descripcion, Marca, Precio, Categoria, Existencias, Foto, Fecha_Modificacion, Ced_UsuarioModificador FROM Articulos";
        $resultado = $this->baseDatos->query($consulta);

        $registros = [];
        while ($fila = $resultado->fetch_object()) {
            $registros[] = $fila;
        }

        return $registros;
    }

    /*
     * @return object
     */
    public function buscarArtPorCod(): object {
        $consulta = "SELECT Codigo, Descripcion, Marca, Precio, Categoria, Existencias, Foto, Fecha_Modificacion, Ced_UsuarioModificador FROM Articulos WHERE Codigo = " . $this->solicitud['codigo'];
        $resultado = $this->baseDatos->query($consulta);

        return $resultado->fetch_object();
    }

    /*
     *
     */
    public function __destruct() {
        $this->baseDatos->close();
    }
    
}

?>