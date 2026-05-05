<?php

include_once 'basedatos.php';

class especies extends basedatos
{
    public $id;
    public $nombre;
    public $consulta;

    function __construct($id = null, $nombre = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    //Metodos
    //GET
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    //SET
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function listar()
    {
        $sql = "SELECT * FROM listarEspecies";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("CALL crearEspecie ('%s')", $this->nombre);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("CALL eliminarEspecie (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("CALL actualizarEspecie (%s, '%s')", $this->id, $this->nombre);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("CALL consultarEspecie (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        if (!$res || !is_array($res)) {
            $this->id = NULL;
            $this->nombre = NULL;
            return false;
        }
        $this->id = $res['id'];
        $this->nombre = $res['nombre'];
        return true;
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = sprintf("CALL consultarEspecies ('%s')", $this->consulta);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}