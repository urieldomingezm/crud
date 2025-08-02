<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config.php';
require_once INFORMACION_PATH . 'datos.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'ID de usuario requerido'
        ]);
        exit;
    }
    
    $resultado = UsuarioManager::eliminar($_POST['id']);
    echo json_encode($resultado);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?>