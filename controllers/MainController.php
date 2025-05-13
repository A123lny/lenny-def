<?php
class MainController {
    public function index() {
        // Se l'utente è autenticato, reindirizzalo alla dashboard
        if (isset($_SESSION['user_id'])) {
            redirect('dashboard');
            exit;
        } else {
            // Altrimenti reindirizzalo al login
            redirect('auth', 'login');
            exit;
        }
    }
}