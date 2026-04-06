<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/medicaciones.php';
$obj = new medicaciones();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicación eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar medicación. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_medicaciones.php");
exit;
?> 
