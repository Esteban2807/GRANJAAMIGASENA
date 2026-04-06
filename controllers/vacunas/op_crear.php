<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/vacunas.php';
    $obj = new vacunas();
    $obj->setNombre($_POST['nombre']);
    $obj->setMarcaProveedor($_POST['marca_proveedor']);
    $obj->setStockActual($_POST['stock_actual']);
    $obj->setUnidadMedida($_POST['unidad_medida']);
    $obj->setFechaVencimiento($_POST['fecha_vencimiento']);
    $obj->insertar();
    header("Location: ../../vacunas");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
   header("Location: ../../l_vacunas.php");
}
?> 
