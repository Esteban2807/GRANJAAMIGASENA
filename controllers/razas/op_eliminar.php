<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1]);
include '../../class/razas.php';
$obj = new Razas();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_razas.php?msg=eliminado");
?>