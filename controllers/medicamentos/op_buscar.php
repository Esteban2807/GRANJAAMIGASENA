<?php
require_once '../../config/seguridad.php';
verificarSesion();

header('Content-Type: application/json');

include_once '../../class/medicamentos.php';

$medicamentos = new medicamentos();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $medicamentos->buscar($query);

echo json_encode([
    'success' => true,
    'data' => $resultados
]);
