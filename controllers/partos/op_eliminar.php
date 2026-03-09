<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/partos.php';
$obj = new partos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_partos.php");
?> 
