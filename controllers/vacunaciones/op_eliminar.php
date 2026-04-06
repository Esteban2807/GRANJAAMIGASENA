<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/vacunaciones.php';
$obj = new vacunaciones();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacunación eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar vacunación. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_vacunaciones.php");
exit;
?> 
