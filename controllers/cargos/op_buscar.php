<?php
require_once '../../config/seguridad.php';
verificarSesion();

header('Content-Type: application/json');

include_once '../../class/cargos.php';

$cargos = new cargos();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $cargos->buscar($query);

echo json_encode([
    'success' => true,
    'data' => $resultados,
    'acciones' => in_array($_SESSION['rol_id'], [1])
]);
