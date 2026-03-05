<?php
include '../../class/cargos.php';
$obj = new cargos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_cargos.php");
?> 
