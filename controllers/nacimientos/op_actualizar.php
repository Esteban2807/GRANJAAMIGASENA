<?php
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
header("Location: ../../l_nacimientos.php");
?> 
