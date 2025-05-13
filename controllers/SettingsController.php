
<?php
/**
 * Controller per la gestione delle impostazioni dell'applicazione
 */
class SettingsController {
    /**
     * Visualizza la pagina principale delle impostazioni
     */
    public function index() {
        // Carica la vista delle impostazioni
        require_once 'views/settings/index.php';
    }
    
    /**
     * Gestisci le impostazioni del profilo utente
     */
    public function profile() {
        // In futuro: implementare la gestione del profilo
        require_once 'views/settings/profile.php';
    }
    
    /**
     * Gestisci le impostazioni del sistema
     */
    public function system() {
        // In futuro: implementare le impostazioni di sistema
        require_once 'views/settings/system.php';
    }
}
