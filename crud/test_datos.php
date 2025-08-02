<?php
require_once 'config.php';
require_once INFORMACION_PATH . 'datos.php';

header('Content-Type: application/json');

try {
    $usuarios = UsuarioManager::obtenerTodos();
    echo json_encode([
        'success' => true,
        'message' => 'Datos cargados correctamente',
        'count' => count($usuarios),
        'data' => $usuarios
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>