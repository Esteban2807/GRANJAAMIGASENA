<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Tipos_documento
include '../../class/tipos_documento.php';

# Crear el objeto Tipos_documento
$obj = new Tipos_documento();

# Establecer la clave primaria para consultar
$obj->setId($_POST['id']);

# Consultar el registro existente
$obj->consultar();

# Establecer los nuevos valores
$obj->setNombre($_POST['nombre']);
$obj->setSiglas($_POST['siglas']);
$obj->setEstado($_POST['estado']);

# Actualizar en la base de datos
$exito = $obj->actualizar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Tipo de documento actualizado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar tipo de documento. Inténtelo de nuevo.'];
}

# Redirigir al listado de Tipos_documento
    session_write_close();
header("Location: ../../l_tipos_documento.php");
exit;
?>
