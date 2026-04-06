<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/animales.php';
    $obj = new Animales();
    $obj->setNombre($_POST['nombre']);
    $obj->setIdMadre($_POST['id_madre']);
    $obj->setIdPadre($_POST['id_padre']);
    $obj->setFechaNacimiento($_POST['fecha_nacimiento']);
    $obj->setIdEspecie($_POST['id_especie']);
    $obj->setIdRaza($_POST['id_raza']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Animal creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear animal. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_animales.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Animal creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_animales.php");
    exit;
}
?>