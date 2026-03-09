<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Razas
include '../../class/razas.php';

# Crear el objeto Razas
$obj = new Razas();

# Establecer la clave primaria para eliminar
$obj->setId($_POST['id']);

# Eliminar de la base de datos
$obj->eliminar();

# Redirigir al listado
header("Location: ../../l_razas.php");
?>
