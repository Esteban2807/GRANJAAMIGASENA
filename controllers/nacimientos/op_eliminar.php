<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/nacimientos.php';
$obj = new nacimientos();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Nacimiento eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar nacimiento. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_nacimientos.php");
exit;
?> 
