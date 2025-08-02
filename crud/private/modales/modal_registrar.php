<div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalRegistrarLabel">
                    <i class="bi bi-person-plus me-2"></i>
                    Registrar Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formRegistrar">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium">Nombre Completo</label>
                            <input type="text" name="nombre" id="nombre" required minlength="2" maxlength="100" class="form-control" placeholder="Ingrese el nombre completo" autocomplete="name">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" name="email" id="email" required maxlength="100" class="form-control" placeholder="ejemplo@correo.com" autocomplete="email">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="telefono" class="form-label fw-medium">Teléfono</label>
                            <input type="tel" name="telefono" id="telefono" maxlength="20" class="form-control" placeholder="+1234567890" autocomplete="tel">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="estado" class="form-label fw-medium">Estado</label>
                            <select name="estado" id="estado" class="form-select" aria-describedby="estadoHelp">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <div id="estadoHelp" class="form-text">Seleccione el estado del usuario</div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>