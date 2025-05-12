<?php require_once 'views/layout/header.php'; ?>

<!-- Inizio della pagina -->
<script>
// Registriamo che siamo nella pagina degli ordini attivi
window.currentPage = 'active-orders';
</script>

<?php
// Dati statici per test
$activeOrders = [
    [
        'id' => '1001',
        'created_at' => date('Y-m-d H:i:s', strtotime('-25 minutes')),
        'status' => 'nuovo',
        'restaurant_name' => 'Pizzeria Napoli',
        'customer_name' => 'Marco Rossi',
        'delivery_address' => 'Via Roma 123, Milano',
        'total_amount' => 32.50
    ],
    [
        'id' => '1002',
        'created_at' => date('Y-m-d H:i:s', strtotime('-45 minutes')),
        'status' => 'in preparazione',
        'restaurant_name' => 'Sushi House',
        'customer_name' => 'Laura Bianchi',
        'delivery_address' => 'Via Garibaldi 45, Milano',
        'total_amount' => 48.90
    ],
    [
        'id' => '1003',
        'created_at' => date('Y-m-d H:i:s', strtotime('-60 minutes')),
        'status' => 'in consegna',
        'restaurant_name' => 'Burger King',
        'customer_name' => 'Paolo Verdi',
        'delivery_address' => 'Corso Italia 87, Milano',
        'total_amount' => 25.80,
        'driver_name' => 'Mario Rossi',
        'driver_id' => '1'
    ],
    [
        'id' => '1004',
        'created_at' => date('Y-m-d H:i:s', strtotime('-15 minutes')),
        'status' => 'nuovo',
        'restaurant_name' => 'Ristorante Cinese',
        'customer_name' => 'Francesca Neri',
        'delivery_address' => 'Via Montenapoleone 10, Milano',
        'total_amount' => 42.70
    ],
    [
        'id' => '1005',
        'created_at' => date('Y-m-d H:i:s', strtotime('-30 minutes')),
        'status' => 'in preparazione',
        'restaurant_name' => 'Trattoria Da Giuseppe',
        'customer_name' => 'Stefano Gialli',
        'delivery_address' => 'Corso Buenos Aires 56, Milano',
        'total_amount' => 67.20
    ],
    [
        'id' => '1006',
        'created_at' => date('Y-m-d H:i:s', strtotime('-90 minutes')),
        'status' => 'in consegna',
        'restaurant_name' => 'McDonald\'s',
        'customer_name' => 'Valentina Azzurri',
        'delivery_address' => 'Via Torino 123, Milano',
        'total_amount' => 19.90,
        'driver_id' => '2',
        'driver_name' => 'Paolo Bianchi'
    ]
];

// Funzione helper per evitare errori con htmlspecialchars e valori null
function safeHtmlSpecialChars($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}
?>

<!-- Includiamo il CSS specifico per questa pagina -->
<link rel="stylesheet" href="assets/css/active-orders.css">

