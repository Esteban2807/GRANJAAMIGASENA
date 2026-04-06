<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
# Incluir la clase Tipos_documento
include '../../class/tipos_documento.php';
include '../../class/animales.php';

# Crear el objeto Animales
$obj = new Animales();

# Establecer la clave primaria para consultar
$obj->setId($_POST['id']);

# Consultar el registro existente
$obj->consultar();

# Establecer los nuevos valores
$obj->setNombre($_POST['nombre']);
$obj->setIdEspecie($_POST['id_especie']);
$obj->setIdRaza($_POST['id_raza']);
$obj->setIdPadre($_POST['id_padre']);
$obj->setIdMadre($_POST['id_madre']);
$obj->setObservaciones($_POST['observaciones']);
$obj->setChapeta($_POST['chapeta']);        // ← agregar
$obj->setSexo($_POST['sexo']);              // ← agregar
$obj->setFechaNacimiento($_POST['fecha_nacimiento']); // ← agregar

# Actualizar en la base de datos
$obj->actualizar();
# Redirigir al listado de Animales
header("Location: ../../l_animales.php");
?>
