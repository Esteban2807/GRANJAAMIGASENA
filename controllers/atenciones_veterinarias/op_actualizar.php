<?php
include '../../class/atenciones_veterinarias.php';
$obj = new atenciones_veterinarias();
$obj->setId($_POST['id']);
$obj->consultar();
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
$obj->actualizar();
header("Location: ../../l_atenciones_veterinarias.php");
?> 
