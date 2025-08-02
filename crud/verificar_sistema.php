<?php
if (file_exists('config.php')) {
    require_once 'config.php';
    
    $constantes = ['ROOT_PATH', 'PRIVATE_PATH', 'PLANTILLAS_PATH', 'MODALES_PATH', 'ACCIONES_PATH', 'INFORMACION_PATH'];
    foreach ($constantes as $const) {
        if (!defined($const)) {
        }
    }
}

$archivos_criticos = [
    'index.php',
    'private/plantilla/header.php',
    'private/plantilla/footer.php',
    'private/informacion/datos.php',
    'private/procesos/mostrar.php',
    'private/procesos/agregar.php',
    'private/procesos/modificar.php',
    'private/procesos/eliminar.php',
    'private/disenos/js/script.js',
    'private/disenos/css/custom.css'
];

foreach ($archivos_criticos as $archivo) {
    if (!file_exists($archivo)) {
    }
}

if (!is_readable('private/informacion/datos.php')) {
}

try {
    if (defined('INFORMACION_PATH')) {
        require_once INFORMACION_PATH . 'datos.php';
        $usuarios = UsuarioManager::obtenerTodos();
        
        if (!empty($usuarios)) {
            $primer_usuario = $usuarios[0];
        }
    }
} catch (Exception $e) {
}

if (!isset($_SESSION['usuarios'])) {
}
?>