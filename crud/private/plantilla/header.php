<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Gestión de Usuarios'; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
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

    <style>
        /* Contenedor principal de DataTables */
        .dataTables_wrapper {
            @apply w-full;
        }

        /* Estilos para el selector de longitud */
        .dataTables_length {
            @apply mb-4;
        }

        .dataTables_length select {
            @apply px-4 py-2 border-2 border-gray-200 rounded-lg text-sm bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 shadow-sm;
        }

        .dataTables_length label {
            @apply text-sm font-medium text-gray-700 flex items-center gap-2;
        }

        /* Estilos para el filtro de búsqueda */
        .dataTables_filter {
            @apply mb-4;
        }

        .dataTables_filter input {
            @apply px-4 py-2 border-2 border-gray-200 rounded-lg text-sm ml-2 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 shadow-sm placeholder-gray-400;
        }

        .dataTables_filter label {
            @apply text-sm font-medium text-gray-700 flex items-center;
        }

        /* Información de registros */
        .dataTables_info {
            @apply text-sm text-gray-600 mt-6 font-medium bg-gray-50 px-4 py-2 rounded-lg border border-gray-200;
        }

        /* Paginación */
        .dataTables_paginate {
            @apply mt-6 flex justify-center;
        }

        .dataTables_paginate .paginate_button {
            @apply px-4 py-2 mx-1 border-2 border-gray-200 rounded-lg text-sm font-medium hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 hover:border-blue-300 transition-all duration-200 shadow-sm;
        }

        .dataTables_paginate .paginate_button.current {
            @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white border-blue-500 shadow-md hover:from-blue-600 hover:to-blue-700;
        }

        .dataTables_paginate .paginate_button.disabled {
            @apply opacity-50 cursor-not-allowed hover:bg-white hover:border-gray-200;
        }

        /* Estilos de la tabla */
        table.dataTable {
            @apply w-full border-collapse bg-white rounded-lg overflow-hidden shadow-lg;
        }

        table.dataTable thead th {
            @apply bg-gradient-to-r from-blue-50 to-indigo-50 font-bold text-gray-800 border-b-2 border-blue-200 text-left sticky top-0 z-10;
            position: sticky !important;
            top: 0 !important;
        }

        table.dataTable tbody td {
            @apply px-6 py-4 border-b border-gray-100 text-sm;
        }

        table.dataTable tbody tr {
            @apply transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-25 hover:to-indigo-25;
        }

        table.dataTable tbody tr:nth-child(even) {
            @apply bg-gray-25;
        }

        table.dataTable tbody tr:hover {
            @apply bg-gradient-to-r from-blue-50 to-indigo-50 shadow-sm transform scale-[1.01];
        }

        /* Botones de exportación */
        .dt-buttons {
            @apply mb-6 flex flex-wrap gap-3;
        }

        .dt-button {
            @apply px-6 py-3 text-white text-sm font-semibold rounded-lg transition-all duration-200 inline-flex items-center shadow-md hover:shadow-lg transform hover:scale-105 border-2;
        }

        .dt-button:hover {
            @apply transform scale-105 shadow-lg;
        }

        .buttons-excel {
            @apply bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 border-green-500;
        }

        .buttons-pdf {
            @apply bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 border-red-500;
        }

        .buttons-print {
            @apply bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 border-blue-500;
        }

        /* FixedHeader específico */
        .fixedHeader-floating {
            @apply shadow-xl border-b-4 border-blue-300;
        }

        .fixedHeader-locked {
            @apply shadow-xl;
        }

        /* Contenedor con scroll personalizado */
        .dataTables_scrollBody {
            @apply border border-gray-200 rounded-lg;
        }

        .dataTables_scrollBody::-webkit-scrollbar {
            @apply w-2 h-2;
        }

        .dataTables_scrollBody::-webkit-scrollbar-track {
            @apply bg-gray-100 rounded-full;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb {
            @apply bg-gradient-to-r from-blue-400 to-blue-500 rounded-full hover:from-blue-500 hover:to-blue-600;
        }

        /* Animaciones adicionales */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dataTables_wrapper {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Mejoras para responsive */
        @media (max-width: 768px) {
            .dt-buttons {
                @apply flex-col;
            }
            
            .dt-button {
                @apply w-full justify-center;
            }
            
            table.dataTable thead th,
            table.dataTable tbody td {
                @apply px-3 py-2 text-xs;
            }
        }

        /* Estados de carga */
        .dataTables_processing {
            @apply bg-white bg-opacity-90 text-gray-700 font-semibold text-lg p-4 rounded-lg shadow-lg border-2 border-blue-200;
        }

        /* Colores personalizados para Tailwind */
        .bg-gray-25 {
            background-color: #fafafa;
        }
        
        .bg-blue-25 {
            background-color: #f8faff;
        }
        
        .hover\:from-blue-25:hover {
            --tw-gradient-from: #f8faff;
        }
        
        .hover\:to-indigo-25:hover {
            --tw-gradient-to: #f8faff;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100 min-h-screen">

    <header class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 shadow-xl border-b-4 border-blue-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4 shadow-lg">
                        <i class="bi bi-people-fill text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight">Gestión de Usuarios</h1>
                        <p class="text-blue-100 text-sm font-medium mt-1">Sistema de administración integral</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="resetData()" class="group bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-2 rounded-lg border border-white border-opacity-30 hover:border-opacity-50 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105" title="Reiniciar datos a valores originales">
                        <i class="bi bi-arrow-clockwise mr-2 group-hover:rotate-180 transition-transform duration-300"></i>
                        Reiniciar Datos
                    </button>
                    <div class="hidden sm:block">
                        <span class="text-blue-100 text-sm font-medium bg-white bg-opacity-10 px-3 py-1 rounded-full border border-white border-opacity-20">
                            <i class="bi bi-shield-check mr-1"></i>
                            Panel de Administración
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>