<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentaciones.php';
$obj = new alimentaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_alimentaciones.php");
?> 
