<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/nacimientos.php';
$obj = new nacimientos();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setFecha($_POST['fecha']);
$obj->setPartoId($_POST['parto_id']);
$obj->setDocumentoUsuario($_POST['documento_usuario']);
$obj->setPesoKg($_POST['peso_kg']);
$obj->setSexo($_POST['sexo']);
$obj->setVigor($_POST['vigor']);
$obj->setObservaciones($_POST['observaciones']);
$obj->actualizar();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Nacimiento actualizado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_nacimientos.php");
exit;
?> 
