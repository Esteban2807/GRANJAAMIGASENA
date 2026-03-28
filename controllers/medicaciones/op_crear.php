<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/medicaciones.php';
    $obj = new medicaciones();
    $obj->setIdAnimal($_POST['id_animal']);
    $obj->setDocumentoVeterinario($_POST['documento_veterinario']);
    $obj->setIdMedicamento($_POST['id_medicamento']);
    $obj->setCantidadDada($_POST['cantidad_dada']);
    $obj->setFechaHora($_POST['fecha_hora']);
    $obj->insertar();
    header("Location: ../../l_medicaciones.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../inicio");
}
?> 
