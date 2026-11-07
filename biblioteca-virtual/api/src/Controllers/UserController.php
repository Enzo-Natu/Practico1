<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit();
}
if ($_SESSION['rol'] === 'Administrador') {
    echo json_encode(['redirect' => '../administrador/dashboard.html']);
    exit();
}
echo json_encode([
    'status' => 'success',
    'usuario' => [
        'nombre' => $_SESSION['nombre'],
        'email' => $_SESSION['email'],
        'rol' => $_SESSION['rol']
    ]
]);
?>