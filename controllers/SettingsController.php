
<?php
class SettingsController {
    public function index() {
        require_once 'views/settings/index.php';
    }

    public function profile() {
        require_once 'views/settings/profile.php';
    }

    public function system() {
        require_once 'views/settings/system.php';
    }
}