<style>
    /* Stili per card espandibili con riferimenti colorati per gli stati */
    .order-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 10px;
        border-left: 4px solid transparent;
        overflow: hidden;
        cursor: pointer;
    }
    
    /* Bordi colorati per stati differenti */
    .order-card.status-nuovo {
        border-left-color: #ff9800; /* Arancione */
    }
    
    .order-card.status-preparazione {
        border-left-color: #2196F3; /* Blu */
    }
    
    .order-card.status-pronto {
        border-left-color: #ffd54f; /* Giallo */
    }
    
    .order-card.status-consegna {
        border-left-color: #4caf50; /* Verde */
    }
    
    .order-card.status-ritardo {
        border-left-color: #f44336; /* Rosso */
    }
    
    .order-card:hover {
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    
    /* Nuovo layout header card */
    .order-card .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px;
        border-bottom: 1px solid #f0f0f0;
        background-color: #f9f9f9;
    }
    
    .order-card .order-main-info {
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .order-card .order-id {
        font-weight: 500;
        color: #555;
    }
    
    .order-card .restaurant-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
        color: #666;
    }
    
    .order-card .order-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .order-card .order-body {
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
    }
    
    .order-card.expanded .order-body {
        padding: 12px;
        max-height: 300px;
        overflow-y: auto;
    }
    
    .order-card .order-footer {
        display: none;
        padding: 10px 12px;
        border-top: 1px solid #f0f0f0;
        background-color: #f9f9f9;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-card.expanded .order-footer {
        display: flex;
    }
    
    .order-status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .status-nuovo {
        background-color: #fff3e0; /* Sfondo arancione chiaro */
        color: #e65100; /* Testo arancione scuro */
    }
    
    .status-preparazione {
        background-color: #e3f2fd; /* Sfondo blu chiaro */
        color: #0d47a1; /* Testo blu scuro */
    }
    
    .status-pronto {
        background-color: #fffde7; /* Sfondo giallo chiaro */
        color: #fbc02d; /* Testo giallo scuro */
    }
    
    .status-consegna {
        background-color: #e8f5e9; /* Sfondo verde chiaro */
        color: #2e7d32; /* Testo verde scuro */
    }
    
    .status-ritardo {
        background-color: #ffebee; /* Sfondo rosso chiaro */
        color: #c62828; /* Testo rosso scuro */
    }
    
    .order-info {
        margin-bottom: 8px;
        display: flex;
        align-items: flex-start;
    }
    
    .order-info i {
        min-width: 20px;
        margin-right: 6px;
        color: #666;
    }
    
    /* Sistema di griglia per slot temporali */
    .time-slots-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        width: 100%;
        margin-bottom: 15px;
    }
    
    .sub-time-slot {
        width: 100%;
    }
    
    .sub-time-slots-container {
        padding-bottom: 0.8rem;
        width: 100%;
    }
    
    .time-block {
        display: none;
    }
    
    .time-block.active {
        display: block;
    }
    
    /* Animazioni per le card */
    .order-card.animate-in {
        animation: slideIn 0.3s forwards;
    }
    
    .order-card.animate-out {
        animation: slideOut 0.3s forwards;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes slideOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-20px); }
    }
    
    .order-urgente {
        position: relative;
    }
    
    .order-urgente:after {
        content: "";
        position: absolute;
        right: 8px;
        top: 8px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #f44336;
        animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(244, 67, 54, 0); }
        100% { box-shadow: 0 0 0 0 rgba(244, 67, 54, 0); }
    }
    
    /* Stili per il drag&drop */
    .order-card.dragging {
        opacity: 0.4;
    }
    
    .orders-container.drag-over {
        background-color: rgba(33, 150, 243, 0.1);
        border: 2px dashed #2196F3;
    }
    
    /* Miglioramenti per la sezione delle fasce orarie */
    .time-slots-tabs .nav-link {
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
        margin-right: 0.5rem;
        font-weight: 500;
        color: #495057;
        border: 1px solid #dee2e6;
        background-color: #fff;
        white-space: nowrap;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-width: 135px;
    }
    
    .time-slots-tabs .nav-link.active {
        color: #fff;
        background-color: #2196F3;
        border-color: #2196F3;
    }
    
    .time-slots-tabs .nav-link .badge {
        margin-left: 6px;
    }
    
    .time-slots-tabs .nav-link.active .badge {
        background-color: #fff;
        color: #2196F3;
    }
    
    /* Dettagli degli ordini */
    .order-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
    }
    
    .order-details-grid .detail-item {
        background-color: #f8f9fa;
        padding: 0.5rem;
        border-radius: 4px;
    }
    
    .order-details-grid .detail-item .detail-label {
        font-size: 0.7rem;
        color: #6c757d;
        margin-bottom: 2px;
    }
    
    .order-details-grid .detail-item .detail-value {
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    /* Indicatore di tempo */
    .time-indicator {
        font-size: 0.8rem;
        padding: 2px 6px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
    }
    
    .time-ok {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    
    .time-warning {
        background-color: #fff3e0;
        color: #e65100;
    }
    
    .time-danger {
        background-color: #ffebee;
        color: #c62828;
    }
    
    /* Avatar circle per i driver */
    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        color: white;
        margin-right: 8px;
    }

    /* Stile coerente per i pulsanti di azione circolari */
    .btn-action {
        width: 38px; 
        height: 38px; 
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm, 0 1px 3px rgba(0,0,0,0.12));
        font-size: 0.9rem;
    }
    
    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .btn-action.btn-primary {
        background: var(--gradient-primary, linear-gradient(to right, #ff5a5f, #ff3a5c));
        border: none;
    }
    
    .btn-action.btn-secondary {
        background: var(--gradient-secondary, linear-gradient(to right, #6c757d, #5a6268));
        border: none;
    }
    
    .btn-action.btn-success {
        background: var(--gradient-success, linear-gradient(to right, #28a745, #20c997));
        border: none;
    }
    
    /* Stile per gli stati vuoti */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        text-align: center;
        color: #6c757d;
    }
    
    .empty-state .empty-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    /* Stile dropdown assegnazione driver */
    .driver-dropdown .dropdown-menu {
        padding: 0.5rem;
        max-height: 250px;
        overflow-y: auto;
        min-width: 240px;
    }
    
    .driver-dropdown .dropdown-header {
        font-weight: bold;
        color: #2196F3;
        padding: 0.5rem;
        background-color: #e3f2fd;
        border-radius: 4px;
        margin-bottom: 0.5rem;
    }
    
    .driver-dropdown .driver-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        border-radius: 4px;
        transition: all 0.2s ease;
    }
    
    .driver-dropdown .driver-item:hover {
        background-color: #f8f9fa;
    }
    
    .driver-dropdown .driver-info {
        margin-left: 10px;
        flex-grow: 1;
    }
    
    .driver-dropdown .driver-name {
        font-weight: 500;
        display: block;
    }
    
    .driver-dropdown .driver-status {
        font-size: 0.75rem;
        color: #6c757d;
    }
    
    /* Box slot orari ottimizzato */
    .time-slot-card {
        height: calc(100% - 15px);
        display: flex;
        flex-direction: column;
    }
    
    .time-slot-card .card-body {
        flex-grow: 1;
        overflow-y: auto;
        padding: 0.5rem;
    }
    
    /* Controllo azioni compatto con dropdown assegnazione driver */
    .action-controls {
        display: flex;
        justify-content: space-between;
        gap: 5px;
    }
    
    /* Ottimizzazione spazio contenitori principali */
    .sub-time-slots-wrapper {
        width: 100%;
    }
    
    /* Nuovo bottone di assegnazione driver coerente con lo stile del sito */
    .btn-assign-driver {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        background-color: #4caf50;
        color: white;
        border: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        z-index: 100; /* Assicurati che il pulsante sia sopra altri elementi */
    }
    
    .btn-assign-driver:hover {
        background-color: #388e3c;
        color: white;
    }
    
    .btn-assign-driver i {
        margin-right: 3px;
        font-size: 0.7rem;
    }
    
    /* Questo impedisce che l'evento click si propaghi dai pulsanti dropdown alla card */
    .card-clickable-area {
        cursor: pointer;
    }
    
    /* Adattamento per schermi piccoli */
    @media (max-width: 1200px) {
        .time-slots-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .time-slots-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Ordini in corso</h2>
        <p class="section-subtitle">Gestisci gli ordini attivi e monitora le consegne in tempo reale</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-primary" id="active-new-order-btn">
            <i class="fas fa-plus me-1"></i> Nuovo ordine
        </button>
    </div>
</div>

<!-- Statistiche veloci degli ordini attivi - stile orizzontale compatto -->
<div class="stats-grid mb-3">
    <!-- Nuovi ordini - Arancione -->
    <div class="stat-card stat-card-compact animate-float" style="background-color: #ff9800;">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-inbox"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Nuovi ordini</div>
            <div class="stat-value" id="newOrdersCount">
                <?= count(array_filter($activeOrders, function($o) { return $o['status'] === 'nuovo'; })) ?>
            </div>
        </div>
    </div>
    
    <!-- In preparazione - Azzurro -->
    <div class="stat-card stat-card-compact animate-float" style="background-color: #2196F3;">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-utensils"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">In preparazione</div>
            <div class="stat-value" id="preparingOrdersCount">
                <?= count(array_filter($activeOrders, function($o) { return $o['status'] === 'in preparazione'; })) ?>
            </div>
        </div>
    </div>
    
    <!-- Pronti - Giallo più tenue -->
    <div class="stat-card stat-card-compact animate-float" style="background-color: #ffd54f;">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Pronti</div>
            <div class="stat-value" id="readyOrdersCount">
                <?= count(array_filter($activeOrders, function($o) { return $o['status'] === 'pronto'; })) ?? 0 ?>
            </div>
        </div>
    </div>
    
    <!-- In consegna - Verde -->
    <div class="stat-card stat-card-compact animate-float" style="background-color: #4caf50;">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-motorcycle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">In consegna</div>
            <div class="stat-value" id="deliveringOrdersCount">
                <?= count(array_filter($activeOrders, function($o) { return $o['status'] === 'in consegna'; })) ?>
            </div>
        </div>
    </div>
    
    <!-- In ritardo - Rosso -->
    <div class="stat-card stat-card-compact animate-float" style="background-color: #f44336;">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">In ritardo</div>
            <div class="stat-value" id="delayedOrdersCount">
                <?= count(array_filter($activeOrders, function($o) { return isset($o['delayed'])&&$o['delayed']; })) ?? 0 ?>
            </div>
        </div>
    </div>
</div>

<!-- Barra di controllo unificata con driver e filtri -->
<div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
    <div class="driver-control-container flex-grow-1">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <!-- Sezione driver -->
            <div class="d-flex align-items-center flex-wrap me-3">
                <h6 class="mb-0 me-2">Driver:</h6>
                
                <!-- Driver attivi (tutti i disponibili) -->
                <div class="driver-counter me-2 mb-0" data-bs-toggle="modal" data-bs-target="#activeDriversModal" style="cursor: pointer">
                    <span class="badge rounded-pill bg-success px-2 py-1 d-flex align-items-center">
                        <i class="fas fa-user-check me-1"></i> Attivi: <span class="fw-bold ms-1" id="activeDriversCount">7</span>
                    </span>
                </div>
                
                <!-- Driver pronti (non in consegna) -->
                <div class="driver-counter me-2 mb-0" data-bs-toggle="modal" data-bs-target="#readyDriversModal" style="cursor: pointer">
                    <span class="badge rounded-pill bg-primary px-2 py-1 d-flex align-items-center">
                        <i class="fas fa-car me-1"></i> Pronti: <span class="fw-bold ms-1" id="readyDriversCount">3</span>
                    </span>
                </div>
                
                <!-- Driver in consegna -->
                <div class="driver-counter me-2 mb-0" data-bs-toggle="modal" data-bs-target="#deliveringDriversModal" style="cursor: pointer">
                    <span class="badge rounded-pill bg-secondary px-2 py-1 d-flex align-items-center">
                        <i class="fas fa-route me-1"></i> In consegna: <span class="fw-bold ms-1" id="deliveringDriversCount">4</span>
                    </span>
                </div>
                
                <button class="btn btn-sm btn-outline-warning py-1 px-2" id="autoAssignBtn">
                    <i class="fas fa-magic me-1"></i> Auto assegna
                </button>
            </div>
            
            <!-- Separatore verticale -->
            <div class="border-end h-75 mx-2 d-none d-md-block"></div>
            
            <!-- Sezione filtri con ID univoci -->
            <div class="d-flex align-items-center flex-wrap">
                <!-- Ricerca -->
                <div class="input-group input-group-sm me-2 mb-2 mb-sm-0" style="width: 200px;">
                    <span class="input-group-text bg-white border-end-0 py-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 py-0" id="active-order-search" placeholder="Cerca ordine...">
                </div>
                
                <!-- Filtri -->
                <select class="form-select form-select-sm me-2 mb-2 mb-sm-0" style="width: auto;" id="active-status-filter">
                    <option value="all">Tutti gli stati</option>
                    <option value="nuovo">Nuovi ordini</option>
                    <option value="preparazione">In preparazione</option>
                    <option value="pronto">Pronti</option>
                    <option value="consegna">In consegna</option>
                    <option value="ritardo">In ritardo</option>
                </select>
                
                <select class="form-select form-select-sm me-2 mb-2 mb-sm-0" style="width: auto;" id="active-restaurant-filter">
                    <option value="all">Tutti i ristoranti</option>
                    <?php
                    $restaurants = [];
                    foreach($activeOrders as $order) {
                        if (isset($order['restaurant_name'])&&!empty($order['restaurant_name'])&&!in_array($order['restaurant_name'], $restaurants)) {
                            $restaurants[] = $order['restaurant_name'];
                            echo "<option value=\"".htmlspecialchars($order['restaurant_name'])."\">".htmlspecialchars($order['restaurant_name'])."</option>";
                        }
                    }
                    ?>
                </select>
                
                <!-- Reset -->
                <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" id="active-reset-filters">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tabs per le fasce orarie con design migliorato -->
<div class="time-slots-container mb-3 overflow-auto">
    <ul class="nav nav-tabs nav-fill flex-nowrap time-slots-tabs border-0">
        <li class="nav-item">
            <a class="nav-link active" href="#" data-time-range="all">
                Tutti <span class="badge bg-primary ms-1"><?= count($activeOrders) ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-time-range="10-12">
                10:00 - 12:00 <span class="badge bg-primary ms-1">12</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-time-range="12-14">
                12:00 - 14:00 <span class="badge bg-primary ms-1">8</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-time-range="14-16">
                14:00 - 16:00 <span class="badge bg-primary ms-1">5</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-time-range="16-18">
                16:00 - 18:00 <span class="badge bg-primary ms-1">9</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-time-range="18-20">
                18:00 - 20:00 <span class="badge bg-primary ms-1">7</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-time-range="20-22">
                20:00 - 22:00 <span class="badge bg-primary ms-1">4</span>
            </a>
        </li>
    </ul>
</div>

<!-- Vista Kanban ottimizzata -->
<div class="orders-views">
    <!-- Vista Kanban (visibile di default) -->
    <div id="kanban-view" class="mb-4">
        <div class="time-block active" data-time-range="all">
            <!-- Contenitore con griglia a larghezza ottimizzata per fasce da 30 minuti -->
            <div class="sub-time-slots-wrapper">
                <?php
                // Orari degli slot (dalle 10:00 alle 22:00, ogni 30 minuti)
                $timeSlots = [
                    '10:00-10:30', '10:30-11:00', '11:00-11:30', '11:30-12:00',
                    '12:00-12:30', '12:30-13:00', '13:00-13:30', '13:30-14:00',
                    '14:00-14:30', '14:30-15:00', '15:00-15:30', '15:30-16:00',
                    '16:00-16:30', '16:30-17:00', '17:00-17:30', '17:30-18:00',
                    '18:00-18:30', '18:30-19:00', '19:00-19:30', '19:30-20:00',
                    '20:00-20:30', '20:30-21:00', '21:00-21:30', '21:30-22:00'
                ];

                // Raggruppa gli slot in blocchi di 4 (per le fasce di 2 ore)
                $timeSlotGroups = array_chunk($timeSlots, 4);
                
                // Per ogni gruppo di 4 slot di 30 minuti (che forma una fascia di 2 ore)
                foreach ($timeSlotGroups as $groupIndex => $group):
                ?>
                <div class="time-slots-row">
                    <?php
                    // Per ogni slot da 30 minuti in questo gruppo
                    foreach ($group as $slotIndex => $timeSlot):
                        list($startTime, $endTime) = explode('-', $timeSlot);
                        
                        // Numero casuale di ordini per questo slot (da 0 a 5)
                        $ordersCount = rand(0, 5);
                        
                        // Calcola il tempo stimato di preparazione (12-20 min)
                        $estimatedTime = rand(12, 20);
                    ?>
                    <div class="sub-time-slot" data-time="<?= $timeSlot ?>">
                        <div class="card border-0 shadow-sm time-slot-card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-dark"><?= $timeSlot ?></h6>
                                    <span class="badge bg-primary"><?= $ordersCount ?></span>
                                </div>
                                <div class="text-muted small">
                                    <i class="fas fa-clock me-1"></i> Tempo stimato: <?= $estimatedTime ?> min
                                </div>
                            </div>
                            <div class="card-body orders-container">
                                <?php 
                                // Simula alcuni ordini per questo slot
                                for ($i = 0; $i < $ordersCount; $i++) {
                                    $orderId = 1000 + ($groupIndex * 40 + $slotIndex * 10) + $i;
                                    // Stati possibili: nuovo, preparazione, pronto, consegna, ritardo
                                    $stati = ['nuovo', 'preparazione', 'pronto', 'consegna', 'ritardo'];
                                    $stato = $stati[array_rand($stati)];
                                    
                                    // Per alcuni ordini, aggiungi il flag di urgenza
                                    $isUrgente = rand(0, 10) > 8;
                                    
                                    // Ristoranti di esempio
                                    $ristoranti = ['Pizzeria Napoli', 'Sushi House', 'Burger King', 'Ristorante Cinese', 'Trattoria Da Giuseppe', 'McDonald\'s'];
                                    $ristorante = $ristoranti[array_rand($ristoranti)];
                                    
                                    // Importo casuale tra 15 e 70 euro
                                    $importo = number_format(rand(1500, 7000) / 100, 2);

                                    // Stato formattato per visualizzazione
                                    $statoFormattato = '';
                                    switch($stato) {
                                        case 'nuovo': $statoFormattato = 'Nuovo'; break;
                                        case 'preparazione': $statoFormattato = 'In preparazione'; break;
                                        case 'pronto': $statoFormattato = 'Pronto'; break;
                                        case 'consegna': $statoFormattato = 'In consegna'; break;
                                        case 'ritardo': $statoFormattato = 'In ritardo'; break;
                                    }
                                ?>
                                <div class="order-card mb-2 status-<?= $stato ?> <?= $isUrgente ? 'order-urgente' : '' ?>" data-order-id="<?= $orderId ?>" data-restaurant="<?= $ristorante ?>">
                                    <div class="order-header">
                                        <div class="order-main-info card-clickable-area" onclick="toggleOrderExpand(this.closest('.order-card'))">
                                            <span class="order-id">#<?= $orderId ?></span>
                                            <span class="mx-2">•</span>
                                            <span class="restaurant-name"><?= $ristorante ?></span>
                                        </div>
                                        <div class="order-actions">
                                            <div class="order-status-badge status-<?= $stato ?>"><?= $statoFormattato ?></div>
                                            <?php if ($stato !== 'consegna'): ?>
                                            <div class="dropdown driver-dropdown">
                                                <button class="btn-assign-driver" 
                                                        type="button" 
                                                        id="driverDropdown-<?= $orderId ?>" 
                                                        data-bs-toggle="dropdown" 
                                                        aria-expanded="false">
                                                    <i class="fas fa-user-plus"></i> Assegna
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="driverDropdown-<?= $orderId ?>">
                                                    <li><h6 class="dropdown-header">Driver disponibili</h6></li>
                                                    <!-- Mario Bianchi -->
                                                    <li><a class="dropdown-item driver-item" href="#" onclick="assignOrderToDriver('<?= $orderId ?>', '1', 'Mario Bianchi'); return false;">
                                                        <div class="avatar-circle bg-primary" style="width: 28px; height: 28px; font-size: 12px;">MB</div>
                                                        <div class="driver-info">
                                                            <span class="driver-name">Mario Bianchi</span>
                                                            <span class="driver-status">Disponibile</span>
                                                        </div>
                                                    </a></li>
                                                    <!-- Paolo Verdi -->
                                                    <li><a class="dropdown-item driver-item" href="#" onclick="assignOrderToDriver('<?= $orderId ?>', '3', 'Paolo Verdi'); return false;">
                                                        <div class="avatar-circle bg-info" style="width: 28px; height: 28px; font-size: 12px;">PV</div>
                                                        <div class="driver-info">
                                                            <span class="driver-name">Paolo Verdi</span>
                                                            <span class="driver-status">Disponibile</span>
                                                        </div>
                                                    </a></li>
                                                    <!-- Fabio Bruno -->
                                                    <li><a class="dropdown-item driver-item" href="#" onclick="assignOrderToDriver('<?= $orderId ?>', '6', 'Fabio Bruno'); return false;">
                                                        <div class="avatar-circle bg-success" style="width: 28px; height: 28px; font-size: 12px;">FB</div>
                                                        <div class="driver-info">
                                                            <span class="driver-name">Fabio Bruno</span>
                                                            <span class="driver-status">Disponibile</span>
                                                        </div>
                                                    </a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#activeDriversModal">
                                                        <i class="fas fa-list me-2"></i> Visualizza tutti
                                                    </a></li>
                                                </ul>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="order-body">
                                        <div class="order-details-grid">
                                            <div class="detail-item">
                                                <div class="detail-label">Importo</div>
                                                <div class="detail-value">€ <?= $importo ?></div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-label">Orario</div>
                                                <div class="detail-value"><?= $startTime ?></div>
                                            </div>
                                        </div>
                                        
                                        <div class="order-info">
                                            <i class="fas fa-user"></i>
                                            <span>Cliente: Mario Rossi</span>
                                        </div>
                                        
                                        <div class="order-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Via Roma 123, Milano</span>
                                        </div>
                                        
                                        <div class="order-info">
                                            <i class="fas fa-phone"></i>
                                            <span>Tel: 345 1234567</span>
                                        </div>
                                        
                                        <div class="order-info">
                                            <i class="fas fa-shopping-bag"></i>
                                            <span>
                                                <?php
                                                // Prodotti casuali ordinati
                                                $prodotti = ['Pizza Margherita', 'Pizza Diavola', 'Hamburger', 'Sushi Mix', 'Spaghetti', 'Insalata Caesar', 'Coca Cola', 'Acqua'];
                                                $numProdotti = rand(1, 4);
                                                $ordineDettaglio = [];
                                                for ($p = 0; $p < $numProdotti; $p++) {
                                                    $quantita = rand(1, 2);
                                                    $prodotto = $prodotti[array_rand($prodotti)];
                                                    $ordineDettaglio[] = "$quantita x $prodotto";
                                                }
                                                echo implode(', ', $ordineDettaglio);
                                                ?>
                                            </span>
                                        </div>
                                        
                                        <?php if ($stato === 'consegna'): ?>
                                        <div class="order-info">
                                            <i class="fas fa-motorcycle"></i>
                                            <span>Driver: Paolo Verdi</span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="order-footer">
                                        <div class="order-total">
                                            <i class="fas fa-euro-sign me-1"></i> <?= $importo ?>
                                        </div>
                                        <div class="action-controls">
                                            <?php if ($stato === 'nuovo'): ?>
                                            <button class="btn btn-sm btn-outline-primary move-to-preparing" data-order-id="<?= $orderId ?>">
                                                <i class="fas fa-arrow-right me-1"></i> Preparazione
                                            </button>
                                            <?php elseif ($stato === 'preparazione'): ?>
                                            <button class="btn btn-sm btn-outline-info move-to-ready" data-order-id="<?= $orderId ?>">
                                                <i class="fas fa-arrow-right me-1"></i> Pronto
                                            </button>
                                            <?php elseif ($stato === 'pronto'): ?>
                                            <button class="btn btn-sm btn-outline-success move-to-delivering" data-order-id="<?= $orderId ?>">
                                                <i class="fas fa-arrow-right me-1"></i> In consegna
                                            </button>
                                            <?php elseif ($stato === 'consegna'): ?>
                                            <button class="btn btn-sm btn-outline-success mark-delivered" data-order-id="<?= $orderId ?>">
                                                <i class="fas fa-check me-1"></i> Consegnato
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton-<?= $orderId ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?= $orderId ?>">
                                                <li><a class="dropdown-item view-order-btn" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-eye me-2"></i> Visualizza
                                                </a></li>
                                                <li><a class="dropdown-item print-order-btn" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-print me-2"></i> Stampa
                                                </a></li>
                                                <?php if ($stato === 'nuovo'): ?>
                                                <li><a class="dropdown-item move-to-preparing" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-arrow-right me-2"></i> Metti in preparazione
                                                </a></li>
                                                <?php elseif ($stato === 'preparazione'): ?>
                                                <li><a class="dropdown-item move-to-ready" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-arrow-right me-2"></i> Segna come pronto
                                                </a></li>
                                                <?php elseif ($stato === 'pronto'): ?>
                                                <li><a class="dropdown-item move-to-delivering" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-arrow-right me-2"></i> Metti in consegna
                                                </a></li>
                                                <?php elseif ($stato === 'consegna'): ?>
                                                <li><a class="dropdown-item mark-delivered" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-check me-2"></i> Segna come consegnato
                                                </a></li>
                                                <li><a class="dropdown-item driver-info" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-id-badge me-2"></i> Info driver
                                                </a></li>
                                                <li><a class="dropdown-item track-delivery" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-map-marked-alt me-2"></i> Traccia consegna
                                                </a></li>
                                                <?php endif; ?>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item cancel-order-btn text-danger" href="#" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-times me-2"></i> Annulla
                                                </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php if ($ordersCount === 0): ?>
                                <!-- Empty state for no orders -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    Nessun ordine in questo slot
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Blocchi per altre fasce orarie (nascosti inizialmente) -->
        <?php 
        $timeRanges = ['10-12', '12-14', '14-16', '16-18', '18-20', '20-22'];
        foreach ($timeRanges as $rangeIndex => $range): 
            list($start, $end) = explode('-', $range);
        ?>
        <div class="time-block" data-time-range="<?= $range ?>">
            <div class="sub-time-slots-wrapper">
                <div class="time-slots-row">
                    <?php
                    // Estrai gli slot di questa fascia oraria
                    $rangeSlots = array_slice($timeSlots, $rangeIndex * 4, 4);
                    
                    foreach ($rangeSlots as $slotIndex => $timeSlot) {
                        list($startTime, $endTime) = explode('-', $timeSlot);
                        $ordersCount = rand(0, 5);
                        $estimatedTime = rand(12, 20);
                    ?>
                    <div class="sub-time-slot" data-time="<?= $timeSlot ?>">
                        <div class="card border-0 shadow-sm time-slot-card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-dark"><?= $timeSlot ?></h6>
                                    <span class="badge bg-primary"><?= $ordersCount ?></span>
                                </div>
                                <div class="text-muted small">
                                    <i class="fas fa-clock me-1"></i> Tempo stimato: <?= $estimatedTime ?> min
                                </div>
                            </div>
                            <div class="card-body orders-container">
                                <?php if ($ordersCount === 0): ?>
                                <!-- Empty state for no orders -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    Nessun ordine in questo slot
                                </div>
                                <?php else: ?>
                                    <?php 
                                    // Simula ordini per questo slot
                                    for ($i = 0; $i < $ordersCount; $i++):
                                        $orderId = 2000 + ($rangeIndex * 40 + $slotIndex * 10) + $i;
                                        $stati = ['nuovo', 'preparazione', 'pronto', 'consegna', 'ritardo'];
                                        $stato = $stati[array_rand($stati)];
                                        $isUrgente = rand(0, 10) > 8;
                                        $ristoranti = ['Pizzeria Napoli', 'Sushi House', 'Burger King', 'Ristorante Cinese', 'Trattoria Da Giuseppe', 'McDonald\'s'];
                                        $ristorante = $ristoranti[array_rand($ristoranti)];
                                        $importo = number_format(rand(1500, 7000) / 100, 2);

                                        // Stato formattato per visualizzazione
                                        $statoFormattato = '';
                                        switch($stato) {
                                            case 'nuovo': $statoFormattato = 'Nuovo'; break;
                                            case 'preparazione': $statoFormattato = 'In preparazione'; break;
                                            case 'pronto': $statoFormattato = 'Pronto'; break;
                                            case 'consegna': $statoFormattato = 'In consegna'; break;
                                            case 'ritardo': $statoFormattato = 'In ritardo'; break;
                                        }
                                    ?>
                                    <div class="order-card mb-2 status-<?= $stato ?> <?= $isUrgente ? 'order-urgente' : '' ?>" data-order-id="<?= $orderId ?>" data-restaurant="<?= $ristorante ?>">
                                        <div class="order-header">
                                            <div class="order-main-info card-clickable-area" onclick="toggleOrderExpand(this.closest('.order-card'))">
                                                <span class="order-id">#<?= $orderId ?></span>
                                                <span class="mx-2">•</span>
                                                <span class="restaurant-name"><?= $ristorante ?></span>
                                            </div>
                                            <div class="order-actions">
                                                <div class="order-status-badge status-<?= $stato ?>"><?= $statoFormattato ?></div>
                                                <?php if ($stato !== 'consegna'): ?>
                                                <div class="dropdown driver-dropdown">
                                                    <button class="btn-assign-driver" 
                                                            type="button" 
                                                            id="driverDropdown-<?= $orderId ?>" 
                                                            data-bs-toggle="dropdown" 
                                                            aria-expanded="false">
                                                        <i class="fas fa-user-plus"></i> Assegna
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="driverDropdown-<?= $orderId ?>">
                                                        <li><h6 class="dropdown-header">Driver disponibili</h6></li>
                                                        <!-- Mario Bianchi -->
                                                        <li><a class="dropdown-item driver-item" href="#" onclick="assignOrderToDriver('<?= $orderId ?>', '1', 'Mario Bianchi'); return false;">
                                                            <div class="avatar-circle bg-primary" style="width: 28px; height: 28px; font-size: 12px;">MB</div>
                                                            <div class="driver-info">
                                                                <span class="driver-name">Mario Bianchi</span>
                                                                <span class="driver-status">Disponibile</span>
                                                            </div>
                                                        </a></li>
                                                        <!-- Paolo Verdi -->
                                                        <li><a class="dropdown-item driver-item" href="#" onclick="assignOrderToDriver('<?= $orderId ?>', '3', 'Paolo Verdi'); return false;">
                                                            <div class="avatar-circle bg-info" style="width: 28px; height: 28px; font-size: 12px;">PV</div>
                                                            <div class="driver-info">
                                                                <span class="driver-name">Paolo Verdi</span>
                                                                <span class="driver-status">Disponibile</span>
                                                            </div>
                                                        </a></li>
                                                        <!-- Fabio Bruno -->
                                                        <li><a class="dropdown-item driver-item" href="#" onclick="assignOrderToDriver('<?= $orderId ?>', '6', 'Fabio Bruno'); return false;">
                                                            <div class="avatar-circle bg-success" style="width: 28px; height: 28px; font-size: 12px;">FB</div>
                                                            <div class="driver-info">
                                                                <span class="driver-name">Fabio Bruno</span>
                                                                <span class="driver-status">Disponibile</span>
                                                            </div>
                                                        </a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#activeDriversModal">
                                                            <i class="fas fa-list me-2"></i> Visualizza tutti
                                                        </a></li>
                                                    </ul>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="order-body">
                                            <div class="order-details-grid">
                                                <div class="detail-item">
                                                    <div class="detail-label">Importo</div>
                                                    <div class="detail-value">€ <?= $importo ?></div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="detail-label">Orario</div>
                                                    <div class="detail-value"><?= $startTime ?></div>
                                                </div>
                                            </div>
                                            
                                            <div class="order-info">
                                                <i class="fas fa-user"></i>
                                                <span>Cliente: Mario Rossi</span>
                                            </div>
                                            
                                            <div class="order-info">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>Via Roma 123, Milano</span>
                                            </div>
                                            
                                            <div class="order-info">
                                                <i class="fas fa-phone"></i>
                                                <span>Tel: 345 1234567</span>
                                            </div>
                                        </div>
                                        <div class="order-footer">
                                            <div class="order-total">
                                                <i class="fas fa-euro-sign me-1"></i> <?= $importo ?>
                                            </div>
                                            <div class="action-controls">
                                                <?php if ($stato === 'nuovo'): ?>
                                                <button class="btn btn-sm btn-outline-primary move-to-preparing" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-arrow-right me-1"></i> Preparazione
                                                </button>
                                                <?php elseif ($stato === 'preparazione'): ?>
                                                <button class="btn btn-sm btn-outline-info move-to-ready" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-arrow-right me-1"></i> Pronto
                                                </button>
                                                <?php elseif ($stato === 'pronto'): ?>
                                                <button class="btn btn-sm btn-outline-success move-to-delivering" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-arrow-right me-1"></i> In consegna
                                                </button>
                                                <?php elseif ($stato === 'consegna'): ?>
                                                <button class="btn btn-sm btn-outline-success mark-delivered" data-order-id="<?= $orderId ?>">
                                                    <i class="fas fa-check me-1"></i> Consegnato
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton-<?= $orderId ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?= $orderId ?>">
                                                    <li><a class="dropdown-item view-order-btn" href="#" data-order-id="<?= $orderId ?>">
                                                        <i class="fas fa-eye me-2"></i> Visualizza
                                                    </a></li>
                                                    <li><a class="dropdown-item print-order-btn" href="#" data-order-id="<?= $orderId ?>">
                                                        <i class="fas fa-print me-2"></i> Stampa
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Vista Timeline (nascosta inizialmente) -->
    <div id="timeline-view" class="mb-4" style="display: none;">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="timeline-container p-3">
                    <div class="p-4 text-center">
                        <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                        <h5>Vista Timeline</h5>
                        <p class="text-muted">Hai preferito non utilizzarla. Usa la vista Kanban per una gestione ottimale degli ordini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aggiungiamo uno stile per garantire che il testo sia leggibile su sfondi colorati -->
<style>
    .stat-card {
        color: white;
        text-shadow: 0 1px 1px rgba(0,0,0,0.2);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Stile per la barra compatta dei driver */
    .driver-control-container {
        display: inline-block;
        background-color: white;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        width: auto;
    }
    
    /* Rendi i badge più compatti */
    .driver-counter .badge {
        font-size: 0.8rem;
        font-weight: normal;
        transition: all 0.2s ease;
    }
    
    .driver-counter:hover .badge {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
</style>

<!-- Container per i toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

<!-- Script per gestire i filtri e altre funzionalità -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Riferimenti agli elementi DOM per i filtri
    const orderSearch = document.getElementById('active-order-search');
    const statusFilter = document.getElementById('active-status-filter');
    const restaurantFilter = document.getElementById('active-restaurant-filter');
    const resetFiltersBtn = document.getElementById('active-reset-filters');
    
    // Raccogliamo tutte le card degli ordini
    const orderCards = document.querySelectorAll('.order-card');

    // Inizializza tutti i dropdown di Bootstrap
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    })
    
    // Aggiungi un gestore di eventi per evitare la propagazione dei click sui dropdown
    document.querySelectorAll('.driver-dropdown button, .driver-dropdown .dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    
    // Inizializzazione modali (verifica che Bootstrap sia caricato)
    let assignDriverModal, trackDeliveryModal, confirmDeliveryModal, driverInfoModal, selectOrderForDriverModal;
    
    if (typeof bootstrap !== 'undefined') {
        if (document.getElementById('assignDriverModal')) {
            assignDriverModal = new bootstrap.Modal(document.getElementById('assignDriverModal'));
        }
        if (document.getElementById('trackDeliveryModal')) {
            trackDeliveryModal = new bootstrap.Modal(document.getElementById('trackDeliveryModal'));
        }
        if (document.getElementById('confirmDeliveryModal')) {
            confirmDeliveryModal = new bootstrap.Modal(document.getElementById('confirmDeliveryModal'));
        }
        if (document.getElementById('driverInfoModal')) {
            driverInfoModal = new bootstrap.Modal(document.getElementById('driverInfoModal'));
        }
        if (document.getElementById('selectOrderForDriverModal')) {
            selectOrderForDriverModal = new bootstrap.Modal(document.getElementById('selectOrderForDriverModal'));
        }
    }
    
    // Memorizza i contatori totali reali
    const totalCounts = {
        new: parseInt(document.getElementById('newOrdersCount').textContent.trim()) || 0,
        preparing: parseInt(document.getElementById('preparingOrdersCount').textContent.trim()) || 0,
        ready: parseInt(document.getElementById('readyOrdersCount').textContent.trim()) || 0,
        delivering: parseInt(document.getElementById('deliveringOrdersCount').textContent.trim()) || 0,
        delayed: parseInt(document.getElementById('delayedOrdersCount').textContent.trim()) || 0
    };
    
    // Funzione per applicare i filtri (aggiornata per non modificare i contatori globali)
    function applyFilters() {
        const searchTerm = orderSearch.value.toLowerCase();
        const statusValue = statusFilter.value;
        const restaurantValue = restaurantFilter.value;
        
        // Contatori per le card visibili (solo per aggiornare i contatori nelle tab)
        let visibleCardsCount = 0;
        
        // Per ogni card di ordine, verifichiamo se corrisponde ai filtri
        orderCards.forEach(card => {
            const cardId = card.dataset.orderId;
            const cardRestaurant = card.dataset.restaurant;
            const cardContent = card.innerText.toLowerCase();
            
            // Otteniamo lo stato dalla classe della card
            let cardStatus = '';
            if (card.classList.contains('status-nuovo')) cardStatus = 'nuovo';
            else if (card.classList.contains('status-preparazione')) cardStatus = 'preparazione';
            else if (card.classList.contains('status-pronto')) cardStatus = 'pronto';
            else if (card.classList.contains('status-consegna')) cardStatus = 'consegna';
            else if (card.classList.contains('status-ritardo')) cardStatus = 'ritardo';
            
            let visible = true;
            
            // Filtro ricerca testuale
            if (searchTerm&&!cardContent.includes(searchTerm)) {
                visible = false;
            }
            
            // Filtro stato
            if (statusValue !== 'all'&&statusValue !== cardStatus) {
                visible = false;
            }
            
            // Filtro ristorante
            if (restaurantValue !== 'all'&&restaurantValue !== cardRestaurant) {
                visible = false;
            }
            
            // Applica visibilità
            card.style.display = visible ? 'block' : 'none';
            
            // Conta tutte le card visibili per aggiornare il contatore della tab "Tutti"
            if (visible) {
                visibleCardsCount++;
            }
        });
        
        // Aggiorna solo il contatore delle card visibili nella tab "Tutti"
        const allTabBadge = document.querySelector('.time-slots-tabs .nav-link[data-time-range="all"] .badge');
        if (allTabBadge) {
            allTabBadge.textContent = visibleCardsCount;
        }
        
        // Verifica se ci sono card visibili in ogni slot temporale
        checkEmptyTimeSlots();
    }
    
    // Funzione per aggiornare i contatori dopo un'azione reale (non filtri)
    function updateRealCounters(newNew, newPreparing, newReady, newDelivering, newDelayed) {
        // Aggiorna i contatori reali
        totalCounts.new = newNew;
        totalCounts.preparing = newPreparing;
        totalCounts.ready = newReady;
        totalCounts.delivering = newDelivering;
        totalCounts.delayed = newDelayed;
        
        // Aggiorna i contatori visualizzati
        const newOrdersCount = document.getElementById('newOrdersCount');
        const preparingOrdersCount = document.getElementById('preparingOrdersCount');
        const readyOrdersCount = document.getElementById('readyOrdersCount');
        const deliveringOrdersCount = document.getElementById('deliveringOrdersCount');
        const delayedOrdersCount = document.getElementById('delayedOrdersCount');
        
        if (newOrdersCount) newOrdersCount.textContent = totalCounts.new;
        if (preparingOrdersCount) preparingOrdersCount.textContent = totalCounts.preparing;
        if (readyOrdersCount) readyOrdersCount.textContent = totalCounts.ready;
        if (deliveringOrdersCount) deliveringOrdersCount.textContent = totalCounts.delivering;
        if (delayedOrdersCount) delayedOrdersCount.textContent = totalCounts.delayed;
        
        // Aggiorna anche il contatore totale per la fascia "Tutti" se non ci sono filtri attivi
        if (statusFilter.value === 'all'&&restaurantFilter.value === 'all'&&!orderSearch.value) {
            const allTabBadge = document.querySelector('.time-slots-tabs .nav-link[data-time-range="all"] .badge');
            if (allTabBadge) {
                allTabBadge.textContent = totalCounts.new + totalCounts.preparing + totalCounts.ready + 
                                         totalCounts.delivering + totalCounts.delayed;
            }
        }
    }
    
    // Funzione per controllare se ci sono slot temporali vuoti
    function checkEmptyTimeSlots() {
        // Per ogni slot temporale
        document.querySelectorAll('.sub-time-slot').forEach(slot => {
            const visibleCards = slot.querySelectorAll('.order-card:not([style*="display: none"])');
            const cardContainer = slot.querySelector('.orders-container');
            const emptyState = slot.querySelector('.empty-state');
            
            if (visibleCards.length === 0) {
                // Non ci sono card visibili in questo slot
                if (!emptyState&&cardContainer) {
                    // Crea messaggio stato vuoto
                    const emptyDiv = document.createElement('div');
                    emptyDiv.className = 'empty-state';
                    emptyDiv.innerHTML = `
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div>Nessun ordine in questo slot</div>
                    `;
                    cardContainer.appendChild(emptyDiv);
                }
            } else {
                // Ci sono card visibili, rimuovi il messaggio stato vuoto
                if (emptyState) {
                    emptyState.remove();
                }
            }
        });
    }
    
    // Resetta i filtri ai valori predefiniti
    function resetFilters() {
        if (orderSearch) orderSearch.value = '';
        if (statusFilter) statusFilter.value = 'all';
        if (restaurantFilter) restaurantFilter.value = 'all';
        
        // Applica i filtri dopo il reset
        applyFilters();
    }
    
    // Funzione per spostare un ordine alla fase successiva
    function moveOrderToNextStatus(orderId, newStatus) {
        // Trova l'elemento ordine
        const orderCard = document.querySelector(`.order-card[data-order-id="${orderId}"]`);
        if (!orderCard) return;
        
        // Trova la colonna di destinazione
        const targetColumn = document.querySelector(`.orders-column[data-status="${newStatus}"] .orders-container`);
        
        // Animazione uscita
        orderCard.classList.add('animate-out');
        
        // Ottieni lo stato corrente dell'ordine
        let currentStatus = '';
        if (orderCard.classList.contains('status-nuovo')) currentStatus = 'nuovo';
        else if (orderCard.classList.contains('status-preparazione')) currentStatus = 'preparazione';
        else if (orderCard.classList.contains('status-pronto')) currentStatus = 'pronto';
        else if (orderCard.classList.contains('status-consegna')) currentStatus = 'consegna';
        else if (orderCard.classList.contains('status-ritardo')) currentStatus = 'ritardo';
        
        // Rimuovi la classe dello stato corrente e aggiungi la classe del nuovo stato
        orderCard.classList.remove(`status-${currentStatus}`);
        
        // Converti il nuovo stato al formato della classe CSS
        let newStatusClass = newStatus.replace('in ', '');
        orderCard.classList.add(`status-${newStatusClass}`);
        
        // Modifica il testo del badge di stato
        const statusBadge = orderCard.querySelector('.order-status-badge');
        if (statusBadge) {
            statusBadge.className = `order-status-badge status-${newStatusClass}`;
            let statusText = '';
            switch(newStatusClass) {
                case 'nuovo': statusText = 'Nuovo'; break;
                case 'preparazione': statusText = 'In preparazione'; break;
                case 'pronto': statusText = 'Pronto'; break;
                case 'consegna': statusText = 'In consegna'; break;
                case 'ritardo': statusText = 'In ritardo'; break;
            }
            statusBadge.textContent = statusText;
        }
        
        // Se il nuovo stato è "consegna", rimuovi il pulsante di assegnazione driver dall'header
        if (newStatusClass === 'consegna') {
            const assignDriverBtn = orderCard.querySelector('.driver-dropdown');
            if (assignDriverBtn) {
                assignDriverBtn.remove();
            }
        }
        
        setTimeout(() => {
            // Aggiorna i contatori reali
            updateCountersAfterMove();
            
            // Aggiungi nuovamente gli event listeners
            attachEventListeners();
            
            // Rimuovi l'animazione
            orderCard.classList.remove('animate-out');
            
            // Mostra toast di conferma
            showToast('Ordine aggiornato', `L'ordine #${orderId} è stato spostato in "${newStatus}"`, 'success');
        }, 300);
    }
    
    // Funzione per calcolare un orario di consegna stimato realistico
    function estimateDeliveryTime() {
        const now = new Date();
        now.setMinutes(now.getMinutes() + 30); // Aggiungi 30 minuti all'ora corrente
        return now.getHours().toString().padStart(2, '0') + ':' + 
                now.getMinutes().toString().padStart(2, '0');
    }
    
    // Funzione per aggiornare i contatori dopo lo spostamento di un ordine
    function updateCountersAfterMove() {
        // Conta tutti gli ordini per stato (non solo quelli visibili)
        const realNewCount = document.querySelectorAll('.order-card.status-nuovo').length;
        const realPreparingCount = document.querySelectorAll('.order-card.status-preparazione').length;
        const realReadyCount = document.querySelectorAll('.order-card.status-pronto').length;
        const realDeliveringCount = document.querySelectorAll('.order-card.status-consegna').length;
        const realDelayedCount = document.querySelectorAll('.order-card.status-ritardo').length;
        
        // Aggiorna i contatori totali reali
        updateRealCounters(realNewCount, realPreparingCount, realReadyCount, realDeliveringCount, realDelayedCount);
        
        // Se abbiamo filtri attivi, applica di nuovo i filtri per aggiornare la visualizzazione
        if (statusFilter.value !== 'all' || restaurantFilter.value !== 'all' || orderSearch.value) {
            applyFilters();
        }
    }
    
    // Funzione per segnare un ordine come consegnato
    function markOrderAsDelivered(orderId) {
        const orderCard = document.querySelector(`.order-card[data-order-id="${orderId}"]`);
        if (!orderCard) return;
        
        // Animazione uscita
        orderCard.classList.add('animate-out');
        
        setTimeout(() => {
            // Rimuovi la card
            orderCard.remove();
            
            // Aggiorna contatori
            updateCountersAfterMove();
            
            // Mostra toast di conferma
            showToast('Ordine completato', `L'ordine #${orderId} è stato consegnato con successo!`, 'success');
        }, 300);
    }
    
    // Funzione per annullare un ordine
    function cancelOrder(orderId) {
        if (confirm(`Sei sicuro di voler annullare l'ordine #${orderId}?`)) {
            const orderCard = document.querySelector(`.order-card[data-order-id="${orderId}"]`);
            if (!orderCard) return;
            
            // Animazione uscita
            orderCard.classList.add('animate-out');
            
            setTimeout(() => {
                // Rimuovi la card
                orderCard.remove();
                
                // Aggiorna contatori
                updateCountersAfterMove();
                
                // Mostra toast di conferma
                showToast('Ordine annullato', `L'ordine #${orderId} è stato annullato`, 'warning');
            }, 300);
        }
    }
    
    // Funzione per allegare event listeners a tutti i pulsanti
    function attachEventListeners() {
        // Pulsanti per spostare in preparazione
        document.querySelectorAll('.move-to-preparing').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation(); // Impedisci che l'evento faccia espandere la card
                moveOrderToNextStatus(this.dataset.orderId, 'in preparazione');
            });
        });
        
        // Pulsanti per spostare come pronto
        document.querySelectorAll('.move-to-ready').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                moveOrderToNextStatus(this.dataset.orderId, 'pronto');
            });
        });
        
        // Pulsanti per spostare in consegna
        document.querySelectorAll('.move-to-delivering').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                moveOrderToNextStatus(this.dataset.orderId, 'in consegna');
            });
        });
        
        // Pulsanti per tracciare consegna
        document.querySelectorAll('.track-delivery').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                showToast('Traccia consegna', `Tracciamento dell'ordine #${this.dataset.orderId}`, 'info');
            });
        });
        
        // Pulsanti per info driver
        document.querySelectorAll('.driver-info').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (driverInfoModal) driverInfoModal.show();
            });
        });
        
        // Pulsanti per segnare come consegnato
        document.querySelectorAll('.mark-delivered').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const orderId = this.dataset.orderId;
                if (document.getElementById('deliveredOrderId')) {
                    document.getElementById('deliveredOrderId').value = orderId;
                }
                if (document.getElementById('deliveryOrderNumber')) {
                    document.getElementById('deliveryOrderNumber').textContent = '#' + orderId;
                }
                if (confirmDeliveryModal) {
                    confirmDeliveryModal.show();
                }
            });
        });
        
        // Pulsanti per annullare ordine
        document.querySelectorAll('.cancel-order-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                cancelOrder(this.dataset.orderId);
            });
        });
        
        // Pulsanti per visualizzare ordine
        document.querySelectorAll('.view-order-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                showToast('Visualizza ordine', `Visualizzazione ordine #${this.dataset.orderId}`, 'info');
            });
        });
        
        // Pulsanti per stampare ordine
        document.querySelectorAll('.print-order-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                showToast('Stampa ordine', `Stampa ordine #${this.dataset.orderId}`, 'info');
            });
        });
    }
    
    // Event listener per conferma consegna completata
    const confirmDeliveredBtn = document.getElementById('confirmDeliveredBtn');
    if (confirmDeliveredBtn) {
        confirmDeliveredBtn.addEventListener('click', function() {
            const orderId = document.getElementById('deliveredOrderId').value;
            markOrderAsDelivered(orderId);
            if (confirmDeliveryModal) {
                confirmDeliveryModal.hide();
            }
        });
    }
    
    // Funzione per mostrare toast di notifica
    function showToast(title, message, type = 'primary') {
        // Se esiste una funzione globale showToast, usala
        if (typeof window.showToast === 'function') {
            window.showToast(title, message, type);
            return;
        }
        
        // Implementazione semplificata di un toast
        const toastContainer = document.querySelector('.toast-container') || (() => {
            const container = document.createElement('div');
            container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            container.style.zIndex = '1080';
            document.body.appendChild(container);
            return container;
        })();
        
        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <strong>${title}</strong>: ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        toastContainer.appendChild(toastEl);
        
        if (typeof bootstrap !== 'undefined') {
            const bsToast = new bootstrap.Toast(toastEl);
            bsToast.show();
        }
        
        setTimeout(() => {
            try {
                if (typeof bootstrap !== 'undefined') {
                    const bsToast = bootstrap.Toast.getInstance(toastEl);
                    if (bsToast) bsToast.hide();
                }
                setTimeout(() => toastEl.remove(), 300);
            } catch (e) {
                toastEl.remove();
            }
        }, 5000);
    }
    
    // Aggiungi event listeners ai filtri
    if (orderSearch) {
        orderSearch.addEventListener('input', applyFilters);
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', applyFilters);
    }
    
    if (restaurantFilter) {
        restaurantFilter.addEventListener('change', applyFilters);
    }
    
    // Reset filtri
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', resetFilters);
    }
    
    // Event handler per il pulsante di auto assegnazione
    const autoAssignBtn = document.getElementById('autoAssignBtn');
    if (autoAssignBtn) {
        autoAssignBtn.addEventListener('click', function() {
            showToast('Auto assegnazione', 'Funzionalità di auto assegnazione in fase di sviluppo', 'info');
        });
    }
    
    // Calcolo automatico dei valori dei contatori driver in base alla logica
    function updateDriverCounts() {
        // In un'app reale, questi valori verrebbero dal server
        // Per ora usiamo valori di esempio
        const totalActiveDrivers = 7;    // Tutti i driver attivi in servizio
        const deliveringDrivers = 4;     // Driver attualmente in consegna
        const readyDrivers = totalActiveDrivers - deliveringDrivers; // Driver pronti = attivi - in consegna
        
        // Aggiorniamo i contatori
        document.getElementById('activeDriversCount').textContent = totalActiveDrivers;
        document.getElementById('deliveringDriversCount').textContent = deliveringDrivers;
        document.getElementById('readyDriversCount').textContent = readyDrivers;
    }
    
    // Gestione dei tab per le fasce orarie
    const timeSlotsTabs = document.querySelectorAll('.time-slots-tabs .nav-link');
    const timeBlocks = document.querySelectorAll('.time-block');
    
    timeSlotsTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Rimuovi la classe active da tutti i tab
            timeSlotsTabs.forEach(t => t.classList.remove('active'));
            
            // Aggiungi la classe active al tab cliccato
            this.classList.add('active');
            
            // Mostra il blocco temporale corrispondente
            const timeRange = this.getAttribute('data-time-range');
            timeBlocks.forEach(block => {
                if (block.getAttribute('data-time-range') === timeRange) {
                    block.style.display = 'block';
                } else {
                    block.style.display = 'none';
                }
            });
        });
    });
    
    // Inizializza i listener agli eventi
    attachEventListeners();
    
    // Chiamare la funzione all'inizializzazione
    updateDriverCounts();
    
    // Mostra "Tutti" all'inizio
    const allTab = document.querySelector('.time-slots-tabs .nav-link[data-time-range="all"]');
    if (allTab) {
        allTab.click();
    }
    
    // Applica i filtri all'avvio
    applyFilters();
});
</script>

