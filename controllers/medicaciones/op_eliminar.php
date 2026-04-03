<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/medicaciones.php';
$obj = new medicaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicación eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_medicaciones.php");
exit;
?> 
