<?php
require_once '../../config.php';
require_once INFORMACION_PATH . 'datos.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'ID de usuario requerido'
        ]);
        exit;
    }
    
    $resultado = UsuarioManager::actualizar($_POST['id'], $_POST);
    echo json_encode($resultado);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?>