<?php
require_once '../../config/seguridad.php';
verificarSesion();

header('Content-Type: application/json');

include_once '../../class/atenciones_veterinarias.php';

$atenciones_veterinarias = new atenciones_veterinarias();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $atenciones_veterinarias->buscar($query);

echo json_encode([
    'success' => true,
    'data' => $resultados
]);
