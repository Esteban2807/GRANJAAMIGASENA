<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1,4]);
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
$obj->actualizar();
header("Location: ../../l_alimentos.php?msg=actualizado");
?>