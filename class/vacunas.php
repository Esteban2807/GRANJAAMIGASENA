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

    // ======================
    // GETTERS Y SETTERS
    // ======================
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setMarcaProveedor($marca_proveedor)
    {
        $this->marca_proveedor = $marca_proveedor;
    }
    public function setStockActual($stock_actual)
    {
        $this->stock_actual = $stock_actual;
    }
    public function setUnidadMedida($unidad_medida)
    {
        $this->unidad_medida = $unidad_medida;
    }
    public function setFechaVencimiento($fecha_vencimiento)
    {
        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getMarcaProveedor()
    {
        return $this->marca_proveedor;
    }
    public function getStockActual()
    {
        return $this->stock_actual;
    }
    public function getUnidadMedida()
    {
        return $this->unidad_medida;
    }
    public function getFechaVencimiento()
    {
        return $this->fecha_vencimiento;
    }

    // ======================
    // LISTAR (vista)
    // ======================
    public function listar()
    {
        $sql = "SELECT * FROM listarVacunas";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    // ======================
    // INSERTAR (SP)
    // ======================
    public function insertar()
    {
        $sql = "CALL crearVacuna(
            '{$this->nombre}',
            '{$this->marca_proveedor}',
            '{$this->stock_actual}',
            '{$this->unidad_medida}',
            '{$this->fecha_vencimiento}'
        )";

        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    // ======================
    // ACTUALIZAR (SP)
    // ======================
    public function actualizar()
    {
        $sql = "CALL actualizarVacuna(
            {$this->id},
            '{$this->nombre}',
            '{$this->marca_proveedor}',
            '{$this->stock_actual}',
            '{$this->unidad_medida}',
            '{$this->fecha_vencimiento}'
        )";

        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    // ======================
    // ELIMINAR (SP)
    // ======================
    public function eliminar()
    {
        $sql = "CALL eliminarVacuna({$this->id})";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    // ======================
    // CONSULTAR UNO (SP)
    // ======================
    public function consultar()
    {
        $sql = "CALL consultarVacuna({$this->id})";

        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();

        if ($res) {
            $this->nombre = $res['nombre'];
            $this->marca_proveedor = $res['marca_proveedor'];
            $this->stock_actual = $res['stock_actual'];
            $this->unidad_medida = $res['unidad_medida'];
            $this->fecha_vencimiento = $res['fecha_vencimiento'];
        }
    }

    // ======================
    // BUSCAR (SP)
    // ======================
    public function buscar($consulta)
    {
        $this->consulta = $consulta;

        $sql = "CALL consultarVacunas('{$this->consulta}')";

        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();

        return $res;
    }
}
?>