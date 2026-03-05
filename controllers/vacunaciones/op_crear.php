<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/vacunaciones.php';
    $obj = new vacunaciones();
    $obj->setIdAnimal($_POST['id_animal']);
    $obj->setDocumentoVeterinario($_POST['documento_veterinario']);
    $obj->setIdVacuna($_POST['id_vacuna']);
    $obj->setCantidadDada($_POST['cantidad_dada']);
    $obj->setFechaHora($_POST['fecha_hora']);
    $obj->insertar();
    header("Location: ../../l_vacunaciones.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../index.php");
}
?> 
