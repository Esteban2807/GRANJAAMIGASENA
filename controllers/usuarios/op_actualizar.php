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
$obj->setContrasena($_POST['contrasena'] ?? ($_POST['password'] ?? $obj->getContrasena()));
$obj->setIdCargo($_POST['id_cargo'] ?? $obj->getIdCargo());

$obj->actualizar();

header("Location: ../../l_usuarios.php");
exit;
?>
