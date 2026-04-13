<?php
include_once 'basedatos.php';
class cargos extends basedatos
{
    public $id;
    public $nombre;
    public $consulta;
    public static $defaults = [
        1 => 'Administrador',
        2 => 'Veterinario',
        3 => 'Aprendiz',
        4 => 'Gestor de Inventario',
        5 => 'Encargado de Granja',
        6 => 'Visitante'
    ];

    function __construct($id = null, $nombre = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function listar()
    {
        $sql = "SELECT * FROM listarCargos";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("CALL crearCargo ('%s')", $this->nombre);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("CALL eliminarCargo (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("CALL actualizarCargo (%s, '%s')", $this->id, $this->nombre);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("CALL consultarCargo (%s)", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->nombre = $res['nombre'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = sprintf("CALL consultarCargos ('%s')", $this->consulta);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function seedDefaults()
    {
        $this->conectar();
        foreach (self::$defaults as $id => $nombre) {
            $sql = sprintf("INSERT INTO cargos (id, nombre) VALUES (%d, '%s') ON DUPLICATE KEY UPDATE nombre=VALUES(nombre)", $id, $nombre);
            $this->ejecutarSQL($sql);
        }
        $this->desconectar();
    }
}
?> 
