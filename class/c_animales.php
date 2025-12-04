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
    public $id_abuelo_materno;
    public $id_abuela_materna;
    public $id_abuelo_paterno;
    public $id_abuela_paterna;
    public $observaciones;


    public $consulta;

    //Constructor
    function __construct($fecha_nacimiento = null, $nombre = null, $id = null, $id_especie = null, $id_raza = null, $id_padre = null, $id_madre = null, $id_abuelo_materno = null, $id_abuela_materna = null, $id_abuelo_paterno = null, $id_abuela_paterna = null, $observaciones = null)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_especie = $id_especie;
        $this->id_raza = $id_raza;
        $this->id_padre = $id_padre;
        $this->id_madre = $id_madre;
        $this->id_abuelo_materno = $id_abuelo_materno;
        $this->id_abuela_materna = $id_abuela_materna;
        $this->id_abuelo_paterno = $id_abuelo_paterno;
        $this->id_abuela_paterna = $id_abuela_paterna;
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
    public function getIdAbueloMaterno()
    {
        return $this->id_abuelo_materno;
    }
    public function getIdAbuelaMaterna()
    {
        return $this->id_abuela_materna;
    }
    public function getIdAbueloPaterno()
    {
        return $this->id_abuelo_paterno;
    }
    public function getIdAbuelaPaterna()
    {
        return $this->id_abuela_paterna;
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
    public function setIdAbueloMaterno($id_abuelo_materno)
    {
        $this->id_abuelo_materno = $id_abuelo_materno;
    }
    public function setIdAbuelaMaterna($id_abuela_materna)
    {
        $this->id_abuela_materna = $id_abuela_materna;
    }
    public function setIdAbueloPaterno($id_abuelo_paterno)
    {
        $this->id_abuelo_paterno = $id_abuelo_paterno;
    }
    public function setIdAbuelaPaterna($id_abuela_paterna)
    {
        $this->id_abuela_paterna = $id_abuela_paterna;
    }
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    //Metodos especificos
    public function listar()
    {
        $sql = "SELECT a.fecha_de_nacimiento,a.nombre,a.id,e.nombre AS especie,r.nombre AS raza,a.id_padre,a.id_madre,a.id_abuelo_materno,a.id_abuela_materna,a.id_abuelo_paterno,a.id_abuela_paterna,observaciones FROM animales AS a, especies AS e, razas AS r WHERE  a.id_especie = e.id AND r.id_especie = e.id  ORDER BY a.nombre ASC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf("INSERT INTO granjaamiga (fecha_nacimiento,nombre,id,) VALUES ('%s', '%s', '%s')", $this->codigo, $this->nombre, $this->codigo_transaccion);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM banco WHERE codigo = %s", $this->codigo);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function actualizar()
    {
        $sql = sprintf("UPDATE banco SET codigo = %s, nombre = '%s', codigo_transaccion = '%s' WHERE codigo = %s", $this->codigo, $this->nombre, $this->codigo_transaccion, $this->codigo);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
        echo $sql;
    }

    public function consult()
    {
        $sql = "SELECT * FROM banco WHERE codigo like '%$this->consulta%' OR nombre like '%$this->consulta%' OR codigo_transaccion like '%$this->consulta%' ";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
