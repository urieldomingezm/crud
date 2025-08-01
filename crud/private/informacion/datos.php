<?php
require_once '../../config.php';

class UsuarioManager
{
    private static $usuarios = [];
    private static $nextId = 1;

    public static function init()
    {
        if (empty(self::$usuarios)) {
            self::$usuarios = [
                [
                    'id' => 1,
                    'nombre' => 'Juan Pérez',
                    'email' => 'juan@example.com',
                    'telefono' => '+1234567890',
                    'estado' => 1,
                    'fecha_registro' => '2024-01-15 10:30:00'
                ],
                [
                    'id' => 2,
                    'nombre' => 'María García',
                    'email' => 'maria@example.com',
                    'telefono' => '+1234567891',
                    'estado' => 1,
                    'fecha_registro' => '2024-01-16 14:20:00'
                ],
                [
                    'id' => 3,
                    'nombre' => 'Carlos López',
                    'email' => 'carlos@example.com',
                    'telefono' => '+1234567892',
                    'estado' => 0,
                    'fecha_registro' => '2024-01-17 09:15:00'
                ],
                [
                    'id' => 4,
                    'nombre' => 'Ana Martínez',
                    'email' => 'ana@example.com',
                    'telefono' => '+1234567893',
                    'estado' => 1,
                    'fecha_registro' => date('Y-m-d H:i:s') // Usuario de hoy
                ],
                [
                    'id' => 5,
                    'nombre' => 'Pedro Rodríguez',
                    'email' => 'pedro@example.com',
                    'telefono' => '+1234567894',
                    'estado' => 1,
                    'fecha_registro' => '2024-01-18 16:45:00'
                ]
            ];
            self::$nextId = 6;
        }
    }

    public static function obtenerTodos()
    {
        self::init();
        return self::$usuarios;
    }

    public static function obtenerPorId($id)
    {
        self::init();
        foreach (self::$usuarios as $usuario) {
            if ($usuario['id'] == $id) {
                return $usuario;
            }
        }
        return null;
    }

    public static function agregar($datos)
    {
        self::init();

        if (empty($datos['nombre']) || empty($datos['email'])) {
            return [
                'success' => false,
                'message' => 'Nombre y email son obligatorios'
            ];
        }

        foreach (self::$usuarios as $usuario) {
            if ($usuario['email'] === $datos['email']) {
                return [
                    'success' => false,
                    'message' => 'El email ya está registrado'
                ];
            }
        }

        $nuevoUsuario = [
            'id' => self::$nextId++,
            'nombre' => trim($datos['nombre']),
            'email' => trim($datos['email']),
            'telefono' => trim($datos['telefono'] ?? ''),
            'estado' => (int)($datos['estado'] ?? 1),
            'fecha_registro' => date('Y-m-d H:i:s')
        ];

        self::$usuarios[] = $nuevoUsuario;

        return [
            'success' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $nuevoUsuario
        ];
    }

    public static function actualizar($id, $datos)
    {
        self::init();

        if (empty($datos['nombre']) || empty($datos['email'])) {
            return [
                'success' => false,
                'message' => 'Nombre y email son obligatorios'
            ];
        }

        $indice = -1;
        foreach (self::$usuarios as $key => $usuario) {
            if ($usuario['id'] == $id) {
                $indice = $key;
                break;
            }
        }

        if ($indice === -1) {
            return [
                'success' => false,
                'message' => 'Usuario no encontrado'
            ];
        }

        foreach (self::$usuarios as $usuario) {
            if ($usuario['email'] === $datos['email'] && $usuario['id'] != $id) {
                return [
                    'success' => false,
                    'message' => 'El email ya está registrado por otro usuario'
                ];
            }
        }

        self::$usuarios[$indice]['nombre'] = trim($datos['nombre']);
        self::$usuarios[$indice]['email'] = trim($datos['email']);
        self::$usuarios[$indice]['telefono'] = trim($datos['telefono'] ?? '');
        self::$usuarios[$indice]['estado'] = (int)($datos['estado'] ?? 1);

        return [
            'success' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => self::$usuarios[$indice]
        ];
    }

    // Eliminar usuario
    public static function eliminar($id)
    {
        self::init();

        // Buscar y eliminar usuario
        foreach (self::$usuarios as $key => $usuario) {
            if ($usuario['id'] == $id) {
                unset(self::$usuarios[$key]);
                self::$usuarios = array_values(self::$usuarios); // Reindexar array

                return [
                    'success' => true,
                    'message' => 'Usuario eliminado correctamente'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Usuario no encontrado'
        ];
    }
}

// Solo ejecutar la lógica de manejo de peticiones si se accede directamente
if (basename($_SERVER['PHP_SELF']) === 'datos.php') {
    header('Content-Type: application/json');

    $method = $_SERVER['REQUEST_METHOD'];

    try {
        switch ($method) {
            case 'GET':
                if (isset($_GET['id'])) {
                    // Obtener usuario específico
                    $usuario = UsuarioManager::obtenerPorId($_GET['id']);
                    if ($usuario) {
                        echo json_encode([
                            'success' => true,
                            'data' => $usuario
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Usuario no encontrado'
                        ]);
                    }
                } else {
                    // Obtener todos los usuarios para DataTable
                    $usuarios = UsuarioManager::obtenerTodos();
                    echo json_encode([
                        'data' => $usuarios
                    ]);
                }
                break;

            default:
                echo json_encode([
                    'success' => false,
                    'message' => 'Método no permitido'
                ]);
                break;
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error interno: ' . $e->getMessage()
        ]);
    }
}
