# Sistema CRUD de Gestión de Usuarios

Un sistema web completo para la gestión de usuarios desarrollado en PHP con una interfaz moderna y responsiva. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) de manera intuitiva y eficiente.

## Características Principales

- **Interfaz moderna**: Diseño responsivo con Bootstrap 5 y iconos Bootstrap Icons
- **Dashboard informativo**: Tarjetas con estadísticas en tiempo real de usuarios
- **DataTables avanzado**: Tabla interactiva con búsqueda, paginación y exportación
- **Modales dinámicos**: Formularios emergentes para agregar y editar usuarios
- **Validación completa**: Validación tanto del lado cliente como servidor
- **Gestión de sesiones**: Almacenamiento temporal de datos en sesiones PHP
- **Alertas elegantes**: Notificaciones con SweetAlert2
- **Arquitectura MVC**: Separación clara de lógica, presentación y datos

## Estructura del Proyecto

```
crud/
├── index.php                 # Página principal con dashboard
├── config.php               # Configuración y constantes del sistema
├── sql_referencias.php      # Consultas SQL de referencia
├── test_datos.php          # Endpoint para pruebas de datos
├── verificar_sistema.php   # Verificación de integridad del sistema
├── .htaccess               # Configuración Apache
└── private/                # Carpeta protegida
    ├── .htaccess          # Protección adicional
    ├── plantilla/         # Templates del sistema
    │   ├── header.php     # Cabecera común
    │   └── footer.php     # Pie de página común
    ├── modales/           # Ventanas modales
    │   ├── modal_registrar.php
    │   ├── modal_editar.php
    │   └── modal_eliminar.php
    ├── procesos/          # Lógica de negocio
    │   ├── mostrar.php    # Obtener usuarios
    │   ├── agregar.php    # Crear usuario
    │   ├── modificar.php  # Actualizar usuario
    │   ├── eliminar.php   # Eliminar usuario
    │   └── reiniciar.php  # Restaurar datos
    ├── informacion/       # Gestión de datos
    │   └── datos.php      # Clase UsuarioManager
    └── disenos/           # Recursos estáticos
        ├── css/
        │   └── custom.css # Estilos personalizados
        └── js/
            └── script.js  # JavaScript personalizado
```

## Funcionalidades

### Dashboard Principal
- **Estadísticas en tiempo real**: Total de usuarios, activos, inactivos y nuevos registros del día
- **Tarjetas informativas**: Diseño visual atractivo con gradientes y iconos
- **Tabla interactiva**: Lista completa de usuarios con funciones avanzadas

### Gestión de Usuarios
- **Agregar usuarios**: Formulario modal con validación completa
- **Editar usuarios**: Modificación de datos existentes
- **Eliminar usuarios**: Confirmación de seguridad antes de eliminar
- **Cambio de estado**: Activar/desactivar usuarios
- **Búsqueda avanzada**: Filtrado en tiempo real por cualquier campo

### Características Técnicas
- **Validación de email**: Prevención de duplicados
- **Campos obligatorios**: Nombre y email requeridos
- **Formato de teléfono**: Soporte para números internacionales
- **Fechas automáticas**: Registro de fecha de creación
- **Estados de usuario**: Sistema binario activo/inactivo

## Tecnologías Utilizadas

### Frontend
- **Bootstrap 5.3.2**: Framework CSS responsivo
- **Bootstrap Icons 1.11.2**: Iconografía moderna
- **jQuery 3.7.1**: Manipulación DOM y AJAX
- **DataTables 1.13.7**: Tablas interactivas avanzadas
- **SweetAlert2**: Alertas y confirmaciones elegantes

### Backend
- **PHP 7.4+**: Lenguaje de programación principal
- **Sesiones PHP**: Almacenamiento temporal de datos
- **JSON**: Intercambio de datos entre frontend y backend
- **Apache**: Servidor web con configuración .htaccess

