<?php
include '../../class/nacimientos.php';
$obj = new nacimientos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_nacimientos.php");
?> 
