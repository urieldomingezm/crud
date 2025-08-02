<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalEditarLabel">
                    <i class="bi bi-pencil-square me-2"></i>
                    Editar Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formEditar">
                <input type="hidden" name="id" id="editId">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editNombre" class="form-label fw-medium">Nombre Completo</label>
                            <input type="text" name="nombre" id="editNombre" required minlength="2" maxlength="100" class="form-control" placeholder="Ingrese el nombre completo" autocomplete="name">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="editEmail" class="form-label fw-medium">Email</label>
                            <input type="email" name="email" id="editEmail" required maxlength="100" class="form-control" placeholder="ejemplo@correo.com" autocomplete="email">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="editTelefono" class="form-label fw-medium">Teléfono</label>
                            <input type="tel" name="telefono" id="editTelefono" maxlength="20" class="form-control" placeholder="+1234567890" autocomplete="tel">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="editEstado" class="form-label fw-medium">Estado</label>
                            <select name="estado" id="editEstado" class="form-select" aria-describedby="editEstadoHelp">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <div id="editEstadoHelp" class="form-text">Seleccione el estado del usuario</div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i>
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>