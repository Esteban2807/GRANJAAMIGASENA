<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentos.php';
$obj = new alimentos();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Alimento eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_alimentos.php");
exit;
?> 
