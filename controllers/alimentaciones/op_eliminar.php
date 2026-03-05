<?php
include '../../class/alimentaciones.php';
$obj = new alimentaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_alimentaciones.php");
?> 
