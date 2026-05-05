<?php
include_once("basedatos.php");
class Tipos_documento extends basedatos
{
    public $id;
    public $nombre;
    public $siglas;
    public $estado;

    function __construct($id = NULL, $nombre = NULL, $siglas = NULL, $estado = NULL)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->siglas = $siglas;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getSiglas()
    {
        return $this->siglas;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setSiglas($siglas)
    {
        $this->siglas = $siglas;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function insertar()
    {
        $sql = sprintf("CALL crearTipoDocumento ('%s', '%s', '%s')", $this->nombre, $this->siglas, $this->estado);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM listarTiposDocumento";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function consultar()
    {
        $sql = sprintf("CALL listarTipoDocumento (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->nombre = $res['nombre'];
        $this->siglas = $res['siglas'];
        $this->estado = $res['estado'];
    }

    public function eliminar()
    {
        $sql = sprintf("CALL eliminarTipoDocumento (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function actualizar()
    {
        $sql = sprintf("CALL actualizarTipoDocumento (%s, '%s', '%s', '%s')", $this->id, $this->nombre, $this->siglas, $this->estado);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function buscar($valor)
    {
        $sql = sprintf("CALL consultarTiposDocumento ('%s')", $valor);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?>