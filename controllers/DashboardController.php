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
        
        // Controlla se l'utente sta usando un dispositivo mobile
        $isMobile = $this->isMobileDevice();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            $isMobile ? 'assets/js/5-pages/mobile_dashboard.js' : 'assets/js/5-pages/dashboard.js'
        ];
        
        // Controlla se l'utente sta usando un dispositivo mobile
        $isMobile = $this->isMobileDevice();
        
        // Carica la vista appropriata
        if ($isMobile) {
            require_once 'views/dashboard/mobile.php';
        } else {
            require_once 'views/dashboard/index.php';
        }
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
?>
