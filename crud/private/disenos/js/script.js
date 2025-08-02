let table;
        let userIdToDelete = null;

        $(document).ready(function() {
            table = $('#usersTable').DataTable({
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": ROUTES.datos,
                    "type": "GET"
                },
                "dom": 'Bfrtip',
                "fixedHeader": true,
                "scrollY": "60vh",
                "scrollCollapse": true,
                "buttons": [{
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel mr-2"></i>Excel',
                        className: 'buttons-excel',
                        title: 'Usuarios - ' + new Date().toLocaleDateString('es-ES'),
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
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
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths = ['8%', '30%', '25%', '15%', '10%', '12%'];
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
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                ],
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row) {
                            return `<span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-bold rounded-full shadow-sm">${data}</span>`;
                        }
                    },
                    {
                        "data": "nombre",
                        "render": function(data, type, row) {
                            return `<div class="text-sm font-semibold text-gray-900">${data}</div>`;
                        }
                    },
                    {
                        "data": "email",
                        "render": function(data, type, row) {
                            return `<span class="text-sm text-gray-900 hover:text-blue-600 cursor-pointer">${data}</span>`;
                        }
                    },
                    {
                        "data": "telefono",
                        "render": function(data, type, row) {
                            return `<span class="text-sm text-gray-900">${data}</span>`;
                        }
                    },
                    {
                        "data": "estado",
                        "render": function(data, type, row) {
                            if (data == 1) {
                                return '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300 shadow-sm">Activo</span>';
                            } else {
                                return '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300 shadow-sm">Inactivo</span>';
                            }
                        }
                    },
                    {
                        "data": "fecha_registro",
                        "render": function(data, type, row) {
                            const fecha = new Date(data);
                            const fechaFormateada = fecha.toLocaleDateString('es-ES', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            });
                            const horaFormateada = fecha.toLocaleTimeString('es-ES', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            return `<div class="text-sm">
                                        <div class="text-gray-900 font-medium">${fechaFormateada}</div>
                                        <div class="text-gray-500 text-xs">${horaFormateada}</div>
                                    </div>`;
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return `
                                <div class="flex items-center justify-center space-x-3">
                                    <button onclick="editUser(${row.id})" class="group inline-flex items-center justify-center w-9 h-9 text-blue-700 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-lg transition-all duration-200 border border-blue-200 hover:border-blue-300 shadow-sm hover:shadow-md" title="Editar usuario">
                                        <i class="bi bi-pencil-square text-sm group-hover:scale-110 transition-transform"></i>
                                    </button>
                                    <button onclick="deleteUser(${row.id}, '${row.nombre}', '${row.email}')" class="group inline-flex items-center justify-center w-9 h-9 text-red-700 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 rounded-lg transition-all duration-200 border border-red-200 hover:border-red-300 shadow-sm hover:shadow-md" title="Eliminar usuario">
                                        <i class="bi bi-trash3 text-sm group-hover:scale-110 transition-transform"></i>
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
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Todos"]
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
                    url: ROUTES.agregar,
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
                    url: ROUTES.modificar,
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
                url: ROUTES.datos,
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
                    url: ROUTES.eliminar,
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