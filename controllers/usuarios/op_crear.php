<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/../../class/usuarios.php';

    $obj = new usuarios();

    $obj->setTipoDocumento($_POST['tipo_documento'] ?? null);
    $obj->setDocumento($_POST['documento'] ?? null);
    $obj->setCorreo($_POST['correo'] ?? null);
    $obj->setNombres($_POST['nombres'] ?? null);
    $obj->setApellidos($_POST['apellidos'] ?? null);

    $password = $_POST['contrasena'] ?? ($_POST['password'] ?? null);
    if ($password !== null) {
        if (preg_match('/^[a-f0-9]{32}$/i', $password)) {
            $obj->setContrasena($password);
        } else {
            $obj->setContrasena(md5($password));
        }
    }

    $idCargo = null;
    if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1) {
        $idCargo = $_POST['id_cargo'] ?? 6;
    } else {
        $idCargo = 6;
    }
    $obj->setIdCargo($idCargo);

    $obj->insertar();

    header("Location: ../../l_usuarios.php");
    exit;
} else {
    header("Location: ../../inicio");
    exit;
}
?>
