
<?php
/**
 * Controller per la gestione delle impostazioni
 */
class SettingsController {
    
    /**
     * Costruttore
     */
    public function __construct() {
        // Non necessita di inizializzazioni particolari
    }
    
    /**
     * Mostra la pagina principale delle impostazioni
     */
    public function index() {
        // Script JavaScript per questa pagina
        $page_scripts = [
            'assets/js/settings.js'
        ];
        
        // Carica la vista
        require_once 'views/settings/index.php';
    }
    
    /**
     * Gestisce le impostazioni del profilo utente
     */
    public function profile() {
        // Script JavaScript per questa pagina
        $page_scripts = [];
        
        // Carica la vista
        require_once 'views/settings/profile.php';
    }
    
    /**
     * Gestisce le impostazioni di sistema
     */
    public function system() {
        // Script JavaScript per questa pagina
        $page_scripts = [];
        
        // Carica la vista
        require_once 'views/settings/system.php';
    }
}
