<?php

// Root path definition
define('ROOT_PATH', __DIR__ . '/');

// Core directory paths
define('PRIVATE_PATH', ROOT_PATH.'private/');

// PLANTILLAS
define('PLANTILLAS_PATH', PRIVATE_PATH.'plantilla/');

// MODALES
define('MODALES_PATH', PRIVATE_PATH.'modales/');

// ACCIONES
define('ACCIONES_PATH', PRIVATE_PATH.'procesos/');

// INFORMACION
define('INFORMACION_PATH', PRIVATE_PATH.'informacion/');

// Template class
class Template {
    
    public static function renderHeader($title = 'CRUD DataTable - Gestión de Usuarios') {
        include PLANTILLAS_PATH . 'header.php';
    }
    
    public static function renderFooter() {
        include PLANTILLAS_PATH . 'footer.php';
    }
}
?>

