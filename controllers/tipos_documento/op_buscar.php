<?php
require_once '../../config/seguridad.php';
verificarSesion();

header('Content-Type: application/json');

include_once '../../class/tipos_documento.php';

$tipos_documento = new Tipos_documento();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $tipos_documento->buscar($query);

echo json_encode([
    'success' => true,
    'data' => $resultados
]);
