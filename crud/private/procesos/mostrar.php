<?php
require_once '../../config.php';
require_once INFORMACION_PATH . 'datos.php';

header('Content-Type: application/json');

try {
    $usuarios = UsuarioManager::obtenerTodos();
    echo json_encode([
        'success' => true,
        'data' => $usuarios
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener usuarios: ' . $e->getMessage()
    ]);
}
?>