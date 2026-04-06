<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/medicamentos.php';
    $obj = new medicamentos();
    $obj->setNombre($_POST['nombre']);
    $obj->setTipo($_POST['tipo']);
    $obj->setMarcaProveedor($_POST['marca_proveedor']);
    $obj->setStockActual($_POST['stock_actual']);
    $obj->setUnidadMedida($_POST['unidad_medida']);
    $obj->setFechaVencimiento($_POST['fecha_vencimiento']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicamento creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear medicamento. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_medicamentos.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicamento creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_medicamentos.php");
    exit;
}
?> 
