<?php
class CRMController {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
    
    public function clients() {
        // In futuro, qui recupereremo i dati dei clienti dal database
        // Per ora carichiamo solo la vista vuota
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/crm/clients.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function restaurants() {
        // In futuro, qui recupereremo i dati dei ristoranti dal database
        // Per ora carichiamo solo la vista vuota
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/crm/restaurants.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function orders() {
        // In futuro, qui recupereremo i dati degli ordini dal database
        // Per ora carichiamo solo la vista vuota
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/crm/orders.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function reviews() {
        // In futuro, qui recupereremo i dati delle recensioni dal database
        // Per ora carichiamo solo la vista vuota
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/crm/reviews.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function complaints() {
        // In futuro, qui recupereremo i dati dei reclami dal database
        // Per ora carichiamo solo la vista vuota
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/crm/complaints.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function suggestions() {
        // In futuro, qui recupereremo i dati dei suggerimenti dal database
        // Per ora carichiamo solo la vista vuota
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/crm/suggestions.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
}
?>