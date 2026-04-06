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
        $sql = "SELECT r.id,r.nombre, e.nombre AS especie FROM razas AS r INNER JOIN especies AS e ON r.id_especie = e.id;";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("INSERT INTO razas (nombre,id_especie) VALUES ('%s','%s');", $this->nombre, $this->id_especie);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM razas WHERE id = '%s';", $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function actualizar()
    {
        $sql = sprintf("UPDATE razas SET nombre = '%s', id_especie = '%s' WHERE id = '%s';", $this->nombre, $this->id_especie, $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function buscar($consult)
    {
        $this->consult = $consult;
        $c = $consult;
        $sql = "SELECT r.id, r.nombre, e.nombre AS especie FROM razas AS r INNER JOIN especies AS e ON r.id_especie = e.id WHERE r.nombre LIKE '%$c%' OR e.nombre LIKE '%$c%' ORDER BY r.id";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function consultar()
    {
        $sql = sprintf("SELECT r.id, r.nombre, r.id_especie, e.nombre AS especie FROM razas AS r INNER JOIN especies AS e ON r.id_especie = e.id WHERE r.id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        if ($res) {
            $this->nombre     = $res['nombre'];
            $this->id_especie = $res['id_especie'];
        }
    }
}