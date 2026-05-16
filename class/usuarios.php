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
            "CALL crearUsuario('%s','%s','%s','%s','%s','%s','%s')",
            $this->tipo_documento,
            $this->documento,
            $this->correo,
            $this->nombres,
            $this->apellidos,
            $this->contrasena,
            $this->id_cargo
        );
        $this->conectar();
        $res = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $res;
    }

    public function listar()
    {
        $sql = "CALL listarUsuarios()";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function consultar()
    {
        $sql = sprintf("CALL consultarUsuario('%s')", $this->documento);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        if (!$res || !is_array($res)) {
            $this->tipo_documento = NULL;
            $this->documento = NULL;
            $this->correo = NULL;
            $this->nombres = NULL;
            $this->apellidos = NULL;
            $this->contrasena = NULL;
            $this->id_cargo = NULL;
            return false;
        }
        $this->tipo_documento = $res['tipo_documento'];
        $this->documento = $res['documento'];
        $this->correo = $res['correo'];
        $this->nombres = $res['nombres'];
        $this->apellidos = $res['apellidos'];
        $this->contrasena = $res['contrasena'];
        $this->id_cargo = $res['id_cargo'];
        return true;
    }

    public function eliminar()
    {
        $sql = sprintf("CALL eliminarUsuario('%s')", $this->documento);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function actualizar()
    {
        $sql = sprintf(
            "CALL actualizarUsuario('%s','%s','%s','%s','%s','%s','%s')",
            $this->documento,
            $this->tipo_documento,
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

    public function buscar($valor)
    {
        $sql = sprintf("CALL buscarUsuario('%s')", $valor);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public static function verificarSesion()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }
    }

    public static function estaAutenticado()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return isset($_SESSION['user']);
    }

    public static function usuarioActual()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }
}

