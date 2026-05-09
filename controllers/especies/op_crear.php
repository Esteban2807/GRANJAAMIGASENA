<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/especies.php';
    $obj = new Especies();
    $obj->setNombre($_POST['nombre']);
    $obj->insertar();
    header("Location: ../../l_especies.php?msg=creado");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../index.php");
}
?>