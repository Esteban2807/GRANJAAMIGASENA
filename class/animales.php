<?php
include_once 'database.php';
class animales extends basedatos
{
    //Propiedades y atributos
    public $fecha_nacimiento;
    public $nombre;
    public $id;
    public $id_especie;
    public $id_raza;
    public $id_padre;
    public $id_madre;
    public $observaciones;


    public $consulta;

    //Constructor
    function __construct($fecha_nacimiento = null, $nombre = null, $id = null, $id_especie = null, $id_raza = null, $id_padre = null, $id_madre = null, $observaciones = null)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_especie = $id_especie;
        $this->id_raza = $id_raza;
        $this->id_padre = $id_padre;
        $this->id_madre = $id_madre;
        $this->observaciones = $observaciones;
    }

    //Metodos
    //GET
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getIdEspecie()
    {
        return $this->id_especie;
    }
    public function getIdRaza()
    {
        return $this->id_raza;
    }
    public function getIdPadre()
    {
        return $this->id_padre;
    }
    public function getIdMadre()
    {
        return $this->id_madre;
    }
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    //SET
    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setIdEspecie($id_especie)
    {
        $this->id_especie = $id_especie;
    }
    public function setIdRaza($id_raza)
    {
        $this->id_raza = $id_raza;
    }
    public function setIdPadre($id_padre)
    {
        $this->id_padre = $id_padre;
    }
    public function setIdMadre($id_madre)
    {
        $this->id_madre = $id_madre;
    }
    
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    //Metodos especificos
    public function listar()
    {
        $sql = "SELECT 
    a.fecha_de_nacimiento,
    a.nombre,
    a.id,
    e.nombre AS especie,
    r.nombre AS raza,
    a.id_padre,
    a.id_madre,
    a.observaciones
FROM animales AS a
INNER JOIN especies AS e ON a.id_especie = e.id
INNER JOIN razas AS r ON a.id_raza = r.id
ORDER BY a.nombre ASC;
";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("INSERT INTO animales (fecha_nacimiento,nombre,id,id_especie,id_raza,id_padre,id_madre,observaciones) VALUES ('%s', '%s', '%s','%s', '%s', '%s','%s', '%s',)", $this->fecha_nacimiento, $this->nombre, $this->id,$this->id_especie,$this->id_raza,$this->id_padre,$this->id_madre,$this->observaciones);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM animales WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function actualizar()
    {
        $sql = sprintf("UPDATE animales SET fecha_de_nacimiento = %s, nombre = '%s', id = '%s', id_especie = '%s', id_raza = '%s',id_padre = '%s' ,id_madre = '%s' ,observaciones = '%s'   WHERE id = %s", $this->fecha_nacimiento, $this->nombre, $this->id,$this->id_especie,$this->id_raza,$this->id_padre,$this->id_madre,$this->observaciones, $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function consultar()
    {
        $sql = "SELECT 
    a.fecha_de_nacimiento,
    a.nombre,
    a.id,
    e.nombre AS especie,
    r.nombre AS raza,
    a.id_padre,
    a.id_madre,
    a.observaciones
FROM animales AS a
INNER JOIN especies AS e ON a.id_especie = e.id
INNER JOIN razas AS r ON a.id_raza = r.id
ORDER BY a.nombre ASC
WHERE a.fecha_de_nacimiento like '%$this->consulta%' 
OR a.nombre like '%$this->consulta%' 
OR a.id like '%$this->consulta%' ";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
