    <?php include MODALES_PATH . 'modal_registrar.php'; ?>
    <?php include MODALES_PATH . 'modal_editar.php'; ?>
    <?php include MODALES_PATH . 'modal_eliminar.php'; ?>

    <button id="btnScrollTop" class="btn btn-primary position-fixed rounded-circle shadow-lg" style="display: none; z-index: 1050; width: 50px; height: 50px; bottom: 20px; right: 20px;" title="Ir arriba">
        <i class="bi bi-arrow-up fs-5"></i>
    </button>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2025 Uriel Medina. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        console.log('Footer cargado, botón disponible:', $('#btnScrollTop').length > 0);
    </script>

</body>

</html>