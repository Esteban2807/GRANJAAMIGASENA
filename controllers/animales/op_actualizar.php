<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1,2,3,5]);
include '../../class/tipos_documento.php';
include '../../class/animales.php';
$obj = new Animales();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setNombre($_POST['nombre']);
$obj->setIdEspecie($_POST['id_especie']);
$obj->setIdRaza($_POST['id_raza']);
$obj->setIdPadre($_POST['id_padre']);
$obj->setIdMadre($_POST['id_madre']);
$obj->setObservaciones($_POST['observaciones']);
$obj->setChapeta($_POST['chapeta']);
$obj->setSexo($_POST['sexo']);
$obj->setFechaNacimiento($_POST['fecha_nacimiento']);
$obj->actualizar();
header("Location: ../../l_animales.php?msg=actualizado");
?>