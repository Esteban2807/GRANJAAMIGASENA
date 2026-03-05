<?php
include '../../class/cargos.php';
$obj = new cargos();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setNombre($_POST['nombre']);
$obj->actualizar();
header("Location: ../../l_cargos.php");
?> 
