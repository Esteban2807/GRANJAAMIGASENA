<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Especies
include '../../class/especies.php';

# Crear el objeto Especies
$obj = new Especies();

# Establecer la clave primaria para consultar
$obj->setId($_POST['id']);

# Consultar el registro existente
$obj->consultar();

# Establecer los nuevos valores
$obj->setNombre($_POST['nombre']);

# Actualizar en la base de datos
$exito = $obj->actualizar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Especie actualizado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar especie. Inténtelo de nuevo.'];
}

# Redirigir al listado de Especies
    session_write_close();
header("Location: ../../l_especies.php");
exit;
?>
