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