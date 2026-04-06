<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Especies
include '../../class/especies.php';

# Crear el objeto Especies
$obj = new Especies();

# Establecer la clave primaria para eliminar
$obj->setId($_POST['id']);

# Eliminar de la base de datos
$exito = $obj->eliminar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Especie eliminado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al eliminar especie. Inténtelo de nuevo.'];
}

# Redirigir al listado
    session_write_close();
header("Location: ../../l_especies.php");
exit;
?>
