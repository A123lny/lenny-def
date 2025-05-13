<?php
/**
 * Controller per la gestione delle impostazioni
 */
class SettingsController {

    /**
     * Mostra la pagina principale delle impostazioni
     */
    public function index() {
        require_once 'views/settings/index.php';
    }

    /**
     * Mostra la pagina del profilo utente
     */
    public function profile() {
        require_once 'views/settings/profile.php';
    }
    
    /**
     * Gestisce la richiesta di eliminazione del profilo
     * Questo metodo verrebbe chiamato via AJAX nella versione completa
     */
    public function deleteProfile() {
        // In un'applicazione reale:
        // 1. Verificare la password dell'utente
        // 2. Rimuovere i dati dal database
        // 3. Terminare la sessione
        // 4. Reindirizzare alla pagina di login
        
        session_destroy();
        redirect('auth', 'login');
    }

    /**
     * Mostra la pagina delle impostazioni di sistema
     */
    public function system() {
        require_once 'views/settings/system.php';
    }
    
    /**
     * Mostra la pagina delle impostazioni di sicurezza
     */
    public function security() {
        require_once 'views/settings/security.php';
    }
    
    /**
     * Mostra la pagina di gestione ruoli e permessi
     */
    public function roles() {
        require_once 'views/settings/roles.php';
    }
    
    /**
     * Mostra la pagina di gestione utenti
     */
    public function users() {
        require_once 'views/settings/users.php';
    }
    
    /**
     * Mostra la pagina delle integrazioni
     */
    public function integrations() {
        require_once 'views/settings/integrations.php';
    }
}