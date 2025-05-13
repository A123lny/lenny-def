
<?php
class SettingsController {
    public function index() {
        // Carica la vista delle impostazioni
        require_once 'views/settings/index.php';
    }
    
    public function profile() {
        // Carica la vista del profilo utente
        require_once 'views/settings/profile.php';
    }
    
    public function system() {
        // Carica la vista delle impostazioni di sistema
        require_once 'views/settings/system.php';
    }
}
?>
