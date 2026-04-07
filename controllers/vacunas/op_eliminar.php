<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/vacunas.php';
$obj = new vacunas();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacuna eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar vacuna. Inténtelo de nuevo.'];
}
session_write_close();
header("Location: ../../l_vacunas.php");
exit;
?>
