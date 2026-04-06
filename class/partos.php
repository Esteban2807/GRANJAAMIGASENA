<?php
include_once 'basedatos.php';
class partos extends basedatos
{
    public $id;
    public $fecha;
    public $facilidad;
    public $madre_id;
    public $secuencia;
    public $documento_usuario;
    public $documento_veterinario;
    public $duracion_minutos;
    public $consulta;

    function __construct($id = null, $fecha = null, $facilidad = null, $madre_id = null, $secuencia = null, $documento_usuario = null, $documento_veterinario = null, $duracion_minutos = null)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->facilidad = $facilidad;
        $this->madre_id = $madre_id;
        $this->secuencia = $secuencia;
        $this->documento_usuario = $documento_usuario;
        $this->documento_veterinario = $documento_veterinario;
        $this->duracion_minutos = $duracion_minutos;
    }

    public function setId($id) { $this->id = $id; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setFacilidad($facilidad) { $this->facilidad = $facilidad; }
    public function setMadreId($madre_id) { $this->madre_id = $madre_id; }
    public function setSecuencia($secuencia) { $this->secuencia = $secuencia; }
    public function setDocumentoUsuario($documento_usuario) { $this->documento_usuario = $documento_usuario; }
    public function setDocumentoVeterinario($documento_veterinario) { $this->documento_veterinario = $documento_veterinario; }
    public function setDuracionMinutos($duracion_minutos) { $this->duracion_minutos = $duracion_minutos; }

    public function getId() { return $this->id; }
    public function getFecha() { return $this->fecha; }
    public function getFacilidad() { return $this->facilidad; }
    public function getMadreId() { return $this->madre_id; }
    public function getSecuencia() { return $this->secuencia; }
    public function getDocumentoUsuario() { return $this->documento_usuario; }
    public function getDocumentoVeterinario() { return $this->documento_veterinario; }
    public function getDuracionMinutos() { return $this->duracion_minutos; }

    public function listar()
    {
        $sql = "SELECT * FROM partos ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO partos (fecha,facilidad,madre_id,secuencia,documento_usuario,documento_veterinario,duracion_minutos) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
            $this->fecha,
            $this->facilidad,
            $this->madre_id,
            $this->secuencia,
            $this->documento_usuario,
            $this->documento_veterinario,
            $this->duracion_minutos
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM partos WHERE id = %s", $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE partos SET fecha='%s', facilidad='%s', madre_id='%s', secuencia='%s', documento_usuario='%s', documento_veterinario='%s', duracion_minutos='%s' WHERE id=%s",
            $this->fecha,
            $this->facilidad,
            $this->madre_id,
            $this->secuencia,
            $this->documento_usuario,
            $this->documento_veterinario,
            $this->duracion_minutos,
            $this->id
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM partos WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->fecha = $res['fecha'];
        $this->facilidad = $res['facilidad'];
        $this->madre_id = $res['madre_id'];
        $this->secuencia = $res['secuencia'];
        $this->documento_usuario = $res['documento_usuario'];
        $this->documento_veterinario = $res['documento_veterinario'];
        $this->duracion_minutos = $res['duracion_minutos'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $c = $consulta;
        $sql = "SELECT * FROM partos WHERE madre_id LIKE '%$c%' OR documento_veterinario LIKE '%$c%' OR fecha LIKE '%$c%' ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?> 
