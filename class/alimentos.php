<?php
include_once 'basedatos.php';

class alimentos extends basedatos
{
    public $id;
    public $nombre;
    public $tipo;
    public $marca_proveedor;
    public $stock_actual;
    public $unidad_medida;
    public $fecha_vencimiento;
    public $consulta;

    function __construct($id = null, $nombre = null, $tipo = null, $marca_proveedor = null, $stock_actual = null, $unidad_medida = null, $fecha_vencimiento = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->marca_proveedor = $marca_proveedor;
        $this->stock_actual = $stock_actual;
        $this->unidad_medida = $unidad_medida;
        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    // ======================
    // LISTAR (usa vista)
    // ======================
    public function listar()
    {
        $sql = "SELECT * FROM listarAlimentos";
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
        $sql = "CALL crearAlimento(
            '{$this->nombre}',
            '{$this->tipo}',
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
        $sql = "CALL actualizarAlimento(
            {$this->id},
            '{$this->nombre}',
            '{$this->tipo}',
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
        $sql = "CALL eliminarAlimento({$this->id})";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    // ======================
    // CONSULTAR UNO (SP)
    // ======================
    public function consultar()
    {
        $sql = "CALL consultarAlimento({$this->id})";

        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();

        if ($res) {
            $this->nombre = $res['nombre'];
            $this->tipo = $res['tipo'];
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

        $sql = "CALL consultarAlimentos('{$this->consulta}')";

        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();

        return $res;
    }
}