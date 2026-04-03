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
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacuna creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../vacunas");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacuna creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_vacunas.php");
    exit;
}
?> 
