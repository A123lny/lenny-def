<?php require_once 'views/layout/header.php'; ?>

<div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="section-title">Rimborsi</h2>
        <p class="section-subtitle">Gestisci e approva i rimborsi dei clienti</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?php echo url('orders', 'refunds_analysis'); ?>" class="btn btn-sm btn-info me-2" id="btnAnalisiRimborsi">
            <i class="fas fa-chart-bar me-1"></i> Analisi rimborsi
        </a>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newRefundModal">
            <i class="fas fa-plus me-1"></i> Nuovo rimborso
        </button>
    </div>
</div>

<!-- Statistiche principali nello stile della dashboard -->
<div class="stats-grid mb-4">
    <div class="stat-card stat-card-primary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Rimborsi totali</div>
            <div class="stat-value"><?= $stats['total_refunds'] ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 7.2% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-secondary animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-hourglass-half"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Rimborsi in attesa</div>
            <div class="stat-value"><?= $stats['pending_refunds'] ?></div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 3.5% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-1 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Rimborsi approvati</div>
            <div class="stat-value"><?= $stats['approved_refunds'] ?></div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i> 5.8% rispetto al mese scorso
            </div>
        </div>
    </div>
    
    <div class="stat-card stat-card-accent-2 animate-float">
        <div class="stat-pattern"></div>
        <div class="stat-icon">
            <i class="fas fa-euro-sign"></i>
        </div>
        <div class="stat-content">
            <div class="stat-title">Valore medio rimborso</div>
            <div class="stat-value"><?= number_format($stats['total_amount'] / $stats['total_refunds'], 2, ',', '.') ?>€</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-down"></i> 1.3% rispetto al mese scorso
            </div>
        </div>
    </div>
</div>

<!-- Tabella rimborsi con filtri integrati -->
<div class="orders-container mb-4">
    <!-- Intestazione e filtri -->
    <div class="orders-header">
        <div class="d-flex align-items-center justify-content-between w-100 flex-wrap">
            <div class="d-flex align-items-center flex-wrap flex-grow-1">
                <div class="input-group search-box me-3 mb-2">
                    <span class="input-group-text">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control" id="searchQuery" placeholder="Cerca rimborso...">
                </div>
                
                <div class="filter-group d-flex flex-wrap align-items-center">
                    <div class="filter-container mb-2 me-3">
                        <select class="form-select" id="statusFilter" style="min-width: 180px;">
                            <option value="all" selected>Tutti gli stati</option>
                            <option value="in attesa">In attesa</option>
                            <option value="approvato">Approvato</option>
                            <option value="rifiutato">Rifiutato</option>
                        </select>
                    </div>
                    
                    <div class="filter-container mb-2 me-3">
                        <select class="form-select" id="reasonFilter" style="min-width: 220px;">
                            <option value="all" selected>Tutte le motivazioni</option>
                            <option value="consegna in ritardo">Consegna in ritardo</option>
                            <option value="ordine errato">Ordine errato</option>
                            <option value="prodotto danneggiato">Prodotto danneggiato</option>
                            <option value="qualità del cibo">Qualità del cibo</option>
                            <option value="ordine incompleto">Ordine incompleto</option>
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
                <button type="button" class="btn btn-primary dropdown-toggle export-btn" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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

    <!-- Tabella rimborsi -->
    <div class="orders-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Rimborso</th>
                    <th scope="col">ID Ordine</th>
                    <th scope="col">Data</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Motivazione</th>
                    <th scope="col">Importo</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($refundsData)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">Nessun rimborso trovato</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($refundsData as $refund): ?>
                        <tr>
                            <td><strong><?= $refund['id'] ?></strong></td>
                            <td><a href="index.php?controller=orders&action=view&id=<?= substr($refund['order_id'], 4) ?>" class="text-primary"><?= $refund['order_id'] ?></a></td>
                            <td><?= $refund['date'] ?></td>
                            <td><?= $refund['customer_name'] ?></td>
                            <td><?= $refund['reason'] ?></td>
                            <td><strong><?= number_format($refund['amount'], 2, ',', '.') ?>€</strong></td>
                            <td>
                                <?php
                                    $statusClass = 'secondary';
                                    switch ($refund['status']) {
                                        case 'in attesa':
                                            $statusClass = 'warning';
                                            break;
                                        case 'approvato':
                                            $statusClass = 'success';
                                            break;
                                        case 'rifiutato':
                                            $statusClass = 'danger';
                                            break;
                                    }
                                ?>
                                <span class="status-badge badge-<?= $statusClass ?>"><?= ucfirst($refund['status']) ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn view-btn view-refund-btn" data-refund-id="<?= $refund['id'] ?>" data-bs-toggle="tooltip" title="Visualizza">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="action-btn print-btn" data-refund-id="<?= $refund['id'] ?>" data-bs-toggle="tooltip" title="Stampa">
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
            Mostrando <strong><?= count($refundsData) ?></strong> di <strong><?= count($refundsData) ?></strong> rimborsi
        </div>
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal per Nuovo Rimborso -->
<?php require_once 'views/orders/modals/new_refund_modal.php'; ?>

<!-- Modal per Dettaglio Rimborso -->
<?php require_once 'views/orders/modals/refund_detail_modal.php'; ?>

<!-- Toast per notifiche -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto" id="toastTitle">Notifica</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage">
            Messaggio di esempio
        </div>
    </div>
</div>

<!-- Dipendenze JavaScript -->
<!-- Aggiungo le librerie jsPDF e autotable direttamente nell'HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<?php require_once 'views/layout/footer.php'; ?>
