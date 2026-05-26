<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1,2,3,5]);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/animales.php';
    $obj = new Animales();
    $obj->setNombre($_POST['nombre']);
    $obj->setChapeta($_POST['chapeta']);
    $obj->setSexo($_POST['sexo']);
    $obj->setIdMadre($_POST['id_madre']);
    $obj->setIdPadre($_POST['id_padre']);
    $obj->setFechaNacimiento($_POST['fecha_nacimiento']);
    $obj->setIdEspecie($_POST['id_especie']);
    $obj->setIdRaza($_POST['id_raza']);
    $obj->setObservaciones($_POST['observaciones']);
    $obj->insertar();
    header("Location: ../../l_animales.php?msg=creado");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "Método GET no permitido para crear registros";
} else {
    header("Location: ../../l_animales.php");
}
?>