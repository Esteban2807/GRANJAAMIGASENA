<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Animales
include '../../class/animales.php';

# Crear el objeto Animales
$obj = new Animales();

# Establecer la clave primaria para eliminar
$obj->setId($_POST['id']);

# Eliminar de la base de datos
$obj->eliminar();

# Redirigir al listado de Animales
header("Location: ../../animales");
?>
