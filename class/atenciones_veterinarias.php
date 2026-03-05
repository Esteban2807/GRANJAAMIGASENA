<?php
include_once 'basedatos.php';
class atenciones_veterinarias extends basedatos
{
    public $id;
    public $id_animal;
    public $documento_veterinario;
    public $fecha_atencion;
    public $motivo;
    public $diagnostico;
    public $tratamiento;
    public $medicamento_id;
    public $dosis;
    public $via_administracion;
    public $observaciones;
    public $costo_total;
    public $consulta;

    function __construct($id = null, $id_animal = null, $documento_veterinario = null, $fecha_atencion = null, $motivo = null, $diagnostico = null, $tratamiento = null, $medicamento_id = null, $dosis = null, $via_administracion = null, $observaciones = null, $costo_total = null)
    {
        $this->id = $id;
        $this->id_animal = $id_animal;
        $this->documento_veterinario = $documento_veterinario;
        $this->fecha_atencion = $fecha_atencion;
        $this->motivo = $motivo;
        $this->diagnostico = $diagnostico;
        $this->tratamiento = $tratamiento;
        $this->medicamento_id = $medicamento_id;
        $this->dosis = $dosis;
        $this->via_administracion = $via_administracion;
        $this->observaciones = $observaciones;
        $this->costo_total = $costo_total;
    }

    public function setId($id) { $this->id = $id; }
    public function setIdAnimal($id_animal) { $this->id_animal = $id_animal; }
    public function setDocumentoVeterinario($documento_veterinario) { $this->documento_veterinario = $documento_veterinario; }
    public function setFechaAtencion($fecha_atencion) { $this->fecha_atencion = $fecha_atencion; }
    public function setMotivo($motivo) { $this->motivo = $motivo; }
    public function setDiagnostico($diagnostico) { $this->diagnostico = $diagnostico; }
    public function setTratamiento($tratamiento) { $this->tratamiento = $tratamiento; }
    public function setMedicamentoId($medicamento_id) { $this->medicamento_id = $medicamento_id; }
    public function setDosis($dosis) { $this->dosis = $dosis; }
    public function setViaAdministracion($via_administracion) { $this->via_administracion = $via_administracion; }
    public function setObservaciones($observaciones) { $this->observaciones = $observaciones; }
    public function setCostoTotal($costo_total) { $this->costo_total = $costo_total; }

    public function getId() { return $this->id; }
    public function getIdAnimal() { return $this->id_animal; }
    public function getDocumentoVeterinario() { return $this->documento_veterinario; }
    public function getFechaAtencion() { return $this->fecha_atencion; }
    public function getMotivo() { return $this->motivo; }
    public function getDiagnostico() { return $this->diagnostico; }
    public function getTratamiento() { return $this->tratamiento; }
    public function getMedicamentoId() { return $this->medicamento_id; }
    public function getDosis() { return $this->dosis; }
    public function getViaAdministracion() { return $this->via_administracion; }
    public function getObservaciones() { return $this->observaciones; }
    public function getCostoTotal() { return $this->costo_total; }

    public function listar()
    {
        $sql = "SELECT * FROM atenciones_veterinarias ORDER BY id DESC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO atenciones_veterinarias (id_animal,documento_veterinario,fecha_atencion,motivo,diagnostico,tratamiento,medicamento_id,dosis,via_administracion,observaciones,costo_total) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            $this->id_animal,
            $this->documento_veterinario,
            $this->fecha_atencion,
            $this->motivo,
            $this->diagnostico,
            $this->tratamiento,
            $this->medicamento_id,
            $this->dosis,
            $this->via_administracion,
            $this->observaciones,
            $this->costo_total
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM atenciones_veterinarias WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE atenciones_veterinarias SET id_animal='%s', documento_veterinario='%s', fecha_atencion='%s', motivo='%s', diagnostico='%s', tratamiento='%s', medicamento_id='%s', dosis='%s', via_administracion='%s', observaciones='%s', costo_total='%s' WHERE id=%s",
            $this->id_animal,
            $this->documento_veterinario,
            $this->fecha_atencion,
            $this->motivo,
            $this->diagnostico,
            $this->tratamiento,
            $this->medicamento_id,
            $this->dosis,
            $this->via_administracion,
            $this->observaciones,
            $this->costo_total,
            $this->id
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM atenciones_veterinarias WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->id_animal = $res['id_animal'];
        $this->documento_veterinario = $res['documento_veterinario'];
        $this->fecha_atencion = $res['fecha_atencion'];
        $this->motivo = $res['motivo'];
        $this->diagnostico = $res['diagnostico'];
        $this->tratamiento = $res['tratamiento'];
        $this->medicamento_id = $res['medicamento_id'];
        $this->dosis = $res['dosis'];
        $this->via_administracion = $res['via_administracion'];
        $this->observaciones = $res['observaciones'];
        $this->costo_total = $res['costo_total'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = "SELECT * FROM atenciones_veterinarias WHERE motivo LIKE '%$this->consulta%' OR id_animal LIKE '%$this->consulta%'";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?> 
