<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1]);
include '../../class/especies.php';
$obj = new Especies();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_especies.php?msg=eliminado");
?>