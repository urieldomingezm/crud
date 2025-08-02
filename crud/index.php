<?php
require_once 'config.php';
$title = 'CRUD DataTable - Gestión de Usuarios';
Template::renderHeader($title);
?>


<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-blue-200 transform hover:scale-105">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg">
                    <i class="bi bi-people text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-blue-700 uppercase tracking-wide">Total Usuarios</p>
                    <p class="text-3xl font-bold text-blue-900" id="totalUsers">0</p>
                    <p class="text-xs text-blue-600 mt-1">Registrados en el sistema</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-green-200 transform hover:scale-105">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-r from-green-500 to-green-600 shadow-lg">
                    <i class="bi bi-person-check-fill text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-green-700 uppercase tracking-wide">Usuarios Activos</p>
                    <p class="text-3xl font-bold text-green-900" id="activeUsers">0</p>
                    <p class="text-xs text-green-600 mt-1">Con acceso habilitado</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-red-200 transform hover:scale-105">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-r from-red-500 to-red-600 shadow-lg">
                    <i class="bi bi-person-x-fill text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-red-700 uppercase tracking-wide">Usuarios Inactivos</p>
                    <p class="text-3xl font-bold text-red-900" id="inactiveUsers">0</p>
                    <p class="text-xs text-red-600 mt-1">Con acceso suspendido</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-purple-200 transform hover:scale-105">
            <div class="flex items-center">
                <div class="p-4 rounded-full bg-gradient-to-r from-purple-500 to-purple-600 shadow-lg">
                    <i class="bi bi-calendar-plus-fill text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-purple-700 uppercase tracking-wide">Nuevos Hoy</p>
                    <p class="text-3xl font-bold text-purple-900" id="newToday">0</p>
                    <p class="text-xs text-purple-600 mt-1">Registrados hoy</p>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <i class="bi bi-table text-blue-600 mr-3"></i>
                        Lista de Usuarios
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 font-medium">Gestiona y administra todos los usuarios del sistema de manera eficiente</p>
                </div>
                <div class="mt-6 sm:mt-0">
                    <button onclick="openModal('registrar')" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 border border-blue-500">
                        <i class="bi bi-plus-circle-fill mr-2 group-hover:rotate-90 transition-transform duration-200"></i>
                        Agregar Nuevo Usuario
                    </button>
                </div>
            </div>
        </div>


        <div class="px-8 py-6">
            <div class="overflow-hidden rounded-xl border border-gray-200 shadow-inner">
                <table id="usersTable" class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                ID
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                Nombre
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                Teléfono
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                Fecha
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php Template::renderFooter(); ?>