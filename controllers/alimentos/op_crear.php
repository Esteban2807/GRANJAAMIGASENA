<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/alimentos.php';
    $obj = new alimentos();
    $obj->setNombre($_POST['nombre']);
    $obj->setTipo($_POST['tipo']);
    $obj->setMarcaProveedor($_POST['marca_proveedor']);
    $obj->setStockActual($_POST['stock_actual']);
    $obj->setUnidadMedida($_POST['unidad_medida']);
    $obj->setFechaVencimiento($_POST['fecha_vencimiento']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimento creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear alimento. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_alimentos.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimento creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_alimentos.php");
    exit;
}
?> 
