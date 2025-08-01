<?php
require_once '../../config.php';
require_once INFORMACION_PATH . 'datos.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = UsuarioManager::agregar($_POST);
    echo json_encode($resultado);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?>