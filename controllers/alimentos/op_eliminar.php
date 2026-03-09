<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/alimentos.php';
$obj = new alimentos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_alimentos.php");
?> 
