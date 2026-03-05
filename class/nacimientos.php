<?php
include_once 'basedatos.php';
class nacimientos extends basedatos
{
    public $id;
    public $fecha;
    public $parto_id;
    public $documento_usuario;
    public $peso_kg;
    public $sexo;
    public $vigor;
    public $observaciones;
    public $consulta;

    function __construct($id = null, $fecha = null, $parto_id = null, $documento_usuario = null, $peso_kg = null, $sexo = null, $vigor = null, $observaciones = null)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->parto_id = $parto_id;
        $this->documento_usuario = $documento_usuario;
        $this->peso_kg = $peso_kg;
        $this->sexo = $sexo;
        $this->vigor = $vigor;
        $this->observaciones = $observaciones;
    }

    public function setId($id) { $this->id = $id; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setPartoId($parto_id) { $this->parto_id = $parto_id; }
    public function setDocumentoUsuario($documento_usuario) { $this->documento_usuario = $documento_usuario; }
    public function setPesoKg($peso_kg) { $this->peso_kg = $peso_kg; }
    public function setSexo($sexo) { $this->sexo = $sexo; }
    public function setVigor($vigor) { $this->vigor = $vigor; }
    public function setObservaciones($observaciones) { $this->observaciones = $observaciones; }

    public function getId() { return $this->id; }
    public function getFecha() { return $this->fecha; }
    public function getPartoId() { return $this->parto_id; }
    public function getDocumentoUsuario() { return $this->documento_usuario; }
    public function getPesoKg() { return $this->peso_kg; }
    public function getSexo() { return $this->sexo; }
    public function getVigor() { return $this->vigor; }
    public function getObservaciones() { return $this->observaciones; }

    public function listar()
    {
        $sql = "SELECT * FROM nacimientos ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO nacimientos (fecha,parto_id,documento_usuario,peso_kg,sexo,vigor,observaciones) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
            $this->fecha,
            $this->parto_id,
            $this->documento_usuario,
            $this->peso_kg,
            $this->sexo,
            $this->vigor,
            $this->observaciones
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM nacimientos WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE nacimientos SET fecha='%s', parto_id='%s', documento_usuario='%s', peso_kg='%s', sexo='%s', vigor='%s', observaciones='%s' WHERE id=%s",
            $this->fecha,
            $this->parto_id,
            $this->documento_usuario,
            $this->peso_kg,
            $this->sexo,
            $this->vigor,
            $this->observaciones,
            $this->id
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM nacimientos WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->fecha = $res['fecha'];
        $this->parto_id = $res['parto_id'];
        $this->documento_usuario = $res['documento_usuario'];
        $this->peso_kg = $res['peso_kg'];
        $this->sexo = $res['sexo'];
        $this->vigor = $res['vigor'];
        $this->observaciones = $res['observaciones'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = "SELECT * FROM nacimientos WHERE sexo LIKE '%$this->consulta%' OR vigor LIKE '%$this->consulta%'";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?> 
