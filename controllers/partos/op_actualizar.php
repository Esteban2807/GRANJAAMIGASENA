<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/partos.php';
$obj = new partos();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setFecha($_POST['fecha']);
$obj->setFacilidad($_POST['facilidad']);
$obj->setMadreId($_POST['madre_id']);
$obj->setSecuencia($_POST['secuencia']);
$obj->setDocumentoUsuario($_POST['documento_usuario']);
$obj->setDocumentoVeterinario($_POST['documento_veterinario']);
$obj->setDuracionMinutos($_POST['duracion_minutos']);
$obj->actualizar();
$dest = "../../l_partos.php";
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Parto actualizado(a) correctamente.'];
    session_write_close();
header("Location: $dest");
exit;
?> 
