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
    public function insertarArt(): string {
        $consulta = 'INSERT INTO Articulos (Descripcion, Marca, Precio, Categoria, Existencias, Foto, Fecha_Modificacion, Ced_UsuarioModificador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stament = $this->baseDatos->prepare($consulta);
        $stament->bind_param('ssisissi', $this->solicitud['descripcion'], $this->solicitud['marca'], $this->solicitud['precio'], $this->solicitud['categoria'], $this->solicitud['existencias'], $this->solicitud['foto'], $this->solicitud['fechaMod'], $this->solicitud['cedUsuMod']);

        $stament->execute();
        $stament->close();

        return $this->baseDatos->insert_id;
    }

    /*
     * @return bool|int
     */
    public function modificarArt() {
        
        if(!empty($this->solicitud['descripcion']) && !isempty($this->solicitud['marca']) && !isempty($this->solicitud['precio']) && !isempty($this->solicitud['categoria']) && !isempty($this->solicitud['existencias']) && !isempty($this->solicitud['foto']) && !isempty($this->solicitud['fechaMod']) && !isempty($this->solicitud['cedUsuMod'])) {
          $consulta = "UPDATE Articulos SET Descripcion = '{$this->solicitud['descripcion']}', Marca = '{$this->solicitud['marca']}', Precio = '{$this->solicitud['precio']}', Categoria = '{$this->solicitud['categoria']}', Existencias = '{$this->solicitud['existencias']}', Foto = '{$this->solicitud['foto']}', Fecha_Modificacion = '{$this->solicitud['fechaMod']}', Ced_UsuarioModificador = '{$this->solicitud['cedUsuMod']}' WHERE Codigo = {$this->solicitud['cedUsuMod']}";
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