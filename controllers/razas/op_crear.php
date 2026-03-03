<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Incluir la clase Razas
    include '../../class/razas.php';

    # CREAR EL OBJETO Razas
    $obj = new Razas();

    # Establecer propiedades del objeto Razas
    $obj->setNombre($_POST['nombre']);
    $obj->setIdEspecie($_POST['id_especie']);

    # Insertar en la base de datos
    $obj->insertar();

    # Redirigir al listado de Razas
    header("Location: ../../l_razas.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    header("Location: ../../index.php");
}
?>