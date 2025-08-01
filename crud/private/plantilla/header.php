<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'CRUD DataTable - Gestión de Usuarios'; ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- CUSTOM JS -->
    <script src="private/disenos/js/script.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .dataTables_wrapper {
            @apply w-full;
        }

        .dataTables_length select {
            @apply px-3 py-1 border border-gray-300 rounded-md text-sm;
        }

        .dataTables_filter input {
            @apply px-3 py-2 border border-gray-300 rounded-md text-sm ml-2;
        }

        .dataTables_info {
            @apply text-sm text-gray-600 mt-4;
        }

        .dataTables_paginate {
            @apply mt-4;
        }

        .dataTables_paginate .paginate_button {
            @apply px-3 py-1 mx-1 border border-gray-300 rounded text-sm hover:bg-gray-100;
        }

        .dataTables_paginate .paginate_button.current {
            @apply bg-blue-500 text-white border-blue-500;
        }

        table.dataTable thead th {
            @apply bg-gray-50 font-semibold text-gray-700 border-b-2 border-gray-200;
        }

        table.dataTable tbody tr:hover {
            @apply bg-gray-50;
        }

        .dt-buttons {
            @apply mb-4 flex flex-wrap gap-2;
        }

        .dt-button {
            @apply px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors duration-200 inline-flex items-center;
        }

        .dt-button:hover {
            @apply bg-gray-700;
        }

        .buttons-excel {
            @apply bg-green-600 hover:bg-green-700;
        }

        .buttons-pdf {
            @apply bg-red-600 hover:bg-red-700;
        }

        .buttons-print {
            @apply bg-blue-600 hover:bg-blue-700;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="bi bi-people-fill text-2xl text-blue-600 mr-3"></i>
                    <h1 class="text-2xl font-bold text-gray-900">Gestión de Usuarios</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Panel de Administración</span>
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="bi bi-person-fill text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>