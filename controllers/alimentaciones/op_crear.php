<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/alimentaciones.php';
    $obj = new alimentaciones();
    $obj->setIdAnimal($_POST['id_animal']);
    $obj->setDocumentoAlimentador($_POST['documento_alimentador']);
    $obj->setIdAlimento($_POST['id_alimento']);
    $obj->setCantidadDada($_POST['cantidad_dada']);
    $obj->setFechaHora($_POST['fecha_hora']);
    $obj->insertar();
    header("Location: ../../l_alimentaciones.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../inicio");
}
?> 
