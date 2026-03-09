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
$obj->actualizar();

# Redirigir al listado de Tipos_documento
header("Location: ../../l_tipos_documento.php");
?>
