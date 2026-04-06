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
    header("Location: ../../animales");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../animales");
}
?>
