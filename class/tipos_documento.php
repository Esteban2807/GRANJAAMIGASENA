<?php
include_once("basedatos.php");
class Tipos_documento extends basedatos{
    public $id;
    public $nombre;
    public $siglas;
    public $estado;

    function __construct($id = NULL, $nombre = NULL, $siglas = NULL, $estado = NULL){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->siglas = $siglas;
        $this->estado = $estado;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getSiglas(){
        return $this->siglas;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setSiglas($siglas){
        $this->siglas = $siglas;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function insertar(){
        $sql = sprintf("INSERT INTO tipos_documento (nombre, siglas, estado) VALUES ('%s', '%s', '%s')", $this->nombre, $this->siglas, $this->estado);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }

    public function listar(){
        $sql = "SELECT * FROM tipos_documento";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function consultar(){
        $sql = sprintf("SELECT * FROM tipos_documento WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->nombre = $res['nombre'];
        $this->siglas = $res['siglas'];
        $this->estado = $res['estado'];
    }

    public function eliminar(){
        $sql = sprintf("DELETE FROM tipos_documento WHERE id = %s", $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }

    public function actualizar(){
        $sql = sprintf("UPDATE tipos_documento SET nombre = '%s', siglas = '%s', estado = '%s' WHERE id = %s", $this->nombre, $this->siglas, $this->estado, $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }

    public function buscar($valor){
        $sql = sprintf("SELECT * FROM tipos_documento WHERE nombre LIKE '%%%s%%'", $valor);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?>