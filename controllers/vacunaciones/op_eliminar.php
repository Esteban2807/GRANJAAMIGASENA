<?php
include '../../class/vacunaciones.php';
$obj = new vacunaciones();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_vacunaciones.php");
?> 
