<?php
include_once 'basedatos.php';
class razas extends basedatos
{
    public $id;
    public $nombre;
    public $id_especie;
    public $consult;

    function __construct($id = null, $nombre = null, $id_especie = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_especie = $id_especie;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getIdEspecie()
    {
        return $this->id_especie;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setIdEspecie($id_especie)
    {
        $this->id_especie = $id_especie;
    }
    public function listar()
    {
        $sql = "SELECT * FROM listarRazas";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("CALL crearRaza ('%s', %s)", $this->nombre, $this->id_especie);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("CALL eliminarRaza (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("CALL actualizarRaza (%s, '%s', %s)", $this->id, $this->nombre, $this->id_especie);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function buscar($consult)
    {
        $this->consult = $consult;
        $sql = sprintf("CALL consultarRazas ('%s')", $this->consult);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function consultar()
    {
        $sql = sprintf("CALL consultarRaza (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        if (!$res || !is_array($res)) {
            $this->id = NULL;
            $this->nombre = NULL;
            $this->id_especie = NULL;
            return false;
        }
        $this->id = $res['id'];
        $this->nombre = $res['nombre'];
        $this->id_especie = $res['id_especie'];
        return true;
    }
}
