<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1,2,5]);
include '../../class/animales.php';
$obj = new Animales();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_animales.php?msg=eliminado");
?>