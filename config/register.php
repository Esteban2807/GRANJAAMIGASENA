<?php
include '../class/usuarios.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$tipo_documento = trim($_POST['tipo_documento'] ?? '');
$documento      = trim($_POST['documento'] ?? '');
$correo         = trim($_POST['correo'] ?? '');
$nombres        = trim($_POST['nombres'] ?? '');
$apellidos      = trim($_POST['apellidos'] ?? '');
$contrasena     = $_POST['contrasena'] ?? ($_POST['password'] ?? '');
$id_cargo       = '6';

if ($tipo_documento === '' || $documento === '' || $correo === '' || $nombres === '' || $apellidos === '' || $contrasena === '') {
    header('Location: ../login.php');
    exit;
}

$obj = new usuarios();
$obj->setTipoDocumento($tipo_documento);
$obj->setDocumento($documento);
$obj->setCorreo($correo);
$obj->setNombres($nombres);
$obj->setApellidos($apellidos);
$obj->setContrasena(md5($contrasena));
$obj->setIdCargo($id_cargo);
$obj->insertar();

header('Location: ../login.php');
exit;
?>
