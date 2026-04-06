<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Razas
include '../../class/razas.php';

# Crear el objeto Razas
$obj = new Razas();

# Establecer la clave primaria para consultar
$obj->setId($_POST['id']);

# Consultar el registro existente
$obj->consultar();

# Establecer los nuevos valores
$obj->setNombre($_POST['nombre']);
$obj->setIdEspecie($_POST['id_especie']);

# Actualizar en la base de datos
$exito = $obj->actualizar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Raza actualizado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar raza. Inténtelo de nuevo.'];
}

# Redirigir al listado de Razas
    session_write_close();
header("Location: ../../l_razas.php");
exit;
?>
