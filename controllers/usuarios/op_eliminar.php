<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include_once __DIR__ . '/../../class/usuarios.php';

$obj = new usuarios();

$documento = isset($_POST['documento']) ? $_POST['documento'] : (isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null);

if ($documento !== null) {
    $obj->setDocumento($documento);
    $obj->eliminar();
}

    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Usuario eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_usuarios.php");
exit;
?>
