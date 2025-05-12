<?php if (isset($_SESSION['user_id'])): ?>
            </div> <!-- Chiusura di page-container -->
        </main> <!-- Chiusura di main-content -->
    </div> <!-- Chiusura di layout-wrapper -->
<?php else: ?>
    </div> <!-- Chiusura di auth-wrapper -->
<?php endif; ?>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script comuni essenziali -->
    <script src="<?= asset('js/2-utils/dom-utils.js') ?>"></script>
    <script src="<?= asset('js/2-utils/format-utils.js') ?>"></script>
    <script src="<?= asset('js/4-components/sidebar.js') ?>"></script>
    <script src="<?= asset('js/4-components/toast.js') ?>"></script>
    <script src="<?= asset('js/main.js') ?>"></script>
    <script src="<?= asset('js/3-services/notification-service.js') ?>"></script>
    
    <!-- Script specifici per la pagina definiti dal controller -->
    <?php if(isset($page_scripts)): ?>
        <?php foreach($page_scripts as $script): ?>
            <?php
            // Rimuovi il prefisso /lenny1/ se presente
            $cleaned_script = preg_replace('/^\/lenny1\//', '', $script);
            // Se inizia con assets/ rimuovilo poiché asset() lo aggiungerà
            $cleaned_script = preg_replace('/^assets\//', '', $cleaned_script);
            ?>
            <script src="<?= asset($cleaned_script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <script>
        // Inizializzazione del sistema di notifiche
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica il servizio di notifiche
            if (typeof NotificationService === 'object' && typeof NotificationService.init === 'function') {
                NotificationService.init();
            }
        });
    </script>
</body>
</html>
