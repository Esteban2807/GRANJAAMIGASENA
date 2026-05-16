<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1,4]);
include '../../class/medicamentos.php';
$obj = new medicamentos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_medicamentos.php?msg=eliminado");
?>