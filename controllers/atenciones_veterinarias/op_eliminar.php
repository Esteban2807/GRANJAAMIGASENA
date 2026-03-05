<?php
include '../../class/atenciones_veterinarias.php';
$obj = new atenciones_veterinarias();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_atenciones_veterinarias.php");
?> 
