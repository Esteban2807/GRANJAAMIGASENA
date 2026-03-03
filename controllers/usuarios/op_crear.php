<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../../class/usuarios.php';

    $obj = new usuarios();

    $obj->setTipoDocumento($_POST['tipo_documento'] ?? null);
    $obj->setDocumento($_POST['documento'] ?? null);
    $obj->setCorreo($_POST['correo'] ?? null);
    $obj->setNombres($_POST['nombres'] ?? null);
    $obj->setApellidos($_POST['apellidos'] ?? null);
    $obj->setContrasena($_POST['contrasena'] ?? ($_POST['password'] ?? null));
    $obj->setIdCargo($_POST['id_cargo'] ?? null);

    $obj->insertar();

    header("Location: ../../l_usuarios.php");
    exit;
} else {
    header("Location: ../../index.php");
    exit;
}
?>
