<?php
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
$obj->actualizar();

# Redirigir al listado de Especies
header("Location: ../../l_especies.php");
?>