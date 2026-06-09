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

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setPartoId($parto_id)
    {
        $this->parto_id = $parto_id;
    }
    public function setDocumentoUsuario($documento_usuario)
    {
        $this->documento_usuario = $documento_usuario;
    }
    public function setPesoKg($peso_kg)
    {
        $this->peso_kg = $peso_kg;
    }
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }
    public function setVigor($vigor)
    {
        $this->vigor = $vigor;
    }
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getPartoId()
    {
        return $this->parto_id;
    }
    public function getDocumentoUsuario()
    {
        return $this->documento_usuario;
    }
    public function getPesoKg()
    {
        return $this->peso_kg;
    }
    public function getSexo()
    {
        return $this->sexo;
    }
    public function getVigor()
    {
        return $this->vigor;
    }
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function listar()
    {
        $sql = "SELECT * FROM listarNacimientos";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("CALL crearNacimiento ('%s', %s, '%s', %s, '%s', '%s', '%s')",
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
        $sql = sprintf("CALL eliminarNacimiento (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("CALL actualizarNacimiento (%s, '%s', %s, '%s', %s, '%s', '%s', '%s')",
            $this->id,
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
    public function consultar()
    {
        $sql = sprintf("CALL consultarNacimiento (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        if (!$res || !is_array($res)) {
            $this->id = NULL;
            $this->fecha = NULL;
            $this->parto_id = NULL;
            $this->documento_usuario = NULL;
            $this->peso_kg = NULL;
            $this->sexo = NULL;
            $this->vigor = NULL;
            $this->observaciones = NULL;
            return false;
        }
        $this->id = $res['id'];
        $this->fecha = $res['fecha'];
        $this->parto_id = $res['parto_id'];
        $this->documento_usuario = $res['documento_usuario'];
        $this->peso_kg = $res['peso_kg'];
        $this->sexo = $res['sexo'];
        $this->vigor = $res['vigor'];
        $this->observaciones = $res['observaciones'];
        return true;
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = sprintf("CALL consultarNacimientos ('%s')", $this->consulta);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?>