<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Gestión de Usuarios'; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="private/disenos/css/custom.css">
    <script>
        const ROUTES = {
            datos: 'private/informacion/datos.php',
            agregar: 'private/procesos/agregar.php',
            modificar: 'private/procesos/modificar.php',
            eliminar: 'private/procesos/eliminar.php',
            reiniciar: 'private/procesos/reiniciar.php'
        };

        function resetData() {
            Swal.fire({
                title: '¿Reiniciar datos?',
                text: 'Esto restaurará todos los datos a su estado original y se perderán los cambios realizados.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, reiniciar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: ROUTES.reiniciar,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Datos reiniciados!',
                                    text: 'Los datos han sido restaurados correctamente',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                if (typeof table !== 'undefined' && table) {
                                    table.ajax.reload();
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message || 'Error al reiniciar datos'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error de conexión'
                            });
                        }
                    });
                }
            });
        }
    </script>
    <script src="private/disenos/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="bg-light min-vh-100" style="background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 50%, #e8eaf6 100%);">

    <header class="bg-primary shadow-lg border-bottom border-primary border-4">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center py-4">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle me-4 shadow">
                        <i class="bi bi-people-fill fs-2 text-white"></i>
                    </div>
                    <div>
                        <h1 class="h2 fw-bold text-white mb-1">Gestión de Usuarios</h1>
                        <p class="text-white-50 small mb-0 fw-medium">Sistema de administración integral</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button onclick="resetData()" class="btn btn-outline-light btn-sm shadow-sm" title="Reiniciar datos a valores originales">
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        Reiniciar Datos
                    </button>
                    <div class="d-none d-sm-block">
                        <span class="badge bg-white bg-opacity-25 text-white border border-white border-opacity-25 px-3 py-2">
                            <i class="bi bi-shield-check me-1"></i>
                            Panel de Administración
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>