<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/nacimientos.php';
$obj = new nacimientos();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Nacimiento eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_nacimientos.php");
exit;
?> 
