<?php
if (session_status() === PHP_SESSION_NONE) session_start();
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
$id_cargo       = 1;

if ($tipo_documento === '' || $documento === '' || $correo === '' || $nombres === '' || $apellidos === '' || $contrasena === '') {
    $_SESSION['flash'] = ['tipo' => 'error', 'mensaje' => 'Todos los campos son obligatorios.'];
    session_write_close();
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

if ($obj->insertar()) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Usuario registrado con éxito. Ya puedes iniciar sesión.'];
    session_write_close();
    header('Location: ../login.php');
    exit;
} else {
    $_SESSION['flash'] = ['tipo' => 'error', 'mensaje' => 'Error al registrar. El documento o correo ya existe.'];
    session_write_close();
    header('Location: ../login.php');
    exit;
}
