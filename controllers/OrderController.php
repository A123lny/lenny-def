<?php
class OrderController {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
    
    public function index() {
        // Utilizziamo dati statici per la pagina degli ordini
        // Creiamo un array $orders con dati statici per la datatable
        $orders = [
            [
                'id' => '1587',
                'order_number' => 'ORD-1587',
                'date' => '14/04/2025 14:32',
                'delivery_date' => '14/04/2025 15:30',
                'customer_name' => 'Mario Rossi',
                'restaurant' => 'Pizzeria Napoli',
                'total' => '28,50€',
                'status' => 'Nuovo'
            ],
            [
                'id' => '1586',
                'order_number' => 'ORD-1586',
                'date' => '14/04/2025 10:15',
                'delivery_date' => '14/04/2025 11:45',
                'customer_name' => 'Laura Bianchi',
                'restaurant' => 'Burger King',
                'total' => '42,75€',
                'status' => 'In preparazione'
            ],
            [
                'id' => '1585',
                'order_number' => 'ORD-1585',
                'date' => '13/04/2025 12:50',
                'delivery_date' => '13/04/2025 13:30',
                'customer_name' => 'Andrea Verdi',
                'restaurant' => 'Pizzeria Da Mario',
                'total' => '19,90€',
                'status' => 'In consegna'
            ],
            [
                'id' => '1584',
                'order_number' => 'ORD-1584',
                'date' => '10/04/2025 11:45',
                'delivery_date' => '10/04/2025 13:00',
                'customer_name' => 'Sofia Esposito',
                'restaurant' => 'Ristorante Bella Italia',
                'total' => '33,20€',
                'status' => 'Consegnato'
            ],
            [
                'id' => '1583',
                'order_number' => 'ORD-1583',
                'date' => '02/04/2025 10:30',
                'delivery_date' => '02/04/2025 11:45',
                'customer_name' => 'Luca Russo',
                'restaurant' => 'Sushi Fusion',
                'total' => '25,80€',
                'status' => 'Consegnato'
            ],
            [
                'id' => '1582',
                'order_number' => 'ORD-1582',
                'date' => '28/03/2025 16:42',
                'delivery_date' => '28/03/2025 17:45',
                'customer_name' => 'Francesco Baldi',
                'restaurant' => 'Burger King',
                'total' => '18,90€',
                'status' => 'Consegnato'
            ],
            [
                'id' => '1581',
                'order_number' => 'ORD-1581',
                'date' => '20/03/2025 09:15',
                'delivery_date' => '20/03/2025 10:30',
                'customer_name' => 'Giulia Martini',
                'restaurant' => 'Pizzeria Napoli',
                'total' => '32,50€',
                'status' => 'Consegnato'
            ]
        ];
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            // Utility
            'assets/js/2-utils/export-utils.js',
            'assets/js/2-utils/print-utils.js',
            
            // Componenti
            'assets/js/4-components/orders/order-detail.js',
            'assets/js/4-components/orders/new-order.js',
            
            // Script principale
            'assets/js/5-pages/orders/orders.js'
        ];
        
