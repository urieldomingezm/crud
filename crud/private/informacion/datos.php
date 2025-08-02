<?php
require_once '../../config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class UsuarioManager
{
    private static $initialized = false;

    public static function init()
    {
        if (!self::$initialized) {
            if (!isset($_SESSION['usuarios'])) {
                $_SESSION['usuarios'] = [
                    [
                        'id' => 1,
                        'nombre' => 'Juan Carlos Pérez Mendoza',
                        'email' => 'juan.perez@corporativo.com',
                        'telefono' => '+52 55 1234-5678',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-15 10:30:00'
                    ],
                    [
                        'id' => 2,
                        'nombre' => 'María Elena García Rodríguez',
                        'email' => 'maria.garcia@empresa.mx',
                        'telefono' => '+52 33 9876-5432',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-16 14:20:00'
                    ],
                    [
                        'id' => 3,
                        'nombre' => 'Carlos Alberto López Hernández',
                        'email' => 'carlos.lopez@tecnologia.com',
                        'telefono' => '+52 81 5555-1234',
                        'estado' => 0,
                        'fecha_registro' => '2024-01-17 09:15:00'
                    ],
                    [
                        'id' => 4,
                        'nombre' => 'Ana Sofía Martínez Jiménez',
                        'email' => 'ana.martinez@innovacion.mx',
                        'telefono' => '+52 55 7777-8888',
                        'estado' => 1,
                        'fecha_registro' => date('Y-m-d H:i:s')
                    ],
                    [
                        'id' => 5,
                        'nombre' => 'Pedro Antonio Rodríguez Silva',
                        'email' => 'pedro.rodriguez@desarrollo.com',
                        'telefono' => '+52 222 444-6666',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-18 16:45:00'
                    ],
                    [
                        'id' => 6,
                        'nombre' => 'Laura Beatriz Fernández Castro',
                        'email' => 'laura.fernandez@marketing.mx',
                        'telefono' => '+52 55 3333-4444',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-19 11:30:00'
                    ],
                    [
                        'id' => 7,
                        'nombre' => 'Roberto Miguel Sánchez Torres',
                        'email' => 'roberto.sanchez@ventas.com',
                        'telefono' => '+52 33 2222-1111',
                        'estado' => 0,
                        'fecha_registro' => '2024-01-20 08:45:00'
                    ],
                    [
                        'id' => 8,
                        'nombre' => 'Carmen Lucía Morales Vega',
                        'email' => 'carmen.morales@recursos.mx',
                        'telefono' => '+52 81 9999-0000',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-21 15:20:00'
                    ],
                    [
                        'id' => 9,
                        'nombre' => 'Diego Alejandro Ruiz Mendez',
                        'email' => 'diego.ruiz@operaciones.com',
                        'telefono' => '+52 55 6666-7777',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-22 13:10:00'
                    ],
                    [
                        'id' => 10,
                        'nombre' => 'Valeria Isabel Herrera Campos',
                        'email' => 'valeria.herrera@finanzas.mx',
                        'telefono' => '+52 222 8888-9999',
                        'estado' => 0,
                        'fecha_registro' => '2024-01-23 10:05:00'
                    ],
                    [
                        'id' => 11,
                        'nombre' => 'Andrés Fernando Vargas Delgado',
                        'email' => 'andres.vargas@logistica.com',
                        'telefono' => '+52 33 1111-2222',
                        'estado' => 1,
                        'fecha_registro' => '2024-01-24 17:30:00'
                    ]
                ];
                $_SESSION['nextId'] = 12;
            }
            self::$initialized = true;
        }
    }

    public static function obtenerTodos()
    {
        self::init();
        return $_SESSION['usuarios'];
    }

    public static function obtenerPorId($id)
    {
        self::init();
        foreach ($_SESSION['usuarios'] as $usuario) {
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

        foreach ($_SESSION['usuarios'] as $usuario) {
            if ($usuario['email'] === $datos['email']) {
                return [
                    'success' => false,
                    'message' => 'El email ya está registrado'
                ];
            }
        }

        $nuevoUsuario = [
            'id' => $_SESSION['nextId']++,
            'nombre' => trim($datos['nombre']),
            'email' => trim($datos['email']),
            'telefono' => trim($datos['telefono'] ?? ''),
            'estado' => (int)($datos['estado'] ?? 1),
            'fecha_registro' => date('Y-m-d H:i:s')
        ];

        $_SESSION['usuarios'][] = $nuevoUsuario;

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
        foreach ($_SESSION['usuarios'] as $key => $usuario) {
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


        foreach ($_SESSION['usuarios'] as $usuario) {
            if ($usuario['email'] === $datos['email'] && $usuario['id'] != $id) {
                return [
                    'success' => false,
                    'message' => 'El email ya está registrado por otro usuario'
                ];
            }
        }

        $_SESSION['usuarios'][$indice]['nombre'] = trim($datos['nombre']);
        $_SESSION['usuarios'][$indice]['email'] = trim($datos['email']);
        $_SESSION['usuarios'][$indice]['telefono'] = trim($datos['telefono'] ?? '');
        $_SESSION['usuarios'][$indice]['estado'] = (int)($datos['estado'] ?? 1);

        return [
            'success' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $_SESSION['usuarios'][$indice]
        ];
    }

  
    public static function eliminar($id)
    {
        self::init();

        foreach ($_SESSION['usuarios'] as $key => $usuario) {
            if ($usuario['id'] == $id) {
                unset($_SESSION['usuarios'][$key]);
                $_SESSION['usuarios'] = array_values($_SESSION['usuarios']);

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


if (basename($_SERVER['PHP_SELF']) === 'datos.php') {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    $method = $_SERVER['REQUEST_METHOD'];

    try {
        switch ($method) {
            case 'GET':
                if (isset($_GET['id'])) {
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
                    $usuarios = UsuarioManager::obtenerTodos();
                    echo json_encode([
                        'success' => true,
                        'data' => $usuarios
                    ]);
                }
                break;

            case 'OPTIONS':
                http_response_code(200);
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
    exit;
}
