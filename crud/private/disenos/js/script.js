let table;
let userIdToDelete = null;

$(document).ready(function() {
    table = $('#usersTable').DataTable({
        "ajax": ROUTES.datos,
        "dom": '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"f><"col-sm-12 col-md-4"B>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "buttons": [
            { extend: 'excel', text: '<i class="bi bi-file-earmark-excel me-2"></i>Excel', className: 'buttons-excel' },
            { extend: 'pdf', text: '<i class="bi bi-file-earmark-pdf me-2"></i>PDF', className: 'buttons-pdf' },
            { extend: 'print', text: '<i class="bi bi-printer me-2"></i>Imprimir', className: 'buttons-print' }
        ],
        "info": true,
        "lengthChange": true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "columns": [
            { "data": "id", "render": (data) => `<span class="badge bg-primary">${data}</span>` },
            { "data": "nombre", "render": (data) => `<div class="fw-semibold">${data}</div>` },
            { "data": "email" },
            { "data": "telefono" },
            { "data": "estado", "render": (data) => data == 1 ? '<span class="badge status-active">Activo</span>' : '<span class="badge status-inactive">Inactivo</span>' },
            { "data": "fecha_registro", "render": (data) => new Date(data).toLocaleDateString('es-ES') },
            { "data": null, "render": (data, type, row) => `
                <div class="d-flex justify-content-center gap-1">
                    <button onclick="editUser(${row.id})" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                    <button onclick="deleteUser(${row.id}, '${row.nombre}', '${row.email}')" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3"></i></button>
                </div>` }
        ],
        "searching": true,
        "language": {
            "decimal": "",
            "emptyTable": "No hay datos disponibles en la tabla",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar la columna de manera ascendente",
                "sortDescending": ": activar para ordenar la columna de manera descendente"
            }
        },
        "pageLength": 10,
        "order": [[0, "desc"]],
        "drawCallback": function() {
            setTimeout(() => updateStats(), 100);
        }
    });
    setupForms();
    setupScrollButton();
    setupModalAccessibility();
});

function setupScrollButton() {
    $(window).scroll(function() {
        const scrollTop = $(this).scrollTop();
        if (scrollTop > 300) {
            $('#btnScrollTop').fadeIn();
        } else {
            $('#btnScrollTop').fadeOut();
        }
    });

    $('#btnScrollTop').click(function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });
}

function setupForms() {
    $('#formRegistrar').on('submit', function(e) {
        e.preventDefault();
        $.post(ROUTES.agregar, $(this).serialize(), function(response) {
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Éxito!', text: 'Usuario registrado correctamente', timer: 2000, showConfirmButton: false });
                bootstrap.Modal.getInstance(document.getElementById('modalRegistrar')).hide();
                table.ajax.reload();
                $('#formRegistrar')[0].reset();
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Error al registrar usuario' });
            }
        }, 'json').fail(() => Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión' }));
    });

    $('#formEditar').on('submit', function(e) {
        e.preventDefault();
        $.post(ROUTES.modificar, $(this).serialize(), function(response) {
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Éxito!', text: 'Usuario actualizado correctamente', timer: 2000, showConfirmButton: false });
                bootstrap.Modal.getInstance(document.getElementById('modalEditar')).hide();
                table.ajax.reload();
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Error al actualizar usuario' });
            }
        }, 'json').fail(() => Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión' }));
    });
}

function editUser(id) {
    $.get(ROUTES.datos, { id }, function(response) {
        if (response.success) {
            const user = response.data;
            $('#editId').val(user.id);
            $('#editNombre').val(user.nombre);
            $('#editEmail').val(user.email);
            $('#editTelefono').val(user.telefono);
            $('#editEstado').val(user.estado);
            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        }
    }, 'json');
}

function deleteUser(id, nombre, email) {
    userIdToDelete = id;
    $('#deleteUserName').text(nombre);
    $('#deleteUserEmail').text(email);
    new bootstrap.Modal(document.getElementById('modalEliminar')).show();
}

function confirmarEliminar() {
    if (userIdToDelete) {
        $.post(ROUTES.eliminar, { id: userIdToDelete }, function(response) {
            if (response.success) {
                Swal.fire({ icon: 'success', title: '¡Éxito!', text: 'Usuario eliminado correctamente', timer: 2000, showConfirmButton: false });
                bootstrap.Modal.getInstance(document.getElementById('modalEliminar')).hide();
                table.ajax.reload();
                userIdToDelete = null;
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Error al eliminar usuario' });
            }
        }, 'json').fail(() => Swal.fire({ icon: 'error', title: 'Error', text: 'Error de conexión' }));
    }
}

function setupModalAccessibility() {
    const modals = ['modalRegistrar', 'modalEditar', 'modalEliminar'];
    
    modals.forEach(modalId => {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                        const isVisible = modalElement.style.display === 'block';
                        if (isVisible) {
                            modalElement.removeAttribute('aria-hidden');
                        } else {
                            modalElement.setAttribute('aria-hidden', 'true');
                        }
                    }
                });
            });
            
            observer.observe(modalElement, {
                attributes: true,
                attributeFilter: ['style']
            });
            
            modalElement.addEventListener('show.bs.modal', function() {
                setTimeout(() => {
                    this.removeAttribute('aria-hidden');
                }, 10);
            });
            
            modalElement.addEventListener('shown.bs.modal', function() {
                this.removeAttribute('aria-hidden');
                const firstInput = this.querySelector('input:not([type="hidden"]), select, textarea');
                if (firstInput) {
                    setTimeout(() => firstInput.focus(), 100);
                }
            });
            
            modalElement.addEventListener('hide.bs.modal', function() {
                this.setAttribute('aria-hidden', 'true');
            });
            
            modalElement.addEventListener('hidden.bs.modal', function() {
                this.setAttribute('aria-hidden', 'true');
            });
        }
    });
}

function updateStats() {
    if (!table || !table.data) {
        return;
    }
    
    try {
        const data = table.data();
        if (!data || typeof data.length === 'undefined') {
            $('#totalUsers').text('0');
            $('#activeUsers').text('0');
            $('#inactiveUsers').text('0');
            $('#newToday').text('0');
            return;
        }
        
        const total = data.length;
        let active = 0, inactive = 0, newToday = 0;
        const today = new Date().toDateString();

        data.each(function(row) {
            if (row && typeof row.estado !== 'undefined') {
                if (row.estado == 1) active++; else inactive++;
            }
            if (row && row.fecha_registro) {
                if (new Date(row.fecha_registro).toDateString() === today) newToday++;
            }
        });

        $('#totalUsers').text(total);
        $('#activeUsers').text(active);
        $('#inactiveUsers').text(inactive);
        $('#newToday').text(newToday);
    } catch (error) {

        $('#totalUsers').text('0');
        $('#activeUsers').text('0');
        $('#inactiveUsers').text('0');
        $('#newToday').text('0');
    }
}