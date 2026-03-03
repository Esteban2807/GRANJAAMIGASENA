<?php
# Incluir la clase Especies
include '../../class/especies.php';

# Crear el objeto Especies
$obj = new Especies();

# Establecer la clave primaria para eliminar
$obj->setId($_POST['id']);

# Eliminar de la base de datos
$obj->eliminar();

# Redirigir al listado
header("Location: ../../l_especies.php");
?>