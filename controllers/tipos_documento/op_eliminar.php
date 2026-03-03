<?php
# Incluir la clase Tipos_documento
include '../../class/tipos_documento.php';

# Crear el objeto Tipos_documento
$obj = new Tipos_documento();

# Establecer la clave primaria para eliminar
$obj->setId($_POST['id']);

# Eliminar de la base de datos
$obj->eliminar();

# Redirigir al listado
header("Location: ../../l_tipos_documento.php");
?>