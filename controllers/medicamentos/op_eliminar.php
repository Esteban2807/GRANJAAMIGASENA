<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/medicamentos.php';
$obj = new medicamentos();
$obj->setId($_POST['id']);
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicamento eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar medicamento. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_medicamentos.php");
exit;
?> 
