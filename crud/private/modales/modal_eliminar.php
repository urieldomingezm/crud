<div id="modalEliminar" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-red-600">
                        <i class="bi bi-exclamation-triangle mr-2"></i>
                        Confirmar Eliminación
                    </h3>
                    <button onclick="closeModal('eliminar')" class="text-gray-400 hover:text-gray-600">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="px-6 py-4">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <i class="bi bi-exclamation-triangle text-red-500 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-700">
                            ¿Estás seguro de que deseas eliminar este usuario?
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Esta acción no se puede deshacer.
                        </p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-md p-3 mb-4">
                    <p class="text-sm font-medium text-gray-900" id="deleteUserName"></p>
                    <p class="text-sm text-gray-600" id="deleteUserEmail"></p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('eliminar')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="button" onclick="confirmarEliminar()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors duration-200">
                        <i class="bi bi-trash mr-1"></i>
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>