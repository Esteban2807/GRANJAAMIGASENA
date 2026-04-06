<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/atenciones_veterinarias.php';
    $obj = new atenciones_veterinarias();
    $obj->setIdAnimal($_POST['id_animal']);
    $obj->setDocumentoVeterinario($_POST['documento_veterinario']);
    $obj->setFechaAtencion($_POST['fecha_atencion']);
    $obj->setMotivo($_POST['motivo']);
    $obj->setDiagnostico($_POST['diagnostico']);
    $obj->setTratamiento($_POST['tratamiento']);
    $obj->setMedicamentoId($_POST['medicamento_id']);
    $obj->setDosis($_POST['dosis']);
    $obj->setViaAdministracion($_POST['via_administracion']);
    $obj->setObservaciones($_POST['observaciones']);
    $obj->setCostoTotal($_POST['costo_total']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Atención veterinaria creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear atención veterinaria. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_atenciones_veterinarias.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Atención veterinaria creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_atenciones_veterinarias.php");
    exit;
}
?> 
