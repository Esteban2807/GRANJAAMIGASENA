<?php
include '../../class/medicamentos.php';
$obj = new medicamentos();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_medicamentos.php");
?> 
