<?php
class DriverController {
    
    public function __construct() {
        // Costruttore vuoto, non serve più la connessione al database
    }
    
    // Funzione per la panoramica generale dei driver
    public function panoramica() {
        
        // Utilizziamo dati statici per la panoramica dei driver
        $drivers = $this->getDriversData();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/2-utils/export-utils.js',
            'assets/js/4-components/drivers/driver_view.js',
            'assets/js/4-components/drivers/driver_edit.js',
            'assets/js/4-components/drivers/driver_new.js',
            'assets/js/5-pages/drivers/panoramica.js'
        ];
        
        // Caricamento della vista
        require_once 'views/drivers/panoramica.php';
    }
    
    // Funzione per la gestione dei turni dei driver
    public function turni() {
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/4-components/drivers/gestione-turni-driver.js',
            'assets/js/5-pages/drivers/turni.js'
        ];
        
        // Caricamento della vista
        require_once 'views/drivers/turni.php';
    }
    
    // Funzione per la gestione avanzata dei turni dei driver
    public function gestione_turni_driver() {
        // Dati di esempio per la gestione turni (in un'app reale verrebbero dal database)
        $driverShifts = [
            [
                'id' => 1,
                'driver_id' => 1,
                'driver_name' => 'Mario Rossi',
                'day' => 'mon',
                'shift' => 'mattina',
                'status' => 'disponibile'
            ],
            [
                'id' => 2,
                'driver_id' => 2,
                'driver_name' => 'Luca Bianchi',
                'day' => 'mon',
                'shift' => 'mattina',
                'status' => 'disponibile'
            ],
            // Altri dati di turni...
        ];
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            'assets/js/4-components/drivers/gestione-turni-driver.js',
            'assets/js/5-pages/drivers/turni.js'
        ];
        
        // Caricamento della vista
        require_once 'views/drivers/tabs/gestione_turni_driver.php';
    }
    
    // Funzione per la gestione dei contratti dei driver
    public function contratti() {
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [];
        
        // Caricamento della vista
        require_once 'views/drivers/contratti.php';
    }
    
    // Funzione per la gestione dei mezzi dei driver
    public function mezzi() {
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [];
        
        // Caricamento della vista
        require_once 'views/drivers/mezzi.php';
    }
    
    // Funzione per la gestione dei pagamenti ai driver
    public function pagamenti() {
        // Utilizziamo dati statici per i pagamenti dei driver
        $drivers = $this->getDriversPaymentData();
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [];
        
        // Caricamento della vista
        require_once 'views/drivers/pagamenti.php';
    }
    
    // Funzione per la visualizzazione delle performance dei driver
    public function performance() {
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [];
        
        // Caricamento della vista
        require_once 'views/drivers/performance.php';
    }
    
    // Supporto retrocompatibilità - Reindirizza alla pagina panoramica
    public function index() {
        redirect('drivers', 'panoramica');
        exit;
    }
    
    /**
     * Fornisce dati statici dei driver per la panoramica
     * @return array
     */
    private function getDriversData() {
        return [
            [
                'id' => 1,
                'name' => 'Marco Bianchi',
                'email' => 'marco.bianchi@example.com',
                'phone' => '3331122334',
                'vehicle_type' => 'Scooter',
                'vehicle_plate' => 'AB12345',
                'status' => 'attivo',
                'created_at' => '2025-03-15 09:30:00'
            ],
            [
                'id' => 2,
                'name' => 'Giulia Rossi',
                'email' => 'giulia.rossi@example.com',
                'phone' => '3334455667',
                'vehicle_type' => 'Moto',
                'vehicle_plate' => 'CD67890',
                'status' => 'attivo',
                'created_at' => '2025-03-18 10:15:00'
            ],
            [
                'id' => 3,
                'name' => 'Alessandro Verdi',
                'email' => 'alessandro.verdi@example.com',
                'phone' => '3337788990',
                'vehicle_type' => 'Auto',
                'vehicle_plate' => 'EF54321',
                'status' => 'inattivo',
                'created_at' => '2025-03-20 11:45:00'
            ],
            [
                'id' => 4,
                'name' => 'Sara Neri',
                'email' => 'sara.neri@example.com',
                'phone' => '3339900112',
                'vehicle_type' => 'Bici',
                'vehicle_plate' => '',
                'status' => 'consegna',
                'created_at' => '2025-03-25 08:20:00'
            ],
            [
                'id' => 5,
                'name' => 'Luca Ferrari',
                'email' => 'luca.ferrari@example.com',
                'phone' => '3351234567',
                'vehicle_type' => 'Scooter',
                'vehicle_plate' => 'GH98765',
                'status' => 'attivo',
                'created_at' => '2025-04-01 14:30:00'
            ],
            [
                'id' => 6,
                'name' => 'Elena Marino',
                'email' => 'elena.marino@example.com',
                'phone' => '3356789012',
                'vehicle_type' => 'Moto',
                'vehicle_plate' => 'IJ45678',
                'status' => 'attivo',
                'created_at' => '2025-04-03 16:45:00'
            ],
            [
                'id' => 7,
                'name' => 'Roberto Esposito',
                'email' => 'roberto.esposito@example.com',
                'phone' => '3358901234',
                'vehicle_type' => 'Auto',
                'vehicle_plate' => 'KL23456',
                'status' => 'consegna',
                'created_at' => '2025-04-10 09:15:00'
            ]
        ];
    }
    
    /**
     * Fornisce dati statici dei pagamenti ai driver
     * @return array
     */
    private function getDriversPaymentData() {
        return [
            [
                'id' => 1,
                'name' => 'Marco Bianchi',
                'email' => 'marco.bianchi@example.com',
                'phone' => '3331122334',
                'vehicle_type' => 'Scooter',
                'vehicle_plate' => 'AB12345',
                'status' => 'attivo',
                'completed_orders' => 87,
                'total_delivery_fees' => 348.00
            ],
            [
                'id' => 2,
                'name' => 'Giulia Rossi',
                'email' => 'giulia.rossi@example.com',
                'phone' => '3334455667',
                'vehicle_type' => 'Moto',
                'vehicle_plate' => 'CD67890',
                'status' => 'attivo',
                'completed_orders' => 63,
                'total_delivery_fees' => 252.00
            ],
            [
                'id' => 3,
                'name' => 'Alessandro Verdi',
                'email' => 'alessandro.verdi@example.com',
                'phone' => '3337788990',
                'vehicle_type' => 'Auto',
                'vehicle_plate' => 'EF54321',
                'status' => 'inattivo',
                'completed_orders' => 32,
                'total_delivery_fees' => 128.00
            ],
            [
                'id' => 4,
                'name' => 'Sara Neri',
                'email' => 'sara.neri@example.com',
                'phone' => '3339900112',
                'vehicle_type' => 'Bici',
                'vehicle_plate' => '',
                'status' => 'consegna',
                'completed_orders' => 54,
                'total_delivery_fees' => 216.00
            ],
            [
                'id' => 5,
                'name' => 'Luca Ferrari',
                'email' => 'luca.ferrari@example.com',
                'phone' => '3351234567',
                'vehicle_type' => 'Scooter',
                'vehicle_plate' => 'GH98765',
                'status' => 'attivo',
                'completed_orders' => 76,
                'total_delivery_fees' => 304.00
            ],
            [
                'id' => 6,
                'name' => 'Elena Marino',
                'email' => 'elena.marino@example.com',
                'phone' => '3356789012',
                'vehicle_type' => 'Moto',
                'vehicle_plate' => 'IJ45678',
                'status' => 'attivo',
                'completed_orders' => 58,
                'total_delivery_fees' => 232.00
            ],
            [
                'id' => 7,
                'name' => 'Roberto Esposito',
                'email' => 'roberto.esposito@example.com',
                'phone' => '3358901234',
                'vehicle_type' => 'Auto',
                'vehicle_plate' => 'KL23456',
                'status' => 'consegna',
                'completed_orders' => 42,
                'total_delivery_fees' => 168.00
            ]
        ];
    }
}
?>
