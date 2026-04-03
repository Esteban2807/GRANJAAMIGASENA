<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/vacunas.php';
$obj = new vacunas();
$obj->setId($_POST['id']);
$obj->eliminar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacuna eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../vacunas");
exit;
?> 
