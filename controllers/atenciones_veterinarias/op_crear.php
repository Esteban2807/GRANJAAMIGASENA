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
    $obj->insertar();
    header("Location: ../../l_atenciones_veterinarias.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../index.php");
}
?> 
