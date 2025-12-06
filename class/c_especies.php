<?php

include_once 'database.php';

class especies extends basedatos {
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
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    //SET
    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
     public function listar()
    {
        $sql = "SELECT * FROM especies ORDER BY id";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("INSERT INTO especies (nombre) VALUES ('%s')", $this->nombre);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM especies WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("UPDATE especies SET nombre = '%s'   WHERE id = %s",  $this->nombre, $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
        echo $sql;
    }
     public function consultar()
    {
        $sql = "SELECT * FROM especies WHERE nombre like '%$this->consulta%' OR id like '%$this->consulta%'";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}