<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
verificarRol([1]);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../class/cargos.php';
    $obj = new cargos();
    $obj->setNombre($_POST['nombre']);
    $obj->insertar();
    header("Location: ../../l_cargos.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../inicio");
}
?> 
