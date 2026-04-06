<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/atenciones_veterinarias.php';
$obj = new atenciones_veterinarias();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Atención veterinaria eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar atención veterinaria. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_atenciones_veterinarias.php");
exit;
?> 
