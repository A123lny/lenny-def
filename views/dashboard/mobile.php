
<?php require_once 'views/layout/header.php'; ?>

<div class="mobile-dashboard">
    <div class="section-header mb-3">
        <h2 class="section-title">Panoramica</h2>
        <p class="section-subtitle">Statistiche aggiornate in tempo reale</p>
    </div>

    <!-- Statistiche principali versione mobile -->
    <div class="mobile-stats-container">
        <div class="stat-card stat-card-primary animate-float w-100 mb-3">
            <div class="stat-pattern"></div>
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-content">
                <div class="stat-title">Ordini Totali</div>
                <div class="stat-value"><?= $totalOrders ?></div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8.3% rispetto al mese scorso
                </div>
            </div>
        </div>
        
        <div class="stat-card stat-card-secondary animate-float w-100 mb-3">
            <div class="stat-pattern"></div>
            <div class="stat-icon">
                <i class="fas fa-euro-sign"></i>
            </div>
            <div class="stat-content">
                <div class="stat-title">Ricavi Totali</div>
                <div class="stat-value"><?= number_format($totalRevenue, 0, ',', '.') ?>€</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12.7% rispetto al mese scorso
                </div>
            </div>
        </div>
        
        <div class="stat-card stat-card-accent-1 animate-float w-100 mb-3">
            <div class="stat-pattern"></div>
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-title">Ordini Attivi</div>
                <?php
                $activeOrdersCount = 0;
                foreach ($ordersByStatus as $status) {
                    if (in_array($status['status'], ['nuovo', 'in preparazione', 'in consegna'])) {
                        $activeOrdersCount += $status['count'];
                    }
                }
                ?>
                <div class="stat-value"><?= $activeOrdersCount ?></div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 3.5% rispetto a ieri
                </div>
            </div>
        </div>
        
        <div class="stat-card stat-card-accent-2 animate-float w-100 mb-3">
            <div class="stat-pattern"></div>
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-title">Clienti Totali</div>
                <div class="stat-value"><?= $totalCustomers ?></div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 5.2% rispetto alla settimana scorsa
                </div>
            </div>
        </div>
    </div>

    <!-- Pannello ordini recenti mobile -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Ordini Recenti</h5>
            <a href="index.php?controller=orders&action=index" class="btn btn-sm btn-primary">
                <i class="fas fa-external-link-alt me-1"></i> Vedi tutti
            </a>
        </div>
        <div class="card-body p-0">
            <div class="mobile-orders-list">
                <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
                <div class="text-center py-3 text-muted">
                    <i class="fas fa-spinner fa-spin"></i> Caricamento ordini...
                </div>
            </div>
        </div>
    </div>

    <!-- Pannello prodotti più venduti mobile -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Prodotti Più Venduti</h5>
        </div>
        <div class="card-body">
            <div class="top-products mobile-top-products">
                <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
                <div class="text-center py-3 text-muted">
                    <i class="fas fa-spinner fa-spin"></i> Caricamento prodotti...
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carica Chart.js prima di dashboard.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php require_once 'views/layout/footer.php'; ?>
