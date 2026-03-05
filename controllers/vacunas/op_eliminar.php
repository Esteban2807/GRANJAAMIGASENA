<?php
include '../../class/vacunas.php';
$obj = new vacunas();
$obj->setId($_POST['id']);
$obj->eliminar();
header("Location: ../../l_vacunas.php");
?> 