        require_once 'views/orders/index.php';
    }
    
    /**
     * Visualizza la pagina degli ordini attivi
     */
    public function active() {
        // In un'app reale, recupereremmo gli ordini attivi dal database
        // Per ora utilizziamo dati statici generati nella vista
        
        // Imposta una variabile per identificare questa pagina specifica
        $isActiveOrdersPage = true;
        
        // Definisce gli script JavaScript necessari per questa pagina
        $page_scripts = [
            // Utility
            'assets/js/2-utils/export-utils.js',
            'assets/js/2-utils/print-utils.js',
            
            // Componenti
            'assets/js/4-components/orders/order-detail.js',
            'assets/js/4-components/orders/new-order.js',
            
            // Script principale
            'assets/js/5-pages/orders/orders.js'
        ];
        
        // Carica la vista con i dati
        require_once 'views/orders/active.php';
    }
    
    public function refunds() {
        // Recuperare i dati dei rimborsi (dati di esempio)
        $refundsData = $this->getRefundsData();
        
        // Statistiche per le card
        $stats = [
            'total_refunds' => count($refundsData),
            'pending_refunds' => count(array_filter($refundsData, function($r) { return $r['status'] === 'in attesa'; })),
            'approved_refunds' => count(array_filter($refundsData, function($r) { return $r['status'] === 'approvato'; })),
            'rejected_refunds' => count(array_filter($refundsData, function($r) { return $r['status'] === 'rifiutato'; })),
            'total_amount' => array_sum(array_column($refundsData, 'amount'))
        ];
        
        // Definiamo gli script specifici per questa pagina
        $page_scripts = [
                       
            // Utilità
            'assets/js/2-utils/export-utils.js',
            'assets/js/2-utils/print-utils.js',
            
            // Script principale della pagina
            'assets/js/5-pages/orders/refunds.js'
        ];
        
        require_once 'views/orders/refunds.php';
    }
    
    /**
     * Visualizza la pagina di analisi dei rimborsi
     * Questo metodo gestisce l'URL /lenny1/orders/refunds_analysis
     */
    public function refunds_analysis() {
        
        // Dati per i grafici (simulati)
        $monthlyRefundsData = [
            'Jan' => 8, 'Feb' => 12, 'Mar' => 15, 'Apr' => 10, 
            'May' => 14, 'Jun' => 18, 'Jul' => 16, 'Aug' => 12, 
            'Sep' => 14, 'Oct' => 16, 'Nov' => 10, 'Dec' => 9
        ];
        
        $refundReasonData = [
            'Prodotto danneggiato' => 32,
            'Consegna in ritardo' => 28,
            'Ordine errato' => 22,
            'Qualità del cibo' => 18,
            'Altro' => 10
        ];
        
        $refundRatioData = [
            'refunded_orders' => 144,
            'total_orders' => 1254,
            'refund_rate' => 11.5
        ];
        
        $restaurantRefundsData = [
            'Pizzeria Napoli' => 24,
            'Burger King' => 32,
            'Pizzeria Da Mario' => 18,
            'Ristorante Bella Italia' => 27,
            'Sushi Fusion' => 43
        ];
        
        // Definiamo gli script specifici per questa pagina
        $page_scripts = [
            'assets/js/5-pages/refunds.js'
        ];
        
        require_once 'views/orders/refunds_analysis.php';
    }
    
    public function analysis() {
        // Dati per i grafici (simulati)
        $monthlyRefundsData = [
            'Jan' => 8, 'Feb' => 12, 'Mar' => 15, 'Apr' => 10, 
            'May' => 14, 'Jun' => 18, 'Jul' => 16, 'Aug' => 12, 
            'Sep' => 14, 'Oct' => 16, 'Nov' => 10, 'Dec' => 9
        ];
        
        $refundReasonData = [
            'Prodotto danneggiato' => 32,
            'Consegna in ritardo' => 28,
            'Ordine errato' => 22,
            'Qualità del cibo' => 18,
            'Altro' => 10
        ];
        
        $refundRatioData = [
            'refunded_orders' => 144,
            'total_orders' => 1254,
            'refund_rate' => 11.5
        ];
        
        $restaurantRefundsData = [
            'Pizzeria Napoli' => 24,
            'Burger King' => 32,
            'Pizzeria Da Mario' => 18,
            'Ristorante Bella Italia' => 27,
            'Sushi Fusion' => 43
        ];
        
        // Definiamo gli script specifici per questa pagina
        $page_scripts = [
            'assets/js/5-pages/refunds.js'
        ];
        
        require_once 'views/orders/refunds_analysis.php';
    }
    
    public function view() {
        if (isset($_GET['id'])) {
            $orderId = $_GET['id'];
            
            // Utilizziamo dati statici per la visualizzazione di un singolo ordine
            // I dati dettagliati sono definiti nella funzione getOrderDetail
            $order = $this->getOrderDetail($orderId);
            
            if ($order) {
                // Definisce gli script JavaScript necessari per questa pagina
                $page_scripts = [
                    'assets/js/2-utils/export-utils.js',
                    'assets/js/4-components/orders/order-detail.js',
                    'assets/js/5-pages/orders/orders.js'
                ];
                
                require_once 'views/orders/view.php';
            } else {
                redirect('orders');
                exit;
            }
        } else {
            redirect('orders');
            exit;
        }
    }
    
    /**
     * Ottiene dati di esempio per un ordine specifico
     * @param string $orderId ID dell'ordine
     * @return array|null Dati dell'ordine o null se non trovato
     */
    private function getOrderDetail($orderId) {
        // Dati statici per gli ordini di esempio
        $orders = [
            '1587' => [
                'id' => '1587',
                'order_number' => 'ORD-1587',
                'customer_id' => '101',
                'customer_name' => 'Mario Rossi',
                'customer_phone' => '+39 338 1234567',
                'customer_email' => 'mario.rossi@example.com',
                'status' => 'consegnato',
                'created_at' => '14/04/2025 14:32',
                'delivery_date' => '14/04/2025 15:30',
                'subtotal' => 27.50,
                'delivery_fee' => 2.50,
                'total_amount' => 30.00,
                'payment_method' => 'Carta di credito',
                'delivery_address' => 'Via Roma 123, Milano',
                'items' => [
                    [
                        'id' => '1',
                        'item_name' => 'Pizza Margherita',
                        'quantity' => 2,
                        'price' => 8.50,
                        'total' => 17.00
                    ],
                    [
                        'id' => '2',
                        'item_name' => 'Coca-Cola 33cl',
                        'quantity' => 2,
                        'price' => 2.50,
                        'total' => 5.00
                    ],
                    [
                        'id' => '3',
                        'item_name' => 'Tiramisù',
                        'quantity' => 1,
                        'price' => 5.50,
                        'total' => 5.50
                    ]
                ]
            ],
            '1583' => [
                'id' => '1583',
                'order_number' => 'ORD-1583',
                'customer_id' => '102',
                'customer_name' => 'Luca Russo',
                'customer_phone' => '+39 339 9876543',
                'customer_email' => 'luca.russo@example.com',
                'status' => 'consegnato',
                'created_at' => '10/04/2025 19:45',
                'delivery_date' => '10/04/2025 20:30',
                'subtotal' => 32.00,
                'delivery_fee' => 3.50,
                'total_amount' => 35.50,
                'payment_method' => 'Contanti alla consegna',
                'delivery_address' => 'Via Garibaldi 45, Milano',
                'items' => [
                    [
                        'id' => '1',
                        'item_name' => 'Burger Deluxe',
                        'quantity' => 2,
                        'price' => 12.00,
                        'total' => 24.00
                    ],
                    [
                        'id' => '2',
                        'item_name' => 'Patatine fritte',
                        'quantity' => 2,
                        'price' => 4.00,
                        'total' => 8.00
                    ]
                ]
            ]
        ];
        
        // Rimuovi il prefisso "ORD-" se presente
        $cleanId = str_replace('ORD-', '', $orderId);
        
        return isset($orders[$cleanId]) ? $orders[$cleanId] : null;
    }
    
    /**
     * Ottiene dati di esempio per i rimborsi
     * @return array Dati dei rimborsi
     */
    private function getRefundsData() {
        // In futuro questi dati verranno dal database
        return [
            [
                'id' => 'RFD-1001',
                'order_id' => 'ORD-1587',
                'customer_name' => 'Mario Rossi',
                'date' => '14/04/2025',
                'amount' => 28.50,
                'reason' => 'Consegna in ritardo',
                'status' => 'approvato'
            ],
            [
                'id' => 'RFD-1002',
                'order_id' => 'ORD-1583',
                'customer_name' => 'Luca Russo',
                'date' => '10/04/2025',
                'amount' => 12.90,
                'reason' => 'Prodotto danneggiato',
                'status' => 'in attesa'
            ],
            [
                'id' => 'RFD-1003',
                'order_id' => 'ORD-1581',
                'customer_name' => 'Giulia Martini',
                'date' => '09/04/2025',
                'amount' => 32.50,
                'reason' => 'Ordine errato',
                'status' => 'in attesa'
            ],
            [
                'id' => 'RFD-1004',
                'order_id' => 'ORD-1579',
                'customer_name' => 'Andrea Verdi',
                'date' => '08/04/2025',
                'amount' => 19.90,
                'reason' => 'Qualità del cibo',
                'status' => 'rifiutato'
            ],
            [
                'id' => 'RFD-1005',
                'order_id' => 'ORD-1576',
                'customer_name' => 'Sofia Esposito',
                'date' => '06/04/2025',
                'amount' => 33.20,
                'reason' => 'Ordine incompleto',
                'status' => 'approvato'
            ],
            [
                'id' => 'RFD-1006',
                'order_id' => 'ORD-1573',
                'customer_name' => 'Paolo Bianchi',
                'date' => '03/04/2025',
                'amount' => 22.75,
                'reason' => 'Consegna in ritardo',
                'status' => 'in attesa'
            ],
            [
                'id' => 'RFD-1007',
                'order_id' => 'ORD-1568',
                'customer_name' => 'Laura Bianchi',
                'date' => '28/03/2025',
                'amount' => 42.75,
                'reason' => 'Ordine errato',
                'status' => 'approvato'
            ]
        ];
    }
}
?>
