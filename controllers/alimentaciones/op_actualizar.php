<?php
include '../../class/alimentaciones.php';
$obj = new alimentaciones();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setIdAnimal($_POST['id_animal']);
$obj->setDocumentoAlimentador($_POST['documento_alimentador']);
$obj->setIdAlimento($_POST['id_alimento']);
$obj->setCantidadDada($_POST['cantidad_dada']);
$obj->setFechaHora($_POST['fecha_hora']);
$obj->actualizar();
header("Location: ../../l_alimentaciones.php");
?> 
