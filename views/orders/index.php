<?php require_once 'views/layout/header.php'; ?>

<!-- Includi CSS specifico per gli ordini -->
<link rel="stylesheet" href="assets/css/5-pages/_orders.css">

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Storico Ordini</h2>
        <p class="section-subtitle">Gestisci e consulta tutti gli ordini della piattaforma</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Nuovo ordine
        </button>
    </div>
</div>

<!-- Statistiche principali nello stile della dashboard -->
<div class="stats-grid mb-4">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Ordini totali</div>
            <div class="stat-value">1.254</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 8.3% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-secondary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-euro-sign"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Fatturato totale</div>
            <div class="stat-value">24.582,50€</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 12.7% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-motorcycle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Consegne completate</div>
            <div class="stat-value">1.189</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 6.2% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-2 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-utensils"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Valore medio ordine</div>
            <div class="stat-value">19,60€</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 2.1% rispetto al mese scorso
            </div>
        </div>
    </div>
</div>

<!-- Tabella ordini con filtri integrati -->
<div class="orders-container mb-4">
    <!-- Intestazione e filtri -->
    <div class="orders-header">
        <div class="d-flex align-items-center justify-content-between w-100 flex-wrap">
            <div class="d-flex align-items-center flex-wrap flex-grow-1">
                <div class="input-group search-box me-3 mb-2">
                    <span class="input-group-text">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control" id="searchQuery" placeholder="Cerca ordine...">
                </div>
                
                <div class="filter-group d-flex flex-wrap align-items-center">
                    <div class="filter-container mb-2 me-3">
                        <select class="form-select" id="statusFilter" style="min-width: 180px;">
                            <option value="all" selected>Tutti gli stati</option>
                            <option value="nuovo">Nuovo</option>
                            <option value="in preparazione">In preparazione</option>
                            <option value="in consegna">In consegna</option>
                            <option value="consegnato">Consegnato</option>
                            <option value="annullato">Annullato</option>
                        </select>
                    </div>
                    
                    <div class="filter-container mb-2 me-3">
                        <select class="form-select" id="restaurantFilter" style="min-width: 220px;">
                            <option value="all" selected>Tutti i ristoranti</option>
                            <option value="pizzeria napoli">Pizzeria Napoli</option>
                            <option value="burger king">Burger King</option>
                            <option value="pizzeria da mario">Pizzeria Da Mario</option>
                            <option value="ristorante bella italia">Ristorante Bella Italia</option>
                            <option value="sushi fusion">Sushi Fusion</option>
                        </select>
                    </div>
                    
                    <div class="filter-container mb-2">
                        <div class="period-filter">
                            <button class="period-btn active" data-period="all">Tutti</button>
                            <button class="period-btn" data-period="oggi">Oggi</button>
                            <button class="period-btn" data-period="settimana">Settimana</button>
                            <button class="period-btn" data-period="mese">Mese</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="dropdown mb-2">
                <button type="button" class="btn btn-primary dropdown-toggle" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download me-1"></i> Esporta
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="#" id="exportCSV"><i class="fas fa-file-csv me-2"></i> Esporta CSV</a></li>
                    <li><a class="dropdown-item" href="#" id="exportPDF"><i class="fas fa-file-pdf me-2"></i> Esporta PDF</a></li>
                    <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2"></i> Esporta Excel</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Tabella ordini -->
    <div class="orders-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data ordine</th>
                    <th scope="col">Data consegna</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Ristorante</th>
                    <th scope="col">Importo</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">Nessun ordine trovato</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><strong><?= $order['order_number'] ?></strong></td>
                            <td><?= $order['date'] ?></td>
                            <td><?= $order['delivery_date'] ?></td>
                            <td><?= $order['customer_name'] ?></td>
                            <td><?= $order['restaurant'] ?></td>
                            <td><strong><?= $order['total'] ?></strong></td>
                            <td>
                                <?php
                                $statusClass = '';
                                switch ($order['status']) {
                                    case 'Nuovo':
                                        $statusClass = 'badge-primary';
                                        break;
                                    case 'In preparazione':
                                        $statusClass = 'badge-info';
                                        break;
                                    case 'In consegna':
                                        $statusClass = 'badge-warning';
                                        break;
                                    case 'Consegnato':
                                        $statusClass = 'badge-success';
                                        break;
                                    case 'Annullato':
                                        $statusClass = 'badge-danger';
                                        break;
                                }
                                ?>
                                <span class="status-badge <?= $statusClass ?>"><?= $order['status'] ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn view-btn view-order-btn" data-order-id="<?= $order['id'] ?>" data-bs-toggle="tooltip" title="Visualizza">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="action-btn print-btn" data-order-id="<?= $order['id'] ?>" data-bs-toggle="tooltip" title="Stampa">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Paginazione e info -->
    <div class="orders-footer">
        <div class="text-muted small">
            Mostrando <strong>7</strong> di <strong>1.254</strong> ordini
        </div>
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Include il modal nuovo ordine -->
<?php require_once 'views/orders/modals/new_order_modal.php'; ?>

<!-- Include il modal dettaglio ordine -->
<?php require_once 'views/orders/modals/order_detail_modal.php'; ?>

<!-- Include librerie esterne necessarie -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Aggiungo le librerie jsPDF e autotable direttamente nell'HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/it.js"></script>

<?php require_once 'views/layout/footer.php'; ?>