<!-- Funzione per espandere/comprimere le card degli ordini -->
<script>
function toggleOrderExpand(element) {
    // Toggle della classe expanded sulla card
    element.classList.toggle('expanded');
}
</script>

<!-- Funzione per assegnare un ordine a un driver -->
<script>
// Funzione per assegnare un ordine specifico a un driver
function assignOrderToDriver(orderId, driverId, driverName) {
    // Trova l'ordine nella DOM
    const orderCard = document.querySelector(`.order-card[data-order-id="${orderId}"]`);
    if (!orderCard) {
        showToast('Errore', `Ordine #${orderId} non trovato`, 'danger');
        return;
    }
    
    // Aggiorna lo stato dell'ordine a "in consegna"
    orderCard.classList.remove('status-preparazione', 'status-pronto', 'status-nuovo');
    orderCard.classList.add('status-consegna');
    
    // Aggiorna la visualizzazione del badge di stato
    const statusBadge = orderCard.querySelector('.order-status-badge');
    if (statusBadge) {
        statusBadge.className = 'order-status-badge status-consegna';
        statusBadge.textContent = 'In consegna';
    }
    
    // Rimuovi il pulsante di assegnazione driver
    const driverDropdown = orderCard.querySelector('.driver-dropdown');
    if (driverDropdown) {
        driverDropdown.remove();
    }
    
    // Aggiungi info del driver all'ordine
    const orderBody = orderCard.querySelector('.order-body');
    if (orderBody) {
        // Verifica se esiste già l'informazione del driver
        let driverInfo = orderBody.querySelector('.order-info:last-child');
        if (driverInfo&&driverInfo.querySelector('i.fas.fa-motorcycle')) {
            // Aggiorna l'informazione esistente
            driverInfo.querySelector('span').textContent = `Driver: ${driverName}`;
        } else {
            // Crea una nuova info sul driver
            const driverInfoHTML = `
                <div class="order-info">
                    <i class="fas fa-motorcycle"></i>
                    <span>Driver: ${driverName}</span>
                </div>
            `;
            orderBody.insertAdjacentHTML('beforeend', driverInfoHTML);
        }
    }
    
    // Aggiorna i pulsanti dell'ordine
    const orderFooter = orderCard.querySelector('.order-footer');
    if (orderFooter) {
        // Aggiorna i pulsanti
        const actionControls = orderFooter.querySelector('.action-controls');
        if (actionControls) {
            actionControls.innerHTML = `
                <button class="btn btn-sm btn-outline-success mark-delivered" data-order-id="${orderId}">
                    <i class="fas fa-check me-1"></i> Consegnato
                </button>
            `;
        }

        // Aggiorna il dropdown menu
        const dropdownMenu = orderFooter.querySelector('.dropdown-menu');
        if (dropdownMenu) {
            dropdownMenu.innerHTML = `
                <li><a class="dropdown-item view-order-btn" href="#" data-order-id="${orderId}">
                    <i class="fas fa-eye me-2"></i> Visualizza
                </a></li>
                <li><a class="dropdown-item print-order-btn" href="#" data-order-id="${orderId}">
                    <i class="fas fa-print me-2"></i> Stampa
                </a></li>
                <li><a class="dropdown-item mark-delivered" href="#" data-order-id="${orderId}">
                    <i class="fas fa-check me-2"></i> Segna come consegnato
                </a></li>
                <li><a class="dropdown-item driver-info" href="#" data-order-id="${orderId}">
                    <i class="fas fa-id-badge me-2"></i> Info driver
                </a></li>
                <li><a class="dropdown-item track-delivery" href="#" data-order-id="${orderId}">
                    <i class="fas fa-map-marked-alt me-2"></i> Traccia consegna
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item cancel-order-btn text-danger" href="#" data-order-id="${orderId}">
                    <i class="fas fa-times me-2"></i> Annulla
                </a></li>
            `;
        }
    }
    
    // Aggiorna i contatori
    // Conta tutti gli ordini per stato dopo la modifica
    const realNewCount = document.querySelectorAll('.order-card.status-nuovo').length;
    const realPreparingCount = document.querySelectorAll('.order-card.status-preparazione').length;
    const realReadyCount = document.querySelectorAll('.order-card.status-pronto').length;
    const realDeliveringCount = document.querySelectorAll('.order-card.status-consegna').length;
    const realDelayedCount = document.querySelectorAll('.order-card.status-ritardo').length;
    
    // Aggiorna i contatori negli elementi HTML
    const newOrdersCount = document.getElementById('newOrdersCount');
    const preparingOrdersCount = document.getElementById('preparingOrdersCount');
    const readyOrdersCount = document.getElementById('readyOrdersCount');
    const deliveringOrdersCount = document.getElementById('deliveringOrdersCount');
    const delayedOrdersCount = document.getElementById('delayedOrdersCount');
    
    if (newOrdersCount) newOrdersCount.textContent = realNewCount;
    if (preparingOrdersCount) preparingOrdersCount.textContent = realPreparingCount;
    if (readyOrdersCount) readyOrdersCount.textContent = realReadyCount;
    if (deliveringOrdersCount) deliveringOrdersCount.textContent = realDeliveringCount;
    if (delayedOrdersCount) delayedOrdersCount.textContent = realDelayedCount;
    
    // Mostra un toast di conferma
    showToast('Driver assegnato', `${driverName} è stato assegnato all'ordine #${orderId}`, 'success');
    
    // Aggiungi event listener per il nuovo pulsante di consegna
    const markDeliveredBtn = orderCard.querySelector('.mark-delivered');
    if (markDeliveredBtn) {
        markDeliveredBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const orderId = this.dataset.orderId;
            document.getElementById('deliveredOrderId').value = orderId;
            document.getElementById('deliveryOrderNumber').textContent = '#' + orderId;
            new bootstrap.Modal(document.getElementById('confirmDeliveryModal')).show();
        });
    }
    
    // Aggiungi event listener per le nuove opzioni del dropdown
    const trackDeliveryBtn = orderCard.querySelector('.track-delivery');
    if (trackDeliveryBtn) {
        trackDeliveryBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            showToast('Traccia consegna', `Tracciamento dell'ordine #${this.dataset.orderId}`, 'info');
        });
    }
    
    const driverInfoBtn = orderCard.querySelector('.driver-info');
    if (driverInfoBtn) {
        driverInfoBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            new bootstrap.Modal(document.getElementById('driverInfoModal')).show();
        });
    }
}

