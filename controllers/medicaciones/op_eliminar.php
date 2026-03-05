<?php
include '../../class/medicaciones.php';
$obj = new medicaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_medicaciones.php");
?> 
