<?php
session_start();
require_once __DIR__ . '/../class/usuarios.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$documento  = trim($_POST['documento'] ?? '');
$contrasena = trim($_POST['contrasena'] ?? '');

if ($documento === '' || $contrasena === '') {
    $_SESSION['login_error'] = 'Complete los campos.';
    header('Location: ../login.php');
    exit;
}

$usuario = new usuarios();
$usuario->setDocumento($documento);
$usuario->consultar();

$stored = $usuario->getContrasena();
// Validación básica: compara con MD5 si el almacenamiento lo usa
if ($stored && $stored === md5($contrasena)) {
    $_SESSION['user'] = [
        'documento' => $usuario->getDocumento(),
        'nombres'   => $usuario->getNombres(),
        'apellidos' => $usuario->getApellidos(),
        'correo'    => $usuario->getCorreo()
    ];
    $_SESSION['rol_id'] = $usuario->getIdCargo();
    header('Location: ../inicio');
    exit;
}

$_SESSION['login_error'] = 'Documento o contraseña incorrectos.';
header('Location: ../login.php');
exit;