// Funzione per mostrare toast di notifica
function showToast(title, message, type = 'primary') {
    // Implementazione semplificata di un toast
    const toastContainer = document.querySelector('.toast-container') || (() => {
        const container = document.createElement('div');
        container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        container.style.zIndex = '1080';
        document.body.appendChild(container);
        return container;
    })();
    
    const toastEl = document.createElement('div');
    toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    
    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <strong>${title}</strong>: ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    toastContainer.appendChild(toastEl);
    
    if (typeof bootstrap !== 'undefined') {
        const bsToast = new bootstrap.Toast(toastEl);
        bsToast.show();
    }
    
    setTimeout(() => {
        try {
            if (typeof bootstrap !== 'undefined') {
                const bsToast = bootstrap.Toast.getInstance(toastEl);
                if (bsToast) bsToast.hide();
            }
            setTimeout(() => toastEl.remove(), 300);
        } catch (e) {
            toastEl.remove();
        }
    }, 5000);
}

// Funzione per assegnare un driver
function assignDriver(driverId) {
    // In un'app reale, questa funzione mostrerebbe un dialogo per selezionare un ordine da assegnare al driver
    // Per ora, mostriamo solo un toast informativo
    let driverName;
    switch (driverId) {
        case 1: driverName = "Mario Bianchi"; break;
        case 3: driverName = "Paolo Verdi"; break;
        case 6: driverName = "Fabio Bruno"; break;
        default: driverName = `Driver #${driverId}`;
    }
    
    showToast('Selezione ordine', `Seleziona un ordine da assegnare a ${driverName}`, 'info');
}

