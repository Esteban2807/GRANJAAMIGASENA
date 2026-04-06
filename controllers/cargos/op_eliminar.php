<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1]);
include '../../class/cargos.php';
$obj = new cargos();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Cargo eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar cargo. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_cargos.php");
exit;
?> 
