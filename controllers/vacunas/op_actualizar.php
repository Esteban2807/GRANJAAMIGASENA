<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/vacunas.php';
$obj = new vacunas();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setNombre($_POST['nombre']);
$obj->setMarcaProveedor($_POST['marca_proveedor']);
$obj->setStockActual($_POST['stock_actual']);
$obj->setUnidadMedida($_POST['unidad_medida']);
$obj->setFechaVencimiento($_POST['fecha_vencimiento']);
$obj->actualizar();
header("Location: ../../vacunas");
?> 
