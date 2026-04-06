<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1]);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/cargos.php';
    $obj = new cargos();
    $obj->setNombre($_POST['nombre']);
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Cargo creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear cargo. Inténtelo de nuevo.'];
    }
    session_write_close();
    header("Location: ../../l_cargos.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Cargo creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_cargos.php");
    exit;
}
?> 
