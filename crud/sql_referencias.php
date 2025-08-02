<?php

class SQLReferencias {
    
    // Consultas SELECT
    const OBTENER_TODOS_USUARIOS = "SELECT id, nombre, email, telefono, estado, fecha_registro FROM usuarios ORDER BY id DESC";
    
    const OBTENER_USUARIO_POR_ID = "SELECT id, nombre, email, telefono, estado, fecha_registro FROM usuarios WHERE id = ?";
    
    const VERIFICAR_EMAIL_EXISTENTE = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    
    const VERIFICAR_EMAIL_EXISTENTE_ACTUALIZAR = "SELECT COUNT(*) FROM usuarios WHERE email = ? AND id != ?";
    
    const CONTAR_USUARIOS_ACTIVOS = "SELECT COUNT(*) FROM usuarios WHERE estado = 1";
    
    const CONTAR_USUARIOS_INACTIVOS = "SELECT COUNT(*) FROM usuarios WHERE estado = 0";
    
    const CONTAR_USUARIOS_HOY = "SELECT COUNT(*) FROM usuarios WHERE DATE(fecha_registro) = CURDATE()";
    
    // Consultas INSERT
    const INSERTAR_USUARIO = "INSERT INTO usuarios (nombre, email, telefono, estado, fecha_registro) VALUES (?, ?, ?, ?, NOW())";
    
    // Consultas UPDATE
    const ACTUALIZAR_USUARIO = "UPDATE usuarios SET nombre = ?, email = ?, telefono = ?, estado = ? WHERE id = ?";
    
    const CAMBIAR_ESTADO_USUARIO = "UPDATE usuarios SET estado = ? WHERE id = ?";
    
    // Consultas DELETE
    const ELIMINAR_USUARIO = "DELETE FROM usuarios WHERE id = ?";
    
    const ELIMINAR_USUARIOS_INACTIVOS = "DELETE FROM usuarios WHERE estado = 0";
    
    // Estructura de tabla
    const CREAR_TABLA_USUARIOS = "
        CREATE TABLE usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            telefono VARCHAR(20),
            estado TINYINT(1) DEFAULT 1,
            fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ";
    
    // Índices
    const CREAR_INDICE_EMAIL = "CREATE INDEX idx_email ON usuarios(email)";
    const CREAR_INDICE_ESTADO = "CREATE INDEX idx_estado ON usuarios(estado)";
    const CREAR_INDICE_FECHA = "CREATE INDEX idx_fecha_registro ON usuarios(fecha_registro)";
}
?>