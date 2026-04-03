<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/atenciones_veterinarias.php';
$obj = new atenciones_veterinarias();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Atención veterinaria eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_atenciones_veterinarias.php");
exit;
?> 
