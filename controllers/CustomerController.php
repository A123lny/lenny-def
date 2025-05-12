<?php
class CustomerController {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
    
    public function index() {
        // Recuperare tutti i clienti
        $stmt = $this->conn->query("
            SELECT c.*, COUNT(o.id) as orders_count, SUM(o.total_amount) as total_spent
            FROM customers c
            LEFT JOIN orders o ON c.id = o.customer_id
            GROUP BY c.id
            ORDER BY c.name
        ");
        $customers = $stmt->fetchAll();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/customers.js'
        ];
        
        require_once 'views/work-in-progress.php';
    }
}
?>
