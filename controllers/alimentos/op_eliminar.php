<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentos.php';
$obj = new alimentos();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimento eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar alimento. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_alimentos.php");
exit;
?> 
