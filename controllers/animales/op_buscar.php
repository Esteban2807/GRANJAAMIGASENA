<?php
require_once '../../config/seguridad.php';
verificarSesion();

header('Content-Type: application/json');

include_once '../../class/animales.php';

$animales = new Animales();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $animales->buscar($query);

$puedeEditar   = in_array($_SESSION['rol_id'], [1,2,3,5]);
$puedeEliminar = in_array($_SESSION['rol_id'], [1,2,5]);

echo json_encode([
    'success' => true,
    'data' => $resultados,
    'puedeEditar' => $puedeEditar,
    'puedeEliminar' => $puedeEliminar
]);


