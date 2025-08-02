<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEliminarLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="d-flex align-items-start mb-3">
                    <div class="flex-shrink-0">
                        <i class="bi bi-exclamation-triangle text-danger fs-2"></i>
                    </div>
                    <div class="ms-3">
                        <p class="mb-2">
                            ¿Estás seguro de que deseas eliminar este usuario?
                        </p>
                        <p class="text-muted small mb-0">
                            Esta acción no se puede deshacer.
                        </p>
                    </div>
                </div>
                
                <div class="alert alert-light border" role="alert">
                    <p class="fw-medium mb-1" id="deleteUserName"></p>
                    <p class="text-muted small mb-0" id="deleteUserEmail"></p>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" onclick="confirmarEliminar()" class="btn btn-danger">
                    <i class="bi bi-trash me-1"></i>
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>