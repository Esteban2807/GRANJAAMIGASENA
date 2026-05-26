<?php
require_once '../../config/seguridad.php';
verificarSesion();
verificarRol([1]);

header('Content-Type: application/json');

include_once '../../class/usuarios.php';

$usuarios = new Usuarios();
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($query)) {
    echo json_encode([
        'success' => false,
        'message' => 'Consulta vacía'
    ]);
    exit;
}

$resultados = $usuarios->buscar($query);

echo json_encode([
    'success' => true,
    'data' => $resultados
]);
