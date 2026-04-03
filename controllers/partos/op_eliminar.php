<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/partos.php';
$obj = new partos();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Parto eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_partos.php");
exit;
?> 
