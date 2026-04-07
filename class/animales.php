<?php
include_once 'basedatos.php';
class animales extends basedatos
{
    public $id;
    public $chapeta;
    public $nombre;
    public $sexo;
    public $fecha_nacimiento;
    public $id_especie;
    public $id_raza;
    public $id_padre;
    public $id_madre;
    public $observaciones;
    public $consulta;

    function __construct($chapeta = null, $nombre = null, $sexo = null, $fecha_nacimiento = null, $id_especie = null, $id_raza = null, $id_padre = null, $id_madre = null, $observaciones = null)
    {
        $this->chapeta = $chapeta;
        $this->nombre = $nombre;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->id_especie = $id_especie;
        $this->id_raza = $id_raza;
        $this->id_padre = $id_padre;
        $this->id_madre = $id_madre;
        $this->observaciones = $observaciones;
    }

    public function getId() { return $this->id; }
    public function getChapeta() { return $this->chapeta; }
    public function getNombre() { return $this->nombre; }
    public function getSexo() { return $this->sexo; }
    public function getFechaNacimiento() { return $this->fecha_nacimiento; }
    public function getIdEspecie() { return $this->id_especie; }
    public function getIdRaza() { return $this->id_raza; }
    public function getIdPadre() { return $this->id_padre; }
    public function getIdMadre() { return $this->id_madre; }
    public function getObservaciones() { return $this->observaciones; }

    public function setId($id) { $this->id = $id; }
    public function setChapeta($chapeta) { $this->chapeta = $chapeta; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setSexo($sexo) { $this->sexo = $sexo; }
    public function setFechaNacimiento($fecha_nacimiento) { $this->fecha_nacimiento = $fecha_nacimiento; }
    public function setIdEspecie($id_especie) { $this->id_especie = $id_especie; }
    public function setIdRaza($id_raza) { $this->id_raza = $id_raza; }
    public function setIdPadre($id_padre) { $this->id_padre = $id_padre; }
    public function setIdMadre($id_madre) { $this->id_madre = $id_madre; }
    public function setObservaciones($observaciones) { $this->observaciones = $observaciones; }

    public function listar()
    {
        $sql = "SELECT a.id, a.chapeta, a.nombre, a.sexo, a.fecha_nacimiento,
                e.nombre AS especie, r.nombre AS raza,
                a.id_padre, a.id_madre, a.observaciones
                FROM animales AS a
                INNER JOIN especies AS e ON a.id_especie = e.id
                INNER JOIN razas AS r ON a.id_raza = r.id
                ORDER BY a.nombre ASC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function insertar()
    {
        $padre = !empty($this->id_padre) ? "'" . $this->id_padre . "'" : "NULL";
        $madre = !empty($this->id_madre) ? "'" . $this->id_madre . "'" : "NULL";
        $sql = sprintf(
            "INSERT INTO animales (chapeta, nombre, sexo, fecha_nacimiento, id_especie, id_raza, id_padre, id_madre, observaciones) VALUES ('%s','%s','%s','%s','%s','%s',%s,%s,'%s')",
            $this->chapeta,
            $this->nombre,
            $this->sexo,
            $this->fecha_nacimiento,
            $this->id_especie,
            $this->id_raza,
            $padre,
            $madre,
            $this->observaciones
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }

    public function eliminar()
    {
        $sql = sprintf("DELETE FROM animales WHERE id = %s", $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }

    public function actualizar()
    {
        $padre = !empty($this->id_padre) ? "'" . $this->id_padre . "'" : "NULL";
        $madre = !empty($this->id_madre) ? "'" . $this->id_madre . "'" : "NULL";
        $sql = sprintf(
            "UPDATE animales SET chapeta='%s', nombre='%s', sexo='%s', fecha_nacimiento='%s', id_especie='%s', id_raza='%s', id_padre=%s, id_madre=%s, observaciones='%s' WHERE id=%s",
            $this->chapeta,
            $this->nombre,
            $this->sexo,
            $this->fecha_nacimiento,
            $this->id_especie,
            $this->id_raza,
            $padre,
            $madre,
            $this->observaciones,
            $this->id
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }

    public function consultar()
    {
        $sql = sprintf(
            "SELECT id, chapeta, nombre, sexo, fecha_nacimiento, id_especie, id_raza, id_padre, id_madre, observaciones
            FROM animales WHERE id = %s",
            $this->id
        );
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->chapeta = $res['chapeta'];
        $this->nombre = $res['nombre'];
        $this->sexo = $res['sexo'];
        $this->fecha_nacimiento = $res['fecha_nacimiento'];
        $this->id_especie = $res['id_especie'];
        $this->id_raza = $res['id_raza'];
        $this->id_padre = $res['id_padre'];
        $this->id_madre = $res['id_madre'];
        $this->observaciones = $res['observaciones'];
    }

    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $sql = "SELECT a.id, a.chapeta, a.nombre, a.sexo, a.fecha_nacimiento,
                e.nombre AS especie, r.nombre AS raza,
                a.id_padre, a.id_madre, a.observaciones
                FROM animales AS a
                INNER JOIN especies AS e ON a.id_especie = e.id
                INNER JOIN razas AS r ON a.id_raza = r.id
                WHERE a.nombre LIKE '%$this->consulta%'
                OR a.chapeta LIKE '%$this->consulta%'
                ORDER BY a.nombre ASC";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?>