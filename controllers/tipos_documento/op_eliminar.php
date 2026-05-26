<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1]);
include '../../class/tipos_documento.php';
$obj = new Tipos_documento();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_tipos_documento.php?msg=eliminado");
?>