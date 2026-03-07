<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include_once __DIR__ . '/../../class/usuarios.php';

$obj = new usuarios();

$obj->setDocumento($_POST['documento'] ?? null);
$obj->consultar();

$obj->setTipoDocumento($_POST['tipo_documento'] ?? $obj->getTipoDocumento());
$obj->setCorreo($_POST['correo'] ?? $obj->getCorreo());
$obj->setNombres($_POST['nombres'] ?? $obj->getNombres());
$obj->setApellidos($_POST['apellidos'] ?? $obj->getApellidos());
$incomingPass = $_POST['contrasena'] ?? ($_POST['password'] ?? null);
if ($incomingPass === null || $incomingPass === '') {
    $obj->setContrasena($obj->getContrasena());
} else {
    if (preg_match('/^[a-f0-9]{32}$/i', $incomingPass)) {
        $obj->setContrasena($incomingPass);
    } else {
        $obj->setContrasena(md5($incomingPass));
    }
}
if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1) {
    $obj->setIdCargo($_POST['id_cargo'] ?? $obj->getIdCargo());
} else {
    $obj->setIdCargo($obj->getIdCargo());
}

$obj->actualizar();

header("Location: ../../l_usuarios.php");
exit;
?>
