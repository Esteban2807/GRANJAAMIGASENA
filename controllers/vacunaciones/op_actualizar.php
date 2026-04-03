<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/vacunaciones.php';
$obj = new vacunaciones();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setIdAnimal($_POST['id_animal']);
$obj->setDocumentoVeterinario($_POST['documento_veterinario']);
$obj->setIdVacuna($_POST['id_vacuna']);
$obj->setCantidadDada($_POST['cantidad_dada']);
$obj->setFechaHora($_POST['fecha_hora']);
$obj->actualizar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacunación actualizado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_vacunaciones.php");
exit;
?> 
