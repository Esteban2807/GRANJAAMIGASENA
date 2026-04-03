<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/medicamentos.php';
$obj = new medicamentos();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Medicamento eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_medicamentos.php");
exit;
?> 
