<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/partos.php';
    $obj = new partos();
    $obj->setFecha($_POST['fecha']);
    $obj->setFacilidad($_POST['facilidad']);
    $obj->setMadreId($_POST['madre_id']);
    $obj->setSecuencia($_POST['secuencia']);
    $obj->setDocumentoUsuario($_POST['documento_usuario']);
    $obj->setDocumentoVeterinario($_POST['documento_veterinario']);
    $obj->setDuracionMinutos($_POST['duracion_minutos']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Parto creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear parto. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_partos.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Parto creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_partos.php");
    exit;
}
?> 
