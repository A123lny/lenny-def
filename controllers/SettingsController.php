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
     * Mostra la pagina delle impostazioni di sistema
     */
    public function system() {
        require_once 'views/settings/system.php';
    }
}