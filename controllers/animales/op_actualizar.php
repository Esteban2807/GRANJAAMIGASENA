<?php
require_once __DIR__ . '/../../config/seguridad.php';
verificarSesion();
include '../../class/tipos_documento.php';
include '../../class/animales.php';

$obj = new Animales();
$obj->setId($_POST['id']);
$obj->consultar();
$obj->setNombre($_POST['nombre']);
$obj->setIdEspecie($_POST['id_especie']);
$obj->setIdRaza($_POST['id_raza']);
$obj->setIdPadre($_POST['id_padre']);
$obj->setIdMadre($_POST['id_madre']);
$obj->setObservaciones($_POST['observaciones']);
$obj->setChapeta($_POST['chapeta']);        // ← agregar
$obj->setSexo($_POST['sexo']);              // ← agregar
$obj->setFechaNacimiento($_POST['fecha_nacimiento']); // ← agregar

$exito = $obj->actualizar();
if ($exito) {
    $_SESSION['flash'] = ['tipo' => 'success', 'mensaje' => 'Animal actualizado(a) correctamente.'];
} else {
    $_SESSION['flash'] = ['tipo' => 'danger', 'mensaje' => 'Error al actualizar animal. Inténtelo de nuevo.'];
}
session_write_close();
header("Location: ../../l_animales.php");
exit;
?>
