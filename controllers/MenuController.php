<?php
class MenuController {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
    
    public function index() {
        // Recuperare tutte le categorie con conteggio prodotti
        $stmt = $this->conn->query("
            SELECT mc.*, COUNT(mi.id) as items_count
            FROM menu_categories mc
            LEFT JOIN menu_items mi ON mc.id = mi.category_id
            GROUP BY mc.id
            ORDER BY mc.name
        ");
        $categories = $stmt->fetchAll();
        
        // Recuperare tutti i prodotti
        $stmt = $this->conn->query("
            SELECT mi.*, mc.name as category_name
            FROM menu_items mi
            JOIN menu_categories mc ON mi.category_id = mc.id
            ORDER BY mc.name, mi.name
        ");
        $menuItems = $stmt->fetchAll();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/menu.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function categories() {
        // Recuperare tutte le categorie
        $stmt = $this->conn->query("
            SELECT mc.*, COUNT(mi.id) as items_count
            FROM menu_categories mc
            LEFT JOIN menu_items mi ON mc.id = mi.category_id
            GROUP BY mc.id
            ORDER BY mc.name
        ");
        $categories = $stmt->fetchAll();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/menu.js',
            'assets/js/5-pages/categories.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
    
    public function items() {
        // Recuperare tutti i prodotti
        $stmt = $this->conn->query("
            SELECT mi.*, mc.name as category_name
            FROM menu_items mi
            JOIN menu_categories mc ON mi.category_id = mc.id
            ORDER BY mc.name, mi.name
        ");
        $menuItems = $stmt->fetchAll();
        
        // Recuperare le categorie per il filtro
        $stmt = $this->conn->query("SELECT * FROM menu_categories ORDER BY name");
        $categories = $stmt->fetchAll();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/menu.js',
            'assets/js/5-pages/items.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
}
?>
