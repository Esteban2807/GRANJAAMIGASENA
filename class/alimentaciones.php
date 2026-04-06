<?php
include_once 'basedatos.php';
class alimentaciones extends basedatos
{
    public $id;
    public $id_animal;
    public $documento_alimentador;
    public $id_alimento;
    public $cantidad_dada;
    public $fecha_hora;
    public $consulta;

    function __construct($id = null, $id_animal = null, $documento_alimentador = null, $id_alimento = null, $cantidad_dada = null, $fecha_hora = null)
    {
        $this->id = $id;
        $this->id_animal = $id_animal;
        $this->documento_alimentador = $documento_alimentador;
        $this->id_alimento = $id_alimento;
        $this->cantidad_dada = $cantidad_dada;
        $this->fecha_hora = $fecha_hora;
    }

    public function setId($id) { $this->id = $id; }
    public function setIdAnimal($id_animal) { $this->id_animal = $id_animal; }
    public function setDocumentoAlimentador($documento_alimentador) { $this->documento_alimentador = $documento_alimentador; }
    public function setIdAlimento($id_alimento) { $this->id_alimento = $id_alimento; }
    public function setCantidadDada($cantidad_dada) { $this->cantidad_dada = $cantidad_dada; }
    public function setFechaHora($fecha_hora) { $this->fecha_hora = $fecha_hora; }

    public function getId() { return $this->id; }
    public function getIdAnimal() { return $this->id_animal; }
    public function getDocumentoAlimentador() { return $this->documento_alimentador; }
    public function getIdAlimento() { return $this->id_alimento; }
    public function getCantidadDada() { return $this->cantidad_dada; }
    public function getFechaHora() { return $this->fecha_hora; }

    public function listar()
    {
        $sql = "SELECT * FROM alimentaciones ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO alimentaciones (id_animal,documento_alimentador,id_alimento,cantidad_dada,fecha_hora) VALUES ('%s','%s','%s','%s','%s')",
            $this->id_animal,
            $this->documento_alimentador,
            $this->id_alimento,
            $this->cantidad_dada,
            $this->fecha_hora
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM alimentaciones WHERE id = %s", $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE alimentaciones SET id_animal='%s', documento_alimentador='%s', id_alimento='%s', cantidad_dada='%s', fecha_hora='%s' WHERE id=%s",
            $this->id_animal,
            $this->documento_alimentador,
            $this->id_alimento,
            $this->cantidad_dada,
            $this->fecha_hora,
            $this->id
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM alimentaciones WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->id_animal = $res['id_animal'];
        $this->documento_alimentador = $res['documento_alimentador'];
        $this->id_alimento = $res['id_alimento'];
        $this->cantidad_dada = $res['cantidad_dada'];
        $this->fecha_hora = $res['fecha_hora'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $c = $consulta;
        $sql = "SELECT * FROM alimentaciones WHERE id_animal LIKE '%$c%' OR documento_alimentador LIKE '%$c%' ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?> 
