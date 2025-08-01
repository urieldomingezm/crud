<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DataTable - Gestión de Usuarios</title>

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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Custom DataTable styles with Tailwind */
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

        /* Estilos para botones de exportación */
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


    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class="bi bi-people text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Usuarios</p>
                        <p class="text-2xl font-semibold text-gray-900" id="totalUsers">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="bi bi-person-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Activos</p>
                        <p class="text-2xl font-semibold text-gray-900" id="activeUsers">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100">
                        <i class="bi bi-person-dash text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Inactivos</p>
                        <p class="text-2xl font-semibold text-gray-900" id="inactiveUsers">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <i class="bi bi-calendar-plus text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Nuevos Hoy</p>
                        <p class="text-2xl font-semibold text-gray-900" id="newToday">0</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-lg shadow">

            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Lista de Usuarios</h2>
                        <p class="mt-1 text-sm text-gray-600">Gestiona todos los usuarios del sistema</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <button onclick="openModal('registrar')" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                            <i class="bi bi-plus-circle mr-2"></i>
                            Nuevo Usuario
                        </button>
                    </div>
                </div>
            </div>


            <div class="px-6 py-4">
                <div class="overflow-x-auto">
                    <table id="usersTable" class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modales -->
    <?php include MODALES_PATH . 'modal_registrar.php'; ?>
    <?php include MODALES_PATH . 'modal_editar.php'; ?>
    <?php include MODALES_PATH . 'modal_eliminar.php'; ?>

    <script>
        let table;
        let userIdToDelete = null;

        $(document).ready(function() {
            table = $('#usersTable').DataTable({
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "<?php echo INFORMACION_PATH; ?>datos.php",
                    "type": "GET"
                },
                "dom": 'Bfrtip',
                "buttons": [{
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel mr-2"></i>Excel',
                        className: 'buttons-excel',
                        title: 'Usuarios - ' + new Date().toLocaleDateString('es-ES'),
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-file-earmark-pdf mr-2"></i>PDF',
                        className: 'buttons-pdf',
                        title: 'Gestión de Usuarios',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6]
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths = ['10%', '25%', '25%', '15%', '10%', '15%'];
                            doc.styles.tableHeader.fontSize = 10;
                            doc.defaultStyle.fontSize = 8;
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer mr-2"></i>Imprimir',
                        className: 'buttons-print',
                        title: 'Gestión de Usuarios',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6]
                        }
                    }
                ],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "avatar",
                        "render": function(data, type, row) {
                            return `<div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">${row.nombre.charAt(0).toUpperCase()}</span>
                                    </div>`;
                        }
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "telefono"
                    },
                    {
                        "data": "estado",
                        "render": function(data, type, row) {
                            if (data == 1) {
                                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="bi bi-check-circle mr-1"></i>Activo</span>';
                            } else {
                                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"><i class="bi bi-x-circle mr-1"></i>Inactivo</span>';
                            }
                        }
                    },
                    {
                        "data": "fecha_registro",
                        "render": function(data, type, row) {
                            return new Date(data).toLocaleDateString('es-ES');
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return `
                                <div class="flex items-center justify-center space-x-2">
                                    <button onclick="editUser(${row.id})" class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 hover:bg-blue-200 rounded-md transition-colors duration-200" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button onclick="deleteUser(${row.id}, '${row.nombre}', '${row.email}')" class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 bg-red-100 hover:bg-red-200 rounded-md transition-colors duration-200" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
                },
                "responsive": true,
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "order": [
                    [0, "desc"]
                ],
                "drawCallback": function(settings) {
                    updateStats();
                }
            });

            setupForms();
        });


        function setupForms() {

            $('#formRegistrar').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '<?php echo ACCIONES_PATH; ?>agregar.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Usuario registrado correctamente',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            closeModal('registrar');
                            table.ajax.reload();
                            $('#formRegistrar')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Error al registrar usuario'
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
            });

            $('#formEditar').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '<?php echo ACCIONES_PATH; ?>modificar.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Usuario actualizado correctamente',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            closeModal('editar');
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Error al actualizar usuario'
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
            });
        }

        function openModal(type) {
            document.getElementById('modal' + type.charAt(0).toUpperCase() + type.slice(1)).classList.remove('hidden');
        }

        function closeModal(type) {
            document.getElementById('modal' + type.charAt(0).toUpperCase() + type.slice(1)).classList.add('hidden');
        }

        function editUser(id) {

            $.ajax({
                url: '<?php echo INFORMACION_PATH; ?>datos.php',
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const user = response.data;
                        $('#editId').val(user.id);
                        $('#editNombre').val(user.nombre);
                        $('#editEmail').val(user.email);
                        $('#editTelefono').val(user.telefono);
                        $('#editEstado').val(user.estado);
                        openModal('editar');
                    }
                }
            });
        }

        function deleteUser(id, nombre, email) {
            userIdToDelete = id;
            $('#deleteUserName').text(nombre);
            $('#deleteUserEmail').text(email);
            openModal('eliminar');
        }

        function confirmarEliminar() {
            if (userIdToDelete) {
                $.ajax({
                    url: '<?php echo ACCIONES_PATH; ?>eliminar.php',
                    type: 'POST',
                    data: {
                        id: userIdToDelete
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Usuario eliminado correctamente',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            closeModal('eliminar');
                            table.ajax.reload();
                            userIdToDelete = null;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Error al eliminar usuario'
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
        }

        function updateStats() {
            const data = table.data();
            const total = data.length;
            let active = 0;
            let inactive = 0;
            let newToday = 0;

            const today = new Date().toDateString();

            data.each(function(row) {
                if (row.estado == 1) active++;
                else inactive++;

                if (new Date(row.fecha_registro).toDateString() === today) {
                    newToday++;
                }
            });

            $('#totalUsers').text(total);
            $('#activeUsers').text(active);
            $('#inactiveUsers').text(inactive);
            $('#newToday').text(newToday);
        }

        window.onclick = function(event) {
            const modals = ['modalRegistrar', 'modalEditar', 'modalEliminar'];
            modals.forEach(function(modalId) {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>