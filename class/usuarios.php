<?php
include_once("basedatos.php");
class usuarios extends basedatos
{
    public $tipo_documento;
    public $documento;
    public $correo;
    public $nombres;
    public $apellidos;
    public $contrasena;
    public $id_cargo;

    function __construct($tipo_documento = NULL, $documento = NULL, $correo = NULL, $nombres = NULL, $apellidos = NULL, $contrasena = NULL, $id_cargo = NULL)
    {
        $this->tipo_documento = $tipo_documento;
        $this->documento = $documento;
        $this->correo = $correo;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->contrasena = $contrasena;
        $this->id_cargo = $id_cargo;
    }
    public function getTipoDocumento()
    {
        return $this->tipo_documento;
    }
    public function getDocumento()
    {
        return $this->documento;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function getIdCargo()
    {
        return $this->id_cargo;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    public function setTipoDocumento($tipo_documento)
    {
        $this->tipo_documento = $tipo_documento;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    public function setIdCargo($id_cargo)
    {
        $this->id_cargo = $id_cargo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO usuarios (tipo_documento, documento, correo, nombres, apellidos, contrasena, id_cargo) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $this->tipo_documento,
            $this->documento,
            $this->correo,
            $this->nombres,
            $this->apellidos,
            $this->contrasena,
            $this->id_cargo
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM usuarios";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function consultar()
    {
        $sql = sprintf("SELECT * FROM usuarios WHERE documento = '%s'", $this->documento);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->tipo_documento = $res['tipo_documento'];
        $this->documento = $res['documento'];
        $this->correo = $res['correo'];
        $this->nombres = $res['nombres'];
        $this->apellidos = $res['apellidos'];
        $this->contrasena = $res['contrasena'];
        $this->id_cargo = $res['id_cargo'];
    }

    public function eliminar()
    {
        $sql = sprintf("DELETE FROM usuarios WHERE documento = '%s'", $this->documento);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE usuarios SET tipo_documento = '%s', correo = '%s', nombres = '%s', apellidos = '%s', contrasena = '%s', id_cargo = '%s' WHERE documento = '%s'",
            $this->tipo_documento,
            $this->correo,
            $this->nombres,
            $this->apellidos,
            $this->contrasena,
            $this->id_cargo,
            $this->documento
        );  
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function buscar($valor)
    {
        $sql = sprintf("SELECT * FROM usuarios WHERE nombres LIKE '%%%s%%'", $valor);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    
}

