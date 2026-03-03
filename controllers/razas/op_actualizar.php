<?php
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
$obj->actualizar();

# Redirigir al listado de Razas
header("Location: ../../l_razas.php");
?>