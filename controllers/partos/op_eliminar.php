<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/partos.php';
$obj = new partos();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Parto eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar parto. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_partos.php");
exit;
?> 
