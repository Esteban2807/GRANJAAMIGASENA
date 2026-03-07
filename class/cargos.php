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
        $sql = "SELECT * FROM cargos ORDER BY id";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("INSERT INTO cargos (nombre) VALUES ('%s')", $this->nombre);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM cargos WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function actualizar()
    {
        $sql = sprintf("UPDATE cargos SET nombre = '%s' WHERE id = %s", $this->nombre, $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM cargos WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->nombre = $res['nombre'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = "SELECT * FROM cargos WHERE nombre LIKE '%$this->consulta%' OR id LIKE '%$this->consulta%'";
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
