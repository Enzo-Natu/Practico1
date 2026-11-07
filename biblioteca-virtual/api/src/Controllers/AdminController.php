<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'Administrador') {
    http_response_code(401);
    echo json_encode(['error' => 'Acceso no autorizado']);
    exit();
}
require_once __DIR__ . '/../Models/AdminModel.php';

try {
    $model = new AdminModel();
    $stats = $model->obtenerEstadisticas();
    echo json_encode([
        'status' => 'success',
        'usuario' => [
            'nombre' => $_SESSION['nombre'],
            'email' => $_SESSION['email'],
            'rol' => $_SESSION['rol']
        ],
        'stats' => $stats
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>