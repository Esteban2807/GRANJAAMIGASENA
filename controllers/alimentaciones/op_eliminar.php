<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentaciones.php';
$obj = new alimentaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimentación eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_alimentaciones.php");
exit;
?> 
