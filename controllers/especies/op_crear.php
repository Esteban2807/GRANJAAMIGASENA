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
    $exito = $obj->insertar();
    if ($exito) {
        $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Especie creado(a) exitosamente.'];
    } else {
        $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al crear especie. Inténtelo de nuevo.'];
    }

    # Redirigir al listado de Especies
    session_write_close();
    header("Location: ../../l_especies.php");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo "Método GET no permitido para crear registros";
} else{
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Especie creado(a) exitosamente.'];
    session_write_close();
    header("Location: ../../l_especies.php");
    exit;
}
?>
