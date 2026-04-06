<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentos.php';
$obj = new alimentos();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setNombre($_POST['nombre']);
$obj->setTipo($_POST['tipo']);
$obj->setMarcaProveedor($_POST['marca_proveedor']);
$obj->setStockActual($_POST['stock_actual']);
$obj->setUnidadMedida($_POST['unidad_medida']);
$obj->setFechaVencimiento($_POST['fecha_vencimiento']);
$exito = $obj->actualizar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimento actualizado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar alimento. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_alimentos.php");
exit;
?> 
