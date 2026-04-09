<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Incluir la clase Tipos_documento
    include '../../class/tipos_documento.php';

    # CREAR EL OBJETO Tipos_documento
    $obj = new Tipos_documento();

    # Establecer propiedades del objeto Tipos_documento
    $obj->setNombre($_POST['nombre']);
    $obj->setSiglas($_POST['siglas']);
    $obj->setEstado($_POST['estado']);

    # Insertar en la base de datos
    $obj->insertar();

    # Redirigir al listado de Tipos_documento
    header("Location: ../../l_tipos_documento.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../index.php");
}
?>
