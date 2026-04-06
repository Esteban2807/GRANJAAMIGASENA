<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/vacunaciones.php';
    $obj = new vacunaciones();
    $obj->setIdAnimal($_POST['id_animal']);
    $obj->setDocumentoVeterinario($_POST['documento_veterinario']);
    $obj->setIdVacuna($_POST['id_vacuna']);
    $obj->setCantidadDada($_POST['cantidad_dada']);
    $obj->setFechaHora($_POST['fecha_hora']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacunación creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear vacunación. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_vacunaciones.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Vacunación creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_vacunaciones.php");
    exit;
}
?> 
