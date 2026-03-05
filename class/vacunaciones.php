<?php
include_once 'basedatos.php';
class vacunaciones extends basedatos
{
    public $id;
    public $id_animal;
    public $documento_veterinario;
    public $id_vacuna;
    public $cantidad_dada;
    public $fecha_hora;
    public $consulta;

    function __construct($id = null, $id_animal = null, $documento_veterinario = null, $id_vacuna = null, $cantidad_dada = null, $fecha_hora = null)
    {
        $this->id = $id;
        $this->id_animal = $id_animal;
        $this->documento_veterinario = $documento_veterinario;
        $this->id_vacuna = $id_vacuna;
        $this->cantidad_dada = $cantidad_dada;
        $this->fecha_hora = $fecha_hora;
    }

    public function setId($id) { $this->id = $id; }
    public function setIdAnimal($id_animal) { $this->id_animal = $id_animal; }
    public function setDocumentoVeterinario($documento_veterinario) { $this->documento_veterinario = $documento_veterinario; }
    public function setIdVacuna($id_vacuna) { $this->id_vacuna = $id_vacuna; }
    public function setCantidadDada($cantidad_dada) { $this->cantidad_dada = $cantidad_dada; }
    public function setFechaHora($fecha_hora) { $this->fecha_hora = $fecha_hora; }

    public function getId() { return $this->id; }
    public function getIdAnimal() { return $this->id_animal; }
    public function getDocumentoVeterinario() { return $this->documento_veterinario; }
    public function getIdVacuna() { return $this->id_vacuna; }
    public function getCantidadDada() { return $this->cantidad_dada; }
    public function getFechaHora() { return $this->fecha_hora; }

    public function listar()
    {
        $sql = "SELECT * FROM vacunaciones ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO vacunaciones (id_animal,documento_veterinario,id_vacuna,cantidad_dada,fecha_hora) VALUES ('%s','%s','%s','%s','%s')",
            $this->id_animal,
            $this->documento_veterinario,
            $this->id_vacuna,
            $this->cantidad_dada,
            $this->fecha_hora
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM vacunaciones WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE vacunaciones SET id_animal='%s', documento_veterinario='%s', id_vacuna='%s', cantidad_dada='%s', fecha_hora='%s' WHERE id=%s",
            $this->id_animal,
            $this->documento_veterinario,
            $this->id_vacuna,
            $this->cantidad_dada,
            $this->fecha_hora,
            $this->id
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM vacunaciones WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->id_animal = $res['id_animal'];
        $this->documento_veterinario = $res['documento_veterinario'];
        $this->id_vacuna = $res['id_vacuna'];
        $this->cantidad_dada = $res['cantidad_dada'];
        $this->fecha_hora = $res['fecha_hora'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = "SELECT * FROM vacunaciones WHERE id_animal LIKE '%$this->consulta%' OR documento_veterinario LIKE '%$this->consulta%'";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?> 
