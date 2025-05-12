<?php
class RestaurantController {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
    
    public function index() {
        // Questa è la funzione principale che mostra la pagina con i tre bottoni
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            // Utility
            'assets/js/2-utils/export-utils.js',
            
            // Servizi
            'assets/js/3-services/geocoding-service.js',
            
            // Componenti
            'assets/js/4-components/restaurants/restaurant-details.js',
            'assets/js/4-components/restaurants/restaurant-wizard.js',
            'assets/js/4-components/restaurants/restaurant-selection.js',
            
            // Script principale
            'assets/js/5-pages/restaurants.js'
        ];
        
        require_once 'views/restaurants/index.php';
    }
}
?>