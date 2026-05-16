<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1,4]);
include '../../class/vacunas.php';
$obj = new vacunas();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_vacunas.php?msg=eliminado");
?>