// Funzioni per chiamare/tracciare driver
function callDriver(driverId) {
    showToast('Chiamata driver', `Chiamata al driver ${driverId} in corso...`, 'info');
}

function trackDriver(driverId) {
    showToast('Tracciamento', `Tracciamento del driver ${driverId} in corso...`, 'info');
}
</script>

<!-- Modali per i driver -->
<!-- Modale Driver Attivi (con pulsanti di azione aggiornati) -->
<div class="modal fade" id="activeDriversModal" tabindex="-1" aria-labelledby="activeDriversModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="activeDriversModalLabel">
                    <i class="fas fa-user-check me-2"></i> Driver Attivi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Stato</th>
                                <th>Consegne oggi</th>
                                <th>Ultima attività</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary me-2">MB</div>
                                        Mario Bianchi
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Disponibile</span></td>
                                <td>8</td>
                                <td>12:45 (10 min fa)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(1)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(1)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(1)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-danger me-2">LR</div>
                                        Laura Rossi
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">In consegna</span></td>
                                <td>6</td>
                                <td>12:50 (5 min fa)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(2)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(2)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(2)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-info me-2">PV</div>
                                        Paolo Verdi
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Disponibile</span></td>
                                <td>5</td>
                                <td>12:30 (25 min fa)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(3)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(3)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(3)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-warning me-2">GF</div>
                                        Giovanni Ferrari
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">In consegna</span></td>
                                <td>9</td>
                                <td>12:40 (15 min fa)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(4)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(4)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(4)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-secondary me-2">AM</div>
                                        Anna Marini
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">In pausa</span></td>
                                <td>3</td>
                                <td>12:20 (35 min fa)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(5)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(5)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(5)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-success me-2">FB</div>
                                        Fabio Bruno
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Disponibile</span></td>
                                <td>7</td>
                                <td>12:35 (20 min fa)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(6)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(6)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(6)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-dark me-2">MN</div>
                                        Marco Neri
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">In consegna</span></td>
                                <td>5</td>
                                <td>12:55 (adesso)</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-action" onclick="assignDriver(7)" title="Assegna a ordine">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-action ms-2" onclick="callDriver(7)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(7)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-success">Invia messaggio a tutti</button>
            </div>
        </div>
    </div>
