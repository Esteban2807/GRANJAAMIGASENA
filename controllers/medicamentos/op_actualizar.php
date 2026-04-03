<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/medicamentos.php';
$obj = new medicamentos();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setNombre($_POST['nombre']);
$obj->setTipo($_POST['tipo']);
$obj->setMarcaProveedor($_POST['marca_proveedor']);
$obj->setStockActual($_POST['stock_actual']);
$obj->setUnidadMedida($_POST['unidad_medida']);
$obj->setFechaVencimiento($_POST['fecha_vencimiento']);
$obj->actualizar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicamento actualizado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_medicamentos.php");
exit;
?> 