### Características de Seguridad
- **Protección de carpetas**: Archivos privados no accesibles directamente
- **Validación de entrada**: Sanitización de datos del usuario
- **Headers CORS**: Configuración de acceso entre dominios
- **Gestión de errores**: Manejo controlado de excepciones

## Instalación y Configuración

### Requisitos
- Servidor web Apache con mod_rewrite
- PHP 7.4 o superior
- Navegador web moderno

### Pasos de Instalación
1. Clonar o descargar el proyecto
2. Colocar la carpeta `crud` en el directorio del servidor web
3. Asegurar que Apache tenga mod_rewrite habilitado
4. Verificar permisos de escritura en la carpeta del proyecto
5. Acceder a `http://localhost/crud/` en el navegador

### Configuración Inicial
El sistema incluye datos de prueba predefinidos con 11 usuarios de ejemplo. Los datos se almacenan en sesiones PHP y se reinician automáticamente en cada nueva sesión.

## Uso del Sistema

### Navegación Principal
- **Dashboard**: Vista general con estadísticas
- **Tabla de usuarios**: Lista completa con opciones de gestión
- **Botón "Agregar Usuario"**: Abre modal de registro
- **Acciones por fila**: Editar y eliminar usuarios individuales

### Operaciones CRUD
1. **Crear**: Clic en "Agregar Nuevo Usuario" → Completar formulario → Guardar
2. **Leer**: Los datos se muestran automáticamente en la tabla principal
3. **Actualizar**: Clic en icono de edición → Modificar datos → Guardar cambios
4. **Eliminar**: Clic en icono de eliminación → Confirmar acción

### Funciones Adicionales
- **Exportar datos**: PDF, Excel, CSV desde la tabla
- **Imprimir**: Función de impresión integrada
- **Reiniciar datos**: Restaurar información original
- **Búsqueda global**: Filtro en tiempo real por cualquier campo

## Arquitectura del Código

### Patrón de Diseño
El proyecto sigue una arquitectura modular con separación de responsabilidades:

- **Presentación**: Templates en `plantilla/`
- **Lógica de negocio**: Procesos en `procesos/`
- **Datos**: Gestión en `informacion/`
- **Configuración**: Constantes centralizadas en `config.php`

### Clase Principal: UsuarioManager
```php
class UsuarioManager {
    public static function obtenerTodos()      // Listar usuarios
    public static function obtenerPorId($id)  // Obtener usuario específico
    public static function agregar($datos)    // Crear nuevo usuario
    public static function actualizar($id, $datos) // Modificar usuario
    public static function eliminar($id)      // Eliminar usuario
}
```

### API Endpoints
- `GET private/informacion/datos.php` - Obtener usuarios
- `POST private/procesos/agregar.php` - Crear usuario
- `POST private/procesos/modificar.php` - Actualizar usuario
- `POST private/procesos/eliminar.php` - Eliminar usuario
- `POST private/procesos/reiniciar.php` - Restaurar datos

## Personalización

### Estilos CSS
Los estilos personalizados se encuentran en `private/disenos/css/custom.css` y pueden modificarse para cambiar:
- Colores del tema
- Espaciado y tipografía
- Efectos hover y transiciones
- Diseño responsivo

### JavaScript
La lógica del frontend está en `private/disenos/js/script.js` e incluye:
- Inicialización de DataTables
- Manejo de formularios AJAX
- Validaciones del lado cliente
- Efectos visuales y animaciones

## Datos de Prueba

El sistema incluye 11 usuarios de ejemplo con información realista:
- Nombres completos en español
- Emails corporativos
- Teléfonos con formato mexicano
- Estados mixtos (activos/inactivos)
- Fechas de registro variadas

## Autor

**Uriel Medina** - Desarrollador Full Stack

---

*Sistema desarrollado con fines educativos y de demostración. Ideal para aprender conceptos de desarrollo web, CRUD operations y diseño de interfaces modernas.*
