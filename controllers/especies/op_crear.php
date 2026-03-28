<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Incluir la clase Especies
    include '../../class/especies.php';

    # CREAR EL OBJETO Especies
    $obj = new Especies();

    # Establecer propiedades del objeto Especies
    $obj->setNombre($_POST['nombre']);

    # Insertar en la base de datos
    $obj->insertar();

    # Redirigir al listado de Especies
    header("Location: ../../l_especies.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../inicio");
}
?>
