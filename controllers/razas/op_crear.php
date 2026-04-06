<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # Incluir la clase Razas
    include '../../class/razas.php';

    # CREAR EL OBJETO Razas
    $obj = new Razas();

    # Establecer propiedades del objeto Razas
    $obj->setNombre($_POST['nombre']);
    $obj->setIdEspecie($_POST['id_especie']);

    # Insertar en la base de datos
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Raza creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear raza. Inténtelo de nuevo.'];
    }

    # Redirigir al listado de Razas
    session_write_close();
    header("Location: ../../l_razas.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Raza creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_razas.php");
    exit;
}
?>
