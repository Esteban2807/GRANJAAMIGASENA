<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/nacimientos.php';
$obj = new nacimientos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_nacimientos.php");
?> 