</div>
<!-- Modale Driver Pronti -->
<div class="modal fade" id="readyDriversModal" tabindex="-1" aria-labelledby="readyDriversModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="readyDriversModalLabel">
                    <i class="fas fa-car me-2"></i> Driver Pronti per Consegna
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <!-- Driver 1 -->
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-primary me-3">MB</div>
                                <div>
                                    <h6 class="mb-0">Mario Bianchi</h6>
                                    <small class="text-muted">Attivo da: 3 ore e 15 min</small>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btn-action" onclick="assignDriver(1)" title="Assegna a ordine">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Driver 2 -->
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-info me-3">PV</div>
                                <div>
                                    <h6 class="mb-0">Paolo Verdi</h6>
                                    <small class="text-muted">Attivo da: 2 ore e 45 min</small>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btn-action" onclick="assignDriver(3)" title="Assegna a ordine">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Driver 3 -->
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-success me-3">FB</div>
                                <div>
                                    <h6 class="mb-0">Fabio Bruno</h6>
                                    <small class="text-muted">Attivo da: 1 ora e 30 min</small>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btn-action" onclick="assignDriver(6)" title="Assegna a ordine">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modale Driver In Consegna -->
<div class="modal fade" id="deliveringDriversModal" tabindex="-1" aria-labelledby="deliveringDriversModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="deliveringDriversModalLabel">
                    <i class="fas fa-route me-2"></i> Driver In Consegna
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Ordine</th>
                                <th>Ristorante</th>
                                <th>Cliente</th>
                                <th>ETA</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-danger me-2">LR</div>
                                        Laura Rossi
                                    </div>
                                </td>
                                <td>#1245</td>
                                <td>Pizzeria Napoli</td>
                                <td>M. Bianchi</td>
                                <td><span class="badge bg-success">5 min</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btn-action" onclick="callDriver(1)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(1)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-warning me-2">GF</div>
                                        Giovanni Ferrari
                                    </div>
                                </td>
                                <td>#1243</td>
                                <td>Sushi House</td>
                                <td>F. Ricci</td>
                                <td><span class="badge bg-warning">10 min</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btn-action" onclick="callDriver(2)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(2)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-dark me-2">MN</div>
                                        Marco Neri
                                    </div>
                                </td>
                                <td>#1242</td>
                                <td>Burger King</td>
                                <td>A. Russo</td>
                                <td><span class="badge bg-success">3 min</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btn-action" onclick="callDriver(3)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(3)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary me-2">RL</div>
                                        Roberto Longo
                                    </div>
                                </td>
                                <td>#1238</td>
                                <td>Ristorante Cinese</td>
                                <td>L. Bianchi</td>
                                <td><span class="badge bg-danger">15 min</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btn-action" onclick="callDriver(4)" title="Chiama">
                                            <i class="fa fa-phone"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-action ms-2" onclick="trackDriver(4)" title="Traccia">
                                            <i class="fa fa-map-marker"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modale Conferma Consegna -->
