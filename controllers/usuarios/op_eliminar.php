<?php
include_once __DIR__ . '/../../class/usuarios.php';

$obj = new usuarios();

$documento = isset($_POST['documento']) ? $_POST['documento'] : (isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null);

if ($documento !== null) {
    $obj->setDocumento($documento);
    $obj->eliminar();
}

header("Location: ../../l_usuarios.php");
?>
