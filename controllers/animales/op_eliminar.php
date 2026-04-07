<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/animales.php';

$obj = new Animales();
$obj->setId($_POST['id']);

$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Animal eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar animal. Inténtelo de nuevo.'];
}
session_write_close();
header("Location: ../../l_animales.php");
exit;
?>
