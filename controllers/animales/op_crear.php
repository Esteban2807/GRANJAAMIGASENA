<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Incluir la clase Animales
    include '../../class/animales.php';

    # CREAR EL OBJETO Animales
    $obj = new Animales();

    # Establecer propiedades del objeto Animales
    $obj->setNombre($_POST['nombre']);
    $obj->setIdMadre($_POST['id_madre']);
    $obj->setIdPadre($_POST['id_padre']);
    $obj->setFechaNacimiento($_POST['fecha_nacimiento']);
    $obj->setIdEspecie($_POST['id_especie']);
    $obj->setIdRaza($_POST['id_raza']);
    # Insertar en la base de datos
    $obj->insertar();

    # Redirigir al listado de Animales
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Animal creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../animales");
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
