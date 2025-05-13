
<?php require_once 'views/layout/header.php'; ?>

<div class="mobile-dashboard-container">
    <!-- Header mobile con saluto e notifiche -->
    <div class="mobile-header">
        <div class="mobile-greeting">
            <div class="mobile-greeting-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="mobile-greeting-text">
                <h2>Ciao, Luca Admin!</h2>
                <p>Benvenuto nel tuo pannello di controllo</p>
            </div>
        </div>
        <div class="mobile-notifications">
            <a href="#" class="notification-icon">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </a>
        </div>
    </div>

    <!-- Statistiche principali mobile in layout verticale -->
    <div class="mobile-stats-grid">
        <div class="mobile-stat-card primary">
            <div class="mobile-stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Ordini Totali</span>
                <span class="mobile-stat-value"><?= $totalOrders ?></span>
                <span class="mobile-stat-trend positive">
                    <i class="fas fa-arrow-up"></i> 8.3%
                </span>
            </div>
        </div>

        <div class="mobile-stat-card secondary">
            <div class="mobile-stat-icon">
                <i class="fas fa-euro-sign"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Ricavi Totali</span>
                <span class="mobile-stat-value"><?= number_format($totalRevenue, 0, ',', '.') ?>€</span>
                <span class="mobile-stat-trend positive">
                    <i class="fas fa-arrow-up"></i> 12.7%
                </span>
            </div>
        </div>

        <div class="mobile-stat-card accent-1">
            <div class="mobile-stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Ordini Attivi</span>
                <?php
                $activeOrdersCount = 0;
                foreach ($ordersByStatus as $status) {
                    if (in_array($status['status'], ['nuovo', 'in preparazione', 'in consegna'])) {
                        $activeOrdersCount += $status['count'];
                    }
                }
                ?>
                <span class="mobile-stat-value"><?= $activeOrdersCount ?></span>
                <span class="mobile-stat-trend negative">
                    <i class="fas fa-arrow-down"></i> 3.5%
                </span>
            </div>
        </div>

        <div class="mobile-stat-card accent-2">
            <div class="mobile-stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="mobile-stat-content">
                <span class="mobile-stat-title">Clienti Totali</span>
                <span class="mobile-stat-value"><?= $totalCustomers ?></span>
                <span class="mobile-stat-trend positive">
                    <i class="fas fa-arrow-up"></i> 5.2%
                </span>
            </div>
        </div>
    </div>

    <!-- Sezione ordini recenti -->
    <div class="mobile-section">
        <div class="mobile-section-header">
            <h3>Ordini Recenti</h3>
            <a href="index.php?controller=orders&action=index" class="mobile-view-all">
                Vedi tutti <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <div class="mobile-orders-list">
            <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
            <div class="mobile-loading">
                <i class="fas fa-spinner fa-spin"></i> Caricamento ordini...
            </div>
        </div>
    </div>

    <!-- Sezione prodotti più venduti -->
    <div class="mobile-section">
        <div class="mobile-section-header">
            <h3>Prodotti Più Venduti</h3>
        </div>
        <div class="mobile-top-products">
            <!-- Il contenuto verrà popolato dinamicamente con JavaScript -->
            <div class="mobile-loading">
                <i class="fas fa-spinner fa-spin"></i> Caricamento prodotti...
            </div>
        </div>
    </div>

    <!-- Sezione status ordini -->
    <div class="mobile-section">
        <div class="mobile-section-header">
            <h3>Status Ordini</h3>
        </div>
        <div class="mobile-status-chart">
            <div class="mobile-status-items">
                <?php foreach ($ordersByStatus as $status): ?>
                    <div class="mobile-status-item">
                        <span class="status-badge status-<?= $status['status'] ?>">
                            <?= $status['status'] ?>
                        </span>
                        <span class="status-count"><?= $status['count'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Pulsante azione rapida -->
    <div class="mobile-action-button">
        <button class="floating-action-button">
            <i class="fas fa-plus"></i>
        </button>
        <div class="floating-action-menu">
            <a href="index.php?controller=orders&action=new"><i class="fas fa-shopping-cart"></i> Nuovo Ordine</a>
            <a href="index.php?controller=customers&action=new"><i class="fas fa-user-plus"></i> Nuovo Cliente</a>
            <a href="index.php?controller=drivers&action=new"><i class="fas fa-motorcycle"></i> Nuovo Driver</a>
        </div>
    </div>
</div>

<!-- Carica Chart.js prima di dashboard.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php require_once 'views/layout/footer.php'; ?>
