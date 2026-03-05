<?php
include '../../class/partos.php';
$obj = new partos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_partos.php");
?> 
