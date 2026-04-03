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
$obj->eliminar();

# Redirigir al listado
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Especie eliminado(a) correctamente.'];
    session_write_close();
header("Location: ../../l_especies.php");
exit;
?>