<div class="modal fade" id="confirmDeliveryModal" tabindex="-1" aria-labelledby="confirmDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="confirmDeliveryModalLabel">
                    <i class="fas fa-check-circle me-2"></i> Conferma consegna completata
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deliveredOrderId" value="">
                <p class="mb-3">Confermi che l'ordine <span id="deliveryOrderNumber" class="fw-bold"></span> è stato consegnato con successo?</p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> 
                    Una volta confermata la consegna, l'ordine verrà rimosso dalla lista degli ordini attivi.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-success" id="confirmDeliveredBtn">
                    <i class="fas fa-check me-1"></i> Conferma consegna
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modale Info Driver -->
<div class="modal fade" id="driverInfoModal" tabindex="-1" aria-labelledby="driverInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="driverInfoModalLabel">
                    <i class="fas fa-id-badge me-2"></i> Informazioni driver
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <div class="avatar-circle bg-primary mx-auto mb-2" style="width: 64px; height: 64px; font-size: 1.5rem;">
                        <span>PV</span>
                    </div>
                    <h5 class="mb-0">Paolo Verdi</h5>
                    <span class="badge bg-success">Online</span>
                </div>
                
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Telefono</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone me-2 text-primary"></i>
                                <span>+39 345 6789012</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small">ID Driver</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-id-card me-2 text-primary"></i>
                                <span>DR-2345</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small">In servizio da</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                <span>08:30 (4h 15m)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Consegne oggi</label>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shipping-fast me-2 text-primary"></i>
                                <span>5 completate</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Veicolo</label>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-motorcycle me-2 text-primary"></i>
                        <span>Scooter Honda SH125 - Targa: AB12345</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Ultima posizione</label>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span>Via Montenapoleone, Milano (3 min fa)</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary" onclick="callDriver(3)">
                    <i class="fas fa-phone me-1"></i> Chiama
                </button>
                <button type="button" class="btn btn-info" onclick="trackDriver(3)">
                    <i class="fas fa-map-marker-alt me-1"></i> Traccia
                </button>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>