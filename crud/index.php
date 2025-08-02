<?php
require_once 'config.php';
$title = 'CRUD DataTable - Gestión de Usuarios';
Template::renderHeader($title);
?>


<main class="container-fluid py-4">

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-primary shadow-sm h-100 hover-card" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-primary shadow me-3">
                            <i class="bi bi-people text-white fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small fw-semibold text-primary text-uppercase mb-1 letter-spacing">Total Usuarios</p>
                            <p class="h2 fw-bold text-primary mb-1" id="totalUsers">0</p>
                            <p class="small text-primary-emphasis mb-0">Registrados en el sistema</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-success shadow-sm h-100 hover-card" style="background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-success shadow me-3">
                            <i class="bi bi-person-check-fill text-white fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small fw-semibold text-success text-uppercase mb-1 letter-spacing">Usuarios Activos</p>
                            <p class="h2 fw-bold text-success mb-1" id="activeUsers">0</p>
                            <p class="small text-success-emphasis mb-0">Con acceso habilitado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-danger shadow-sm h-100 hover-card" style="background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-danger shadow me-3">
                            <i class="bi bi-person-x-fill text-white fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small fw-semibold text-danger text-uppercase mb-1 letter-spacing">Usuarios Inactivos</p>
                            <p class="h2 fw-bold text-danger mb-1" id="inactiveUsers">0</p>
                            <p class="small text-danger-emphasis mb-0">Con acceso suspendido</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-warning shadow-sm h-100 hover-card" style="background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-warning shadow me-3">
                            <i class="bi bi-calendar-plus-fill text-white fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="small fw-semibold text-warning text-uppercase mb-1 letter-spacing">Nuevos Hoy</p>
                            <p class="h2 fw-bold text-warning mb-1" id="newToday">0</p>
                            <p class="small text-warning-emphasis mb-0">Registrados hoy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow-lg border-0">
        <div class="card-header bg-light border-bottom">
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-2 d-flex align-items-center">
                        Lista de Usuarios
                    </h2>
                    <p class="text-muted small mb-0 fw-medium">Gestiona y administra todos los usuarios del sistema de manera eficiente</p>
                </div>
                <div class="mt-3 mt-sm-0">
                    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
                        <i class="bi bi-plus-circle-fill me-2"></i>
                        Agregar Nuevo Usuario
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <table id="usersTable" class="table table-striped table-hover">
                <thead class="table-primary sticky-top">
                    <tr>
                        <th scope="col" class="fw-semibold">ID</th>
                        <th scope="col" class="fw-semibold">Nombre</th>
                        <th scope="col" class="fw-semibold">Email</th>
                        <th scope="col" class="fw-semibold">Teléfono</th>
                        <th scope="col" class="fw-semibold">Estado</th>
                        <th scope="col" class="fw-semibold">Fecha</th>
                        <th scope="col" class="fw-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php Template::renderFooter(); ?>