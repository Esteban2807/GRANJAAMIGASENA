<?php
require_once '../../config/seguridad.php';
verificarSesion();

header('Content-Type: application/json');

include_once '../../class/alimentaciones.php';

$alimentaciones = new alimentaciones();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $alimentaciones->buscar($query);

echo json_encode([
    'success' => true,
    'data' => $resultados,
    'acciones' => in_array($_SESSION['rol_id'], [1,5])
]);
