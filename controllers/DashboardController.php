<?php
class DashboardController {
    public function index() {
        // Utilizziamo dati statici per coerenza con il resto dell'applicazione
        
        // Dati statici per i widget della dashboard
        $totalOrders = 684;
        $totalRevenue = 15750;
        $totalCustomers = 425;
        
        // Dati statici per gli ordini per stato
        $ordersByStatus = [
            ['status' => 'nuovo', 'count' => 12],
            ['status' => 'in preparazione', 'count' => 8],
            ['status' => 'in consegna', 'count' => 15],
            ['status' => 'consegnato', 'count' => 635],
            ['status' => 'annullato', 'count' => 14]
        ];
        
        // I dati dettagliati sono già definiti nel file JavaScript dashboard.js
        // Quindi qui definiamo solo ciò che serve per il rendering iniziale della vista
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/5-pages/dashboard.js'
        ];
        
        // Carica la vista
        require_once 'views/dashboard/index.php';
    }
}
?>
