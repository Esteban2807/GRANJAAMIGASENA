<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../class/usuarios.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$documento  = trim($_POST['documento'] ?? '');
$contrasena = trim($_POST['contrasena'] ?? '');

if ($documento === '' || $contrasena === '') {
    $_SESSION['flash'] = ['tipo' => 'error', 'mensaje' => 'Por favor complete todos los campos.'];
    session_write_close();
    header('Location: ../login.php');
    exit;
}

$usuario = new usuarios();
$usuario->setDocumento($documento);
$usuario->consultar();

$stored = $usuario->getContrasena();

if ($stored && $stored === md5($contrasena)) {
    $_SESSION['user'] = [
        'documento' => $usuario->getDocumento(),
        'nombres'   => $usuario->getNombres(),
        'apellidos' => $usuario->getApellidos(),
        'correo'    => $usuario->getCorreo()
    ];
    $_SESSION['rol_id'] = $usuario->getIdCargo();
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => '¡Bienvenido, ' . htmlspecialchars($usuario->getNombres()) . '!'];
    session_write_close();
    header('Location: ../index.php');
    exit;
}

$_SESSION['flash'] = ['tipo' => 'error', 'mensaje' => 'Documento o contraseña incorrectos.'];
session_write_close();
header('Location: ../login.php');
exit;
