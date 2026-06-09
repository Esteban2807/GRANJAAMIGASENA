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

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setFacilidad($facilidad)
    {
        $this->facilidad = $facilidad;
    }
    public function setMadreId($madre_id)
    {
        $this->madre_id = $madre_id;
    }
    public function setSecuencia($secuencia)
    {
        $this->secuencia = $secuencia;
    }
    public function setDocumentoUsuario($documento_usuario)
    {
        $this->documento_usuario = $documento_usuario;
    }
    public function setDocumentoVeterinario($documento_veterinario)
    {
        $this->documento_veterinario = $documento_veterinario;
    }
    public function setDuracionMinutos($duracion_minutos)
    {
        $this->duracion_minutos = $duracion_minutos;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getFacilidad()
    {
        return $this->facilidad;
    }
    public function getMadreId()
    {
        return $this->madre_id;
    }
    public function getSecuencia()
    {
        return $this->secuencia;
    }
    public function getDocumentoUsuario()
    {
        return $this->documento_usuario;
    }
    public function getDocumentoVeterinario()
    {
        return $this->documento_veterinario;
    }
    public function getDuracionMinutos()
    {
        return $this->duracion_minutos;
    }

    public function listar()
    {
        $sql = "SELECT * FROM listarPartos";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("CALL crearParto ('%s', '%s', %s, %s, '%s', '%s', %s)",
            $this->fecha,
            $this->facilidad,
            $this->madre_id,
            $this->secuencia,
            $this->documento_usuario,
            $this->documento_veterinario,
            $this->duracion_minutos
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("CALL eliminarParto (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("CALL actualizarParto (%s, '%s', '%s', %s, %s, '%s', '%s', %s)",
            $this->id,
            $this->fecha,
            $this->facilidad,
            $this->madre_id,
            $this->secuencia,
            $this->documento_usuario,
            $this->documento_veterinario,
            $this->duracion_minutos
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("CALL consultarParto (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        if (!$res || !is_array($res)) {
            $this->id = NULL;
            $this->fecha = NULL;
            $this->facilidad = NULL;
            $this->madre_id = NULL;
            $this->secuencia = NULL;
            $this->documento_usuario = NULL;
            $this->documento_veterinario = NULL;
            $this->duracion_minutos = NULL;
            return false;
        }
        $this->id = $res['id'];
        $this->fecha = $res['fecha'];
        $this->facilidad = $res['facilidad'];
        $this->madre_id = $res['madre_id'];
        $this->secuencia = $res['secuencia'];
        $this->documento_usuario = $res['documento_usuario'];
        $this->documento_veterinario = $res['documento_veterinario'];
        $this->duracion_minutos = $res['duracion_minutos'];
        return true;
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = sprintf("CALL consultarPartos ('%s')", $this->consulta);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?>