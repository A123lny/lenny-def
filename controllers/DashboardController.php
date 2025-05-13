
<?php
/**
 * Controller per la Dashboard principale
 * Gestisce la visualizzazione della dashboard e delle statistiche
 */
class DashboardController {
    /**
     * Mostra la dashboard principale
     */
    public function index() {
        // Controlla se il dispositivo è mobile
        if ($this->isMobileDevice()) {
            $this->mobile();
            return;
        }
        
        // Dati di esempio per la dashboard
        $totalOrders = 684;
        $totalRevenue = 15742;
        $totalCustomers = 425;
        $deliveryTime = 28;
        $averageOrderValue = 23;
        
        $ordersByStatus = [
            ['status' => 'nuovo', 'count' => 12],
            ['status' => 'in-preparazione', 'count' => 8],
            ['status' => 'in-consegna', 'count' => 15],
            ['status' => 'consegnato', 'count' => 645],
            ['status' => 'annullato', 'count' => 4]
        ];
        
        // Passa i dati alla vista
        include 'views/dashboard/index.php';
    }
    
    /**
     * Mostra la versione mobile della dashboard
     */
    public function mobile() {
        // Dati di esempio per la dashboard mobile
        $totalOrders = 684;
        $totalRevenue = 15742;
        $totalCustomers = 425;
        
        $ordersByStatus = [
            ['status' => 'nuovo', 'count' => 12],
            ['status' => 'in-preparazione', 'count' => 8],
            ['status' => 'in-consegna', 'count' => 15],
            ['status' => 'consegnato', 'count' => 645],
            ['status' => 'annullato', 'count' => 4]
        ];
        
        // Passa i dati alla vista mobile
        include 'views/dashboard/mobile.php';
    }
    
    /**
     * Determina se l'utente sta utilizzando un dispositivo mobile
     * @return bool
     */
    private function isMobileDevice() {
        // Se specificato esplicitamente nell'URL, forza la visualizzazione mobile o desktop
        if (isset($_GET['view'])) {
            return $_GET['view'] === 'mobile';
        }
        
        $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        
        // Controlla se il dispositivo è mobile
        $isMobile = (
            strpos($userAgent, 'Android') !== false
            || strpos($userAgent, 'webOS') !== false
            || strpos($userAgent, 'iPhone') !== false
            || strpos($userAgent, 'iPod') !== false
            || strpos($userAgent, 'BlackBerry') !== false
            || strpos($userAgent, 'Windows Phone') !== false
            || (strpos($userAgent, 'iPad') !== false && strpos($userAgent, 'Mobile') !== false)
        );
        
        // Controlla anche la larghezza dello schermo (se JavaScript è disponibile)
        if (isset($_COOKIE['screen_width']) && $_COOKIE['screen_width'] < 768) {
            $isMobile = true;
        }
        
        return $isMobile;
    }
}
