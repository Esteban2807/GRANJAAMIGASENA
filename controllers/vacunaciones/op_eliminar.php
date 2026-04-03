<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/vacunaciones.php';
$obj = new vacunaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacunación eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_vacunaciones.php");
exit;
?> 
