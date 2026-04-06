<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/medicaciones.php';
$obj = new medicaciones();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setIdAnimal($_POST['id_animal']);
$obj->setDocumentoVeterinario($_POST['documento_veterinario']);
$obj->setIdMedicamento($_POST['id_medicamento']);
$obj->setCantidadDada($_POST['cantidad_dada']);
$obj->setFechaHora($_POST['fecha_hora']);
$exito = $obj->actualizar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicación actualizado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar medicación. Inténtelo de nuevo.'];
}
    session_write_close();
header("Location: ../../l_medicaciones.php");
exit;
?> 
