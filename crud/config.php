<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', __DIR__ . '/');
define('PRIVATE_PATH', ROOT_PATH.'private/');
define('PLANTILLAS_PATH', PRIVATE_PATH.'plantilla/');
define('MODALES_PATH', PRIVATE_PATH.'modales/');
define('ACCIONES_PATH', PRIVATE_PATH.'procesos/');
define('INFORMACION_PATH', PRIVATE_PATH.'informacion/');

class Template {
    public static function renderHeader($title = 'CRUD DataTable - Gestión de Usuarios') {
        include PLANTILLAS_PATH . 'header.php';
    }
    
    public static function renderFooter() {
        include PLANTILLAS_PATH . 'footer.php';
    }
}
?>

