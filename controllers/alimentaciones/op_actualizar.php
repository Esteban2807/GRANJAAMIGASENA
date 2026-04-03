<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentaciones.php';
$obj = new alimentaciones();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setIdAnimal($_POST['id_animal']);
$obj->setDocumentoAlimentador($_POST['documento_alimentador']);
$obj->setIdAlimento($_POST['id_alimento']);
$obj->setCantidadDada($_POST['cantidad_dada']);
$obj->setFechaHora($_POST['fecha_hora']);
$obj->actualizar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimentación actualizado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_alimentaciones.php");
exit;
?> 
