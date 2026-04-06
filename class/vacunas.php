<?php
include_once 'basedatos.php';
class vacunas extends basedatos
{
    public $id;
    public $nombre;
    public $marca_proveedor;
    public $stock_actual;
    public $unidad_medida;
    public $fecha_vencimiento;
    public $consulta;

    function __construct($id = null, $nombre = null, $marca_proveedor = null, $stock_actual = null, $unidad_medida = null, $fecha_vencimiento = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca_proveedor = $marca_proveedor;
        $this->stock_actual = $stock_actual;
        $this->unidad_medida = $unidad_medida;
        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setMarcaProveedor($marca_proveedor) { $this->marca_proveedor = $marca_proveedor; }
    public function setStockActual($stock_actual) { $this->stock_actual = $stock_actual; }
    public function setUnidadMedida($unidad_medida) { $this->unidad_medida = $unidad_medida; }
    public function setFechaVencimiento($fecha_vencimiento) { $this->fecha_vencimiento = $fecha_vencimiento; }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getMarcaProveedor() { return $this->marca_proveedor; }
    public function getStockActual() { return $this->stock_actual; }
    public function getUnidadMedida() { return $this->unidad_medida; }
    public function getFechaVencimiento() { return $this->fecha_vencimiento; }

    public function listar()
    {
        $sql = "SELECT * FROM vacunas ORDER BY id";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
    public function insertar()
    {
        $sql = sprintf(
            "INSERT INTO vacunas (nombre,marca_proveedor,stock_actual,unidad_medida,fecha_vencimiento) VALUES ('%s','%s','%s','%s','%s')",
            $this->nombre,
            $this->marca_proveedor,
            $this->stock_actual,
            $this->unidad_medida,
            $this->fecha_vencimiento
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function eliminar()
    {
        $sql = sprintf("DELETE FROM vacunas WHERE id = %s", $this->id);
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function actualizar()
    {
        $sql = sprintf(
            "UPDATE vacunas SET nombre='%s', marca_proveedor='%s', stock_actual='%s', unidad_medida='%s', fecha_vencimiento='%s' WHERE id=%s",
            $this->nombre,
            $this->marca_proveedor,
            $this->stock_actual,
            $this->unidad_medida,
            $this->fecha_vencimiento,
            $this->id
        );
        $this->conectar();
        $ok = $this->ejecutarSQL($sql);
        $this->desconectar();
        return $ok !== false;
    }
    public function consultar()
    {
        $sql = sprintf("SELECT * FROM vacunas WHERE id = %s", $this->id);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->nombre = $res['nombre'];
        $this->marca_proveedor = $res['marca_proveedor'];
        $this->stock_actual = $res['stock_actual'];
        $this->unidad_medida = $res['unidad_medida'];
        $this->fecha_vencimiento = $res['fecha_vencimiento'];
    }
    public function buscar($consulta)
    {
        $this->consulta = $consulta;
        $c = $consulta;
        $sql = "SELECT * FROM vacunas WHERE nombre LIKE '%$c%' OR marca_proveedor LIKE '%$c%' ORDER BY id";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?> 
