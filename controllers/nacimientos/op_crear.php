<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/nacimientos.php';
    $obj = new nacimientos();
    $obj->setFecha($_POST['fecha']);
    $obj->setPartoId($_POST['parto_id']);
    $obj->setDocumentoUsuario($_POST['documento_usuario']);
    $obj->setPesoKg($_POST['peso_kg']);
    $obj->setSexo($_POST['sexo']);
    $obj->setVigor($_POST['vigor']);
    $obj->setObservaciones($_POST['observaciones']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Nacimiento creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear nacimiento. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_nacimientos.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Nacimiento creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_nacimientos.php");
    exit;
}
?> 
